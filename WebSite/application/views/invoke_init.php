<?php include("include_newcss.php"); ?>
<script>
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

<div id="wrapper">

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Initial Invocation Parameters</h3>                                                                               
                </div><!-- End .heading-->
                
			<form method="post" accept-charset="utf-8" id="myForm" onsubmit="return myValidate();" action="<?php echo base_url();?>index.php/invoke/invoke_init" >
			<table id="multi_select_tbl">
            	<tr>
                	<td width="130px;"><label>Min Similarities for Simple Clone Class</label></td>
                    <td><input type="text" name="sccMinSim" id="sccMinSim"/><label style="display:inline-block" class="myErrLbl" id="minTokErr"></label></td>
                    <td></td>
            	</tr>
<!--                <tr>
                	<td><label>Method Analysis</label></td>
                    <td><input type="checkbox" name="methodAnalysis" id="methodAnalysis"/></td>
            	</tr> -->
                <tr>
                	<td><label>Grouping Choice</label></td>
                    <td><select style="width:120px;" name="groupingChoice" id="groupingChoice">
                      <option value="mixed">Mixed Mode</option>
                      <option value="across_groups">Across Groups</option>
	                  </select><br/></td>
                    <td></td>
            	</tr>
                <tr>
                	<td><label>Language</label></td>
                    <td><select style="width:120px;" name="language" id="language">
						<?php foreach ($languages as $language){ ?>
                          <option value="<?php echo $language->id ?>"><?php echo $language->language ?></option>
                        <?php } ?>
                        </select></td>
                     <td></td>
            	</tr>
                <tr>
                	<td><label>Files from DB</label></td>
                    <td><select style="width:400px;height:150px;" multiple="multiple" id="files" name="files[]">
						<?php foreach ($usrfiles as $usrfile){ ?>
                          <option value="<?php echo $usrfile->id ?>"><?php echo $usrfile->fname ?></option>
                        <?php } ?>
                        </select></td>
                     <td><label id="filErr" class="myErrLbl"></label></td>
            	</tr>
                <tr>
                	<td><input type="submit" value="Next"/></td>
                    <td></td>
                    <td></td>
            	</tr>
            </table>
            </form>
            </div>
            <!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->