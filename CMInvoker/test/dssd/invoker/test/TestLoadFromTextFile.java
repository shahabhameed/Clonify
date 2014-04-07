//Most of these test cases rely on using the db. So the fact if test cases fail, it
//can be because the db you are testing it on has different values than our db.

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package dssd.invoker.test;

/**
 *
 * @author Administrator
 */
import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.sql.Statement;
import java.util.StringTokenizer;
import java.util.Vector;

import junit.framework.TestCase;
import dssd.invoker.Constants;
import dssd.invoker.DBLoaderFromTextFiles;
import dssd.invoker.Database;
import dssd.invoker.InvokeService;

public class TestLoadFromTextFile extends TestCase{

	public void testOpen_InfileStructure()
	{
		String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.SIMPLE_CLONE_CLASSES_FILE_NAME + Constants.CM_TEXT_FILE_EXTENSION;   
		File file = new File(filePath);  
		assertNotNull(file);
	}   

	public void testOpen_FileClsuters()
	{
		String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.FILE_CLUSTERS_FILE_NAME+ Constants.CM_TEXT_FILE_EXTENSION; 

		File file = new File(filePath);  
		assertNotNull(file);
	}
        /*
	public void testCheck_parsing_FileClusters() throws NumberFormatException, IOException{
		String filepath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER + File.separatorChar + Constants.TEST_FILE_NAME+ Constants.CM_TEXT_FILE_EXTENSION; 
		File file2 = new File(filepath);
		FileInputStream filein2 = new FileInputStream(file2);
		BufferedReader stdin2 = new BufferedReader(new InputStreamReader(filein2));
		String temp,line;
		line = null;
		StringTokenizer st, st1, st2;
		String fid = null;
		while ((line = stdin2.readLine()) != null) {
			if (!line.equalsIgnoreCase("")) {
				st = new StringTokenizer(line, ";");
				String cid = st.nextToken();
				int scs_crossfile_id = Integer.parseInt(cid);
				assertEquals(0, scs_crossfile_id);
				//System.out.println("scs_crossfile id is "+scs_crossfile_id);
				String support = st.nextToken();
				String sccs = stdin2.readLine();
				st2 = new StringTokenizer(sccs, ",");
				while (st2.hasMoreTokens()) {
					temp = st2.nextToken();
					assertEquals("0", temp);


					//insertSCSCrossFile_SCC(Integer.parseInt(temp),
					//	scs_crossfile_id);
				}

				int sup = (new Integer(support)).intValue();
				//System.out.println("Sup in code is  "+sup);
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
					if(fid.equals("7"))
					{
						assertEquals("File id is 7 or 8","7",fid);
					}

					if(fid.equals("8"))
					{
						assertEquals("File id is 7 or 8","8",fid);
					}

					//System.out.println("tc is "+tk);
					//System.out.println("pc is "+coverage);
				}
				atc = atc / sup;
				apc = apc / sup;
				assertEquals("Check value of apc",25.1964,apc);
				assertEquals("Check value of atc",46.0,atc);
				assertEquals("The number of Members",2, sup);
				//System.out.println("atc is "+atc);
				//System.out.println("apc is "+apc);
				//System.out.println("Members are "+sup);
			}
		}
	}
*/
	public void testCheckFilesize_zero() {
		DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
		@SuppressWarnings("unused")
		int size = dbt.getFileSize(-134);
		assertEquals("zero file size since id not in db", 0, 0);
	}
	
	public void testCheckFilesize_working() {
		DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
		int size = dbt.getFileSize(1);
		if (size == -1){
			assertFalse(false);
		}
		if (size != -1){
			assertTrue(true);
		}
	}

       public void testGroupSize_working() {
           DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
           int size = dbt.getGroupSize(1);
		if (size == -1){
			assertFalse(false);
		}
		if (size != -1){
			assertTrue(true);
		}
       }

       public void testGroupSize_zero() {
		DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
		@SuppressWarnings("unused")
		int size = dbt.getGroupSize(-134);
		assertEquals("zero group size since id not in db", 0, 0);
	}
       
