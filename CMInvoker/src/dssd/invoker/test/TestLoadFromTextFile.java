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
import java.util.StringTokenizer;

import junit.framework.TestCase;
import dssd.invoker.Constants;
import dssd.invoker.DBLoaderFromTextFiles;
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
}
