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
        $this->load->model('treemap_model');

        if (!$this->tank_auth->is_logged_in()) {         // Not logged in
            redirect('/auth/login/');
        }
    }

    public function index() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->load->view('partials/main_header', $data);
        $this->load->view('home.php');
        $this->load->view('partials/main_footer');
    }

    public function customloadcode() {
        $filePath = $this->input->post('file_path');
        $obj = new SyntaxHighlighter($filePath, 'java');
        $obj->EnableLineNumbers();
        $colors = array('#BDD6A9', '#C8CEC3', '#CCFBA8', '#BCD7A9', '#D5E0CE', '#D8EDCA', '#C3CFBC', '#E1F0DE',
            '#C8E9F6', '#AEDFF2', '#9DE1FF', '#AFE4FD', '#C2D4DE', '#B7CCD4', '#B9D7E6', '#ADD6EB');
        $window_id = $this->input->post('window_id');
        $obj->SetId("window" . $window_id);
        echo $obj->getFormattedCode();
    }

    public function loadCode() {
        $clone_list_id = $this->input->post('clone_list_id');
        $invocation_id = $this->input->post('invocation_id');
        $scc_id = $this->input->post('scc_id');
        $start_line = $this->input->post('start_line');
        $end_line = $this->input->post('end_line');
        $fid = $this->input->post('fid');
        $mid = $this->input->post('mid');

        $start_col = $this->input->post('strt_col');
        $end_col = $this->input->post('end_col');
        $window_id = $this->input->post('window_id');
        $col_code_id = $window_id % 2; 
        $color_code = "";
        if ($col_code_id == 0){
          $color_code = "#00FF00";
        }else{
          $color_code = "#FFFF00";
        }
        
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
        if (!$clone_list_id && !$start_line && !$start_line) {
            $temp = explode(",", $scc_id);
            foreach ($temp as $t) {
                $scc_ids[$t] = $t;
            }
            $all_lines = array();
            $counter = 0;
            $lines = array();            
            foreach ($scc_ids as $scc_id) {
                $scc_instances = $this->scc->getSCCInstancesBySCCId($invocation_id, $scc_id);
                if ($scc_instances) {
                    foreach ($scc_instances as $scc_instance) {
                        if (!$fid || $fid == $scc_instance['fid']) {
                            for ($i = $scc_instance['startline']; $i <= $scc_instance['endline']; $i++) {
                                $all_lines[] = $i;
                                $lines[] = $i;
                            }
                        }
                        $counter++;
                    }
                }
            }
            asort($lines);
            asort($all_lines);
            
            $val = array_count_values($all_lines);
            foreach ($val as $in => $v) {
                if ($v == 1) {
                    $opt = 0.5;
                } else if ($v == 2) {
                    $opt = 0.6;
                } else if ($v == 3) {
                    $opt = 0.7;
                } else if ($v == 4) {
                    $opt = 0.8;
                } else if ($v == 5) {
                    $opt = 0.9;
                } else if ($v == 6) {
                    $opt = 1.0;
                }

                $line_color = "background-color:$color_code;opacity:$opt;";
                $obj->HighlightLines($in, $line_color);
            }
            $pre = -3;
            foreach ($val as $in => $v){
              if ($in > $pre + 2) {                
                $miniMapLinks[] = $in;                                        
                $miniMapLinkLable[$in] = array('text' => '  ', 'rows' => 20);
                if (count($miniMapLinks) > 1){
                  $miniMapLinkLable[$miniMapLinks[count($miniMapLinks) - 2]]['rows'] = $counter;                  
                }
                $counter = 0;
              }
              $pre = $in;
              $counter++;
            }
            $miniMapLinkLable[$miniMapLinks[count($miniMapLinks) - 1 ]]['rows'] = $counter;
        } else if ($mid && !$start_line && !$start_line) {
            $temp = explode(",", $mid);
            foreach ($temp as $t) {
                $mids[$t] = $t;
            }
            $all_lines = array();
            $counter = 0;
            $lines = array();
            foreach ($mids as $m_id) {
                $scc_instances = $this->mcc->getMethodInstancesByMId($invocation_id, $m_id);
                if ($scc_instances) {
                        foreach ($scc_instances as $scc_instance) {
                            if (!$fid || $fid == $scc_instance['fid']) {
                                for ($i = $scc_instance['startline']; $i <= $scc_instance['endline']; $i++) {
                                    $all_lines[] = $i;
                                    $lines[] = $i;
                                }
                            }
                            $counter++;
                        }
                    }
            }
            asort($lines);
            asort($all_lines);

            $val = array_count_values($all_lines);
            foreach ($val as $in => $v) {
                if ($v == 1) {
                    $opt = 0.5;
                } else if ($v == 2) {
                    $opt = 0.6;
                } else if ($v == 3) {
                    $opt = 0.7;
                } else if ($v == 4) {
                    $opt = 0.8;
                } else if ($v == 5) {
                    $opt = 0.9;
                } else if ($v == 6) {
                    $opt = 1.0;
                }

                $line_color = "background-color:$color_code;opacity:$opt;";
                $obj->HighlightLines($in, $line_color);
            }
            $pre = -3;
            foreach ($val as $in => $v){
              if ($in > $pre + 2) {                
                $miniMapLinks[] = $in;                                        
                $miniMapLinkLable[$in] = array('text' => '  ', 'rows' => 20);
                if (count($miniMapLinks) > 1){
                  $miniMapLinkLable[$miniMapLinks[count($miniMapLinks) - 2]]['rows'] = $counter;                  
                }
                $counter = 0;
              }
              $pre = $in;
              $counter++;
            }
            $miniMapLinkLable[$miniMapLinks[count($miniMapLinks) - 1 ]]['rows'] = $counter;
        } else {
            for ($i = $start_line; $i <= $end_line; $i++) {
                $lines[] = $i;
            }
            $miniMapLinks[] = $start_line;
            $miniMapLinkLable[$start_line] = array('text' => '  ', 'rows' => $end_line - $start_line);
            $line_color = "background-color:$color_code";
            $obj->HighlightLines($lines, $line_color);
        }

        $obj->AddMiniMapLinkLabel($miniMapLinkLable);        
        $obj->SetId("window" . $window_id);
        $first_row = $miniMapLinks[0];

        echo "<span><input type='hidden' id='startline-" . $window_id . "' value='" . $first_row . "'></span>";
        echo $obj->getFormattedCode()."---!!!^^^".json_encode($this->common->extractFirstAndLastLine($filePath, $start_line, $end_line))."---!!!^^^".$color_code;
    }

    public function SingleCloneClassByFile() {
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

    public function SingleCloneStructureWithinFile() {
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
                $secondary_table_rows[$row['scs_crossfile_id']] = $this->scc->getALLSCSAcrossFileSecondaryTable($row, $invocationId);
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

    public function SingleCloneStructureFCSWithinGroup() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getAllFCSWithinGroup($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
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

    public function SingleCloneStructureFCSCrossGroup() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getAllFCSCrossGroup($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
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

    public function SingleCloneStructureFCSWithinDirectory() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getAllFCSWithinDirectory($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        $dids = array();
        if ($result) {
            foreach ($result as $row) {
                $dids[] = $row['directory_id'];
                $secondary_table_rows[$row['fcs_indir_id']] = $this->scc->getAllFCSWithinDirectorySecondaryTableRows($row, $invocationId);
            }
        }

        $viewData['secondary_table_rows'] = $secondary_table_rows;

        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;
        //$dids = array(0,1,2);
        $viewData['treemapdata'] = $this->treemap_model->get_fcs_within_dir_treemap($invocationId, $dids);
        $viewData['treedata'] = create_tree($invocationId);

        $this->load->view('partials/main_header');
        $this->load->view('clone_table/fcs_within_directory.php', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function SingleCloneStructureFCSCrossDirectory() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getAllFCSCrossDirectory($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
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
        if ($result) {
            foreach ($result as $row) {
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

    private function getInvocationIdFromURL($index = 3) {
        $invocationId = $this->uri->segment($index);
        $userId = $this->tank_auth->get_user_id();
        if (!$invocationId) {
            redirect('/home/');
        }
        $data = $this->scc->getUserInvocationById($invocationId, $userId);
        if (!$data) {
            redirect('/home/');
        }
        return $invocationId;
    }

    function cloneDifference() {
        $file1_clone_string = $this->common->extractClonedSubstring($this->input->post('file_1_path'), $this->input->post('file_1_start_line'), $this->input->post('file_1_end_line'), $this->input->post('file_1_start_col'), $this->input->post('file_1_end_col'));
        $file2_clone_string = $this->common->extractClonedSubstring($this->input->post('file_2_path'), $this->input->post('file_2_start_line'), $this->input->post('file_2_end_line'), $this->input->post('file_2_start_col'), $this->input->post('file_2_end_col'));
        $obj = new StringCompare();
        $test_result = $obj->getDifferenceBetweenStrings1($file1_clone_string, $file2_clone_string, $this->input->post('file_1_start_line'), $this->input->post('file_2_start_line'), $this->input->post('file_1_start_col'), $this->input->post('file_2_end_col'));
//        echo "<pre>".print_r($test_result)."</pre>";
        $data = implode(",", $test_result);
//        $data = json_encode($test_result);
        echo $data;
    }

    public function MethodCloneClass() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $result = $this->mcc->getAllMCCRows($invocationId);
        $viewData['mcc_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
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

    public function MethodCloneClassByFile() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->mcc->getMCCByFileData($invocationId);
        $viewData['mcc_data'] = $result;

        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
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

    public function MethodByFile() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->mcc->getMethodByFileData($invocationId);
        $viewData['file_data'] = $result;

        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
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
        if ($result) {
            foreach ($result as $row) {
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

    public function MethodCloneStructureAcrossFile() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $results = $this->mcc->getAllMCSAcrossFile($invocationId);
        $viewData['mcs_data'] = $results;

        $secondary_table_rows = array();
        if ($results) {
            foreach ($results as $row) {
                $secondary_table_rows[$row['mcs_crossfile_id']] = $this->mcc->getAllMCSAcrossFileChildTable($row, $invocationId);
            }
        }

        $viewData['mcs_clone_list_data'] = $secondary_table_rows;

        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/mcs_across_file.php', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function filecloneclass() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getAllFCC($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
                $secondary_table_rows[$row['fcc_id']] = $this->scc->getAllFCCSecondaryTableRows($row, $invocationId);
            }
        }

        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['invocationId'] = $invocationId;
        // print_r($viewData);exit;
        $viewData['showCloneView'] = true;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/fcc.php', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function filecloneclassbydir() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getAllFCCDIR($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
                $secondary_table_rows[$row['fcc_id']] = $this->scc->getAllFCCDIrSecondaryTableRows($row, $invocationId);
            }
        }

        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['invocationId'] = $invocationId;
        $viewData['treedata'] = create_tree($invocationId);
        $viewData['showCloneView'] = true;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/fccdir.php', $viewData);
        $this->load->view('partials/main_footer');
    }
    
    public function SCSAcrossMethod() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getSCSAcrossMethodPrimaryTable($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
          foreach ($result as $row) {
            $secondary_table_rows[$row['scs_crossmethod_id']] = $this->scc->getSCSAcrossMethodSecondaryTable($row['scs_crossmethod_id'], $invocationId);
          }
        }

        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['invocationId'] = $invocationId;        
        $viewData['showCloneView'] = true;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/scs_cross_method.php', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function fileCloneClassByGroup() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getAllFCCGroup($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
                $secondary_table_rows[$row['fcc_id']] = $this->scc->getAllFCCGroupSecondaryTableRows($row, $invocationId);
            }
        }

        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['invocationId'] = $invocationId;
        $viewData['treedata'] = create_tree($invocationId);
        $viewData['showCloneView'] = true;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/fcc_by_group.php', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function filebydir() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->db->query('select count(*) as noofinstance, cmdirectory_id 
									from invocation_files tb1    
									where tb1.invocation_id = ' . $invocationId . '
									group by cmdirectory_id')->result_array();
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
                $res = $this->db->query('select * from invocation_files as tb1
											join repository_file as tb2 on tb1.file_id = tb2.id 
											where invocation_id = ' . $invocationId . ' and cmdirectory_id = ' . $row['cmdirectory_id'])->result_array();
                $secondary_table_rows[$row['cmdirectory_id']] = $res;
            }
        }

        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['invocationId'] = $invocationId;
        $viewData['treedata'] = create_tree($invocationId);
        $viewData['showCloneView'] = true;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/filebydir.php', $viewData);
        $this->load->view('partials/main_footer');
    }

}
