// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.task;

import java.util.concurrent.ArrayBlockingQueue;
import java.util.concurrent.BlockingQueue;
import java.util.concurrent.RejectedExecutionHandler;
import java.util.concurrent.ThreadPoolExecutor;
import java.util.concurrent.TimeUnit;

import org.apache.commons.configuration.PropertiesConfiguration;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import proscom.common.AppConfig;
import proscom.common.AppEnv;
import proscom.domain.Message;
import proscom.exception.AppConfigException;

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
public class TaskManager {

	private static BlockingQueue<Runnable> worksQueue = null;
	private static RejectedExecutionHandler executionHandler = new RejectedTaskHandler();
	private static ThreadPoolExecutor executor = null;
	
	private static final Logger logger = LoggerFactory
			.getLogger(TaskManager.class);
	
	static {
		try {
			PropertiesConfiguration config = AppConfig.getPropertiesConfiguration();
			int poolSize 	= config.getInt(AppEnv.TASK_POOL_SIZE, AppEnv.TASK_POOL_SIZE_DEFAULT_VALUE);
			int runningTask = config.getInt(AppEnv.TASK_RUNNING, AppEnv.TASK_RUNNING_DEFAULT_VALUE);

			worksQueue = new ArrayBlockingQueue<Runnable>(poolSize);
			executor = new ThreadPoolExecutor(runningTask, runningTask * 2, 10, TimeUnit.SECONDS, worksQueue, executionHandler);

			executor.allowCoreThreadTimeOut(true);
		} catch (AppConfigException e) {
			logger.error("Init TaskManager error", e);
		}
	}
	
	public static void execute(Message message) {
		MessageProcessing messageProcessing = new MessageProcessing(message);
		executor.execute(messageProcessing);
	}
	
	/**
	 * Shutdown Task Handler.
	 */
	public static void shutdown() {
		executor.shutdown();
	}
	
	/**
	 * Starting the monitor thread as a daemon.
	 */
	public static void startMonitor() {
		Thread monitor = new Thread(new TaskMonitorThread(executor));
		monitor.setDaemon(true);
		monitor.start();
	}
}
