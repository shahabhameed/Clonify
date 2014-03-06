<?php ?>
<script type="text/javascript" src="<?= asset_url('js/myInvoke.js') ?>"></script>

<div id="content" class="clearfix">
    <div class="contentwrapper">
        <div class="heading">
            <h3>Configuration</h3>
            <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                </li>
                <li class="active">Configuration</li>
            </ul>
        </div>

        <div class="row">



        </div><!-- End .row -->           

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default gradient">
                    <div class="panel-heading">
                        <h4><span>Configuration Wizard</span></h4>

                    </div>

                    <div class="col-lg-4">

                    </div><!-- End .span6 -->
                    
                    
                    <div class="panel-body noPad clearfix">
                        <form id="wizard" name="wizard" class="form-horizontal" role="form" method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/invoke/invoke_init"  onsubmit="alert();">
                            <div class="wizard-actions">
                                <button class="btn btn-default pull-left col-lg-1" type="reset"> Back </button>
                                <button class="btn btn-success pull-right col-lg-1" type="submit" onclick="SelectOnSubmit();"> Next </button>
                                <!-- <button class="btn btn-success pull-right col-lg-1" type="next" > Next </button> -->
                            </div><!-- End .form-group  -->

                                                            <div class="msg"></div>



                            <div class="wizard-steps clearfix"></div>

                            <div class="step" id="invocation-details"><span class="step-info" data-num="1" data-text="Invocation Parameters"></span>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="username">Min Similarities:</label>
                                    <div class="col-lg-8">
                                        <input id="spinner1" class="form-control" name="spinner1" type="text" value="30" >

                                        <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>

                                    </div>
                                </div><!-- End .form-group  -->

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" >Grouping Mode:</label>
                                    <div class="col-lg-2">
                                        <select  name="groupingChoice" id="groupingChoice" class="form-control col-lg-2">
                                            <option value="mixed">Mixed Mode</option>
                                            <option value="across_groups">Across Groups</option>
                                        </select>  
                                    </div>

                                </div><!-- End .form-group  -->

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" >Language:</label>
                                    <div class="col-lg-2">
                                        <select  name="language" id="language" class="form-control col-lg-2">
                                            <?php foreach ($languages as $language) { ?>
                                                <option value="<?php echo $language->id ?>"><?php echo $language->language ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div><!-- End .form-group  -->

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="username">Name:</label>
                                    <div class="col-lg-3">
                                        <input  name="iName" id="iName" type="text" class="form-control" placeholder="Enter a short name for this invocation">
                                        <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>
                                    </div>

                                </div><!-- End .form-group  -->

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="username">Comments:</label>
                                    <div class="col-lg-6">
                                        <textarea rows="3" class="form-control" name="iComment" id="iComment" placeholder="Enter your comments"></textarea>
                                        <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>
                                    </div>
                                </div><!-- End .form-group  -->

                            </div>
                            <div class="step" id="code-groups"><span class="step-info" data-num="2" data-text="Code Groups"></span>

                                <div class="col-lg-12">
                                    <div class="row">

                                        <div class="panel panel-default">

                                            <div class="form-group">

                                                <div class="col-lg-6">

                                                    <div class="panel panel-default">

                                                        <div class="panel-heading">
                                                            <h4><span class="icon16 icomoon-icon-equalizer-2"></span><span>Files From Database</span> </h4><a href="#" class="minimize">Minimize</a>
                                                        </div>

                                                        <div class="panel-body">
                                                            <div class="form-group">

                                                                <div class="col-lg-12">
                                                                    <select id="box1View" multiple="multiple" class="form-control" style="height:300px;">
                                                                        <?php foreach ($usrfiles as $usrfile) { ?>
                                                                            <option value="<?php echo $usrfile->id ?>" selected="false"><?php echo $usrfile->fname ?></option><?php } ?>

                                                                    </select>
                                                                    <br/>
                                                                    <label id="filErr" class="myErrLbl"></label>
                                                                    <!--<span id="box1Counter" class="count"></span>-->

                                                                    <div class="dn"><select id="box1Storage" name="box1Storage" class="nostyle "></select></div>

                                                                </div>

                                                                <div align="right" class="col-lg-12"> 
                                                                    <button  type="button" class="btn btn-success btn marginT6" onclick="createNewElement('Group', 'box1View');" >Create Group</button>
                                                                </div>
                                                                <select id="hiddenGroup" name="hiddenGroup[]" style="display:none" multiple="multiple"></select>




                                                            </div>
                                                        </div><!-- End .panel body -->
                                                    </div>

                                                </div><!-- End .span8 -->

                                                <div class="col-lg-6">

                                                    <div class="panel panel-default">

                                                        <div class="panel-heading"> <h4><span class="icon16 icomoon-icon-equalizer-2"></span><span>Code Groups</span></h4>
                                                            <a href="#" class="minimize">Minimize</a>
                                                        </div>

                                                        <div class="panel-body">
                                                            <div class="form-group">

                                                                <div class="panel-group accordion gradient col-lg-12" id="accordionGroup"></div>

                                                            </div>  
                                                        </div>

                                                    </div><!-- End .panel -->

                                                </div><!-- End .span4 -->
                                            </div>
                                        </div><!-- End .row -->
                                    </div>



                                </div><!-- End .panel -->

                            </div>
                            <div class="step" id="sup-tokens"><span class="step-info" data-num="3" data-text="Suppressed Tokens"></span>

                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="panel panel-default">

                                            <div class="col-lg-5">

                                                <div class="panel panel-default">
                                                    <div class="panel-heading"> 
                                                        <h4><span class="icon16 icomoon-icon-equalizer-2"></span><span>Equal Tokens</span></h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="form-group">

                                                            <div class="col-lg-12">

                                                                <select multiple="multiple" id="suppresed" name="suppresed[]" class="form-control" style="height:300px;">>
                                                                    <?php foreach ($tokens as $token) { ?>
                                                                        <option value="<?php echo $token->token_id ?>"><?php echo $token->token_id . " - " . $token->token_name ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <br/>
                                                                <label id="filErr" class="myErrLbl"></label>

                                                                <div class="dn"><select id="box1Storage" name="box1Storage" class="nostyle"></select></div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-lg-2">
                                                <div class="panel panel-default"> 
                                                    <div class="dualBtn">
                                                        <div class="form-group" align="center">


                                                            <button id="to2" type="button" class="btn marginT2" onclick="moveOptions('suppresed', 'suppresed2')"><span class="icon12 minia-icon-arrow-right-3"></span></button><br/>
                                                            <button id="to1" type="button" class="btn marginT5" onclick="moveOptions('suppresed2', 'suppresed')"><span class="icon12 minia-icon-arrow-left-3"></span></button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-5">	
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4><span class="icon16 icomoon-icon-equalizer-2"></span><span>Selected Tokens</span></h4>
                                                        <a href="#" class="minimize">Minimize</a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="form-group">

                                                            <div class="col-lg-12">
                                                                <select multiple="multiple" id="suppresed2" name="suppresed2[]" class=" form-control" style="height:300px; ">>
                                                                    <?php foreach ($prev_sup_tokens as $prev_sup_token) { ?>
                                                                        <option value="<?php echo $prev_sup_token->token_id ?>"><?php echo $prev_sup_token->token_id . " - " . $prev_sup_token->token_name ?></option>
                                                                    <?php } ?>
                                                                </select>													
                                                            </div>
                                                        </div><!-- End .span4 -->

                                                    </div>

                                                </div>

                                            </div><!-- End .col  -->


                                        </div>

                                    </div ><!-- End .row -->

                                </div ><!-- End .Main col  -->

                            </div>	<!-- End .Row  -->			
                            <div class="step submit_step " id="equal-tokens">
                                <span class="step-info" data-num="4" data-text="Equal Tokens"></span>
                                <div class="col-lg-12">
                                    <div class="row">

                                        <div class="panel panel-default">

                                            <div class="form-group">

                                                <div class="col-lg-6">

                                                    <div class="panel panel-default">

                                                        <div class="panel-heading">
                                                            <h4><span class="icon16 icomoon-icon-equalizer-2"></span><span>Equal Tokens</span> </h4><a href="#" class="minimize">Minimize</a>
                                                        </div>

                                                        <div class="panel-body">
                                                            <div class="form-group">

                                                                <div class="col-lg-12">

                                                                    <select multiple="multiple" id="equal" name="equal[]" class="multiple form-control" style="height:300px; ">
                                                                        <?php foreach ($alltokens as $token) { ?>
                                                                            <option value="<?php echo $token->token_id ?>"><?php echo $token->token_id . " = " . $token->token_name ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <br/>
                                                                    <label id="filErr" class="myErrLbl"></label>

                                                                    <div class="dn"><select id="box1Storage" name="box1Storage" class="nostyle"></select></div>

                                                                </div>

                                                                <div align="right" class="col-lg-12"> 
                                                                    <button  type="button" class="btn btn-success btn marginT6" onclick="createNewElement('Rule', 'equal');">Add Rule</button>
                                                                </div>
                                                                <select id="hiddenRule" name="hiddenRule[]" style="display:none" multiple="multiple"></select>



                                                            </div>
                                                        </div><!-- End .panel body -->
                                                    </div>

                                                </div><!-- End .span8 -->

                                                <div class="col-lg-6">

                                                    <div class="panel panel-default">

                                                        <div class="panel-heading"> <h4><span class="icon16 icomoon-icon-equalizer-2"></span><span>Rules</span></h4>
                                                            <a href="#" class="minimize">Minimize</a>
                                                        </div>

                                                        <div class="panel-body">
                                                            <div class="form-group">

                                                                <div class="panel-group accordion" id="accordionRule">
                                                                </div>

                                                            </div>  
                                                        </div>

                                                    </div><!-- End .panel -->

                                                </div><!-- End .span4 -->
                                            </div>
                                        </div><!-- End .row -->
                                    </div>



                                </div><!-- End .panel -->


                            </div><!-- End .step -->      

                        </form>
                    </div>  <!-- End .wizard -->
                </div><!-- End .panel -->

            </div><!-- End .span12 -->

        </div><!-- End .row -->








    </div> <!-- End content wrapper -->   
</div> <!-- End content -->   
<script>
    SelectSort("suppresed");
    SelectSort("box1View");
    SelectSort("equal");
</script>