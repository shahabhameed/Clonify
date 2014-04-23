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
                    <li class="active">Home</li>
                </ul>
            </div><!-- End .heading-->

            <div>
                <form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/ex_cont/saveFilesToDb" OnSubmit="return ConfirmForm();">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default gradient">
                                <div class="panel-heading" style="height:45px;">
                                    <h4><span class="icon16 fa fa-home"></span>
                                        <span >Home</span>

                                    </h4>

                                </div>
                                <div class="panel-body noPadding " >
                                    <div class="row ">
                                        <div class="col-lg-6">

                                            <div class="panel panel-default">

                                                <div class="panel-heading">

                                                    <h4>
                                                        <span class="icon16 icomoon-icon-list-2"></span>
                                                        <span>Clonify</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="panel-body">
                                                    <p class="h3">Clonify provides</p>
                                                    <dl class="dl-horizontal h4">
                                                        <dt>1</dt>
                                                        <dd>File Clones Detection</dd>
                                                        <dt>2</dt>
                                                        <dd>Simple Clones Detection</dd>

                                                        <dt>3</dt>
                                                        <dd>Method Clones Detection</dd>
                                                        <dt>4</dt>
                                                        <dd>Support for multiple Languages</dd>
                                                        <dt>5</dt>
                                                        <dd>User Friendly and intuitive UI</dd>
                                                        <dt>6</dt>
                                                        <dd>Notifications of your results on your email!</dd>





                                                    </dl>
                                                </div>

                                            </div><!-- End .panel -->

                                        </div><!-- End .span8 -->

                                        <div class="col-lg-6">

                                            <div class="panel panel-default chart">

                                                <div class="panel-heading">

                                                    <h4>
                                                        <span class="icon16 fa fa-dashboard"></span>
                                                        <span>Clone Activity</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="auto-update-chart" style="height: 230px;width:100%;">

                                                    </div>
                                                </div>

                                            </div><!-- End .panel -->

                                        </div><!-- End .span6 -->






                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="panel panel-default chart">

                                                <div class="panel-heading">

                                                    <h4>
                                                        <span class="icon16 fa fa-bar-chart-o"></span>
                                                        <span>Clones Detected</span>
                                                    </h4>
                                                    <a href="#" class="minimize">Minimize</a>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="stacked-bars-chart" style="height: 230px;width:100%;">

                                                    </div>
                                                </div>

                                            </div><!-- End .panel -->

                                        </div><!-- End .span6 -->
                                    </div>
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
    $().ready(function() {
        var elf = $('#elfinder').elfinder({
            // lang: 'ru',             // language (OPTIONAL)
            url: '<?php echo site_url("ex_cont/elfinder_init"); ?>', // connector URL (REQUIRED)
            uiOptions: {
                toolbar: [
                    // toolbar configuration
                    ['open'],
                    ['back', 'forward'],
                    ['reload'],
                    ['home', 'up'],
                    ['mkdir', 'mkfile', 'upload'],
                    ['info'],
                    ['rm'],
                    ['search'],
                    ['view']
                ]
            },
            contextmenu: {
                // navbarfolder menu
                navbar: ['open', '|', 'rm', '|', 'info'],
                // current directory menu
                cwd: ['reload', 'back', '|', 'upload', 'mkdir', '|', 'info'],
                // current directory file menu
                files: [
                    'getfile', '|', 'open', 'quicklook', '|', 'download', '|',
                    'rm', '|', 'info'
                ]
            },
        }).elfinder('instance');
    });
    function ConfirmForm()
    {

        return confirm("You are about make changes in your repository!" +
                "Click OK to continue or Cancel to abort.");
    }
</script>