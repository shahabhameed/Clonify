package dssd.invoker;


import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;

public class MyExternalThread extends Thread{
    
	private InputStream inputStream;
	private boolean hasRunCompletedSuccessfully;
	
    public MyExternalThread(InputStream is)
    {
        inputStream = is;
    }
    
    public boolean isAllSet(){
    	if(inputStream == null){
    		return false;
    	}
    	
    	return true;
    }
    
    public boolean isRunExitedSuccessfully(){
    	return hasRunCompletedSuccessfully;
    }
    
    public void run()
    {
    	hasRunCompletedSuccessfully = false;
    	try{
    		if(inputStream != null){
	    		InputStreamReader streamReader = new InputStreamReader(inputStream);
	    		BufferedReader bufferReader = new BufferedReader(streamReader);
	    		String line=null;
	   			while ( (line = bufferReader.readLine()) != null){
	  				System.out.println(line);
	   			}
    		}
        } 
        catch (IOException ex){
        	ex.printStackTrace();    
        	hasRunCompletedSuccessfully = false;
        	
        	return;
        }
        
        hasRunCompletedSuccessfully = true;
    }

}
