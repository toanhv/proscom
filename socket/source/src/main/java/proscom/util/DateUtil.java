// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.util;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

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
public class DateUtil {

	public static long getTimestamp() {
		
		return (new Date()).getTime() / 1000;
	}

	public static String format(Date date, String pattern) {
		
		SimpleDateFormat fmt = new java.text.SimpleDateFormat(pattern);
		return fmt.format(date);
	}
	
	public static Date toDate(String s, String format) throws ParseException {
		DateFormat formatter = new SimpleDateFormat(format);
		
		Date date = formatter.parse(s);
		
		return date;
	}

	public static java.sql.Date toSqlDate(Date d) {
		if (d == null)
			return null;
		return new java.sql.Date(d.getTime());
	}
	
	public static java.sql.Timestamp toSqlTimestamp(Date d) {
		return new java.sql.Timestamp(d.getTime());
	}

	public static Date getFirstDayOfWeek() {
		
		Calendar cal = Calendar.getInstance();
		
		cal.set(Calendar.HOUR_OF_DAY, 0); // ! clear would not reset the hour of day !
		cal.clear(Calendar.MINUTE);
		cal.clear(Calendar.SECOND);
		cal.clear(Calendar.MILLISECOND);
		
		cal.set(Calendar.DAY_OF_WEEK, cal.getFirstDayOfWeek());
		
		return cal.getTime();
	}

	public static Date getFirstDayOfMonth() {
		
		Calendar cal = Calendar.getInstance();
		
		cal.set(Calendar.HOUR_OF_DAY, 0); // ! clear would not reset the hour of day !
		cal.clear(Calendar.MINUTE);
		cal.clear(Calendar.SECOND);
		cal.clear(Calendar.MILLISECOND);

		// get start of the month
		cal.set(Calendar.DAY_OF_MONTH, 1);
		
		return cal.getTime();
	}
}
