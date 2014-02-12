<?php include("include_newcss.php"); ?>

<script>
//function SelectMoveRows(SS1,SS2)
function selectAllOptions() {
	obj = document.getElementById("suppresed2");
	for (i=obj.options.length - 1; i>=0; i--)
    {
		obj.options[i].selected = true;
	}
}

function SelectMoveRows(a)
{
	if(a==0){
		SS1 = document.getElementById("suppresed");
		SS2 = document.getElementById("suppresed2");
	}
	if(a==1){
		SS2 = document.getElementById("suppresed");
		SS1 = document.getElementById("suppresed2");
	}
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
}
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
</script>

<div id="wrapper">

        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Suppressed Tokens</h3>                                                                               
                </div><!-- End .heading-->
                
			<form name="form_sup" method="post" accept-charset="utf-8" action="<?php echo base_url();?>index.php/invoke/invoke_sup" >
            <table id="suppressed_tbl">
            	<tr>
                	<td><select multiple="multiple" id="suppresed" name="suppresed[]">
						<?php foreach ($tokens as $token){ ?>
                          <option value="<?php echo $token->token_id ?>"><?php echo $token->token_id." - ".$token->token_name ?></option>
                        <?php } ?>
                        </select></td>
                	<td><input type="button" value=">" onclick="SelectMoveRows(0)" /><br/>
                    <input type="button" value="<" onclick="SelectMoveRows(1)" /></td>
                	<td><select multiple="multiple" id="suppresed2" name="suppresed2[]">
                        </select></td>
                </tr>
                <tr>
                	<td><input type="submit" onclick="selectAllOptions();" value="Next"/></td>
                	<td></td>
                	<td></td>                                        
                </tr>
            </table>
            </form>
                
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
    
    <script>SelectSort(document.getElementById("suppresed"));
    </script>