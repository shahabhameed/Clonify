<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Repository_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function insertUserRepository($path, $user_id)
	{
		//insert 
		//$user_id = $this->session->userdata('user_id');
		$path2 = str_replace("\\", "/", $path);
		$path = $path2;
		$date = date('Y-m-d H:i:s');
		//$this->db->update()
		$this->db->query("INSERT INTO user_repository(user_id,repository_name,creation_time) VALUES('$user_id','$path','$date')");
		
	}
	function getIdFromUserRepository($user_id)
	{
		$this->db->where('user_id', $user_id);
		//$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get('user_repository');
		if ($query->num_rows() == 1)
		{ 
			return  $query->row();
			//return $newData['email'];
		}
		return NULL;
	}
	
	function insertFileName($user_id, $dirPath, $fileName)
	{
		//insert into db tables: repository directory and repository file
		//get username and then get the corresponding id of the user_repository 
		$dirPath2 = str_replace("\\", "/", $dirPath);
		$dirPath = $dirPath2;
		$data = $this->getIdFromUserRepository($user_id);
		$id = $data->id;
		$date = date('Y-m-d H:i:s');
		if ($dirPath=="")
		{
			$newId;
			if ($this->isExistDirectoryName($dirPath, $id))
				{
					$this->db->query("INSERT INTO repository_directory(repository_id) VALUES('$id')");
					$newId = mysql_insert_id();
					if ($this->isExistFileName($newId, $fileName))
					{
						$this->db->query("INSERT INTO repository_file(file_name,directory_id,last_modified_time) VALUES('$fileName','$newId','$date')");
					}
				}
			else
				{
					$newId = $this->getDirectoryId($dirPath, $id);
					if ($this->isExistFileName($newId, $fileName))
					{
						$this->db->query("INSERT INTO repository_file(file_name,directory_id,last_modified_time) VALUES('$fileName','$newId','$date')");
					}
				}
		}
		else
		{
			$newFileDir = $dirPath.'/';
			$newId;
			if ($this->isExistDirectoryName($newFileDir, $id))
				{
					$this->db->query("INSERT INTO repository_directory(repository_id,directory_name) VALUES('$id','$newFileDir')");
					$newId = mysql_insert_id();
					if ($this->isExistFileName($newId, $fileName))
					{
						$this->db->query("INSERT INTO repository_file(file_name,directory_id,last_modified_time) VALUES('$fileName','$newId','$date')");
					}
				}
			else
				{
					$newId = $this->getDirectoryId($dirPath.'/', $id);
					if ($this->isExistFileName($newId, $fileName))
					{
						$this->db->query("INSERT INTO repository_file(file_name,directory_id,last_modified_time) VALUES('$fileName','$newId','$date')");
					}
				}
		}
		
		
	}
	//function to check if files already exist in the data base!	
	function isExistDirectoryName($dirPath, $id)
	{
		$this->db->where('directory_name', $dirPath);
		$this->db->where('repository_id', $id);
		//$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get('repository_directory');
		if ($query->num_rows() > 0)
		{ 
			return  false;
		}
		return true;
	}
	
	function getDirectoryId($dirPath, $id)
	{
		$this->db->where('directory_name', $dirPath);
		$this->db->where('repository_id', $id);
		//$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get('repository_directory');
		if ($query->num_rows() == 1)
		{ 
			$newData = $query->row();
			return $newData->id;
		}
		return NULL;
	}
	function getDirectoryPathById($id)
	{
		$this->db->where('id', $id);
		//$this->db->where('repository_id', $id);
		//$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get('repository_directory');
		if ($query->num_rows() == 1)
		{ 
			$newData = $query->row();
			return $newData->directory_name;
		}
		return NULL;
	}
	function getDirectoryIdbyRepoId($id)
	{
		//$this->db->where('directory_name', $dirPath);
		$this->db->where('id', $id);
		//$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get('repository_file');
		if ($query->num_rows() == 1)
		{ 
			$newData = $query->row();
			return $newData->directory_id;
		}
		return NULL;
	}
	
	function getRepoIdbyDirId($id)
	{
		//$this->db->where('directory_name', $dirPath);
		$this->db->where('id', $id);
		//$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get('repository_directory');
		if ($query->num_rows() == 1)
		{ 
			$newData = $query->row();
			return $newData->repository_id;
		}
		return NULL;
	}
	function isExistFileName($newId, $fileName)
	{
		$this->db->where('file_name', $fileName);
		$this->db->where('directory_id', $newId);
		//$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get('repository_file');
		if ($query->num_rows() > 0)
		{ 
			return  false;
		}
		return true;
	}
	function checkDelete($user_id, $subPaths, $fileNames)
	{
		//get data from db from two tables
		//compare and get id to delete if any file has been deleted.
		//delete only the file
		$data = $this->getIdFromUserRepository($user_id);
		$id = $data->id;
		$allFiles = $this->getAllFiles();
		$allDirectories = $this->getAllDirectories();
		$arrlength=count($fileNames);
		//echo $arrlength;
		//echo $id;
		$dirId = 0;
		foreach ($allFiles as $newFile)
		{
			$del = true;
			//$xNumber = 0;
			//echo $newFile->file_name;
			for($x=0;$x<$arrlength;$x++)
			{
				$fileID = $newFile->id;
				//echo $fileID;
				$dirIDCheck = $this->getDirectoryIdbyRepoId($fileID);
				$dirPathTemp = $this->getDirectoryPathById($dirIDCheck);
				//echo $dirPathTemp."</br>";
				//echo $subPaths[$x]."</br>";
				$dirPath2 = str_replace("\\", "/", $subPaths[$x]);
				$dirPath = $dirPath2;
				if (strcmp($newFile->file_name, $fileNames[$x])==0) 
				{
					if ($dirPath=="")
					{
						if(strcmp($dirPathTemp, $dirPath)==0)
						{
							$del = false;
							break;
						}
					}
					else {
						if(strcmp($dirPathTemp, $dirPath.'/')==0)
						{
							$del = false;
							break;
						}
					}
				}
				//$xNumber = $x;
			}
			
			if ($del==true)
			{
				//$dirPath = $subPaths[$xNumber];
				//$dirPath2 = str_replace("\\", "/", $dirPath);
				//$dirPath = $dirPath2;
				// get the dir id from repository using the file id and then delete!
				//echo $dirPath;
				/*if ($dirPath=="")
					$dirId =$this->getDirectoryId($dirPath, $id);
				else
					$dirId =$this->getDirectoryId($dirPath.'/', $id);
				echo $dirId;
				*/
				$fileID = $newFile->id;
				//get directory details
				$dirIDCheck = $this->getDirectoryIdbyRepoId($fileID);
				//get user repo id - if match then delete!
				$userRepoID = $this->getRepoIdbyDirId($dirIDCheck);
				if ($id==$userRepoID)
				{
					$query = "DELETE FROM repository_file WHERE file_name = '$newFile->file_name' and id = $fileID ";
					//echo $query;
					$this->db->query($query);
					//$this->db->delete('repository_file', array('file_name' => $newFile->file_name, 'directory_id' => $dirId )); 
				}
			}
			
		}
		
		
	}
	function getAllFiles()
	{
		$query = "SELECT * FROM repository_file";
		$results = $this->db->query($query);
		return $results->result();
		//return $results;
	}
	function getAllDirectories()
	{
		$query = "SELECT * FROM repository_directory";
		$results = $this->db->query($query);
		return $results->result();
	}
	/*function getFileID($fileID)
	{
		$this->db->where('directory_name', $dirPath);
		$this->db->where('repository_id', $id);
		//$this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get('repository_directory');
		if ($query->num_rows() == 1)
		{ 
			$newData = $query->row();
			return $newData->id;
		}
		return NULL;
	}
	*/
}