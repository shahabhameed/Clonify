<div id="wrapper">
    <?php
    include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php';
    ?>
    <!--Body content-->
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->
            <div class="heading">
                <h3></h3>    
                <ul class="breadcrumb">
                    <li>You are here:</li>
                    <li>
                    </li>
                    <li class="active">About Us</li>
                </ul>
            </div><!-- End .heading-->

            <div>
                <form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/" >


                    <div class="row col-lg-12">
                        <!-- Tabs Start-->
                        <div class="row" id="tabs">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div style="margin-bottom: 20px;">
                                        <ul id="myTab" class="nav nav-tabs pattern">
                                            <li class="active" ><a href="#tree" data-toggle="tab" class=""><h4>What is Clonify?</h4></a></li>
                                            <li><a href="#navigation" data-toggle="tab"><h4>Our Clients</h4></a></li>
                                            <li><a href="#team" data-toggle="tab"><h4>Our Team</h4></a></li>

                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="tree">
                                                <div class="col-md-12">
                                                    <div class="row">

                                                        <p> Clonify</p>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="navigation">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <img src="<?= asset_url('images/gallery/lums.gif') ?>" class="img-rounded" style="height:160px;width:160px;">
                                                            <div class="row">
                                                                <p style="text-align: center">LUMS</p>
                                                            </div>
                                                        </div>
                                                    </div><!-- End contentwrapper -->
                                                </div><!-- End .panel -->     
                                            </div>
                                            <div class="tab-pane fade" id="team">
                                                <div class="col-lg-12">
                                                    <div class="row"> 
                                                        <div class="col-lg-12">

                                                            <div style="margin-bottom: 27px;">
                                                                <div class="row">
                                                                    <div class="col-lg-2">
                                                                        <img src="<?= asset_url('images/gallery/khizer.jpg') ?>" class="img-circle" style="height:160px;width:160px;">
                                                                        <div class="row">
                                                                            <p style="text-align: center">Khizer Bajwa</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <img src="<?= asset_url('images/gallery/mohsin.jpg') ?>" class="img-circle" style="height:160px;width:160px;">
                                                                        <div class="row">
                                                                            <p style="text-align: center">Mohsin Ali Khan</p>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <img src="<?= asset_url('images/gallery/abdullah.jpg') ?>" class="img-circle" style="height:160px;width:160px;">
                                                                        <div class="row">
                                                                            <p style="text-align: center">Abdullah Hamid</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <img src="<?= asset_url('images/gallery/umer.jpg') ?>" class="img-circle" style="height:160px;width:160px;">
                                                                        <div class="row">
                                                                            <p style="text-align: center">Umer Hayat</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <img src="<?= asset_url('images/gallery/hafeez.jpg') ?>" class="img-circle" style="height:160px;width:160px;">
                                                                        <div class="row">
                                                                            <p style="text-align: center">Hafeez ur Rehman</p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div><!-- End .span6 -->

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
                </form>

            </div>
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->

</div><!-- End #wrapper -->

