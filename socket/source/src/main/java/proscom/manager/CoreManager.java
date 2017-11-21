// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.manager;

import java.net.InetSocketAddress;
import java.util.concurrent.Executors;

import org.apache.commons.configuration.PropertiesConfiguration;
import org.jboss.netty.bootstrap.ServerBootstrap;
import org.jboss.netty.channel.Channel;
import org.jboss.netty.channel.ChannelFactory;
import org.jboss.netty.channel.group.ChannelGroup;
import org.jboss.netty.channel.group.ChannelGroupFuture;
import org.jboss.netty.channel.group.DefaultChannelGroup;
import org.jboss.netty.channel.socket.nio.NioServerSocketChannelFactory;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import proscom.common.AppConfig;
import proscom.common.AppEnv;
import proscom.exception.AppConfigException;
import proscom.socket.ClientChannel;
import proscom.socket.CorePipelineFactory;
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
public class CoreManager {
	
	private static final Logger logger = LoggerFactory.getLogger(CoreManager.class);
	
	private static ChannelFactory factory = null;
	private static ServerBootstrap bootstrap = null;
	private static ChannelGroup channels = new DefaultChannelGroup(CoreManager.class.getName());
	
	public static void main(String[] args) throws AppConfigException {
		start();
	}
	
	public static void start() throws AppConfigException {
		
		DbUtil.init();
		
		factory = new NioServerSocketChannelFactory(Executors.newCachedThreadPool(), Executors.newCachedThreadPool());

		bootstrap = new ServerBootstrap(factory);
		
		bootstrap.setPipelineFactory(new CorePipelineFactory());
		
		bootstrap.setOption("child.tcpNoDelay", true);
		bootstrap.setOption("child.keepAlive", true);
		
		PropertiesConfiguration config = AppConfig.getPropertiesConfiguration();
		
		// port listening
		int port = config.getInt(AppEnv.PORT, AppEnv.DEFAULT_PORT);
		
		Channel channel = bootstrap.bind(new InetSocketAddress(port));
		channels.add(channel);
		logger.info("Start Server at port {}, channel {}", port, channel.getId());
		
		// start client channel
		ClientChannel client = new ClientChannel();
		client.start();
		
		// start monitor
		TaskManager.startMonitor();
	}

	/**
	 * Stop Server.
	 */
	public static void close() {
		
		ChannelGroupFuture future = channels.close();
		future.awaitUninterruptibly();
		
		factory.releaseExternalResources();
		
		logger.info("Stop Server.. done!");
	}
}
