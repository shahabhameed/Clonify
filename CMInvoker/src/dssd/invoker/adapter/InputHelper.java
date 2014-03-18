package dssd.invoker.adapter;

import dssd.invoker.InvokeParameter;

public abstract class InputHelper {
	protected InvokeParameter invokeParameter;
	
	public boolean isDataSet(){
		if(
			invokeParameter != null 
			//&& invokeParameter.isAllSet()
		)
		{
			return true;
		}
		
		return false;
	}
	
	public boolean setData(InvokeParameter pInvokeParameter){
		invokeParameter = pInvokeParameter;
		return true;
	}
	
	/**
	 * Implementation of this function should save any number of input files
	 * required by Clone Miner "clones.exe" in inputFolder
	 */
	public boolean makeCMInputFile(){
			return writeToDisk();
	}
	
	public abstract boolean writeToDisk();
}
