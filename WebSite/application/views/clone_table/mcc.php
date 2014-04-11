<style type="text/css">
.panel .dataTables_length {
  margin-top: 8px;
}
div.selector {

width: 50% !important;

}
</style>
<div id="wrapper">
  
<?php 
  include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; 
?>
    <div id="content" class="clearfix">
      <div class="contentwrapper">
        <div class="heading">
          <h3>Method Clone Class</h3> 
          <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                    <a href="<?php echo base_url();?>" class="tip" title="back to dashboard">
                        <span class="icon16 fa fa-desktop"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 fa fa-caret-right"></span>
                    </span>
                </li>
                <li class="active">Method Clone Class</li>
            </ul>                   
        </div>

        <!-- Modal -->
        <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Select * From SCC Where</h4>
              </div>
              <div class="modal-body">
                
               <div class="row">
                  <div class="col-md-4">
                    <h4>Length</h4>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-10" id="sccrangefilter">
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <u><h4>No. of Instances</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="sccnumberfilter">
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-10">
                    <small>For multiple values use [], e.g for number 1 and 2 write [1,2]</small>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

         <!-- Modal -->
        <div class="modal fade" id="qtable2" tabindex="-1" role="dialog" aria-labelledby="Table 2 Query" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Search * From SCC Clone Instance List Where</h4>
              </div>
              <div class="modal-body">
               <div class="row">
                  <div class="col-md-3">
                    <u><h4>GID</h4></u>
                  </div>
                  <div class="col-md-4" id="gidnumberfilter">
                    </div>
               </div>
                <br class="clear_all"/>
                <div class="row">
                  <div class="col-md-3">
                    <u><h4>DID</h4></u>
                  </div>
                  <div class="col-md-4" id="didnumberfilter">
                    </div>
               </div>
                <br class="clear_all"/>
              <div class="row">
                  <div class="col-md-3">
                    <u><h4>FID</h4></u>
                  </div>
                  <div class="col-md-4" id="fidnumberfilter">
                    </div>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i> MCC List</span></h4>
                 <span class="loader" style="top:15px;cursor:pointer;">
                  <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                </span>
                 <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                 
                </div>
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable1 display table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>MCC ID</th>
                        <th>Structure(SCC ID,...)</th>
                        <th>ATC</th>                        
                        <th>APC</th>                        
                        <th>No. of Instances</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php 
                          $counter = 0;
                          if($mcc_data)
                          foreach($mcc_data as $data){
                            $counter++;
                         ?>
                        <tr class="list_view" data-mccid="<?php echo $data['mcc_id'];?>">
                          <td><?php echo $counter;?></td>
                          <td><?php echo $data['mcc_id'];?></td>                          
                          <td><?php echo $data['scc'];?></td>
                          <td><?php echo isset($data['atc']) ? $data['atc'] : '-';?></td>
                          <td><?php echo isset($data['apc']) ? $data['apc'] : '-';?></td>
                          <td><?php echo isset($data['length']) ? $data['length'] : '-';?></td>
                        </tr>
                        <?php }?>                        
                      </tbody>
                      <tfoot>
                        <tr>
                        <th>No</th>
                        <th>MCC ID</th>
                        <th>Structure(SCC ID,...)</th>
                        <th>ATC</th>                        
                        <th>APC</th>                        
                        <th>No. of Instances</th>
                      </tr>
                    </tfoot>                     
                  </table>
                </div>

              </div>
            </div>
          </div>
           <?php 
           if($mcc_clone_list_data)
            $mcc_clone_list_data = $mcc_clone_list_data ? $mcc_clone_list_data : array();
           foreach($mcc_clone_list_data as $mcc_id => $data){?>
          <div class="row mcc_instance_list" id="mcc_instance_list_<?php echo $mcc_id;?>">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i>MCC Clone Instance List - MCC ID - <?php echo $mcc_id;?></span></h4>
                 <span class="loader" style="top:15px;cursor:pointer;">
                  <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable2"></i>
                </span>
                 <a href="#"  id="pannel2" class="minimize" style="display: inline;">Minimize</a>
                </div>
                
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dataTable display table table-bordered col-lg-12" width="100%">
                    <thead>
                      <tr>                        
                        <th class="col-lg-1">No.</th>
                        <th class="col-lg-2">Group ID</th>
                        <th class="col-lg-2">Directory ID</th>
                        <th class="col-lg-2">File ID</th>
                        <th class="col-lg-1">TC</th>
                        <th class="col-lg-1">PC</th>
                        <th class="col-lg-3">Method Name</th>
                        <th class="col-lg-4">File Name</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php $counter = 0;
                        $data  = $data ? $data : array();
                        foreach($data as $d){
                          $counter++;
                        ?>
<!-- 
Khizer + Umer: Yakki
-->
                          <tr class="code_view" data-name="<?php echo $d['filename']; ?>" data-endline="<?php echo $d['endline'];?>" data-endcol="<?php echo 1;//$d['endcol'];?>" data-startcol="<?php echo 1;//$d['startcol'];?>" data-startline="<?php echo $d['startline'];?>" data-fid="<?php echo $d['fid'];?>" data-mccid= "<?php echo $mcc_id;?>" data-clid= "<?php echo $d['mcc_instance_id'];?>" data-path="<?php echo $d['filepath']?>">
                            <td><?php echo $counter;?></td>
                            <td><?php echo isset($d['gid']) ? $d['gid'] : "-";?></td>
                            <td><?php echo isset($d['did']) ? $d['did'] : "-";?></td>
                            <td><?php echo $d['fid'];?></td>
                            <td><?php echo $d['tc'];?></td>
                            <td><?php echo $d['pc'];?></td>
                            <td style="text-align:left"><?php echo $d['methodname'];?></td>                            
                            <td style="text-align:left"><?php echo $d['filename'];?></td>                            
                          </tr>
                        <?php }?>
                      </tbody> 
                      <tfoot>
                      <tr>                        
                        <th>No.</th>
                        <th>Group ID</th>
                        <th>Directory ID</th>
                        <th>File ID</th>
                        <th>TC</th>
                        <th>PC</th>
                        <th>Method Name</th>
                        <th>File Name</th>
                      </tr>
                    </tfoot>                       
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php }?>
        <div class="row code-window-containter">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading">
                  <h4><span>Code Window</span></h4>
                </div>
                <div class="panel-body noPad clearfix">
                  <div class="">
                    <div class="col-md-6 panel-heading">
                      <h4><span id="file1"></span></h4>
                    </div>
                     <div class="col-md-6 panel-heading">
                      <h4><span id="file2"></span></h4>
                    </div>
                  </div>
                  <div class="code-window1">
                    <div class="col-md-11 padding15 code-window responsive" id="code_window1" >                    
                    </div>

                    <div class="col-md-1" id="code_map1" style="padding:0px;padding-right:5px;width:65px !important;">
                    </div>
                  </div>
                                  
                  <div class="code-window2">
                    <div class="col-md-1" id="code_map2" style="padding:0px;width:65px !important;">
                    </div>
                    <div class="col-md-5 padding15 code-window responsive" id="code_window2">
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div><!-- End contentwrapper -->
    </div><!-- End #content -->
    
</div><!-- End #wrapper -->

<script>
$(document).ready(function(){
    $(".list_view").on("click",function(){
		$("tr").removeClass('selected-row');
        $(this).addClass('selected-row');
        Clonify.MCC.viewMCCCloneInstance($(this).data("mccid"));
        event.preventDefault();            
        return false;
    });
     $(".code_view").on("click",function(){
		 $(".mcc_instance_list tr").removeClass('selected-row');
         $(this).addClass('selected-row');
        Clonify.MCC.viewCodeData($(this).data("mccid"),$(this).data("clid"),$(this).data("path"),$(this).data("fid"),$(this).data("startline"),$(this).data("endline"), $(this).data("startcol"), $(this).data("endcol"), $(this).data("name"));
        event.preventDefault();            
        return false;
    });
    
  });
</script>
