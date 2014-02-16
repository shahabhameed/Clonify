<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoke_model_test extends CI_Model
{
	function new_invocation()
	{
		$user_id = $this->session->userdata('user_id');
		$status = '0';// 0 - Inactive (Not Started Yet)
		$date = date('Y-m-d H:i:s');				
		$this->db->query("INSERT INTO user_invocations(user_id,status,invoked_time) VALUES('$user_id','$status','$date')");
		
		echo $this->db->affected_rows();
		$invoke_id = mysql_insert_id();
		$this->session->set_userdata(array('invoke_id'=>$invoke_id));
		$this->insert_initial_params();
	}
	
    function insert_initial_params()
    {
		$user_id = $this->session->userdata('user_id');
		$invoke_id = $this->session->userdata('invoke_id');
		
        $scc_min_sim = $_POST['sccMinSim'];
		if(isset($_POST['methodAnalysis'])){
	        $method_analysis = TRUE;
		}
		else{
			$method_analysis = FALSE;
		}
        $grouping_choice = $_POST['groupingChoice'];
		$files = $_POST['files'];
		
		$this->db->query("INSERT INTO invocation_parameters(min_similatiry_SCC_tokens,grouping_choice,method_analysis,invocation_id) VALUES('$scc_min_sim','$grouping_choice','$grouping_choice','$invoke_id')");
		
		//$suppresed = $_POST['suppresed'];
		//$equal = $_POST['equal'];
		//print_r($suppresed);
		//print_r($equal);
		//print_r($files);
		
		foreach ($_POST['files'] as $selFil) {
			$this->db->query("INSERT INTO invocation_files(invocation_id,file_id) VALUES('$invoke_id','$selFil')");
			//echo $selected;
		}
		
		$this->insert_initial_params_2();
    }
	
	function insert_initial_params_2()
    {
		$user_id = $this->session->userdata('user_id');
		$invoke_id = $this->session->userdata('invoke_id');
		
        $suppresed = $_POST['suppresed2'];
		$equal = $_POST['equal'];
		$supTokens = '';
		$eqTokens = '';
		$first = true;
		foreach ($_POST['suppresed2'] as $selSup) {
			if($first){
				$supTokens=$selSup;
			}
			else{
				$supTokens=$supTokens.','.$selSup;
			}
		}
		
		foreach ($_POST['equal2'] as $selEq) {
			$eqTokens = $eqTokens.'|'.$selEq;
		}
		$this->db->query("UPDATE invocation_parameters SET suppressed_tokens='$supTokens',equal_tokens='$eqTokens' where invocation_id='$invoke_id'");
    }
	
	function init($scc_min_sim,$files)
    {
		$isNotEmpty = false;
		if(!empty($scc_min_sim) || !empty($files)){
			$isNotEmpty=true;
		}
		return $isNotEmpty;
	}

	function sup($suppresed)
    {
		if(!empty($suppresed)){
		//$suppresed = $_POST['suppresed2'];
		$supTokens = '';
		$first = true;
		foreach ($suppresed as $selSup) {
			if($first){
				$supTokens=$selSup;
				$first = false;
			}
			else{
				$supTokens=$supTokens.','.$selSup;
			}
		}
		return $supTokens;
		}
		return NULL;
	}

	function eq($equal)
    {
		if(!empty($equal)){
		//$equal = $_POST['equal2'];		
		$eqTokens = '';
		$first = true;
		foreach ($equal as $selEq) {
			if($first){
				$eqTokens = $selEq;
				$first = false;
			}
			else{
				$eqTokens = $eqTokens.'|'.$selEq;
			}
		}
		return $eqTokens;
		}
		return NULL;
		
	}
	
	function get_all_user_files($user_id)
	{
		//$user_id = $this->session->userdata('user_id');
		$query = "select f.id, CONCAT(repository_name,directory_name,file_name) as fname from repository_file f,repository_directory d,user_repository r where d.repository_id=r.id and f.directory_id=d.id and r.user_id = '$user_id' order by fname";
		$query_lang = " and f.file_name like '%.java'";
		//echo $query;
		$results = $this->db->query($query);
/*
		foreach($results->result() as $usrfile){
			echo $usrfile->id."\n".$usrfile->fname;
		}
*/
		return $results->result();
	}
	
	function get_all_languages()
	{
		$query = "SELECT * FROM languages";
		$results = $this->db->query($query);
		return $results->result();
	}
	
	function get_all_language_tokens($language_id)
	{
		//$language_id = $this->session->userdata('language');
		$query = "SELECT * FROM tokens WHERE language_id='$language_id'";
		$results = $this->db->query($query);
		return $results->result();
	}
}