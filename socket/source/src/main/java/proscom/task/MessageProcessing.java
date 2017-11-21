// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.task;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import proscom.domain.Message;

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
public class MessageProcessing implements Runnable {
	
	private static final Logger logger = LoggerFactory.getLogger(MessageProcessing.class);
	
	private Message message;

	public MessageProcessing(Message message) {
		this.message = message;
	}

	public void run() {
		logger.info("Processing message {}", message);

		/*MessageService messageService = MessageServiceFactory
				.getMessageService(message.getMessageType());
		messageService.processMessage(message);*/

		//logger.info("Processing message {}.. done!", message);
	}
}