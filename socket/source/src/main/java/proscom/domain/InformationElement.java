// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.domain;

public class InformationElement {

	public String save;
	public String type;
	public String name;
	public String unu;
	public int length;
	public String reserved;
	public String content;
	
	@Override
	public String toString() {
		return "InformationElement [save=" + save + ", type=" + type
				+ ", name=" + name + ", unu=" + unu + ", length=" + length
				+ ", reserved=" + reserved + ", content=" + content + "]";
	}
}
