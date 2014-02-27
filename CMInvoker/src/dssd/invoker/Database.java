package dssd.invoker;


import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

/**
 * @author Umer
 */
public class Database {

	private static String databaseName;
	private static String username;
	private static String password;
		
	public static Connection openConnection() {
		Connection conn = null;
		try {
			username = CMProperties.getDatabaseUsername();
			password = CMProperties.getDatabasePassword();
			databaseName = CMProperties.getDatabaseName();
			
			String url = "jdbc:mysql://localhost/";
			Class.forName("com.mysql.jdbc.Driver").newInstance();
			conn = DriverManager.getConnection(url, username, password);
		} catch (Exception e) {
			System.err.println("Cannot connect to database server"
					+ e.getMessage());
			e.printStackTrace();
		}
		return conn;
	}
	
	public static boolean closeConnection(Connection conn) {
		if (conn != null) {
			try {
				conn.close();
			} catch (Exception e) { /* ignore close errors */
				e.printStackTrace();
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * @author Hafeez & Umer
	 * @param fid
	 * @return
	 */
	public static InvokeParameter getInvokeConfig(int uid) {
		System.out.println("START getInvokeConfig(int uid)");
		int id = -1;
		InvokeParameter invokeParameter = null;
		try {

			Connection dbConn = openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select id from user_invocations u where u.status  =" + 0 + ";");
			if (results.next()) {
				id = results.getInt(1);
				System.out.println("Invoke Config ID: "+id);
				results = s.executeQuery("select * from invocation_parameters u where u.invocation_id  =" + id + ";");
				if (results.next()) {					
					invokeParameter = new InvokeParameter(
                                                                results.getInt("invocation_id"),
								results.getInt("min_similatiry_SCC_tokens"), 
								results.getInt("grouping_choice"),
								results.getInt("method_analysis"),
								results.getString("suppressed_tokens"),
								results.getString("equal_tokens")
                                                            );
					
					System.out.println(" \ninvokeParameter: " +invokeParameter.toString());
					
					results = s.executeQuery("select f.id, CONCAT(repository_name,directory_name,file_name) from repository_file f,repository_directory d," +
							"user_repository r where d.id=f.directory_id and d.repository_id=r.id and f.id IN " +
							"(select file_id from invocation_files where invocation_id=" + id +");");
					
					
					List<List<InvocationFileInfo>> groupList = new ArrayList<List<InvocationFileInfo>>();
					Integer group = -1;
					List<InvocationFileInfo> invocationFileList = new ArrayList<InvocationFileInfo>();
					while (results.next()) {
						Integer fileId = results.getInt(1);
						//a very bad way to get groupId. Should be refactored.
						Statement st = dbConn.createStatement();
						ResultSet result2 = st.executeQuery(" SELECT group_id from invocation_files where file_id ="+ fileId +" and invocation_id="+ id +";");
						result2.next();
						Integer groupId = result2.getInt(1);
						String fileName = results.getString(2);
						InvocationFileInfo invoFileInfo = new InvocationFileInfo(fileName, groupId);
						if(group == groupId || group==-1 ){
							invocationFileList.add(invoFileInfo);
							group = groupId;
						}
						else
						{
							groupList.add(invocationFileList);
							invocationFileList = new ArrayList<InvocationFileInfo>();
							invocationFileList.add(invoFileInfo);
							group = groupId;
						}
						
					}
					if(!invocationFileList.isEmpty())
					{
						groupList.add(invocationFileList);
					}
					invokeParameter.setInput_files(groupList);
					System.out.println("Input_files: " + invokeParameter.getInput_files());
				}
			}
			System.out.println("Invoke Config ID: "+id);
			s.close();
			closeConnection(dbConn);
		} catch (Exception e) {
			e.printStackTrace();
		}

		return invokeParameter;
	}

	/* Execute the database transactions */
	public static boolean executeTransaction(String sql) {
		try {
			if (sql.indexOf("\"") != -1) {
				sql = sql.substring(0, sql.length() - 1);
			}
			sql = sql + ";";

			Connection dbConn = openConnection();
			Statement st = dbConn.createStatement();
			st.execute("use "+databaseName+";");
			st.execute(sql);
			st.close();
		} catch (Exception e) {
			System.err.println(e.getMessage());
			e.printStackTrace();
			
			return false;
		}
		
		return true;
	}
	
	/* Execute the database transactions */
	public static boolean updateInvocationStatus(Integer iid, Integer astatus) {
		try {
			Connection dbConn = openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use "+databaseName+";");
		
			s.executeUpdate("update user_invocations set status =" +  astatus +" where id = "+ iid +";");
			s.close();
		} catch (Exception e) {
			System.err.println(e.getMessage());
			e.printStackTrace();
			
			return false;
		}
		
		return true;
	}

}
