<?php

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Home extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->library('tank_auth');
      $this->load->library('SyntaxHighlighter');
      $this->load->library('scc');
      $this->load->library('common');
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
      $lines = array();
      $miniMapLinks = array();
      $miniMapLinkLable = array();
      
      $filePath = $this->input->post('file_path');
      $obj = new SyntaxHighlighter($filePath, 'java');
      $obj->EnableLineNumbers();
      $colors = array('#BDD6A9', '#C8CEC3', '#CCFBA8', '#BCD7A9', '#D5E0CE', '#D8EDCA', '#C3CFBC', '#E1F0DE',
                      '#C8E9F6', '#AEDFF2', '#9DE1FF', '#AFE4FD', '#C2D4DE', '#B7CCD4', '#B9D7E6', '#ADD6EB');
      $row = 1;
      if (!$clone_list_id && !$start_line && !$start_line){
        $scc_instances = $this->scc->getSCCInstancesBySCCId($invocation_id, $scc_id);
        if ($scc_instances){
          foreach($scc_instances as $scc_instance){
            $lines = array();
            for ($i = $scc_instance['startline']; $i <= $scc_instance['endline']; $i++) {
              $lines[] = $i;
            }
            $color_index = count($colors) % $row;
            $line_color = "background-color:" . $colors[$color_index] .";";            
            $obj->HighlightLines($lines, $line_color);
            $miniMapLinks[] = $scc_instance['startline'];
            $miniMapLinkLable[$scc_instance['startline']] = array('text' => '  ', 'rows' => $scc_instance['endline'] - $scc_instance['startline']);
            
            $row++;
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
    
    public function SingleCloneStructureAcrossFile(){
      $viewData = array();      
      $invocationId = $this->getInvocationIdFromURL();
      
      $results = $this->scc->getAllSCSAcrossFile($invocationId);   
      $viewData['results'] = $results;
      
      $viewData['showCloneView'] = true;
      $viewData['invocationId'] = $invocationId;
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scs_across_file.php', $viewData);
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

  }
  