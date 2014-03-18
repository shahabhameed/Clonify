/**
 * @author Yali
 */
package edu.nus.cloneanalyzer.clone.datatypes;

import org.eclipse.core.resources.IResource;

public class SCSInFileInstance extends FCSInDirInstance implements IResourceMember{
	protected int did;
	protected String dirName;
	protected int gid;
	
	public SCSInFileInstance(int ccId, int id, int cid, String containerName, int did, String dirName, int gid) {
		super(ccId, id, cid, containerName);
		this.did = did;
		this.dirName = dirName;
		this.gid = gid;
	}

	public SCSInFileInstance(int ccId, int cid, String containerName, int did, String dirName, int gid) {
		super(ccId, cid, containerName);
		this.did = did;
		this.dirName = dirName;
		this.gid = gid;
	}

	public void addComponent(int sl, int el){
		components = components + sl + "-" + el;
	}
	
	public void addComponent(String delim, int sl, int el){
		components = components + delim + sl + "-" + el; 
	}

	public int getGid() {
		return gid;
	}

	public int getDid() {
		return did;
	}

	public String getDirName() {
		return dirName;
	}

	public Integer getSize() {
		return new Integer(con.getFileLineSize(this.getCid()));
	}
	
	public String toString(){
		return "Type: Simple Clone Structure Within File Instance" 
				+ ";\nSCS ID: " + this.getCcId()
				+ ";\nFile: " + this.getContainerName()
				+ ";\nSCS Instance ID: " + this.getId();
	}

	public IResource getResource() {
		return con.findFileFromWorkspace(this.getCid(), this.getContainerName(), 
				this.getDid(), this.getDirName(), this.getGid());
	}

	public int getInitialLineNumber() {
		return 0;
	}
	
	public String getFullname() {
		return "SCS " + this.getCcId() + " In File Instance " + this.getId() + ": " + this.getContainerName();
	}

	public int getInstId() {
		return this.getId();
	}
}