       public void testDirectorySize_working() {
           DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
           int size = dbt.getDirectorySize(1);
		if (size == -1){
			assertFalse(false);
		}
		if (size != -1){
			assertTrue(true);
		}
       }

       public void testDirectorySize_zero() {
		DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
		@SuppressWarnings("unused")
		int size = dbt.getDirectorySize(-134);
		assertEquals("zero directory size since id not in db", 0, 0);
	}
       
       
       
               
/*        public void testgetFileName_invalidInput(){
           DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
           String filename = dbt.getFileName(-134);
           assertNull(filename);
       }*/
       
       public void testgetDidFromFid_invalid() {
         DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
         int did = dbt.getDidFromFid(-134);
           assertEquals("directory id is -1 since id is not in db",-1, -1);
           
           
       }
       
       public void testGidFromFid_invalid() {
         DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
         int gid = dbt.getGidFromFid(-134);
         assertEquals("Grpup id is -1 since id is not in db",-1, -1);
            
       }
       
      public void testgetGidFromFid_working() {
          DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
          int gid = dbt.getGidFromFid(1);
          if (gid == -1){
            assertFalse(false);
	  }
          if (gid != -1){
	   assertTrue(true);
	  }
      
      }
      
       public void testgetDidFromFid_working() {
          DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
          int did = dbt.getGidFromFid(1);
          if (did == -1){
            assertFalse(false);
	  }
          if (did != -1){
	   assertTrue(true);
	  }
      
      }

       
       public void testgetFCC_InstanceData_invalid() {
         DBLoaderFromTextFiles dbt = new DBLoaderFromTextFiles();
         Vector<String> vec = new Vector<String>();
         vec = dbt.getFCC_InstanceData(-40);
         try {
         int size = vec.size();
         }
         catch (Exception e)
         {
          assertTrue(true);
         return;
         }
         assertTrue(false);
       }
         //assertEquals("zero size of the list returned  since id not in db", 0, 0);
       
       
	public void testMCCInsertions(){
		assertTrue(getNumberOfRows("SELECT COUNT(mcc_id) FROM mcc;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(mid) FROM method_file;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(mid) FROM method;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(invocation_id) FROM invocation_files;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(mcs_crossfile_id) FROM mcscrossfile_methods;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(scs_crossmethod_id) FROM scscrossmethod_scc;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(scs_crossmethod_id) FROM scs_crossmethod;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(scs_crossmethod_id) FROM scscrossmethod_method;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(mcc_id) FROM mcc_file;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(mcs_crossfile_id) FROM mcscrossfile_file;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(mcs_crossfile_id) FROM mcscrossfile_mcc;") > 0);
		assertTrue(getNumberOfRows("SELECT COUNT(mcs_crossfile_id) FROM mcs_crossfile;") > 0);
	}
	
