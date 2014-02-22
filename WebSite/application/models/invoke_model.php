<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoke_model extends CI_Model
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
	
	function init()
    {
        $iName = $_POST['iName'];
		$iComment = $_POST['iComment'];
		$scc_min_sim = $_POST['sccMinSim'];
		$language = $_POST['language'];
		if(isset($_POST['methodAnalysis'])){
	        $method_analysis = TRUE;
		}
		else{
			$method_analysis = FALSE;
		}
        $grouping_choice = $_POST['groupingChoice'];
		$files = $_POST['files'];
		
		$groupList = $_POST['hiddenGroup']; //get hidden list
		

		$this->session->set_userdata(array('scc_min_sim'=>$scc_min_sim,'method_analysis'=>$method_analysis,'grouping_choice'=>$grouping_choice,'files'=>$files,'groupList'=>$groupList,'language'=>$language,'iname'=>$iName,'icomment'=>$iComment));
	}

	function sup()
    {
	$supTokens = '';
	if (!empty($_POST["suppresed2"]))
	  {
		$suppresed = $_POST['suppresed2'];
		
		$first = true;
		foreach ($_POST['suppresed2'] as $selSup) {
			if($first){
				$supTokens=$selSup;
				$first = false;
			}
			else{
				$supTokens=$supTokens.','.$selSup;
			}
		}
		}
		$this->session->set_userdata(array('supTokens'=>$supTokens));
		
	}

	function eq()
    {
	$eqTokens = '';
	  if (!empty($_POST["equal2"]))
	  {
		$equal = $_POST['equal2'];		
		
		$first = true;
		foreach ($_POST['equal2'] as $selEq) {
			if($first){
				$eqTokens = $selEq;
				$first = false;
			}
			else{
				$eqTokens = $eqTokens.'|'.$selEq;
			}
		}
		}
		
		$this->session->set_userdata(array('eqTokens'=>$eqTokens));
		
		$this->invoke();
		
	}
	
	function invoke()
	{
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$status = '0';// 0 - Inactive (Not Started Yet)
		$date = date('Y-m-d H:i:s');
		
		$iname = $this->session->userdata('iname');
		$grouping_choice = $this->session->userdata('grouping_choice');
		$method_analysis = $this->session->userdata('method_analysis');
		$scc_min_sim = $this->session->userdata('scc_min_sim');
		$files = $this->session->userdata('files');
		$supTokens = $this->session->userdata('supTokens');
		$eqTokens = $this->session->userdata('eqTokens');
		$language = $this->session->userdata('language');
		$icomment = $this->session->userdata('icomment');
		
		if(empty($icomment)){
			$icomment = 'Min Sim Tokens: '.$scc_min_sim.'. Language: '.$language.'.\nSuppressed Tokens:'.$supTokens.'.\nEqual Tokens:'.$eqTokens.'.';
		}
		if(empty($iname)){
			$iname = $user_name.'_'.$user_id.'_'.$date;
		}

		$this->db->query("INSERT INTO user_invocations(user_id,status,invoked_time,invocation_name,comments) VALUES('$user_id','$status','$date','$iname','$icomment')");

		$invoke_id = mysql_insert_id();
		$this->session->set_userdata(array('invoke_id'=>$invoke_id));

		$this->db->query("INSERT INTO invocation_parameters(min_similatiry_SCC_tokens,grouping_choice,method_analysis,invocation_id,suppressed_tokens,equal_tokens,language_id) VALUES('$scc_min_sim','$grouping_choice','$grouping_choice','$invoke_id','$supTokens','$eqTokens','$language')");
		
		
		add_invocation_files_details();
		
		
		
		
		
		
		
	}
	
	function add_invocation_files_details()
	{
		$files = $this->session->userdata('files');
		$groupList = $this->session->userdata('groupList');
		$count = 0;
		
		if (!empty($groupList)){
			foreach ($groupList as $list)
			{
				$group=$_POST[$list];
				foreach ($group as $file_in_group)
				{
					$group_id=substr($group,9);
					$this->db->query("INSERT INTO invocation_files(invocation_id,file_id,group_id,cmfile_id) VALUES('$invoke_id','$file_in_group',$group_id,'$count')");
					$count++;
					
				}
				
			}
		
	
	}
	
	}
	
	function get_all_user_files()
	{
		$user_id = $this->session->userdata('user_id');
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
	function get_all_invocation_files()
	{
		$query = "SELECT * FROM invocation_files";
		$results = $this->db->query($query);
		return $results->result();
	}
	
	function get_all_language_tokens()
	{
		$language_id = $this->session->userdata('language');
		$query = "SELECT * FROM tokens WHERE language_id='$language_id'";
		$results = $this->db->query($query);
		return $results->result();
	}
	
	function get_all_language_tokens_sup($prev_invo_params)
	{
		$language_id = $this->session->userdata('language');
		if($prev_invo_params){
			foreach ($prev_invo_params as $row)
			{
				$token_ids = $row->suppressed_tokens;
			}
			if($token_ids){
				$query = "SELECT * FROM tokens WHERE language_id='$language_id' and token_id not in($token_ids)";
			}
			else{
				$query = "SELECT * FROM tokens WHERE language_id='$language_id'";
			}
		}
		else{
			$query = "SELECT * FROM tokens WHERE language_id='$language_id'";
		}
		$results = $this->db->query($query);
		return $results->result();
	}
	
	function get_prev_minSim($prev_invo_params)
	{
		$minsim = '';
		$language_id = $this->session->userdata('language');
		if($prev_invo_params){
			foreach ($prev_invo_params as $row)
			{
				$minsim = $row->min_similatiry_SCC_tokens;
			}
		}
		return $minsim;
	}
	
	function get_all_language_tokens_eq($prev_invo_params)
	{
		$language_id = $this->session->userdata('language');
		if($prev_invo_params){
			$token_ids = '';
			$first = true;
			foreach ($prev_invo_params as $row)
			{
				$eq_tokens = $row->equal_tokens;
			}
			if($eq_tokens){
				$eq_tokens_arr_m = explode("|",$eq_tokens);
				foreach ($eq_tokens_arr_m as $row2)
				{
					$eq_tokens_arr = explode("=",$row2);
					foreach ($eq_tokens_arr as $row3)
					{
						if($first){
							$token_ids = $row3;
							$first = false;
						}
						else{
							$token_ids = $token_ids.','.$row3;
						}
					}
				}
				$query = "SELECT * FROM tokens WHERE language_id='$language_id' and token_id not in($token_ids)";
			}
			else{
				$query = "SELECT * FROM tokens WHERE language_id='$language_id'";
			}
		}
		else{
			$query = "SELECT * FROM tokens WHERE language_id='$language_id'";
		}
//		echo $query;
		$results = $this->db->query($query);
		return $results->result();
	}
	
	function get_latest_user_invocation_tokens_by_language()
	{
		$user_id = $this->session->userdata('user_id');
		$language = $this->session->userdata('language');
		$query = "SELECT * FROM invocation_parameters where invocation_id = (SELECT id FROM user_invocations WHERE user_id='$user_id' and id in (select invocation_id from invocation_parameters where language_id='$language') order by invoked_time desc LIMIT 1)";
		$results = $this->db->query($query);
		return $results->result();
	}
	
	function get_all_prev_eq_tokens($prev_invo_params)
	{
		if($prev_invo_params){
			$language_id = $this->session->userdata('language');
			$eq_tokens = '';
			foreach ($prev_invo_params as $row)
			{
				$eq_tokens = $row->equal_tokens;
			}
			$eq_tokens_arr = explode("|",$eq_tokens);
			return $eq_tokens_arr;
		}
		return NULL;
	}
	
	function get_all_prev_sup_tokens($prev_invo_params)
	{
		if($prev_invo_params){
			$language_id = $this->session->userdata('language');
			$token_ids = '';
			foreach ($prev_invo_params as $row)
			{
				$token_ids = $row->suppressed_tokens;
			}
			$query = "SELECT * FROM tokens WHERE language_id='$language_id' and token_id in($token_ids)";
			$results = $this->db->query($query);
			return $results->result();
		}
		return NULL;
	}
}