<div id="wrapper">

    <!--Body content-->
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->

            <div class="heading">

                <h3>Load Results</h3>                                                                               
            </div><!-- End .heading-->
            <div class="row-fluid">
                <div class="span12">
                    <?php if ((!empty($isUpdated)) && strcmp($isUpdated, 'true')) { ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong></strong><?php echo $info_message ?> 
                        </div>
                    <?php }; ?>

                    <div class="box">
                        <div class="content noPad">
                            <form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/load_results/update_results" >
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
                                                <?php if ($result->status == 1) { ?>
                                                    <td><a href="#" oldtitle="Tooltip in the right" title="" data-hasqtip="true" aria-describedby="qtip-22"><img src="<?= asset_url('images/Info.png') ?>" height ="24" width="24" /></a></td>
                                                <?php } ?>
                                                <?php if ($result->status == 2) { ?>
                                                    <td><a href="#"><img src="<?= asset_url('images/Tick.png') ?>" height ="24" width="24" /></a></td>
                                                <?php } ?>
                                                <?php if ($result->status == 3) { ?>
                                                    <td><img src="<?= asset_url('images/Error.png') ?>" height ="24" width="24" /></td>
                                                 <?php } ?>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <textarea rows="1" style="margin-bottom:0px;border:none;background:#fafafa;width:99%;webkit-box-shadow: none;-moz-box-shadow: none;box-shadow:none;" name="<?php echo 'icomments' . $count; ?>"><?php echo $result->comments; ?></textarea>
                                                </td>
                                            </tr>
                                            <?php $count++;
                                        }
                                        ?>
                                    <input style="display:none;" type="text" id="count" name="count" value ="<?php echo $count; ?>" />
                                    <!--  
                                                                              <tr>
                                        <td>1</td>
                                        <td>2014-02-11T10:22:46+00:00</td>
                                        <td><a href=#>umerhayat_result_5<a></td>
                                        <td><img src="<?= asset_url('images/Info.png') ?>" height ="24" width="24" /></td>
                                      </tr>
                                      <tr>
                                        <td>1</td>
                                        <td>2014-02-11T10:22:46+00:00</td>
                                        <td><a href=#>umerhayat_result_4<a></td>
                                        <td><img src="<?= asset_url('images/Tick.png') ?>" height ="24" width="24" /></td>
                                      </tr>
                                      <tr>
                                        <td>1</td>
                                        <td>2014-02-11T10:22:46+00:00</td>
                                        <td><a href=#>umerhayat_result_3<a></td>
                                        <td><img src="<?= asset_url('images/Tick.png') ?>" height ="24" width="24" /></td>
                                      </tr>
                                                                              <tr>
                                        <td>1</td>
                                        <td>2014-02-11T10:22:46+00:00</td>
                                        <td><a href=#>umerhayat_result_2<a></td>
                                        <td><img src="<?= asset_url('images/Error.png') ?>" height ="24" width="24" /></td>
                                      </tr>
                                                                              <tr>
                                        <td>1</td>
                                        <td>2014-02-11T10:22:46+00:00</td>
                                        <td><a href=#>umerhayat_result_1<a></td>
                                        <td><img src="<?= asset_url('images/Tick.png') ?>" height ="24" width="24" /></td>
                                      </tr> -->
                                    </tbody>
                                </table>


                                <div class="form-group col-lg-12">
                                   

                                        <button type="submit" class="btn btn-info col-lg-1 pull-left marginR10 marginT10">Save Changes</button>
                                        <button type="button" onclick="location.href = '<?php echo base_url(); ?>'" class="btn btn-danger col-lg-1 marginT10">Cancel</button>

                                   
                                </div>


                        </div>

                    </div><!-- End .box -->
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>