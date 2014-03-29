<div id="wrapper">
    <?php
    include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php';
    ?>
    <!--Body content-->
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->

            <div class="heading">

                <h3>


                </h3>    
                <ul class="breadcrumb">
                    <li>You are here:</li>
                    <li>
                    </li>
                    <li class="active">Tree Map</li>
                </ul>
            </div><!-- End .heading-->

            <div>
                <form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/" >

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default gradient">
                                <div class="panel-heading">
                                    <h4><span class="icon16 fa fa-cloud-upload"></span>
                                        <span >Tree Map</span></h4>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                                <div class="panel-body noPad clearfix">

                                    <div class="row ">
                                        <div class=" box gradient col-lg-12">
                                            <div class="content noPad col-lg-12">

                                                <button class=" btn btn-info pull-left col-lg-2" style="display:none" type="submit">View Tree Map</button>
                                            </div>  
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">

                                            <div class="panel panel-default">

                                                <div class="form-group">

                                                    <div class="col-lg-12 box">

                                                        <div class="panel panel-default">

                                                            

                                                            <div class="panel-body1">
                                                                <div class="form-group">
                                                                    <div id="treemap" align="center" class="marginL20 col-lg-12 "></div>
                                                                </div>
                                                            </div><!-- End .panel body -->
                                                        </div>

                                                    </div><!-- End .span8 -->


                                                </div>
                                            </div><!-- End .row -->
                                        </div>



                                    </div><!-- End .panel -->


                                </div>

                            </div>
                        </div>
                    </div>



                </form>

            </div>
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->

</div><!-- End #wrapper -->

<script type="text/javascript" charset="utf-8">

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
	
    $(function() {
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
            {
                label: 'F1',
                value: 15.4,
                parent: 'FCS Within Group',
                data: {description: "F1", title: "F1"}
            },
            {
                label: 'F2',
                value: 4,
                parent: 'FCS Within Group',
                data: {description: "F1", title: "F1"}
            },
            {
                label: 'F3',
                value: 41.5,
                parent: 'FCS Within Group',
                data: {description: "F3", title: "F3"}
            },
            {
                label: 'F4',
                value: 6.8,
                parent: 'FCS Within Group',
                data: {description: "F4", title: "F4"}
            },
            {
                label: 'F5',
                value: 8.8,
                parent: 'FCS Across Group',
                data: {description: "F5", title: "F5"}
            },
            {
                label: 'F6',
                value: 11,
                parent: 'FCS Across Group',
                data: {description: "TF6.", title: "F6"}
            },
            {
                label: 'F7',
                value: 8.9,
                parent: 'FCS Across Group',
                data: {description: "F7", title: "F7"}
            },
            {
                label: 'F8',
                value: 6.0,
                parent: 'FCS Across Group',
                data: {description: "F8", title: "F8"}
            },
            {
                label: 'F9',
                value: 8.7,
                parent: 'FCS Across Group',
                data: {description: "FF9", title: "F9"}
            },
            {
                label: 'F10',
                value: 8.7,
                parent: 'FCS Across Directory',
                data: {description: "F10", title: "F10"}
            },
            {
                label: 'F11',
                value: 7.9,
                parent: 'FCS Across Directory',
                data: {description: "F11", title: "F11"}
            },
            {
                label: 'F12',
                value: 10.8,
                parent: 'FCS Across Directory',
                data: {description: "F12", title: "F12"}
            },
            {
                label: 'F13',
                value: 9.8,
                parent: 'FCS Across Directory',
                data: {description: "F13", title: "F13"}
            },
            {
                label: 'F14',
                value: 4.3,
                parent: 'FCS Within Directory',
                data: {description: "F14", title: "F14"}
            },
            {
                label: 'F15',
                value: 9.3,
                parent: 'FCS Within Directory',
                data: {description: "F15", title: "F15"}
            },
            {
                label: 'F16',
                value: 7,
                parent: 'FCS Within Directory',
                data: {description: "F16", title: "F16"}
            },
            {
                label: 'F17',
                value: 5.6,
                parent: 'FCS Within Directory',
                data: {description: "F17", title: "F17"}
            },
            {
                label: 'F18',
                value: 6.0,
                parent: 'FCS Within Directory',
                data: {description: "F18", title: "F18"}
            },
            {
                label: 'F19',
                value: 6.1,
                parent: 'FCS Within Directory',
                data: {description: "F19", title: "F19"}
            }
        ];
<<<<<<< HEAD
        $('#treemap').jqxTreeMap({
            width: 800,
            height: 800,
            source: data,
            colorRange: 50,
            selectionEnabled: true ,
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
    });
    

</script>