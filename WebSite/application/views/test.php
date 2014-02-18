<?php
?>
<script>
function addOption(selectbox,text,value )
{var optn = document.createElement("OPTION");
optn.text = text;
optn.value = value;
selectbox.options.add(optn);
}

function createGroup(){
	var groups=document.getElementById("accordion1");
    var childCount = groups.getElementsByClassName("panel panel-default").length;
	var id="collapse"+(childCount+1);
	var href="#"+id;
	
	var newGroup=document.createElement('div');newGroup.setAttribute('class','panel panel-default');	
	var newPanel=document.createElement('div'); newPanel.setAttribute('class','panel-heading'); 
	var newHeading=document.createElement('h4');newHeading.setAttribute('class','panel-title');
	var groupName=document.createElement('a'); groupName.setAttribute('class','accordion-toggle'); groupName.setAttribute('data-toggle','collapse');groupName.setAttribute('data-parent','#accordion1');
	groupName.setAttribute('href',href);
	groupName.innerHTML="Group "+(childCount+1);
	
	
	var collapse=document.createElement('div'); collapse.setAttribute('class','panel-collapse collapse'); collapse.setAttribute('id',id);
	
	var list=document.createElement('select'); list.setAttribute('id',list+(childCount+1)); list.setAttribute('multiple','multiple'); list.setAttribute('class','multiple nostyle pull-right');
	list.setAttribute('style','height:150px; width:450px;')
	var rightBox=document.getElementById("box2View");
	var leftBox=document.getElementById("box1View");

	if(leftBox.length>0)
	{
	
			for(i=0;i<leftBox.length;i++)
			{
				if(leftBox.options[i].selected==true){
				addOption(list,leftBox.options[i].innerHTML,leftBox.options[i].value);
				}
			
			}
	
	
	
	var content=document.createElement('div'); content.setAttribute('class','panel-body');  content.appendChild(list);
	
	newHeading.appendChild(groupName);
	newPanel.appendChild(newHeading);
	newGroup.appendChild(newPanel);
	
	
	collapse.appendChild(content);
	newGroup.appendChild(collapse);
	groups.appendChild(newGroup);
	}
	
	
	

	

}

function myValidate(){
	var minTok = document.getElementById("sccMinSim");
	var minTokErr = document.getElementById("minTokErr");
	var fil = document.getElementById("files");
	minTokErr.innerHTML = '';
	filErr.innerHTML = '';
	//alert(fil.value);
	var isValidated = true;
	if(minTok.value == ''){
		minTokErr.innerHTML = 'This field cannot be empty.';
		isValidated = false;
	}
	else if(isNaN(minTok.value)){
		minTokErr.innerHTML = 'Please enter a valid numeric value.';
		isValidated = false;
	}
	else{
		minTokErr.innerHTML = '';
	}

	if(fil.value == ''){
		filErr.innerHTML = 'Please select a file to continue.';
		isValidated = false;
	}
	else{
		filErr.innerHTML = '';
	}
	
	return isValidated;
}
</script>

