package dssd.invoker;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
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
	
	private static String INSERT_FCS_INDIR = "INSERT INTO fcs_withindir(invocation_id,fcs_indir_id, members,directory_id) values ";
	private static String INSERT_FCSINDIR_FCC = "INSERT INTO fcs_withindir_fcc(invocation_id,fcs_indir_id, fcc_id) values ";
	private static String INSERT_FCSINDIR_FILES = "INSERT INTO fcs_withindir_files(invocation_id,fcs_indir_id,fcc_id,fcsindir_instance_id,fid) values ";
	private static String INSERT_FCS_CROSSDIR = "INSERT INTO fcs_crossdir(invocation_id,fcs_crossdir_id, members,directory_id) values ";
	private static String INSERT_FCSCROSSDIR_FILES = "INSERT INTO fcs_crossdir_files(invocation_id,fcs_crossdir_id,fcc_id, directory_id,fid) values ";
	private static String INSERT_FCSCROSSDIR_FCC = "INSERT INTO fcs_crossdir_fcc(invocation_id,fcs_crossdir_id, fcc_id ) values ";
	private static String INSERT_FCS_INGROUP = "INSERT INTO fcs_withingroup(invocation_id,fcs_ingroup_id, members,group_id) values ";
	private static String INSERT_FCSINGROUP_FCC = "INSERT INTO fcs_withingroup_fcc(invocation_id,fcs_ingroup_id, fcc_id) values ";
	private static String INSERT_FCSINGROUP_FILES = "INSERT INTO fcs_withingroup_files(invocation_id,fcs_ingroup_id,fcc_id, fcsingroup_instance_id, fid) values";
	private static String INSERT_FCS_CROSSGROUP = "INSERT INTO fcs_crossgroup(invocation_id,fcs_crossgroup_id, members,group_id) values ";
	private static String INSERT_FCSCROSSGROUP_FILES = "INSERT INTO fcs_crossgroup_files(invocation_id,fcs_crossgroup_id,fcc_id,group_id, fid) values ";
	private static String INSERT_FCSCROSSGROUP_FCC = "INSERT INTO fcs_crossgroup_fcc(invocation_id,fcs_crossgroup_id, fcc_id ) values ";
	
        
        private static String INSERT_FCC = "INSERT INTO fcc(invocation_id, fcc_id, atc, apc, members) values ";
        private static String INSERT_FCC_INSTANCE = "INSERT INTO fcc_instance(invocation_id, fcc_instance_id, fcc_id, tc, pc, fid, did, gid) values ";
        private static String INSERT_FCC_DIR = "INSERT INTO fcc_by_directory(invocation_id, fcc_id, directory_id) values ";
        private static String INSERT_FCC_SCC = "INSERT INTO fcc_scc(invocation_id, scc_id, fcc_id) values ";
        private static String INSERT_FCC_GROUP = "INSERT INTO fcc_by_group(invocation_id, fcc_id, group_id) values ";
	
	
	private static String INSERT_MCC = "INSERT INTO mcc(mcc_id, atc, apc, invocation_id, members) values ";
	private static String INSERT_MCC_INSTANCE = "INSERT INTO mcc_instance(mcc_instance_id, mcc_id, mid, tc, pc, fid, did, gid, invocation_id) values ";
	private static String INSERT_MCC_SCC = "INSERT INTO mcc_scc(mcc_id, scc_id, invocation_id) values ";
	
	private static String INSERT_METHOD = "INSERT INTO method(mid, mname, tokens, startline, endline, invocation_id) values ";
	private static String INSERT_METHOD_FILE = "INSERT INTO method_file(mid, fid, startline, endline, invocation_id) values ";
	
	private static String INSERT_MCSCROSSFILE_METHODS = "INSERT INTO mcscrossfile_methods(mcs_crossfile_id, fid, mcc_id, mid, invocation_id) values ";
	private static String INSERT_MCSCROSSFILE_MCC = "INSERT INTO mcscrossfile_mcc(mcs_crossfile_id, mcc_id, invocation_id) values ";
	private static String INSERT_MCS_CROSSFILE = "INSERT INTO mcs_crossfile(mcs_crossfile_id, members, invocation_id) values ";
	private static String INSERT_MCSCROSSFILE_FILE = "INSERT INTO mcscrossfile_file(mcs_crossfile_id, fid, did, gid, invocation_id) values ";
		
	private static String INSERT_SCSCROSSMETHOD_SCC = "INSERT INTO scscrossmethod_scc(scs_crossmethod_id, scc_id, invocation_id) values ";
	private static String INSERT_SCSCROSSMETHOD_METHOD = "INSERT INTO scscrossmethod_method(scs_crossmethod_id, mid, tc, pc, fid, did, gid, invocation_id) values ";
	private static String INSERT_SCS_CROSSMETHOD = "INSERT INTO scs_crossmethod(scs_crossmethod_id, atc, apc, members, invocation_id) values ";
	private static String INSERT_MCC_FILE = "INSERT INTO mcc_file(mcc_id, fid, invocation_id) values ";
		
	private static String INSERT_SCC_METHOD = "INSERT INTO scc_method(scc_id, mid, invocation_id) values ";
	
	public DBLoaderFromTextFiles(){
		databaseName = CMProperties.getDatabaseName();
	}
		
	public void populateCMDirectoryIDs(Integer invokId) throws IOException{

		filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_INFO_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;

		File file3 = new File(filePath);

		FileInputStream filein3 = new FileInputStream(file3);

		BufferedReader stdin3 = new BufferedReader(new InputStreamReader(

				filein3));

		///changed by Danish, i added invokID as argument thus calling the overloaded function.

		int size = getFileSize(invokId);

		for (int i = 0; i < size; i++) {

			line = stdin3.readLine();

			if(line != null){

				st = new StringTokenizer(line, ",");

				st.nextToken();

				int tempId = new Integer(st.nextToken().trim()).intValue();

				int length = new Integer(st.nextToken().trim()).intValue();

				Database.getInstance().executeTransaction("UPDATE invocation_files SET cmdirectory_id=\"" + tempId + "\" WHERE cmfile_id=\"" + i + "\" AND invocation_id=\"" + invokId+"\";");

			}

		}

	}
	
	@Override
	public boolean loadDBFromFiles() {
		try{
			String filePath = "";
			String filePath_infilestructures = "";

			filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_INFO_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;
			File file3 = new File(filePath);
			FileInputStream filein3 = new FileInputStream(file3);
			BufferedReader stdin3 = new BufferedReader(new InputStreamReader(
					filein3));
			int size = getFileSize(invocationId);
			for (int i = 0; i < size; i++) {
				line = stdin3.readLine();
				if(line != null){
					st = new StringTokenizer(line, ",");
					st.nextToken();
					int tempId = new Integer(st.nextToken().trim()).intValue();
					int length = new Integer(st.nextToken().trim()).intValue();
					Database.getInstance().executeTransaction("UPDATE invocation_files SET cmdirectory_id=" + tempId + " WHERE cmfile_id=" + i + " AND invocation_id=" + invocationId + ";");
				}
			}
			
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
				Database.getInstance().executeTransaction(INSERT_SCC);
			}
			if (!INSERT_SCC_INSTANCE
					.equalsIgnoreCase("INSERT INTO scc_instance(scc_instance_id, scc_id, fid, startline, startcol, endline, endcol, invocation_id) values ")) {
				Database.getInstance().executeTransaction(INSERT_SCC_INSTANCE);
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
			size = 0;
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
				Database.getInstance().executeTransaction(INSERT_SCSINFILE_SCC);
			}			
			if (!INSERT_SCSINFILE_FILE
					.equalsIgnoreCase("INSERT INTO scsinfile_file(scs_infile_id,invocation_id, fid, members) values ")) {
				Database.getInstance().executeTransaction(INSERT_SCSINFILE_FILE);
			}
			if (!INSERT_SCSINFILE_FRAGMENTS
					.equalsIgnoreCase("INSERT INTO scsinfile_fragments(scs_infile_id, fid, scc_id, scsinfile_instance_id, scc_instance_id, invocation_id) values ")) {
				Database.getInstance().executeTransaction(INSERT_SCSINFILE_FRAGMENTS);
			}

			filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.METHOD_INFO_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;
			
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
							Integer.parseInt(eLine), invocationId);
					insertMethod_File(Integer.parseInt(mid), Integer
							.parseInt(fid), Integer.parseInt(sLine),
							Integer.parseInt(eLine), invocationId);
				}
			}

			if (!INSERT_METHOD
					.equalsIgnoreCase("INSERT INTO method(mid, mname, tokens, startline, endline, invocation_id) values ")) {
				Database.getInstance().executeTransaction(INSERT_METHOD);
			}
			if (!INSERT_METHOD_FILE
					.equalsIgnoreCase("INSERT INTO method_file(mid, fid, startline, endline, invocation_id) values ")) {
				Database.getInstance().executeTransaction(INSERT_METHOD_FILE);
			}

			filein6.close();
			
			filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.CLONES_METHOD_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;
			File file7 = new File(filePath);
			FileInputStream filein7 = new FileInputStream(file7);
			BufferedReader stdin7 = new BufferedReader(
					new InputStreamReader(filein7));
			int methodPosn = 0;
			while ((line = stdin7.readLine()) != null) {
				if (!line.equalsIgnoreCase("")) {
					st = new StringTokenizer(line, ",");
					while (st.hasMoreTokens()) {
						String s1 = st.nextToken();
						if (!s1.equalsIgnoreCase("")) {
							insertSCC_Method(Integer.parseInt(s1),
									methodPosn, invocationId);
						}
					}
				}
				methodPosn++;
			}

			if (!INSERT_SCC_METHOD
					.equalsIgnoreCase("INSERT INTO scc_method(scc_id, mid, invocation_id) values ")) {
				Database.getInstance().executeTransaction(INSERT_SCC_METHOD);
			}

			double atc = 0;
			double apc = 0;

			if(InvokeService.sInvokeParameter.getMethod_analysis() == 1){
				filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.METHOD_CLUSTER_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;  
				File file8 = new File(filePath);
				FileInputStream filein8 = new FileInputStream(file8);
				BufferedReader stdin8 = new BufferedReader(
						new InputStreamReader(filein8));
				String temp2 = null;
				while ((line = stdin8.readLine()) != null) {
					if (!line.equalsIgnoreCase("")) {
						st = new StringTokenizer(line, ";");
						String mCid = st.nextToken().trim();
						int scs_crossmethod_id = Integer.parseInt(mCid);
						String mSupport = st.nextToken().trim();
						temp = stdin8.readLine();
						sccs = new Vector<String>();
						st2 = new StringTokenizer(temp, ",");
						while (st2.hasMoreTokens()) {
							temp2 = st2.nextToken();
							insertSCSCrossMethod_SCC(scs_crossmethod_id,
									Integer.parseInt(temp2), invocationId);
						}

						int mSup = (new Integer(mSupport)).intValue();
						atc = 0;
						apc = 0;
						for (int i = 0; i < mSup; i++) {
							line = stdin8.readLine();
							st1 = new StringTokenizer(line, ";,");
							mid = st1.nextToken().trim();
							String mTk = st1.nextToken().trim();
							String mCoverage = st1.nextToken().trim();
							atc += Double.parseDouble(mTk);
							apc += Double.parseDouble(mCoverage);
							mName = getMethodName(Integer.parseInt(mid));
							insertSCSCrossMethod_Method(scs_crossmethod_id,
									Integer.parseInt(mid), Double
									.parseDouble(mTk), Double
									.parseDouble(mCoverage), invocationId);
						}
						atc = atc / mSup;
						apc = apc / mSup;
						insertSCS_CrossMethod(scs_crossmethod_id, atc, apc,
								mSup, invocationId);
					}
				}

				if (!INSERT_SCSCROSSMETHOD_METHOD
						.equalsIgnoreCase("INSERT INTO scscrossmethod_method(scs_crossmethod_id, mid, tc, pc, fid, did, gid) values ")) {
					Database.getInstance().executeTransaction(INSERT_SCSCROSSMETHOD_METHOD);
				}
				if (!INSERT_SCSCROSSMETHOD_SCC
						.equalsIgnoreCase("INSERT INTO scscrossmethod_scc(scs_crossmethod_id, scc_id) values ")) {
					Database.getInstance().executeTransaction(INSERT_SCSCROSSMETHOD_SCC);
				}
				if (!INSERT_SCS_CROSSMETHOD
						.equalsIgnoreCase("INSERT INTO scs_crossmethod(scs_crossmethod_id, atc, apc, members) values ")) {
					Database.getInstance().executeTransaction(INSERT_SCS_CROSSMETHOD);
				}
			}
			
			if(InvokeService.sInvokeParameter.getMethod_analysis() == 1){

				filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.METHOD_CLUSTER_XX_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;
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
									.parseDouble(mCoverage), invocationId);

							
						}
						atc = atc / mSup;
						apc = apc / mSup;
						for (int i = 0; i < sccs.size(); i++) {
							insertMCC_SCC(mcc_id, Integer.parseInt(sccs.get(i)), invocationId);
						}
						insertMCC(mcc_id, atc, apc, invocationId, mSup);
					}
				}

				if (!INSERT_MCC.equalsIgnoreCase("INSERT INTO mcc(mcc_id, atc, apc, invocation_id, members) values ")) {
					System.out.println("\nINSERT_MCC: " + INSERT_MCC);
					Database.getInstance().executeTransaction(INSERT_MCC);
				}
				if (!INSERT_MCC_INSTANCE.equalsIgnoreCase("INSERT INTO mcc_instance(mcc_instance_id, mcc_id, mid, tc, pc, fid, did, gid, invocation_id) values ")) {
					System.out.println("\nINSERT_MCC_INSTANCE: " + INSERT_MCC_INSTANCE);
					Database.getInstance().executeTransaction(INSERT_MCC_INSTANCE);
				}
				if (!INSERT_MCC_SCC.equalsIgnoreCase("INSERT INTO mcc_scc(mcc_id, scc_id, invocation_id) values ")) {
					System.out.println("\nINSERT_MCC_SCC: " + INSERT_MCC_SCC);
					Database.getInstance().executeTransaction(INSERT_MCC_SCC);
				}

			}
			
			if(InvokeService.sInvokeParameter.getMethod_analysis() == 1){

				filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.METHOD_CLONES_BY_FILE_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;
				File file10 = new File(filePath);
				FileInputStream filein10 = new FileInputStream(file10);
				BufferedReader stdin10 = new BufferedReader(
						new InputStreamReader(filein10));

				int filePosn = 0;
				while ((line = stdin10.readLine()) != null) {
					if (!line.equalsIgnoreCase("")) {
						st = new StringTokenizer(line, ",");
						while (st.hasMoreTokens()) {
							String s2 = st.nextToken().trim();
							if (!s2.equalsIgnoreCase("")) {
								insertMCC_File(Integer.parseInt(s2), filePosn, invocationId);
							}
						}
					}
					filePosn++;
				}

				if (!INSERT_MCC_FILE
						.equalsIgnoreCase("INSERT INTO mcc_file(mcc_id, fid, invocation_id) values ")) {
					Database.getInstance().executeTransaction(INSERT_MCC_FILE);
				}
			}
			
			if(InvokeService.sInvokeParameter.getMethod_analysis() == 1){
				filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.METHOD_STRUCTURE_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;
				File file11 = new File(filePath);
				FileInputStream filein11 = new FileInputStream(file11);
				BufferedReader stdin11 = new BufferedReader(
						new InputStreamReader(filein11));
				Vector<String> mccs = null;
				int mccId;
				while ((line = stdin11.readLine()) != null) {
					if (!line.equalsIgnoreCase("")) {
						st = new StringTokenizer(line);
						String sid = st.nextToken().trim();
						int mcs_crossfile_id = Integer.parseInt(sid);
						String number = st.nextToken().trim();
						int nm = Integer.parseInt(number);
						insertMCS_CrossFile(mcs_crossfile_id, nm, invocationId);
						line = stdin11.readLine();
						st1 = new StringTokenizer(line, ",");
						size = st1.countTokens();
						mccs = new Vector<String>();
						cluster_size = 0;
						String pre = "", temp1;
						for (int i = 0; i < size; i++) {
							temp1 = st1.nextToken();
							if (!pre.equalsIgnoreCase(temp1)) {
								mccs.add(temp1);
								cluster_size++;
							}
							insertMCSCrossFile_MCC(mcs_crossfile_id, Integer
									.parseInt(temp1), invocationId);
							pre = temp1;
						}
						for (int i = 0; i < nm; i++) {
							line = stdin11.readLine();
							line = stdin11.readLine();
							fId = Integer.parseInt(line.trim());
							insertMCSCrossFile_File(mcs_crossfile_id, fId, invocationId);
							for (int j = 0; j < cluster_size; j++) {
								mccId = Integer.parseInt(mccs.get(j).trim());
								line = stdin11.readLine();
								st2 = new StringTokenizer(line, ",");
								while (st2.hasMoreTokens()) {
									mid = st2.nextToken();
									insertMCSCrossFile_Methods(
											mcs_crossfile_id, fId, mccId,
											Integer.parseInt(mid), invocationId);
								}
							}
						}
						line = stdin11.readLine();
					}
				}

				if (!INSERT_MCS_CROSSFILE
						.equalsIgnoreCase("INSERT INTO mcs_crossfile(mcs_crossfile_id, members, invocation_id) values ")) {
					Database.getInstance().executeTransaction(INSERT_MCS_CROSSFILE);
				}
				if (!INSERT_MCSCROSSFILE_MCC
						.equalsIgnoreCase("INSERT INTO mcscrossfile_mcc(mcs_crossfile_id, mcc_id, invocation_id) values ")) {
					Database.getInstance().executeTransaction(INSERT_MCSCROSSFILE_MCC);
				}
				if (!INSERT_MCSCROSSFILE_FILE
						.equalsIgnoreCase("INSERT INTO mcscrossfile_file(mcs_crossfile_id, fid, did, gid, invocation_id) values ")) {
					Database.getInstance().executeTransaction(INSERT_MCSCROSSFILE_FILE);
				}
				if (!INSERT_MCSCROSSFILE_METHODS
						.equalsIgnoreCase("INSERT INTO mcscrossfile_methods(mcs_crossfile_id, fid, mcc_id, mid, invocation_id) values ")) {
					Database.getInstance().executeTransaction(INSERT_MCSCROSSFILE_METHODS);
				}
			}
                        
                        parse_file_clusters(invocationId);
                        
                        Parse_FileClustersXX(invocationId);
                        Parse_InGroupCloneFileStructures(invocationId);
                        
                        	
			parse_InDirs_CloneFileStructures(invocationId);
			Parse_CrossDirsCloneFileStructuresEx(invocationId);			
			Parse_CrossGroupsCloneFileStructuresEx(invocationId);
                        parseFileCloneByDirs(invocationId);
                        parseFileCloneByGroups(invocationId);;
		} catch(Exception e){
			e.printStackTrace();
			return false;
		}
		
		return true;
	} //function end bracket

	public void insertSCC_Method(int scc_id, int mid, int pInvocationId) {
		INSERT_SCC_METHOD += "( \"" + scc_id + "\" , \"" + mid + "\",\"" + pInvocationId + "\" ),";
	}
	
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
		
		Database.getInstance().executeTransaction(query);
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
			Database.getInstance().executeTransaction(INSERT_SCSCROSSFILE_SCC);
		}
		if (!INSERT_SCSCROSSFILE_FILE
				.equalsIgnoreCase("INSERT INTO scscrossfile_file(scs_crossfile_id, fid, tc, pc, invocation_id) values ")) {
			Database.getInstance().executeTransaction(INSERT_SCSCROSSFILE_FILE);
		}
		if (!INSERT_SCS_CROSSFILE
				.equalsIgnoreCase("INSERT INTO scs_crossfile(scs_crossfile_id, invocation_id, atc, apc, members) values ")) {
			Database.getInstance().executeTransaction(INSERT_SCS_CROSSFILE);
		}
	}
	
	/////Team1 Parsing////////
	private void parse_InDirs_CloneFileStructures(int invocation_id )throws FileNotFoundException, IOException
    {
    	String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.IN_DIR_STRUCTURE+ Constants.CM_TEXT_FILE_EXTENSION; 
    	File file3 = new File(filePath);
    	FileInputStream filein14 = new FileInputStream(file3);
		BufferedReader stdin14 = new BufferedReader(new InputStreamReader(filein14));
		String temp = null;
		int count = 0;
		int count0 = 0;
		int count1 = 0;
                int fccId = -1;
		Vector<String>fccs = null;
		int size = getDirectorySize(invocation_id);
		int fileSize = 0;                
		for (int i = 0; i < size; i++) {
			line = stdin14.readLine();
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line, "()");
				int loop = st.countTokens() / 2;
				for (int j = 0; j < loop; j++) {
					int inst = (new Integer(st.nextToken())).intValue();
					String pat = st.nextToken();
					StringTokenizer stPat = new StringTokenizer(pat, ",");
					int cluster_size = 0;
					String pre = "";
					fccs = new Vector<String>();
					while (stPat.hasMoreTokens()) {
						temp = stPat.nextToken();
						if (!pre.equalsIgnoreCase(temp)) {
							fccs.add(temp);
							cluster_size++;
						}
						insertFCSInDir_FCC(invocation_id,count, Integer.parseInt(temp));
						pre = temp;
					}

					Vector<String> files = null;
                                        files = new Vector<String>();                               
					int dId = count0;
					dId = count0;
					for (int k = 0; k < cluster_size; k++) {
                                          fccId = Integer.parseInt(fccs.get(k));
                                          files = getFCSInDir_Files(invocation_id, dId, fccId);
                                          if (files != null) {
                                            fileSize = files.size();
                                            count1 = 0;
                                            for (int n = 0; n < inst; n++) {
                                              for (int q = 0; q < fileSize / inst; q++) {
                                                insertFCSInDir_Files(invocation_id, count, fccId, n, Integer.parseInt(files.get(count1)));
                                                count1++;
                                              }
                                            }
                                          }
					}
					insertFCS_InDir(invocation_id,count, inst,count0);
					//insertFCSInDir_Dir(count, count0);
					count++;
				}
			}
			count0++;
		}
		
		
		
		
		if (!INSERT_FCS_INDIR
				.equalsIgnoreCase("INSERT INTO fcs_withindir(invocation_id,fcs_indir_id, members,directory_id) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCS_INDIR);
		}
		
		if (!INSERT_FCSINDIR_FCC
				.equalsIgnoreCase("INSERT INTO fcs_withindir_fcc(invocation_id,fcs_indir_id, fcc_id) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCSINDIR_FCC);
		}
		
		if (!INSERT_FCSINDIR_FILES
				.equalsIgnoreCase("INSERT INTO fcs_withindir_files(invocation_id,fcs_ingroup_id,fcc_id, fcsingroup_instance_id, fid) values")) {
			Database.getInstance().executeTransaction(INSERT_FCSINDIR_FILES);
		}

    	
    	
    }
    ///Above file Completed////
	
	private void Parse_FileClustersXX(int invocation_id)throws FileNotFoundException, IOException{    	
          String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_CLUSTER_XX+ Constants.CM_TEXT_FILE_EXTENSION; 
          File file4 = new File(filePath);		
          FileInputStream filein4 = new FileInputStream(file4);
          BufferedReader stdin4 = new BufferedReader(new InputStreamReader(filein4));
          while ((line = stdin4.readLine()) != null) {
            if (!line.equalsIgnoreCase("")) {
              st = new StringTokenizer(line, ";");
              String cid = st.nextToken();
              int fcc_id = Integer.parseInt(cid);
              String support = st.nextToken();
              String sccs = stdin4.readLine();
              st2 = new StringTokenizer(sccs, ",");
              Vector<String> sccVector = new Vector<String>();
              while (st2.hasMoreTokens()) {
                sccVector.add(st2.nextToken());
              }
              for (int i = 0; i < sccVector.size(); i++) {
                insertFCC_SCC(invocation_id, Integer.parseInt(sccVector.get(i)), fcc_id);
              }
              int sup = (new Integer(support)).intValue();
              double atc = 0;
              double apc = 0;
              for (int i = 0; i < sup; i++) {
                line = stdin4.readLine();
                st1 = new StringTokenizer(line, ";,");
                fid = st1.nextToken();
                String tk = st1.nextToken();
                String coverage = st1.nextToken();
		atc += Double.parseDouble(tk);
		apc += Double.parseDouble(coverage);
		insertFCC_Instance(invocation_id, i, fcc_id, Integer.parseInt(fid), Double.parseDouble(tk), Double.parseDouble(coverage));
              }
              atc = atc / sup;
              apc = apc / sup;
              insertFCC(invocation_id, fcc_id, atc, apc, sup);
            }
          }
          
          if (!INSERT_FCC_SCC.equalsIgnoreCase("INSERT INTO fcc_scc(invocation_id, scc_id, fcc_id) values ")) {
            Database.getInstance().executeTransaction(INSERT_FCC_SCC);
          }
          
          if (!INSERT_FCC_INSTANCE.equalsIgnoreCase("INSERT INTO fcc_instance(invocation_id, fcc_instance_id, fcc_id, tc, pc, fid, did, gid) values ")) {
            Database.getInstance().executeTransaction(INSERT_FCC_INSTANCE);
          }
          
          if (!INSERT_FCC.equalsIgnoreCase("INSERT INTO fcc(invocation_id, fcc_id, atc, apc, members) values ")) {
            Database.getInstance().executeTransaction(INSERT_FCC);
          }
	
    }

    ///Above File Completed////
	
	private void Parse_CrossDirsCloneFileStructuresEx(int invocation_id)throws FileNotFoundException, IOException
    {
    	String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.CROSS_DIR_FILE_EX+ Constants.CM_TEXT_FILE_EXTENSION;  
		File file3 = new File(filePath);
		FileInputStream filein13 = new FileInputStream(file3);
		BufferedReader stdin13 = new BufferedReader(new InputStreamReader(
				filein13));
		int fccId;
		int dId = -1;
		Vector<String> fccs = null;
		while ((line = stdin13.readLine()) != null) {
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line);
				String sid = st.nextToken();
				String number = st.nextToken();
				int nm = Integer.parseInt(number);
				line = stdin13.readLine();
				st1 = new StringTokenizer(line, ",");
				int size = st1.countTokens();
				fccs = new Vector<String>();
				int cluster_size = 0;
				String pre = "", temp1;
				for (int i = 0; i < size; i++) {
					temp1 = st1.nextToken();
					if (!pre.equalsIgnoreCase(temp1)) {
						fccs.add(temp1);
						cluster_size++;
					}
					insertFCSCrossDir_FCC(invocation_id,Integer.parseInt(sid), Integer
							.parseInt(temp1));
					pre = temp1;
				}
				for (int i = 0; i < nm; i++) {
					line = stdin13.readLine();
					line = stdin13.readLine();
					 dId = Integer.parseInt(line.trim());
					//insertFCSCrossDir_Dir(Integer.parseInt(sid), dId);
					for (int j = 0; j < cluster_size; j++) {
						fccId = Integer.parseInt(fccs.get(j).trim());
						line = stdin13.readLine();
						st2 = new StringTokenizer(line, ",");
						while (st2.hasMoreTokens()) {
							fid = st2.nextToken();
							insertFCSCrossDir_Files(invocation_id,Integer.parseInt(sid),
									dId, fccId, Integer.parseInt(fid));
						}
					}
				}
				line = stdin13.readLine();
				insertFCS_CrossDir(invocation_id,Integer.parseInt(sid), nm,dId);
			}
		}

		
		
		if (!INSERT_FCSCROSSDIR_FCC
				.equalsIgnoreCase("INSERT INTO fcs_crossdir_fcc(invocation_id,fcs_crossdir_id, fcc_id ) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCSCROSSDIR_FCC);
		}
		
		if (!INSERT_FCSCROSSDIR_FILES
				.equalsIgnoreCase("INSERT INTO fcs_crossdir_files(invocation_id,fcs_crossdir_id,fcc_id, directory_id,fid) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCSCROSSDIR_FILES);
		}
		if (!INSERT_FCS_CROSSDIR
				.equalsIgnoreCase("INSERT INTO fcs_crossdir(invocation_id,fcs_crossdir_id, members,directory_id) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCS_CROSSDIR);
		}
	
    }
    
/////Above file completed////
	

    private void Parse_InGroupCloneFileStructures(int invocation_id)throws FileNotFoundException, IOException
    {
    	String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.IN_GROUP_STRUCTURE+ Constants.CM_TEXT_FILE_EXTENSION;  
	File file17 = new File(filePath);
	FileInputStream filein17 = new FileInputStream(file17);
	BufferedReader stdin17 = new BufferedReader(new InputStreamReader(filein17));
	String temp = null;
        int count = 0;
        int count0 = 0;
        int count1 = 0;
	int gId = -1;
	int fccId = -1;
	int fileSize = -1;
	Vector<String> fccs = null;
        int cluster_size = 0;        
	int size = getGroupSize(invocation_id);
	for (int i = 0; i < size; i++) {
          line = stdin17.readLine();
          if (!line.equalsIgnoreCase("")) {
            st = new StringTokenizer(line, "()");
            int loop = st.countTokens() / 2;
            for (int j = 0; j < loop; j++) {
              int inst = (new Integer(st.nextToken())).intValue();
              String pat = st.nextToken();
              StringTokenizer stPat = new StringTokenizer(pat, ",");
              cluster_size = 0;
              String pre = "";
              fccs = new Vector<String>();
              while (stPat.hasMoreTokens()) {
                temp = stPat.nextToken();
		if (!pre.equalsIgnoreCase(temp)) {
                  fccs.add(temp);
                  cluster_size++;
		}
		insertFCSInGroup_FCC(invocation_id, count, Integer.parseInt(temp));
		pre = temp;
              }
              Vector<String> files = null;
              gId = count0;
              for (int k = 0; k < cluster_size; k++) {
                fccId = Integer.parseInt(fccs.get(k));
                files = getFCSInGroup_Files(invocation_id, gId, fccId);
                if (files != null) {
                  fileSize = files.size();
                  count1 = 0;
                  for (int n = 0; n < inst; n++) {
                    for (int q = 0; q < fileSize / inst; q++) {
                      insertFCSInGroup_Files(invocation_id, count, fccId, n, Integer.parseInt(files.get(count1)));
                      count1++;
                    }
                  }
                }
              }
              insertFCS_InGroup(invocation_id, count, inst, count0);              
              count++;
            }
          }
          count0++;
	}

		if (!INSERT_FCS_INGROUP
				.equalsIgnoreCase("INSERT INTO fcs_withingroup(invocation_id,fcs_ingroup_id, members,group_id) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCS_INGROUP);
		}
		
		if (!INSERT_FCSINGROUP_FCC
				.equalsIgnoreCase("INSERT INTO fcs_withingroup_fcc(invocation_id,fcs_ingroup_id, fcc_id) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCSINGROUP_FCC);
		}
		
		if (!INSERT_FCSINGROUP_FILES
				.equalsIgnoreCase("INSERT INTO fcs_withingroup_files(fcs_ingroup_id, gid, fcc_id, fcsingroup_instance_id, fid) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCSINGROUP_FILES);
		}
	
    	
    	
    	
    	
    }
 ////Above File Completed////////////
	

	private void Parse_CrossGroupsCloneFileStructuresEx(int invocation_id)throws FileNotFoundException, IOException
    {
    	String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_STRUCTURE_CROSS_GROUP+ Constants.CM_TEXT_FILE_EXTENSION;
    	File file6 = new File(filePath);
		FileInputStream filein16 = new FileInputStream(file6);
		BufferedReader stdin16 = new BufferedReader(new InputStreamReader(filein16));
		Vector<String> fccs = null;
		int gId = -1;
		int fccId= -1;
		while ((line = stdin16.readLine()) != null) {
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line);
				String sid = st.nextToken();
				String number = st.nextToken();
				int nm = Integer.parseInt(number);
				line = stdin16.readLine();
				st1 = new StringTokenizer(line, ",");
				int size = st1.countTokens();
				fccs = new Vector<String>();
				int cluster_size = 0;
				String pre = "", temp1;
				for (int i = 0; i < size; i++) {
					temp1 = st1.nextToken();
					if (!pre.equalsIgnoreCase(temp1)) {
						fccs.add(temp1);
						cluster_size++;
					}
					insertFCSCrossGroup_FCC(invocation_id,Integer.parseInt(sid), Integer.parseInt(temp1));
					pre = temp1;
				}
				for (int i = 0; i < nm; i++) {
					line = stdin16.readLine();
					line = stdin16.readLine();
					gId = Integer.parseInt(line.trim());
					//insertFCSCrossGroup_Group(Integer.parseInt(sid), gId);
					for (int j = 0; j < cluster_size; j++) {
						fccId = Integer.parseInt(fccs.get(j).trim());
						line = stdin16.readLine();
						st2 = new StringTokenizer(line, ",");
						while (st2.hasMoreTokens()) {
							fid = st2.nextToken();
							insertFCSCrossGroup_Files(
									invocation_id,Integer.parseInt(sid), gId, fccId,
									Integer.parseInt(fid));
						}
					}
				}
				line = stdin16.readLine();
				insertFCS_CrossGroup(invocation_id,Integer.parseInt(sid), nm,gId);
			}
		}

		
		
		if (!INSERT_FCSCROSSGROUP_FCC
				.equalsIgnoreCase("INSERT INTO fcs_crossgroup(invocation_id,fcs_crossgroup_id, members,group_id) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCSCROSSGROUP_FCC);
		}
		
		if (!INSERT_FCSCROSSGROUP_FILES
				.equalsIgnoreCase("INSERT INTO fcscrossgroup_files(invocation_id,fcs_crossgroup_id,fcc_id,group_id, fid) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCSCROSSGROUP_FILES);
		}
		if (!INSERT_FCS_CROSSGROUP
				.equalsIgnoreCase("INSERT INTO fcscrossgroup_fcc(invocation_id,fcs_crossgroup_id, fcc_id ) values ")) {
			Database.getInstance().executeTransaction(INSERT_FCS_CROSSGROUP);
		}	
    }
    	
    public void parseFileCloneByGroups(int invocation_id) throws FileNotFoundException, IOException
    {
        String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_CLONES_BY_GROUPS+ Constants.CM_TEXT_FILE_EXTENSION;
        File file18 = new File(filePath);
	FileInputStream filein18 = new FileInputStream(file18);
	BufferedReader stdin18 = new BufferedReader(new InputStreamReader(filein18));
	int groupPosn = 0;
        while ((line = stdin18.readLine()) != null) {
            if (!line.equalsIgnoreCase("")) {
                st = new StringTokenizer(line, ",");
                    while (st.hasMoreTokens()) {
                        String s2 = st.nextToken().trim();
                        if (!s2.equalsIgnoreCase("")) {
                            insertFCC_Group(invocation_id, Integer.parseInt(s2), groupPosn);
			}
                    }
		}
		groupPosn++;
            }

            if (!INSERT_FCC_GROUP.equalsIgnoreCase("INSERT INTO fcc_group(fcc_id, gid) values ")) {
                Database.getInstance().executeTransaction(INSERT_FCC_GROUP);
            }
    }
        
    public void parseFileCloneByDirs(int invocation_id)throws FileNotFoundException, IOException
    {
           
            String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_CLONES_BY_DIR+ Constants.CM_TEXT_FILE_EXTENSION;
            File file15 = new File(filePath);
            FileInputStream filein15 = new FileInputStream(file15);
            BufferedReader stdin15 = new BufferedReader(new InputStreamReader(filein15));
			int dirPosn = 0;
			while ((line = stdin15.readLine()) != null) {
				if (!line.equalsIgnoreCase("")) {
					st = new StringTokenizer(line, ",");
					while (st.hasMoreTokens()) {
						String s2 = st.nextToken().trim();
						if (!s2.equalsIgnoreCase("")) {
							insertFCC_Dir(invocation_id,Integer.parseInt(s2), dirPosn);
						}
					}
				}
				dirPosn++;
			}
                      int aaa=0;

			if (!INSERT_FCC_DIR.equalsIgnoreCase("INSERT INTO fcc_by_directory(invocation_id, fcc_id, directory_id) values ")) {
                            Database.getInstance().executeTransaction(INSERT_FCC_DIR);
			}
            
        }
        
        
        
        
	
	
	
	
	
	
	
	
	public void insertMethod_File(int mid, int fid, int startline, int endline, int pInvocationId) {
		INSERT_METHOD_FILE += "( \"" + mid + "\" , \"" + fid + "\", \""
				+ startline + "\", \"" + endline + "\",\"" + pInvocationId + "\"),";
	}
	
	/* Methods for insert data into the database using SQL Statements */
	public void insertMethod(int mid, String mname, int tokens, int startline,
			int endline, int pInvocationId) {
		INSERT_METHOD += "( \"" + mid + "\" , \"" + mname + "\", \"" + tokens
				+ "\", \"" + startline + "\", \"" + endline + "\",\"" + pInvocationId + "\"),";
	}

	
	public void insertMCC(int mcc_id, double atc, double apc, int pInvocationId, int members) {
		INSERT_MCC += "( \"" + mcc_id + "\" , \"" + atc + "\", \"" + apc
				+ "\", \"" + pInvocationId + "\",\"" + members + "\"  ),";
	}
	
	public void insertMCC_Instance(int mcc_instance_id, int mcc_id, int mid,
			double tc, double pc, int pInvocationId) {
		
		int fid = getFidFromMid(mid);
		INSERT_MCC_INSTANCE += "( \"" + mcc_instance_id + "\" , \"" + mcc_id
				+ "\", \"" + mid + "\", \"" + tc + "\", \"" + pc + "\", \""
				+ fid + "\", \"" + getDidFromFid(fid) + "\", \""
				+ getGidFromFid(fid) + "\", \"" + pInvocationId + "\"),";
	}
	
	public int getGidFromFid(int fid) {
		int gid = -1;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select group_id"
					+ " from invocation_files " + "where cmfile_id=\"" + fid + "\" AND invocation_id=\"" + invocationId + "\";");
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
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select file_id"
					+ " from invocation_files " + " where cmfile_id=\"" + pFid + "\" AND invocation_id=\"" + invocationId + "\";");
			if (results.next()) {
				fid = results.getInt(1);
			}
			
			results = s.executeQuery("select directory_id"
					+ " from repository_file " + "where id=\"" + fid + "\";");
			if (results.next()) {
				did = results.getInt(1);
			}

			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

		return did;
	}
	
	public void insertMCC_SCC(int mcc_id, int scc_id, int pInvocationId) {
		INSERT_MCC_SCC += "( \"" + mcc_id + "\" , \"" + scc_id + "\",\"" + pInvocationId + "\"),";
	}
	
	public int getFidFromMid(int mid) {
		int fid = -1;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select fid "
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
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
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
			Statement st = Database.getInstance().getDBConn().createStatement();
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
        
        public Vector<String> getFCSInGroup_Files(int invocation_id, int gid, int fcc_id) {
		Vector<String> list = null;
		String fid = null;

		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select distinct fid "
							+ " from fcc_instance "
							+ " where gid = " + gid
                                                        + " and invocation_id = " + invocation_id
							+ " and fcc_id = " + fcc_id + ";");
			list = new Vector<String>();
			while (results.next()) {
				fid = results.getString("fid");
				list.add(fid);
			}

			s.close();
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e.getMessage());
		}

		return list;
	}
        
        public Vector<String> getFCSInDir_Files(int invocation_id, int did, int fcc_id) {
		Vector<String> list = null;
		String fid = null;

		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s
					.executeQuery("select distinct fid "
							+ "from fcc_instance "
							+ "where did = " + did
                                                        + "and invocation_id = " + invocation_id
							+ " and fcc_id = " + fcc_id + ";");
			list = new Vector<String>();
			while (results.next()) {
				fid = results.getString("fid");
				list.add(fid);
			}

			s.close();
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e.getMessage());
		}

		return list;
	}
        
	private String getFileName(int fid) {
		String fileName = null;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
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
	
	
	public int getDirectorySize(int invocation_id) {
		int size = -1;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s
					.executeQuery("select count(distinct(cmdirectory_id)) from invocation_files where invocation_id = " + invocation_id + ";");
			if (results.next()) {
				size = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return size;
	}
	
	public int getDidFromFid(int invocation_id,int fid) {
		
		int did = -1;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select cmdirectory_id from invocation_files where cmfile_id = " + fid + " and invocation_id = "+invocation_id+";");
			if (results.next()) {
				did = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

		return did;
	
	}
	
	public int getFileSize(Integer invocationId) {
		int size = -1;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
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

	
	public int getGidFromFid(int invocation_id,int fid) {
		int gid = -1;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select group_id "
					+ " from invocation_files " + " where cmfile_id = " + fid + " and invocation_id = " +invocation_id+ ";");
			if (results.next()) {
				gid = results.getInt(1);
                                if (gid > 0){
                                  //gid = gid - 1;
                                } 
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

		return gid;
	}
    
	/*
	 * Returns the size of the input file list
	 */
	
	public int getFileSize(int invocation_id) {
		int size = -1;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");			
                        ResultSet results = s.executeQuery("select count(*) from invocation_files where invocation_id = " + invocation_id + ";");
			if (results.next()) {
				size = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return size;
	}
	
	
	public int getGroupSize(int invocation_id) {
		int size = -1;
		try {
			Statement st = Database.getInstance().getDBConn().createStatement();
			st.execute("use "+databaseName+";");
			ResultSet results = st
					.executeQuery("select count(distinct group_id)from invocation_files where invocation_id = " + invocation_id + ";");
			if (results.next()) {
				size = results.getInt(1);
			}
			st.close();
		} catch (Exception e) {
			System.err.println(e.getMessage());
			e.printStackTrace();
		}
		return size;
	}

	public Vector<String> getFCC_InstanceData(int invocation_id) {
		Vector<String> list = null;
		String fid = null;
                String gid = null;
                String fcc_id = null;
                String did = null;
                
                String Data = null;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use "+databaseName+";");
			ResultSet results = s.executeQuery("select distinct fid, gid, did, fcc_id from fcc_instance where invocation_id = " + invocation_id + ";");
			list = new Vector<String>();
			while (results.next()) {
				fid = results.getString("fid");
                                gid = results.getString("gid");
                                fcc_id = results.getString("fcc_id");
				did = results.getString("did");
                                
                                Data = fid + "||" +  gid  + "||" + fcc_id + "||" + did;
                                list.add(Data);
			}

			s.close();
		} catch (Exception e) {
			e.printStackTrace();
			System.err.println(e.getMessage());
		}

		return list;
	}			
	
	
	private Vector<String> getSCS_Fragments(int cid, int scc_id, int type) {
		Vector<String> list = null;
		String frag = null;

		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
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
	
	public void insertFCSCrossDir_FCC(int invocation_id,int fcs_crossdir_id, int fcc_id) {
		INSERT_FCSCROSSDIR_FCC += "( \"" + invocation_id + "\",\"" + fcs_crossdir_id + "\" , \"" + fcc_id
				+ "\"  ),";
	}
	
	public void insertFCSCrossDir_Files(int invocation_id,int fcs_crossdir_id, int did,
			int fcc_id, int fid) {
		INSERT_FCSCROSSDIR_FILES += "( \"" + invocation_id + "\",\"" + fcs_crossdir_id + "\" , \"" + fcc_id
				+ "\" , \"" + did + "\" , \"" + fid + "\" ),";
	}
	
	public void insertFCS_CrossDir(int invocation_id,int fcs_crossdir_id, int members,int did) {
		INSERT_FCS_CROSSDIR += "( \"" + invocation_id + "\",\"" + fcs_crossdir_id + "\", \"" + members
				+ "\",\"" + did + "\"  ),";
	}
	
	public void insertFCSInDir_Files(int invocation_id,int fcs_indir_id,int fcc_id,
			int fcsindir_instance_id, int fid) {
		INSERT_FCSINDIR_FILES += "( \"" + invocation_id + "\",\"" + fcs_indir_id + "\" , \"" + fcc_id + "\" ,\"" + fcsindir_instance_id
				+ "\" , \"" + fid + "\"  ),";
	}

	
	private void insertFCSInDir_FCC(int invocation_id,int fcs_indir_id, int fcc_id) {
		INSERT_FCSINDIR_FCC += "( \"" + invocation_id + "\",\"" + fcs_indir_id + "\" , \"" + fcc_id
				+ "\"  ),";
	}

	public void insertFCS_InDir(int invocation_id,int fcs_indir_id, int members,int did) {
		INSERT_FCS_INDIR += "( \"" + invocation_id + "\",\"" + fcs_indir_id + "\" , \"" + members
				+ "\",\"" + did + "\"  ),";
	}
	
        public void insertFCC_SCC(int invocation_id, int scc_id, int fcc_id) {
		INSERT_FCC_SCC += "( \"" + invocation_id + "\" , \"" + scc_id + "\" , \"" + fcc_id + "\"  ),";
	}
        
	public void insertFCC_Instance(int invocation_id, int fcc_instance_id, int fcc_id, int fid,
			double tc, double pc) {
		INSERT_FCC_INSTANCE += "( \"" + invocation_id + "\",\"" + fcc_instance_id + "\" ,\"" + fcc_id
				+ "\" , \"" + tc + "\" , \"" + pc + "\" , \"" + fid + "\", \""
				+ getDidFromFid(invocation_id, fid) + "\" , \"" + getGidFromFid(invocation_id, fid)
				+ "\"  ),";
	}
        
        public void insertFCC(int invocation_id, int fcc_id, double atc, double apc, int members) {
		INSERT_FCC += "( \"" + invocation_id + "\", \"" + fcc_id + "\" , \"" + atc + "\", \"" + apc
				+ "\", \"" + members + "\"  ),";
	}
        
	public void insertMCSCrossFile_Methods(int mcs_crossfile_id, int fid,
			int mcc_id, int mid, int pInvocationId) {
		INSERT_MCSCROSSFILE_METHODS += "( \"" + mcs_crossfile_id + "\" , \""
				+ fid + "\", \"" + mcc_id + "\" , \"" + mid + "\",\"" + pInvocationId + "\"),";
	}
	

	public void insertFCSInGroup_FCC(int invocation_id,int fcs_ingroup_id, int fcc_id) {
		INSERT_FCSINGROUP_FCC += "(\"" + invocation_id + "\", \"" + fcs_ingroup_id + "\" , \"" + fcc_id
				+ "\"  ),";
	}

	public void insertFCSInGroup_Files(int invocation_id, int fcs_ingroup_id, int fcc_id, int fcsingroup_instance_id, int fid) {
		INSERT_FCSINGROUP_FILES += "(\"" + invocation_id + "\", \"" + fcs_ingroup_id + "\" , \"" + fcc_id + "\" ,\"" + fcsingroup_instance_id
				+ "\" , \"" + fid + "\"  ),";
	}

	public void insertFCS_InGroup(int invocation_id,int fcs_ingroup_id, int members,int gid) {
		INSERT_FCS_INGROUP += "( \"" + invocation_id + "\",\"" + fcs_ingroup_id + "\" , \"" + members
				+ "\",\"" + gid + "\"  ),";
	}
	
	public void insertFCSCrossGroup_FCC(int invocation_id,int fcs_crossgroup_id, int fcc_id) {
		INSERT_FCSCROSSGROUP_FCC += "( \"" +invocation_id + "\",\"" + fcs_crossgroup_id + "\" , \""
				+ fcc_id + "\"  ),";
	}
	
	public void insertFCSCrossGroup_Files(int invocation_id,int fcs_crossgroup_id, int gid,
			int fcc_id, int fid) {
		INSERT_FCSCROSSGROUP_FILES += "( \"" + invocation_id + "\",\"" + fcs_crossgroup_id + "\" , \""
				+ fcc_id + "\" , \"" + gid + "\" , \"" + fid + "\" ),";
	}

	
	public void insertFCS_CrossGroup(int invocation_id,int fcs_crossgroup_id, int members,int gid) {
		INSERT_FCS_CROSSGROUP += "( \"" + invocation_id + "\",\"" + fcs_crossgroup_id + "\", \""
				+ members + "\",\"" + gid+ "\"  ),";
	}


	public void insertMCS_CrossFile(int mcs_crossfile_id, int members, int pInvocationId) {
		INSERT_MCS_CROSSFILE += "( \"" + mcs_crossfile_id + "\" , \"" + members
				+ "\",\"" + pInvocationId + "\"),";
	}

	public void insertMCSCrossFile_MCC(int mcs_crossfile_id, int mcc_id, int pInvocationId) {
		INSERT_MCSCROSSFILE_MCC += "( \"" + mcs_crossfile_id + "\" , \""
				+ mcc_id + "\",\"" + pInvocationId + "\"),";
	}
	
	public void insertMCSCrossFile_File(int mcs_crossfile_id, int fid, int pInvocationId) {
		INSERT_MCSCROSSFILE_FILE += "( \"" + mcs_crossfile_id + "\" , \"" + fid
				+ "\", \"" + getDidFromFid(fid) + "\", \"" + getGidFromFid(fid)
				+ "\",\"" + pInvocationId + "\"),";
	}
	
	public void insertSCSCrossMethod_SCC(int scs_crossmethod_id, int scc_id, int pInvocationId) {
		INSERT_SCSCROSSMETHOD_SCC += "( \"" + scs_crossmethod_id + "\" , \""
				+ scc_id + "\",\"" + pInvocationId + "\"),";
	}
	
	public void insertSCSCrossMethod_Method(int scs_crossmethod_id, int mid,
			double tc, double pc, int pInvocationId) {
		int fid = getFidFromMid(mid);
		INSERT_SCSCROSSMETHOD_METHOD += "( \"" + scs_crossmethod_id + "\" , \""
				+ mid + "\" , \"" + tc + "\" , \"" + pc + "\", \"" + fid
				+ "\", \"" + getDidFromFid(fid) + "\" , \""
				+ getGidFromFid(fid) + "\",\"" + pInvocationId + "\"),";
	}
	
	public void insertSCS_CrossMethod(int scs_crossmethod_id, double atc,
			double apc, int members, int pInvocationId) {
		INSERT_SCS_CROSSMETHOD += "( \"" + scs_crossmethod_id + "\" , \"" + atc
				+ "\", \"" + apc + "\", \"" + members + "\",\"" + pInvocationId + "\"),";
	}
	
	public void insertMCC_File(int mcc_id, int fid, int pInvocationId) {
		INSERT_MCC_FILE += "( \"" + mcc_id + "\" , \"" + fid + "\",\"" + pInvocationId + "\"),";
	}

	public void insertFCC_Dir(int invocation_id,int fcc_id, int did) {
		INSERT_FCC_DIR += "(\"" + invocation_id + "\" , \"" + fcc_id + "\" , \"" + did + "\"  ),";
	}
        
        public void insertFCC_Group(int invocation_id, int fcc_id, int gid) {
		INSERT_FCC_GROUP += "( \"" + invocation_id + "\" , \"" + fcc_id + "\" , \"" + gid + "\"  ),";
	}




}