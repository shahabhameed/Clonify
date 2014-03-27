package dssd.invoker;


import java.io.File;
import java.io.IOException;
import java.io.PrintStream;

import dssd.invoker.adapter.InputHelper;
import dssd.invoker.adapter.OutputHelper;

public class InvokeService {
	public static String CM_ROOT = "";

	private static Process miner;
	private static MyExternalThread errStream, outputStream;
	private static Boolean stopProcess = false;
	//	private static Controller con;// = new Controller();
	//	private static CloneManager cloneManager = new CloneManager(con);

	public static InvokeParameter sInvokeParameter = null;
	
	/**
	 * @param args
	 */
	public static void main(String[] args) {
		init();
		try {
			invokeCloneMiner();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	public static void init(){
		CMProperties.loadProperties();

		CM_ROOT = CMProperties.getCloneminerRoot();

		
	}

	public static void invokeCloneMiner() throws IOException{		

		PrintStream ps = new PrintStream("log.txt");
		System.setOut(ps);

		while (!stopProcess){
			try {
				sInvokeParameter = Database.getInstance().getInvokeConfig(1);

				if(sInvokeParameter != null && sInvokeParameter.getInvocation_id()>-1)
				{
					if(Constants.SHOULD_USE_OLD_RESULTS == false){
						InputHelper helper = new TextInputFilesGenerator();
						helper.setData(sInvokeParameter);
						helper.makeCMInputFile();

						//Update status to in process/Active
						Database.getInstance().updateInvocationStatus(sInvokeParameter.getInvocation_id(), 1);

						String pathStr = CM_ROOT  +File.separatorChar + Constants.CM_EXEC_FILE_NAME;
						pathStr = "\"" + pathStr + "\"";
						final String[] strArray = new String[4];
						strArray[0] = pathStr;
						strArray[1] = "" + sInvokeParameter.getMin_similatiry_SCC_tokens();//stc;
						strArray[2] = "" + sInvokeParameter.getMethod_analysis();
						strArray[3] = "" + sInvokeParameter.getGrouping_choice();//groupIndex;

						// execute clone miner
						long startTime = System.currentTimeMillis();
						String dirStr = CM_ROOT;
						String dirOutput = CM_ROOT + File.separatorChar + Constants.CM_OUTPUT_FOLDER;

						deleteDir(new File(dirOutput)); 

						File dir = new File(dirStr);
						miner = Runtime.getRuntime().exec(strArray, null, dir);
						errStream = new MyExternalThread(miner.getErrorStream());
						outputStream = new MyExternalThread(miner.getInputStream());
						errStream.start();
						outputStream.start();
						int result = miner.waitFor();
						if (result != 0) {
							System.err
							.println("Clone Miner terminates with problems...");
						} else {
							long endTime = System.currentTimeMillis();
							long elapsed = endTime - startTime;
							long milli = elapsed % 1000;
							long sec = (elapsed / 1000) % 60;
							long mins = elapsed / 60000;
							System.out.println("Elapsed Time for CM: "
									+ mins + " mins " + sec + " secs "
									+ milli + " millisec");
							errStream.join();
							outputStream.join();
						}
					}
					
					OutputHelper outputHelper = new DBLoaderFromTextFiles();
					outputHelper.setData(sInvokeParameter.getInvocation_id());
					outputHelper.loadDBFromFiles();
					
					//Update status to Finished
					Database.getInstance().updateInvocationStatus(sInvokeParameter.getInvocation_id(), 2);
				}
				else
				{
					System.out.println("No active user invocation found. System will try again Later");
				}

				System.out.println("*** Sleeping for 5 Sec");
				Thread.sleep(5*1000);

			}catch (Exception ie) {
				if(miner!= null){
					miner.destroy();
					System.err
					.println("Clone Miner terminates with problems...");
				}
				System.err.println(ie.getMessage());
				ie.printStackTrace();
				if(sInvokeParameter != null)
				{
					//Update status to Crashed/error
					Database.getInstance().updateInvocationStatus(sInvokeParameter.getInvocation_id(), 3);
				}
			}	
		}



	}
	
	public int getTestValue(){
		return 1;
	}
	
	public static String getAbsolutePath(){
		File file = new File("Test.java");
		String absolutePath = file.getAbsolutePath();
		System.out.println(absolutePath);

		return absolutePath;
	}

	public static String DB_PATH = "E:\\DSSDLocal\\caws\\CloneMiner\\CMInvoker\\Resources\\config.properties";

	public static boolean deleteDir(File dir) {
		if (dir.isDirectory()) {
			String[] children = dir.list();
			for (int i = 0; i < children.length; i++) {
				File file=new File(dir, children[i]);

				boolean success = file.delete();
				if (!success) {
					return false;
				}
			}
		}

		// The directory is now empty so delete it
		return true;
	}
}
