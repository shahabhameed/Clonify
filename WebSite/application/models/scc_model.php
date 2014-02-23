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
    $where = "tb1.invocation_id = $invocationId and tb1.scc_id= $scc_id";
    
    $this->db->select('*');    
    $this->db->from('scc_instance AS tb1');    
    $this->db->join('invocation_files AS tb21', 'tb1.fid = tb21.cmfile_id', 'INNER');
    $this->db->join('repository_file AS tb2', 'tb21.file_id = tb2.id', 'INNER');
    $this->db->join('repository_directory AS tb3', 'tb2.directory_id = tb3.id', 'INNER');
    $this->db->join('user_repository AS tb4', 'tb4.id = tb3.repository_id', 'INNER');
    $this->db->join('invocation_files AS tb5', 'tb5.file_id = tb2.id', 'INNER');
    $this->db->where($where);
    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->result();
    }        
    return NULL;    
    
  }
  
  
  public function getAllSCCRows($invocationId, $userId){
    $where = "tb1.invocation_id = $invocationId AND tb2.user_id=$userId";
    
    $this->db->select('tb1.*');
    $this->db->from('scc tb1');
    $this->db->join('user_invocations tb2', 'tb1.invocation_id = tb2.id', 'INNER');    
    $this->db->where($where);    

    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->result();
    }
    return NULL;    
  }
  
  public function getAllSCSWithInFile($invocationId, $userId){
    $where = "tb2.invocation_id = $invocationId AND tb3.invocation_id=$invocationId";
    
    $this->db->select('*');
    $this->db->from('scsinfile_file tb1');
    $this->db->join('scsinfile_scc tb2', 'tb1.scs_infile_id = tb2.scs_infile_id AND tb1.invocation_id = tb2.invocation_id', 'INNER');
    $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
    $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
    $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');    
    $this->db->where($where);

    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->result();
    }
    return array();
  }
  
  public function getSCCInstanceData($invocationId, $scc_id, $scc_instance_id, $userId){
    $where = "tb1.invocation_id = $invocationId AND tb1.scc_id=$scc_id AND scc_instance_id=$scc_instance_id";
    
    $this->db->select('*');
    $this->db->from('scc_instance tb1');    
    $this->db->where($where);

    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->row();
    }    
    return array();
  }
  
  public function getAllSCSWithInFileChildTable($invocationId, $scs_id){
    $where = "tb1.invocation_id = $invocationId AND tb1.scs_infile_id = $scs_id";
    
    $this->db->select('*');
    $this->db->from('scsinfile_fragments tb1');
    $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
    $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
    $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
    $this->db->join('user_repository AS tb6', 'tb6.id = tb5.repository_id', 'INNER');
    $this->db->where($where);

    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->result();
    }
    return array();
  }
  
  public function getSCSAcrossFileParentTable($invocationId, $userId){
    $where = "tb1.invocation_id = $invocationId";
    
    $this->db->select('*');
    $this->db->from('scs_crossfile tb1');
    $this->db->join('scscrossfile_scc tb2', 'tb1.scs_crossfile_id = tb2.scs_crossfile_id AND tb1.invocation_id = tb2.invocation_id', 'INNER');        
    $this->db->where($where);

    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->result();
    }
    return array();
  }
  
  public function getSCSAcrossFileChildTable($invocationId, $scs_id){
    $where = "tb1.invocation_id = $invocationId AND tb1.scs_crossfile_id = $scs_id";
    
    $this->db->select('*');
    $this->db->from('scscrossfile_file tb1');
    $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
    $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
    $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
    $this->db->join('user_repository AS tb6', 'tb6.id = tb5.repository_id', 'INNER');
    $this->db->where($where);

    $result = $this->db->get();
    if ($result->num_rows()> 0){      
      return $result->result();
    }
    return array();
  }
  
}