<?php
?>
<script type="text/javascript" src="<?=asset_url('js/myInvoke.js')?>"></script>
<script>

function SelectSort(SelList)
{
    var ID='';
    var Text='';
    for (x=0; x < SelList.length - 1; x++)
    {
        for (y=x + 1; y < SelList.length; y++)
        {
            if (SelList[x].text > SelList[y].text)
            {
                // Swap rows
                ID=SelList[x].value;
                Text=SelList[x].text;
                SelList[x].value=SelList[y].value;
                SelList[x].text=SelList[y].text;
                SelList[y].value=ID;
                SelList[y].text=Text;
            }
        }
    }
}

function prependElement(parentID,child)
    {
        parent=document.getElementById(parentID);
        parent.insertBefore(child,parent.childNodes[0]);
    }
	
function moveOptions(fromID,toID)
{
	SS1 = document.getElementById(fromID);
	SS2 = document.getElementById(toID);
    var SelID='';
    var SelText='';
	
    // Move rows from SS1 to SS2 from bottom to top
    for (i=SS1.options.length - 1; i>=0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID=SS1.options[i].value;
            SelText=SS1.options[i].text;
            var newRow = new Option(SelText,SelID);
            SS2.options[SS2.length]=newRow;
            SS1.options[i]=null;
        }
    }
	SelectSort(SS2);
	SelectSort(SS1);
}

function checkAndDelete(fromID,parentId,childID)
{
	SS1 = document.getElementById(fromID);
	if (SS1.options.length == 0)
        {
			deleteGroup(parentId,childID);	
		}
}

function deleteGroup(parentId,childID)
{
	if (document.getElementById(childID)) {     
          var child = document.getElementById(childID);
          var parent = document.getElementById(parentId);
          parent.removeChild(child);
     }

}
function addControl(parentID,type,value,id,childClass,onClick) {
 
    //Create an input type dynamically.
    var element = document.createElement("input");
 
    //Assign different attributes to the element.
    element.setAttribute("type", type);
    element.setAttribute("value", value);
    element.setAttribute("id", id);
    element.setAttribute("class", childClass);
	element.setAttribute("onClick", onClick);

    var parent = document.getElementById("parentID");
 
    //Append the element in page (in span).
    parent.appendChild(element);
 
}	
	
function addOption(selectbox,text,value )
{var optn = document.createElement("OPTION");
optn.text = text;
optn.value = value;
selectbox.options.add(optn);
}



function createNewElement(newElement,baseElement){

	var rootDiv=("accordion" + newElement); 
	var groups=document.getElementById("accordion" + newElement);
    var childCount = groups.getElementsByClassName("panel panel-default").length;
	var id="collapse"+(childCount+1);
	var href="#"+id;
	
	//IDS: Group Panel : group#
	//     Collapse Panel : collapse#
	//     Group List : groupList#
	//     Group Buttons Panel : groupButton#
	
	var newGroup=document.createElement('div');newGroup.setAttribute('class','panel panel-default');newGroup.setAttribute('id',newElement+(childCount+1));		
	var newPanel=document.createElement('div'); newPanel.setAttribute('class','panel-heading'); 
	var newHeading=document.createElement('h4');//newHeading.setAttribute('class','panel-title');
	var newSpan=document.createElement('span');newSpan.innerHTML=newElement+" "+(childCount+1);
	
	
	var groupName=document.createElement('a'); groupName.setAttribute('class','minimize'); 
	groupName.setAttribute('href','#');
	//groupName.setAttribute('data-toggle','collapse');groupName.setAttribute('data-parent','#accordion'+newElement);
	groupName.innerHTML="Minimize";
	//newElement+" "+(childCount+1);
	
	var collapse=document.createElement('div'); collapse.setAttribute('class','panel-collapse collapse in'); collapse.setAttribute('id',id);
	
	var list=document.createElement('select'); list.setAttribute('id',newElement+'List'+(childCount+1)); list.setAttribute('multiple','multiple'); list.setAttribute('class','multiple form-control col-lg-12');
	list.setAttribute('style','height:150px;')
	

	
	var leftBox=document.getElementById(baseElement);
	var isSelected=false;
	
	if(leftBox.length!=0 )
	{
	
			for (i=leftBox.options.length - 1; i>=0; i--)
			{
				if(leftBox.options[i].selected==true){
					isSelected=true;
					SelID=leftBox.options[i].value;
					SelText=leftBox.options[i].text;
					var newRow = new Option(SelText,SelID);
					list.options[list.length]=newRow;
					leftBox.options[i]=null;

			}
	}
	if(isSelected)
	{
	
	var content=document.createElement('div'); content.setAttribute('class','panel-body');  
	
	var buttons=document.createElement('div'); buttons.setAttribute('class','panel-body');   buttons.setAttribute('id',newElement+'Button'+(childCount+1))
	
	//Creating Button Control
	var add = document.createElement('input');
	var remove = document.createElement('input');
	var del = document.createElement('input');
	
	//Setting Button Attributes
	setAttributes(add,'button','Add','add'+childCount+1,'btn btn-primary pull-left col-lg-2 	','moveOptions(\''+baseElement+'\',\''+newElement+'List'+(childCount+1)+'\')');
	setAttributes(remove,'button','Remove','remove'+childCount+1,'btn btn-warning col-lg-2 col-lg-offset-1','moveOptions(\''+newElement+'List'+(childCount+1)+'\',\''+baseElement+'\');	checkAndDelete(\''+newElement+'List'+(childCount+1)+'\',\''+rootDiv+'\',\''+newElement+(childCount+1)+'\');');
	setAttributes(del,'button','Delete','delete'+childCount+1,'btn btn-danger col-lg-2 col-lg-offset-1' ,'selectAllOptions(\''+newElement+'List'+(childCount+1)+'\');moveOptions(\''+newElement+'List'+(childCount+1)+'\',\''+baseElement+'\');deleteGroup(\''+rootDiv+'\',\''+newElement+(childCount+1)+'\');');
	
	//Appending buttons to Buttons panel
	buttons.appendChild(add);
	buttons.appendChild(remove);
	buttons.appendChild(del);

	//Appending group to Accordion
	newHeading.appendChild(newSpan);
	newPanel.appendChild(newHeading);
	newPanel.appendChild(groupName);
	content.appendChild(list);
	content.appendChild(buttons);
	
	
	newGroup.appendChild(newPanel);
	newGroup.appendChild(content);
	//collapse.appendChild(buttons);
	//collapse.appendChild(content);
	
	
	
	<!--	groups.appendChild(newGroup);  -->
	// Add groups in reverse order
	 prependElement(rootDiv,newGroup);  
	 
	}
	
	}

}

