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
      $lines = array();
      $miniMapLinks = array();
      $miniMapLinkLable = array();
      $start_line = $this->input->post('start_line');
      $end_line = $this->input->post('end_line');
      
      for ($i = $start_line; $i <= $end_line; $i++) {
        $lines[] = $i;
      }
      $miniMapLinks[] = $start_line;
      $miniMapLinkLable[$start_line] = array('text' => 'Clone 1', 'rows' => $end_line - $start_line);
      
      $filePath = $this->input->post('file_path');
      $obj = new SyntaxHighlighter($filePath, 'java');
      $obj->EnableLineNumbers();


      $obj->HighlightLines($lines);
      $obj->AddMiniMapLinkLabel($miniMapLinkLable);
      $obj->SetId("window" . $clone_list_id);
      echo $obj->getFormattedCode();
    }

    public function SingleCloneClassByFile(){      
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scc_file.php');
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneStructureWithinFile(){      
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scs_within_file.php');
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneStructureAcrossFile(){
      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scs_across_file.php');
      $this->load->view('partials/main_footer');
    }
    
    public function SingleCloneClass() {
      $viewData = array();

      $result = $this->scc->getAllSCCRows();   
      $viewData['scc_data'] = $result;
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
          $secondary_table_rows[$row['scc_id']] = $this->scc->getAllSCCSecondaryTableRows($row);
        }
      }
      $viewData['scc_clone_list_data'] = $secondary_table_rows;

      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scc.php', $viewData);
      $this->load->view('partials/main_footer');
    }
    
    function cloneDifference(){
      $file1_clone_string = $this->common->extractClonedSubstring($this->input->post('file_1_path'), $this->input->post('file_1_start_line'), $this->input->post('file_1_end_line')) ;
      $file2_clone_string = $this->common->extractClonedSubstring($this->input->post('file_2_path'), $this->input->post('file_2_start_line'), $this->input->post('file_2_end_line')) ;
      $obj =  new StringCompare();      
      $test_result = $obj->getDifferenceBetweenStrings($file1_clone_string, $file2_clone_string);      
      $data = implode(",", $test_result);
      echo $data;
    }

  }
  