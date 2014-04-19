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
                                    <h4><span class="icon16 fa fa-cloud-upload"></span>
                                        <span >Home</span>
                                        
                                    </h4>

                                </div>
                                <div class="panel-body noPadding " style="height:500px">
                                    <div class="row ">

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