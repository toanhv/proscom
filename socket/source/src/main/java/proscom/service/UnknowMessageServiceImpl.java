// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.service;

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
public class UnknowMessageServiceImpl implements MessageService {

	private static final Logger logger = LoggerFactory.getLogger(UnknowMessageServiceImpl.class);
	
	@Override
	public void processMessage(Message message) {
		logger.warn("Unknow Message {}", message);
	}

}
