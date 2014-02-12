package dssd.invoker;
import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.StringTokenizer;



public class Helper {

	public static boolean makeInputFile(InvokeParameter invokeParameter)
	{
		try {
			if(invokeParameter != null){
				String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_INPUT_FOLDER + File.separatorChar + Constants.CM_INPUT_FILE_INPUTFILES + Constants.CM_TEXT_FILE_EXTENSION;
				System.out.println("\nfilePath: " + filePath);
				PrintWriter writer = new PrintWriter(filePath, "UTF-8");
				
				ArrayList<String> iFiles = invokeParameter.getInput_files();
				
				if(iFiles != null && iFiles.size() > 0){
					for (String s : iFiles){
						System.out.println("\nfilePathAdding: " + s);
						writer.println(s);
					}
				}
				
				writer.close();
			}
		} catch (IOException e) {
			e.printStackTrace();
			
			return false;
		}
		
		return true;
	}

	public static boolean makeEqualTokensFile(InvokeParameter invokeParameter)
	{
		try {
			if(invokeParameter != null){
				String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_INPUT_FOLDER + File.separatorChar + Constants.CM_INPUT_FILE_EQUAL_TOKENS + Constants.CM_TEXT_FILE_EXTENSION;
				System.out.println("\nfilePath: " + filePath);
				
				PrintWriter writer = new PrintWriter(filePath, "UTF-8");
				
				
				String inputString = invokeParameter.getEqual_tokens(); 
				
				if(inputString != null && inputString.length()>0){
					StringTokenizer st = new StringTokenizer(inputString, "|");
					String tempString = "";
					while (st != null && st.hasMoreTokens()) {
						tempString = (String)st.nextToken();
						
						System.out.println(tempString);
						writer.println(tempString);
					}
					
					writer.close();
				}
			}
		} catch (IOException e) {
			e.printStackTrace();
			
			return false;
		}
		
		return true;
	}
	
	public static boolean makeSuppressedTokenFile(InvokeParameter invokeParameter)
	{
		try {
			if(invokeParameter != null){
				String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_INPUT_FOLDER + File.separatorChar + Constants.CM_INPUT_FILE_SUPPRESSED + Constants.CM_TEXT_FILE_EXTENSION;
				System.out.println("\nfilePath: " + filePath);
				
				PrintWriter writer = new PrintWriter(filePath, "UTF-8");
					
				String tempString = invokeParameter.getSuppressed_tokens();
				
				System.out.println(tempString);
				writer.println(tempString);
				
				writer.close();
			}
		} catch (IOException e) {
			e.printStackTrace();
			
			return false;
		}
		
		return true;
	}
	
	public static boolean makeClusterParametersFile(InvokeParameter invokeParameter)
	{
		try {
			if(invokeParameter != null){
				String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_INPUT_FOLDER + File.separatorChar + Constants.CM_INPUT_FILE_CLUSTER_PARAMETERS + Constants.CM_TEXT_FILE_EXTENSION;
				System.out.println("\nfilePath: " + filePath);
				
				PrintWriter writer = new PrintWriter(filePath, "UTF-8");
				
				//TODO out of scope at the moment
				
				writer.close();
			}
		} catch (IOException e) {
			e.printStackTrace();
			
			return false;
		}
		
		return true;
	}
}
