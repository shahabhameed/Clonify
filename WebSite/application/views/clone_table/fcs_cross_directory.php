<style type="text/css">
    .panel .dataTables_length {
        margin-top: 8px;
    }
    div.selector {

        width: 50% !important;

    }
</style>
<script type="text/javascript" src="<?= asset_url('js/myTreeMap.js'); ?>"></script>

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

            <!-- Modal 1-->
            <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Select * From FCS Across Directory Where</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <u><h4>FCS ID</h4></u>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="fcsidfilter">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <u><h4>No. Of Instance</h4></u>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="noofclones">
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


            <!-- Modal 2 -->
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
                                    <u><h4>Clone Id</h4></u>
                                </div>
                                <div class="col-md-4" id="cloneId">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default gradient">
                                <div class="panel-heading min">
                                    <h4><span> <i class="fa fa-list-alt fa-2"></i> FCS Across Directory</span></h4>
                                    <span class="loader" style="top:15px;cursor:pointer;">
                                        <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                                    </span>
                                    <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>

                                </div>
                                <div class="panel-body noPad clearfix">
                                    <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTablefcs display table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>FCS ID</th>
                                                <th>Structure (FCC ID, ...)</th>                        
                                                <th>Directory Id</th>
                                                <th>No. Of Instance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $counter = 0;
                                            if ($parent_table_data)
                                                foreach ($parent_table_data as $data) {
                                                    $counter++;
                                                    ?>
                                                    <tr class="list_view" data-sccid="<?php echo $data['fcs_crossdir_id']; ?>">
                                                        <td><?php echo $counter; ?></td>
                                                        <td><?php echo $data['fcs_crossdir_id']; ?></td>                          
                                                        <td ><?php echo isset($data['fcc_ids']) ? $data['fcc_ids'] : "-"; ?></td>
                                                        <td><?php echo isset($data['directory_id']) ? $data['directory_id'] : '-'; ?></td>
                                                        <td><?php echo isset($data['members']) ? $data['members'] : '-'; ?></td>

                                                    </tr>
                                                <?php } ?>                        
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>FCS ID</th>
                                                <th>Structure (FCC ID, ...)</th>                        
                                                <th>Directory Id</th>
                                                <th>No. Of Instance</th>
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
                                                    <th>Structure(FID, ...)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $counter = 0;
                                                $data = $data ? $data : array();
                                                foreach ($data as $ingroup_id => $fids) {
                                                    $counter++;
                                                    $new_fids = join(", ", $fids);
                                                    $temp_filds = join(",", $fids);
                                                    ?>
                                                    <tr class="code_view" data-files="<?php echo $temp_filds; ?>">
                                                        <td><?php echo $counter; ?></td>
                                                        <td><?php echo $ingroup_id; ?></td>
                                                        <td><?php echo $new_fids; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody> 
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Clone ID</th>
                                                    <th>Structure(FID, ...)</th>
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
                </div>

                <!-- -->

                <div class="col-md-3" style="border-left:1px solid;max-height:600px;overflow-y:scroll;overflow-x:hidden;">
                    <div class="todo">
                        <h4>Navigation <a href="#" class="icon tip" oldtitle="Add task" title="" data-hasqtip="true"><span class="icon16 icomoon-icon-plus"></span></a></h4>
                        <ul id="treeDemo" class="ztree"></ul>
                    </div>

                </div>
            </div>
            <div class="row" id="treeMapBlock">
                <div class="col-lg-9">


                    <div class="panel panel-default">

                        <div class="form-group">

                            <div class="col-lg-12">

                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <h4><span class="icon16 icomoon-icon-equalizer-2"></span><span>Tree Map View</span> </h4><a href="#" class="minimize">Minimize</a>
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group">

                                            <div class="col-lg-12">
                                                <div id="treemap" align="center" class="marginL20 col-lg-12 "></div>	


                                            </div>


                                        </div>
                                    </div><!-- End .panel body -->
                                </div>

                            </div><!-- End .span8 -->


                        </div>
                    </div><!-- End .row -->
                </div>

            </div>
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->

</div><!-- End #wrapper -->

<script>


    function generateTreeMap()
    {
        //var treeMapData = <?php //echo json_encode($treemapdata);      ?>;
        var data = new Array();
        data = <?php
                    if ($treemapdata) {
                        echo $treemapdata;
                    }
                    ?>;
        //alert(data);
        return data;
    }



    var zNodes = <?php echo $treedata ?>;
    $(document).ready(function() {
        tmData = renderTreeMap();
        
        $(".list_view").on("click", function() {
            Clonify.FCS.viewInstanceCrossDirectory($(this).data("sccid"));
            event.preventDefault();
            return false;
        });
    });
</script>
