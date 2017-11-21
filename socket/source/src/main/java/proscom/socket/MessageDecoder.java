// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.socket;

import java.util.concurrent.ConcurrentHashMap;

import org.apache.commons.configuration.PropertiesConfiguration;
import org.jboss.netty.buffer.ChannelBuffer;
import org.jboss.netty.channel.Channel;
import org.jboss.netty.channel.ChannelHandlerContext;
import org.jboss.netty.handler.codec.frame.FrameDecoder;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import proscom.common.AppConfig;
import proscom.common.AppEnv;
import proscom.domain.Account;
import proscom.domain.Alarm;
import proscom.domain.IDModule;
import proscom.domain.Imsi;
import proscom.domain.InformationElement;
import proscom.domain.Message;
import proscom.domain.ModuleStatus;
import proscom.domain.OutputMode;
import proscom.domain.Parameter;
import proscom.domain.Sensor;
import proscom.domain.Sim;
import proscom.domain.SystemMode;
import proscom.domain.TimerCounter;
import proscom.enums.ImsiStatus;
import proscom.exception.AppConfigException;
import proscom.util.ChannelBufferHelper;
import proscom.util.DbUtil;
import proscom.util.StringUtil;

/**
 * <p>
 * Title: ProsCOM
 * </p>
 * <p>
 * Copyright: Copyright (c) by LAPTRINH.VN 2016
 * </p>
 * 
 * @author LAPTRINH.VN
 * @version 0.1
 */
public class MessageDecoder extends FrameDecoder {

	private static final Logger logger = LoggerFactory.getLogger(MessageDecoder.class);

	//private ChannelBuffer accountReportStart;
	private ChannelBuffer accountReportEnd;
	
	protected static ConcurrentHashMap<String, String> serverMessage = new ConcurrentHashMap<>();
	
	private void loadConfiguration() throws AppConfigException {
		
		PropertiesConfiguration config = AppConfig.getPropertiesConfiguration();
		
		//accountReportStart = ChannelBufferHelper.fromString(config.getString(AppEnv.ACCOUNT_REPORT_START, AppEnv.DEFAULT_ACCOUNT_REPORT_START));
		accountReportEnd = ChannelBufferHelper.fromString(config.getString(AppEnv.ACCOUNT_REPORT_END, AppEnv.DEFAULT_ACCOUNT_REPORT_END));
	}
	
	@Override
	protected Object decode(ChannelHandlerContext ctx, Channel channel, ChannelBuffer buffer) throws Exception {
		
		Message message = new Message();
		buffer.markReaderIndex();
		ChannelBuffer rawMessage = buffer.copy();
		logger.info("rawMessage: {}", new String(rawMessage.array()));
		
		try {
			loadConfiguration();
			
			// message data
			String UD;
			String messageType;
			String messageId;
			
			UD = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 1));
			buffer.skipBytes(1);
			
