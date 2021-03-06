var globalK = 0;
var tempAH = new Array();
var tempAHFP = new Array();
var tempAHFN = new Array();
function loadTreeMap(data) {
    $('#treemap').jqxTreeMap({
        width: 'auto',
        height: 800,
        source: data,
        baseColor: '#C8D0D2',
        colorMode: 'parent',
        selectionEnabled: true,
        /*colorRanges: [{
         color: "#C3BCBC",
         min: 0,
         max: 25
         }, {
         color: "#A9A6B3",
         min: 25,
         max: 50
         }, {
         color: "#9692A1",
         min: 50,
         max: 100
         }, {
         color: "#7B7784",
         min: 100,
         max: 10000
         }],
         */
        renderCallbacks: {
            '*': function(element, value) {
                if (value.data) {
                    
                    element.jqxTooltip({
                        content: '<div><div class="btn-primary "  style="font-weight: text-align: right; bold; width: auto; font-family: verdana; font-size: 13px;"><span align: left;>' + value.data.title +
                                '</span></div><div class="btn-default  " style="width: auto; font-family: verdana; font-size: 12px;">' + value.data.description + '</div></div>',
                        position: 'mouse',
                        autoHideDelay: 6000
                    });
                } else if (value.data === undefined) {
                    element.css({
                        backgroundColor: '#fff',
                        border: '1px solid #555'
                    });
                }
            }
        }
    });
}

function renderTreeMap() {

    var treeData = generateTreeMap();
    loadTreeMap(treeData);
    return treeData;
}
function getTreeMapData() {

    return generateTreeMap();
 
}

function splitFIDs(fids)
{
    var fidArr = new Array();
    if (typeof fids !== 'undefined')
    {
        fidArr = fids.split(",");
    }
    return fidArr;
}

function generateNewTreeMap(tmData, fidArr, tmCount)
{
    if (tmData)
    {
        //colors for multiple clicks
        var tmClr = '#FFFF00';
        if (tmCount == 1)
            tmClr = '#FFFF00';//yellow
        else if (tmCount == 2)
            tmClr = '#FF4500';//orange
        else if (tmCount == 3)
            tmClr = '#7FFF00';//green
        else if (tmCount == 4)
            tmClr = '#00FFFF';//cyan
        else if (tmCount == 5)
            tmClr = '#FFFF00';
        else if (tmCount == 6)
            tmClr = '#FF0000';
        else if (tmCount == 7)
            tmClr = '#FFFF00';
        else if (tmCount == 8)
            tmClr = '#FF0000';

        // var k =0;      
        for (var key in tmData) {
            if (typeof tmData[key] === "object") {
                if (fidArr.indexOf(tmData[key].fid) >= 0)
                {
                    tmData[key].color = tmClr;
                    tempAH[globalK] = tmData[key].fid;
                    tempAHFP[globalK] = tmData[key].filepath;
                    tempAHFN[globalK] = tmData[key].filename;
                    globalK = globalK + 1;
                }
            }
        }
        loadTreeMap(tmData);
    }
    return tmData;
}

function selectCurrentFileTreeMap(tmData, fidArr, tmCount)
{
    if (tmData)
    {
        treeMapDivs = document.getElementById('treemap').getElementsByTagName("div");
        for (var i = 0; i < treeMapDivs.length; i++)
        {
            treeMapSpans = treeMapDivs[i].getElementsByTagName("span");
            if (fidArr.indexOf(treeMapSpans[1].innerHTML) >= 0)
            {
                treeMapDivs[i].className = 'jqx-treemap-rectangle-hover';
            }
            else
            {
                treeMapDivs[i].className = 'jqx-treemap-rectangle';
            }
        }

        //loadTreeMap(tmData);
    }
    return tmData;
}

function resetTreeMap()
{
    tmData = renderTreeMap();
    tmCount = 1;
}

    