function loadTreeMap(data) {
    $('#treemap').jqxTreeMap({
        width: 'auto',
        height: 800,
        source: data,
        baseColor: '#C8D0D2',
        colorMode: 'parent',
        selectionEnabled: true ,
        colorRanges: [{
                color: "#F72828",
                min: 0,
                max: 1000
            }, {
                color: "#28E4F7",
                min: 1000,
                max: 4000
            }, {
                color: "#28B33A",
                min: 2000,
                max: 10000
            }],
        
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

function splitFIDs(fids)
{
    //fids = "110,30,58,138,75,155,84,4";//hard coded fids for testing - when secondary table not loading
    var fidArr = new Array();
    if (typeof fids != 'undefined')
    {
        fidArr = fids.split(',');
    }
    return fidArr;
}

function generateNewTreeMap(tmData, fidArr, tmCount)
{
    if (tmData)
    {
        //colors for multiple clicks
        var tmClr = '#FFFF00';
        if(tmCount == 1)
            tmClr = '#FFFF00';//yellow
        else if(tmCount == 2)
            tmClr = '#FF4500';//orange
        else if(tmCount == 3)
            tmClr = '#7FFF00';//green
        else if(tmCount == 4)
            tmClr = '#00FFFF';//cyan
        else if(tmCount == 5)
            tmClr = '#FFFF00';
        else if(tmCount == 6)
            tmClr = '#FF0000';
        else if(tmCount == 7)
            tmClr = '#FFFF00';
        else if(tmCount == 8)
            tmClr = '#FF0000';
          
         var k =0;      
        for (var key in tmData) {
            if (typeof tmData[key] === "object") {
                if (fidArr.indexOf(tmData[key].label) >= 0)
                {
                    tmData[key].color = tmClr;
                    tempAH[k] = tmData[key].label;
                    k=k+1;
                }
            }
        }
        loadTreeMap(tmData);
    }
    return tmData;
}

    