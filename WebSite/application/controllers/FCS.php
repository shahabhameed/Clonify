<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FCS extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('tank_auth');
        $this->load->library('SyntaxHighlighter');
        $this->load->library('scc');
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
        $this->load->view('dashboard.php');
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

                $line_color = "background-color:#C8CEC3;opacity:$opt;";
                $obj->HighlightLines($in, $line_color);
            }
            $pre = -3;

            foreach ($val as $in => $v) {
                if ($in > $pre + 2) {
                    $miniMapLinks[] = $in;
                    $miniMapLinkLable[$in] = array('text' => '  ', 'rows' => 50);
                }
                $pre = $in;
            }
        } else if ($mid && !$start_line && !$start_line) {
            $temp = explode(",", $mid);
            foreach ($temp as $t) {
                $mids[$t] = $t;
            }
            //print_r($mids);
            foreach ($mids as $m_id) {
                $scc_instances = $this->mcc->getMethodInstancesByMId($invocation_id, $m_id);
                if ($scc_instances) {
                    foreach ($scc_instances as $scc_instance) {
                        $lines = array();
                        for ($i = $scc_instance['startline']; $i <= $scc_instance['endline']; $i++) {
                            $lines[] = $i;
                        }
                        $r = $row % $total;

                        $line_color = "background-color:" . $colors[$r] . ";";
                        $obj->HighlightLines($lines, $line_color);
                        $miniMapLinks[] = $scc_instance['startline'];
                        $miniMapLinkLable[$scc_instance['startline']] = array('text' => '  ', 'rows' => $scc_instance['endline'] - $scc_instance['startline']);

                        $row++;
                    }
                }
            }
        } else {
            for ($i = $start_line; $i <= $end_line; $i++) {
                $lines[] = $i;
            }
            $miniMapLinks[] = $start_line;
            $miniMapLinkLable[$start_line] = array('text' => '  ', 'rows' => $end_line - $start_line);
            $obj->HighlightLines($lines, null);
        }

        $obj->AddMiniMapLinkLabel($miniMapLinkLable);
        $window_id = $this->input->post('window_id');
        $obj->SetId("window" . $window_id);
        $first_row = $miniMapLinks[0];

        echo "<span><input type='hidden' id='startline-" . $window_id . "' value='" . $first_row . "'></span>";
        echo $obj->getFormattedCode();
    }

    function parseDirStructure($directory, $parentName, $isGroup, &$map) {
        $output = "";
        if (!empty($directory)) {
            if ($directory ['dname'] == "") {
                $dname = $parentName;
            } else {
                $dname = $directory ['dname'];
            }
            $dsize = $directory['dsize'];

            $output.=$this->createParent($directory, $parentName, $map);

            $children = $directory['children'];
            if (!empty($children)) {
                foreach ($children as $child => $childData) {
                    $output.=$this->parseDirStructure($childData, $dname, $isGroup, $map);
                }
            }

            $files = $directory['files'];
            $output.=$this->traverseFiles($files, $isGroup, $map);
        }
        return $output;
    }

    function createParent($directory, $parentName, &$map) {
        $color = "57AC57";
        $output = "";
        if ($directory['dname'] != "") {
            $output = "{";
            $output.= "label: '" . $directory['dname'] . "',";
            $output.= "value: 1,";
            $output.="parent: '" . $parentName . "',";
            $output.="color: '#C8D0D2' ,";
            $output.="},";
            $map[] = array(
                'label' => $directory['dname'],
                'value' => 1,
                'parent' => $parentName,
                'color' => '#C8D0D2',
            );
        }
        /* else {
          $output.="label: '" . $parentName . "',";
          $output.="value: 1,";
          $output.="parent: 'Root',";
          } */
        //$output.= "color: '#".$color."',";

        return $output;
    }

    function random_color_part() {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }

    function traverseFiles($files, $isGroup, &$map) {
        $output = "";
        if (!empty($files)) {

            $isFirst = true;
            foreach ($files as $file => $filedata) {
                if ($isFirst) {
                    $min = $max = $filedata['clones'];
                    $isFirst = false;
                }
                if ($filedata['clones'] > $max) {
                    $max = $filedata['clones'];
                }
                if ($filedata['clones'] <= $min) {
                    $min = $filedata['clones'];
                }
            }
            $rangeSize = round(($max - $min) / 4);
            $r1 = $min + $rangeSize;
            $r2 = $r1 + $rangeSize;
            $r3 = $r2 + $rangeSize;
            foreach ($files as $file => $filedata) {
                $temp = array();
                $output.="{";
                if ($isGroup) {
                    $output.="label: '" . $filedata['gid'] . "',";
                    $temp['label'] = $filedata['gid'];
                } else {
                    //$output.="label: '" . $filedata['cmfid'] . "',";
                    $output.="label: ' ',";
                    $temp['label'] = ' ';
                }
                $output.="value: " . $filedata['fsize'] . ",";
                $temp['value'] = $filedata['fsize'];
                //$output.="value: " . $filedata['clones'] . ",";
                if (isset($filedata['clones'])) {
                    if ($filedata['clones'] >= $min && $filedata['clones'] <= $r1) {
                        $output.= "color: '#E3E3E3',";
                        $temp['color'] = '#E3E3E3';
                    } else if ($filedata['clones'] > $r1 && $filedata['clones'] <= $r2) {
                        $output.= "color: '#C4C4C4',";
                        $temp['color'] = '#C4C4C4';
                    } else if ($filedata['clones'] > $r2 && $filedata['clones'] <= $r3) {
                        $output.= "color: '#9E9E9E',";
                        $temp['color'] = '#9E9E9E';
                    } else if ($filedata['clones'] > $r3 && $filedata['clones'] <= $max) {
                        $output.= "color: '#696969',";
                        $temp['color'] = '#696969';
                    }
                }

                if ($filedata['dname'] == '') {
                    $output.="parent: 'Root',";
                    $temp['parent'] = 'Root';
                } else {
                    $output.="parent: '" . $filedata['dname'] . "',";
                    $temp['parent'] = $filedata['dname'];
                }
                //Uncomment to randomize color of each file block
                //$output.= "color: '#".random_color()."',";
                $output.="fid: '" . $filedata['cmfid'] . "',";
                $output.="filepath: '" . $filedata['filepath'] . "',";
                $output.="filename: '" . $filedata['filename'] . "',";
                //$output.="data: {fid:".$filedata['cmfid'].",description: '" . $filedata['dname'] . $filedata['filename'] . "</br>File Size: " . $filedata['fsize'] . "</br>No. of Clones: " . $filedata['clones'] . "', title: '" . $filedata['filename'] . "'}";
                $output.="data: {fid:" . $filedata['cmfid'] . ",description: 'File ID: " . $filedata['cmfid'] . "</br>File Size: " . $filedata['fsize'] . "</br>No. of Clones: " . $filedata['clones'] . "', title: '" . $filedata['filename'] . "'}";
                $output.="},";
                $temp['fid'] = $filedata['cmfid'];
                $temp['filepath'] = $filedata['filepath'];
                $temp['filename'] = $filedata['filename'];
                $temp['data'] = (array('fid' => $filedata['cmfid'], 'description' => "File ID: " . $filedata['cmfid'] . "</br>File Size: " . $filedata['fsize'] . "</br>No. of Clones: " . $filedata['clones'], 'title' => $filedata['filename']) );

                $map[] = $temp;
            }
        }
        return $output;
    }

    public function generateTreeMapData($treemapdata, $isGroup, &$map) {

        $map[] = array(
            'label' => 'Root',
            'value' => null,
            'color' => '#C8D0D2',
        );
        $output = "[";
        $output.="{";
        $output.="label: 'Root',";
        $output.="value: null,";
        $output.="color: '#C8D0D2'";
        $output.="},";

        if (isset($treemapdata)) {
            foreach ($treemapdata as $dirList => $data) {
                $output.= $this->parseDirStructure($data, "Root", $isGroup, $map);
            }
        }
        $output.="]";
        //echo "<pre>".print_r($output,true)."</pre>";
        //die();
        return $output;
    }

    public function FCSWithinGroup() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();

        $result = $this->scc->getAllFCSWithinGroup($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        $gids = array();
        if ($result) {
            foreach ($result as $row) {
                $gids[] = $row['group_id'];
                $secondary_table_rows[$row['fcs_ingroup_id']] = $this->scc->getAllFCSWithinGroupSecondaryTableRows($row, $invocationId);
            }
        }

        $gids = array_unique($gids);
        $treeMapData = $this->treemap_model->get_fcs_grp_treemap($invocationId, $gids);
        $map = array();
        $t = $this->generateTreeMapData($treeMapData, true, $map);
        $td = json_encode($map);
        $viewData['treemapdata'] =$td;// $this->generateTreeMapData($treeMapData, true, $map);
        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['treedata'] = create_tree($invocationId);
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/fcs_within_group.php', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function FCSCrossGroup() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $gids = array();
        $result = $this->scc->getAllFCSCrossGroup($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
                //$gids[] = $row['group_id'];
                $secondary_table_rows[$row['fcs_crossgroup_id']] = $this->scc->getAllFCSCrossGroupSecondaryTableRows($row, $invocationId);
            }
        }
        foreach ($secondary_table_rows as $temp1) {
            $tmp2 = array_keys($temp1);
            foreach ($tmp2 as $tmp22) {
                $gids[] = $tmp22;
            }
        }
        $gids = array_unique($gids);

        $treeMapData = $this->treemap_model->get_fcs_grp_treemap($invocationId, $gids);
        $map = array();
        $t = $this->generateTreeMapData($treeMapData, true, $map);
        $td = json_encode($map);

        $viewData['treemapdata'] = $td;
        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['treedata'] = create_tree($invocationId);
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/fcs_cross_group.php', $viewData);
        $this->load->view('partials/main_footer');
        return $viewData['treemapdata'];
    }

    public function FCSGroupTreeMap() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $gids = array();
        $result = $this->scc->getAllFCSCrossGroup($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
                //$gids[] = $row['group_id'];
                $secondary_table_rows[$row['fcs_crossgroup_id']] = $this->scc->getAllFCSCrossGroupSecondaryTableRows($row, $invocationId);
            }
        }
        foreach ($secondary_table_rows as $temp1) {
            $tmp2 = array_keys($temp1);
            foreach ($tmp2 as $tmp22) {
                $gids[] = $tmp22;
            }
        }
        $gids = array_unique($gids);
        $treeMapData = $this->treemap_model->get_fcs_grp_treemap($invocationId, $gids);
        $map = array();
        $viewData['treemapdata'] = $this->generateTreeMapData($treeMapData, true, $map);

        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['treedata'] = create_tree($invocationId);
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;
        $this->load->view('groupTreeMap', $viewData);
        $this->load->view('partials/main_header');
        $this->load->view('partials/main_footer');
    }

    public function FCSWithinDirectory() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $dids = array();
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
        //$dids = array(0,1);
        $dids = array_unique($dids);
        $treeMapData = $this->treemap_model->get_fcs_dir_treemap($invocationId, $dids);
        
        $map = array();
        $t = $this->generateTreeMapData($treeMapData, false, $map);
        $td = json_encode($map);
        
        $viewData['treemapdata'] = $td;//$this->generateTreeMapData($treeMapData, false, $map);
        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;
        $viewData['treedata'] = create_tree($invocationId);

        $this->load->view('partials/main_header');
        $this->load->view('clone_table/fcs_within_directory.php', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function FCSCrossDirectory() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $dids = array();
        $result = $this->scc->getAllFCSCrossDirectory($invocationId);
        $viewData['parent_table_data'] = $result;
        $secondary_table_rows = array();
        if ($result) {
            foreach ($result as $row) {
                $dids[] = $row['directory_id'];
                $secondary_table_rows[$row['fcs_crossdir_id']] = $this->scc->getAllFCSCrossDirectorySecondaryTableRows($row, $invocationId);
            }
        }
        $dids = array_unique($dids);
        $treeMapData = $this->treemap_model->get_fcs_dir_treemap($invocationId, $dids);
        $map = array();
        $t = $this->generateTreeMapData($treeMapData, false, $map);
        $td = json_encode($map);
        $viewData['treemapdata'] = $td;//$this->generateTreeMapData($treeMapData, false, $map);
        
        $viewData['secondary_table_rows'] = $secondary_table_rows;
        $viewData['treedata'] = create_tree($invocationId);
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;
        $this->load->view('partials/main_header');
        $this->load->view('clone_table/fcs_cross_directory.php', $viewData);
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
        $file1_clone_string = $this->common->extractClonedSubstring($this->input->post('file_1_path'), $this->input->post('file_1_start_line'), $this->input->post('file_1_end_line'));
        $file2_clone_string = $this->common->extractClonedSubstring($this->input->post('file_2_path'), $this->input->post('file_2_start_line'), $this->input->post('file_2_end_line'));
        $obj = new StringCompare();
        $test_result = $obj->getDifferenceBetweenStrings($file1_clone_string, $file2_clone_string);
        $data = implode(",", $test_result);
        echo $data;
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
        $viewData['treemapFCCdata'] = json_encode($secondary_table_rows);

        $dids = array();
        $result = $this->scc->getAllFCCDIR($invocationId);
        if ($result) {
            foreach ($result as $row) {
                $dids[] = $row['directory_id'];
            }
        }
        $dids = array_unique($dids);
        $treeMapData = $this->treemap_model->get_fcs_dir_treemap($invocationId, $dids);
        $map = array();
        $t = $this->generateTreeMapData($treeMapData, false, $map);
        $td = json_encode($map);
        $viewData['treemapdata'] = $t;//$this->generateTreeMapData($treeMapData, false, $map);
        $viewData['treedata'] = create_tree($invocationId);
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
