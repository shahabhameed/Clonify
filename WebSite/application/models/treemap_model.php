<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Treemap_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('scc');
    }


    function get_fcs_grp_treemap($invocationId, $gids)
    {
        $first = true;
        $gidList = "";
        foreach($gids as $gid)
        {
            if($first)
            {
                $gidList.="(".$gid;
                $first = false;
            }
            else
            {
                $gidList.=",".$gid;
            }
        }
        if($gidList!="")
        {
            $gidList.=")";
            $query = "select distinct cmdirectory_id from invocation_files where group_id IN $gidList and invocation_id=$invocationId";
            $result = $this->db->query($query);
    		$resTmp = json_decode(json_encode($result->result()), true);
            $dids = array();
            foreach($resTmp as $did)
            {
                $dids[] = $did['cmdirectory_id'];
            }
            return $this->get_fcs_dir_treemap($invocationId,$dids);
        }
        else
            return NULL;
    }
  
    function get_fcs_dir_treemap($invocationId, $dids)
	{
		//$fcs_within_dir = array();
		$dirArr = array();
		foreach($dids as $did)
		{
			$query = "SELECT distinct d.id did, d.parent_id pid from repository_file f,repository_directory d, user_repository r WHERE d.id=f.directory_id and d.repository_id=r.id and f.id in(select file_id from invocation_files where cmdirectory_id=$did and invocation_id=$invocationId)";
			$result = $this->db->query($query);
			$dirParent = json_decode(json_encode($result->result()), true);
			foreach($dirParent as $dirP)
			{
                if($dirP['pid']>=0)
                {
    				$pArr = array($dirP['pid']);
    				$tmpP = $dirP['pid'];
    				while($tmpP != NULL)
    				{
    					$query = "SELECT d.id did, d.parent_id pid from repository_directory d where d.id = $tmpP";
    					$result = $this->db->query($query);
    					$dirPP = json_decode(json_encode($result->result()), true);
    					if($dirPP[0]['pid']!=NULL && $dirPP[0]['pid']>=0)
    					{
    						$tmpP = $dirPP[0]['pid'];
    						$pArr[] = $tmpP;
    					}
    					else
    					{
    						$tmpP = NULL;
    					}
    				}
    				$dirArr[] = array("cmdid"=>$did,"did"=>$dirP['did'],"parents"=>$pArr);
    				//$dirParent[$dirP]['pid']=$pArr;
                }
                else if($dirP['pid']==-1)
                {
                    $dirArr[] = array("cmdid"=>$did,"did"=>$dirP['did'],"parents"=>array());
                }
			}
		}
		//$dirArr has all dir ids and list of their parents (complete heirarchy)
		//SAMPLE:
		//Array ( [0] => Array ( [0] => 125 [1] => Array ( [0] => 2 ) ) [1] => Array ( [0] => 126 [1] => Array ( [0] => 2 ) ) [2] => Array ( [0] => 127 [1] => Array ( [0] => 126 [1] => 2 ) ) )
		
        //SCC By File
        $sccByF = $this->scc->getSCSSByFileData($invocationId);
        
		//foreach($dids as $did)
		$dirData = array();
		foreach($dirArr as $dirArrT)
		{
			$did = $dirArrT['cmdid'];
			$filarr = array();
			//$query = "SELECT directory_name dname, file_name filename, CONCAT(repository_name,directory_name,file_name) filepath, 0 as fsize FROM repository_file f,repository_directory d,	user_repository r WHERE d.id=f.directory_id and d.repository_id=r.id and f.id in(select file_id from invocation_files where cmdirectory_id=$did and invocation_id=$invocationId)";
            $query = "SELECT i.cmfile_id cmfid, directory_id did, directory_name dname, file_name filename, i.group_id gid, CONCAT(repository_name,directory_name,file_name) filepath, 0 as fsize, 0 as clones FROM repository_file f,repository_directory d,	user_repository r, invocation_files i WHERE d.id=f.directory_id and d.repository_id=r.id and f.id=i.file_id and i.cmdirectory_id=$did and i.invocation_id=$invocationId";
			$result = $this->db->query($query);
			$dir_files = $result->result();
			if($dir_files)
			{
				$dir_size=0;
				foreach($dir_files as $dir_file)
				{
					$dir_file = json_decode(json_encode($dir_file), true);
					$dname = $dir_file['dname'];
					$file_path = $dir_file['filepath'];
					$file_size = filesize($file_path);
					$dir_size = $dir_size + $file_size;
					$dir_file['fsize'] = $file_size;
                    
                    if(isset($sccByF[$dir_file['cmfid']]))
                    {
                        $dir_file['clones'] = $sccByF[$dir_file['cmfid']]['members'];                        
                    }
                    
					$filarr[$dir_file['cmfid']]=$dir_file;
				}
				//$dids[$did]=array("cmdid"=>$did,"did"=>$dirArrT['did'],"dname"=>$dname,"dsize"=>$dir_size,"files"=>$filarr,"children"=>array());
                if($dir_file['did']==$dirArrT['did'])
                {
                    $dirData[$dirArrT['did']]=array("cmdid"=>$did,"did"=>$dirArrT['did'],"dname"=>$dname,"dsize"=>$dir_size,"files"=>$filarr,"children"=>array());
                                    
                }
			}
			//print_r($dids[$did]);
		}
		
		//return $dirData;
        $parCount = 1;
        while(1)
        {
            $parFound = 0;
    		foreach($dirArr as $dirArrP)
    		{
    			$parents = array_reverse($dirArrP['parents']);
    			//$parents = $dirArrP['parents'];
    			//if(count($parents) == 1)
                if(count($parents) == $parCount)
    			{
                    $parFound = 1;
    				$currDid = $dirArrP['did'];
    				/*
                    $currPar = $parents[0];
    				if(isset($dirData[$currPar]))
    				{
    					$dirData[$currPar]['children'][$currDid]=$dirData[$currDid];
    					$dirData[$currPar]['dsize']=$dirData[$currPar]['dsize'] + $dirData[$currDid]['dsize'];
    					unset($dirData[$currDid]);
    				}
    				else
    				{
    					$dirData[$currPar]=array("cmdid"=>$dirArrP['cmdid'],"did"=>$currPar,"dname"=>'',"dsize"=>$dirData[$currDid]['dsize'],"files"=>array(),"children"=>array($currDid=>$dirData[$currDid]));
    					unset($dirData[$currDid]);
    				}
                    */
                    
                    $currDir = &$dirData;
                    for($i=0;$i<$parCount;$i++)
                    {
                        $currPar = $parents[$i];
        				if(isset($currDir[$currPar]))
        				{
        					//$currDir[$currPar]['children'][$currDid]=$dirData[$currDid];
                            if(isset($dirData[$currDid]))
                            {
        					   $currDir[$currPar]['dsize']=$currDir[$currPar]['dsize'] + $dirData[$currDid]['dsize'];
                            }
        					//unset($dirData[$currDid]);
        				}
        				else if(isset($dirData[$currDid]))
        				{
        					$currDir[$currPar]=array("cmdid"=>$dirArrP['cmdid'],"did"=>$currPar,"dname"=>'',"dsize"=>$dirData[$currDid]['dsize'],"files"=>array(),"children"=>array());
        					//unset($dirData[$currDid]);
        				}
                        $currDir = &$currDir[$currPar]['children'];
                    }
                    if(isset($dirData[$currDid]))
                    {
                        $currDir[$currDid]=$dirData[$currDid];
                        unset($dirData[$currDid]);
                    }
    			}
    		}
            if(!$parFound)
            {
                break;
            }
            $parCount++;
        }
        //echo "<pre>".print_r($dirData,true)."</pre>";
        //echo "<pre>".print_r($currDir,true)."</pre>";
		//die();
        
		return $dirData;
    }

    function fillArrayWithFileNodes( DirectoryIterator $dir )
    {
      $data = array();
      foreach ( $dir as $node )
      {
        if ( $node->isDir() && !$node->isDot() )
        {
          $data[$node->getFilename()] = $this->fillArrayWithFileNodes( new DirectoryIterator( $node->getPathname() ) );
        }
        else if ( $node->isFile() )
        {
          $data[] = $node->getFilename();
        }
      }
      return $data;
    }

}
