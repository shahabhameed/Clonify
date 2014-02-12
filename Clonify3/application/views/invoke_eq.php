<?php include("include_newcss.php"); ?>

<script>
function selectAllOptions() {
	obj = document.getElementById("equal2");
	for (i=obj.options.length - 1; i>=0; i--)
    {
		obj.options[i].selected = true;
	}
}

function SelectMoveRows(a)
{
	if(a==0){
		SS1 = document.getElementById("equal");
		SS2 = document.getElementById("equal2");
	}
	if(a==1){
		SS2 = document.getElementById("equal");
		SS1 = document.getElementById("equal2");
	}
    var SelID='';
    var SelText='';
    // Move rows from SS1 to SS2 from bottom to top
	var first = true;
	var newVal = '';
    for (i=SS1.options.length - 1; i>=0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID=SS1.options[i].value;
            SelText=SS1.options[i].text;
            SS1.options[i]=null;
			if(first){
				newVal = SelID;
				first = false;
			}
			else{
				newVal = newVal + '=' + SelID;
			}
        }
    }
	var newRow = new Option(newVal,newVal);
    SS2.options[SS2.length]=newRow;
    //SelectSort(SS2);
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

                    <h3>Equal Tokens</h3>                                                                               
                </div><!-- End .heading-->
                
                

                
			<form method="post" accept-charset="utf-8" action="<?php echo base_url();?>index.php/invoke/invoke_eq" >
            <table id="suppressed_tbl">
            	<tr>
                	<td><select multiple="multiple" id="equal" name="equal[]">
						<?php foreach ($tokens as $token){ ?>
                          <option value="<?php echo $token->token_id ?>"><?php echo $token->token_id." = ".$token->token_name ?></option>
                        <?php } ?>
                        </select></td>
                	<td><input type="button" value=">" onclick="SelectMoveRows(0)" /><!-- <br/>
                    <input type="button" value="<" onclick="SelectMoveRows(1)" /> --></td>
                	<td><select multiple="multiple" id="equal2" id="equal2" name="equal2[]">
                        </select></td>
                </tr>
                <tr>
                	<td><input type="submit" onclick="selectAllOptions()" value="Invoke"/></td>
                	<td></td>
                	<td></td>                                        
                </tr>
            </table>
            </form>

                
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
    
<script>SelectSort(document.getElementById("equal"));</script>