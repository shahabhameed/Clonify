<style type="text/css">
    .panel .dataTables_length {
        margin-top: 8px;
    }
    div.selector {

        width: 50% !important;

    }
</style>
<script type="text/javascript" src="<?= asset_url('js/myTreeMap.js') ?>"></script>
<div id="wrapper">

    <?php
    include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php';
    ?>
    <div id="content" class="clearfix">
        <div class="contentwrapper">
            <div class="heading">
                <h3>Simple Clone Class</h3> 
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
                    <li class="active">Simple Clone Class</li>
                </ul>                   
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Modal -->
                    <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Select * From FCC Where</h4>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4>FCC ID</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10" id="fccidfilter">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <u><h4>APC</h4></u>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4" id="fccnoofinstance">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <small></small>
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
                                    <h4 class="modal-title" id="myModalLabel">Search * From FCC Clone Instance List Where</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <u><h4>GROUP ID</h4></u>
                                        </div>
                                        <div class="col-md-4" id="gidnumberfilter">
                                        </div>
                                    </div>
                                    <br class="clear_all"/>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <u><h4>Directory ID</h4></u>
                                        </div>
                                        <div class="col-md-4" id="didnumberfilter">
                                        </div>
                                    </div>
                                    <br class="clear_all"/>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <u><h4>File ID</h4></u>
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

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default gradient">
                                    <div class="panel-heading min">
                                        <h4><span> <i class="fa fa-list-alt fa-2"></i> FCC List</span></h4>
                                        <span class="loader" style="top:15px;cursor:pointer;">
                                            <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i>
                                        </span>
                                        <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>

                                    </div>
                                    <div class="panel-body noPad clearfix">
                                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTablefcc display table table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>FCC ID</th>
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
                                                        <tr class="list_view" data-sccid="<?php echo $data['fcc_id']; ?>">
                                                            <td><?php echo $counter; ?></td>
                                                            <td><?php echo $data['fcc_id']; ?></td>                          
                                                            <td style="text-align:left"><?php echo isset($data['fcc_ids']) ? $data['fcc_ids'] : "-"; ?></td>
                                                            <td><?php echo isset($data['atc']) ? $data['atc'] : '-'; ?></td>
                                                            <td><?php echo isset($data['apc']) ? $data['apc'] : '-'; ?></td>
                                                            <td><?php echo isset($data['members']) ? $data['members'] : '-'; ?></td>

                                                        </tr>
                                                    <?php } ?>                           
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>FCC ID</th>
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
                        $c = 0;
                        foreach ($secondary_table_rows as $scc_id => $data) {
                            $scc_csv = str_replace(" ", "", $parent_table_data[$c]['fcc_ids']);
                            $c++;
                            ?>
                            <div class="row scc_instance_list" id="scc_instance_list_<?php echo $scc_id; ?>">
                                <div class="col-md-12">
                                    <div class="panel panel-default gradient">
                                        <div class="panel-heading min">
                                            <h4><span> <i class="fa fa-list-alt fa-2"></i>SCC Clone Instance List - FCC ID - <?php echo $scc_id; ?></span></h4>
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
                                                        <tr class="code_view" id="fcc_<?php echo $scc_id; ?>_<?php echo $d['fid']; ?>"
                                                            data-name="<?php echo $d['directory_name'] . $d['file_name']; ?>" 
                                                            data-endline="" data-endcol="" data-startcol="" 
                                                            data-startline="" 
                                                            data-fid="<?php echo $d['fid']; ?>" 
                                                            data-scsid="<?php echo $scc_csv; ?>" 
                                                            data-clid="" 
                                                            data-path="<?php echo $d['repository_name'] . $d['directory_name'] . $d['file_name'] ?>">                                            
                                                            <td><?php echo $counter; ?></td>
                                                            <td><?php echo isset($d['group_id']) ? $d['group_id'] : "-"; ?></td>
                                                            <td><?php echo isset($d['directory_id']) ? $d['directory_id'] : "-"; ?></td>
                                                            <td><?php echo $d['fid']; ?></td>
                                                            <td><?php echo $d['tc']; ?></td>
                                                            <td><?php echo $d['pc']; ?></td>
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
                                            <div class="col-md-1" id="code_map2">
                                            </div>
                                            <div class="col-md-5 padding15 code-window responsive" id="code_window2">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End contentwrapper -->
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
        </div>








    </div><!-- End #content -->

</div><!-- End #wrapper -->

<script>
var zNodes = <?php echo $treedata ?>;
var fcctree = 1;
var currentfccid = 0;
    function generateTreeMap()
    {
        //var treeMapData = <?php //echo json_encode($treemapdata);                 ?>;
        var data = new Array();
        data = <?php
                        if ($treemapdata) {
                            echo $treemapdata;
                        }
                        ?>;
        //alert(data);
        return data;
    }
    var isFccPage = true;
    var fccTMCodeData = null;
    var fccTMData = <?php echo $treemapFCCdata ?>;
    //console.log(fccTMData[1][0]['fid']);

    $(document).ready(function() {
        tmData = renderTreeMap();
        tmCount = 1;

        $(".list_view").on("click", function() {

            fid = new Array();
            var fccId = $(this).data("sccid");
            currentfccid = fccId;

            for (var key in fccTMData[fccId]) {
                if (typeof fccTMData[fccId][key] === "object") {
                    //console.log(fccTMData[fccId][key]['fid']);
                    tmpFid = fccTMData[fccId][key]['fid'];
                    tmpFid = tmpFid.toString();
                    fid.push(tmpFid);
                }
            }
            fid = $.unique(fid);
            fid = $.unique(fid);
            mysearch(fid);
            tmData = generateNewTreeMap(tmData, fid, tmCount);
            tmCount++;

            $("tr").removeClass('selected-row');
            $(this).addClass('selected-row');

            Clonify.SCC.viewSCCCloneInstance($(this).data("sccid"));
            event.preventDefault();
            return false;
        });

        $(".code_view").on("click", function() {
            fid = $(this).data("fid");
            fid = fid.toString();
            tmData = selectCurrentFileTreeMap(tmData,splitFIDs(fid),tmCount);
            tmCount++;
            $(".scc_instance_list tr").removeClass('selected-row');
            $(this).addClass('selected-row');
            Clonify.SCC.viewCodeData($(this).data("scsid"), $(this).data("clid"), $(this).data("path"), $(this).data("fid"), $(this).data("startline"), $(this).data("endline"), $(this).data("startcol"), $(this).data("endcol"), $(this).data("name"), this);
            event.preventDefault();
            return false;
        });


    });
</script>
