// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.service;

import proscom.enums.MessageType;

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
public class MessageServiceFactory {

	public static MessageService getMessageService(MessageType messageType) {
		if (messageType != null)
			switch (messageType) {
			case V:
				return new VE00MessageServiceImpl();
			default:
				return new UnknowMessageServiceImpl();
			}
		return new UnknowMessageServiceImpl();
	}
}
