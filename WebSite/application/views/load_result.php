<div id="wrapper">

    <!--Body content-->
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->

            <div class="heading">

               <!-- <h3>View Results</h3>   -->                                                                             
            </div><!-- End .heading-->
            <div class="row">
                <div class="col-lg-12">
                    <?php if ((!empty($isUpdated)) && strcmp($isUpdated, 'true')) { ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong></strong><?php echo $info_message ?> 
                        </div>
                    <?php }; ?>

                    <form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/load_results/update_results" >

                        <div class="content noPadding">
                            <div class="panel panel-default">
                                <div class="panel-heading " style="height:45px"> 
                                    <h4><span class="icon16 fa fa-desktop left marginT5"></span>
                                        <span class="">Results</span>
                                        <button type="button" class="btn btn-danger btn-sm right marginR10"style="width:98px;text-align:center ;"  onclick="location.href = '<?php echo base_url(); ?>'" >Cancel</button>
                                        <button type="submit" class="btn btn-info btn-sm  marginR10 right" style="width:98px; text-align:center;" >Save Changes</button>
                                    </h4>
                                    <!-- <a href="#" class="minimize">Minimize</a> -->
                                </div>


                                <div class="panel-body col-lg-12">
                                    <div class="form-group">
                                        <table class="responsive table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width = "20px"  >#</th>
                                                    <th class="col-lg-4">Date/Time</th>
                                                    <th class="col-lg-6">Name</th>
                                                    <th class="col-lg-1">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 0;
                                                foreach ($results as $result) {
                                                    ?>
                                                    <tr>

                                                        <td style="text-align:center;"><?php echo $count + 1; ?></td>
                                                        <td>
                                                            <?php if ($result->status == 2) { ?>
                                                                <a href="<?php echo site_url('home/SingleCloneClass') . "/" . $result->id; ?>"><?php echo $result->invoked_time; ?></a>
                                                            <?php } else { ?>
                                                                <?php echo $result->invoked_time; ?><?php } ?>      
                                                        </td>
                                                        <td  style="text-align:left;"><input style="width:99%;margin-bottom:0px;border:none;background:#fafafa;webkit-box-shadow: none;-moz-box-shadow: none;box-shadow:none;" type="text" name="<?php echo 'iname' . $count; ?>" value="<?php echo $result->invocation_name; ?>">
                                                            <input type="hidden" name ="<?php echo 'iid' . $count; ?>" value="<?php echo $result->id; ?>"></input>
                                                        </td>
                                                        <?php if ($result->status == 1 || $result->status == 0) { ?>
                                                            <td><a href="#" oldtitle="Tooltip in the right" title="" data-hasqtip="true" aria-describedby="qtip-22"><img src="<?= asset_url('images/Info.png') ?>" height ="24" width="24" /></a></td>
                                                        <?php } ?>
                                                        <?php if ($result->status == 2) { ?>
                                                            <td><a href="#"><img src="<?= asset_url('images/Tick.png') ?>" height ="24" width="24" /></a></td>
                                                        <?php } ?>
                                                        <?php if ($result->status == 3) { ?>
                                                            <td><img src="<?= asset_url('images/Error.png') ?>" height ="24" width="24" title="Error"/></td>
                                                        <?php } ?>
                                                        <?php if ($result->status == 4) { ?>
                                                            <td><img src="<?= asset_url('images/invalid.png') ?>" height ="24" width="24" title = "Invalid Result" /></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <textarea rows="3" style="margin-bottom:0px;border:none;background:#fafafa;width:99%;webkit-box-shadow: none;-moz-box-shadow: none;box-shadow:none;" name="<?php echo 'icomments' . $count; ?>"><?php echo $result->comments; ?></textarea>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            <input style="display:none;" type="text" id="count" name="count" value ="<?php echo $count; ?>" />

                                            </tbody>
                                        </table>
                                    </div>  
                                </div>
                            </div><!-- End .panel -->  

                        </div>
                    </form>



                </div>

            </div>
        </div>
    </div>
</div>