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
import java.util.ArrayList;
import java.util.StringTokenizer;
import java.util.Vector;

import dssd.invoker.adapter.OutputHelper;

public class DBLoaderFromTextFiles extends OutputHelper{

	StringTokenizer st, st1, st2;
	String line, id, l, m, fid, sl, sc, el, ec, filePath = null;
	String mid, mName, sLine, eLine, token;
	int num = 0, mId = -1;
	int dlm;
	private String databaseName ="";

	private static String INSERT_SCC = "INSERT INTO scc(scc_id, length, members, invocation_id) values ";		
	private static String INSERT_SCC_INSTANCE = "INSERT INTO scc_instance(scc_instance_id, scc_id, fid, startline, startcol, endline, endcol, invocation_id) values ";
	private static String INSERT_SCSINFILE_SCC = "INSERT INTO scsinfile_scc(scc_id, scs_infile_id, invocation_id) values ";		
	private static String INSERT_SCSINFILE_FILE = "INSERT INTO scsinfile_file(scs_infile_id,invocation_id, fid, members) values ";
	private static String INSERT_SCSINFILE_FRAGMENTS = "INSERT INTO scsinfile_fragments(scs_infile_id, fid, scc_id, scsinfile_instance_id, scc_instance_id, invocation_id) values ";
	private static String INSERT_SCSCROSSFILE_FILE = "INSERT INTO scscrossfile_file(scs_crossfile_id, fid, tc, pc, invocation_id) values ";
	private static String INSERT_SCSCROSSFILE_SCC = "INSERT INTO scscrossfile_scc(scc_id, scs_crossfile_id, invocation_id) values ";
	private static String INSERT_SCS_CROSSFILE = "INSERT INTO scs_crossfile(scs_crossfile_id, invocation_id, atc, apc, members) values ";
	
	private static String INSERT_MCC = "INSERT INTO mcc(mcc_id, atc, apc, invocation_id, members) values ";
	private static String INSERT_MCC_INSTANCE = "INSERT INTO mcc_instance(mcc_instance_id, mcc_id, mid, tc, pc, fid, did, gid) values ";
	private static String INSERT_MCC_SCC = "INSERT INTO mcc_scc(mcc_id, scc_id) values ";
	
	private static String INSERT_METHOD = "INSERT INTO method(mid, mname, tokens, startline, endline) values ";
	private static String INSERT_METHOD_FILE = "INSERT INTO method_file(mid, cmfile_id, startline, endline) values ";
		
	public DBLoaderFromTextFiles(){
		databaseName = CMProperties.getDatabaseName();
	}
	
	public void populateCMDirectoryIDs(Integer invokId) throws IOException{
		filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_INFO_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;
		File file3 = new File(filePath);
		FileInputStream filein3 = new FileInputStream(file3);
		BufferedReader stdin3 = new BufferedReader(new InputStreamReader(
				filein3));
		int size = getFileSize();
		for (int i = 0; i < size; i++) {
			line = stdin3.readLine();
			st = new StringTokenizer(line, ",");
			st.nextToken();
			int tempId = new Integer(st.nextToken().trim()).intValue();
			int length = new Integer(st.nextToken().trim()).intValue();
			Database.executeTransaction("UPDATE invocation_files SET cmdirectory_id=\"" + tempId + "\" WHERE cmfile_id=\"" + i + "\" AND invocation_id=\"" + invokId+"\";");
		}
	}
	