<div id="content" class="clearfix">
      <div class="contentwrapper">
        <div class="heading">
          <h3>Groups</h3>
          <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                </li>
                <li class="active">Test</li>
            </ul>
        </div>
  <div class="row">
  
   <div class="col-lg-6">
                

                        </div><!-- End .span6 -->

                    </div><!-- End .row -->           
  
  <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default gradient">
                                <div class="panel-heading">
                                    <h4><span>Configuration Wizard</span></h4>

                                </div>
                                <div class="panel-body noPad clearfix">
                                   <form id="wizard" class="form-horizontal" role="form" >
								   <div class="wizard-actions">
                                            <button class="btn btn-default pull-left" type="reset"> Back </button>
                                            <button class="btn btn-success pull-right" type="submit"> Next </button>
                                        </div><!-- End .form-group  -->
                                        <div class="msg"></div>
                                        <div class="wizard-steps clearfix"></div>

										
										
										
										
										
                                        <div class="step" id="invocation-details">
                                            <span class="step-info" data-num="1" data-text="Invocation Parameters"></span>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="username">Min Similarities:</label>
                                                <div class="col-lg-10">
                                                   <input id="spinner1" name="spinner1" type="text" value="1">

												   <label style="display:inline-block" class="myErrLbl" id="minTokErr"></label>
                                                </div>
                                            </div><!-- End .form-group  -->
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >Grouping Mode:</label>
                                                <div class="col-lg-2">
                                                   <select style="width:120px;" name="groupingChoice" id="groupingChoice">
													<option value="mixed">Mixed Mode</option>
													<option value="across_groups">Across Groups</option>
													</select>  </div>
													
                                            </div><!-- End .form-group  -->
                                                 
										<div class="form-group">
                                                <label class="col-lg-2 control-label" >Language:</label>
                                                <div class="col-lg-2">
															<select style="width:120px;" name="language" id="language">
																		<?php foreach ($languages as $language){ ?>
																			<option value="<?php echo $language->id ?>"><?php echo $language->language ?></option>
																	    <?php } ?>
												            </select>
												</div>
										
										</div><!-- End .form-group  -->
										<div class="form-group" style="display:none">
                                                <label class="col-lg-2 control-label" >Files From DB:</label>
                                                <div class="col-lg-2">
															<select style="width:400px;height:150px;" multiple="multiple" id="files" name="files[]">
						<?php foreach ($usrfiles as $usrfile){ ?>
                          <option value="<?php echo $usrfile->id ?>"><?php echo $usrfile->fname ?></option>
                        <?php } ?>
                        </select>
						<label id="filErr" class="myErrLbl"></label>
												</div>
										
										</div><!-- End .form-group  -->
										
										
										
										
										</div>
										
										
										
										
										
										
										
										
										
										
                                        <div class="step" id="profile-details">
                                            <span class="step-info" data-num="2" data-text="Code Groups"></span>
                                            	<div class="panel panel-default">
                                
                               
                                    
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="leftBox">
                                                   
                                                    
                                                    <select id="box1View" multiple="multiple" class="multiple nostyle" style="height:300px; width:500px;">
                                                     	<?php foreach ($usrfiles as $usrfile){ ?>
														<option value="<?php echo $usrfile->id ?>" selected="false"><?php echo $usrfile->fname ?></option>
														<?php } ?>
                        
                     
                                                       
                                                    </select>
                                                    <br/>
													<label id="filErr" class="myErrLbl"></label>
                                                    <span id="box1Counter" class="count"></span>
                                                    <div class="dn"><select id="box1Storage" name="box1Storage" class="nostyle"></select></div>
                                                </div>
                                                    
                                                <div class="dualBtn">
                                                    
                                                    <button id="to2" type="button" class="btn marginT2" ><span class="icon12 minia-icon-arrow-right-3"></span></button>
                                                    <button id="allTo2" type="button" class="btn marginT2" ><span class="icon12 iconic-icon-last"></span></button>
                                                    <button id="to1" type="button" class="btn marginT5"><span class="icon12 minia-icon-arrow-left-3"></span></button>
                                                    <button id="allTo1" type="button"class="btn marginT5" ><span class="icon12 iconic-icon-first"></span></button>
													<button  type="button" class="btn btn-success btn marginT5" onclick="createGroup();">Create Group</button>
                                                    <button  type="button" class="btn btn-danger btn marginT5">Delete Group</button>
                                                </div>
												
												
													<div class="col-lg-5 pull-right">
                            
														<div class="page-header" id="code-header" style="display:none">
														<h4>Code Groups</h4>
													</div>

															<div class="panel-group accordion" id="accordion1">
                            
                          
                          
														</div>
                           
														</div><!-- End .span6 -->
												
                                                
													</div>
													
						
											


													</div><!-- End .form-group  -->


 
                                            </div>
											</div><!-- End .panel -->
												
				
                                        <div class="step" id="contact-details">
                                            <span class="step-info" data-num="3" data-text="Suppressed Tokens"></span>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="email">Your email:</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="email1" name="email1" type="text" />
                                                </div>
                                            </div><!-- End .form-group  -->
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="phone">Your phone:</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="phone1" name="phone1" type="text" />
                                                </div>
                                            </div><!-- End .form-group  -->
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="address">Your address:</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" id="address" rows="3"></textarea>
                                                </div>
                                            </div><!-- End .form-group  -->
                                        </div>
                                        <div class="step submit_step" id="other-details">
                                            <span class="step-info" data-num="4" data-text="Equal Tokens"></span>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="hobies">Hobbies:</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" id="hobies" name="hobies" type="text" />
                                                </div>
                                            </div><!-- End .form-group  -->
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="hobies">About you:</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" id="aboutyou" rows="3"></textarea>
                                                </div>
                                            </div><!-- End .form-group  -->
                                            
                                        </div>
                                        
                                    </form>
                                </div>
                            </div><!-- End .panel -->

                        </div><!-- End .span12 -->

                    </div><!-- End .row -->


					
					
					
				


      </div>
</div>