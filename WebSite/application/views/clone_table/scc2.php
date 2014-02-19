<style type="text/css">
.panel .dataTables_length {
  margin-top: 8px;
}
div.selector {

width: 50% !important;

}
.list_view{
  cursor: pointer;
}
.code_view{
  cursor: pointer;
}
</style>
<div id="wrapper">
  
<?php 
  include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; 
?>
    <div id="content" class="clearfix">
      <div class="contentwrapper">
        <div class="heading">
          <h3>Single Clone Class</h3> 
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
                <li class="active">Single Clone Class 2</li>
            </ul>                   
        </div>
        
        <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i> SCC List</span></h4>
                 <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                </div>
                <div class="panel-body noPad clearfix">
                   <br clear="all">
                <div class="myrange" style="width:210px;  margin-top:10px; margin:0 auto;">
                          <div id="slider-range" class="slider"></div>
                          <input type="text" id="amount1" style="border:0; color:#ED7A53; font-weight:bold; box-shadow:none;" />
                </div>
                
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable1 display table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>SCC ID</th>
                        <th>Length</th>                        
                        <th>No. Clones</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php 
                          $counter = 0;
                          foreach($scc_data as $data){
                            $counter++;
                         ?>
                        <tr class="list_view" data-sccid="<?php echo $data['scc_id'];?>">
                          <td><?php echo $counter;?>


                          </td>
                          <td><?php echo $data['scc_id'];?></td>                          
                          <td data-length="<?php echo $data['length'];?>">
                            <span><?php echo $data['length'];?></span>
                            <?php if($data['length']=="147"){ ?>
                             <div class="progress progress-mini left" title="100%" style="width:100%;" >
                              <div class="progress-bar progress-bar-danger" style="width: 95%;"></div>
                             </div>
                            <?php } ?>
                            <?php if($data['length']=="38"){ ?>
                             <div class="progress progress-mini left" title="20%" style="width:100%;" >
                              <div class="progress-bar progress-bar-danger" style="width: 20%;"></div>
                             </div>
                            <?php } ?>
                          </td>
                          <td><?php echo isset($data['total_clones']) ? $data['total_clones'] : '-';?></td>
                          
                        </tr>
                        <?php }?>                        
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>No</th>
                          <th>SCC ID</th>
                          <th>Length</th>                          
                          <th>No. Clones</th>
                        </tr>
                      </tfoot>
                  </table>
                </div>

              </div>
            </div>
          </div>
           <?php foreach($scc_clone_list_data as $scc_id => $data){?>
          <div class="row scc_instance_list" id="scc_instance_list_<?php echo $scc_id;?>">
            <div class="col-lg-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4><span> <i class="fa fa-list-alt fa-2"></i>SCC Clone Instance List - SCC ID - <?php echo $scc_id;?></span></h4>
                 <a href="#"  id="pannel2" class="minimize" style="display: inline;">Minimize</a>
                </div>
                
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive dataTable display table table-bordered" width="100%">
                    <thead>
                      <tr>                        
                        <th>No.</th>
                        <th>GID</th>
                        <th>DID</th>
                        <th>FID</th>
                        <th>Start Line</th>
                        <th>End Line</th>
                        <th>File Name</th>
                        
                      </tr>
                    </thead>
                      <tbody>
                        <?php $counter = 0;
                        foreach($data as $d){
                          $counter++;
                        ?>
                          <tr class="code_view" data-endline="<?php echo $d['endline'];?>" data-startline="<?php echo $d['startline'];?>" data-fid="<?php echo $d['fid'];?>" data-sccid= "<?php echo $scc_id;?>" data-clid= "<?php echo $d['scc_instance_id'];?>" data-path="<?php echo $d['repository_name'].$d['directory_name'].$d['file_name']?>">
                            <td><?php echo $counter;?></td>
                            <td><?php echo isset($d['group_id']) ? $d['group_id'] : "-";?></td>
                            <td><?php echo isset($d['directory_id']) ? $d['directory_id'] : "-";?></td>
                            <td><?php echo $d['fid'];?></td>
                            <td><?php echo $d['startline'];?></td>
                            <td><?php echo $d['endline'];?></td>
                            <td><?php echo $d['directory_name'].$d['file_name'];?></td>
                            
                          </tr>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>No</th>
                          <th>GID</th>
                          <th>DID</th>
                          <th>FID</th>
                          <th>Start Line</th>
                          <th>End Line</th>
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
function magic(pannel_id){
   var $this = $("#"+pannel_id+"");
  if($this .hasClass('minimize')) {
    //minimize content
    $this.removeClass('minimize').addClass('maximize');
    $this.parent('div').addClass('min');
    cont = $this.parent('div').next('div.panel-body')
    cont.slideUp(500, 'easeOutExpo'); //change effect if you want :)
    
  } else  
  if($this .hasClass('maximize')) {
    //minimize content
    $this.removeClass('maximize').addClass('minimize');
    $this.parent('div').removeClass('min');
    cont = $this.parent('div').next('div.panel-body');
    cont.slideDown(500, 'easeInExpo'); //change effect if you want :)
  } 
}
$(document).ready(function(){
    $(".list_view").on("click",function(){
            Clonify.SCC.viewCloneInstance($(this).data("sccid"));
            event.preventDefault();
            // magic("pannel1");
        return false;
    });
     $(".code_view").on("click",function(){
            Clonify.SCC.viewCodeData($(this).data("sccid"),$(this).data("clid"),$(this).data("path"),$(this).data("fid"),$(this).data("startline"),$(this).data("endline"));
            event.preventDefault();
            // magic("pannel2");
        return false;
    });
    
  });
</script>
