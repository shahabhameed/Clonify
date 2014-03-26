  
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
        
         <!-- Modal -->
        <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Select * From SCC By File Where</h4>
              </div>
              <div class="modal-body">
               
               <div class="row">
                  <div class="col-md-4">
                    <u><h4>Group Id</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="ginumberfilter">
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
                    <u><h4>No Colones</h4></u>
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
                <h4 class="modal-title" id="myModalLabel">Select * From SCC Clone Instance List Where</h4>
              </div>
              <div class="modal-body">
               <div class="row">
                  <div class="col-md-4">
                    <u><h4>Clone Id</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-10" id="cidnumberfilter">
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <u><h4>SCS ID</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="scsidnumberfilter">
                    </div>
                </div>
                <br>
              <div class="row">
                  <div class="col-md-4">
                    <u><h4>SCS Instance Id</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="scsinumberfilter">
                    </div>
                </div>
              <br>
              <div class="row">
                  <div class="col-md-4">
                    <u><h4>SCS File Id</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="scsfidnumberfilter">
                    </div>
                </div>
                <br>
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
                 <h4><span> <i class="fa fa-list-alt fa-2"></i> SCS Within File List</span></h4>
                 <span class="loader" style="top:15px;cursor:pointer;">
                  <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                </span>
                 <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                </div>
                <div class="panel-body noPad clearfix">
                  <table cellpadding="0" cellspacing="0" border="0" class="responsive scswithinfile display table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>SCS ID</th>
                        <th>Structure (SCC ID)</th>                        
                        <th>Group Id</th>
                        <th>Directory ID</th>
                        <th>File Id</th>
                        <th>No. of Instances</th>
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
                     <tfoot>
                      <tr>
                        <th>No</th>
                        <th>SCS ID</th>
                        <th>Structure (SCC ID)</th>                        
                        <th>Group Id</th>
                        <th>Directory ID</th>
                        <th>File Id</th>
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
          foreach($results as $scs_infile_id => $data){
            $data = $data['child_rows'];
          ?>
          <div class="row scs_instance_list" id="scs_instance_list_<?php echo $scs_infile_id;?>">
            <div class="col-md-12">
              <div class="panel panel-default gradient">
                <div class="panel-heading min">
                 <h4>
                  <span> 
                    <i class="fa fa-list-alt fa-2"></i>
                      SCS Clone Instance List - SCS ID - <?php echo $scs_infile_id;?>
                  </span>
                </h4>
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
                          <tr class="code_view" data-name="<?php echo $d['directory_name'].$d['file_name']; ?>" data-endline="<?php echo $d['endline'];?>" data-endcol="<?php echo $d['endcol'];?>" data-startcol="<?php echo $d['startcol'];?>" data-startline="<?php echo $d['startline'];?>" data-fid="<?php echo $d['fid'];?>" data-scsid= "<?php echo $scs_infile_id;?>" data-clid= "<?php echo $d['scsinfile_instance_id'];?>" data-path="<?php echo $d['repository_name'].$d['directory_name'].$d['file_name']?>">
                            <td><?php echo $counter;?></td>
                            <td><?php echo $d['scsinfile_instance_id'];?></td>
                            <td><?php echo $d['scc_id'];?></td>
                            <td><?php echo $d['scc_instance_id'];?></td>
                            <td><?php echo $d['fid'];?></td>                            
                            <td><?php echo $d['directory_name'].$d['file_name'];?></td>                            
                          </tr>
                        <?php }?>
                      </tbody>
                    <tfoot>
                      <tr>                        
                        <th>No.</th>
                        <th>Clone ID</th>
                        <th>SCC ID</th>
                        <th>SCC Instance Id</th>
                        <th>File ID</th>
                        <th>File Name</th>
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
                  <a href="#"  class="minimize" style="display: inline;">Minimize</a>
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
  $('.scswithinfile').dataTable( {
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
      }).columnFilter({
           aoColumns: [
                       null,
                       null,
                       null,
                       { sSelector: "#ginumberfilter",type: "number" },
                       { sSelector: "#dinumberfilter",type: "number" },
                       { sSelector: "#finumberfilter",type: "number" },
                       { sSelector: "#sccnumberfilter",type: "number" }
                       ]
      });

      $('.dataTables_length select').uniform();
      $('.dataTables_paginate > ul').addClass('pagination');
      $('.dataTables_filter>label>input').addClass('form-control');
      $('.dataTables_filter').hide();
    $(".list_view").live("click",function(){
      Clonify.SCC.viewSCSCloneInstance($(this).data("scsid"));
      event.preventDefault();      
      return false;
    });
     $(".code_view").live("click",function(){
        Clonify.SCC.viewCodeData($(this).data("scsid"),$(this).data("clid"),$(this).data("path"),$(this).data("fid"),$(this).data("startline"),$(this).data("endline"), $(this).data("startcol"), $(this).data("endcol"), $(this).data("name"));
        event.preventDefault();        
        return false;
    });
    
  });
</script>