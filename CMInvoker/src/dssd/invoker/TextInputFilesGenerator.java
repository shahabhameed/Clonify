package dssd.invoker;
import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.List;
import java.util.StringTokenizer;

import dssd.invoker.adapter.InputHelper;

public class TextInputFilesGenerator extends InputHelper{
	@Override
	public boolean writeToDisk() {
		
		boolean isMakeInputFileSuccessful = makeInputFile();
		boolean isMakeEqualTokensFileSuccessful = makeEqualTokensFile();
		boolean isMakeSuppressedTokenFileSuccessful = makeSuppressedTokenFile();
		boolean isMakeClusterParametersFileSuccessful = makeClusterParametersFile();
		
		if(isMakeInputFileSuccessful && isMakeEqualTokensFileSuccessful && isMakeSuppressedTokenFileSuccessful && isMakeClusterParametersFileSuccessful){
			return true;
		}
		
		return false;
	}
	
	private boolean makeInputFile()
	{
		try {
			if(invokeParameter != null){
				String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_INPUT_FOLDER + File.separatorChar + Constants.CM_INPUT_FILE_INPUTFILES + Constants.CM_TEXT_FILE_EXTENSION;
				System.out.println("\nfilePath: " + filePath);
				PrintWriter writer = new PrintWriter(filePath, "UTF-8");
				
				List<List<InvocationFileInfo>> groupList = invokeParameter.getInput_files();
				
				
				if(groupList != null && groupList.size() > 0)
				{		
					Integer groupCount = 0;
					for (List <InvocationFileInfo> fileList : groupList)
					{
						Integer fileCount = 0;
						
						for(InvocationFileInfo file : fileList)
						{
							String str = file.getInputFileName();
							if(str != null && str.length() > 0){
								str = str.replace("/", "\\");
								if(fileCount == fileList.size()-1 && groupCount != groupList.size()-1)
								{
									writer.println(str+";");
								}
								else
								{
									writer.println(str);
								}
							}
							fileCount++;
						}
						groupCount++;
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

	private boolean makeEqualTokensFile()
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
	
	private boolean makeSuppressedTokenFile()
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
	
	private boolean makeClusterParametersFile()
	{
		try {
			if(invokeParameter != null){
				String filePath = InvokeService.CM_ROOT + File.separatorChar + Constants.CM_INPUT_FOLDER + File.separatorChar + Constants.CM_INPUT_FILE_CLUSTER_PARAMETERS + Constants.CM_TEXT_FILE_EXTENSION;
				System.out.println("\nfilePath: " + filePath);
				
				PrintWriter writer = new PrintWriter(filePath, "UTF-8");
				//Comment for Team1: Please replace "50,50" with appropriate field.
				String tempString = "50"+"," + "50"+"," + invokeParameter.getMin_similatiry_MCC_percent()+"," + invokeParameter.getMin_similatiry_MCC_tokens();
				
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
}
