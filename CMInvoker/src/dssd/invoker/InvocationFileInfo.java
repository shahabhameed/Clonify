package dssd.invoker;

/**
 * @author umerh 
 * 
 * Info object (POJO) for invocation_files table. currently only includes filename and Group_id.
 * Can/should be extended for further use 
 * 
 * */
public class InvocationFileInfo {
	
	private String inputFileName;
	private Integer groupId;
	
	public InvocationFileInfo(String fileName, Integer groupId)
	{
		this.inputFileName = fileName;
		this.groupId = groupId;
	}

	public String getInputFileName() {
		return inputFileName;
	}

	public void setInputFileName(String inputFileName) {
		this.inputFileName = inputFileName;
	}

	public Integer getGroupId() {
		return groupId;
	}

	public void setGroupId(Integer groupId) {
		this.groupId = groupId;
	}
	

}
