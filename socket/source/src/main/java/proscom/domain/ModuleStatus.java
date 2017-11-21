// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class ModuleStatus {

	public InformationElement ie;
	
	public String bom_doi_luu_1;
	public String bom_doi_luu_2;
	public String bom_cap_nuoc_lanh_1;
	public String bom_cap_nuoc_lanh_2;
	public String bom_hoi_duong_ong_1;
	public String bom_hoi_duong_ong_2;
	public String bom_tang_ap_1;
	public String bom_tang_ap_2;
	public String bom_nhiet_bon_gia_nhiet;
	public String dien_tro_nhiet_bon_gia_nhiet_1;
	public String dien_tro_nhiet_bon_gia_nhiet_2;
	public String van_dien_tu_ba_nga;
	public String van_dien_tu_mot_chieu;
	
	@Override
	public String toString() {
		return "ModuleStatus [ie=" + ie + ", bom_doi_luu_1=" + bom_doi_luu_1
				+ ", bom_doi_luu_2=" + bom_doi_luu_2 + ", bom_cap_nuoc_lanh_1="
				+ bom_cap_nuoc_lanh_1 + ", bom_cap_nuoc_lanh_2="
				+ bom_cap_nuoc_lanh_2 + ", bom_hoi_duong_ong_1="
				+ bom_hoi_duong_ong_1 + ", bom_hoi_duong_ong_2="
				+ bom_hoi_duong_ong_2 + ", bom_tang_ap_1=" + bom_tang_ap_1
				+ ", bom_tang_ap_2=" + bom_tang_ap_2
				+ ", bom_nhiet_bon_gia_nhiet=" + bom_nhiet_bon_gia_nhiet
				+ ", dien_tro_nhiet_bon_gia_nhiet_1="
				+ dien_tro_nhiet_bon_gia_nhiet_1
				+ ", dien_tro_nhiet_bon_gia_nhiet_2="
				+ dien_tro_nhiet_bon_gia_nhiet_2 + ", van_dien_tu_ba_nga="
				+ van_dien_tu_ba_nga + ", van_dien_tu_mot_chieu="
				+ van_dien_tu_mot_chieu + "]";
	}
}
