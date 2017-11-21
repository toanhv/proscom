// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class Imsi {

	public InformationElement ie;
	
	public String imsi;
	public int module_id;
	public int status;
	public String module_id_assignment;
	
	@Override
	public String toString() {
		return "Imsi [ie=" + ie + ", imsi=" + imsi + ", module_id=" + module_id
				+ ", status=" + status + ", module_id_assignment="
				+ module_id_assignment + "]";
	}
}
