// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.common;

import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ConcurrentMap;

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
public class AppEnv {
	
	public static final String PORT = "core.port";
	public static final int DEFAULT_PORT = 3006;
	public static final String ACCOUNT_REPORT_START = "packet.accountReportStart";
	public static final String DEFAULT_ACCOUNT_REPORT_START = "&&";
	
	public static final String ACCOUNT_REPORT_END = "packet.accountReportEnd";
	public static final String DEFAULT_ACCOUNT_REPORT_END = "##";
	
	public static final String TASK_POOL_SIZE = "task.poolSize";
	public static final int TASK_POOL_SIZE_DEFAULT_VALUE = 10000;
	public static final String TASK_RUNNING = "task.runningTask";
	public static final int TASK_RUNNING_DEFAULT_VALUE = 10;
	
	
	/** BIEN MA */
	public static final String DOWNLINK	= "1";
	public static final String UPLINK	= "0";
	
	public static final String SYSTEM_MODE_CONFIG 	= "0000000";
	public static final String OUTPUT_MODE_CONFIG 	= "0000001";
	public static final String PARAMETER_CONFIG 	= "0000010";
	public static final String TIMER_COUNTER_CONFIG = "0000011";
	public static final String CHECK_SYSTEM_MODE 	= "0000100";
	public static final String CHECK_OUTPUT_MODE 	= "0000101";
	public static final String CHECK_PARAMETER 		= "0000110";
	public static final String CHECK_TIMER_COUNTER	= "0000111";
	public static final String ALARM_ACKNOWLEDGE	= "0010000";
	public static final String ALARM_CLEARANCE		= "0010001";
	public static final String ID_ASSIGNMENT		= "0100000";
	public static final String CHECK_MODULE_ID		= "0100001";
	public static final String CHECK_ACCOUNT		= "0100010";
	public static final String RECHARGE_ACCOUNT		= "0100011";
	public static final String PASS_RESET			= "0100100";
	public static final String NEW_MODULE_CONFIRM	= "0100101";
	public static final String HARD_EMERGENCY_STOP	= "0110000";
	public static final String HARD_EMERGENCY_RESET = "0110001";
	public static final String SOFT_EMERGENCY_STOP 	= "0110010";
	public static final String SOFT_EMERGENCY_RESET = "0110011";
	
	public static final ConcurrentMap<String, String> MESSAGE_NAME = new ConcurrentHashMap<String, String>();
	
	static {
		MESSAGE_NAME.put(SYSTEM_MODE_CONFIG, 	"System Mode Config");
		MESSAGE_NAME.put(OUTPUT_MODE_CONFIG, 	"Output Mode Config");
		MESSAGE_NAME.put(PARAMETER_CONFIG, 		"Parameter Mode Config");
		MESSAGE_NAME.put(TIMER_COUNTER_CONFIG, 	"Timer/Couter Config");
		MESSAGE_NAME.put(CHECK_SYSTEM_MODE, 	"Check System Config");
		MESSAGE_NAME.put(CHECK_OUTPUT_MODE, 	"Check Output Config");
		
		MESSAGE_NAME.put(CHECK_PARAMETER, 		"Check Parameter");
		MESSAGE_NAME.put(CHECK_TIMER_COUNTER, 	"Check Timer/Counter");
		MESSAGE_NAME.put(ALARM_ACKNOWLEDGE, 	"Alarm Acknowledge");
		MESSAGE_NAME.put(ALARM_CLEARANCE, 		"Alarm Clearance");
		MESSAGE_NAME.put(ID_ASSIGNMENT, 		"ID Assignment");
		MESSAGE_NAME.put(CHECK_MODULE_ID, 		"Check Module ID");
		
		MESSAGE_NAME.put(CHECK_ACCOUNT, 		"Check Account");
		MESSAGE_NAME.put(RECHARGE_ACCOUNT, 		"Recharge Account");
		MESSAGE_NAME.put(PASS_RESET, 			"Pass Reset");
		MESSAGE_NAME.put(NEW_MODULE_CONFIRM, 	"New Module Confirm");
		MESSAGE_NAME.put(HARD_EMERGENCY_STOP, 	"Hard Emergency Stop");
		MESSAGE_NAME.put(HARD_EMERGENCY_RESET, 	"Hard Emergency Reset");
		
		MESSAGE_NAME.put(SOFT_EMERGENCY_STOP, 	"Soft Emergency Stop");
		MESSAGE_NAME.put(SOFT_EMERGENCY_RESET, 	"Soft Emergency Reset");
	}
}
