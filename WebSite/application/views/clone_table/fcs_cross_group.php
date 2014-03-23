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
                <h3>File Clone Structure</h3> 
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
                    <li class="active">File Clone Structure</li>
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
                                    <u><h4>No.Colones</h4></u>
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
                            <h4><span> <i class="fa fa-list-alt fa-2"></i> FCS Across Group Table</span></h4>
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
                                        <th>FCS ID</th>
                                        <th>FCS Across Group List</th>                        
                                        <th>GID</th>
                                        <th>No. Clones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 0;
                                    if ($parent_table_data)
                                        foreach ($parent_table_data as $data) {
                                            $counter++;
                                            ?>
                                            <tr class="list_view" data-sccid="<?php echo $data['fcs_crossgroup_id']; ?>">
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo $data['fcs_crossgroup_id']; ?></td>                          
                                                <td ><?php echo isset($data['fcc_ids']) ? $data['fcc_ids'] : "-"; ?></td>
                                                <td><?php echo isset($data['group_id']) ? $data['group_id'] : '-'; ?></td>
                                                <td><?php echo isset($data['members']) ? $data['members'] : '-'; ?></td>

                                            </tr>
                                        <?php } ?>                        
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
            <?php
            if ($secondary_table_rows)
                $secondary_table_rows = $secondary_table_rows ? $secondary_table_rows : array();
            foreach ($secondary_table_rows as $fcs_id => $data) {
                ?>
                <div class="row scc_instance_list" id="fcs_instance_list_<?php echo $fcs_id; ?>">
                    <div class="col-md-12">
                        <div class="panel panel-default gradient">
                            <div class="panel-heading min">
                                <h4><span> <i class="fa fa-list-alt fa-2"></i>FCS Secondary Table</span></h4>
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
                                            <th>Structure(FID)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 0;
                                        $data = $data ? $data : array();
                                        foreach ($data as $ingroup_id => $fids) {
                                            $counter++;
                                              $fids = join(",", $fids);
                                            ?>
                                            <tr class="code_view">
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo $ingroup_id; ?></td>
                                                <td><?php echo $fids; ?></td>
                                            </tr>
                                          <?php } ?>
                                    </tbody> 
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Clone ID</th>
                                            <th>Structure(FID)</th>
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
    $(document).ready(function() {
        $(".list_view").on("click", function() {
            Clonify.FCS.viewInstanceAcrossGroup($(this).data("sccid"));
            event.preventDefault();
            return false;
        });
    });
</script>
