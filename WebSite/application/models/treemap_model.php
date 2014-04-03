<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Treemap_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  
    function get_fcs_within_dir_treemap($invocationId, $dids)
	{
		//$fcs_within_dir = array();
		foreach($dids as $did)
		{
			$filarr = array();
			//$query = "SELECT directory_name dname, file_name filename, CONCAT(repository_name,directory_name,file_name) filepath, 0 as fsize FROM repository_file f,repository_directory d,	user_repository r WHERE d.id=f.directory_id and d.repository_id=r.id and f.id in(select file_id from invocation_files where cmdirectory_id=$did and invocation_id=$invocationId)";
			$query = "SELECT directory_name dname, file_name filename, CONCAT(repository_name,directory_name,file_name) filepath, 0 as fsize 
			FROM repository_file f 
			inner join repository_directory d on d.id=f.directory_id 
			inner join user_repository r on d.repository_id=r.id 
			inner join invocation_files i on f.id=i.file_id where i.cmdirectory_id=$did and i.invocation_id=$invocationId";

			$result = $this->db->query($query);
			$dir_files = $result->result();
			if($dir_files)
			{
				$dir_size=0;
				foreach($dir_files as $dir_file)
				{
					$dir_file = json_decode(json_encode($dir_file), true);
					$dname = $dir_file['dname'];
					$file_path = $dir_file['filepath'];
					$file_size = filesize($file_path);
					$dir_size = $dir_size + $file_size;
					$dir_file['fsize'] = $file_size;
					$filarr[]=$dir_file;
				}
				$dids[$did]=array("dname"=>$dname,"dsize"=>$dir_size,"files"=>$filarr);
			}
			//print_r($dids[$did]);
		}
		return $dids;
    }

}
