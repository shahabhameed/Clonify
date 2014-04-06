<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 function get_dir_name($dir_id, $invocationId){
   $where = "tb1.invocation_id = $invocationId and tb1.cmdirectory_id = $dir_id";
 	  $ci = & get_instance();
 	  $res = 	$ci->db->select('tb3.directory_name')
		 	  		->from('invocation_files as tb1')
		 	  		->join('repository_file as tb2','tb1.file_id = tb2.id')
		 	  		->join('repository_directory as tb3', 'tb2.directory_id = tb3.id')
		 	  		->where($where)
		 	  		->limit(1)
		 	  		->get()
		 	  		->result_array();
    return $res[0]['directory_name'];
}