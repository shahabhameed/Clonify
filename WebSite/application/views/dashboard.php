<div id="wrapper">
<?php 
  include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; 
?>
        <!--Body content-->
       <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>File Manager</h3>                                                                               
                </div><!-- End .heading-->
				
				
             <div class="row-fluid">

                        <div class="span12">

                            <div class="box gradient">
                                <div class="title">
                                    <h4>
                                        <span class="icon16 icomoon-icon-folder"></span>
                                        <span>File manager and upload</span>
                                    </h4>
                                </div>
                                <div class="content noPad">
                                    <div id="elfinder"></div>
                                </div>

                            </div><!-- End .box -->

                        </div><!-- End .span12 -->

                   </div><!-- End .row-fluid -->
				<div>
					<form method="post" accept-charset="utf-8" action="<?php echo base_url();?>index.php/ex_cont/saveFilesToDb" >
					<input type="submit" value="Finish"/>
				</div>
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->

    <script type="text/javascript" charset="utf-8">
    $().ready(function() {
        var elf = $('#elfinder').elfinder({
            // lang: 'ru',             // language (OPTIONAL)
            url : '<?php echo site_url("ex_cont/elfinder_init");?>'  // connector URL (REQUIRED)
        }).elfinder('instance');            
    });
    </script>