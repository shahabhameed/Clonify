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

            <div class="row">
                <div class="col-lg-12">
                    <!-- Modal 1-->
                    <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Select * From Files By Directory Where</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <u><h4>Directory ID</h4></u>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4" id="diridfilter">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <u><h4>No. Of Files</h4></u>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4" id="nooffilesfilter">
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
                                    <h4 class="modal-title" id="myModalLabel">Search * From File By Directory Files Instance List Where</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <u><h4>Group Id</h4></u>
                                        </div>
                                        <div class="col-md-4" id="gidfilter">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <u><h4>File Id</h4></u>
                                        </div>
                                        <div class="col-md-4" id="fileidfilter">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default gradient">
                                    <div class="panel-heading min">
                                        <h4><span> <i class="fa fa-list-alt fa-2"></i> Files By Directory</span></h4>
                                        <span class="loader" style="top:15px;cursor:pointer;">
                                            <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                                        </span>
                                        <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>

                                    </div>
                                    <div class="panel-body noPad clearfix">
                                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTablefilesbydir display table table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Directory ID</th>
                                                    <th>Directory Name</th>                        
                                                    <th>No of Files</th>                        

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $counter = 0;
                                                if ($parent_table_data)
                                                    foreach ($parent_table_data as $data) {
                                                        $counter++;
                                                        ?>
                                                        <tr class="list_view" data-sccid="<?php echo $data['cmdirectory_id']; ?>">
                                                            <td><?php echo $counter; ?></td>
                                                            <td><?php echo $data['cmdirectory_id']; ?></td>                          
                                                            <td style="text-align:left"><?php echo get_dir_name($data['cmdirectory_id'], $invocationId); ?></td>
                                                            <td><?php echo isset($data['noofinstance']) ? $data['noofinstance'] : '-'; ?></td>
                                                        </tr>
                                                    <?php } ?>                           
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Directory ID</th>
                                                    <th>Directory Name</th>                        
                                                    <th>No of Files</th>                        
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
                                            <h4><span> <i class="fa fa-list-alt fa-2"></i>Files By Directory Files Instance</span></h4>
                                            <span class="loader" style="top:15px;cursor:pointer;">
                                                <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable2"></i>
                                            </span>
                                            <a href="#"  id="pannel2" class="minimize" style="display: inline;">Minimize</a>
                                        </div>

                                        <div class="panel-body noPad clearfix">
                                            <table cellpadding="0" cellspacing="0" border="0" class="responsive dataTable display table table-bordered" width="100%">
                                                <thead>
                                                    ` <tr>
                                                        <th>No</th>
                                                        <th>Group ID</th> 
                                                        <th>File ID</th>
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
                                                        <tr class="code_view" data-sccid="<?php echo $d['cmfile_id']; ?>" data-files="<?php echo $d['cmfile_id'] ?>">
                                                            <td><?php echo $counter; ?></td>
                                                            <td><?php echo $d['group_id']; ?></td> 
                                                            <td><?php echo $d['file_id']; ?></td>                          
                                                            <td><?php echo isset($d['file_name']) ? $d['file_name'] : '-'; ?></td>
                                                        </tr>
                                                    <?php } ?>                           
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Group ID</th> 
                                                        <th>File ID</th>
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
                    </div>
                </div>
            </div>

            <!-- Tabs Start-->
            <div class="row" id="tabs">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div style="margin-bottom: 20px;">
                            <ul id="myTab" class="nav nav-tabs pattern">
                                <li class="active" ><a href="#tree" data-toggle="tab" class=""><h4>Tree Map</h4></a></li>
                                <li><a href="#navigation" data-toggle="tab"><h4>Navigation</h4></a></li>

                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tree">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <!-- Treemap  Start-->
                                            <div class="form-group col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4>
                                                            <span class="icon16 icomoon-icon-equalizer-2"></span>                                                                                                            
                                                            <span class="label legend-treemap4">Very High</span>
                                                            <span class="label legend-treemap3">High</span>
                                                            <span class="label legend-treemap2">Medium</span>
                                                            <span class="label legend-treemap1">Low</span>
                                                            <span class="right marginR5">Tree Map Legend: </span>
                                                        </h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div id="treemap"  class="col-lg-12 "></div>
                                                    </div>
                                                </div><!-- End .panel -->
                                            </div>
                                            <!-- Treemap End-->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="navigation">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="marginL10 col-lg-12" style="border-left:1px solid;border-color:#57AC57;max-height:600px;  height:auto;overflow-y:scroll;overflow-x:hidden;">
                                                <div class="todo">                          
                                                    <ul id="treeDemo" class="ztree"></ul>
                                                </div>
                                            </div>
                                        </div><!-- End contentwrapper -->
                                    </div><!-- End .panel -->     
                                </div>
                            </div>
                        </div>
                    </div><!-- End .span6 -->  
                </div>
            </div>
            <!-- Tabs End-->
        </div><!-- End contentwrapper -->


    </div><!-- End #content -->

</div><!-- End #wrapper -->

<script>
    var zNodes = <?php echo $treedata ?>;
    $(document).ready(function() {
        $(".list_view").on("click", function() {
            $("tr").removeClass('selected-row');
            $(this).addClass('selected-row');

            Clonify.FCS.viewInstanceFileByDir($(this).data("sccid"));
            event.preventDefault();
            return false;
        });

    });
    $(document).ready(function() {
        if ($('table').hasClass('dynamicTablefilesbydir')) {
            $('.dynamicTablefilesbydir').dataTable({
                "sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
                "sPaginationType": "bootstrap",
                "bJQueryUI": false,
                "bAutoWidth": false,
                "iDisplayLength": 5,
                "aLengthMenu": [5, 10, 25, 50],
                "oLanguage": {
                    "sSearch": "<span></span> _INPUT_",
                    "sLengthMenu": "<span>_MENU_</span>",
                    "oPaginate": {"sFirst": "First", "sLast": "Last"}
                }

            }).columnFilter({
                aoColumns: [
                    null,
                    {sSelector: "#diridfilter", type: "number"},
                    null,
                    {sSelector: "#nooffilesfilter", type: "number"}
                ]
            });

            $('.dataTables_length select').uniform();
            $('.dataTables_paginate > ul').addClass('pagination');
            $('.dataTables_filter>label>input').addClass('form-control');
            $('.dataTables_filter').hide();

        }
    });
</script>
