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
        $result = $CI->db->query('select cmfile_id,cmdirectory_id,group_id,rf.file_name,rd.id,rd.directory_name from invocation_files inf
                                    join repository_file rf on inf.file_id = rf.id
                                    join repository_directory rd on rf.directory_id = rd.id
                                    where inf.invocation_id = '.$invocation_id)->result_array();
        $tree = array();
        $parent;
        $group_id = -1;
        $group_ids = array();
        $parent_ids = array();
        $parent_id = -1;
        foreach ($result as $res) {
           
            // print_r($group_ids);
            // echo $group_id;
            
            if($group_id == -1 || !in_array($res['group_id'], $group_ids)){
                // echo "g";
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
            if($parent_id == -1 || !in_array($res['id'], $parent_ids)){
                // echo "p";
                $parent_id = $res['id'];
                $parent_ids[] = $parent_id;
                $tree[] = array(
                                'id'=>"p_".intval($parent_id),
                                'pId'=>"g_".intval($group_id),
                                'name'=>$res['directory_name'],
                                'open'=>false,
                                'isParent'=>true
                            );
            }
            else{
                 $tree[] = array(
                                'id'=>"f_".intval($res['cmfile_id']),
                                'pId'=>"p_".intval($parent_id),
                                'name'=>intval($res['cmfile_id']),
                            );

            }
            // print_r($res);
        }
        // echo (json_encode($tree));exit;
        return json_encode($tree);
        
    }
}

/* End of file url_helper.php */
/* Location: ./application/helpers/url_helper.php */