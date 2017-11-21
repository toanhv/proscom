// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class OutputMode {

	public InformationElement ie;
	
	public String convection_pump;
	public String cold_water_supply_pump; 
	public String return_pump; 
	public String incresed_pressure_pump; 
	public String heat_pump; 
	public String heater_resister; 
	public String three_way_valve; 
	public String backflow_valve; 
	public String reserved;
	
	@Override
	public String toString() {
		return "OutputMode [ie=" + ie + ", convection_pump=" + convection_pump
				+ ", cold_water_supply_pump=" + cold_water_supply_pump
				+ ", return_pump=" + return_pump + ", incresed_pressure_pump="
				+ incresed_pressure_pump + ", heat_pump=" + heat_pump
				+ ", heater_resister=" + heater_resister + ", three_way_valve="
				+ three_way_valve + ", backflow_valve=" + backflow_valve
				+ ", reserved=" + reserved + "]";
	}
}
