<?php ?>
<script type="text/javascript" src="<?= asset_url('js/myInvoke.js') ?>"></script>

<script type="text/javascript">


    function hideWizard()
    {
        var button = document.getElementById("submitButton");
        var wizardBody = document.getElementById("wizard-body");
        var wizardHeading = document.getElementById("wizard-heading");
        if (button.value === "Submit")
        {
            wizardBody.setAttribute("style", 'display:none');
            wizardHeading.setAttribute("style", 'display:none');
        }
    }

    function validateGroup()
    {
        var groupListCount = document.getElementById("hiddenGroup").options.length;
        var error = document.getElementById("groupErr");

        if (groupListCount < 1)
        {
            error.innerHTML = "Please add a group"
            return false
        }
        else
        {
            error.innerHTML = "";
            return true
        }

    }

    function showProgress()
    {


        var progressBar = document.getElementById("barRow");

        var iNow = new Date().setTime(new Date().getTime() + 1 * 1000); // now plus 2 secs
        var iEnd = new Date().setTime(new Date().getTime() + 4 * 1000); // now plus 8 secs
        var iEnd2 = new Date().setTime(new Date().getTime() + 5.5 * 1000); // now plus 8 secs

        var button = document.getElementById("submitButton");

        if (button.value === "Submit")
        {
            progressBar.setAttribute("style", 'display:block');
            $('#progressRow').anim_progressbar({start: iNow, finish: iEnd, interval: 200});
            // var iNow = new Date().setTime(new Date().getTime() + 2 * 1000); // now plus 2 secs
            setTimeout(showMessage, iEnd2 - iNow);

        }


    }

    function redirect()
    {
        window.location.href = "<?php echo base_url(); ?>index.php/load_results/";
    }

    function loadResults()
    {
        var iNow = new Date().setTime(new Date().getTime() + 1 * 1000); // now plus 2 secs
        var iEnd = new Date().setTime(new Date().getTime() + 3 * 1000); // now plus 4 secs
        var submitValue = document.getElementById("submit").value;
        if (submitValue === "Submit")
        {
            setTimeout(redirect, iEnd - iNow);
        }
    }

    function showMessage()
    {
        var finishButton = document.createElement("button");
        var label = document.createElement("label");
        label.innerHTML = "Your form has been submitted successfully!";

        var messageBox = document.getElementById("message");

        finishButton.setAttribute("class", "btn btn-success pull-right col-lg-2");
        finishButton.setAttribute("onclick", "redirect()");
        finishButton.innerHTML = "Proceed";
        messageBox.appendChild(finishButton);

        messageBox.setAttribute("style", "display:block");


    }
    function enable_text(status) {
        status = (status) ? false : true; //convert status boolean to text 'disabled'
        document.wizard.min_mcc_token.disabled = status;
        document.wizard.min_mcc_percent.disabled = status;
    }

    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

