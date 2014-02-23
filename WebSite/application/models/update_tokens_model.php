<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Update_tokens_model extends CI_Model
{
	function get_all_languages()
	{
		$query = "SELECT * FROM languages where id<>7";
		$results = $this->db->query($query);
		
		return $results->result();
	}
	
	function update($fileName)
	{
		//echo "</br>";
		$language = $_POST['language'];
		$txt_file    = file_get_contents('uploads/'.$fileName.'.txt');
		
		$rows        = explode("\n", $txt_file);
		array_shift($rows);

		$values = '';
		
		foreach($rows as $row => $data)
		{
			//get row data
			$row_data = explode(',', $data);
			$id = trim($row_data[0]);
			$name = trim($row_data[1]);
			//display data
			/*echo ' ID:-'.$id.'-';
			echo '<br />';
			echo ' Name:-' . $name.'-';
			echo '<br />';*/
			$values = $values.'('.$language.','.$id.',\''.$name.'\'),';
		}
		$values = substr($values, 0, -1);
		//	echo $values;
		
		$query = "delete from tokens where language_id = '$language'";
		$this->db->query($query);
		$query = "INSERT INTO tokens values $values";
		$this->db->query($query);		
	}
	
	function get_all_language_tokens($language)
	{
		$query = "SELECT * FROM tokens WHERE language_id='$language'";
		$results = $this->db->query($query);
		return $results->result();
	}
	
}