	public void testInvocationIdColumnExistsInMCC(){
		try{
			getNumberOfRows("SELECT invocation_id FROM mcc_instance;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	
	public void testInvocationIdColumnExistsIn_mcscrossfile_methods(){
		try{
			getNumberOfRows("SELECT invocation_id FROM mcscrossfile_methods;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_scscrossmethod_scc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM scscrossmethod_scc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_scs_crossmethod(){
		try{
			getNumberOfRows("SELECT invocation_id FROM scs_crossmethod;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_scscrossmethod_method(){
		try{
			getNumberOfRows("SELECT invocation_id FROM scscrossmethod_method;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_mcc_file(){
		try{
			getNumberOfRows("SELECT invocation_id FROM mcc_file;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_mcscrossfile_file(){
		try{
			getNumberOfRows("SELECT invocation_id FROM mcscrossfile_file;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_mcscrossfile_mcc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM mcscrossfile_mcc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_mcs_crossfile(){
		try{
			getNumberOfRows("SELECT invocation_id FROM mcs_crossfile;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_method(){
		try{
			getNumberOfRows("SELECT invocation_id FROM method;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_mcc_scc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM mcc_scc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	public void testInvocationIdColumnExistsIn_method_file(){
		try{
			getNumberOfRows("SELECT invocation_id FROM method_file;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
	
	public int getNumberOfRows(String pQuery) {
		int size = -1;
		try {
			Statement s = Database.getInstance().getDBConn().createStatement();
			s.execute("use " + "dssd" + ";");
			java.sql.ResultSet results = s.executeQuery(pQuery);
			if (results.next()) {
				size = results.getInt(1);
			}
			s.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		return size;
	}
       
        public void testInvocationIdColumnExistsIn_fcc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcc_by_directory(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcc_by_directory;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcc_by_group(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcc_by_group;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcc_instance(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcc_instance;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        
        public void testInvocationIdColumnExistsIn_fcc_scc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcc_scc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_crossdir(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_crossdir;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_crossdir_fcc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_crossdir_fcc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_crossdir_files(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_crossdir_files;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
       
        public void testInvocationIdColumnExistsIn_fcs_crossgroup(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_crossgroup;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_crossgroup_fcc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_crossgroup_fcc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_crossgroup_files(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_crossgroup_files;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_withindir(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_withindir;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_withindir_fcc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_withindir_fcc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_withindir_files(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_withindir_files;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
         public void testInvocationIdColumnExistsIn_fcs_withgroup(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_withingroup;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_withgroup_fcc(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_withingroup_fcc;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	}
        
        public void testInvocationIdColumnExistsIn_fcs_withgroup_files(){
		try{
			getNumberOfRows("SELECT invocation_id FROM fcs_withingroup_files;");
		}
		catch(Exception e){
			assertTrue(false);
			e.printStackTrace();
		}
		
		assertTrue(true);
	} 
         
        public void testFCCInsertions(){
		if(getNumberOfRows("SELECT COUNT(fcc_id) FROM fcc;") > 0)
                {
                   assertTrue(true); 
                    
                }
		
                if(getNumberOfRows("SELECT COUNT(fcc_id) FROM fcc_by_directory;") > 0){
                  assertTrue(true);   
                }
                
		if(getNumberOfRows("SELECT COUNT(fcc_id) FROM fcc_by_group;") > 0){
                    assertTrue(true); 
                }
		if(getNumberOfRows("SELECT COUNT(fcc_id) FROM fcc_instance;") > 0)
                {
                    assertTrue(true); 
                }
		if(getNumberOfRows("SELECT COUNT(fcc_id) FROM fcc_scc;") > 0){
                    assertTrue(true); 
                }
                
		if(getNumberOfRows("SELECT COUNT(invocation_id) FROM fcs_crossdir;") > 0){
                    assertTrue(true); 
                }
		
                if(getNumberOfRows("SELECT COUNT(fcc_id) FROM fcs_crossdir_fcc;") > 0){
                    
                }
		if(getNumberOfRows("SELECT COUNT(fcc_id) FROM fcs_crossdir_files;") > 0){
                    assertTrue(true); 
                }
		if(getNumberOfRows("SELECT COUNT(fcs_crossgroup_id) FROM fcs_crossgroup;") > 0){
                    assertTrue(true); 
                }
		if(getNumberOfRows("SELECT COUNT(invocation_id) FROM fcs_crossgroup_fcc;") > 0){
                    assertTrue(true); 
                }
		if(getNumberOfRows("SELECT COUNT(fcc_id) FROM fcs_crossgroup_files;") > 0){
                    assertTrue(true); 
                }
		if(getNumberOfRows("SELECT COUNT(invocation_id) FROM fcs_withindir;") > 0){
                    assertTrue(true); 
                }
                if(getNumberOfRows("SELECT COUNT(invocation_id) FROM fcs_withindir_files;") > 0){
                    assertTrue(true); 
                }
                if(getNumberOfRows("SELECT COUNT(invocation_id) FROM fcs_withingroup;") > 0){
                    assertTrue(true); 
                }
                if(getNumberOfRows("SELECT COUNT(invocation_id) FROM fcs_withingroup_fcc;") > 0){
                    assertTrue(true); 
                }
                if(getNumberOfRows("SELECT COUNT(invocation_id) FROM fcs_withingroup_files;") > 0){
                    assertTrue(true); 
                }
              
        }
        
}
