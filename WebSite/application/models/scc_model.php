<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SCC_model extends CI_Model
{
  private $scc_table;
  private $scc_instance_table;
  private $repository_file_table;
  private $repository_directory_table;
  
  function __construct(){
    parent::__construct();    
    $this->scc_table = 'scc';
    $this->scc_instance_table = 'scc_instance';
    $this->repository_file_table = 'repository_file';
    $this->repository_directory_table =  'repository_directory';
  }
  
  function getAllSCCSecondaryTableRows($scc_id, $invocationId, $user_id){
    
    $this->db->select('*');
    $this->db->from('scc_instance AS tb1');
    $this->db->join('repository_file AS tb2', 'tb1.fid = tb2.id', 'INNER');
    $this->db->join('repository_directory AS tb3', 'tb2.directory_id = tb3.id', 'INNER');
    $this->db->join('user_repository AS tb4', 'tb4.id = tb3.repository_id', 'INNER');
    $this->db->where('tb1.scc_id', $scc_id);
    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->result();
    }
    return NULL;    
    
  }
  
  
  public function getAllSCCRows($invocationId, $userId){
    
    $this->db->select('*');
    $this->db->from('scc');
    $this->db->where('invocation_id', $invocationId);

//    $this->db->from('scc AS tb1');
//    $this->db->join('scc_instance AS tb2', 'tb1.scc_id = tb2.scc_id', 'INNER');
//    $this->db->join('repository_file AS tb3', 'tb2.fid = tb3.id', 'INNER');
//    $this->db->join('repository_directory AS tb4', 'tb3.directory_id = tb4.id', 'INNER');
//    $this->db->where('tb1.invocation_id', $invocationId);
    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->result();
    }
    return NULL;    
  }
  
  
}