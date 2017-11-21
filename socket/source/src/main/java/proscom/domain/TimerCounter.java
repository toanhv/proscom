// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class TimerCounter {

	public InformationElement ie;
	
	public String counter;
	public String timer_1;
	public String timer_2;
	public String timer_3;
	
	public int counter_value;
	public int timer_1_value;
	public int timer_2_value;
	public int timer_3_value;
	
	@Override
	public String toString() {
		return "TimerCounter [ie=" + ie + ", counter=" + counter + ", timer_1="
				+ timer_1 + ", timer_2=" + timer_2 + ", timer_3=" + timer_3
				+ ", counter_value=" + counter_value + ", timer_1_value="
				+ timer_1_value + ", timer_2_value=" + timer_2_value
				+ ", timer_3_value=" + timer_3_value + "]";
	}
}
