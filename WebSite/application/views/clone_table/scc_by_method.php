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
          <h3>SCC By Method</h3> 
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
                <li class="active">SCC By Method</li>
            </ul>                   
        </div>

        <!-- Modal -->
        <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Select * From SCC By Method Where</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                            <div class="col-md-4">
                                <u><h4>GID</h4></u>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10" id="gidnumberfilter">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <u><h4>DID</h4></u>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" id="didnumberfilter">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <u><h4>FID</h4></u>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" id="fidnumberfilter">
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
                 <h4><span> <i class="fa fa-list-alt fa-2"></i> SCC By Method List</span></h4>
                 <span class="loader" style="top:15px;cursor:pointer;">
                  <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                </span>
                 <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                 
                </div>
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTableSccByMethod display table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>MID</th>
                        <th>FID</th>
                        <th>DID</th>                        
                        <th>GID</th>                        
                        <th>Method Name</th>
						<th>File Name</th>
						<th>No. of Clones</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php 
                          $counter = 0;
                          if($scc_Method_data)
                          foreach($scc_Method_data as $data){
                            $counter++;
                         ?>
                        <tr class="list_view" data-mid="<?php echo $data['mid'];?>">
                          <td><?php echo $counter;?></td>
                          <td><?php echo $data['mid'];?></td>                          
                          <td><?php echo $data['fid'];?></td>
                          <td><?php echo isset($data['did']) ? $data['did'] : '-';?></td>
                          <td><?php echo isset($data['gid']) ? $data['gid'] : '-';?></td>
                          <td style="text-align:left"><?php echo isset($data['methodname']) ? $data['methodname'] : '-';?></td>
						  <td style="text-align:left"><?php echo $data['filename'];?></td>
						  <td><?php echo $data['length'];?></td>
                        </tr>
                        <?php }?>                        
                      </tbody>
                      <tfoot>
                        <tr>
                        <th>No</th>
                        <th>MID</th>
                        <th>FID</th>
                        <th>DID</th>                        
                        <th>GID</th>                        
                        <th>Method Name</th>
						<th>File Name</th>
						<th>No. of Clones</th>
                      </tr>
                    </tfoot>                     
                  </table>
                </div>

              </div>
            </div>
          </div>
		  
           <?php 
           if($scc_Method_secondary_data)
            $scc_Method_secondary_data = $scc_Method_secondary_data ? $scc_Method_secondary_data : array();
           foreach($scc_Method_secondary_data as $mid => $data){?>
          <div class="row scc_instance_list" id="scc_instance_list_<?php echo $mid;?>">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i>SCC Clone Instance List - MID - <?php echo $mid;?></span></h4>
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
                        <th class="col-lg-2">SCC ID</th>
                        <th class="col-lg-2">Length</th>
                        <th class="col-lg-1">Start Line</th>
                        <th class="col-lg-1">End Line</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php $counter = 0;
                        $data  = $data ? $data : array();
                        foreach($data as $d){
                          $counter++;
                        ?>
                          <tr class="code_view" data-name="<?php echo $d['filename']; ?>" data-endline="<?php echo $d['endline'];?>" data-endcol="<?php echo $d['endcol'];?>" data-startcol="<?php echo $d['startcol'];?>" data-startline="<?php echo $d['startline'];?>" data-fid="<?php echo $d['fid'];?>" data-sccid= "<?php echo $d['scc_id'];?>" data-clid= "<?php //echo $d['scc_instance_id'];?>" data-path="<?php echo $d['filepath']?>">
                            <td><?php echo $counter;?></td>
                            <td><?php echo isset($d['scc_id']) ? $d['scc_id'] : "-";?></td>
                            <td><?php echo $d['length'];?></td>
                            <td><?php echo $d['startline'];?></td>
                            <td><?php echo $d['endline'];?></td>
                          </tr>
                        <?php }?>
                      </tbody> 
                      <tfoot>
                      <tr>                        
                        <th class="col-lg-1">No.</th>
                        <th class="col-lg-2">SCC ID</th>
                        <th class="col-lg-2">Length</th>
                        <th class="col-lg-1">Start Line</th>
                        <th class="col-lg-1">End Line</th>
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

                    <div class="col-md-1" id="code_map1">
                    </div>
                  </div>
                                  
                  <div class="code-window2">
                    <div class="col-md-1" id="code_map2" >
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
        Clonify.SCC.viewSCCCloneInstance($(this).data("mid"), this);
        event.preventDefault();            
        return false;
    });
     $(".code_view").on("click",function(){
        Clonify.SCC.viewCodeData($(this).data("sccid"),$(this).data("clid"),$(this).data("path"),$(this).data("fid"),$(this).data("startline"),$(this).data("endline"), $(this).data("startcol"), $(this).data("endcol"), $(this).data("name"), this);
        event.preventDefault();            
        return false;
    });
    
  });
</script>
