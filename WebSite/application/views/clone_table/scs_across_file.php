  
<?php 
  include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; 
?>
    <div id="content" class="clearfix">
      <div class="contentwrapper">
        <div class="heading">
          <h3>Simple Clone Structure Across File</h3> 
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
                <li class="active">Simple Clone Structure Across File</li>
            </ul>                   
        </div>
        
                   <!-- Modal -->
        <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Select * From SCC Across File List Where</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <u><h4>SCS Id</h4></u>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10" id="scsidnumberfilter">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <u><h4>ATC</h4></u>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10" id="atcnumberfilter">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <u><h4>APC</h4></u>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10" id="apcnumberfilter">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <u><h4>No Of Instances</h4></u>
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
                <h4 class="modal-title" id="myModalLabel">Select * From SCC Clone Instance List where</h4>
              </div>
              <div class="modal-body">
               <div class="row">
                  <div class="col-md-4">
                    <u><h4>GROUP ID</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-10" id="gidnumberfilter">
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <u><h4>Directory ID</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="didnumberfilter">
                    </div>
                </div>
                <br>
              <div class="row">
                  <div class="col-md-4">
                    <u><h4>File ID</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="fidnumberfilter">
                    </div>
                </div>
              <br>
              <div class="row">
                  <div class="col-md-4">
                    <u><h4>TC</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="tcnumberfilter">
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <u><h4>PC</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-4" id="pcnumberfilter">
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
                        <h4><span> <i class="fa fa-list-alt fa-2"></i> SCS Across File List</span></h4>
                        <span class="loader" style="top:15px;cursor:pointer;">
                            <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                        </span>
                        <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                    </div>
                    <div class="panel-body noPad clearfix">
                        <table cellpadding="0" cellspacing="0" border="0" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" class="responsive dynamicTableScs  display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>SCS ID</th>
                                    <th>Structure ( SCC ID,...)</th>                        
                                    <th>ATC</th>
                                    <th>APC</th>                        
                                    <th>No. of Instances</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                if ($scc_data) {    
                                    foreach ($scc_data as $index => $data) {
                                        $counter++;
                                        ?>

                                        <tr class="list_view" data-scsid="<?php echo $data['scs_crossfile_id']; ?>">
                                            <td><?php echo $counter; ?></td>
                                            <td><?php echo $data['scs_crossfile_id']; ?></td>
                                            <td style="text-align:left;width:12em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo $data['scc_id_csv']; ?></td>
                                            <td><?php echo isset($data['tc']) ? $data['tc'] : '-'; ?></td>
                                            <td><?php echo isset($data['pc']) ? $data['pc'] : '-'; ?></td>
                                            <td><?php echo $data['members']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>SCS ID</th>
                                    <th>Structure (SCC ID)</th>                        
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
        if ($scs_clone_list_data)
                $scs_clone_list_data = $scs_clone_list_data ? $scs_clone_list_data : array();
            foreach ($scs_clone_list_data as $scs_crossfile_id => $data) {
                $scc_csv = $scc_data[$scs_crossfile_id]['scc_id_csv'];
                ?>
                <div class="row scs_instance_list" id="scs_instance_list_<?php echo $scs_crossfile_id; ?>">
                    <div class="col-md-12">
                        <div class="panel panel-default gradient">
                            <div class="panel-heading min">
                                <h4><span> <i class="fa fa-list-alt fa-2"></i>SCS Clone Instance List - SCS ID - <?php echo $scs_crossfile_id; ?></span></h4>
                                <span class="loader" style="top:15px;cursor:pointer;">
                                    <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable2"></i>
                                </span>
                                <a href="#"  id="pannel2" class="minimize" style="display: inline;">Minimize</a>
                            </div>

                            <div class="panel-body noPad clearfix">
                                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTableScs dataTable display table table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>                        
                                            <th>Group ID</th>
                                            <th>Directory ID</th>
                                            <th>File ID</th>
                                            <th>TC</th>
                                            <th>PC</th>
                                            <th>File Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 0;
                                        $data = $data ? $data : array();
                                        foreach ($data as $d) {
                                            $counter++;
                                            ?>
                                            <tr class="code_view" data-name="<?php echo $d['directory_name'] . $d['file_name']; ?>" data-endline="" data-endcol="" data-startcol="" data-startline="" data-fid="<?php echo $d['fid']; ?>" data-scsid="<?php echo $scc_csv;?>" data-clid="" data-path="<?php echo $d['repository_name'] . $d['directory_name'] . $d['file_name'] ?>">
                                        
                                                
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo isset($d['group_id']) ? $d['group_id'] : "-"; ?></td>
                                                <td><?php echo isset($d['directory_id']) ? $d['directory_id'] : "-"; ?></td>
                                                <td><?php echo isset($d['fid']) ? $d['fid'] : "-"; ?></td>
                                                <td><?php echo isset($d['tc']) ? $d['tc'] : "-"; ?></td>
                                                <td><?php echo isset($d['pc']) ? $d['pc'] : "-"; ?></td>   
                                                <td style="text-align:left" ><?php echo $d['directory_name'] . $d['file_name']; ?></td>                          
                                            </tr>
        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>                        
                                            <th>Group ID</th>
                                            <th>Directory ID</th>
                                            <th>File ID</th>
                                            <th>TC</th>
                                            <th>PC</th>
                                            <th>File Name</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } 
            ?>

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
    $(document).ready(function() {
         
        $(".list_view").on("click", function() {
            Clonify.SCC.viewSCSAcrossCloneInstance($(this).data("scsid"));
            event.preventDefault();
            return false;
        });
        $(".code_view").on("click", function() {
            Clonify.SCC.viewCodeData($(this).data("scsid"), $(this).data("clid"), $(this).data("path"), $(this).data("fid"), $(this).data("startline"), $(this).data("endline"), $(this).data("startcol"), $(this).data("endcol"), $(this).data("name"));
            event.preventDefault();
            return false;
        });

    });
</script>