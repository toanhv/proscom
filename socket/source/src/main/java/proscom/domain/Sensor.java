// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class Sensor {
	
	public InformationElement ie;
	
	public String cam_bien_dan_thu;
	public String cam_bien_bon_solar;
	public String cam_bien_muc_nuoc_bon_solar;
	public String cam_bien_nhiet_do_bon_gia_nhiet;
	public String cam_bien_ap_suat_bon_gia_nhiet;
	
	public String cam_bien_buc_xa_dan_thu;
	public String cam_bien_nhiet_dinh_bon_solar;
	public String cam_bien_tran;
	public String cam_bien_ap_suat_duong_ong;
	public String cam_bien_nhiet_do_duong_ong_1;
	public String cam_bien_nhiet_do_duong_ong_2;
	
	@Override
	public String toString() {
		return "Sensor [ie=" + ie + ", cam_bien_dan_thu=" + cam_bien_dan_thu
				+ ", cam_bien_bon_solar=" + cam_bien_bon_solar
				+ ", cam_bien_muc_nuoc_bon_solar="
				+ cam_bien_muc_nuoc_bon_solar
				+ ", cam_bien_nhiet_do_bon_gia_nhiet="
				+ cam_bien_nhiet_do_bon_gia_nhiet
				+ ", cam_bien_ap_suat_bon_gia_nhiet="
				+ cam_bien_ap_suat_bon_gia_nhiet + ", cam_bien_buc_xa_dan_thu="
				+ cam_bien_buc_xa_dan_thu + ", cam_bien_nhiet_dinh_bon_solar="
				+ cam_bien_nhiet_dinh_bon_solar + ", cam_bien_tran="
				+ cam_bien_tran + ", cam_bien_ap_suat_duong_ong="
				+ cam_bien_ap_suat_duong_ong
				+ ", cam_bien_nhiet_do_duong_ong_1="
				+ cam_bien_nhiet_do_duong_ong_1
				+ ", cam_bien_nhiet_do_duong_ong_2="
				+ cam_bien_nhiet_do_duong_ong_2 + "]";
	}
	
}
