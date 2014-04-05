<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SCC_model extends CI_Model {

    private $scc_table;
    private $scc_instance_table;
    private $repository_file_table;
    private $repository_directory_table;

    function __construct() {
        parent::__construct();
        $this->scc_table = 'scc';
        $this->scc_instance_table = 'scc_instance';
        $this->repository_file_table = 'repository_file';
        $this->repository_directory_table = 'repository_directory';
    }

  
    function getAllFCSWithinGroupSecondaryTableRows($fcs_ingroup_id, $fcc_ids, $invocationId, $user_id) {
        $where = "invocation_id = $invocationId and fcs_ingroup_id= $fcs_ingroup_id and fcc_id IN ($fcc_ids) and invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcs_withingroup_files');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }
    function getAllFCCSecondaryTableRows($fcc_id, $invocationId, $user_id) {
        $where = "tb1.invocation_id = $invocationId and tb1.fcc_id= $fcc_id";
        $this->db->select('*');
        $this->db->from('fcc_instance as tb1');
        $this->db->join('invocation_files tb3', 'tb1.fid = tb3.cmfile_id', 'INNER');
        $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
        $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
        $this->db->join('user_repository AS tb6', 'tb6.id = tb5.repository_id', 'INNER');
        $this->db->where($where);
        $result = $this->db->get();
        // print_r($result->result());exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }
    function getAllFCCDirSecondaryTableRows($dir_id, $invocationId, $user_id) {
        $where = "tb1.invocation_id = $invocationId and tb1.directory_id= $dir_id";
        $this->db->select('*');
        $this->db->from('fcc_by_directory as tb1');
        $this->db->join('invocation_files tb3', 'tb1.fcc_id = tb3.cmfile_id', 'INNER');
        $this->db->join('repository_file tb4', 'tb3.file_id = tb4.id', 'INNER');
        $this->db->join('repository_directory tb5', 'tb4.directory_id = tb5.id', 'INNER');
        $this->db->join('user_repository AS tb6', 'tb6.id = tb5.repository_id', 'INNER');
        $this->db->where($where);
        $result = $this->db->get();
         //print_r($result->result());exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getAllFCSCrossGroupSecondaryTableRows($fcs_crossgroup_id, $fcc_ids, $invocationId, $user_id) {
        $where = "invocation_id = $invocationId and fcs_crossgroup_id= $fcs_crossgroup_id and fcc_id IN ($fcc_ids) and invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcs_crossgroup_files');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getAllFCSWithinDirectorySecondaryTableRows($fcs_indir_id, $fcc_ids, $invocationId, $user_id) {
        $where = "invocation_id = $invocationId and fcs_indir_id= $fcs_indir_id and fcc_id IN ($fcc_ids) and invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcs_withindir_files');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getAllFCSCrossDirectorySecondaryTableRows($fcs_crossdir_id, $fcc_ids, $invocationId, $user_id) {
        $where = "invocation_id = $invocationId and fcs_crossdir_id= $fcs_crossdir_id and fcc_id IN ($fcc_ids) and invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcs_crossdir_files');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getAllFCSWithinGroupRows($invocationId, $user_id) {
        $where = "invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcs_withingroup');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    } 
    function getAllFCCRows($invocationId, $user_id) {
        $where = "invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcc');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }
     function getAllFCCDIRRows($invocationId, $user_id) {
        $where = "tb1.invocation_id = $invocationId";
        $this->db->select('*,count("tb1.fcs_id") as noofinstance');
        $this->db->from('fcc_by_directory tb1');
        $this->db->group_by('tb1.directory_id');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
           return $result->result();
        }
        return NULL;
    }

    function getAllFCSCrossGroupRows($invocationId, $user_id) {
        $where = "invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcs_crossgroup');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getAllFCSWithinDirectoryRows($invocationId, $user_id) {
        $where = "invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcs_withindir');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getAllFCSCrossDirectoryRows($invocationId, $user_id) {
        $where = "invocation_id = $invocationId";
        $this->db->select('*');
        $this->db->from('fcs_crossdir');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getFCSWithinGroupStructureIDS($invocationId, $fcs_ingroup_id, $user_id) {
        $where = "invocation_id = $invocationId AND fcs_ingroup_id = $fcs_ingroup_id";
        $this->db->select('*');
        $this->db->from('fcs_withingroup_fcc');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }
    function getFCCStructureIDS($invocationId, $fcc_id, $user_id) {
        $where = "invocation_id = $invocationId AND fcc_id = $fcc_id";
        $this->db->select('*');
        $this->db->from('fcc_scc');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getFCSCrossGroupStructureIDS($invocationId, $fcs_crossgroup_id, $user_id) {
        $where = "invocation_id = $invocationId AND fcs_crossgroup_id = $fcs_crossgroup_id";
        $this->db->select('*');
        $this->db->from('fcs_crossgroup_fcc');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getFCSWithinDirectoryStructureIDS($invocationId, $fcs_indir_id, $user_id) {
        $where = "invocation_id = $invocationId AND fcs_indir_id = $fcs_indir_id";
        $this->db->select('*');
        $this->db->from('fcs_withindir_fcc');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getFCSCrossDirectoryStructureIDS($invocationId, $fcs_crossdir_id, $user_id) {
        $where = "invocation_id = $invocationId AND fcs_crossdir_id = $fcs_crossdir_id";
        $this->db->select('*');
        $this->db->from('fcs_crossdir_fcc');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    public function getAllSCCRows($invocationId, $userId) {
        $where = "tb1.invocation_id = $invocationId AND tb2.user_id=$userId";

        $this->db->select('tb1.*');
        $this->db->from('scc tb1');
        $this->db->join('user_invocations tb2', 'tb1.invocation_id = tb2.id', 'INNER');
        $this->db->where($where);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }
    
    public function getAllSCCSecondaryTableRows($scc_id, $invocationId, $user_id) {
        $where = "tb1.invocation_id = $invocationId and tb1.scc_id= $scc_id and tb21.invocation_id = $invocationId";

        $this->db->select('*');
        $this->db->from('scc_instance AS tb1');
        $this->db->join('invocation_files AS tb21', 'tb1.fid = tb21.cmfile_id', 'INNER');
        $this->db->join('repository_file AS tb2', 'tb21.file_id = tb2.id', 'INNER');
        $this->db->join('repository_directory AS tb3', 'tb2.directory_id = tb3.id', 'INNER');
        $this->db->join('user_repository AS tb4', 'tb4.id = tb3.repository_id', 'INNER');

        $this->db->where($where);
        $result = $this->db->get();
        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    public function getAllSCSWithInFile($invocationId, $userId) {
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

    public function getSCCInstanceData($invocationId, $scc_id, $scc_instance_id, $userId) {
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

    public function getSCCInstancesBySCCId($invocationId, $scc_id, $userId) {
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

    public function getAllSCSWithInFileChildTable($invocationId, $scs_id) {
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

    public function getSCSAcrossFileParentTable($invocationId) {


        $query = "select * from 
                (select tb1.scs_crossfile_id,tb1.tc,tb1.pc,members,
                tb2.scc_id 
                from scscrossfile_file tb1 
                inner join scscrossfile_scc tb2 on tb1.scs_crossfile_id = tb2.scs_crossfile_id AND tb1.invocation_id = tb2.invocation_id 
                inner join scc tb3 on tb3.invocation_id = tb2.invocation_id 
                where tb1.invocation_id = $invocationId group by tb1.scs_crossfile_id
                ) as parent
                inner join 
                (
                select scs_crossfile_id,GROUP_CONCAT(scc_id) scc_id_csv 
                from scscrossfile_scc 
                where invocation_id=$invocationId  group by scs_crossfile_id
                ) as child 
                on parent.scs_crossfile_id=child.scs_crossfile_id";

        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getSCSAcrossFileChildTable($scc_id,$invocationId) {
        
        
        $query ="select 
                tb1.scs_crossfile_id,tb1.fid,tb1.tc,tb1.pc,
                tb2.startline,tb2.startcol,tb2.endline,tb2.endcol,tb2.invocation_id,
                tb3.group_id,
                tb4.file_name,
                tb4.directory_id,
                tb5.directory_name,
                tb6.repository_name
                from 
                scscrossfile_file as tb1 
                inner join 
                scc_instance AS tb2 on tb1.invocation_id = tb2.invocation_id
                inner join 
                invocation_files as tb3 on tb1.fid = tb3.cmfile_id and tb1.invocation_id=tb3.invocation_id and tb3.invocation_id=$invocationId 
                inner join 
                repository_file as tb4 on tb3.file_id = tb4.id
                inner join 
                repository_directory as tb5 on tb4.directory_id = tb5.id
		inner join
		user_repository as tb6 on tb6.id = tb5.repository_id
                where tb1.invocation_id=$invocationId and scs_crossfile_id=$scc_id
                group by tb1.fid";

        $result = $this->db->query($query); 
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function getSCCBYFileParentTable($invocationId, $userId) {
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

    public function getSCCByFileChildTable($invocationId, $file_id, $userId) {
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

    /*
      function getSCCByMethodPrimaryTable($mcc_id) {

      $query = "SELECT t1.mcc_instance_id, t1.mcc_id, t1.mid, t1.tc, t1.pc, t1.fid, t1.did, t1.gid, t2.mname methodname, CONCAT(directory_name,file_name) filename, CONCAT(repository_name,directory_name,file_name) filepath, t2.startline, t2.endline FROM mcc_instance t1, method t2, repository_file f,repository_directory d,	user_repository r WHERE mcc_id=$mcc_id and t1.mid=t2.mid and d.id=f.directory_id and d.repository_id=r.id and f.id=t1.fid";
      $result = $this->db->query($query);
      // echo $this->db->last_query();exit;
      if ($result->num_rows() > 0) {
      return $result->result();
      }
      return NULL;
      }
     */

    public function getSCCByMethodPrimaryTable($invocationId) {

        //$query = "SELECT t1.mcc_id,t1.atc,t1.apc,count(t2.mcc_id) length, (select GROUP_CONCAT(scc_id) from mcc_scc where mcc_id = t1.mcc_id group by t1.mcc_id) scc FROM mcc t1 INNER JOIN mcc_instance t2 on t1.mcc_id = t2.mcc_id where t1.invocation_id=$invocationId group by t2.mcc_id";

        //$query = "SELECT t3.mcc_instance_id, t3.mcc_id, t3.mid, t3.tc, t3.pc, t3.fid, t3.did, t3.gid, t2.mname methodname, CONCAT( directory_name, file_name ) filename, CONCAT( repository_name, directory_name, file_name ) filepath, t2.startline, t2.endline, COUNT( t3.mcc_id ) length, (SELECT GROUP_CONCAT( scc_id ) FROM mcc_scc WHERE mcc_id = t1.mcc_id
//GROUP BY t1.mcc_id)scc FROM mcc t1, mcc_instance t3, method t2, repository_file f, repository_directory d, user_repository r WHERE t1.mcc_id = t3.mcc_id AND t1.invocation_id =$invocationId AND t3.mid = t2.mid AND d.id = f.directory_id AND d.repository_id = r.id AND f.id = t3.fid GROUP BY t3.mcc_id";
$query = "select t2.mid, t2.fid, t1.cmdirectory_id did, group_id gid, mname methodname, count(t4.scc_id) length,CONCAT( directory_name, file_name ) filename
        from invocation_files t1, method_file t2, method t3, scc_method t4, repository_file f, repository_directory d
        where t1.invocation_id=t2.invocation_id and 
        t2.invocation_id=t3.invocation_id and 
        t2.invocation_id=104 and
        t3.mid=t4.mid and
        t2.fid=t1.cmfile_id and
        t3.mid = t2.mid and  d.id = f.directory_id AND f.id=t1.file_id 
        group by t4.mid
        ORDER BY `t2`.`mid` ASC";
//      $result = $this->db->get();
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

    function getSCCByMethodSecondaryTable($mid, $invocation_id) {

        //$query = "SELECT t1.mcc_instance_id, t1.mcc_id, t1.mid, t1.tc, t1.pc, t1.fid, t1.did, t1.gid, t2.mname methodname, CONCAT(directory_name,file_name) filename, CONCAT(repository_name,directory_name,file_name) filepath, t2.startline, t2.endline FROM mcc_instance t1, method t2, repository_file f,repository_directory d,	user_repository r WHERE mcc_id=$mcc_id and t1.mid=t2.mid and d.id=f.directory_id and d.repository_id=r.id and f.id=t1.fid";

        $query = "select t1.fid,t1.scc_id, t1.scc_instance_id, t2.length, t1.endline, t1.startline,t1.endcol, t1.startcol,CONCAT(directory_name,file_name) filename, CONCAT(repository_name,directory_name,file_name) filepath from scc_instance t1, scc t2, repository_file f,repository_directory d,	user_repository r where t1.scc_id = t2.scc_id and t1.invocation_id = t2.invocation_id and t1.invocation_id = $invocation_id and t1.scc_id in (select scc_id from mcc_scc where mcc_id in (select mcc_id from mcc_instance where mid=$mid and invocation_id=$invocation_id)) AND d.id=f.directory_id and d.repository_id=r.id and f.id=(select file_id from invocation_files where cmfile_id=t1.fid and invocation_id=$invocation_id)";
        $result = $this->db->query($query);
        // echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return NULL;
    }

}
