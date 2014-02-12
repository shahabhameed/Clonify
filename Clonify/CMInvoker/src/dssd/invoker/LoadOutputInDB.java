package dssd.invoker;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.StringTokenizer;
import java.util.Vector;


public class LoadOutputInDB {

	StringTokenizer st, st1, st2;
	String line, id, l, m, fid, sl, sc, el, ec, filePath = null;
	String mid, mName, sLine, eLine, token;
	int num = 0, mId = -1;
	int dlm;
	private String databaseName ="";

	private static String INSERT_SCC_INSTANCE;
	private static String INSERT_SCC_FILE;
	private static String INSERT_SCC;
	

	public LoadOutputInDB(){
		initQuery();
		databaseName = CMProperties.getDatabaseName();
	}
	
	private static void initQuery() {
		
		
		INSERT_SCC = "INSERT INTO scc(scc_id, length, members, invocation_id) values ";
		INSERT_SCC_FILE = "INSERT INTO scc_file(scc_id, fid) values ";
		INSERT_SCC_INSTANCE = "INSERT INTO scc_instance(scc_instance_id, scc_id, fid, startline, startcol, endline, endcol) values ";
	}
	
	public void loadDBFromFiles(Integer invocationId) throws NumberFormatException, IOException{
//		filePath = Test.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.CLONES_METHOD_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;
//		File file7 = new File(filePath);
//		FileInputStream filein7 = new FileInputStream(file7);
//		BufferedReader stdin7 = new BufferedReader(
//				new InputStreamReader(filein7));
//		int methodPosn = 0;
//		while ((line = stdin7.readLine()) != null) {
//			if (!line.equalsIgnoreCase("")) {
//				st = new StringTokenizer(line, ",");
//				while (st.hasMoreTokens()) {
//					String s1 = st.nextToken();
//					if (!s1.equalsIgnoreCase("")) {
//						insertSCC_Method(Integer.parseInt(s1),
//								methodPosn);
//					}
//				}
//			}
//			methodPosn++;
//		}
//
////		if (!INSERT_SCC_METHOD
////				.equalsIgnoreCase("INSERT INTO scc_method(scc_id, mid) values ")) {
////			Database.executeTransaction(INSERT_SCC_METHOD);
////		}
//		
//		
//		/////////////////////////////////////////////////
		
		
		
		String filePath = "";

		filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.SIMPLE_CLONE_CLASSES_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION; 

		//filePath = con.getFilePath(Controller.CLONES_OUTPUT);
		File file = new File(filePath);
		FileInputStream filein = new FileInputStream(file);
		BufferedReader stdin = new BufferedReader(new InputStreamReader(
				filein));
		int scc_instance_id, sccId;
		while ((line = stdin.readLine()) != null) {
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line, ";");
				id = st.nextToken();
				l = st.nextToken();
				m = st.nextToken();
				num = new Integer(m).intValue();
				scc_instance_id = 0;
				sccId = Integer.parseInt(id);
				for (int i = 0; i < num; i++) {
					line = stdin.readLine();
					st = new StringTokenizer(line, ":");
					fid = st.nextToken();
					st1 = new StringTokenizer(st.nextToken(), "-");
					st2 = new StringTokenizer(st1.nextToken(), ".");
					sl = st2.nextToken();
					sc = st2.nextToken();
					st2 = new StringTokenizer(st1.nextToken(), ".");
					el = st2.nextToken();
					ec = st2.nextToken();
					if (dlm == 1) {
						mId = this.getMethodId(Integer.parseInt(fid),
								Integer.parseInt(sl), Integer.parseInt(el));
					} else {
						mId = -1;
					}
					insertSCC_Instance(scc_instance_id, Integer
							.parseInt(id), Integer.parseInt(fid), Integer
							.parseInt(sl), Integer.parseInt(sc), Integer
							.parseInt(el), Integer.parseInt(ec));
					scc_instance_id++;
					insertSCC_File(sccId, Integer.parseInt(fid));
				}
				insertSCC(sccId, Integer.parseInt(l), Integer.parseInt(m),
						invocationId);
			}
		}

		if (!INSERT_SCC
				.equalsIgnoreCase("INSERT INTO scc(scc_id, length, members, benefit) values ")) {
			Database.executeTransaction(INSERT_SCC);
		}
		if (!INSERT_SCC_INSTANCE
				.equalsIgnoreCase("INSERT INTO scc_instance(scc_instance_id, scc_id, fid, startline, startcol, endline, endcol, mid, did, gid) values ")) {
			Database.executeTransaction(INSERT_SCC_INSTANCE);
		}
