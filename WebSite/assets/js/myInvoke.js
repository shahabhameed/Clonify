function selectAllOptionsToks(ctrl) {
    obj = document.getElementById(ctrl);
    for (i = obj.options.length - 1; i >= 0; i--)
    {
        obj.options[i].selected = true;
    }
    return;
}

function SelectMoveRowsSup(a)
{
    if (a == 0) {
        SS1 = document.getElementById("suppresed");
        SS2 = document.getElementById("suppresed2");
    }
    if (a == 1) {
        SS2 = document.getElementById("suppresed");
        SS1 = document.getElementById("suppresed2");
    }
    var SelID = '';
    var SelText = '';
    // Move rows from SS1 to SS2 from bottom to top
    for (i = SS1.options.length - 1; i >= 0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID = SS1.options[i].value;
            SelText = SS1.options[i].text;
            var newRow = new Option(SelText, SelID);
            SS2.options[SS2.length] = newRow;
            SS1.options[i] = null;
        }
    }
    SelectSort(SS2);
}

function SelectMoveRowsEq(a)
{
    if (a == 0) {
        SS1 = document.getElementById("equal");
        SS2 = document.getElementById("equal2");
    }
    if (a == 1) {
        SS2 = document.getElementById("equal");
        SS1 = document.getElementById("equal2");
    }
    SS3 = document.getElementById("hiddenEq");
    var SelID = '';
    var SelText = '';
    // Move rows from SS1 to SS2 from bottom to top
    var first = true;
    var newVal = '';
    for (i = SS1.options.length - 1; i >= 0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID = SS1.options[i].value;
            SelText = SS1.options[i].text;
            SS1.options[i] = null;
            if (first) {
                newVal = SelID;
                first = false;
            }
            else {
                newVal = newVal + '=' + SelID;
            }

            //var newRow = new Option(SelText,SelID);
            //SS3.options[SS3.length]=newRow;
        }
    }
    var newRow = new Option(newVal, newVal);
    SS2.options[SS2.length] = newRow;
    //SelectSort(SS2);
}
/*
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
 */

/////////////////////////////////// FROM TEST.PHP ///////////////////////////////////////////////////////////////////////////

function SelectSort(listId)
{
    SelList = document.getElementById(listId);
    var ID = '';
    var Text = '';
    for (x = 0; x < SelList.length - 1; x++)
    {
        for (y = x + 1; y < SelList.length; y++)
        {
            if (SelList[x].text > SelList[y].text)
            {
                // Swap rows
                ID = SelList[x].value;
                Text = SelList[x].text;
                SelList[x].value = SelList[y].value;
                SelList[x].text = SelList[y].text;
                SelList[y].value = ID;
                SelList[y].text = Text;
            }
        }
    }
}

function prependElement(parentID, child)
{
    parent = document.getElementById(parentID);
    parent.insertBefore(child, parent.childNodes[0]);
}

function moveOptions(fromID, toID)
{
    SS1 = document.getElementById(fromID);
    SS2 = document.getElementById(toID);
    var SelID = '';
    var SelText = '';

    // Move rows from SS1 to SS2 from bottom to top
    for (i = SS1.options.length - 1; i >= 0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID = SS1.options[i].value;
            SelText = SS1.options[i].text;
            var newRow = new Option(SelText, SelID);
            SS2.options[SS2.length] = newRow;
            SS1.options[i] = null;
        }
    }
    SelectSort(toID);
    SelectSort(fromID);
}

function updateHiddenOnDelete(hiddenListId, deletedListId)
{
    var hiddenBox = document.getElementById(hiddenListId);
    for (i = hiddenBox.options.length - 1; i >= 0; i--)
    {
        if (hiddenBox.options[i].value == deletedListId) {
            hiddenBox.options[i] = null;
            return;
        }
    }
}

function checkAndDelete(fromID, parentId, childID, hiddenListId, deletedListId)
{
    SS1 = document.getElementById(fromID);
    if (SS1.options.length == 0)
    {
        deleteGroup(parentId, childID, hiddenListId, deletedListId);
    }
}

