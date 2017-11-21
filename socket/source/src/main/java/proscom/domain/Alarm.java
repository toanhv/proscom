// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class Alarm {

	public InformationElement ie;
	
	public String qua_nhiet;
	public String qua_ap_suat;
	public String mat_dien;
	public String tran_be;
	public int alarm_type;
	
	@Override
	public String toString() {
		return "Alarm [ie=" + ie + ", qua_nhiet=" + qua_nhiet
				+ ", qua_ap_suat=" + qua_ap_suat + ", mat_dien=" + mat_dien
				+ ", tran_be=" + tran_be + "]";
	}
	
}
