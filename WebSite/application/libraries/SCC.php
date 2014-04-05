<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SCC
{
  private $error = array();

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('session');
        $this->ci->load->database();
        $this->ci->load->model('scc_model');
        $this->ci->load->model('load_results_model');
    }

    function getAllSCCRows($invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();

        $data = $this->ci->scc_model->getAllSCCRows($invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
    }

    function getAllSCCSecondaryTableRows($primary_table_row, $invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();

        $data = $this->ci->scc_model->getAllSCCSecondaryTableRows($primary_table_row['scc_id'], $invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
    }

    function getUserInvocationById($invocationId, $userId) {
        return $this->ci->load_results_model->get($invocationId, $userId);
    }

    function getUserInvocations() {
        $data = $this->ci->load_results_model->get_all_results();
        if ($data) {
            return json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return array();
    }

    function getAllSCSWithInFile($invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();

        $data = $this->ci->scc_model->getAllSCSWithInFile($invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        $result = array();

        foreach ($data as $d) {
            $result[$d['scs_infile_id']]['scs_infile_id'] = $d['scs_infile_id'];
            $result[$d['scs_infile_id']]['fid'] = $d['fid'];
            $result[$d['scs_infile_id']]['members'] = $d['members'];
            $result[$d['scs_infile_id']]['file_name'] = $d['file_name'];
            $result[$d['scs_infile_id']]['directory_id'] = $d['directory_id'];
            $result[$d['scs_infile_id']]['group_id'] = $d['group_id'];
            $result[$d['scs_infile_id']]['directory_name'] = $d['directory_name'];
            $result[$d['scs_infile_id']]['scc_id'][] = $d['scc_id'];
        }
        foreach ($result as $index => $r) {
            $result[$index]['scc_id_csv'] = implode(", ", $result[$index]['scc_id']);
            $child_data = $this->ci->scc_model->getAllSCSWithInFileChildTable($invocationId, $index);
            if ($child_data) {
                $child_data = json_decode(json_encode($child_data), true); // Changing Obj in Array
            }
            $result[$index]['members'] = count($child_data);
            foreach ($child_data as $in => $data) {
                $instance_data = $this->getSCCInstanceData($invocationId, $data['scc_id'], $data['scc_instance_id'], $userId);
                $child_data[$in]['startline'] = isset($instance_data['startline']) ? $instance_data['startline'] : "";
                $child_data[$in]['startcol'] = isset($instance_data['startcol']) ? $instance_data['startcol'] : "";
                $child_data[$in]['endline'] = isset($instance_data['endline']) ? $instance_data['endline'] : "";
                $child_data[$in]['endcol'] = isset($instance_data['endcol']) ? $instance_data['endcol'] : "";
            }

            $result[$index]['child_rows'] = $child_data;
        }

        return $result;
    }

    function getAllSCSAcrossFile($invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();
        $data = $this->ci->scc_model->getSCSAcrossFileParentTable($invocationId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
    }

    function getALLSCSAcrossFileSecondaryTable($primary_table_row,$invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();
        $data = $this->ci->scc_model->getSCSAcrossFileChildTable($primary_table_row['scs_crossfile_id'], $invocationId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return  $data;
    }
    
 
  function getAllFCSWithinGroup($invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    
    $data = $this->ci->scc_model->getAllFCSWithinGroupRows($invocationId, $userId);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
      foreach($data as &$d){
        $r = $this->ci->scc_model->getFCSWithinGroupStructureIDS($invocationId, $d['fcs_ingroup_id'], $userId);
        $fcc_ids = array();
        if ($r){
          $temp = json_decode(json_encode($r), true);
          if ($temp){
            foreach($temp as $t){
              $fcc_ids[] = $t['fcc_id'];
            }
          }
        }
        $d['fcc_ids'] = implode(", ", $fcc_ids);
      }
    }    
    return $data;
  }
  function getAllFCC($invocationId){

    $userId = $this->ci->tank_auth->get_user_id();
    
    $data = $this->ci->scc_model->getAllFCCRows($invocationId, $userId);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
      foreach($data as &$d){
        $r = $this->ci->scc_model->getFCCStructureIDS($invocationId, $d['fcc_id'], $userId);
        $fcc_ids = array();
        if ($r){
          $temp = json_decode(json_encode($r), true);
          if ($temp){
            foreach($temp as $t){
              $fcc_ids[] = $t['scc_id'];
            }
          }
        }
        $d['fcc_ids'] = implode(", ", $fcc_ids);
      }
    }    
    return $data;
  }
 function getAllFCCDIR($invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = $this->ci->scc_model->getAllFCCDIRRows($invocationId, $userId);
    $data = json_decode(json_encode($data), true);
    return $data;
  }
  
 function getAllFCCGroup($invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = $this->ci->scc_model->getAllFCCGroupsRows($invocationId, $userId);
    $data = json_decode(json_encode($data), true);
    return $data;
  }
  
  function getAllFCSCrossGroup($invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    
    $data = $this->ci->scc_model->getAllFCSCrossGroupRows($invocationId, $userId);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
      foreach($data as &$d){
        $r = $this->ci->scc_model->getFCSCrossGroupStructureIDS($invocationId, $d['fcs_crossgroup_id'], $userId);
        $fcc_ids = array();
        if ($r){
          $temp = json_decode(json_encode($r), true);
          if ($temp){
            foreach($temp as $t){
              $fcc_ids[] = $t['fcc_id'];
            }
          }
        }
        $d['fcc_ids'] = implode(", ", $fcc_ids);
      }
    }    
    return $data;
  }
  
  function getAllFCSWithinDirectory($invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    
    $data = $this->ci->scc_model->getAllFCSWithinDirectoryRows($invocationId, $userId);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
      foreach($data as &$d){
        $r = $this->ci->scc_model->getFCSWithinDirectoryStructureIDS($invocationId, $d['fcs_indir_id'], $userId);
        $fcc_ids = array();
        if ($r){
          $temp = json_decode(json_encode($r), true);
          if ($temp){
            foreach($temp as $t){
              $fcc_ids[] = $t['fcc_id'];
            }
          }
        }
        $d['fcc_ids'] = implode(", ", $fcc_ids);
      }
    }    
    return $data;
  }
  
  function getAllFCSCrossDirectory($invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    
    $data = $this->ci->scc_model->getAllFCSCrossDirectoryRows($invocationId, $userId);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
      foreach($data as &$d){
        $r = $this->ci->scc_model->getFCSCrossGroupStructureIDS($invocationId, $d['fcs_crossdir_id'], $userId);
        $fcc_ids = array();
        if ($r){
          $temp = json_decode(json_encode($r), true);
          if ($temp){
            foreach($temp as $t){
              $fcc_ids[] = $t['fcc_id'];
            }
          }
        }
        $d['fcc_ids'] = implode(", ", $fcc_ids);
      }
    }    
    return $data;
  }
  
  function getAllFCSWithinGroupSecondaryTableRows($primary_table_row, $invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = null;
    $result = array();
    if (!empty($primary_table_row['fcc_ids'])){
      $fcc_ids = join(", ", array_unique(explode(", ", $primary_table_row['fcc_ids'])));
      $data = $this->ci->scc_model->getAllFCSWithinGroupSecondaryTableRows($primary_table_row['fcs_ingroup_id'], $fcc_ids, $invocationId, $userId);
      if ($data){
        $data = json_decode(json_encode($data), true);
        foreach($data as $d){
          $result[$d['fcsingroup_instance_id']][] = $d['fid'];
        }
      }    
    }
    return $result;
  }  
  function getAllFCCSecondaryTableRows($primary_table_row, $invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = null;
    $result = array();
    $data = $this->ci->scc_model->getAllFCCSecondaryTableRows($primary_table_row['fcc_id'], $invocationId, $userId);
    if ($data){
     return  $data = json_decode(json_encode($data), true);
    }    
    return $result;
  }  
  function getAllFCCDirSecondaryTableRows($primary_table_row, $invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = null;
    $result = array();
    $data = $this->ci->scc_model->getAllFCCDirSecondaryTableRows($primary_table_row['directory_id'], $invocationId, $userId);
    if ($data){
     return  $data = json_decode(json_encode($data), true);
    }    
    return $result;
  }  
  
  function getAllFCCGroupSecondaryTableRows($primary_table_row, $invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = null;
    $result = array();
    $data = $this->ci->scc_model->getAllFCCGroupSecondaryTableRows($primary_table_row['group_id'], $invocationId, $userId);
    if ($data){
     return  $data = json_decode(json_encode($data), true);
    }    
    return $result;
  }  
  
  function getAllFCSCrossGroupSecondaryTableRows($primary_table_row, $invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = null;
    $result = array();
    if (!empty($primary_table_row['fcc_ids'])){
      $fcc_ids = join(", ", array_unique(explode(", ", $primary_table_row['fcc_ids'])));
      $data = $this->ci->scc_model->getAllFCSCrossGroupSecondaryTableRows($primary_table_row['fcs_crossgroup_id'], $fcc_ids, $invocationId, $userId);
      if ($data){
        $data = json_decode(json_encode($data), true);
        foreach($data as $d){
          $result[$d['group_id']][] = $d['fid'];
        }        
      }    
    }
    return $result;
  }  
  
  function getAllFCSWithinDirectorySecondaryTableRows($primary_table_row, $invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = null;
    $result = array();
    if (!empty($primary_table_row['fcc_ids'])){
      $fcc_ids = join(", ", array_unique(explode(", ", $primary_table_row['fcc_ids'])));
      $data = $this->ci->scc_model->getAllFCSWithinDirectorySecondaryTableRows($primary_table_row['fcs_indir_id'], $fcc_ids, $invocationId, $userId);
      if ($data){
        $data = json_decode(json_encode($data), true);
        foreach($data as $d){
          $result[$d['fcsindir_instance_id']][] = $d['fid'];
        }                
      }    
    }
    return $result;
  }  
  
  function getAllFCSCrossDirectorySecondaryTableRows($primary_table_row, $invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = null;
    $result = array();
    if (!empty($primary_table_row['fcc_ids'])){
      $fcc_ids = join(", ", array_unique(explode(", ", $primary_table_row['fcc_ids'])));
      $data = $this->ci->scc_model->getAllFCSCrossDirectorySecondaryTableRows($primary_table_row['fcs_crossdir_id'], $fcc_ids, $invocationId, $userId);
      if ($data){
        $data = json_decode(json_encode($data), true);
        foreach($data as $d){
          $result[$d['directory_id']][] = $d['fid'];
        }                        
      }    
    }
    return $result;
  }  
  
  function getSCSSByFileData($invocationId){
    $userId = $this->ci->tank_auth->get_user_id();
    
    $data = $this->ci->scc_model->getSCCBYFileParentTable($invocationId, $userId);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
    }
    $result = array();
    
    foreach($data as $d){      
      $result[$d['fid']]['members'] = $d['members'];
      $result[$d['fid']]['fid'] = $d['fid'];
      $result[$d['fid']]['group_id'] = $d['group_id'];
      $result[$d['fid']]['directory_id'] = $d['directory_id'];
      $result[$d['fid']]['directory_name'] = $d['directory_name'];
      $result[$d['fid']]['file_name'] = $d['file_name'];
      $result[$d['fid']]['length'] = $d['length'];
    }
    foreach($result as $index => $r){
      $child_data = $this->ci->scc_model->getSCCByFileChildTable($invocationId, $r['fid'], $userId);
      $result[$index]['members'] = count($child_data);
      if ($child_data){
        $child_data = json_decode(json_encode($child_data), true); // Changing Obj in Array
      }            
      $result[$index]['child_rows'] = $child_data;      
    }
    
    return $result;
  }
  
  public function getSCCInstanceData($invocationId, $scc_id, $scc_instance_id, $userId){
    $data = $this->ci->scc_model->getSCCInstanceData($invocationId, $scc_id, $scc_instance_id, $userId);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
    }
    
    return $data;
  }
  
  public function getSCCInstancesBySCCId($invocationId, $scc_id){
    $userId = $this->ci->tank_auth->get_user_id();
    $data = $this->ci->scc_model->getSCCInstancesBySCCId($invocationId, $scc_id, $userId);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
    }
    
    return $data;
  }
  
  function getMethodByClassPrimaryRows($invocationId) {
        //$userId = $this->ci->tank_auth->get_user_id();
        $data = $this->ci->scc_model->getSCCByMethodPrimaryTable($invocationId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
    }
	function getMethodByClassSecondaryRows($mid, $invocationId) {
        //$userId = $this->ci->tank_auth->get_user_id();
        $data = $this->ci->scc_model->getSCCByMethodSecondaryTable($mid,$invocationId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
    }
  
}
