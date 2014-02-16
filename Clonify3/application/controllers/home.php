<?php

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Home extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->library('tank_auth');
      $this->load->library('SyntaxHighlighter');
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

      $userId = 15;
      $loadId = 1;
      $lines = array();
      $miniMapLinks = array();
      $miniMapLinkLable = array();
      if ($clone_list_id == 0) {
        $fileName = 'Cocos2dxBitmap.java';
        for ($i = 56; $i <= 68; $i++) {
          $lines[] = $i;
        }
        $miniMapLinks[] = 56;
        $miniMapLinkLable[56] = array('text' => 'Clone 1', 'rows' => 12);
        for ($i = 156; $i <= 168; $i++) {
          $lines[] = $i;
        }
        $miniMapLinks[] = 156;
        $miniMapLinkLable[156] = array('text' => 'Clone 2', 'rows' => 12);
      } else {
        $fileName = 'Cocos2dxGLSurfaceView.java';
        for ($i = 96; $i <= 108; $i++) {
          $lines[] = $i;
        }
        $miniMapLinks[] = 96;
        $miniMapLinkLable[96] = array('text' => 'Clone 1', 'rows' => 12);
        for ($i = 196; $i <= 208; $i++) {
          $lines[] = $i;
        }
        $miniMapLinks[] = 196;
        $miniMapLinkLable[196] = array('text' => 'Clone 2', 'rows' => 12);
      }

      $filePath = UPLOADED_FILES_FOLDER . $userId . "/" . $loadId . "/" . $fileName;
      $obj = new SyntaxHighlighter($filePath, 'java');
      $obj->EnableLineNumbers();


      $obj->HighlightLines($lines);
      $obj->AddMiniMapLinkLabel($miniMapLinkLable);
      $obj->SetId("window" . $clone_list_id);
      echo $obj->getFormattedCode();
    }

    public function SingleCloneClass() {
      $viewData = array();

      $viewData['scc_data'] = array(
        array(
          'no' => 0,
          'scc_id' => 0,
          'length' => 38,
          'total_clones' => 2,
        ),
        array(
          'no' => 1,
          'scc_id' => 1,
          'length' => 147,
          'total_clones' => 2,
        ),
      );

      $viewData['scc_clone_list_data'] = array(
        0 => array(
          array(
            'clone_list_id' => 0,
            'no' => 0,
            'gid' => 0,
            'did' => 0,
            'fid' => 4,
            'start_line' => 56,
            'end_line' => 68,
            'file_name' => 'File1.php',
          ),
          array(
            'clone_list_id' => 1,
            'no' => 1,
            'gid' => 0,
            'did' => 0,
            'fid' => 4,
            'start_line' => 96,
            'end_line' => 108,
            'file_name' => 'File1.php',
          ),
        )
      );




      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scc.php', $viewData);
      $this->load->view('partials/main_footer');
    }

    public function SingleCloneClass2() {
      $viewData = array();

      $viewData['scc_data'] = array(
        array(
          'no' => 0,
          'scc_id' => 0,
          'length' => 38,
          'total_clones' => 2,
        ),
        array(
          'no' => 1,
          'scc_id' => 1,
          'length' => 147,
          'total_clones' => 2,
        ),
      );

      $viewData['scc_clone_list_data'] = array(
        0 => array(
          array(
            'clone_list_id' => 0,
            'no' => 0,
            'gid' => 0,
            'did' => 0,
            'fid' => 4,
            'start_line' => 56,
            'end_line' => 68,
            'file_name' => 'File1.php',
          ),
          array(
            'clone_list_id' => 1,
            'no' => 1,
            'gid' => 0,
            'did' => 0,
            'fid' => 4,
            'start_line' => 96,
            'end_line' => 108,
            'file_name' => 'File1.php',
          ),
        ),
        1 => array(
          array(
            'clone_list_id' => 0,
            'no' => 0,
            'gid' => 0,
            'did' => 0,
            'fid' => 4,
            'start_line' => 56,
            'end_line' => 68,
            'file_name' => 'File3.php',
          ),
          array(
            'clone_list_id' => 1,
            'no' => 1,
            'gid' => 0,
            'did' => 0,
            'fid' => 4,
            'start_line' => 96,
            'end_line' => 108,
            'file_name' => 'File4.php',
          ),
        ),
      );




      $this->load->view('partials/main_header');
      $this->load->view('clone_table/scc2.php', $viewData);
      $this->load->view('partials/main_footer');
    }

  }
  