			if (UD.equals("0")) {
				messageType = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 3));
				buffer.skipBytes(3);
				
				messageId = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 4));
				buffer.skipBytes(4);
				
				// bien ma
				//message.code = UD;
				message.code = messageType;
				message.code += messageId;
				
				IDModule idModule;
				
				// CONFIG
				if (messageType.equals("000")) {
					
					ModuleStatus moduleStatus;
					idModule = readId(buffer);
					if (idModule != null) {
						message.customerCode = idModule.customerCode;
					}
					
					switch (messageId) {
					
					// system mode config complete
					case "0000":
						logger.info("system mode config complete: " + idModule.toString());
						break;
						
					// output mode config complete
					case "0001":
						logger.info("output mode config complete: " + idModule.toString());
						break;
						
					// parameter config completer
					case "0010":
						logger.info("parameter mode config complete: " + idModule.toString());
						break;
						
					// timer config complete
					case "0011":
						logger.info("timer mode config complete: " + idModule.toString());
						break;
						
					case "0100": // sytem mode report
						SystemMode systemMode = readSystemMode(buffer);
						logger.info("sytem mode report: " + idModule.toString() + systemMode.toString());
						break;
						
					case "0101": // output mode report
						OutputMode outputMode = readOutputMode(buffer);
						DbUtil.saveOutputMode(idModule, outputMode);
						
						logger.info("output mode report: " + idModule.toString() + outputMode.toString());
						break;
						
					case "0110": // parameter report
						
						Parameter paramter = readParameter(buffer);
						DbUtil.saveParameter(idModule, paramter);
						
						logger.info("parameter report: " + idModule.toString() + paramter.toString());
						break;
						
					case "0111": // 0|000|0111: timer report
						
						TimerCounter timerCounter = readTimerCounter(buffer);
						DbUtil.insertTimerCounter(idModule, timerCounter, 0);
						
						logger.info("timer counter report: " + idModule.toString() + timerCounter.toString());
						break;
						
					case "1000": // 0|000|1000: system status report
						
						Sensor sensor = readSensor(buffer);
						DbUtil.insertSensor(idModule, sensor, 0);
						
						// on-off status
						moduleStatus = readModuleStatus(buffer);
						DbUtil.insertModuleStatus(idModule, moduleStatus);
						
						logger.info("sensor report: " + idModule.toString() + sensor.toString() + "-" + moduleStatus);
						break;
					case "1001": // 0|000|1001: on-off status report
						
						moduleStatus = readModuleStatus(buffer);
						DbUtil.insertModuleStatus(idModule, moduleStatus);
						
						logger.info("sensor report: " + idModule.toString() + moduleStatus.toString());
						break;
					default:
						break;
					}
				}
				// ALARM
				else if (messageType.equals("001")) {
					
					idModule = readId(buffer);
					Alarm alarm = null;
					
					if (idModule != null) {
						message.customerCode = idModule.customerCode;
					}
					
					switch (messageId) {
					// ALARM REPORT
					case "0000":	// 0|001|0000
						alarm = readAlarm(buffer);
						alarm.alarm_type = 0;
						logger.info("alarm report: " + idModule.toString() + alarm.toString());
						break;
						
					// ALARM CLEARANCE
					case "0001":	// 0|001|0001
						alarm = readAlarm(buffer);
						alarm.alarm_type = 1;
						logger.info("alarm clearance: " + idModule.toString() + alarm.toString());
						break;
					default:
						break;
					}
					
					if (alarm != null) {
						DbUtil.insertAlarm(idModule, alarm);
						DbUtil.updateModuleAlarm(idModule, alarm);
						message.content = idModule.ie.content;
						message.content += alarm.ie.content;
					}
				}
				// ACCOUNT
				else if (messageType.equals("010")) {
					
					idModule = null;// = readId(buffer);
					//Sim sim;
					Imsi imsi;
					
					switch (messageId) {
					// ID ASSIGNMENT COMPLETE
					case "0000":
						//sim = readSim(buffer);
						imsi = readImsi(buffer);
						idModule = readId(buffer);
						
						DbUtil.updateMsisdn(idModule, imsi);
						DbUtil.updateImsi(imsi.imsi, ImsiStatus.CLIENT_CONFIRM_OK.getValue());	// update id assignment complete
						logger.info("id assignment complete: " + idModule.toString() + imsi.toString());
						break;
						
					// ID REPORT
					case "0001":
						//sim = readSim(buffer);
						imsi = readImsi(buffer);
						idModule = readId(buffer);
						
						DbUtil.updateMsisdn(idModule, imsi);
						logger.info("id report: " + idModule.toString() + imsi.toString() + "-" + StringUtil.binaryStringToHex(imsi.imsi));
						break;
					// ACCOUNT REPORT
					case "0010":
						idModule = readId(buffer);
						Account account = readAccount(buffer);
						
						DbUtil.updateMoney(idModule, account);
						logger.info("account report: " + idModule.toString() + " - " + account.toString());
						break;
					// RECHARGE ACCOUNT COMPLETE
					case "0011":
						idModule = readId(buffer);
						logger.info("recharge account complete: " + idModule.toString());
						break;
					// PASS RESET COMPLETE
					case "0100":
						idModule = readId(buffer);
						logger.info("pass account complete: " + idModule.toString());
						break;
					// REQUEST MODULE ID
					case "0101":
						imsi = readImsi(buffer);
						DbUtil.insertImsi(imsi);
						
						message.imsi 	= imsi.imsi;
						message.content = imsi.ie.content;
						logger.info("request module id: " + imsi.toString());
						break;
					default:
						break;
					}
					
					if (idModule != null) {
						message.customerCode = idModule.customerCode;
					}
				}
				// EMERGENCY STOP
				else if (messageType.equals("011")) {
					
					idModule = readId(buffer);
					if (idModule != null) {
						message.customerCode = idModule.customerCode;
						message.content 	= idModule.ie.content;
					}
					
					switch (messageId) {
					// HARD EMERGENCY STOP NOTIFICATION
					case "0000":
						logger.info("hard emergency stop: " + idModule.toString());
						DbUtil.updateModuleStatus(idModule, 0);
						break;
						
					// HARD EMERGENCY RESET NOTIFY
					case "0001":
						logger.info("hard emergency reset: " + idModule.toString());
						DbUtil.updateModuleStatus(idModule, 1);
						break;
					// SOFT EMERGENCY STOP ACKNOWLEDGE
					case "0010":
						logger.info("soft emergency stop: " + idModule.toString());
						DbUtil.updateModuleStatus(idModule, 0);
						break;
					// SOFT EMERGENCY RESET NOTIFY  
					case "0011":
						logger.info("soft emergency reset: " + idModule.toString());
						DbUtil.updateModuleStatus(idModule, 1);
						break;
					default:
						break;
					}
					
				}
			}
		} catch (Exception e) {
			
			String msg = new String(rawMessage.array());
			DbUtil.insertRawData("", msg);
			
			logger.error("Error when decode message {}", msg, e);
			message = null;
		}
		
		if (message != null && message.customerCode != null && !message.customerCode.equals("")) {
			message.module_id = DbUtil.getModuleId(message.customerCode);
		}
		
		return message;
	}
	
	/**
	 * get IE header
	 * 
	 * @param buffer
	 * @return
	 */
	private InformationElement getIEHeader(ChannelBuffer buffer) {
		
		InformationElement ie = new InformationElement();
		
		String temp;
		
		// skip save byte
		ie.content = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 1));
		buffer.skipBytes(1);
		
		ie.type = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 3));
		buffer.skipBytes(3);
		ie.content += ie.type;
		
		ie.name = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 4));
		buffer.skipBytes(4);
		ie.content += ie.name;
		
		ie.unu = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		ie.content += ie.unu;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 6));
		ie.length = Integer.parseInt(temp, 2);
		buffer.skipBytes(6);
		ie.content += temp;
		
		return ie;
	}
	
	/**
	 * read ID module
	 * 
	 * @param buffer
	 * @return
	 */
	private IDModule readId(ChannelBuffer buffer) {
		
		IDModule idModule = new IDModule();
		
		String temp;
		idModule.ie = getIEHeader(buffer);
		
		// save
		idModule.ie.content += ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 4));
		buffer.skipBytes(4);
		
		// country code
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 12));
		buffer.skipBytes(12);
		idModule.countryCode = temp;
		idModule.ie.content += temp;
		
		// province
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 12));
		buffer.skipBytes(12);
		idModule.provinceCode = temp;
		idModule.ie.content += temp;
		
		// district
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 12));
		buffer.skipBytes(12);
		idModule.districtCode = temp;
		idModule.ie.content += temp;
		
		// customer
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 24));
		buffer.skipBytes(24);
		idModule.customerCode = StringUtil.binaryStringToHex(temp);
		idModule.ie.content += temp;
		
		return idModule;
	}
	
	/**
	 * SYSTEM MODE CONFIG 
	 * 
	 * @param buffer
	 * @return
	 */
	private SystemMode readSystemMode(ChannelBuffer buffer) {
		
		SystemMode systemMode = new SystemMode();
		
		String temp;
		systemMode.ie = getIEHeader(buffer);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		systemMode.bienma = temp;
		buffer.skipBytes(8);
		
		return systemMode;
	}
	
	/**
	 * OUTPUT MODE CONFIG 
	 * 
	 * @param buffer
	 * @return
	 */
	private OutputMode readOutputMode(ChannelBuffer buffer) {
		
		OutputMode item = new OutputMode();
		
		String temp;
		item.ie = getIEHeader(buffer);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 24));
		buffer.skipBytes(24);
		item.convection_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 24));
		buffer.skipBytes(24);
		item.cold_water_supply_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 24));
		buffer.skipBytes(24);
		item.return_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 24));
		buffer.skipBytes(24);
		item.incresed_pressure_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 16));
		buffer.skipBytes(16);
		item.heat_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 32));
		buffer.skipBytes(32);
		item.heater_resister = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 16));
		buffer.skipBytes(16);
		item.three_way_valve = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 16));
		buffer.skipBytes(16);
		item.backflow_valve = temp;
		
		return item;
	}
	
	/**
	 * PARAMETER CONFIG 
	 * 
	 * @param buffer
	 * @return
	 */
	private Parameter readParameter(ChannelBuffer buffer) {
		
		Parameter item = new Parameter();
		
		String temp;
		item.ie = getIEHeader(buffer);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.convection_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 16));
		buffer.skipBytes(16);
		item.cold_water_supply_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 40));
		buffer.skipBytes(40);
		item.return_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.incresed_pressure_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.heat_pump = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 16));
		buffer.skipBytes(16);
		item.heat_resistor = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 40));
		buffer.skipBytes(40);
		item.three_way_valve = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.backflow_valve = temp;
		
		return item;
	}
	
	/**
	 * TIMER/COUNTER CONFIG 
	 * 
	 * @param buffer
	 * @return
	 */
	public TimerCounter readTimerCounter(ChannelBuffer buffer) {
		
		TimerCounter item = new TimerCounter();
		
		String temp;
		item.ie = getIEHeader(buffer);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.counter = temp;
		item.counter_value = StringUtil.binaryStringToInt(temp);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.timer_1 = temp;
		item.timer_1_value = StringUtil.binaryStringToInt(temp);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.timer_2 = temp;
		item.timer_2_value = StringUtil.binaryStringToInt(temp);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.timer_3 = temp;
		item.timer_3_value = StringUtil.binaryStringToInt(temp);
		
		return item;
	}
	
	/**
	 * SYSTEM STATUS REPORT
	 * 
	 * @param buffer
	 * @return
	 */
	public Sensor readSensor(ChannelBuffer buffer) {
		
		Sensor item = new Sensor();
		
		String temp;
		item.ie = getIEHeader(buffer);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_dan_thu = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_bon_solar = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_muc_nuoc_bon_solar = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_nhiet_do_bon_gia_nhiet = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_ap_suat_bon_gia_nhiet = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_buc_xa_dan_thu = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_nhiet_dinh_bon_solar = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_tran = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_ap_suat_duong_ong = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_nhiet_do_duong_ong_1 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		buffer.skipBytes(8);
		item.cam_bien_nhiet_do_duong_ong_2 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 40));
		buffer.skipBytes(40);
		item.ie.reserved = temp;
		
		return item;
	}
	
	/**
	 * ALARM REPORT
	 * 
	 * @param buffer
	 * @return
	 */
	public Alarm readAlarm(ChannelBuffer buffer) {
		
		Alarm item = new Alarm();
		
		String temp;
		item.ie = getIEHeader(buffer);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.qua_nhiet = temp;
		item.ie.content += temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.qua_ap_suat = temp;
		item.ie.content += temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.mat_dien = temp;
		item.ie.content += temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.tran_be = temp;
		item.ie.content += temp;
		
		return item;
	}
	
	/**
	 * SIM
	 * 
	 * @param buffer
	 * @return
	 */
	public Sim readSim(ChannelBuffer buffer) {
		
		Sim item = new Sim();
		
		String temp;
		item.ie = getIEHeader(buffer);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), item.ie.length * 8));
		buffer.skipBytes(item.ie.length * 8);
		item.phone = StringUtil.binaryStringToHex(temp);
		
		return item;
	}
	
	/**
	 * ACCOUNT REPORT
	 * 
	 * @param buffer
	 * @return
	 */
	public Account readAccount(ChannelBuffer buffer) {
		
		Account item = new Account();
		
		String temp;
		//item.ie = getIEHeader(buffer);dd
		
		// read ie
		InformationElement ie = new InformationElement();
		
		// skip save byte
		ie.content = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 1));
		buffer.skipBytes(1);
		
		ie.type = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 3));
		buffer.skipBytes(3);
		ie.content += ie.type;
		
		ie.name = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 4));
		buffer.skipBytes(4);
		ie.content += ie.name;
		
		//ie.unu = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		//buffer.skipBytes(2);
		//ie.content += ie.unu;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 8));
		ie.length = Integer.parseInt(temp, 2);
		buffer.skipBytes(8);
		ie.content += temp;
		
		// read account
		item.ie = ie;
		
		//return ie;
		
		//temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), item.ie.length));
		//buffer.skipBytes(item.ie.length);
		//item.money = temp;
		
		ChannelBuffer tempBuffer = readFrame(buffer, accountReportEnd);
		item.money 	= ChannelBufferHelper.toString(tempBuffer);
		
		return item;
	}
	
	/**
	 * MODULE STATUS
	 * 
	 * @param buffer
	 * @return
	 */
	public ModuleStatus readModuleStatus(ChannelBuffer buffer) {
		
		ModuleStatus item = new ModuleStatus();
		
		String temp;
		item.ie = getIEHeader(buffer);
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_doi_luu_1 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_doi_luu_2 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_cap_nuoc_lanh_1 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_cap_nuoc_lanh_2 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_hoi_duong_ong_1 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_hoi_duong_ong_2 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_tang_ap_1 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_tang_ap_2 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.bom_nhiet_bon_gia_nhiet = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.dien_tro_nhiet_bon_gia_nhiet_1 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.dien_tro_nhiet_bon_gia_nhiet_2 = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.van_dien_tu_ba_nga = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 2));
		buffer.skipBytes(2);
		item.van_dien_tu_mot_chieu = temp;
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 6));
		buffer.skipBytes(6);
		item.ie.reserved = temp;
		
		return item;
	}
	
	/**
	 * IMSI
	 * 
	 * @param buffer
	 * @return
	 */
	private Imsi readImsi(ChannelBuffer buffer) {
		
		Imsi item = new Imsi();
		
		String temp;
		item.ie = getIEHeader(buffer);
		
		item.imsi = "";
		
		for (int i=1; i<=15; i++) {
			temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 4));
			buffer.skipBytes(4);
			item.imsi += StringUtil.binaryStringToInt(temp);
			item.ie.content += temp;
		}
		
		temp = ChannelBufferHelper.toString(extractFrame(buffer, buffer.readerIndex(), 20));
		buffer.skipBytes(20);
		item.ie.reserved = temp;
		item.ie.content += temp;
		
		return item;
	}
	
	/**
	 * Read frame by delimiter, move pointer to the next bytes.
	 * 
	 * @param buffer
	 * @param delimiter
	 * @return
	 */
	private ChannelBuffer readFrame(ChannelBuffer buffer, ChannelBuffer delimiter) {
		int frameLength = ChannelBufferHelper.indexOf(buffer, delimiter);
		ChannelBuffer frame = extractFrame(buffer, buffer.readerIndex(), frameLength);
		buffer.skipBytes(frameLength + delimiter.capacity());

		return frame;
	}
}