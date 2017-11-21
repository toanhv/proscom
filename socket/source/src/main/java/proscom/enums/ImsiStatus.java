// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.enums;

public enum ImsiStatus {
	
	REQUEST_IMSI(0), APPROVED(1), CLIENT_RECEIVED(2), CLIENT_CONFIRM_OK(3), CONNECTION_ERROR(4);
	
	private int imsiStatus;
	
	private ImsiStatus(int imsiStatus) {
		this.imsiStatus = imsiStatus;
	}
	
	public int getValue() {
		return imsiStatus;
	}
}
