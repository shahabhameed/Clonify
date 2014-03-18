<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MCC_model extends CI_Model {

    private $scc_table;
    private $scc_instance_table;
    private $repository_file_table;
    private $repository_directory_table;

    function __construct() {
        parent::__construct();
        $this->mcc_table = 'mcc';
        $this->mcc_instance_table = 'mcc_instance';
        $this->repository_file_table = 'repository_file';
        $this->repository_directory_table = 'repository_directory';
    }

    function getAllMCCSecondaryTableRows($mcc_id, $invocationId, $user_id) {
        /*
          $where = "tb1.invocation_id = $invocationId and tb1.mcc_id= $mcc_id and tb21.invocation_id = $invocationId";

          $this->db->select('*');
          $this->db->from('mcc_instance AS tb1');
          $this->db->join('invocation_files AS tb21', 'tb1.fid = tb21.cmfile_id', 'INNER');
          $this->db->join('repository_file AS tb2', 'tb21.file_id = tb2.id', 'INNER');
          $this->db->join('repository_directory AS tb3', 'tb2.directory_id = tb3.id', 'INNER');
          $this->db->join('user_repository AS tb4', 'tb4.id = tb3.repository_id', 'INNER');

          $this->db->where($where);
          $result = $this->db->get();
         */
        $query = "SELECT t1.mcc_instance_id, t1.mcc_id, t1.mid, t1.tc, t1.pc, t1.fid, t1.did, t1.gid, t2.mname methodname, CONCAT(repository_name,directory_name,file_name) filename FROM mcc_instance t1, method t2, repository_file f,repository_directory d,	user_repository r WHERE mcc_id=$mcc_id and t1.mid=t2.mid and d.id=f.directory_id and d.repository_id=r.id and f.id=t1.fid";
        $result = $this->db->query($query);
        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    public function getAllMCCRows($invocationId, $userId) {
        /*
          $where = "tb1.invocation_id = $invocationId AND tb2.user_id=$userId";

          $this->db->select('tb1.*');
          $this->db->from('mcc tb1');
          $this->db->join('user_invocations tb2', 'tb1.invocation_id = tb2.id', 'INNER');
          $this->db->where($where);
         */

        $query = "SELECT t1.mcc_id,t1.atc,t1.apc,count(t2.mcc_id) length, (select GROUP_CONCAT(scc_id) from mcc_scc where mcc_id = t1.mcc_id group by t1.mcc_id) scc FROM mcc t1 INNER JOIN mcc_instance t2 on t1.mcc_id = t2.mcc_id where t1.invocation_id=$invocationId group by t2.mcc_id";

//      $result = $this->db->get();
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    public function getAllMCSWithInFile($invocationId, $userId) {
        $where = "tb1.invocation_id = $invocationId AND tb2.invocation_id = $invocationId AND tb3.invocation_id=$invocationId";

        $this->db->select('*');
        $this->db->from('scsinfile_file tb1');
        $this->db->join('scsinfile_scc tb2', 'tb1.scs_infile_id = tb2.scs_infile_id AND tb1.invocation_id = tb2.invocation_id', 'INNER');
        $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
        $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
        $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
        $this->db->where($where);
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getMCCInstanceData($invocationId, $scc_id, $scc_instance_id, $userId) {
        $where = "tb1.invocation_id = $invocationId AND tb1.scc_id=$scc_id AND scc_instance_id=$scc_instance_id";

        $this->db->select('*');
        $this->db->from('scc_instance tb1');
        $this->db->where($where);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return array();
    }

    public function getMCCInstancesByMCCId($invocationId, $scc_id, $userId) {
        $where = "tb1.invocation_id = $invocationId AND tb1.scc_id=$scc_id ";

        $this->db->select('*');
        $this->db->from('scc_instance tb1');
        $this->db->where($where);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getAllMCSWithInFileChildTable($invocationId, $scs_id) {
        $where = "tb1.invocation_id = $invocationId AND tb1.scs_infile_id = $scs_id AND tb3.invocation_id = $invocationId";

        $this->db->select('*');
        $this->db->from('scsinfile_fragments tb1');
        $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
        $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
        $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
        $this->db->join('user_repository AS tb6', 'tb6.id = tb5.repository_id', 'INNER');
        $this->db->where($where);

        $result = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getMCSAcrossFileParentTable($invocationId, $userId) {
        $where = "tb1.invocation_id = $invocationId";

        $this->db->select('*');
        $this->db->from('scs_crossfile tb1');
        $this->db->join('scscrossfile_scc tb2', 'tb1.scs_crossfile_id = tb2.scs_crossfile_id AND tb1.invocation_id = tb2.invocation_id', 'INNER');
        $this->db->where($where);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getMCSAcrossFileChildTable($invocationId, $scs_id) {
        $where = "tb1.invocation_id = $invocationId AND tb1.scs_crossfile_id = $scs_id AND tb3.invocation_id = $invocationId";

        $this->db->select('*');
        $this->db->from('scscrossfile_file tb1');
        $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
        $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
        $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
        $this->db->join('user_repository AS tb6', 'tb6.id = tb5.repository_id', 'INNER');
        $this->db->where($where);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getMCCBYFileParentTable($invocationId, $userId) {
        $where = "tb1.invocation_id = $invocationId AND tb3.invocation_id=$invocationId";

        $this->db->select('*');
        $this->db->from('scc_instance tb1');
        $this->db->join('scc tb2', 'tb1.scc_id = tb2.scc_id AND tb1.invocation_id=tb2.invocation_id', 'INNER');
        $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
        $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
        $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
        $this->db->join('user_repository AS tb6', 'tb6.id = tb5.repository_id', 'INNER');
        $this->db->where($where);


        $result = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getMCCByFileChildTable($invocationId, $file_id, $userId) {
        $where = "tb1.invocation_id = $invocationId AND tb1.fid=$file_id and tb3.invocation_id = $invocationId";

        $this->db->select('*');
        $this->db->from('scc_instance tb1');
        $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
        $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
        $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
        $this->db->join('user_repository AS tb6', 'tb6.id = tb5.repository_id', 'INNER');
        $this->db->where($where);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

}
