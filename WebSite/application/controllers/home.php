<?php

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Home extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->library('tank_auth');
      $this->load->library('SyntaxHighlighter');
      $this->load->library('scc');
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
      $viewData = array();
      $scc_id = $this->input->post('scc_id');
      $clone_list_id = $this->input->post('clone_list_id');
      $file_path = $this->input->post('file_path');

      $userId = 15;
      $loadId = 1;
      $lines = array();
      $miniMapLinks = array();
      $miniMapLinkLable = array();
      $start_line = $this->input->post('start_line');
      $end_line = $this->input->post('end_line');
      if (true){//$clone_list_id == 0) {
        $fileName = 'Cocos2dxBitmap.java';
        for ($i = $start_line; $i <= $end_line; $i++) {
          $lines[] = $i;
        }
        $miniMapLinks[] = $start_line;
        $miniMapLinkLable[$start_line] = array('text' => 'Clone 1', 'rows' => $end_line - $start_line);
//        for ($i = 156; $i <= 190; $i++) {
//          $lines[] = $i;
//        }
//        $miniMapLinks[] = 156;
//        $miniMapLinkLable[156] = array('text' => 'Clone 2', 'rows' => 12);
      } 
//      else {
//        $fileName = 'Cocos2dxGLSurfaceView.java';
//        for ($i = 96; $i <= 108; $i++) {
//          $lines[] = $i;
//        }
//        $miniMapLinks[] = 96;
//        $miniMapLinkLable[96] = array('text' => 'Clone 1', 'rows' => 12);
//        for ($i = 196; $i <= 208; $i++) {
//          $lines[] = $i;
//        }
//        $miniMapLinks[] = 196;
//        $miniMapLinkLable[196] = array('text' => 'Clone 2', 'rows' => 12);
//      }

//      $filePath = UPLOADED_FILES_FOLDER . $userId . "/" . $loadId . "/" . $fileName;
      $filePath = $this->input->post('file_path');
      $obj = new SyntaxHighlighter($filePath, 'java');
      $obj->EnableLineNumbers();


      $obj->HighlightLines($lines);
      $obj->AddMiniMapLinkLabel($miniMapLinkLable);
      $obj->SetId("window" . $clone_list_id);
      echo $obj->getFormattedCode();
    }

    public function SingleCloneClass2() {
      $viewData = array();

      $result = $this->scc->getAllSCCRows();   
      $viewData['scc_data'] = $result;
      $secondary_table_rows = array();
      if ($result){
        foreach($result as $row){
//          echo "<pre>",print_r($this->scc->getAllSCCSecondaryTableRows($row)),"</pre>";
          $secondary_table_rows[$row['scc_id']] = $this->scc->getAllSCCSecondaryTableRows($row);
        }
      }
      $viewData['scc_clone_list_data'] = $secondary_table_rows;

      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scc2.php', $viewData);
      $this->load->view('partials/main_footer');
    }

  }
  