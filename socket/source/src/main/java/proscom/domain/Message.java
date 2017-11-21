// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

import java.io.Serializable;

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
public class Message implements Serializable {
	
	private static final long serialVersionUID = 593132603408354835L;

	public String code;
	public String customerCode;
	public String imsi;
	public String content;
	public String ie_name;
	public int module_id;

	@Override
	public String toString() {
		return "Message [code=" + code + ", customerCode=" + customerCode
				+ ", imsi=" + imsi + ", content=" + content + ", ie_name="
				+ ie_name + ", module_id=" + module_id + "]";
	}
	
}
