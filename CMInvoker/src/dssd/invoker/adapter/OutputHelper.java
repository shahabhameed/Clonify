package dssd.invoker.adapter;


public abstract class OutputHelper {
	protected Integer invocationId;
	
	public boolean isDataSet(){
		if(invocationId != null){
			return true;
		}
		
		return false;
	}
	
	public void setData(Integer pInvocationId){
		invocationId = pInvocationId;
	}
	
	/**
	 * Implementation of this function should save any number of input files
	 * required by Clone Miner "clones.exe" in inputFolder
	 */
	public boolean loadFromFilesToDB(){
		if(isDataSet()){
			return loadDBFromFiles();
		}
		
		return false;
	}
	
	public abstract boolean loadDBFromFiles();
}
