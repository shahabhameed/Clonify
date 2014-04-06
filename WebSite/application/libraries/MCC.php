<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MCC {

    private $error = array();

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('session');
        $this->ci->load->database();
        $this->ci->load->model('mcc_model');
        $this->ci->load->model('load_results_model');
    }

    function getAllMCCRows($invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();
        $data = $this->ci->mcc_model->getAllMCCRows($invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
    }

    function getAllMCCSecondaryTableRows($primary_table_row, $invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();

        $data = $this->ci->mcc_model->getAllMCCSecondaryTableRows($primary_table_row['mcc_id'], $invocationId, $userId);
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

    function getAllMCSWithInFile($invocationId) {
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

    function getAllMCSAcrossFile($invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();
        $data = $this->ci->mcc_model->getMCSAcrossFileParentTable($invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
       
    }

	
    function getAllMCSAcrossFileChildTable($primary_table_row,$invocationId) {
	
		$userId = $this->ci->tank_auth->get_user_id();
        $data = $this->ci->mcc_model->getMCSAcrossFileChildTable($primary_table_row['mcs_crossfile_id'], $invocationId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return  $data;
	
	}
	
    function getMCCByFileData($invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();

        $data = $this->ci->mcc_model->getMCCBYFile($invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
		
		return $data;
    }

    public function getSCCInstanceData($invocationId, $scc_id, $scc_instance_id, $userId) {
        $data = $this->ci->scc_model->getSCCInstanceData($invocationId, $scc_id, $scc_instance_id, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }

        return $data;
    }

    public function getSCCInstancesBySCCId($invocationId, $scc_id) {
        $userId = $this->ci->tank_auth->get_user_id();
        $data = $this->ci->scc_model->getSCCInstancesBySCCId($invocationId, $scc_id, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }

        return $data;
    }
	
	function getMCCByFileSecondaryTableRows($primary_table_row, $invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();

        $data = $this->ci->mcc_model->getMCCByFileSecondaryTableRows($primary_table_row['fid'], $invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
    }
	
   function getMethodByFileData($invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();

        $data = $this->ci->mcc_model->getMethodByFilePrimaryData($invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
		
		return $data;
    }
	
	function getMethodByFileSecondaryTableRows($primary_table_row, $invocationId) {
        $userId = $this->ci->tank_auth->get_user_id();

        $data = $this->ci->mcc_model->getMethodByFileSecondaryData($primary_table_row['fid'], $invocationId, $userId);
        if ($data) {
            $data = json_decode(json_encode($data), true); // Changing Obj in Array
        }
        return $data;
    }
	public function getMethodInstancesByMId($invocationId, $m_id){
   // $userId = $this->ci->tank_auth->get_user_id();
    $data = $this->ci->mcc_model->getMethodInstancesByMId($invocationId, $m_id);
    if ($data){
      $data = json_decode(json_encode($data), true); // Changing Obj in Array
    }
    
    return $data;
  }

}
