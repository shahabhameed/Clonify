<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Load_results_model extends CI_Model
{


	
	function get_all_results()
	{
		$user_id = $this->session->userdata('user_id');
		$query = "SELECT * FROM user_invocations WHERE user_id='$user_id' order by invoked_time desc";
		$results = $this->db->query($query);
		return $results->result();
	}
        
        function get($invocationId, $userId)
	{		
          $query = "SELECT * FROM user_invocations WHERE user_id='$userId' AND id='$invocationId' ";
          $results = $this->db->query($query);
          return $results->result();
	}
        
	function update_result($iid,$iname,$icomments)
	{
		$query = "UPDATE user_invocations SET invocation_name='$iname',comments='$icomments' WHERE id=$iid";
		$this->db->query($query);
	}
}