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

import dssd.invoker.adapter.OutputHelper;

public class DBLoaderFromTextFiles extends OutputHelper{

	StringTokenizer st, st1, st2;
	String line, id, l, m, fid, sl, sc, el, ec, filePath = null;
	String mid, mName, sLine, eLine, token;
	int num = 0, mId = -1;
	int dlm;
	private String databaseName ="";

	private static String INSERT_SCC_INSTANCE;	
	private static String INSERT_SCC;
	private static String INSERT_SCSINFILE_SCC;	
	private static String INSERT_SCSINFILE_FILE; 
	private static String INSERT_SCSINFILE_FRAGMENTS;
	private static String INSERT_SCSCROSSFILE_FILE;
	private static String INSERT_SCSCROSSFILE_SCC;
	private static String INSERT_SCS_CROSSFILE;
	
	public DBLoaderFromTextFiles(){
		initQuery();
		databaseName = CMProperties.getDatabaseName();
	}
	
	private static void initQuery() {
		
		
		INSERT_SCC = "INSERT INTO scc(scc_id, length, members, invocation_id) values ";		
		INSERT_SCC_INSTANCE = "INSERT INTO scc_instance(scc_instance_id, scc_id, fid, startline, startcol, endline, endcol, invocation_id) values ";
		INSERT_SCSINFILE_SCC = "INSERT INTO scsinfile_scc(scc_id, scs_infile_id, invocation_id) values ";		
		INSERT_SCSINFILE_FILE = "INSERT INTO scsinfile_file(scs_infile_id,invocation_id, fid, members) values ";
		INSERT_SCSINFILE_FRAGMENTS = "INSERT INTO scsinfile_fragments(scs_infile_id, fid, scc_id, scsinfile_instance_id, scc_instance_id, invocation_id) values ";
		INSERT_SCSCROSSFILE_FILE = "INSERT INTO scscrossfile_file(scs_crossfile_id, fid, tc, pc, invocation_id) values ";
		INSERT_SCSCROSSFILE_SCC = "INSERT INTO scscrossfile_scc(scc_id, scs_crossfile_id, invocation_id) values ";
		INSERT_SCS_CROSSFILE = "INSERT INTO scs_crossfile(scs_crossfile_id,invocation_id, atc, apc, members) values ";
	}
	
	@Override
	public boolean loadDBFromFiles() {
		try{
			String filePath = "";
			String filePath_infilestructures = "";

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
					.equalsIgnoreCase("INSERT INTO scc(scc_id, length, members, benefit) values ")) {
				Database.executeTransaction(INSERT_SCC);
			}
			if (!INSERT_SCC_INSTANCE
					.equalsIgnoreCase("INSERT INTO scc_instance(scc_instance_id, scc_id, fid, startline, startcol, endline, endcol, invocation_id) values ")) {
				Database.executeTransaction(INSERT_SCC_INSTANCE);
			}                                                

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

		} catch(Exception e){
			e.printStackTrace();
			return false;
		}
		
		return true;
	} //function end bracket

	//delete mid
	private void insertSCC_Instance(int scc_instance_id, int scc_id, int fid,
			int startline, int startcol, int endline, int endcol, int invocationId) {
		INSERT_SCC_INSTANCE += "( \"" + scc_instance_id + "\" , \"" + scc_id
		+ "\", \"" + fid + "\", \"" + startline + "\", \"" + startcol
		+ "\" , \"" + endline + "\", \"" + endcol  + "\" , \"" + invocationId + "\"),";
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
				.equalsIgnoreCase("INSERT INTO scs_crossfile(scs_crossfile_id, atc, apc, members) values ")) {
			Database.executeTransaction(INSERT_SCS_CROSSFILE);
		}

		
		
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