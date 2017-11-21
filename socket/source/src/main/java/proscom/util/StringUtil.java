// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.util;

import java.io.IOException;
import java.io.PrintWriter;
import java.io.StringWriter;
import java.util.Arrays;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

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
public class StringUtil {

	public static boolean isNumber(String number) {

		Pattern pattern = Pattern.compile("[0-9]+");
		Matcher matcher = pattern.matcher(number);

		return matcher.matches();
	}

	public static int parseInt(String number) {

		try {
			return Integer.parseInt(number.replaceAll("[^0-9]", ""));
		} catch (Exception e) {
			return 0;
		}
	}

	public static float parseFloat(String number) {
		try {
			return Float.parseFloat(number.replace(",", "."));
		} catch (Exception e) {
			return 0;
		}
	}
	
	/**
	 * Exception to string
	 * 
	 * @param e
	 * @return
	 */
	public static String exceptionToString(Exception e) {

		StringWriter sw = new StringWriter();
		e.printStackTrace(new PrintWriter(sw));
		String logMsg = sw.toString();

		try {
			sw.close();
		} catch (IOException e1) {
		}

		return logMsg;
	}

	public static String binaryStringToHex(String binary) {

		int digitNumber = 1;
		int sum = 0;

		String value = "";

		for (int i = 0; i < binary.length(); i++) {
			if (digitNumber == 1)
				sum += Integer.parseInt(binary.charAt(i) + "") * 8;
			else if (digitNumber == 2)
				sum += Integer.parseInt(binary.charAt(i) + "") * 4;
			else if (digitNumber == 3)
				sum += Integer.parseInt(binary.charAt(i) + "") * 2;
			else if (digitNumber == 4 || i < binary.length() + 1) {
				sum += Integer.parseInt(binary.charAt(i) + "") * 1;
				digitNumber = 0;
				if (sum < 10)
					value += sum;
				else if (sum == 10)
					value += "A";
				else if (sum == 11)
					value += "B";
				else if (sum == 12)
					value += "C";
				else if (sum == 13)
					value += "D";
				else if (sum == 14)
					value += "E";
				else if (sum == 15)
					value += "F";
				sum = 0;
			}
			digitNumber++;
		}

		return value;
	}

	public static String binaryStringToText(String input) {
		
		StringBuilder sb = new StringBuilder(); // Some place to store the chars
		
		Arrays.stream( // Create a Stream
				input.split("(?<=\\G.{8})") // Splits the input string into 8-char-sections (Since a char has 8 bits = 1 byte)
		).forEach(s -> // Go through each 8-char-section...
			sb.append((char) Integer.parseInt(s, 2)) // ...and turn it into an int and then to a char
		);
		
		String output = sb.toString(); // Output text (t)
		
		return output;
	}
	
	public static int binaryStringToInt(String input) {
		
		return Integer.parseInt(input, 2);
	}
}
