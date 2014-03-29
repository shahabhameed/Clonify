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
        //$query = "SELECT t1.mcc_instance_id, t1.mcc_id, t1.mid, t1.tc, t1.pc, t1.fid, t1.did, t1.gid, t2.mname methodname, CONCAT(repository_name,directory_name,file_name) filename FROM mcc_instance t1, method t2, repository_file f,repository_directory d,	user_repository r WHERE mcc_id=$mcc_id and t1.mid=t2.mid and d.id=f.directory_id and d.repository_id=r.id and f.id=t1.fid";
	//$query = "SELECT t1.mcc_instance_id, t1.mcc_id, t1.mid, t1.tc, t1.pc, t1.fid, t1.did, t1.gid, t2.mname methodname, CONCAT(repository_name,directory_name,file_name) filename, t2.startline, t2.endline FROM mcc_instance t1, method t2, repository_file f,repository_directory d,	user_repository r WHERE mcc_id=$mcc_id and t1.mid=t2.mid and d.id=f.directory_id and d.repository_id=r.id and f.id=t1.fid";
//	$query = "SELECT t1.mcc_instance_id, t1.mcc_id, t1.mid, t1.tc, t1.pc, t1.fid, t1.did, t1.gid, t2.mname methodname, CONCAT(directory_name,file_name) filename, CONCAT(repository_name,directory_name,file_name) filepath, t2.startline, t2.endline FROM mcc_instance t1, method t2, repository_file f,repository_directory d,	user_repository r WHERE mcc_id=$mcc_id and t1.mid=t2.mid and d.id=f.directory_id and d.repository_id=r.id and f.id=t1.fid";
		$query = "SELECT t1.mcc_instance_id, t1.mcc_id, t1.mid, t1.tc, t1.pc, t1.fid, t1.did, t1.gid, t2.mname methodname, CONCAT(directory_name,file_name) filename, CONCAT(repository_name,directory_name,file_name) filepath, t2.startline, t2.endline FROM mcc_instance t1, method t2, repository_file f,repository_directory d,	user_repository r WHERE mcc_id=$mcc_id and t1.invocation_id=$invocationId and t1.mid=t2.mid and d.id=f.directory_id and d.repository_id=r.id and f.id=(select file_id from invocation_files where cmfile_id=t1.fid and invocation_id=$invocationId) group by t1.mcc_instance_id";
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

        $query = "SELECT t1.mcc_id,t1.atc,t1.apc,t1.members length, (select GROUP_CONCAT(scc_id) from mcc_scc where invocation_id=$invocationId and mcc_id = t1.mcc_id group by t1.mcc_id) scc FROM mcc t1 INNER JOIN mcc_instance t2 on t1.mcc_id = t2.mcc_id where t1.invocation_id=$invocationId group by t2.mcc_id";

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
     
		$query = "SELECT tb2.mcs_crossfile_id, tb2.members, 
		(select GROUP_CONCAT(mcc_id) 
		from mcscrossfile_mcc 
		where invocation_id=$invocationId and mcs_crossfile_id = tb2.mcs_crossfile_id 
		group by mcs_crossfile_id ) mcc_id_csv 
		FROM 
		mcs_crossfile tb2 
		INNER JOIN mcscrossfile_mcc tb3 ON tb2.mcs_crossfile_id = tb3.mcs_crossfile_id
		INNER JOIN mcc tb1 ON tb1.mcc_id = tb3.mcc_id
		WHERE tb1.invocation_id = $invocationId  GROUP BY tb2.mcs_crossfile_id";
      
		$result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getMCSAcrossFileChildTable( $mcs_id,$invocationId) {
 
		$query = "SELECT tb1.mcs_crossfile_id, tb1.fid, tb1.did, tb1.gid,tb4.file_name, 
		tb7.mcc_id, tb5.directory_name,  
		tb4.directory_id,tb6.repository_name,
		(select GROUP_CONCAT(mid) from mcscrossfile_methods where  mcs_crossfile_id = tb1.mcs_crossfile_id and fid=tb1.fid ) mid_csv 
		FROM mcscrossfile_methods tb7,
		mcscrossfile_file tb1
		INNER JOIN invocation_files tb3 ON tb1.invocation_id = tb3.invocation_id AND tb1.fid = tb3.cmfile_id
		INNER JOIN repository_file tb4 ON tb3.file_id = tb4.id
		INNER JOIN repository_directory tb5 ON tb4.directory_id = tb5.id 
		INNER JOIN user_repository tb6  ON tb6.id = tb5.repository_id 
		WHERE tb1.invocation_id = $invocationId
		AND tb1.mcs_crossfile_id = $mcs_id
		GROUP BY tb1.fid";
	    $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getMCCBYFile($invocationId, $userId) {
		$query = "SELECT distinct mf.fid,m.did,m.gid,round(count(mf.mcc_id)/281,0) clones,CONCAT(directory_name,file_name) filename 
					FROM 
					mcc_instance m,
					mcc_file mf,
					repository_file f,
					repository_directory d,
					user_repository r,
					invocation_files i 
					where
					mf.invocation_id = $invocationId and
					m.invocation_id=mf.invocation_id and
					i.invocation_id=mf.invocation_id and
					i.cmfile_id=mf.fid and 
					f.id=i.file_id and 
					d.id=f.directory_id and 
					d.repository_id=r.id
					group by mf.fid";
		$result = $this->db->query($query);

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
	
	function getMCCByFileSecondaryTableRows($fid, $invocationId, $user_id) {
	//$query = "SELECT t1.mcc_id, t1.mid, t2.mname methodname, t2.startline, t2.endline FROM mcc_instance t1, method t2 WHERE fid=$fid and t1.mid=t2.mid and invocation_id=$invocationId";
	
	$query = "SELECT t1.mcc_instance_id,t1.mcc_id, t1.mid, t2.mname methodname, t2.startline, t2.endline, CONCAT(directory_name,file_name) filename, CONCAT(repository_name,directory_name,file_name) filepath FROM mcc_instance t1, method t2, repository_file f,repository_directory d,	user_repository r WHERE fid=$fid and t1.mid=t2.mid and t1.invocation_id=t2.invocation_id and t1.invocation_id=$invocationId and d.id=f.directory_id and d.repository_id=r.id and f.id=(select file_id from invocation_files where cmfile_id=$fid and invocation_id=$invocationId)
ORDER BY `t1`.`mcc_id` ASC";
        $result = $this->db->query($query);
        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }
	
    public function getMethodByFileSecondaryData($fid, $invocationId, $userId) {
		$query = "SELECT t2.mid, t2.startline, t2.endline, t2.mname, CONCAT(directory_name,file_name) filename, CONCAT(repository_name,directory_name,file_name) filepath FROM method_file t1, method t2, repository_file f,repository_directory d, user_repository r WHERE t1.mid=t2.mid and t1.invocation_id=t2.invocation_id and t1.fid = $fid and t1.invocation_id=$invocationId and d.id=f.directory_id and d.repository_id=r.id and f.id=(select file_id from invocation_files where cmfile_id=$fid and invocation_id=$invocationId) group by t2.mid";
		$result = $this->db->query($query);

        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }
	
	public function getMethodByFilePrimaryData($invocationId, $userId) {
		$query = "SELECT t1.group_id gid, t1.cmfile_id fid, t1.cmdirectory_id did, CONCAT(directory_name,file_name) filename, count(t2.mid) methods FROM repository_file f,repository_directory d, user_repository r, invocation_files t1 inner join method_file t2 on t1.cmfile_id=t2.fid and t1.invocation_id=t2.invocation_id WHERE d.id=f.directory_id and d.repository_id=r.id and f.id = t1.file_id and t2.invocation_id=$invocationId group by t1.cmfile_id";
		$result = $this->db->query($query);

        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }


}
