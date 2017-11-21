// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.util;

import java.nio.charset.StandardCharsets;

import org.jboss.netty.buffer.ChannelBuffer;
import org.jboss.netty.buffer.ChannelBuffers;

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
public class ChannelBufferHelper {

	/**
	 * Convert from {@link String} to {@link ChannelBuffer} type.
	 */
	public static ChannelBuffer fromString(String s) {
		return ChannelBuffers.wrappedBuffer(s
				.getBytes(StandardCharsets.US_ASCII));
	}

	/**
	 * Convert from {@link ChannelBuffer} to {@link String} type.
	 */
	public static String toString(ChannelBuffer buff) {
		return new String(buff.array());
	}

	/**
	 * Returns the number of bytes between the readerIndex of the haystack and
	 * the first needle found in the haystack. -1 is returned if no needle is
	 * found in the haystack.
	 */
	public static int indexOf(ChannelBuffer haystack, ChannelBuffer needle) {
		for (int i = haystack.readerIndex(); i < haystack.writerIndex(); i++) {
			int haystackIndex = i;
			int needleIndex;
			for (needleIndex = 0; needleIndex < needle.capacity(); needleIndex++) {
				if (haystack.getByte(haystackIndex) != needle
						.getByte(needleIndex)) {
					break;
				} else {
					haystackIndex++;
					if (haystackIndex == haystack.writerIndex()
							&& needleIndex != needle.capacity() - 1) {
						return -1;
					}
				}
			}

			if (needleIndex == needle.capacity()) {
				// Found the needle from the haystack!
				return i - haystack.readerIndex();
			}
		}
		return -1;
	}
}
