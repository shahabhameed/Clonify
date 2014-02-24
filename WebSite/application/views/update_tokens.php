<?php include("include_newcss.php"); ?>
<script>

var val = '';

function HandleFileButtonClick(a)
{
	if(a)
	{
		document.frmUpload.userfile.click();
		val = document.frmUpload.userfile.value;
		val = val.split(/(\\|\/)/g).pop();
		//document.frmUpload.txtFakeText.value = val;
		//alert(val);
		document.getElementById('txtFakeText').innerHTML = val;
	}
	else
	{
		//alert(val);
		val = document.frmUpload.userfile.value;
		val = val.split(/(\\|\/)/g).pop();
		document.getElementById('txtFakeText').innerHTML = val;
	}
}

function myValidate(){

	var isValidated = true;

	var fup = document.getElementById('userfile');
	var fileName = fup.value;
	
	alert(fileName);
	
	if(fileName.length < 1){
		isValidated = false;
		alert(isValidated);
		document.getElementById("minTokErr").innerHTML = "Please select a file.";
	}
	else{
			alert(true);
		document.getElementById("minTokErr").innerHTML = "";
	}
	
	return isValidated;
}
</script>
<div id="wrapper">

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->
                <div class="heading">
                    <h3>Update Tokens</h3>                                                                               
                </div><!-- End .heading-->
				
			<form name="frmUpload" enctype="multipart/form-data" accept-charset="utf-8" method="post" onsubmit="return myValidate();" action="<?php echo base_url();?>updatetokens/update">
				
					<table width="100%">
						<tr>
						<td style="vertical-align: top;">
						<table id="multi_select_tbl">
							<tr>
								<td width="130px;">
									<label>File</label>
								</td>
								<td>
                                	<!-- Real Input field, but hidden
                                    <input type="file" name="myFile" style="display:none;">
	                                -->
                                    <!-- Fake field to fool the user 
                                    <input type="text" name="txtFakeText" readonly="true">
                                    <br/>
                                    -->
                                
                                    <!-- Button to invoke the click of the File Input -->
                                    <div style="float:left;">
                                    <input type="button" onclick="HandleFileButtonClick(1);" value="Browse" class="btn">
                                    </div>
                                    <div style="float:left; margin-left:5px; margin-top:6px;">
                                    <label for="txtFakeText" id="txtFakeText"></label>
                                    </div>
                                </td>
                                <td>
 									<div>
										<input type="file" name="userfile" onchange="HandleFileButtonClick(0);" style="display:none" size="20"></input>
									</div>
									<label style="display:inline-block" class="myErrLbl" id="userfileErr"></label>
								</td>
							</tr>
							<tr>
								<td width="130px;">
									<label>Language</label>
								</td>
								<td>
									<select style="width:120px;" name="language" id="language">
									<?php foreach ($languages as $language){ ?>
									  <option value="<?php echo $language->id ?>"><?php echo $language->language ?></option>
									<?php } ?>
									</select>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td>
								</td>
								<td width="130px;">
									<input class="btn" type="submit" value="Upload"/>
								</td>
							</tr>
						</table>
						</td>
						<td>
							<table>
								<tr>
									<td style="float: right;">
										<div style="height: 400px; overflow: auto;">
											<?php if(isset($tokenUpdated)){
													if(strcmp($tokenUpdated, "true") == 0){ ?>
														<table class="responsive table table-bordered">
															<thead>
																<th>Token ID</th>
																<th>Token Label</th>
															</thead>
															<tbody>
																<?php foreach ($tokens as $token){ ?>
																<tr>
																	<td><?php echo $token->token_id; ?></td>
																	<td><?php echo $token->token_name; ?></td>
																</tr>
																<?php } ?>
															</tbody>
														</table>
											<?php 	}
												} ?>
										</div>
									</td>
								</tr>
							</table>
						</td>
						</tr>
					</table>
				</form>
            </div>
            <!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
	
<script>
</script>
<script>
	function onBodyLoad(){
	    var sel = document.getElementById('language');
		for(var i, j = 0; i = sel.options[j]; j++) {
			if(i.value == <?php echo $selectedLanguage; ?>) {
				sel.selectedIndex = j;
				break;
			}
		}		
	}
	
	onBodyLoad();
</script>