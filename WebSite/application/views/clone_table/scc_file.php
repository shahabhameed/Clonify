  
<?php 
  include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; 
?>
    <div id="content" class="clearfix">
      <div class="contentwrapper">
        <div class="heading">
          <h3>Simple Clone Class By File</h3> 
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
                <li class="active">Simple Clone Class By File</li>
            </ul>
        </div>
         <!-- Modal -->
        <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Select * From SCC By File List Where</h4>
              </div>
              <div class="modal-body">
                
               <div class="row">
                  <div class="col-md-4">
                    <u><h4>Group Id</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-10" id="ginumberfilter">
                    </div>
                </div>
                <br>
               <div class="row">
                  <div class="col-md-4">
                    <u><h4>Directory Id</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="dinumberfilter">
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <u><h4>File Id</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="finumberfilter">
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <u><h4>Number Of Instances</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="sccnumberfilter">
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-10">
                    <small>For multiple values use "[ ]", e.g for number 1 and 2 write [1,2]</small>
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
                <h4 class="modal-title" id="myModalLabel">Search SCC Clone Instance</h4>
              </div>
              <div class="modal-body">
               <div class="row">
                  <div class="col-md-4">
                    <u><h4>SCC ID</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-10" id="gidnumberfilter">
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <u><h4>Clone ID</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="didnumberfilter">
                    </div>
                </div>
                <br>
              <div class="row">
                  <div class="col-md-4">
                    <u><h4>Length</h4></u>
                  </div>
               </div>
               <div class="row">
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
                 <h4><span> <i class="fa fa-list-alt fa-2"></i> SCC By File List</span></h4>
                 <span class="loader" style="top:15px;cursor:pointer;">
                  <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                </span>
                 <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                </div>
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive sccfiletable display table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>                        
                        <th>Group Id</th>
                        <th>Directory ID</th>
                        <th>File Id</th>
                        <th style="text-align: left;">File Name</th>
                        <th>No. of Instances</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $counter=0;foreach($results as $result){$counter++;?>
                      <tr class="list_view" data-sccfileid="<?php echo $result['fid'];?>">
                        <td><?php echo $counter;?></td>                        
                        <td><?php echo $result['group_id'];?></td>
                        <td><?php echo $result['directory_id'];?></td>
                        <td><?php echo $result['fid'];?></td>
                        <td style="text-align: left;"><?php echo $result['directory_name'] . $result['file_name'];?></td>
                        <td><?php echo $result['members'];?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>                        
                        <th>Group Id</th>
                        <th>Directory ID</th>
                        <th>File Id</th>
                        <th style="text-align: left;">File Name</th>
                        <th>No. of Instances</th>
                      </tr>
                    </tfoot>
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
                 <span class="loader" style="top:15px;cursor:pointer;">
                  <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable2"></i>
                </span>
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
                       <tfoot>
                      <tr>                        
                        <th>No.</th>                        
                        <th>SCC ID</th>
                        <th>Clone ID</th>
                        <th>Length</th>
                        <th>Start Line</th>
                        <th>End Line</th>
                      </tr>
                    </tfoot>
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

                    <div class="col-md-1" id="code_map1" >
                    </div>
                  </div>
                                  
                  <div class="code-window2">
                    <div class="col-md-1" id="code_map2" >
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
      $('.sccfiletable').dataTable( {
        "sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
        "sPaginationType": "bootstrap",
        "bJQueryUI": false,
        "bAutoWidth": false,
                          "iDisplayLength" : 5,
                          "aLengthMenu" : [5,10,25,50],
        "oLanguage": {
          "sSearch": "<span></span> _INPUT_",
          "sLengthMenu": "<span>_MENU_</span>",
          "oPaginate": { "sFirst": "First", "sLast": "Last" }
        }
      }).yadcf([
            {column_number : 1,filter_container_id : "ginumberfilter"},
            {column_number : 2,filter_container_id : "dinumberfilter"},
            {column_number : 3,filter_container_id : "finumberfilter"},
            {column_number : 5,filter_container_id : "sccnumberfilter"},
        ]);


      $('.dataTables_length select').uniform();
      $('.dataTables_paginate > ul').addClass('pagination');
      $('.dataTables_filter>label>input').addClass('form-control');
      $('.dataTables_filter').hide();
                  
    $(".list_view").live("click",function(){        
        Clonify.SCC.viewSCCCloneInstance($(this).data("sccfileid"), this);
        event.preventDefault();            
        return false;
    });
     $(".code_view").live("click",function(){
        Clonify.SCC.viewCodeData($(this).data("sccid"),$(this).data("clid"),$(this).data("path"),$(this).data("fid"),$(this).data("startline"),$(this).data("endline"), $(this).data("startcol"), $(this).data("endcol"), $(this).data("name"), this);
        event.preventDefault();            
        return false;
    });
    
  });
</script>