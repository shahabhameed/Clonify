  
<?php 
  include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; 
?>
    <div id="content" class="clearfix">
      <div class="contentwrapper">
        <div class="heading">
          <h3>Single Clone Structure Within File</h3> 
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
                <li class="active">Single Clone Structure Within File</li>
            </ul>                   
        </div>
        
        <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i> SCS Within File List</span></h4>
                 <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                </div>
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable1 display table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>SCS ID</th>
                        <th>Structure (SCC ID)</th>                        
                        <th>Group Id</th>
                        <th>Directory ID</th>
                        <th>File Id</th>
                        <th>No. Clones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $counter=0;foreach($results as $result){$counter++;?>
                      <tr class="list_view" data-scsid="<?php echo $result['scs_infile_id'];?>">
                        <td><?php echo $counter;?></td>
                        <td><?php echo $result['scs_infile_id'];?></td>
                        <td><?php echo $result['scc_id_csv'];?></td>
                        <td><?php echo $result['group_id'];?></td>
                        <td><?php echo $result['directory_id'];?></td>
                        <td><?php echo $result['fid'];?></td>
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
          foreach($results as $scs_infile_id => $data){
            $data = $data['child_rows'];
          ?>
          <div class="row scs_instance_list" id="scs_instance_list_<?php echo $scs_infile_id;?>">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i>SCS Clone Instance List - SCS ID - <?php echo $scs_infile_id;?></span></h4>
                 <a href="#"  id="pannel2" class="minimize" style="display: inline;">Minimize</a>
                </div>
                
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dataTable display table table-bordered" width="100%">
                    <thead>
                      <tr>                        
                        <th>No.</th>
                        <th>Clone ID</th>
                        <th>SCC ID</th>
                        <th>SCC Instance Id</th>
                        <th>File ID</th>
                        <th>File Name</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php $counter = 0;
                        foreach($data as $d){
                          $counter++;
                        ?>
                          <tr class="code_view" data-name="<?php echo $d['directory_name'].$d['file_name']; ?>" data-endline="<?php echo $d['endline'];?>" data-startline="<?php echo $d['startline'];?>" data-fid="<?php echo $d['fid'];?>" data-scsid= "<?php echo $scs_infile_id;?>" data-clid= "<?php echo $d['scsinfile_instance_id'];?>" data-path="<?php echo $d['repository_name'].$d['directory_name'].$d['file_name']?>">
                            <td><?php echo $counter;?></td>
                            <td><?php echo $d['scsinfile_instance_id'];?></td>
                            <td><?php echo $d['scc_id'];?></td>
                            <td><?php echo $d['scc_instance_id'];?></td>
                            <td><?php echo $d['fid'];?></td>                            
                            <td><?php echo $d['directory_name'].$d['file_name'];?></td>                            
                          </tr>
                        <?php }?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php } }?>
        
        
      </div><!-- End contentwrapper -->
    </div><!-- End #content -->
    
</div><!-- End #wrapper -->

<script>
$(document).ready(function(){
    $(".list_view").on("click",function(){
      Clonify.SCC.viewSCSCloneInstance($(this).data("scsid"));
      event.preventDefault();      
      return false;
    });
     $(".code_view").on("click",function(){
        Clonify.SCC.viewCodeData($(this).data("sccid"),$(this).data("clid"),$(this).data("path"),$(this).data("fid"),$(this).data("startline"),$(this).data("endline"),$(this).data("name"));
        event.preventDefault();        
        return false;
    });
    
  });
</script>