//		if (!INSERT_SCC_FILE
//				.equalsIgnoreCase("INSERT INTO scc_file(scc_id, fid) values ")) {
//			Database.executeTransaction(INSERT_SCC_FILE);
//		}
		
				
	}

	//delete mid
	public void insertSCC_Instance(int scc_instance_id, int scc_id, int fid,
			int startline, int startcol, int endline, int endcol) {
		INSERT_SCC_INSTANCE += "( \"" + scc_instance_id + "\" , \"" + scc_id
		+ "\", \"" + fid + "\", \"" + startline + "\", \"" + startcol
		+ "\" , \"" + endline + "\", \"" + endcol + "\"),";
	}

	public int getMethodId(int fid, int sl, int el) {
		try {
			String s;
			int msl, mel, mid;
			Vector<String> content = new Vector<String>();
			String fileName = getFileName(fid);

			System.out.println("\n\n***" + fileName);

			File f = new File(fileName);


			FileInputStream fstream = new FileInputStream(f);
			BufferedReader in = new BufferedReader(new InputStreamReader(
					fstream));
			while (in.ready()) {
				content.add(in.readLine());
			}
			while (sl <= el) {
				s = content.get(sl - 1).trim();
				if (s.equalsIgnoreCase("")) {
					sl++;
				} else if ((s.length() >= 1 && s.substring(0, 1)
						.equalsIgnoreCase("}"))
						|| (s.length() >= 2 && (s.substring(0, 2)
								.equalsIgnoreCase("//") || s.substring(0, 2)
								.equalsIgnoreCase("/*")))) {
					sl++;
				} else {
					break;
				}
			}
			while (sl <= el) {
				s = content.get(el - 1).trim();
				if (s.equalsIgnoreCase("")) {
					el--;
				} else if ((s.length() >= 1 && s.substring(0, 1)
						.equalsIgnoreCase("{"))
						|| (s.length() >= 2 && (s.substring(0, 2)
								.equalsIgnoreCase("//") || s.substring(0, 2)
								.equalsIgnoreCase("*/")))) {
					el--;
				} else {
					break;
				}
			}
			Connection dbConn = Database.openConnection();
			Statement st = dbConn.createStatement();
			st.execute("use "+databaseName+";");
			ResultSet results = st.executeQuery("select method.startline, "
					+ "method.endline, method.mid "
					+ "from method, method_file "
					+ "where method.mid = method_file.mid "
					+ "and method_file.fid = " + fid + ";");
			while (results.next()) {
				msl = results.getInt(1);
				mel = results.getInt(2);
				mid = results.getInt(3);
				if (msl <= sl && mel >= el) {
					return mid;
				}
			}

			st.close();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return -1;
	}

	public void insertSCC_File(int scc_id, int fid) {
		INSERT_SCC_FILE += "( \"" + scc_id + "\" , \"" + fid + "\"  ),";
	}

	public void insertSCC(int scc_id, int length, int members, int invocationId) {
		INSERT_SCC += "( \"" + scc_id + "\" , \"" + length + "\", \"" + members
		+ "\", \"" + invocationId + "\"  ),";
	}

	public int getDidFromFid(int fid) {
		int did = -1;
		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select did "
					+ " from file_directory " + " where fid = " + fid + ";");
			if (results.next()) {
				did = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

		return did;
	}

	public int getGidFromFid(int fid) {
		int gid = -1;
		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select file.gid "
					+ " from file " + " where file.fid = " + fid + ";");
			if (results.next()) {
				gid = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

		return gid;
	}

	/*
	 * Returns the file objectName of a file given the file id
	 */
	public String getFileName(int fid) {
		String fileName = null;
		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s
			.executeQuery("select fname from file where fid = " + fid
					+ ";");
			if (results.next()) {
				fileName = results.getString("fname");
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return fileName;
	}
	
}
