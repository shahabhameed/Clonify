function selectAllOptionsToks(ctrl) {
	obj = document.getElementById(ctrl);
	for (i=obj.options.length - 1; i>=0; i--)
    {
		obj.options[i].selected = true;
	}
}

function SelectMoveRowsSup(a)
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

function SelectMoveRowsEq(a)
{
	if(a==0){
		SS1 = document.getElementById("equal");
		SS2 = document.getElementById("equal2");
	}
	if(a==1){
		SS2 = document.getElementById("equal");
		SS1 = document.getElementById("equal2");
	}
	SS3 = document.getElementById("hiddenEq");
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
			
			//var newRow = new Option(SelText,SelID);
            //SS3.options[SS3.length]=newRow;
        }
    }
	var newRow = new Option(newVal,newVal);
    SS2.options[SS2.length]=newRow;
    //SelectSort(SS2);
}

function SelectMoveRowsBackEq(a)
{
	if(a==0){
		SS1 = document.getElementById("equal");
		SS2 = document.getElementById("equal2");
	}
	if(a==1){
		SS2 = document.getElementById("equal");
		SS1 = document.getElementById("equal2");
	}
	SS3 = document.getElementById("hiddenEq");
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
			//split at = and find in hidden list3
			var splitToks = SelID.split("=");
			//alert(SelID + " - " + SelText + " - " + splitToks.length);
			for(l=0;l<splitToks.length;l++)
			{
				j = splitToks[l];
				for (k=SS3.options.length - 1; k>=0; k--)
				{
					//alert(SS3.options[k].value + " - " + j)
					if (SS3.options[k].value == j){
						SelID2=SS3.options[k].value;
						SelText2=SS3.options[k].text;
						//SS3.options[k]=null;
						
						var newRow = new Option(SelText2,SelID2);
						SS2.options[SS2.length]=newRow;
					}
				}
			}
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

function createNewElement(newElement,baseElement){
	var groups=document.getElementById("accordion" + newElement);
    var childCount = groups.getElementsByClassName("panel panel-default").length;
	var id="collapse"+(childCount+1);
	var href="#"+id;
	
	var newGroup=document.createElement('div');newGroup.setAttribute('class','panel panel-default');	
	var newPanel=document.createElement('div'); newPanel.setAttribute('class','panel-heading'); 
	var newHeading=document.createElement('h4');newHeading.setAttribute('class','panel-title');
	var groupName=document.createElement('a'); groupName.setAttribute('class','accordion-toggle'); groupName.setAttribute('data-toggle','collapse');groupName.setAttribute('data-parent','#accordion'+newElement);
	groupName.setAttribute('href',href);
	groupName.innerHTML=newElement+" "+(childCount+1);
	
	
	var collapse=document.createElement('div'); collapse.setAttribute('class','panel-collapse collapse'); collapse.setAttribute('id',id);
	
	var list=document.createElement('select'); list.setAttribute('id',newElement+(childCount+1)); list.setAttribute('multiple','multiple'); list.setAttribute('class','multiple nostyle pull-right');
	list.setAttribute('style','height:150px; width:450px;')
	var rightBox=document.getElementById("box2View");
	var leftBox=document.getElementById(baseElement);

	if(leftBox.length>0)
	{
	
			//for(i=0;i<leftBox.length;i++)
			for (i=leftBox.options.length - 1; i>=0; i--)
			{
				if(leftBox.options[i].selected==true){
					SelID=leftBox.options[i].value;
					SelText=leftBox.options[i].text;
					var newRow = new Option(SelText,SelID);
					list.options[list.length]=newRow;
					leftBox.options[i]=null;
					//addOption(list,leftBox.options[i].innerHTML,leftBox.options[i].value);
					//leftBox.options[i] = null;
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
