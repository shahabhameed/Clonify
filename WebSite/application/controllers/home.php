<?php

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Home extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->library('tank_auth');
      $this->load->library('SyntaxHighlighter');
      $this->load->library('scc');
      $this->load->library('mcc');
      $this->load->library('common');
      $this->load->helper('tree');
      if (!$this->tank_auth->is_logged_in()) {         // Not logged in
        redirect('/auth/login/');
      }
    }

    public function index() {
      $data['user_id'] = $this->tank_auth->get_user_id();
      $data['username'] = $this->tank_auth->get_username();            
      $this->load->view('partials/main_header', $data);
      $this->load->view('dashboard.php');
      $this->load->view('partials/main_footer');
    }

    public function loadCode() {
      $clone_list_id = $this->input->post('clone_list_id');
      $invocation_id = $this->input->post('invocation_id');
      $scc_id = $this->input->post('scc_id');
      $start_line = $this->input->post('start_line');
      $end_line = $this->input->post('end_line');
      $fid = $this->input->post('fid');
      $lines = array();
      $miniMapLinks = array();
      $miniMapLinkLable = array();
      
      $filePath = $this->input->post('file_path');
      $obj = new SyntaxHighlighter($filePath, 'java');
      $obj->EnableLineNumbers();
      $colors = array('#BDD6A9', '#C8CEC3', '#CCFBA8', '#BCD7A9', '#D5E0CE', '#D8EDCA', '#C3CFBC', '#E1F0DE',
                      '#C8E9F6', '#AEDFF2', '#9DE1FF', '#AFE4FD', '#C2D4DE', '#B7CCD4', '#B9D7E6', '#ADD6EB');
      $row = 1;
      $total = count($colors);
      if (!$clone_list_id && !$start_line && !$start_line){        
        $temp = explode(",", $scc_id);
        foreach($temp as $t){
          $scc_ids[$t] = $t;
        }
        
        foreach($scc_ids as $scc_id){
          $scc_instances = $this->scc->getSCCInstancesBySCCId($invocation_id, $scc_id);
          if ($scc_instances){
            foreach($scc_instances as $scc_instance){
              $lines = array();
              for ($i = $scc_instance['startline']; $i <= $scc_instance['endline']; $i++) {
                $lines[] = $i;
              }
              $r = $row % $total;
              
              $line_color = "background-color:" . $colors[$r] .";";
              $obj->HighlightLines($lines, $line_color);
              $miniMapLinks[] = $scc_instance['startline'];
              $miniMapLinkLable[$scc_instance['startline']] = array('text' => '  ', 'rows' => $scc_instance['endline'] - $scc_instance['startline']);

              $row++;              
            }
          }
        }
      }else{
        for ($i = $start_line; $i <= $end_line; $i++) {
          $lines[] = $i;
        }
        $miniMapLinks[] = $start_line;
        $miniMapLinkLable[$start_line] = array('text' => '  ', 'rows' => $end_line - $start_line);
        $obj->HighlightLines($lines,null);
      }

      $obj->AddMiniMapLinkLabel($miniMapLinkLable);
      $window_id = $this->input->post('window_id');
      $obj->SetId("window" . $window_id);
      $first_row = $miniMapLinks[0];
      
      echo "<span><input type='hidden' id='startline-".$window_id."' value='".$first_row."'></span>";
      echo $obj->getFormattedCode();
    }

    public function SingleCloneClassByFile(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $results = $this->scc->getSCSSByFileData($invocationId);   
      $viewData['results'] = $results;
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scc_file.php', $viewData);
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneStructureWithinFile(){      
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $results = $this->scc->getAllSCSWithInFile($invocationId);   
      $viewData['results'] = $results;
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scs_within_file.php', $viewData);
      $this->load->view('partials/main_footer');
    }

    public function SingleCloneStructureAcrossFile() {

        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $results = $this->scc->getAllSCSAcrossFile($invocationId);
        $viewData['scc_data'] = $results;
		
        $secondary_table_rows = array();
        if ($results) {
            foreach ($results as $row) {
                $secondary_table_rows[$row['scs_crossfile_id']] = $this->scc->getALLSCSAcrossFileSecondaryTable($row,$invocationId);
           //scs_crossfile_id or scc_id
                }
        }

        $viewData['scs_clone_list_data'] = $secondary_table_rows;
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/scs_across_file.php', $viewData);
        $this->load->view('partials/main_footer');
        
        
    

    }
    
    public function fcswithindirectory(){
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $this->getInvocationIdFromURL();
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/fcswithindirectory.php', $viewData);
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneStructureFCSWithinGroup(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $result = $this->scc->getAllFCSWithinGroup($invocationId);   
      $viewData['parent_table_data'] = $result;
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fcs_ingroup_id']] = $this->scc->getAllFCSWithinGroupSecondaryTableRows($row, $invocationId);
        }
      }
      
      $viewData['secondary_table_rows'] = $secondary_table_rows;      
      $viewData['treedata'] = create_tree($invocationId);
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/fcs_within_group.php', $viewData);
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneStructureFCSCrossGroup(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $result = $this->scc->getAllFCSCrossGroup($invocationId);   
      $viewData['parent_table_data'] = $result;
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fcs_crossgroup_id']] = $this->scc->getAllFCSCrossGroupSecondaryTableRows($row, $invocationId);
        }
      }
      
      $viewData['secondary_table_rows'] = $secondary_table_rows;      
      $viewData['treedata'] = create_tree($invocationId);
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/fcs_cross_group.php', $viewData);
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneStructureFCSWithinDirectory(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $result = $this->scc->getAllFCSWithinDirectory($invocationId);   
      $viewData['parent_table_data'] = $result;
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fcs_indir_id']] = $this->scc->getAllFCSWithinDirectorySecondaryTableRows($row, $invocationId);
        }
      }
            
      $viewData['secondary_table_rows'] = $secondary_table_rows;      
      
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $viewData['treedata'] = create_tree($invocationId);
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/fcs_within_directory.php', $viewData);
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneStructureFCSCrossDirectory(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $result = $this->scc->getAllFCSCrossDirectory($invocationId);   
      $viewData['parent_table_data'] = $result;
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fcs_crossdir_id']] = $this->scc->getAllFCSCrossDirectorySecondaryTableRows($row, $invocationId);
        }
      }
      
      $viewData['secondary_table_rows'] = $secondary_table_rows;      
      $viewData['treedata'] = create_tree($invocationId);
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/fcs_cross_directory.php', $viewData);
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneClass() {
      $viewData = array();
      $invocationId = $this->getInvocationIdFromURL();
      $result = $this->scc->getAllSCCRows($invocationId);   
      $viewData['scc_data'] = $result;
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['scc_id']] = $this->scc->getAllSCCSecondaryTableRows($row, $invocationId);
        }
      }
      
      $viewData['scc_clone_list_data'] = $secondary_table_rows;
      $viewData['invocationId'] = $invocationId;
      $viewData['showCloneView'] = true;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scc.php', $viewData);
      $this->load->view('partials/main_footer');
    }
    
    private function getInvocationIdFromURL($index=3){
      $invocationId = $this->uri->segment($index);
      $userId = $this->tank_auth->get_user_id();
      if (!$invocationId){
        redirect('/home/');
      }
      $data = $this->scc->getUserInvocationById($invocationId, $userId);
      if (!$data){
        redirect('/home/');
      }
      return $invocationId;
    }
    
    function cloneDifference(){
      $file1_clone_string = $this->common->extractClonedSubstring($this->input->post('file_1_path'), $this->input->post('file_1_start_line'), $this->input->post('file_1_end_line')) ;
      $file2_clone_string = $this->common->extractClonedSubstring($this->input->post('file_2_path'), $this->input->post('file_2_start_line'), $this->input->post('file_2_end_line')) ;
      $obj =  new StringCompare();      
      $test_result = $obj->getDifferenceBetweenStrings($file1_clone_string, $file2_clone_string);      
      $data = implode(",", $test_result);
      echo $data;
    }
	
    public function MethodCloneClass() {
      $viewData = array();
      $invocationId = $this->getInvocationIdFromURL();
      $result = $this->mcc->getAllMCCRows($invocationId);   
      $viewData['mcc_data'] = $result;
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['mcc_id']] = $this->mcc->getAllMCCSecondaryTableRows($row, $invocationId);
        }
      }
      
      $viewData['mcc_clone_list_data'] = $secondary_table_rows;
      $viewData['invocationId'] = $invocationId;
      $viewData['showCloneView'] = true;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/mcc.php', $viewData);
      $this->load->view('partials/main_footer');
    }

    public function MethodCloneClassByFile(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $result = $this->mcc->getMCCByFileData($invocationId);   
      $viewData['mcc_data'] = $result;

	  $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fid']] = $this->mcc->getMCCByFileSecondaryTableRows($row, $invocationId);
        }
      }
	  
	  $viewData['mcc_file_data'] = $secondary_table_rows;

      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/mcc_by_file.php', $viewData);
      $this->load->view('partials/main_footer');
    }
	
   public function MethodByFile(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $result = $this->mcc->getMethodByFileData($invocationId);   
      $viewData['file_data'] = $result;

	  $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['fid']] = $this->mcc->getMethodByFileSecondaryTableRows($row, $invocationId);
        }
      }
	  
	  $viewData['file_method_data'] = $secondary_table_rows;

      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/method_by_file.php', $viewData);
      $this->load->view('partials/main_footer');
    }
	public function SCCByMethod() {
      $viewData = array();
      $invocationId = $this->getInvocationIdFromURL();
      $result = $this->scc->getMethodByClassPrimaryRows($invocationId);   
      $viewData['scc_Method_data'] = $result;
	  
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['mid']] = $this->scc->getMethodByClassSecondaryRows($row['mid'], $invocationId);
        }
      }
      
      $viewData['scc_Method_secondary_data'] = $secondary_table_rows;
	  
      $viewData['invocationId'] = $invocationId;
      $viewData['showCloneView'] = true;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scc_by_method.php', $viewData);
      $this->load->view('partials/main_footer');
    }
	public function MethodCloneStructureAcrossFile(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $results = $this->mcc->getAllMCSAcrossFile($invocationId);   
      $viewData['mcs_data'] = $results;
      
	   $secondary_table_rows = array();
        if ($results) {
            foreach ($results as $row) {
                $secondary_table_rows[$row['mcs_crossfile_id']] = $this->mcc->getAllMCSAcrossFileChildTable($row,$invocationId);
          
                }
        }

      $viewData['mcs_clone_list_data'] = $secondary_table_rows;
		
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/mcs_across_file.php', $viewData);
      $this->load->view('partials/main_footer');
    }

  }
  