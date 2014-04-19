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
                <h3>Simple Clone Structure Across Method</h3> 
                <ul class="breadcrumb">
                    <li>You are here:</li>
                    <li>
                        <a href="<?php echo base_url(); ?>" class="tip" title="back to dashboard">
                            <span class="icon16 fa fa-desktop"></span>
                        </a> 
                        <span class="divider">
                            <span class="icon16 fa fa-caret-right"></span>
                        </span>
                    </li>
                    <li class="active">Simple Clone Structure Across Method</li>
                </ul>                   
            </div>

            <!-- Modal -->
            <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Select * From SCS_Across_Method Where</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <u><h4>SCS ID</h4></u>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="scsidfilter">
                                </div>
                            </div>
                            <br>
                             <div class="row">
                                <div class="col-md-4">
                                    <u><h4>ATC</h4></u>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="atcfilter">
                                </div>
                            </div>
                           <br>
                           <div class="row">
                                <div class="col-md-4">
                                    <u><h4>APC</h4></u>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="apcfilter">
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
                            <h4 class="modal-title" id="myModalLabel">Search * From SCS_Across_Method Instance List Where</h4>
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
                            <h4><span> <i class="fa fa-list-alt fa-2"></i> SCC List</span></h4>
                            <span class="loader" style="top:15px;cursor:pointer;">
                                <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                            </span>
                            <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>

                        </div>
                        <div class="panel-body noPad clearfix">
                            <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTableaccM display table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>SCS ID</th>
                                        <th>Structure(SCC ID, ...)</th>
                                        <th>ATC</th>
                                        <th>APC</th>
                                        <th>No. of Instances</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 0;
                                    if ($parent_table_data)
                                        foreach ($parent_table_data as $data) {
                                            $counter++;
                                            ?>
                                            <tr class="list_view" data-sccid="<?php echo $data['scs_crossmethod_id']; ?>">
                                                <td><?php echo $counter; ?>


                                                </td>
                                                <td><?php echo $data['scs_crossmethod_id']; ?></td>                          
                                                <td>
                                                    <?php echo $data['scc_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['atc']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['apc']; ?>
                                                </td>
                                                <td><?php echo isset($data['members']) ? $data['members'] : '-'; ?></td>

                                            </tr>
                                        <?php } ?>                        
                                </tbody>
                                <tfoot>
                                    <tr>
                                       <th>No</th>
                                        <th>SCS ID</th>
                                        <th>Structure(SCC ID, ...)</th>
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
            if ($secondary_table_rows)
                $secondary_table_rows = $secondary_table_rows ? $secondary_table_rows : array();
            foreach ($secondary_table_rows as $scs_crossmethod_id => $data){
                ?>
                <div class="row scc_instance_list" id="scc_instance_list_<?php echo $scs_crossmethod_id; ?>">
                    <div class="col-md-12">
                        <div class="panel panel-default gradient">
                            <div class="panel-heading min">
                                <h4><span> <i class="fa fa-list-alt fa-2"></i>SCS Clone Instance List - SCS ID - <?php echo $scs_crossmethod_id; ?></span></h4>
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
                                            <th>Group ID</th>
                                            <th>Directory ID</th>
                                            <th>File ID</th>
                                            <th>Method Id</th>
                                            <th>TC</th>
                                            <th>PC</th>
                                            <th>Method Name</th>
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

                                            <tr class="code_view" data-name="<?php echo $d['directory_name'] . $d['file_name']; ?>" data-endline="" data-endcol="" data-startcol="" data-startline="" data-fid="" data-sccid= "" data-clid="<?php echo $scs_crossmethod_id+1; ?>" data-mid="<?php echo $d['mid']?>" data-path="<?php echo $d['repository_name'] . $d['directory_name'] . $d['file_name'] ?>">
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo $d['gid']; ?></td>
                                                <td><?php echo $d['did']; ?></td>
                                                <td><?php echo $d['fid']; ?></td>
                                                <td><?php echo $d['mid']; ?></td>
                                                <td><?php echo $d['tc']; ?></td>
                                                <td><?php echo $d['pc']; ?></td>
                                                <td><?php echo $d['mname']; ?></td>                                                
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
                                            <th>Method Id</th>
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
<?php } ?>
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
   $(document).ready(function() {
         $(".list_view").on("click", function() {            
            Clonify.SCC.viewSCCCloneInstance($(this).data("sccid"), this);
            event.preventDefault();
            return false;
        });
        
        $(".code_view").on("click", function(){            
            Clonify.MCC.viewCodeData($(this).data("sccid"), $(this).data("clid"), $(this).data("path"), $(this).data("fid"), $(this).data("startline"), $(this).data("endline"), $(this).data("startcol"), $(this).data("endcol"), $(this).data("name"), $(this).data("mid"), this);
            event.preventDefault();
            return false;
        });

    });    
</script>
