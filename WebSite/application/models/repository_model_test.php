<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Repository_Model_Test extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function insertUserRepository($path, $user_id)
	{
		//insert 
		//$user_id = $this->session->userdata('user_id');
		$date = date('Y-m-d H:i:s');
		//$this->db->update()
		$this->db->query("INSERT INTO user_repository(user_id,repository_name,creation_time) VALUES('$user_id','$path','$date')");
		return true;
		
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
		return true;
		
		
		
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
	
}