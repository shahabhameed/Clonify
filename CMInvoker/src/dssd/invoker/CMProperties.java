package dssd.invoker;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.OutputStream;
import java.util.Properties;

public class CMProperties {
	private static Properties properties = new Properties();
	
	private static String databaseName;
	private static String databaseUsername;
	private static String databasePassword;
	private static String cloneminerRoot;

	public static boolean loadProperties() {
		boolean status = true;
		
		OutputStream output = null;

		try {
			properties.load(new FileInputStream("config.properties"));

			// set the properties value
			databaseName 		= properties.getProperty("database.name");
			databaseUsername	= properties.getProperty("database.username");
			databasePassword	= properties.getProperty("database.password");
			cloneminerRoot		= properties.getProperty("cloneminer.root");

			//save properties to project root folder
			//properties.store(output, null);
		} catch (IOException io) {
			io.printStackTrace();
			
			status = false;
		} finally {
			if (output != null) {
				try {
					output.close();
				} catch (IOException e) {
					e.printStackTrace();
					
					status = false;
				}
			}
		}
		
		return status;
	}
	
	/**
	 * This function is mainly for testing function if the this function is
	 * required for non-testing purpose please modify it with caution.
	 */
	public static boolean isAllSet(){
		if(
			databaseName != null && databaseName.length()>0 &&
			databaseUsername != null && databaseUsername.length()>0 &&
			databasePassword != null &&
			cloneminerRoot != null && cloneminerRoot.length()>0
		)
		{
			return true;
		}
		
		return false;
	}

	public static Properties getProperties() {
		return properties;
	}

	public static void setProperties(Properties properties) {
		CMProperties.properties = properties;
	}

	public static String getDatabaseName() {
		return databaseName;
	}

	public static void setDatabaseName(String databaseName) {
		CMProperties.databaseName = databaseName;
	}

	public static String getDatabaseUsername() {
		return databaseUsername;
	}

	public static void setDatabaseUsername(String databaseUsername) {
		CMProperties.databaseUsername = databaseUsername;
	}

	public static String getDatabasePassword() {
		return databasePassword;
	}

	public static void setDatabasePassword(String databasePassword) {
		CMProperties.databasePassword = databasePassword;
	}

	public static String getCloneminerRoot() {
		return cloneminerRoot;
	}

	public static void setCloneminerRoot(String cloneminerRoot) {
		CMProperties.cloneminerRoot = cloneminerRoot;
	}
	
	
}