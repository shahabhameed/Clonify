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
	
	$(function(fcs_id) {
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
                label: 'a',
                value: 4,
                parent: 'FCS Within Group',
                data: {description: "a", title: "a"}
            },
            {
                label: 'b',
                value: 4,
                parent: 'FCS Across Group',
                data: {description: "b", title: "b"}
            },
            {
                label: 'c',
                value: 1,
                parent: 'FCS Across Directory',
                data: {description: "c", title: "c"}
            }
			<?php
			 
			 $treemapdata = array ( 
					"cmdid" => "0",
					"did" => "125",
					"dname" => "JAVA/JAVA_1/",
					"dsize" => "2041",
					"files" => array (
						array(
							"dname" => "JAVA/JAVA_1/",
							"filename" => "2",
							"filepath" => "D:/xampp/htdocs/Clonify/WebSite/files/shaban/JAVA/JAVA_1/2.java",
							"fsize" => "12"
							),
							array(
							"dname" => "JAVA/JAVA_1/",
							"filename" => "3",
							"filepath" => "D:/xampp/htdocs/Clonify/WebSite/files/shaban/JAVA/JAVA_1/3.java",
							"fsize" => "8"
							),
							array(
							"dname" => "JAVA/JAVA_1/",
							"filename" => "4",
							"filepath" => "D:/xampp/htdocs/Clonify/WebSite/files/shaban/JAVA/JAVA_1/4.java",
							"fsize" => "15"
							),
							array(
							"dname" => "JAVA/JAVA_1/",
							"filename" => "5",
							"filepath" => "D:/xampp/htdocs/Clonify/WebSite/files/shaban/JAVA/JAVA_1/5.java",
							"fsize" => "20"
							)
							),
						
					"children" => array ( )
					);
			

				if(($treemapdata)){
					$dname = $treemapdata['dname'];
					$dsize = $treemapdata['dsize'];
					$files = $treemapdata['files'];
					//array("Cocos2dxAccelerometer.java","Cocos2dxActivity.java","Cocos2dxBitmap.java");//$treemapdata['files'];
					//array("Cocos2dxAccelerometer.java","Cocos2dxActivity.java","Cocos2dxBitmap.java"); //$data['fileList'];
					foreach($files as $file=>$data)
					{
					
						echo ",{";
						echo "label: '" . $data['filename'] . "',";
						echo "value: " . $data['fsize'] . ",";
						echo "parent: 'FCS Within Directory',";
						echo "data: {description: '" . $data['filename'] . "', title: '" . $data['filename'] . "'}";
						echo "}";
					
				}
				}
				
            ?>
			,{
                label: 'd',
                value: 1,
                parent: 'Cocos2dxAccelerometer.java',
                data: {description: "d", title: "d"}
            }
        ];
		
		loadTreeMap(data);
    });
</script>