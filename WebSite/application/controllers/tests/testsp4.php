<?php
require_once(dirname(__FILE__)."/../auth.php");

class TestSP4 extends CI_Controller
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
      
    }
    
    public function index(){
      $userId = $this->tank_auth->get_user_id();
      $invocationId = $this->getUserInvocations();      
      $this->getUserInvocationById($invocationId, $userId);
      
      $row = $this->getAllFCSWithinGroup($invocationId);
      $this->getAllFCSWithinGroupSecondaryTableRows($row, $invocationId);
      
      $row = $this->getAllFCSCrossGroup($invocationId);
      $this->getAllFCSCrossGroupSecondaryTableRows($row, $invocationId);
      
      $row = $this->getAllFCSWithinDirectory($invocationId);
      $this->getAllFCSWithinDirectorySecondaryTableRows($row, $invocationId);
      
      $row = $this->getAllFCSCrossDirectory($invocationId);
      $this->getAllFCSCrossDirectorySecondaryTableRows($row, $invocationId);
            
      echo $this->unit->report();
    }
        
    private function getAllFCSCrossDirectory($invocationId){
      $data = $this->scc->getAllFCSCrossDirectory($invocationId);                
      $total = count($data);
      $row = array();
      if ($total > 0){
        $row = isset($data[0]) ? $data[0] : array();
      }
      $this->unit->run($total, 'is_array', "getAllFCSCrossDirectory Test If User Has Any FCS Within Directory Rows With InvocationId[$invocationId]  Will Pass if If we have more rows");
      return $row;
    }
    
    private function getAllFCSCrossDirectorySecondaryTableRows($row, $invocationId){
      $data = $this->scc->getAllFCSCrossDirectorySecondaryTableRows($row, $invocationId);                
      $total = count($data);
      
      $this->unit->run($total, 'is_array', "getAllFCSWithinGroupSecondaryTableRows Test If User Has Any Secondary Table Rows");
    }
    
    private function getAllFCSWithinDirectory($invocationId){
      $data = $this->scc->getAllFCSWithinDirectory($invocationId);                
      $total = count($data);
      $row = array();
      if ($total > 0){
        $row = isset($data[0]) ? $data[0] : array();
      }
      $this->unit->run($total, 'is_array', "getAllFCSWithinDirectory Test If User Has Any FCS Within Directory Rows With InvocationId[$invocationId]  Will Pass if If we have more rows");
      return $row;
    }
    
    private function getAllFCSWithinDirectorySecondaryTableRows($row, $invocationId){
      $data = $this->scc->getAllFCSWithinDirectorySecondaryTableRows($row, $invocationId);                
      $total = count($data);
      
      $this->unit->run($total, 'is_array', "getAllFCSWithinGroupSecondaryTableRows Test If User Has Any Secondary Table Rows");
    }
    
    private function getAllFCSWithinGroup($invocationId){
      $data = $this->scc->getAllFCSWithinGroup($invocationId);                
      $total = count($data);
      $row = array();
      if ($total > 0){
        $row = isset($data[0]) ? $data[0] : array();
      }
      $this->unit->run($total, 'is_array', "getAllFCSWithinGroup Test If User Has Any FCS Within Group Rows With InvocationId[$invocationId]  Will Pass if If we have more rows");
      return $row;
    }
    
    private function getAllFCSWithinGroupSecondaryTableRows($row, $invocationId){
      $data = $this->scc->getAllFCSWithinGroupSecondaryTableRows($row, $invocationId);                
      $total = count($data);
      
      $this->unit->run($total, 'is_array', "getAllFCSWithinGroupSecondaryTableRows Test If User Has Any Secondary Table Rows");
    }
    
    private function getAllFCSCrossGroup($invocationId){
      $data = $this->scc->getAllFCSCrossGroup($invocationId);                
      $total = count($data);
      $row = array();
      if ($total > 0){
        $row = isset($data[0]) ? $data[0] : array();
      }
      $this->unit->run($total, 'is_array', "getAllFCSCrossGroup Test If User Has Any FCS Cross Group Rows With InvocationId[$invocationId]  Will Pass if If we have more rows");
      return $row;
    }
    
    private function getAllFCSCrossGroupSecondaryTableRows($row, $invocationId){
      $data = $this->scc->getAllFCSCrossGroupSecondaryTableRows($row, $invocationId);                
      $total = count($data);
      
      $this->unit->run($total, 'is_array', "getAllFCSCrossGroupSecondaryTableRows Test If User Has Any Secondary Table Rows");
    }
    
    private function getUserInvocationById($invocationId, $userId){
      $data = $this->scc->getUserInvocationById($invocationId, $userId);
      if ($data){
        $data = json_decode(json_encode($data), true);
      }            
      $total = count($data);
      
      $this->unit->run($total, 'is_int', "getUserInvocationById Test");
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

}
   