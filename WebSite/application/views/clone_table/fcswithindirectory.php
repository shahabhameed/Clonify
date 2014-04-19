  
<?php 
  include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; 
?>
    <div id="content" class="clearfix">
      <div class="contentwrapper" >
        <div class="heading">
          <h3>FCS Within Directory</h3> 
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
                <li class="active">FCS Within Directory</li>
            </ul>                   
        </div>
        
                   <!-- Modal -->
        <div class="modal fade" id="qtable1" tabindex="-1" role="dialog" aria-labelledby="Table 1 Query" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Select * From FCS Within Directory Where</h4>
              </div>
              <div class="modal-body">
               
               <div class="row">
                  <div class="col-md-4">
                    <u><h4>SCS Id</h4></u>
                  </div>
               </div>
               <div class="row">
                    <div class="col-md-10" id="scsidnumberfilter1">
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
                    <u><h4>No Of Colones</h4></u>
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
        <div class="row-fluid">
          <div class="col-md-9">
            <div class="row ">
              <div class="col-md-12">
                <div class="panel panel-default gradient">
                  <div class="panel-heading min">
                   <h4><span> <i class="fa fa-list-alt fa-2"></i> FCS Within Directory List</span></h4>
                   <span class="loader" style="top:15px;cursor:pointer;">
                    <!-- <i class="fa fa-search fa-4" data-toggle="modal" data-target="#qtable1"></i> -->
                  </span>
                   <a href="#"  id="pannel1" class="minimize" style="display: inline;">Minimize</a>
                  </div>
                  <div class="panel-body noPad clearfix">
                    <table cellpadding="0" cellspacing="0" border="0" class="responsive scsafiletable display table table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>FCS ID</th>
                          <th>Structure (FCS ID)</th>                        
                          <th>Directory</th>
                          <th>Members</th>                        
                        </tr>
                      </thead>
                      <tbody>
                       <tr class="list_view" data-scsid="1">
                          <td>1</td>
                          <td>1</td>
                          <td>70,70,70,68,68,68</td>
                          <td>0</td>
                          <td>2</td>
                       </tr>
                        <tr class="list_view" data-scsid="2">
                          <td>2</td>
                          <td>2</td>
                          <td>70,70,68,68</td>
                          <td>0</td>
                          <td>3</td>
                       </tr>
                      </tbody>
                       <tfoot>
                        <tr>
                          <th>No</th>
                          <th>FCS ID</th>
                          <th>Structure (FCS ID)</th>                        
                          <th>Directory</th>
                          <th>Members</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
            <div class="row scs_instance_list" id="scs_instance_list_1">
              <div class="col-md-12">
                <div class="panel panel-default gradient">
                  <div class="panel-heading min">
                   <h4><span> <i class="fa fa-list-alt fa-2"></i>FCS Clone Instance List</span></h4>
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
                            <tr class="code_view" data-folders="12,14" data-name="" data-endline="" data-endcol="" data-startcol="" data-startline="" data-fid="1" data-scsid= "1" data-clid="" data-path="">
                              <td>1</td>
                              <td>1</td>
                              <td>2,4</td>
                            </tr>
                             <tr class="code_view" data-folders="13,15" data-name="" data-endline="" data-endcol="" data-startcol="" data-startline="" data-fid="2" data-scsid= "2" data-clid="" data-path="">
                              <td>2</td>
                              <td>2</td>
                              <td>3,5</td>
                            </tr>
                          
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
            <div class="row scs_instance_list" id="scs_instance_list_2">
              <div class="col-md-12">
                <div class="panel panel-default gradient">
                  <div class="panel-heading min">
                   <h4><span> <i class="fa fa-list-alt fa-2"></i>FCS Clone Instance List</span></h4>
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
                            <tr class="code_view" data-folders="21" data-name="" data-endline="" data-endcol="" data-startcol="" data-startline="" data-fid="1" data-scsid= "1" data-clid="" data-path="">
                              <td>1</td>
                              <td>1</td>
                              <td>1</td>
                            </tr>
                            <tr class="code_view" data-folders="22,23" data-name="" data-endline="" data-endcol="" data-startcol="" data-startline="" data-fid="2" data-scsid= "2" data-clid="" data-path="">
                              <td>2</td>
                              <td>2</td>
                              <td>2,3</td>
                            </tr>
                          
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
          </div>
          <div class="col-md-3" style="border-left:1px solid;">
            <ul id="treeDemo" class="ztree"></ul>
          </div>
        </div>  
        
        
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
     $(function() {
          generateTreeMap($(this).data("scsid"));
     }
    function generateTreeMap(scsid)
    {
        <?php 
       // if ($data) 
        {   
        $dirPath=$data['dirPath'];
        $scsId=$data['scsId'];
        $dirSize=$data['dirSize'];
        $fileList=array(1,2,3); //$data['fileList'];

        }
         //<td><?php echo isset($data['pc']) ? $data['pc'] : '-'; ?></td>
         //<td><?php echo $data['members']; ?></td>

                                    
                                
        
        ?>
                
        var data = [
            {
                label: 'FCS Within Group',
                value: null,
                color: '#2CDF90'
            },
            {
                label: 'FCS Across Group',
                value: null,
                color: '#536FD8'
            },
            {
                label: 'FCS Across Directory',
                value: null,
                color: '#9C9394'
            },
            {
                label: 'FCS Within Directory',
                value: null,
                color: '#37D1D5'
            },
            
            <?php
                foreach($filelist as $file){
                    echo "{";
                    echo "label: '" . $file . "',";
                    echo "value: " . $file . ",";
                    echo "parent: 'FCS Within Directory',";
                    echo "data: {description: " . $file . ", title: " . $file. "}";
                    echo "},";
                }
            ?>
                        
            {
                label: 'F5',
                value: 8.8,
                parent: 'FCS Across Group',
                data: {description: "F5", title: "F5"}
            },
            {
                label: 'F10',
                value: 8.7,
                parent: 'FCS Across Directory',
                data: {description: "F10", title: "F10"}
            },
            {
                label: 'F14',
                value: 4.3,
                parent: 'FCS Within Gr00up',
                data: {description: "F14", title: "F14"}
            },
        ];
        // loadTreeMap(data);
        
    }
    
    	function loadTreeMap(data){
		$('#treemap').jqxTreeMap({
            width: 800,
            height: 800,
            source: data,
            colorRange: 50,
            renderCallbacks: {
                '*': function(element, value) {
                    if (value.data) {
                        element.jqxTooltip({
                            content: '<div><div style="font-weight: bold; max-width: 200px; font-family: verdana; font-size: 13px;">' + value.data.title + '</div><div style="width: 200px; font-family: verdana; font-size: 12px;">' + value.data.description + '</div></div>',
                            position: 'mouse',
                            autoHideDelay: 6000
                        });
                    } else if (value.data === undefined) {
                        element.css({
                            backgroundColor: '#fff',
                            border: '1px solid #555'
                        });
                    }
                }
            }
        });
	}
$(document).ready(function(){
  $('.scsafiletable').dataTable( {
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
                     { sSelector: "#scsidnumberfilter1",type: "number" },
                     null,
                     { sSelector: "#atcnumberfilter",type: "number" },
                     { sSelector: "#apcnumberfilter",type: "number-range" },
                     
                     { sSelector: "#sccnumberfilter",type: "number" }
                     ]
    });
    $('.dataTables_length select').uniform();
    $('.dataTables_paginate > ul').addClass('pagination');
    $('.dataTables_filter>label>input').addClass('form-control');
    $('.dataTables_filter').hide();
    
    
    
    $(".list_view").on("click",function(){
     
        $('.scs_instance_list').hide();
        $('.treeMapBlock').show();
        expand($(this).data("scsid"));
        $("#scs_instance_list_"+$(this).data("scsid")).show();
        generateTreeMap($(this).data("scsid"));
        return false;
    }
        );
    $(".code_view").on("click",function(){
       mysearch($(this).data("folders"));
    });
    
  });
</script>