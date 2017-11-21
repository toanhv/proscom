// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.exception;

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
public class AppConfigException extends Exception {
	private static final long serialVersionUID = -6111091783023868367L;

	public AppConfigException() {
		super();
	}

	public AppConfigException(String message) {
		super(message);
	}

	public AppConfigException(Throwable throwable) {
		super(throwable);
	}

	public AppConfigException(String message, Throwable throwable) {
		super(message, throwable);
	}
}
