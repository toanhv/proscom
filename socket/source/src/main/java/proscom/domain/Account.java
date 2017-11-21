// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class Account {

	public InformationElement ie;
	
	public String money;
	public String data;
	public String content;
	
	@Override
	public String toString() {
		return "Account [ie=" + ie + ", money=" + money + ", data=" + data + ", content=" + content + "]";
	}
}