function selectAllOptions(elementID) {
	obj = document.getElementById(elementID);
	for (i=obj.options.length - 1; i>=0; i--)
    {
		obj.options[i].selected = true;
	}
}

function setAttributes(element,type,value,id,childClass,onClick) {
 

    //Assign different attributes to the element.
    element.setAttribute('type', type);
	element.setAttribute('value', value);
	element.setAttribute('id', id);
	element.setAttribute('class', childClass);
	element.setAttribute('onClick', onClick);


 
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
          <h3>Configuration</h3>
          <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                </li>
                <li class="active">Configuration Settings</li>
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
                                            <button class="btn btn-default pull-left col-lg-1" type="reset"> Back </button>
                                            
											<button class="btn btn-primary pull-right col-lg-1" type="submit"> Submit </button>
											<button class="btn btn-success pull-right col-lg-1" > Next </button>
                                    </div><!-- End .form-group  -->
                                        
									<div class="msg"></div>
                                        
									<div class="wizard-steps clearfix"></div>

                                        <div class="step" id="invocation-details"><span class="step-info" data-num="1" data-text="Invocation Parameters"></span>
										
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="username">Min Similarities:</label>
                                                <div class="col-lg-8">
                                                   <input id="spinner1" class="form-control" name="spinner1" type="text" value="1" >

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
																		<?php foreach ($languages as $language){ ?>
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
																<?php foreach ($usrfiles as $usrfile){ ?>
																<option value="<?php echo $usrfile->id ?>" selected="false"><?php echo $usrfile->fname ?></option><?php } ?>

														</select>
														<br/>
														<label id="filErr" class="myErrLbl"></label>
														<!--<span id="box1Counter" class="count"></span>-->
														
														<div class="dn"><select id="box1Storage" name="box1Storage" class="nostyle "></select></div>
                                                
															</div>
														
														<div align="right" class="col-lg-12"> 
														<button  type="button" class="btn btn-success btn marginT6" onclick="createNewElement('Group','box1View');" >Create Group</button>
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
                              <div class="step" id="sup-tokens">
                                   <span class="step-info" data-num="3" data-text="Suppressed Tokens"></span>
                                               <div class="panel panel-default">
                                
                               
                                    
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="leftBox">
						                            <select multiple="multiple" id="suppresed" name="suppresed[]" class="multiple form-control" style="height:300px; width:500px;">>
                                                    <?php foreach ($tokens as $token){ ?>
                                                      <option value="<?php echo $token->token_id ?>"><?php echo $token->token_id." - ".$token->token_name ?></option>
                                                    <?php } ?>
                                                    </select>
                                                    <br/>
													<label id="filErr" class="myErrLbl"></label>
                                                   
                                                    <div class="dn"><select id="box1Storage" name="box1Storage" class="nostyle"></select></div>
                                                </div>
                                                    
                                                <div class="dualBtn">
                                                    <button id="to2" type="button" class="btn marginT2" onclick="moveOptions('suppresed','suppresed2')"><span class="icon12 minia-icon-arrow-right-3"></span></button><br/>
                                                    <button id="to1" type="button" class="btn marginT5" onclick="moveOptions('suppresed2','suppresed')"><span class="icon12 minia-icon-arrow-left-3"></span></button>
                                                </div>
												
												
												<div class="col-lg-5 pull-right">
                                                    <select multiple="multiple" id="suppresed2" name="suppresed2[]" class="multiple form-control" style="height:300px; width:500px;">>
													<?php foreach ($prev_sup_tokens as $prev_sup_token){ ?>
                                                      <option value="<?php echo $prev_sup_token->token_id ?>"><?php echo $prev_sup_token->token_id." - ".$prev_sup_token->token_name ?></option>
                                                    <?php } ?>
                                                    </select>													
												</div><!-- End .span6 -->
										</div>
									</div><!-- End .form-group  -->
                            </div>
										
									 </div>	
										
							<div class="step" id="equal-tokens">
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
													<?php foreach ($alltokens as $token){ ?>
													  <option value="<?php echo $token->token_id ?>"><?php echo $token->token_id." = ".$token->token_name ?></option>
													<?php } ?>
													</select>
                                                    <br/>
													<label id="filErr" class="myErrLbl"></label>
                                                    
                                                    <div class="dn"><select id="box1Storage" name="box1Storage" class="nostyle"></select></div>
                                                
															</div>
														
														<div align="right" class="col-lg-12"> 
														<button  type="button" class="btn btn-success btn marginT6" onclick="createNewElement('Rule','equal');">Add Rule</button></div>
														
                                                
														
                                                    
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
	SelectSort(document.getElementById("suppresed"));
</script>