// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.socket;

import java.util.Map.Entry;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ConcurrentMap;

import org.jboss.netty.buffer.ChannelBuffers;
import org.jboss.netty.channel.Channel;
import org.jboss.netty.channel.ChannelHandlerContext;
import org.jboss.netty.channel.ChannelStateEvent;
import org.jboss.netty.channel.ExceptionEvent;
import org.jboss.netty.channel.MessageEvent;
import org.jboss.netty.channel.SimpleChannelHandler;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import proscom.common.AppEnv;
import proscom.domain.Message;
import proscom.enums.DataClientStatus;
import proscom.task.TaskManager;
import proscom.util.DbUtil;

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
public class MessageHandler extends SimpleChannelHandler {

	private static final Logger logger = LoggerFactory
			.getLogger(MessageHandler.class);
	
	//public static final ChannelGroup channels = new DefaultChannelGroup("proscom");
	public static ConcurrentMap<Integer, Channel> channels = new ConcurrentHashMap<>();
	public static ConcurrentMap<String, Channel> channelAssignment = new ConcurrentHashMap<>();
	
	@Override
	public void channelConnected(ChannelHandlerContext ctx, ChannelStateEvent e) {
		
		Channel ch = e.getChannel();
		
		//channels.add(ctx.getChannel());
		
		logger.info("Connect from {}, channels: {}", ch.getLocalAddress(), channels.size());
	}

	@Override
	public void channelDisconnected(ChannelHandlerContext ctx, ChannelStateEvent e) {
		
		Channel ch = e.getChannel();
		
		removeChannel(ch);
		
		logger.info("Disconnect from {}, channels: {}", ch.getLocalAddress(), channels.size());
	}

	@Override
	public void messageReceived(ChannelHandlerContext ctx, MessageEvent e) {
		
		Message message = (Message) e.getMessage();
		
		if (message != null) {
			
			TaskManager.execute(message);
			
			Channel ch = e.getChannel();
			
			
			// add channels
			if (message.customerCode != null && !message.customerCode.equals("")) {
				
				channels.put(message.module_id, ch);	// new or replace
			}
			
			// assignment module id to client
			if (message.imsi != null && ! message.imsi.equals("")) {
				
				channelAssignment.put(message.imsi, ch);	// new or replace
				
				// confirm
				ch.write(ChannelBuffers
							.wrappedBuffer(AppEnv.DOWNLINK.concat(AppEnv.NEW_MODULE_CONFIRM).concat(message.content).getBytes()));
			}
			
			if (message.code != null && (message.code.equals(AppEnv.ALARM_ACKNOWLEDGE) 
					|| message.code.equals(AppEnv.ALARM_CLEARANCE) 
					|| message.code.equals(AppEnv.HARD_EMERGENCY_STOP)
					|| message.code.equals(AppEnv.HARD_EMERGENCY_RESET)
					|| message.code.equals(AppEnv.SOFT_EMERGENCY_STOP)
					|| message.code.equals(AppEnv.SOFT_EMERGENCY_RESET))) {
				
				// confirm
				ch.write(ChannelBuffers
							.wrappedBuffer(AppEnv.DOWNLINK.concat(message.code).concat(message.content).getBytes()));
			}
			
			// update data_client
			int dataClientId = DbUtil.getLastDataClientIdByIeName(message.module_id, AppEnv.DOWNLINK + message.code);
			if (dataClientId != 0) {
				DbUtil.updateDataClientStatus(dataClientId, DataClientStatus.CLIENT_CONFIRM_OK.getValue());
			}
			
			// insert into operation_log
			if (AppEnv.MESSAGE_NAME.containsKey(message.code)) {
				
				String messageContent = AppEnv.MESSAGE_NAME.get(message.code) + " message, sent by Module";
				
				DbUtil.insertOperationLog(message.customerCode, messageContent);
			}
		}
	}

	@Override
	public void exceptionCaught(ChannelHandlerContext ctx, ExceptionEvent e) {
		
		logger.error("Channel Exception", e.getCause());

		Channel ch = e.getChannel();
		
		removeChannel(ch);
		
		ch.close();
		
		logger.info("Channel {} is closed, channels: {}", ch.getId(), channels.size());
	}
	
	/**
	 * remove the channel from pools
	 * @param channel
	 */
	private void removeChannel(Channel channel) {
		
		if (channels.containsValue(channel)) {
			
			for (Entry<Integer, Channel> entry: channels.entrySet()) {
				if (entry.getValue().equals(channel)) {
					channels.remove(entry.getKey());
					break;
				}
			}
		}
		
		if (channelAssignment.containsValue(channel)) {
			
			for (Entry<String, Channel> entry: channelAssignment.entrySet()) {
				if (entry.getValue().equals(channel)) {
					channelAssignment.remove(entry.getKey());
					break;
				}
			}
		}
	}
}
