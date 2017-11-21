// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.task;

import java.util.concurrent.RejectedExecutionHandler;
import java.util.concurrent.ThreadPoolExecutor;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

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
public class RejectedTaskHandler implements RejectedExecutionHandler {
	private static final Logger logger = LoggerFactory.getLogger(RejectedTaskHandler.class);

	public void rejectedExecution(Runnable runnable, ThreadPoolExecutor executor) {
		logger.warn(runnable.toString() + " : I've been rejected !");
	}

}
