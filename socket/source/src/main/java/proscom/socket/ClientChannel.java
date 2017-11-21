// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.socket;

import java.util.List;

import org.apache.commons.configuration.PropertiesConfiguration;
import org.jboss.netty.buffer.ChannelBuffers;
import org.jboss.netty.channel.Channel;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import proscom.common.AppConfig;
import proscom.common.AppEnv;
import proscom.domain.DataClient;
import proscom.domain.Imsi;
import proscom.enums.DataClientStatus;
import proscom.enums.ImsiStatus;
import proscom.exception.AppConfigException;
import proscom.util.DbUtil;

public class ClientChannel implements Runnable {

	private static final Logger logger = LoggerFactory.getLogger(ClientChannel.class);
	
	protected Thread mthrMain;
	
	public void start() {
		
		if (mthrMain != null) {
			mthrMain = null;
		}
		
		mthrMain = new Thread(this);
		mthrMain.start();
	}
	
	@Override
	public void run() {
		
		PropertiesConfiguration config = null;
		
		try {
			config = AppConfig.getPropertiesConfiguration();
		} catch (AppConfigException e1) {
			logger.error("Error get properties config: " + e1.toString());
		}
		
		long sleepTime = 0;
		Channel channel;
		
		while(true) {
			
			try {
				
				logger.info("[sent to client] running..");
				
				// module assignment
				if (MessageHandler.channelAssignment != null && !MessageHandler.channelAssignment.isEmpty()) {
					
					// send imsi
					List<Imsi> imsiList = DbUtil.getImsi(1);
					if (imsiList != null && imsiList.size() > 0) {
						
						for(Imsi item: imsiList) {
							
							if (item.module_id_assignment != null) {
								
								//MessageHandler.channels.write(ChannelBuffers.wrappedBuffer(item.module_id_assignment.getBytes()));
								channel = MessageHandler.channelAssignment.get(item.imsi);
								
								if (channel != null) {
									
									channel.write(ChannelBuffers.wrappedBuffer(item.module_id_assignment.getBytes()));
									logger.info("setup module_id {}: {} - {}", item.imsi, item.module_id, item.module_id_assignment);
									
									DbUtil.updateImsi(item.imsi, ImsiStatus.CLIENT_RECEIVED.getValue());
								} else {
									
									logger.info("[failed] setup, module_id {}: {} - {}", item.imsi, item.module_id, item.module_id_assignment);
									
									DbUtil.updateImsi(item.imsi, ImsiStatus.CONNECTION_ERROR.getValue());
								}
							}
						}
					}
				}
				
				// send data to client
				if (MessageHandler.channels != null && !MessageHandler.channels.isEmpty()) {
					
					// send data_client
					List<DataClient> messageList = DbUtil.getClientMessage(null);
					if (messageList != null && messageList.size() > 0) {
						
						for(DataClient item: messageList) {
							
							if (item.data != null) {
								
								channel = MessageHandler.channels.get(item.module_id);
								
								String ie_name = "";
								try {
									ie_name = AppEnv.MESSAGE_NAME.get(item.ie_name.substring(1));
								} catch (Exception e) {}
								
								if (channel != null) {
									
									channel.write(ChannelBuffers.wrappedBuffer(item.data.getBytes()));
									
									logger.info("[sent to client] module_id: {}, ie: {} - {}, data: {}", 
											item.module_id, item.ie_name, ie_name, item.data);
									
									DbUtil.updateDataClientStatus(item.data_client_id, DataClientStatus.SENT.getValue());
								} else {
									
									logger.info("[failed] sent to client, module_id: {}, ie: {} - {}, data: {}", 
											item.module_id, item.ie_name, ie_name, item.data);
									
									DbUtil.updateDataClientStatus(item.data_client_id, DataClientStatus.CONNECTION_ERROR.getValue());
								}
							}
						}
					}
				}
			} catch (Exception e) {
				
				logger.error("send data client error", e);
			} finally {
				sleepTime = config.getLong("clientChannel.sleep", 5000);
				logger.info("[sent to client] finish. Time to sleep: {}ms", sleepTime);
				
				try {
					//logger.info("send data client is sleeping in {} ms", sleepTime);
					Thread.sleep(sleepTime);
				} catch (Exception e) {
					logger.error("[sent to client] error sleep thread", e);
				}
			}
		}
	}

}
