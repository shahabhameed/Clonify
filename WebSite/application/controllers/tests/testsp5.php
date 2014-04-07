<?php
require_once(dirname(__FILE__)."/../auth.php");

class TestSP5 extends CI_Controller
{    
    function __construct()
    {          
      parent::__construct();
      
      $this->load->library('unit_test');
      $this->load->library('form_validation');
      $this->load->library('tank_auth');
      $this->load->library('security');
      $this->load->library('SyntaxHighlighter');
      $this->load->library('StringCompare');
      $this->load->library('scc');
      $this->load->helper('tree');
      
    }
    
    public function index(){
      $userId = $this->tank_auth->get_user_id();
      $invocationId = $this->getUserInvocations();      
      $this->getUserInvocationById($invocationId, $userId);
      
      $this->getTreeData($invocationId);
      $this->getDirName($invocationId, 0);
      $this->getDirName($invocationId, 1);
      
      $this->getAllFileCloneClasses($invocationId);
      $this->getAllFileCloneClassesByDir($invocationId);
      $this->getAllFileCloneClassesByGroup($invocationId);
      $this->getAllSCSWithInFile($invocationId);
      $this->getFilesByDir($invocationId);
      
      $this->getAllFileCloneClasses(0);
      $this->getAllFileCloneClassesByDir(0);
      $this->getAllFileCloneClassesByGroup(0);
      $this->getAllSCSWithInFile(0);
      $this->getFilesByDir(0);
      
      echo $this->unit->report();
    }
       
    private function getUserInvocations(){
      $data = $this->scc->getUserInvocations();      
      $invocation_id = null;
      if ($data){
        $invocation_id =  $data[0]['id'];
      }
      $total = count($data);      
      $this->unit->run($total, 'is_int', "getUserInvocations Test");
      return $invocation_id;
    }
    
    private function getUserInvocationById($invocationId, $userId){
      $data = $this->scc->getUserInvocationById($invocationId, $userId);
      if ($data){
        $data = json_decode(json_encode($data), true);
      }            
      $total = count($data);
      
      $this->unit->run($total, 'is_int', "getUserInvocationById Test");
    }
    
    private function getDirName($invocationId, $dirId){
      $dir_name = get_dir_name($dirId, $invocationId);     
      $this->unit->run($dir_name, 'is_string', "Get Dir Name[$invocationId][$dirId]");
    }
    
    private function getTreeData($invocationId, $func='is_array'){
      $treeData = create_tree($invocationId);
      
      $this->unit->run($treeData, 'is_string', "Gte Tree Data against InvocationId[$invocationId]");      
    }
    
    private function getAllFileCloneClasses($invocationId, $func='is_array'){
      $result = $this->scc->getAllFCC($invocationId);         
      $this->unit->run($result, $func, "Get All FCC Data of Primary Table InvocationId[$invocationId]");
      
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fcc_id']] = $this->scc->getAllFCCSecondaryTableRows($row, $invocationId);
        }
      }
      
      $this->unit->run($secondary_table_rows, $func, "Get All FCC Secondray Table Data of InvocationId[$invocationId]");
    }
    
    private function getAllFileCloneClassesByDir($invocationId, $func='is_array'){
      $result = $this->scc->getAllFCCDIR($invocationId);   
      $this->unit->run($result, 'is_array', "Get All FCC By Dir Data of Primary Table InvocationId[$invocationId]");
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fcc_id']] = $this->scc->getAllFCCDIrSecondaryTableRows($row, $invocationId);
        }
      }
      
      $this->unit->run($secondary_table_rows, $func, "Get All FCC by Dir Secondray Table Data of InvocationId[$invocationId]");
    }
    
    private function getAllFileCloneClassesByGroup($invocationId, $func='is_array'){
      $result = $this->scc->getAllFCCGroup($invocationId);
      $this->unit->run($result, $func, "Get All FCC By Group Data of Primary Table InvocationId[$invocationId]");
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fcc_id']] = $this->scc->getAllFCCGroupSecondaryTableRows($row, $invocationId);
        }
      }
      
      $this->unit->run($secondary_table_rows, $func, "Get All FCC by Group Secondray Table Data of InvocationId[$invocationId]");
    }
    
    private function getAllSCSWithInFile($invocationId, $func='is_array'){
      $results = $this->scc->getAllSCSWithInFile($invocationId);
      $this->unit->run($results, $func, "Get All SCC By File Data InvocationId[$invocationId]");    
    }
    
    private function getFilesByDir($invocationId, $func='is_array'){
      $result = $this->db->query('select count(*) as noofinstance, cmdirectory_id 
									from invocation_files tb1    
									where tb1.invocation_id = '.$invocationId.'
									group by cmdirectory_id')->result_array();
        
      $this->unit->run($result, $func, "Get All Files By Dir Primary Table Data InvocationId[$invocationId]");    
      
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $res = $this->db->query('select * from invocation_files as tb1
											join repository_file as tb2 on tb1.file_id = tb2.id 
											where invocation_id = '.$invocationId.' and cmdirectory_id = '.$row['cmdirectory_id'])->result_array();
	   $secondary_table_rows[$row['cmdirectory_id']] = $res;
	 }         
      }
      
      $this->unit->run($result, $func, "Get All Files By Dir Secondary Table Data InvocationId[$invocationId]");            
    }   
}
   