  
<?php 
  include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; 
?>
    <div id="content" class="clearfix">
      <div class="contentwrapper">
        <div class="heading">
          <h3>Single Clone Class By File</h3> 
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
                <li class="active">Single Clone Class By File</li>
            </ul>
        </div>
        
        <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i> SCC By File List</span></h4>
                 <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                </div>
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>                        
                        <th>Group Id</th>
                        <th>Directory ID</th>
                        <th>File Id</th>
                        <th>File Name</th>
                        <th>No. Clones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $counter=0;foreach($results as $result){$counter++;?>
                      <tr class="list_view" data-sccfileid="<?php echo $result['fid'];?>">
                        <td><?php echo $counter;?></td>                        
                        <td><?php echo $result['group_id'];?></td>
                        <td><?php echo $result['directory_id'];?></td>
                        <td><?php echo $result['fid'];?></td>
                        <td><?php echo $result['file_name'];?></td>
                        <td><?php echo $result['members'];?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          <?php 
          if ($results){
          foreach($results as $file_id => $data){
            $data = $data['child_rows'];            
          ?>
          <div class="row scc_instance_list" id="scc_instance_list_<?php echo $file_id;?>">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i>SCC Clone Instance List - File ID - <?php echo $file_id;?></span></h4>
                 <a href="#"  id="pannel2" class="minimize" style="display: inline;">Minimize</a>
                </div>
                
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dataTable display table table-bordered" width="100%">
                    <thead>
                      <tr>                        
                        <th>No.</th>                        
                        <th>SCC ID</th>
                        <th>Clone ID</th>
                        <th>Length</th>
                        <th>Start Line</th>
                        <th>End Line</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php $counter = 0;                        
                        foreach($data as $d){
                          $counter++;
                        ?>
                          <tr class="code_view" data-name="<?php echo $d['directory_name'].$d['file_name']; ?>" data-endline="<?php echo $d['endline'];?>" data-endcol="<?php echo $d['endcol'];?>" data-startcol="<?php echo $d['startcol'];?>" data-startline="<?php echo $d['startline'];?>" data-fid="<?php echo $d['fid'];?>" data-sccid= "<?php echo $d['scc_id'];?>" data-clid= "<?php echo $d['scc_instance_id'];?>" data-path="<?php echo $d['repository_name'].$d['directory_name'].$d['file_name']?>">
                            <td><?php echo $counter;?></td>                            
                            <td><?php echo $d['scc_id'];?></td>
                            <td><?php echo $d['scc_instance_id'];?></td>
                            <td><?php echo $d['endline'] - $d['startline'];?></td>
                            <td><?php echo $d['startline'];?></td>
                            <td><?php echo $d['endline'];?></td>
                          </tr>
                        <?php }?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php } }?>
        
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
                    <div class="col-md-5 padding15 code-window" id="code_window2">

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
        Clonify.SCC.viewSCCCloneInstance($(this).data("sccfileid"));
        event.preventDefault();            
        return false;
    });
     $(".code_view").on("click",function(){
        Clonify.SCC.viewCodeData($(this).data("sccid"),$(this).data("clid"),$(this).data("path"),$(this).data("fid"),$(this).data("startline"),$(this).data("endline"), $(this).data("startcol"), $(this).data("endcol"), $(this).data("name"));
        event.preventDefault();            
        return false;
    });
    
  });
</script>