	@Override
	public boolean loadDBFromFiles() {
		try{
			String filePath = "";
			String filePath_infilestructures = "";

			populateCMDirectoryIDs(invocationId);
			
			filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.SIMPLE_CLONE_CLASSES_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION; 
			filePath_infilestructures = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.INFILE_STRUCTURES_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;

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
								.parseInt(el), Integer.parseInt(ec), invocationId);
						scc_instance_id++;						
					}
					insertSCC(sccId, Integer.parseInt(l), Integer.parseInt(m),
							invocationId);
				}
			}

			if (!INSERT_SCC
					.equalsIgnoreCase("INSERT INTO scc(scc_id, length, members, invocation_id) values ")) {
				Database.executeTransaction(INSERT_SCC);
			}
			if (!INSERT_SCC_INSTANCE
					.equalsIgnoreCase("INSERT INTO scc_instance(scc_instance_id, scc_id, fid, startline, startcol, endline, endcol, invocation_id) values ")) {
				Database.executeTransaction(INSERT_SCC_INSTANCE);
			}                                                
			
			/**
			 * Please note this function loads 4 files to DB.
			 */
			loadMoreFiles(invocationId, Constants.CLONES_BY_FILE_FILE_NAME, Constants.CLONES_BY_FILE_TABLE_NAME);
			loadMoreFiles(invocationId, Constants.CLONES_BY_FILE_NORMAL_FILE_NAME, Constants.CLONES_BY_FILE_NORMAL_TABLE_NAME);
			loadMoreFiles(invocationId, Constants.CLONES_BY_METHOD_FILE_NAME, Constants.CLONES_BY_METHOD_TABLE_NAME);
			loadMoreFiles(invocationId, Constants.CLONES_BY_METHOD_NORMAL_FILE_NAME, Constants.CLONES_BY_METHOD_NORMAL_TABLE_NAME);
			loadMoreFiles(invocationId, Constants.CLONES_RNR_FILE_NAME, Constants.CLONES_RNR_TABLE_NAME);

			File file5 = new File(filePath_infilestructures);
			FileInputStream filein5 = new FileInputStream(file5);
			BufferedReader stdin5 = new BufferedReader(new InputStreamReader(
					filein5));
			int count = 0;
			int count0 = 0;
			int count1 = 0;
			int fId = -1;
			Vector<String> fragments;
			int fragmentSize;
			int cluster_size;
			int size = 0;
			String temp;
			Vector<String> sccs = new Vector<String>();
			size = getFileSize(invocationId);
			for (int i = 0; i < size; i++) {
				line = stdin5.readLine();
				if (line != null && !line.equalsIgnoreCase("")) {
					st = new StringTokenizer(line, "()");
					int loop = st.countTokens() / 2;
					for (int j = 0; j < loop; j++) {
						int inst = (new Integer(st.nextToken())).intValue();
						String pat = st.nextToken();
						StringTokenizer stPat = new StringTokenizer(pat, ",");
						String pre = "";
						cluster_size = 0;
						sccs = new Vector<String>();
						while (stPat.hasMoreTokens()) {
							temp = stPat.nextToken();
							if (!pre.equalsIgnoreCase(temp)) {
								sccs.add(temp);
								cluster_size++;
							}
							insertSCSInFile_SCC(Integer.parseInt(temp), count, invocationId);
							pre = temp;
						}

						fragments = null;
						fId = count0;
						for (int k = 0; k < cluster_size; k++) {
							sccId = Integer.parseInt(sccs.get(k));
							fragments = getSCS_Fragments(fId, sccId,
									Constants.FILE_TYPE);
							if (fragments != null) {
								fragmentSize = fragments.size();
								count1 = 0;
								for (int n = 0; n < inst; n++) {
									for (int q = 0; q < fragmentSize / inst; q++) {
										insertSCSInFile_Fragments(count, fId,
												sccId, n, Integer
												.parseInt(fragments
														.get(count1)), invocationId);
										count1++;
									}
								}
							}
						}						
						insertSCSInFile_File(count, count0,invocationId,inst);
						count++;
					}
				}
				count0++;
			}

			if (!INSERT_SCSINFILE_SCC
					.equalsIgnoreCase("INSERT INTO scsinfile_scc(scc_id, scs_infile_id, invocation_id) values ")) {
				Database.executeTransaction(INSERT_SCSINFILE_SCC);
			}			
			if (!INSERT_SCSINFILE_FILE
					.equalsIgnoreCase("INSERT INTO scsinfile_file(scs_infile_id,invocation_id, fid, members) values ")) {
				Database.executeTransaction(INSERT_SCSINFILE_FILE);
			}
			if (!INSERT_SCSINFILE_FRAGMENTS
					.equalsIgnoreCase("INSERT INTO scsinfile_fragments(scs_infile_id, fid, scc_id, scsinfile_instance_id, scc_instance_id, invocation_id) values ")) {
				Database.executeTransaction(INSERT_SCSINFILE_FRAGMENTS);
			}

			parse_file_clusters(invocationId);
			
			sprint04FilesToDB(invocationId);

		} catch(Exception e){
			e.printStackTrace();
			return false;
		}
		
		return true;
	} //function end bracket

	private void loadMoreFiles(Integer pInvocationId, String pFileName, String pTableName) throws NumberFormatException, IOException{
		String filePath = "";

		filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + pFileName + Constants.CM_TEXT_FILE_EXTENSION; 
		
		File file = new File(filePath);
		FileInputStream filein = new FileInputStream(file);
		BufferedReader stdin = new BufferedReader(new InputStreamReader(filein));
		int lineNumber = 0;
		ArrayList<String> values = new ArrayList<String>();
		while ((line = stdin.readLine()) != null) {
			lineNumber++;
			
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line, ",");
				
				for(;st.hasMoreTokens();){
					String value = "(\"" + pInvocationId +"\",\""  + lineNumber + "\",\"" + st.nextToken() + "\"),";
					values.add(value);
				}
			}
		}
		String value = "(\"" + pInvocationId +"\",\""  + (lineNumber+1) + "\",\"LAST_LINE\"),";
		values.add(value);
		
		
		String query = "INSERT INTO " + pTableName + "(invocation_id, line_num, value) values ";
		for(String str : values){
			query += str;
		}
		
		Database.executeTransaction(query);
	}
	
	//delete mid
	private void insertSCC_Instance(int scc_instance_id, int scc_id, int fid,
			int startline, int startcol, int endline, int endcol, int invocationId) {
		INSERT_SCC_INSTANCE += "( \"" + scc_instance_id + "\" , \"" + scc_id
		+ "\", \"" + fid + "\", \"" + startline + "\", \"" + startcol
		+ "\" , \"" + endline + "\", \"" + endcol  + "\",\"" + invocationId + "\"),";
	}	

	private void parse_file_clusters(int invocation_id) throws FileNotFoundException, IOException
	{
		String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_CLUSTERS_FILE_NAME+ Constants.CM_TEXT_FILE_EXTENSION; 
		
		File file2 = new File(filePath);
		FileInputStream filein2 = new FileInputStream(file2);
		BufferedReader stdin2 = new BufferedReader(new InputStreamReader(filein2));
		String temp;
		while ((line = stdin2.readLine()) != null) {
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line, ";");
				String cid = st.nextToken();
				int scs_crossfile_id = Integer.parseInt(cid);
				String support = st.nextToken();
				String sccs = stdin2.readLine();
				st2 = new StringTokenizer(sccs, ",");
				while (st2.hasMoreTokens()) {
					temp = st2.nextToken();
					insertSCSCrossFile_SCC(Integer.parseInt(temp),
							scs_crossfile_id, invocation_id);
				}

				int sup = (new Integer(support)).intValue();
				double atc = 0;
				double apc = 0;
				for (int i = 0; i < sup; i++) {
					line = stdin2.readLine();
					st1 = new StringTokenizer(line, ";,");
					fid = st1.nextToken();
					String tk = st1.nextToken();
					String coverage = st1.nextToken();
					atc += Double.parseDouble(tk);
					apc += Double.parseDouble(coverage);
					insertSCSCrossFile_File(scs_crossfile_id, Integer
							.parseInt(fid), Double.parseDouble(tk), Double
							.parseDouble(coverage), invocation_id);
				}
				atc = atc / sup;
				apc = apc / sup;
				insertSCS_CrossFile(scs_crossfile_id, atc, apc, sup,invocation_id);
			}
		}

		if (!INSERT_SCSCROSSFILE_SCC
				.equalsIgnoreCase("INSERT INTO scscrossfile_scc(scc_id, scs_crossfile_id, invocation_id) values ")) {
			Database.executeTransaction(INSERT_SCSCROSSFILE_SCC);
		}
		if (!INSERT_SCSCROSSFILE_FILE
				.equalsIgnoreCase("INSERT INTO scscrossfile_file(scs_crossfile_id, fid, tc, pc, invocation_id) values ")) {
			Database.executeTransaction(INSERT_SCSCROSSFILE_FILE);
		}
		if (!INSERT_SCS_CROSSFILE
				.equalsIgnoreCase("INSERT INTO scs_crossfile(scs_crossfile_id, invocation_id, atc, apc, members) values ")) {
			Database.executeTransaction(INSERT_SCS_CROSSFILE);
		}
	}
	
	private void sprint04FilesToDB(int pInvocationId) throws NumberFormatException, IOException{
		filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.METHOD_INFO + Constants.CM_TEXT_FILE_EXTENSION;
		
		File file6 = new File(filePath);
		FileInputStream filein6 = new FileInputStream(file6);
		BufferedReader stdin6 = new BufferedReader(
				new InputStreamReader(filein6));
		while ((line = stdin6.readLine()) != null) {
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line, ",");
				mid = st.nextToken().trim();
				fid = st.nextToken().trim();
				mName = st.nextToken().trim();
				sLine = st.nextToken().trim();
				eLine = st.nextToken().trim();
				token = st.nextToken().trim();
				insertMethod(Integer.parseInt(mid), mName, Integer
						.parseInt(token), Integer.parseInt(sLine),
						Integer.parseInt(eLine));
				insertMethod_File(Integer.parseInt(mid), Integer
						.parseInt(fid), Integer.parseInt(sLine),
						Integer.parseInt(eLine));
			}
		}

		if (!INSERT_METHOD
				.equalsIgnoreCase("INSERT INTO method(mid, mname, tokens, startline, endline) values ")) {
			Database.executeTransaction(INSERT_METHOD);
		}
		if (!INSERT_METHOD_FILE
				.equalsIgnoreCase("INSERT INTO method_file(mid, cmfile_id, startline, endline) values ")) {
			Database.executeTransaction(INSERT_METHOD_FILE);
		}

		filein6.close();
		
		
		Vector<String> sccs = new Vector<String>();
		String temp;
		double atc = 0;
		double apc = 0;
		
		filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.METHOD_CLUSTER_XX + Constants.CM_TEXT_FILE_EXTENSION;
		File file9 = new File(filePath);
		FileInputStream filein9 = new FileInputStream(file9);
		BufferedReader stdin9 = new BufferedReader(
				new InputStreamReader(filein9));
		while ((line = stdin9.readLine()) != null) {
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line, ";");
				String mCid = st.nextToken().trim();
				String mSupport = st.nextToken().trim();
				temp = stdin9.readLine();
				sccs = new Vector<String>();
				st2 = new StringTokenizer(temp, ",");
				while (st2.hasMoreTokens()) {
					sccs.add(st2.nextToken());
				}
				int mcc_id = Integer.parseInt(mCid);
				int mSup = (new Integer(mSupport)).intValue();
				atc = 0;
				apc = 0;
				for (int i = 0; i < mSup; i++) {
					line = stdin9.readLine();
					st1 = new StringTokenizer(line, ";,");
					mid = st1.nextToken().trim();
					String mTk = st1.nextToken().trim();
					String mCoverage = st1.nextToken().trim();
					mName = getMethodName(new Integer(mid).intValue());
					atc += Double.parseDouble(mTk);
					apc += Double.parseDouble(mCoverage);
					insertMCC_Instance(i, mcc_id,
							Integer.parseInt(mid), Double
									.parseDouble(mTk), Double
									.parseDouble(mCoverage));
				}
				atc = atc / mSup;
				apc = apc / mSup;
				for (int i = 0; i < sccs.size(); i++) {
					insertMCC_SCC(mcc_id, Integer.parseInt(sccs.get(i)));
				}
				insertMCC(mcc_id, atc, apc, invocationId, mSup);
			}
		}
		
		if (!INSERT_MCC.equalsIgnoreCase("INSERT INTO mcc(mcc_id, atc, apc, invocation_id, members) values ")) {
			System.out.println("\nINSERT_MCC: " + INSERT_MCC);
			Database.executeTransaction(INSERT_MCC);
		}
		if (!INSERT_MCC_INSTANCE.equalsIgnoreCase("INSERT INTO mcc_instance(mcc_instance_id, mcc_id, mid, tc, pc, fid, did, gid) values ")) {
			System.out.println("\nINSERT_MCC_INSTANCE: " + INSERT_MCC_INSTANCE);
			Database.executeTransaction(INSERT_MCC_INSTANCE);
		}
		if (!INSERT_MCC_SCC.equalsIgnoreCase("INSERT INTO mcc_scc(mcc_id, scc_id) values ")) {
			System.out.println("\nINSERT_MCC_SCC: " + INSERT_MCC_SCC);
			Database.executeTransaction(INSERT_MCC_SCC);
		}
	}
	
	public void insertMethod_File(int mid, int fid, int startline, int endline) {
		INSERT_METHOD_FILE += "( \"" + mid + "\" , \"" + fid + "\", \""
				+ startline + "\", \"" + endline + "\"  ),";
	}
	
	/* Methods for insert data into the database using SQL Statements */
	public void insertMethod(int mid, String mname, int tokens, int startline,
			int endline) {
		INSERT_METHOD += "( \"" + mid + "\" , \"" + mname + "\", \"" + tokens
				+ "\", \"" + startline + "\", \"" + endline + "\"  ),";
	}

	
	public void insertMCC(int mcc_id, double atc, double apc, int pInvocationId, int members) {
		INSERT_MCC += "( \"" + mcc_id + "\" , \"" + atc + "\", \"" + apc
				+ "\", \"" + pInvocationId + "\", \"" + members + "\"  ),";
	}
	
	public void insertMCC_Instance(int mcc_instance_id, int mcc_id, int mid,
			double tc, double pc) {
		int fid = getFidFromMid(mid);
		INSERT_MCC_INSTANCE += "( \"" + mcc_instance_id + "\" , \"" + mcc_id
				+ "\", \"" + mid + "\", \"" + tc + "\", \"" + pc + "\", \""
				+ fid + "\", \"" + getDidFromFid(fid) + "\", \""
				+ getGidFromFid(fid) + "\"  ),";
	}
	
	public int getGidFromFid(int fid) {
		int gid = -1;
		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use dssd;");
			ResultSet results = s.executeQuery("select group_id"
					+ " from invocation_files " + "where cmfile_id = " + fid + ";");
			if (results.next()) {
				gid = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

		return gid;
	}
	
	public int getDidFromFid(int pFid) {
		int did = -1;
		try {
			int fid = -1;
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use dssd;");
			ResultSet results = s.executeQuery("select file_id "
					+ " from invocation_files " + " where cmfile_id = " + pFid + ";");
			if (results.next()) {
				fid = results.getInt(1);
			}
			
			results = s.executeQuery("select directory_id"
					+ " from repository_file " + "where id = " + fid + ";");
			if (results.next()) {
				did = results.getInt(1);
			}

			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

		return did;
	}
	
	public void insertMCC_SCC(int mcc_id, int scc_id) {
		INSERT_MCC_SCC += "( \"" + mcc_id + "\" , \"" + scc_id + "\"  ),";
	}
	
	public int getFidFromMid(int mid) {
		int fid = -1;
		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use dssd;");
			ResultSet results = s.executeQuery("select cmfile_id "
					+ " from method_file " + " where mid = " + mid + ";");
			if (results.next()) {
				fid = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

		return fid;
	}
	
	/*
	 * Returns the method objectName of a method given the method id
	 */
	public String getMethodName(int mid) {
		String methodName = null;
		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use dssd;");
			ResultSet results = s
					.executeQuery("select mname from method where mid = " + mid
							+ ";");
			if (results.next()) {
				methodName = results.getString("mname");
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return methodName;
	}
	
	private int getMethodId(int fid, int sl, int el) {
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

	private void insertSCC(int scc_id, int length, int members, int invocationId) {
		INSERT_SCC += "( \"" + scc_id + "\" , \"" + length + "\", \"" + members
		+ "\", \"" + invocationId + "\"  ),";
	}
	
	private void insertSCSInFile_SCC(int scc_id, int scs_infile_id, int invocationId) {
		INSERT_SCSINFILE_SCC += "( \"" + scc_id + "\" , \"" + scs_infile_id + "\" , \"" + invocationId
				+ "\"  ),";	 
	}

	private void insertSCSInFile_Fragments(int scs_infile_id, int fid,
			int scc_id, int scsinfile_instance_id, int scc_instance_id, int invocationId) {
		INSERT_SCSINFILE_FRAGMENTS += "( \"" + scs_infile_id + "\" , \"" + fid
				+ "\" , \"" + scc_id + "\" , \"" + scsinfile_instance_id
				+ "\" , \"" + scc_instance_id + "\" , \"" + invocationId + "\"  ),";
	}
	
	private void insertSCSInFile_File(int scs_infile_id, int fid,int invocationId, int members) {
		INSERT_SCSINFILE_FILE += "( \"" + scs_infile_id +"\" , \"" + invocationId +"\" , \"" + fid
				+  "\" , \"" + members + "\" ),";
	}		

	/*
	 * Returns the file objectName of a file given the file id
	 */
	private String getFileName(int fid) {
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
	
	public int getFileSize(Integer invocationId) {
		int size = -1;
		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select count(*) from invocation_files where invocation_id = " + invocationId + ";");
			if (results.next()) {
                          size = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return size;
	}

	/*
	 * Returns the size of the input file list
	 */
	public int getFileSize() {
		int size = -1;
		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use clonedatabase;");
			ResultSet results = s.executeQuery("select count(*) from file;");
			if (results.next()) {
				size = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return size;
	}

	private Vector<String> getSCS_Fragments(int cid, int scc_id, int type) {
		Vector<String> list = null;
		String frag = null;

		try {
			Connection dbConn = Database.openConnection();
			Statement s = dbConn.createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = null;
			if (type == Constants.FILE_TYPE) {
				results = s.executeQuery("select scc_instance_id "
						+ "from scc_instance " + "where fid = " + cid
						+ " and scc_id = " + scc_id + ";");
			} else if (type == Constants.METHOD_TYPE) {
				results = s.executeQuery("select scc_instance_id "
						+ "from scc_instance " + "where mid = " + cid
						+ " and scc_id = " + scc_id + ";");
			}
			list = new Vector<String>();
			while (results.next()) {
				frag = results.getString("scc_instance_id");
				list.add(frag);
			}

			s.close();
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e.getMessage());
		}

		return list;
	}


	private void insertSCS_CrossFile(int scs_crossfile_id, double atc,
			double apc, int members, int invocation_id) {
		INSERT_SCS_CROSSFILE += "( \"" + scs_crossfile_id + "\" ,\"" + invocation_id
				+ "\", \"" + atc
				+ "\", \"" + apc + "\", \"" + members + "\"  ),";
	}

	private void insertSCSCrossFile_SCC(int scc_id, int scs_crossfile_id, int invocationId) {
		INSERT_SCSCROSSFILE_SCC += "( \"" + scc_id + "\" , \"" + scs_crossfile_id + "\" , \"" + invocationId 
                                          + "\"  ),";
	}
	
	private void insertSCSCrossFile_File(int scs_crossfile_id, int fid,
			double tc, double pc, int invocationId) {
		INSERT_SCSCROSSFILE_FILE += "( \"" + scs_crossfile_id + "\" , \"" + fid
				+ "\" , \"" + tc + "\" , \"" + pc + "\" , \"" + invocationId + "\"  ),";
	}
	

}