function deleteGroup(parentId, childID, hiddenListId, deletedListId)
{
    if (document.getElementById(childID)) {
        var child = document.getElementById(childID);
        var parent = document.getElementById(parentId);
        parent.removeChild(child);
        updateHiddenOnDelete(hiddenListId, deletedListId);
        decrementGroupCount();
    }
}
function decrementGroupCount()
{
    var groupCount=document.getElementById('groupCount');
    var  count=parseInt(groupCount.value)-1;
    groupCount.value=count
}
function addControl(parentID, type, value, id, childClass, onClick) {

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

function addOption(selectbox, text, value)
{
    var optn = document.createElement("OPTION");
    optn.text = text;
    optn.value = value;
    selectbox.options.add(optn);
}

var totalChildren = 0;


function createNewElement(newElement, baseElement) {

    var rootDiv = ("accordion" + newElement);
    var groups = document.getElementById("accordion" + newElement);
    var childCount = groups.getElementsByClassName("panel panel-default").length;
    if (childCount == 0) {
        totalChildren = 0;
    }
    childCount = totalChildren;
    var id = "collapse" + (childCount + 1);
    var href = "#" + id;

    //IDS: Group Panel : group#
    //     Collapse Panel : collapse#
    //     Group List : groupList#
    //     Group Buttons Panel : groupButton#

    var newGroup = document.createElement('div');
    newGroup.setAttribute('class', 'panel panel-default');
    newGroup.setAttribute('id', newElement + (childCount + 1));
    newGroup.setAttribute('name', newElement + (childCount + 1) + '[]');
    var newPanel = document.createElement('div');
    newPanel.setAttribute('class', 'panel-heading');
    var newHeading = document.createElement('h4');//newHeading.setAttribute('class','panel-title');
    var newSpan = document.createElement('span');
    newSpan.innerHTML = newElement + " " + (childCount + 1);


    var groupName = document.createElement('a');
    groupName.setAttribute('class', 'minimize');
    groupName.setAttribute('href', '#');
    //groupName.setAttribute('data-toggle','collapse');groupName.setAttribute('data-parent','#accordion'+newElement);
    groupName.innerHTML = "Minimize";
    //newElement+" "+(childCount+1);

    var collapse = document.createElement('div');
    collapse.setAttribute('class', 'panel-collapse collapse in');
    collapse.setAttribute('id', id);

    var list = document.createElement('select');
    list.setAttribute('name', newElement + 'List' + (childCount + 1) + '[]');
    list.setAttribute('id', newElement + 'List' + (childCount + 1));
    list.setAttribute('multiple', 'multiple');
    list.setAttribute('class', 'multiple form-control col-lg-12');
    list.setAttribute('style', 'height:150px;')



    var leftBox = document.getElementById(baseElement);
    var isSelected = false;
    var numSelected = 0;

    if (leftBox.length != 0)
    {

        for (i = leftBox.options.length - 1; i >= 0; i--)
        {
            if (leftBox.options[i].selected == true) {
                isSelected = true;
                numSelected = numSelected + 1;
            }
        }

        if ((baseElement != 'equal' && isSelected) || (baseElement == 'equal' && numSelected >= 2))
        {

            for (i = leftBox.options.length - 1; i >= 0; i--)
            {
                if (leftBox.options[i].selected == true) {
                    SelID = leftBox.options[i].value;
                    SelText = leftBox.options[i].text;
                    var newRow = new Option(SelText, SelID);
                    list.options[list.length] = newRow;
                    leftBox.options[i] = null;
                }
            }

            var content = document.createElement('div');
            content.setAttribute('class', 'panel-body');

            var buttons = document.createElement('div');
            buttons.setAttribute('class', 'panel-body');
            buttons.setAttribute('id', newElement + 'Button' + (childCount + 1))

            //Creating Button Control
            var add = document.createElement('input');
            var remove = document.createElement('input');
            var del = document.createElement('input');

            //Setting Button Attributes
            setAttributes(add, 'button', 'Add', 'add' + childCount + 1, 'btn btn-primary pull-left col-lg-2 	', 'moveOptions(\'' + baseElement + '\',\'' + newElement + 'List' + (childCount + 1) + '\')');
            setAttributes(remove, 'button', 'Remove', 'remove' + childCount + 1, 'btn btn-warning col-lg-2 col-lg-offset-1', 'moveOptions(\'' + newElement + 'List' + (childCount + 1) + '\',\'' + baseElement + '\');	checkAndDelete(\'' + newElement + 'List' + (childCount + 1) + '\',\'' + rootDiv + '\',\'' + newElement + (childCount + 1) + '\',\'hidden' + newElement + '\',\'' + newElement + 'List' + (childCount + 1) + '\');');
            setAttributes(del, 'button', 'Delete', 'delete' + childCount + 1, 'btn btn-danger col-lg-2 col-lg-offset-1', 'selectAllOptions(\'' + newElement + 'List' + (childCount + 1) + '\');moveOptions(\'' + newElement + 'List' + (childCount + 1) + '\',\'' + baseElement + '\');deleteGroup(\'' + rootDiv + '\',\'' + newElement + (childCount + 1) + '\',\'hidden' + newElement + '\',\'' + newElement + 'List' + (childCount + 1) + '\');');

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



            //	groups.appendChild(newGroup);  -->
            // Add groups in reverse order
            prependElement(rootDiv, newGroup);
            totalChildren = totalChildren + 1;
            var hiddenId = "hidden" + newElement;

            var hiddenBox = document.getElementById(hiddenId);
            var newHiddenRow = new Option(list.id, list.id)
            //alert(hiddenId + " - " + hiddenBox.length);
            hiddenBox.options[hiddenBox.length] = newHiddenRow;
            incrementGroupCount();
        }

    }

}

function incrementGroupCount()
{
    var groupCount=document.getElementById('groupCount');
    var  count=parseInt(groupCount.value)+1;
    groupCount.value=count
}

function selectAllOptions(elementID) {
    obj = document.getElementById(elementID);
    for (j = obj.options.length - 1; j >= 0; j--)
    {
        obj.options[j].selected = true;
    }
}

function test123(val)
{
    alert(val);
}

function selectAllSubLists(parentId)
{
    var hiddenBox = document.getElementById(parentId);
    for (i = hiddenBox.options.length - 1; i >= 0; i--)
    {
        val = hiddenBox.options[i].value;
        selectAllOptions(val);
    }
}

function setAttributes(element, type, value, id, childClass, onClick) {


    //Assign different attributes to the element.
    element.setAttribute('type', type);
    element.setAttribute('value', value);
    element.setAttribute('id', id);
    element.setAttribute('class', childClass);
    element.setAttribute('onClick', onClick);



}

function SelectOnSubmit() {
    selectAllOptions("suppresed2");
    selectAllOptions("hiddenGroup");
    selectAllOptions("hiddenRule");
    selectAllSubLists("hiddenGroup");
    selectAllSubLists("hiddenRule");
//	document.wizard.submit();
}

function myValidate() {
    var minTok = document.getElementById("sccMinSim");
    var minTokErr = document.getElementById("minTokErr");
    var fil = document.getElementById("files");
    minTokErr.innerHTML = '';
    filErr.innerHTML = '';
    //alert(fil.value);
    var isValidated = true;
    if (minTok.value == '') {
        minTokErr.innerHTML = 'This field cannot be empty.';
        isValidated = false;
    }
    else if (isNaN(minTok.value)) {
        minTokErr.innerHTML = 'Please enter a valid numeric value.';
        isValidated = false;
    }
    else {
        minTokErr.innerHTML = '';
    }

    if (fil.value == '') {
        filErr.innerHTML = 'Please select a file to continue.';
        isValidated = false;
    }
    else {
        filErr.innerHTML = '';
    }

    return isValidated;
}

    function onLanguageSelect() {
        document.getElementById("submit").disabled = true;
        var lang_list = document.getElementById("language");

        var sel_id = lang_list.selectedIndex;

        var lang_id = lang_list.options[sel_id].value;
        var lang_txt = lang_list.options[sel_id].text;
        //alert("lang_id: " + lang_id + lang_txt);

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/invoke/setSelectedLanguage/" + lang_id,
            success: function(result) {
                //alert("result: " + result);
                location.reload();
            },
            error: function(xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    }

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
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
