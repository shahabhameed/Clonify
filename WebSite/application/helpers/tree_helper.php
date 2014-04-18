<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Create Tree
 * 
 * Create a local URL to your assets based on your basepath.
 *
 * @access  public
 * @param   string
 * @return  string
 */
if (!function_exists('create_tree')) {

    function create_tree($invocation_id) {
        $CI = & get_instance();
        $result = $CI->db->query('select cmfile_id,cmdirectory_id,group_id,rf.file_name,rd.id,rd.directory_name,rd.parent_id,ur.repository_name
                                    from invocation_files inf
                                    join repository_file rf on inf.file_id = rf.id
                                    join repository_directory rd on rf.directory_id = rd.id
                                    join user_repository ur on rd.repository_id = ur.id
                                    where inf.invocation_id = '.$invocation_id)->result_array();
        $tree = array();
        $parent;
        $group_id = -1;
        $group_ids = array();
        $parent_ids = array();
        $parent_id = -1;
         // print_r($result);exit;
        foreach ($result as $res) {
            if($group_id == -1 || !in_array($res['group_id'], $group_ids)){
                $group_id = $res['group_id'];
                $group_ids[] = $group_id;
                $tree[] = array(
                                'id'=>"g_".intval($group_id),
                                'pId'=>0,
                                'name'=>"Group ".$group_id,
                                'open'=>false,
                                'isParent'=>true
                            );
            }
            if(($res['parent_id'] == -1) && (!in_array($res['id'], $parent_ids))){
                    $parent_id = $res['id'];
                    $parent_ids[] = $parent_id;
                    $tree[] = array(
                                    'id'=>"p_".intval($parent_id),
                                    'pId'=>"g_".intval($group_id),
                                    'name'=>$res['directory_name'],
                                    'open'=>false,
                                    'isParent'=>true
                            );
            }elseif($res['parent_id'] != -1 && !in_array($res['id'], $parent_ids)){
                    $oldparent = $parent_id;
                     $parent_id = $res['id'];
                    $parent_ids[] = $parent_id;
                    $tree[] = array(
                                    'id'=>"p_".intval($parent_id),
                                    'pId'=>"p_".intval($res['parent_id']),
                                    'name'=>$res['directory_name'],
                                    'open'=>false,
                                    'isParent'=>true
                            );
            }

            $tree[] = array(
                                'id'=>"f_".intval($res['cmfile_id']),
                                'pId'=>"p_".intval($parent_id),
                                'name'=>$res['file_name'],
                                'path' => $res['repository_name'].$res['directory_name'].$res['file_name']
                                
                            );
            
        }
         // print_r($tree);exit;
        return json_encode($tree);
    }
}
