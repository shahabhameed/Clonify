<?php
require_once(dirname(__FILE__)."/../auth.php");

class TestSP3 extends CI_Controller
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
      $scc_id = $this->getAllSCCRows($invocationId);
      $this->getAllSCCSecondaryTableRows($invocationId, $scc_id);
      $this->getAllSCSWithInFile($invocationId);
      $this->getAllSCSAcrossFile($invocationId);
      $this->getSCSSByFileData($invocationId);
      $this->getSCCInstancesBySCCId($invocationId, $scc_id);
      
      echo $this->unit->report();
    }
    
    private function getSCCInstancesBySCCId($invocationId, $scc_id){
      $data = $this->scc->getSCCInstancesBySCCId($invocationId, $scc_id);                
      $total = count($data);      
      $this->unit->run($total, 'is_int', "getSCCInstancesBySCCId Test If User Has Any SCC Instance InvocationId[$invocationId] Will Pass if If we have more rows");
    }
    
    private function getSCSSByFileData($invocationId){
      $data = $this->scc->getSCSSByFileData($invocationId);                
      $total = count($data);      
      $this->unit->run($total, 'is_int', "getSCSSByFileData Test If User Has Any SCC BY File InvocationId[$invocationId] Will Pass if If we have more rows");
    }
    
    private function getAllSCSAcrossFile($invocationId){
      $data = $this->scc->getAllSCSAcrossFile($invocationId);                
      $total = count($data);      
      $this->unit->run($total, 'is_int', "getAllSCSAcrossFile Test If User Has Any SCS AcrossFile InvocationId[$invocationId] Will Pass if If we have more rows");
    }
    
    private function getAllSCSWithInFile($invocationId){
      $data = $this->scc->getAllSCSWithInFile($invocationId);                
      $total = count($data);      
      $this->unit->run($total, 'is_int', "getAllSCSWithInFile Test If User Has Any SCS WithInfile InvocationId[$invocationId] Will Pass if If we have more rows");      
    }
    
    private function getAllSCCRows($invocationId){
      $data = $this->scc->getAllSCCRows($invocationId);                
      $total = count($data);
      $scc_id = 0;
      if ($total > 0){
        $scc_id = $data[0]['scc_id'];
      }
      $this->unit->run($total, 'is_int', "getAllSCCRows Test If User Has Any SCC Rows With InvocationId[$invocationId]  Will Pass if If we have more rows");
      return $scc_id;
    }
    
    private function getAllSCCSecondaryTableRows($invocationId, $scc_id){
      $data = $this->scc->getAllSCCSecondaryTableRows($scc_id, $invocationId);                
      $total = count($data);
      
      $this->unit->run($total, 'is_int', "getAllSCCSecondaryTableRows Test If User Has Any SCC Child Row With InvocationId[$invocationId] SccId[$scc_id]  Will Pass if If we have more rows");
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
   