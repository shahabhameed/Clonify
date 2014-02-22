package dssd.invoker.adapter;

import dssd.invoker.InvokeParameter;

public abstract class InputHelper {
	protected InvokeParameter invokeParameter;
	
	public boolean isDataSet(){
		if(
			invokeParameter != null && 
			invokeParameter.isAllSet()
		)
		{
			return true;
		}
		
		return false;
	}
	
	public void setData(InvokeParameter pInvokeParameter){
		invokeParameter = pInvokeParameter;
	}
	
	/**
	 * Implementation of this function should save any number of input files
	 * required by Clone Miner "clones.exe" in inputFolder
	 */
	public boolean makeCMInputFile(){
		if(isDataSet()){
			writeToDisk();
			return true;
		}
		
		return false;
	}
	
	public abstract boolean writeToDisk();
}
