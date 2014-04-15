var colors = ['red', 'green', 'blue', 'orange'];
var current_color = 0;
var globalK = 0;
var tempAH = new Array();
var tempAHFP = new Array();
var tempAHFN = new Array();
var setting = {
    data: {
        simpleData: {
            enable: true
        }
    },
    view: {
        fontCss: getFontCss
    },
    callback: {
        onClick: zTreeOnClick
    }
};
function zTreeOnClick(event, treeId, treeNode) {
    if(treeNode.path){
        var _url = base_url + "home/customloadcode";
        var _params = {
          file_path : treeNode.path,
          file_name : treeNode.name,
        };
        $('#filemodallabel').html(treeNode.name);
        $.post(_url, _params, function(r) {
            $('#file-modal-content').html(r);

            $('#file-modal').modal('show');
         });
     }
}
function focusKey(e) {
    if (key.hasClass("empty")) {
        key.removeClass("empty");
    }
}
function blurKey(e) {
    if (key.get(0).value === "") {
        key.addClass("empty");
    }
}
var lastValue = "", nodeList = [], fontCss = {};
function clickRadio(e) {
    lastValue = "";
    searchNode(e);
}
function searchNode(e) {
    var zTree = $.fn.zTree.getZTreeObj("treeDemo");
    if (!$("#getNodesByFilter").attr("checked")) {
        var value = $.trim(key.get(0).value);
        var keyType = "";
        if ($("#name").attr("checked")) {
            keyType = "name";
        } else if ($("#level").attr("checked")) {
            keyType = "level";
            value = parseInt(value);
        } else if ($("#id").attr("checked")) {
            keyType = "id";
            value = parseInt(value);
        }
        if (key.hasClass("empty")) {
            value = "";
        }
        if (lastValue === value)
            return;
        lastValue = value;
        if (value === "")
            return;
        updateNodes(false);

        if ($("#getNodeByParam").attr("checked")) {
            var node = zTree.getNodeByParam(keyType, value);
            if (node === null) {
                nodeList = [];
            } else {
                nodeList = [node];
            }
        } else if ($("#getNodesByParam").attr("checked")) {
            nodeList = zTree.getNodesByParam(keyType, value);
        } else if ($("#getNodesByParamFuzzy").attr("checked")) {
            nodeList = zTree.getNodesByParamFuzzy(keyType, value);
        }
    } else {
        updateNodes(false);
        nodeList = zTree.getNodesByFilter(filter);
    }
    updateNodes(true);

}
function updateNodes(highlight) {
    var zTree = $.fn.zTree.getZTreeObj("treeDemo");
    for (var i = 0, l = nodeList.length; i < l; i++) {
        nodeList[i].highlight = highlight;
        expand(nodeList[i]);
        zTree.updateNode(nodeList[i]);
    }
}
function resetNodes() {

    var zTree = $.fn.zTree.getZTreeObj("treeDemo");
    var nodes = zTree.transformToArray(zTree.getNodes());
    for (var i = 0, l = nodes.length; i < l; i++) {
        nodes[i].highlight = false;
        zTree.updateNode(nodes[i]);
    }
}
function getFontCss(treeId, treeNode) {
    return (!!treeNode.highlight) ? {color: colors[current_color], "font-weight": "bold"} : {color: "#333", "font-weight": "normal"};
}
function filter(node) {
    return !node.isParent && node.isFirstNode;
}
function expand(node) {
    var zTree = $.fn.zTree.getZTreeObj("treeDemo");
    var pnode = node.getParentNode();
    var gnode = pnode.getParentNode();
    zTree.expandNode(gnode, true);
    zTree.expandNode(pnode, true);
    return false;
}
function mysearch(value) {
    // updateNodes(false);
    var zTree = $.fn.zTree.getZTreeObj("treeDemo");
    var keyType = "id";
    value = value + "";
    var n = value.indexOf(",");
    var parts = Array();
    parts[0] = value;
    if (n > 0) {
        parts = value.split(',');
    }
    nodeList = [];
    for (var i = 0; i < parts.length; i++)
    {
        var node = zTree.getNodeByParam(keyType, "f_" + parts[i]);

        if (node !== null) {
            nodeList.push(node);
        }
    }
    set_color();
    updateNodes(true);
}

function set_color() {
    if (current_color == 3) {
        current_color = 0;
    } else {
        current_color = current_color + 1;
    }
}

var key;
$(document).ready(function() {
    tmCount = 1;
    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    $(".code_view").on("click", function() {
        $(".scc_instance_list tr").removeClass('selected-row');
        $(this).addClass('selected-row');
        mysearch($(this).data("files"));
        tmData = generateNewTreeMap(tmData, splitFIDs($(this).data("files").toString()), tmCount);
        tmCount++;
       
    });
});