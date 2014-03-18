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

	public String getFullname() {
		return "SCS " + this.getCcId() + " In File Instance " + this.getId() + ": " + this.getContainerName();
	}

	public int getInstId() {
		return this.getId();
	}
}