</script>
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

                    <div class="panel-heading" id="wizard-heading">
                        <h4><span>Configuration Wizard</span></h4>

                    </div>

                    <div class="col-lg-12" >
                        <div class="row"   id="barRow" style="display:none">
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="animatedbar">Applying Configuration:</label>
                                <div class="col-lg-12">
                                    <div id="progressRow">
                                        <div class="pbar"></div>
                                        <span class="percent1"></span>
                                        <div class="elapsed"></div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div><!-- End .form-group  -->


                        </div>


                        <div class="row" id="message" style="display:none">

                            <div class="alert alert-success" >
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Clonify Configuration!</strong> form has been submitted successfully.
                            </div>
                        </div>





                    </div><!-- End Progress Bar -->

                    <div class="panel-body noPad clearfix" id="wizard-body">

                        <form id="wizard" name="wizard" class="form-horizontal " role="form" method="POST" accept-charset="utf-8" action="<?php echo base_url(); ?>index.php/invoke/invoke_init"  onsubmit="alert()">
                            <div class="msg"></div>
                            <div class="wizard-actions">

                                <!--
                                <button class="btn btn-default pull-left col-lg-1" type="reset" onclick="changeTextonBack()"> Back </button>
                                <button class="btn btn-success pull-right col-lg-1" type="submit" onclick="changeText();SelectOnSubmit()" id="submitButton"> Next</button>
                                <button class="btn btn-success pull-right col-lg-1" type="submit" onclick="changeText();SelectOnSubmit()" id="submitButton"> Next</button>
                                -->

                                <input type="reset" form="wizard" class="btn btn-default pull-left col-lg-1" value="Back" />
                                <input type="submit" formmethod="POST" form="wizard" class="btn btn-success pull-right col-lg-1" value="Next" id="submit"   onclick="SelectOnSubmit(); loadResults()"/>

                            </div><!-- End .form-group  -->



                            <div class="wizard-steps clearfix"></div>

                            <div class="step" id="invocation-details"><span class="step-info" data-num="1" data-text="Invocation Parameters"></span>


                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="panel panel-default plain">

                                                <div class="panel-heading">

                                                    <h4>
                                                        <span>Invocation Parameters</span>
                                                    </h4>

                                                </div>
                                                <div class="panel-body">

                                                    <div class="form-group">

                                                        <div class="col-lg-6" >

                                                            <div class="panel panel-default">



                                                                <div class="panel-body1">
                                                                    <div class="form-group">


                                                                        <div class="col-lg-12 ">

                                                                            <div class="form-group ">



                                                                            </div><!-- End .form-group  -->
                                                                            <div class="form-group ">

                                                                                <label class="col-lg-6 control-label" for="min_scc_token">Minimum Similarity of SCC in Tokens:</label>
                                                                                <div class="col-lg-4">

                                                                                    <INPUT id="min_scc_token" onkeypress="return isNumberKey(event)" type="text" name="min_scc_token" class="nostyle form-control" value="30" max="999" min="0" maxlength="3" style="width:50px">

                                                                                </div>


                                                                            </div><!-- End .form-group  -->
                                                                            <div class="form-group">
                                                                                <label class="col-lg-6 control-label" for="methodAnalysis">Detect MCC:</label>

                                                                                <div class="col-lg-1 " >

                                                                                    <input class="nostyle" type="checkbox" name="methodAnalysis" id="methodAnalysis" checked="checked" onclick="enable_text(this.checked)" style="width: 1.5em;height: 1.5em; horizontal-align:middle;vertical-align:middle"/>

                                                                                    <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>

                                                                                </div>
                                                                            </div><!-- End .form-group  -->	






                                                                            <div class="form-group">
                                                                                <label class="col-lg-6 control-label" for="min_mcc_token">Minimum Similarity of MCC in Tokens:</label>
                                                                                <div class="col-lg-4">


                                                                                    <INPUT id="min_mcc_token" onkeypress="return isNumberKey(event)" type="text" name="min_mcc_token" class="nostyle form-control" value="30" max="999" min="0" maxlength="3" style="width:50px">

                                                                                    <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>
                                                                                </div>



                                                                            </div><!-- End .form-group  -->
                                                                            <div class="form-group">
                                                                                <label class="col-lg-6 control-label" for="min_mcc_percent">Minimum Similarity of MCC in Percentage:</label>
                                                                                <div class="col-lg-4">
                                                                                    <label class="checkbox-inline">
                                                                                        <input id="min_mcc_percent" class="form-control" onkeypress="return isNumberKey(event)" name="min_mcc_percent" type="text" value="30" min="0"  max="100" maxlength="3" style="width:50px">

                                                                                    </label>


                                                                                </div>
                                                                                <div class="col-lg-offset-2">

                                                                                    <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>

                                                                                </div>

                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="col-lg-6 control-label" for="min_fcc_token">Minimum Similarity of FCC in Tokens:</label>
                                                                                <div class="col-lg-1">


                                                                                    <INPUT id="min_fcc_token" onkeypress="return isNumberKey(event)" type="text" name="min_fcc_token" class="nostyle form-control" value="30" max="999" min="0" maxlength="3" style="width:50px">



                                                                                    <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>
                                                                                </div>



                                                                            </div><!-- End .form-group  -->
                                                                            <div class="form-group">
                                                                                <label class="col-lg-6 control-label" for="min_fcc_percent">Minimum Similarity of FCC in Percentage:</label>
                                                                                <div class="col-lg-4">
                                                                                    <div class="input-group">
                                                                                        <input id="min_fcc_percent" class="form-control" onkeypress="return isNumberKey(event)" name="min_fcc_percent" type="text" value="30" min="0"  max="100" maxlength="3" style="width:50px">


                                                                                    </div>


                                                                                </div>
                                                                                <div class="col-lg-1">

                                                                                    <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>

                                                                                </div>

                                                                            </div>
                                                                            <div class="form-group ">



                                                                            </div><!-- End .form-group  -->




                                                                        </div>

                                                                    </div>
                                                                </div><!-- End .panel body -->
                                                            </div>

                                                        </div><!-- End .span8 -->

                                                        <div class="col-lg-6">

                                                            <div class="panel panel-default">



                                                                <div class="panel-body1">
                                                                    <div class="form-group ">



                                                                    </div><!-- End .form-group  -->
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label" >Language:</label>
                                                                        <div class="col-lg-6">
                                                                            <select  name="language" id="language" class="nostyle form-control col-lg-2" style="width:auto">
                                                                                <option></option>
                                                                                <?php foreach ($languages as $language) { ?>
                                                                                    <option value="<?php echo $language->id ?>"><?php echo $language->language ?></option><?php } ?>
                                                                            </select>
                                                                        </div>

                                                                    </div><!-- End .form-group  -->
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label" >Grouping Mode:</label>
                                                                        <div class="col-lg-6">
                                                                            <select  name="groupingChoice" id="groupingChoice" class="form-control col-lg-2" style="width:auto">
                                                                                <option></option>
                                                                                <option value="mixed">Mixed Mode</option>
                                                                                <option value="across_groups">Across Groups</option>
                                                                            </select>  
                                                                        </div>

                                                                    </div><!-- End .form-group  -->


                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label" for="name">Invocation Name:</label>
                                                                        <div class="col-lg-6">
                                                                            <input  name="iName" id="iName"  type="text" class="form-control" placeholder="Enter a short name for this invocation">
                                                                            <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>
                                                                        </div>

                                                                    </div><!-- End .form-group  -->
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label" for="username">Comments:</label>
                                                                        <div class="col-lg-8">
                                                                            <textarea rows="7" class="form-control col-lg-8 " name="iComment" id="iComment" placeholder="Enter your comments" ></textarea>
                                                                            <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>

                                                                        </div>
                                                                    </div><!-- End .form-group  -->




                                                                </div>

                                                            </div><!-- End .panel -->

                                                        </div><!-- End .span4 -->
                                                    </div>
                                                </div>

                                            </div><!-- End .panel -->

                                        </div><!-- End .span4 -->

                                        <div class="panel panel-default">


                                        </div><!-- End .row -->
                                    </div>



                                </div><!-- End .panel -->



                            </div>
                            <div class="step" id="code-groups"><span class="step-info" data-num="2" data-text="Invocation Files"></span>

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

                                                                <div  class="col-lg-12"> 
                                                                    <div class="form-group" >
                                                                        <label class="col-lg-0 marginL20 control-label pull-left" >Group Count:</label>
                                                                        <div class="col-lg-5">
                                                                            <input  READONLY name="groupCount" id="groupCount"   type="text"  class="form-control" value="0" style="width:50px">
                                                                            <select id="hiddenGroup" name="hiddenGroup[]" style="display:none" multiple="multiple"></select>
                                                                        </div>

                                                                        <div  class="col-lg-5"> 
                                                                            <button  type="button" class="btn btn-success btn marginT6 pull-right" onclick="createNewElement('Group', 'box1View');" >Create Group</button>

                                                                        </div>

                                                                    </div><!-- End .form-group  -->



                                                                </div>





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

                                                                <!-- <div class="panel-group accordion gradient col-lg-12 " id="grouplist1" name="grouplist1"></div> -->
                                                                <div class="panel-group accordion gradient col-lg-12 " id="accordionGroup" name="accordionGroup"></div>

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
                            <div class="step submit_step" id="equal-tokens">  <span class="step-info" data-num="4" data-text="Equal Tokens"></span>
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