// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.task;

import java.util.concurrent.ThreadPoolExecutor;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import proscom.socket.MessageHandler;

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
public class TaskMonitorThread implements Runnable {
	
	private static final Logger logger = LoggerFactory.getLogger(TaskManager.class);
	
	ThreadPoolExecutor executor;

	public TaskMonitorThread(ThreadPoolExecutor executor) {
		this.executor = executor;
	}

	public void run() {
		
		do {
			try {
				logger.info("[monitor] ================================================================");
				logger.info(String
								.format("Pools: %d/%d, active: %d, completed: %d, task: %d, isShutdown: %s, isTerminated: %s",
										this.executor.getPoolSize(),
										this.executor.getCorePoolSize(),
										this.executor.getActiveCount(),
										this.executor.getCompletedTaskCount(),
										this.executor.getTaskCount(),
										this.executor.isShutdown(),
										this.executor.isTerminated()));
				
				logger.info("Number of channel connections: " + MessageHandler.channels.size());
				logger.info("[monitor] ================================================================");
				Thread.sleep(180000);
			} catch (Exception e) {
			}
		} while (true);
	}
}
