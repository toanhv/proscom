// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.util;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import proscom.common.AppConfig;
import proscom.domain.Account;
import proscom.domain.Alarm;
import proscom.domain.DataClient;
import proscom.domain.IDModule;
import proscom.domain.Imsi;
import proscom.domain.ModuleStatus;
import proscom.domain.OutputMode;
import proscom.domain.Parameter;
import proscom.domain.Sensor;
import proscom.domain.Sim;
import proscom.domain.TimerCounter;

import com.jolbox.bonecp.BoneCP;
import com.jolbox.bonecp.BoneCPConfig;

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
public class DbUtil {
	
	private static final Logger logger = LoggerFactory.getLogger(DbUtil.class);
	
	private static BoneCP connectionPool = null;
	private static int queryTimeout = 30; // seconds
	
	static {
		try {
			BoneCPConfig boneCPConfig = new BoneCPConfig(AppConfig.getBoneCPConfigProperties());
			connectionPool = new BoneCP(boneCPConfig);
			
			logger.info("Init connectionPool success");
			

		} catch (Exception e) {
			logger.error("Can not establish connection to the database.", e);
		}
	}
	
	public static void init() {}
	
	/**
	 * insert raw_data
	 * @param customerCode
	 * @param message
	 */
	public static void insertRawData(String customerCode, String message) {
		
		String insertQuery = "INSERT INTO raw_data(customer_code, message) VALUES(?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, customerCode);
			preparedStatement.setString(2, message);

			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertRawData() error, message: {}", message, e);
		}
	}
	
	public static void setDoubleOrNull(PreparedStatement pstmt, int column, Double value) throws SQLException {
	    if (value != null) {
	        pstmt.setDouble(column, value);
	    } else {
	        pstmt.setNull(column, java.sql.Types.DOUBLE);
	    }
	}
	
	/**
	 * get module_id
	 * @param customerCode
	 * @return
	 */
	public static int getModuleId(String customerCode) {
		
		String mSQL =   "SELECT id FROM modules WHERE customer_code = '" + customerCode + "'";
		
		int moduleId = 0;
		try (Connection conn = connectionPool.getConnection(); Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(mSQL);) {
			
			rs.next();
			
			moduleId = rs.getInt(1);
		} catch (NullPointerException | SQLException e) {
			logger.error("getModuleId({}) error", customerCode, e);
		}
		
		return moduleId;
	}
	
	public static boolean isOutputModeExists(int moduleId) {
		
		int rowCount = -1;
		
		try (Connection conn = connectionPool.getConnection();
				Statement stmt = conn.createStatement();
				ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM output_mode WHERE module_id=" + moduleId);) {
			rs.next();
			rowCount = rs.getInt(1);
		} catch (NullPointerException | SQLException e) {
			logger.error("isOutputModeExists({}) error", moduleId, e);
		}

		if (rowCount > 0)
			return true;

		return false;
	}
	
	/**
	 * save output mode
	 * 
	 * @param idModule
	 * @param outputMode
	 */
	public static void saveOutputMode(IDModule idModule, OutputMode outputMode) {
		
		int moduleId = getModuleId(idModule.customerCode);
		if (isOutputModeExists(moduleId)) {
			updateOutputMode(idModule, outputMode, moduleId);
		} else {
			insertOutputMode(idModule, outputMode, moduleId);
		}
	}
	
	/**
	 * insert ouput_mode
	 * 
	 * @param idModule
	 * @param outputMode
	 */
	public static void insertOutputMode(IDModule idModule, OutputMode outputMode, int moduleId) {
		
		//int moduleId = getModuleId(idModule.customerCode);
		
		String insertQuery = "INSERT INTO output_mode(module_id,convection_pump,cold_water_supply_pump,return_pump,incresed_pressure_pump,heat_pump,heater_resister,three_way_valve,backflow_valve,created_at) VALUES(?,?,?,?,?,?,?,?,?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, moduleId);
			preparedStatement.setString(2, outputMode.convection_pump);
			preparedStatement.setString(3, outputMode.cold_water_supply_pump);
			preparedStatement.setString(4, outputMode.return_pump);
			preparedStatement.setString(5, outputMode.incresed_pressure_pump);
			preparedStatement.setString(6, outputMode.heat_pump);
			preparedStatement.setString(7, outputMode.heater_resister);
			preparedStatement.setString(8, outputMode.three_way_valve);
			preparedStatement.setString(9, outputMode.backflow_valve);
			preparedStatement.setTimestamp(10, DateUtil.toSqlTimestamp(new Date()));
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertOutputMode() error, message: {}", outputMode, e);
		}
	}
	
	public static void updateOutputMode(IDModule idModule, OutputMode outputMode, int moduleId) {
		
		//int moduleId = getModuleId(idModule.customerCode);
		
		String insertQuery = "update output_mode set convection_pump=?,cold_water_supply_pump=?,return_pump=?,incresed_pressure_pump=?,heat_pump=?,heater_resister=?,three_way_valve=?,backflow_valve=?,updated_at=? where module_id=?";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, outputMode.convection_pump);
			preparedStatement.setString(2, outputMode.cold_water_supply_pump);
			preparedStatement.setString(3, outputMode.return_pump);
			preparedStatement.setString(4, outputMode.incresed_pressure_pump);
			preparedStatement.setString(5, outputMode.heat_pump);
			preparedStatement.setString(6, outputMode.heater_resister);
			preparedStatement.setString(7, outputMode.three_way_valve);
			preparedStatement.setString(8, outputMode.backflow_valve);
			preparedStatement.setTimestamp(9, DateUtil.toSqlTimestamp(new Date()));
			preparedStatement.setInt(10, moduleId);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateOutputMode() error, message: {}", outputMode, e);
		}
	}
	
	public static boolean isParameterExists(int moduleId) {
		
		int rowCount = -1;
		
		try (Connection conn = connectionPool.getConnection();
				Statement stmt = conn.createStatement();
				ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM param_config WHERE module_id=" + moduleId);) {
			rs.next();
			rowCount = rs.getInt(1);
		} catch (NullPointerException | SQLException e) {
			logger.error("isParameterExists({}) error", moduleId, e);
		}

		if (rowCount > 0)
			return true;

		return false;
	}
	
	/**
	 * save param config
	 * 
	 * @param idModule
	 * @param paramter
	 */
	public static void saveParameter(IDModule idModule, Parameter paramter) {
		
		int moduleId = getModuleId(idModule.customerCode);
		if (isParameterExists(moduleId)) {
			updateParameter(idModule, paramter, moduleId);
		} else {
			insertParameter(idModule, paramter, moduleId);
		}
	}
	
	/**
	 * insert parameter
	 * 
	 * @param idModule
	 * @param paramter
	 */
	public static void insertParameter(IDModule idModule, Parameter paramter, int moduleId) {
		
		String insertQuery = "INSERT INTO param_config(module_id,convection_pump,cold_water_supply_pump,return_pump,incresed_pressure_pump,heat_pump,heat_resistor,three_way_valve,backflow_valve,created_at) VALUES(?,?,?,?,?,?,?,?,?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, moduleId);
			preparedStatement.setString(2, paramter.convection_pump);
			preparedStatement.setString(3, paramter.cold_water_supply_pump);
			preparedStatement.setString(4, paramter.return_pump);
			preparedStatement.setString(5, paramter.incresed_pressure_pump);
			preparedStatement.setString(6, paramter.heat_pump);
			preparedStatement.setString(7, paramter.heat_resistor);
			preparedStatement.setString(8, paramter.three_way_valve);
			preparedStatement.setString(9, paramter.backflow_valve);
			preparedStatement.setTimestamp(10, DateUtil.toSqlTimestamp(new Date()));
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertParameter() error, message: {}", paramter, e);
		}
	}
	
	public static void updateParameter(IDModule idModule, Parameter paramter, int moduleId) {
		
		String insertQuery = "update param_config set convection_pump=?,cold_water_supply_pump=?,return_pump=?,incresed_pressure_pump=?,heat_pump=?,heat_resistor=?,three_way_valve=?,backflow_valve=?,updated_at=? where module_id=?";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, paramter.convection_pump);
			preparedStatement.setString(2, paramter.cold_water_supply_pump);
			preparedStatement.setString(3, paramter.return_pump);
			preparedStatement.setString(4, paramter.incresed_pressure_pump);
			preparedStatement.setString(5, paramter.heat_pump);
			preparedStatement.setString(6, paramter.heat_resistor);
			preparedStatement.setString(7, paramter.three_way_valve);
			preparedStatement.setString(8, paramter.backflow_valve);
			preparedStatement.setTimestamp(9, DateUtil.toSqlTimestamp(new Date()));
			preparedStatement.setInt(10, moduleId);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertParameter() error, message: {}", paramter, e);
		}
	}
	
	/**
	 * check timer_counter exists
	 * 
	 * @param moduleId
	 * @return
	 */
	public static boolean isTimerCounterExists(int moduleId) {
		
		int rowCount = -1;
		
		try (Connection conn = connectionPool.getConnection();
				Statement stmt = conn.createStatement();
				ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM timer_counter WHERE module_id=" + moduleId);) {
			rs.next();
			rowCount = rs.getInt(1);
		} catch (NullPointerException | SQLException e) {
			logger.error("isTimerCounterExist({}) error", moduleId, e);
		}

		if (rowCount > 0)
			return true;

		return false;
	}
	
	/**
	 * save timer_counter
	 * 
	 * @param idModule
	 * @param timerCounter
	 */
	public static void saveTimerCounter(IDModule idModule, TimerCounter timerCounter) {
		
		int moduleId = getModuleId(idModule.customerCode);
		if (isTimerCounterExists(moduleId)) {
			updateTimerCounter(idModule, timerCounter, moduleId);
		} else {
			insertTimerCounter(idModule, timerCounter, moduleId);
		}
	}
	
	/**
	 * update timer_counter
	 * 
	 * @param idModule
	 * @param timerCounter
	 * @param moduleId
	 */
	public static void updateTimerCounter(IDModule idModule, TimerCounter timerCounter, int moduleId) {
		
		
		String insertQuery = "UPDATE timer_counter SET counter=?,timer_1=?,timer_2=?,timer_3=? WHERE module_id=?";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, timerCounter.counter);
			preparedStatement.setString(2, timerCounter.timer_1);
			preparedStatement.setString(3, timerCounter.timer_2);
			preparedStatement.setString(4, timerCounter.timer_3);
			preparedStatement.setInt(5, moduleId);
			
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertTimerCounter() error, message: {}", timerCounter, e);
		}
	}
	
	/**
	 * insert timer_counter
	 * 
	 * @param idModule
	 * @param timerCounter
	 * @param moduleId
	 */
	public static void insertTimerCounter(IDModule idModule, TimerCounter timerCounter, int moduleId) {
		
		if (moduleId == 0) {
			moduleId = getModuleId(idModule.customerCode);
		}
		
		String insertQuery = "INSERT INTO timer_counter(module_id,counter,timer_1,timer_2,timer_3) VALUES(?,?,?,?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, moduleId);
			preparedStatement.setInt(2, timerCounter.counter_value);
			preparedStatement.setInt(3, timerCounter.timer_1_value);
			preparedStatement.setInt(4, timerCounter.timer_2_value);
			preparedStatement.setInt(5, timerCounter.timer_3_value);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertTimerCounter() error, timerCounter: {}", timerCounter, e);
		}
	}
	
	/**
	 * save sensor
	 * 
	 * @param idModule
	 * @param sensor
	 */
	public static void saveSensor(IDModule idModule, Sensor sensor) {
		
		int moduleId = getModuleId(idModule.customerCode);
		if (isSensorExists(moduleId)) {
			updateSensor(idModule, sensor, moduleId);
		} else {
			insertSensor(idModule, sensor, moduleId);
		}
	}
	
	/**
	 * check sensor exists
	 * 
	 * @param moduleId
	 * @return
	 */
	public static boolean isSensorExists(int moduleId) {
		
		int rowCount = -1;
		
		try (Connection conn = connectionPool.getConnection();
				Statement stmt = conn.createStatement();
				ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM sensor WHERE module_id=" + moduleId);) {
			rs.next();
			rowCount = rs.getInt(1);
		} catch (NullPointerException | SQLException e) {
			logger.error("isSensorExist({}) error", moduleId, e);
		}

		if (rowCount > 0)
			return true;

		return false;
	}
	
	/**
	 * update sensor
	 * 
	 * @param idModule
	 * @param sensor
	 * @param moduleId
	 */
	public static void updateSensor(IDModule idModule, Sensor sensor, int moduleId) {
		
		String insertQuery = "UPDATE sensor SET cam_bien_dan_thu=?,cam_bien_bon_solar=?,cam_bien_muc_nuoc_bon_solar=?,cam_bien_nhiet_do_bon_gia_nhiet=?,cam_bien_ap_suat_bon_gia_nhiet=?,cam_bien_ap_suat_duong_ong=?,cam_bien_nhiet_dinh_bon_solar=?,cam_bien_tran=?,du_phong=? WHERE module_id=?";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, sensor.cam_bien_dan_thu);
			preparedStatement.setString(2, sensor.cam_bien_bon_solar);
			preparedStatement.setString(3, sensor.cam_bien_muc_nuoc_bon_solar);
			preparedStatement.setString(4, sensor.cam_bien_nhiet_do_bon_gia_nhiet);
			preparedStatement.setString(5, sensor.cam_bien_ap_suat_bon_gia_nhiet);
			preparedStatement.setString(6, sensor.cam_bien_ap_suat_duong_ong);
			preparedStatement.setString(7, sensor.cam_bien_nhiet_dinh_bon_solar);
			preparedStatement.setString(8, sensor.cam_bien_tran);
			preparedStatement.setString(9, sensor.ie.reserved);
			preparedStatement.setInt(10, moduleId);
			
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateSensor() error, sensor: {}", sensor, e);
		}
	}
	
	/**
	 * insert sensor
	 * 
	 * @param idModule
	 * @param sensor
	 * @param moduleId
	 */
	public static void insertSensor(IDModule idModule, Sensor sensor, int moduleId) {
		
		if (moduleId == 0) {
			moduleId = getModuleId(idModule.customerCode);
		}
		
		String insertQuery = "INSERT INTO sensor(module_id,cam_bien_dan_thu,cam_bien_bon_solar,cam_bien_muc_nuoc_bon_solar,cam_bien_nhiet_do_bon_gia_nhiet,cam_bien_ap_suat_bon_gia_nhiet,cam_bien_buc_xa_dan_thu,cam_bien_nhiet_dinh_bon_solar,cam_bien_tran,cam_bien_ap_suat_duong_ong,cam_bien_nhiet_do_duong_ong_1,cam_bien_nhiet_do_duong_ong_2,du_phong) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, moduleId);
			preparedStatement.setString(2, sensor.cam_bien_dan_thu);
			preparedStatement.setString(3, sensor.cam_bien_bon_solar);
			preparedStatement.setString(4, sensor.cam_bien_muc_nuoc_bon_solar);
			preparedStatement.setString(5, sensor.cam_bien_nhiet_do_bon_gia_nhiet);
			preparedStatement.setString(6, sensor.cam_bien_ap_suat_bon_gia_nhiet);
			preparedStatement.setString(7, sensor.cam_bien_buc_xa_dan_thu);
			preparedStatement.setString(8, sensor.cam_bien_nhiet_dinh_bon_solar);
			preparedStatement.setString(9, sensor.cam_bien_tran);
			preparedStatement.setString(10, sensor.cam_bien_ap_suat_duong_ong);
			preparedStatement.setString(11, sensor.cam_bien_nhiet_do_duong_ong_1);
			preparedStatement.setString(12, sensor.cam_bien_nhiet_do_duong_ong_2);
			preparedStatement.setString(13, sensor.ie.reserved);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertSensor() error, sensor: {}", sensor, e);
		}
	}
	
	/**
	 * get messages for client
	 * 
	 * @param customerCode
	 * @return
	 */
	public static List<DataClient> getClientMessage(String customerCode) {
		
		String mSQL;
		
		if (customerCode != null) {
			mSQL = " SELECT d.id, d.module_id, d.ie_name, d.data FROM data_client d "
						+ " JOIN modules m "
						+ " ON d.module_id = m.id "
						+ " WHERE customer_code = '" + customerCode + "'"
						+ " AND STATUS = 0 "
						+ " ORDER BY d.created_at";
		} else {
			mSQL = " SELECT d.id, d.module_id, d.ie_name, d.data FROM data_client d "
					+ " WHERE "
					+ " STATUS = 0 "
					+ " ORDER BY d.created_at";
		}
		
		List<DataClient> dataList = new ArrayList<DataClient>();
		DataClient dataClient;
		try (Connection conn = connectionPool.getConnection(); Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(mSQL);) {
			
			while(rs.next()) {
				
				dataClient = new DataClient();
				dataClient.data_client_id = rs.getInt("id");
				dataClient.module_id = rs.getInt("module_id");
				dataClient.ie_name = rs.getString("ie_name");
				dataClient.data = rs.getString("data");
				
				dataList.add(dataClient);
			}
		} catch (NullPointerException | SQLException e) {
			logger.error("getClientMessage({}) error", customerCode, e);
		}
		
		return dataList;
	}
	
	/**
	 * update client message status
	 * 
	 * @param idList
	 * @param status
	 */
	public static void updateDataClientStatus(int id, int status) {
		
		String updateQuery = "UPDATE data_client SET updated_at=current_timestamp, status=" + status + " WHERE id = " + id;
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(updateQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateDataClientStatus({}) error", id, e);
		}
	}
	
	/**
	 * update list
	 * @param idList
	 * @param status
	 */
	public static void updateClientMessageStatus(String idList, int status) {
		
		String updateQuery = "UPDATE data_client SET updated_at=current_timestamp, status=" + status + " WHERE id in (" + idList + ")";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(updateQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateClientMessageStatus({}) error", idList, e);
		}
	}
	
	/**
	 * insert alarm
	 * 
	 * @param idModule
	 * @param alarm
	 */
	public static void insertAlarm(IDModule idModule, Alarm alarm) {
		
		int moduleId = getModuleId(idModule.customerCode);
		String insertQuery = "INSERT INTO alarm(module_id,qua_nhiet,qua_ap_suat,mat_dien,tran_be,type,created_at) VALUES(?,?,?,?,?,?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, moduleId);
			preparedStatement.setString(2, alarm.qua_nhiet);
			preparedStatement.setString(3, alarm.qua_ap_suat);
			preparedStatement.setString(4, alarm.mat_dien);
			preparedStatement.setString(5, alarm.tran_be);
			preparedStatement.setInt(6, alarm.alarm_type);
			preparedStatement.setTimestamp(7, DateUtil.toSqlTimestamp(new Date()));
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertAlarm() error, alarm: {}", alarm, e);
		}
	}
	
	/**
	 * update module_alarm
	 * 
	 * @param idModule
	 * @param alarm
	 */
	public static void updateModuleAlarm(IDModule idModule, Alarm alarm) {
		
		String mSQL = "UPDATE modules SET alarm=? WHERE id=?";
		int moduleId = getModuleId(idModule.customerCode);
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(mSQL);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, alarm.qua_nhiet + alarm.qua_ap_suat + alarm.mat_dien + alarm.tran_be);
			preparedStatement.setInt(2, moduleId);
			
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateModuleAlarm() error, alarm: {}", alarm, e);
		}
	}
	
	/**
	 * update sim - khong dung
	 * 
	 * @param idModule
	 * @param sim
	 */
	public static void updateSim(IDModule idModule, Sim sim) {
		
		String insertQuery = "UPDATE modules SET msisdn=? WHERE id=?";
		int moduleId = getModuleId(idModule.customerCode);
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, sim.phone);
			preparedStatement.setInt(2, moduleId);
			
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateSim() error, sim: {}", sim, e);
		}
	}
	
	public static void updateMsisdn(IDModule idModule, Imsi imsi) {
		
		String insertQuery = "UPDATE modules SET msisdn=? WHERE id=?";
		int moduleId = getModuleId(idModule.customerCode);
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, imsi.imsi);
			preparedStatement.setInt(2, moduleId);
			
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateMsisdn() error, imsi: {}", imsi, e);
		}
	}
	
	/**
	 * update money
	 * 
	 * @param idModule
	 * @param account
	 */
	public static void updateMoney(IDModule idModule, Account account) {
		
		String insertQuery = "UPDATE modules SET money=? WHERE id=?";
		int moduleId = getModuleId(idModule.customerCode);
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, account.money);
			preparedStatement.setInt(2, moduleId);
			
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateMoney() error, account: {}", account, e);
		}
	}
	
	/**
	 * insert module status
	 * 
	 * @param idModule
	 * @param moduleStatus
	 */
	public static void insertModuleStatus(IDModule idModule, ModuleStatus moduleStatus) {
		
		int moduleId = getModuleId(idModule.customerCode);
		String insertQuery = "INSERT INTO module_status(module_id,bom_doi_luu_1,bom_doi_luu_2,bom_cap_nuoc_lanh_1,bom_cap_nuoc_lanh_2,bom_hoi_duong_ong_1,bom_hoi_duong_ong_2,bom_tang_ap_1,bom_tang_ap_2,bom_nhiet_bon_gia_nhiet,dien_tro_nhiet_bon_gia_nhiet_1,dien_tro_nhiet_bon_gia_nhiet_2,van_dien_tu_ba_nga,van_dien_tu_mot_chieu,du_phong) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, moduleId);
			preparedStatement.setString(2, moduleStatus.bom_doi_luu_1);
			preparedStatement.setString(3, moduleStatus.bom_doi_luu_2);
			preparedStatement.setString(4, moduleStatus.bom_cap_nuoc_lanh_1);
			preparedStatement.setString(5, moduleStatus.bom_cap_nuoc_lanh_2);
			preparedStatement.setString(6, moduleStatus.bom_hoi_duong_ong_1);
			preparedStatement.setString(7, moduleStatus.bom_hoi_duong_ong_2);
			preparedStatement.setString(8, moduleStatus.bom_tang_ap_1);
			preparedStatement.setString(9, moduleStatus.bom_tang_ap_2);
			preparedStatement.setString(10, moduleStatus.bom_nhiet_bon_gia_nhiet);
			preparedStatement.setString(11, moduleStatus.dien_tro_nhiet_bon_gia_nhiet_1);
			preparedStatement.setString(12, moduleStatus.dien_tro_nhiet_bon_gia_nhiet_2);
			preparedStatement.setString(13, moduleStatus.van_dien_tu_ba_nga);
			preparedStatement.setString(14, moduleStatus.van_dien_tu_mot_chieu);
			preparedStatement.setString(15, moduleStatus.ie.reserved);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertModuleStatus() error, moduleStatus: {}", moduleStatus, e);
		}
	}
	
	/**
	 * check imsi exists
	 * 
	 * @param imsi
	 * @return
	 */
	public static boolean isImsiExists(String imsi) {
		
		int rowCount = -1;
		
		try (Connection conn = connectionPool.getConnection();
				Statement stmt = conn.createStatement();
				ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM imsi WHERE imsi='" + imsi + "'");) {
			rs.next();
			rowCount = rs.getInt(1);
		} catch (NullPointerException | SQLException e) {
			logger.error("isImsiExist({}) error", imsi, e);
		}

		if (rowCount > 0)
			return true;

		return false;
	}
	
	/**
	 * insert imsi
	 * 
	 * @param imsi
	 */
	public static void insertImsi(Imsi imsi) {
		
		if (isImsiExists(imsi.imsi)) {
			logger.info("imsi ({}) is exists", imsi.imsi);
			return;
		}
		
		String insertQuery = "INSERT INTO imsi(imsi,created_at) VALUES(?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setString(1, imsi.imsi);
			preparedStatement.setTimestamp(2, DateUtil.toSqlTimestamp(new Date()));
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertImsi() error, imsi: {}", imsi, e);
		}
	}
	
	/**
	 * get imsi
	 * 
	 * @param imsi
	 * @param status
	 * @return
	 */
	public static Imsi getImsi(String imsi, int status) {
		
		Imsi result = null;
		String mSQL =   "SELECT module_id, module_id_assignment FROM imsi WHERE imsi = '" + imsi + "' and status = " + status;
		
		try (Connection conn = connectionPool.getConnection(); Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(mSQL);) {
			
			if (rs.next()) {
				result = new Imsi();
				result.module_id = rs.getInt(1);
				result.module_id_assignment = rs.getString(2);
			}
		} catch (NullPointerException | SQLException e) {
			logger.error("getImsi({}) error", imsi, e);
		}
		
		return result;
	}
	
	public static List<Imsi> getImsi(int status) {
		
		List<Imsi> imsiList = new ArrayList<Imsi>();
		Imsi result = null;
		String mSQL =   "SELECT imsi, module_id, module_id_assignment FROM imsi WHERE status = " + status;
		
		try (Connection conn = connectionPool.getConnection(); Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(mSQL);) {
			
			while (rs.next()) {
				result = new Imsi();
				result.imsi = rs.getString(1);
				result.module_id = rs.getInt(2);
				result.module_id_assignment = rs.getString(3);
				
				imsiList.add(result);
			}
		} catch (NullPointerException | SQLException e) {
			logger.error("getImsi({}) error", status, e);
		}
		
		return imsiList;
	}
	
	public static void updateImsi(String imsi, int status) {
		
		String mSQL = "UPDATE imsi SET status=? WHERE imsi=?";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(mSQL);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, status);
			preparedStatement.setString(2, imsi);
			
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateImsi() error, imsi: {}", imsi, e);
		}
	}

	public static int getLastDataClientIdByIeName(int moduleId, String ieName) {
		
		int dataClientId = 0;
		
		String mSQL =   "SELECT id FROM data_client WHERE module_id = " + moduleId + " and ie_name = '" + ieName + "' ORDER BY created_at DESC LIMIT 1";
		
		try (Connection conn = connectionPool.getConnection(); Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(mSQL);) {
			
			if (rs.next()) {
				dataClientId = rs.getInt(1);
			}
		} catch (NullPointerException | SQLException e) {
			logger.error("getLastDataClientIdByIeName({}) error", ieName, e);
		}
		
		return dataClientId;
	}
	
	/**
	 * insert into operation_log
	 * 
	 * @param customerCode
	 * @param message
	 */
	public static void insertOperationLog(String customerCode, String message) {
		
		int moduleId = getModuleId(customerCode);
		String insertQuery = "INSERT INTO operation_log(module_id,message) VALUES(?,?)";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(insertQuery);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, moduleId);
			preparedStatement.setString(2, message);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("insertOperationLog() error, customerCode: {}, message: {}", customerCode, message, e);
		}
	}

	public static void updateModuleStatus(IDModule idModule, int status) {
		
		String mSQL = "UPDATE modules SET status=? WHERE customer_code=?";
		
		try (Connection connection = connectionPool.getConnection(); PreparedStatement preparedStatement = connection.prepareStatement(mSQL);) {
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.setInt(1, status);
			preparedStatement.setString(2, idModule.customerCode);
			
			preparedStatement.setQueryTimeout(queryTimeout);
			
			preparedStatement.executeUpdate();
		} catch (NullPointerException | SQLException e) {
			logger.error("updateModuleStatus() error, customerCode: {}", idModule.customerCode, e);
		}
	}
	
}
