function loadTreeMap(data) {
    $('#treemap').jqxTreeMap({
            width: 'auto',
            height: 800,
            source: data,
            baseColor: '#E7F2FF',
            colorMode:'parent',
            colorRanges :[{
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
    
    