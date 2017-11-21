// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.enums;

public enum DataClientStatus {
	
	NOT_BEEN_SENT(0), SENT(1), CLIENT_CONFIRM_OK(3), CONNECTION_ERROR(4);
	
	private int dataClientType;
	
	private DataClientStatus(int dataClientType) {
		this.dataClientType = dataClientType;
	}
	
	public int getValue() {
		return dataClientType;
	}
}
