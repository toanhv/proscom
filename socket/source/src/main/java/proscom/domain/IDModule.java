// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class IDModule {

	public InformationElement ie;
	
	public String countryCode;
	public String provinceCode;
	public String districtCode;
	public String customerCode;
	
	@Override
	public String toString() {
		return "IDModule [ie=" + ie + ", countryCode=" + countryCode
				+ ", provinceCode=" + provinceCode + ", districtCode="
				+ districtCode + ", customerCode=" + customerCode + "]";
	}
}
