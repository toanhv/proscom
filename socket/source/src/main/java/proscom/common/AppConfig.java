// ----------------------------------------------------------------------------
// Copyright 2016, LAPTRINH.VN.
// All rights reserved
// ----------------------------------------------------------------------------
// Change History:
//  2016.10.12  datnh
//     - Initial release
// ----------------------------------------------------------------------------
package proscom.common;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLDecoder;
import java.security.CodeSource;
import java.util.Properties;

import org.apache.commons.configuration.ConfigurationException;
import org.apache.commons.configuration.PropertiesConfiguration;
import org.apache.commons.configuration.reloading.FileChangedReloadingStrategy;

import proscom.exception.AppConfigException;

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
public class AppConfig {
	
	private static final String CONF_PATH = "conf";
	private static final String CONF_FILE = "app.properties";
	private static final String BONECP_CONF_FILE = "bonecp-config.properties";

	private static PropertiesConfiguration propertiesConfiguration = null;

	/**
	 * Gets {@link PropertiesConfiguration} of application.
	 * 
	 * @return {@link PropertiesConfiguration} object.
	 * @throws AppConfigException
	 */
	public static synchronized PropertiesConfiguration getPropertiesConfiguration() throws AppConfigException {
		if (propertiesConfiguration == null) {
			try {
				String configFile = getLocation(CONF_PATH) + "/" + CONF_FILE;

				propertiesConfiguration = new PropertiesConfiguration();
				// auto reload config when content is changed
				propertiesConfiguration.setReloadingStrategy(new FileChangedReloadingStrategy());

				propertiesConfiguration.load(configFile);
			} catch (MalformedURLException | UnsupportedEncodingException | ConfigurationException e) {
				throw new AppConfigException("Can not load app configuration file.", e);
			}
		}

		return propertiesConfiguration;
	}

	/**
	 * Get BoneCP configuration properties.
	 * 
	 * @return
	 * @throws FileNotFoundException
	 * @throws IOException
	 */
	public static Properties getBoneCPConfigProperties() throws FileNotFoundException, IOException {
		Properties prop = new Properties();

		String boneCPConfigFile = getLocation(CONF_PATH) + "/" + BONECP_CONF_FILE;

		prop.load(new FileInputStream(boneCPConfigFile));

		return prop;
	}

	/**
	 * Get actual path at runtime.
	 * 
	 * @return Location.
	 * @throws MalformedURLException
	 * @throws UnsupportedEncodingException
	 */
	public static String getLocation(String location) throws MalformedURLException, UnsupportedEncodingException {
		String result = "";

		CodeSource src = AppConfig.class.getProtectionDomain().getCodeSource();

		URL url = new URL(src.getLocation(), location);
		result = URLDecoder.decode(url.getPath(), "utf-8");

		return result;
	}
}
