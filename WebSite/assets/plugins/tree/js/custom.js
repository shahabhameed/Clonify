var colors = ['red', 'green', 'blue', 'orange'];
var current_color = 0;

var setting = {
			data: {
				key: {
					title: "t"
				},
				simpleData: {
					enable: true
				}
			},
			view: {
				fontCss: getFontCss
			}
		};

		var zNodes =[
			{ id:1, pId:0, name:"Directory 1", t:"id=1", open:false},
			{ id:11, pId:1, name:"File 1-1", t:"id=11"},
			{ id:12, pId:1, name:"File 1-2", t:"id=12"},
			{ id:13, pId:1, name:"File 1-3", t:"id=13"},
			{ id:14, pId:1, name:"File 1-4", t:"id=14"},
			{ id:15, pId:1, name:"File 1-5", t:"id=15"},
			{ id:2, pId:0, name:"Directory 2", t:"id=2", open:false},
			{ id:21, pId:2, name:"File 2-1", t:"id=21"},
			{ id:22, pId:2, name:"File 2-2", t:"id=22"},
			{ id:23, pId:2, name:"File 2-3", t:"id=23"},
		];

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
				if (lastValue === value) return;
				lastValue = value;
				if (value === "") return;
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
			console.log(nodeList);
			for( var i=0, l=nodeList.length; i<l; i++) {
				nodeList[i].highlight = highlight;
				zTree.updateNode(nodeList[i]);
			}
		}
		function resetNodes(){
			
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			var nodes =  zTree.transformToArray(zTree.getNodes());
			for( var i=0, l=nodes.length; i<l; i++) {
				nodes[i].highlight = false;
				zTree.updateNode(nodes[i]);
			}
		}
		function getFontCss(treeId, treeNode) {
			return (!!treeNode.highlight) ? {color:colors[current_color], "font-weight":"bold"} : {color:"#333", "font-weight":"normal"};
		}
		function filter(node) {
			return !node.isParent && node.isFirstNode;
		}
		function expand(value){
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			var node = zTree.getNodeByParam("id", value);
			zTree.expandAll(false);
			resetNodes();
			zTree.expandNode(node, true, true, true);
			return false;
		}
		function mysearch(value){
			// updateNodes(false);
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			var keyType = "id";	
			value = value+"";
			var n = value.indexOf(",");
			var parts = Array();
			parts[0] = value;
			if(n>0){
				 parts = value.split(',');
			}
			nodeList = [];
			for (var i=0;i<parts.length;i++)
			{ 
				var node = zTree.getNodeByParam(keyType, parts[i]);

				if (node !== null) {
					nodeList.push(node);
				}
			}
			set_color();
			updateNodes(true);
		}
		function set_color(){
			if(current_color == 3){
				current_color = 0;
			}else{
				current_color = current_color+1;
			}
		}
		
		var key;
		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			
		});