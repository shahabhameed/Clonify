// make console.log safe to use
window.console||(console={log:function(){}});

//------------- Options for Supr - admin tempalte -------------//
var supr_Options = {
	fixedWidth: false, //activate fixed version with true
	rtl:false //activate rtl version with true
}

var code_compare_global_attributes = {
    file_1_path : null,
    file_1_start_line : null,
    file_1_end_line : null,
    file_1_start_col : null,
    file_1_end_col : null,    
    file_1_window_id: null,
    file_2_window_id: null,
    file_2_path : null,
    file_2_start_line : null,
    file_2_end_line : null,
    file_2_start_col : null,
    file_2_end_col : null,
    file_2_window_id : null
}
var window_id = 0;
//------------- Modernizr -------------//
//load some plugins only if is needed
Modernizr.load({
  test: Modernizr.placeholder,
  nope: base_url+'assets/plugins/forms/placeholder/jquery.placeholder.min.js',
  complete: function () {
	//------------- placeholder fallback  -------------//
	$('input[placeholder], textarea[placeholder]').placeholder();
  }
});
Modernizr.load({
  test: Modernizr.touch,
  yep: [ base_url+'assets/plugins/fix/ios-fix/ios-orientationchange-fix.js',  base_url+'assets/plugins/fix/touch-punch/jquery.ui.touch-punch.min.js']
});

//window resize events
$(window).resize(function(){
	//get the window size
	var wsize =  $(window).width();
	if (wsize > 980 ) {
		$('.shortcuts.hided').removeClass('hided').attr("style","");
		$('.sidenav.hided').removeClass('hided').attr("style","");
	}

	var size ="Window size is:" + $(window).width();	
});

$(window).load(function(){
	var wheight = $(window).height();
	$('#sidebar.scrolled').css('height', wheight-63+'px');
});

// document ready function
$(document).ready(function(){ 	

	//make template fixed width
	if(supr_Options.fixedWidth) {
		$('body').addClass('fixedWidth');
		$('#header').addClass('container');
		$('#wrapper').addClass('container');
	}
	

    $('.search-btn').addClass('nostyle');//tell uniform to not style this element
 
	//------------- Navigation -------------//

	mainNav = $('.mainnav>ul>li');
	mainNav.find('ul').siblings().addClass('hasUl').append('<span class="hasDrop icon16 fa fa-caret-down"></span>');
	mainNavLink = mainNav.find('a').not('.sub a');
	mainNavLinkAll = mainNav.find('a');
	mainNavSubLink = mainNav.find('.sub a').not('.sub li');
	mainNavCurrent = mainNav.find('a.current');

	//add hasSub to first element
	if(mainNavLink.hasClass('hasUl')) {
		$(this).closest('li').addClass('hasSub');
	}
	
	/*Auto current system in main navigation */
	var domain = document.domain;
	var folder ='';//if you put site in folder not in main domain you need to specify it. example http://www.host.com/folder/site
	var absoluteUrl = 0; //put value of 1 if use absolute path links. example http://www.host.com/dashboard instead of /dashboard

	function setCurrentClass(mainNavLinkAll, url) {
		mainNavLinkAll.each(function(index) {
			//convert href to array and get last element
			var href= $(this).attr('href');

			if(href == url) {
				//set new current class
				$(this).addClass('current');

				parents = $(this).parentsUntil('li.hasSub');
				parents.each(function() {
					if($(this).hasClass('sub')) {
						//its a part of sub menu need to expand this menu
						$(this).prev('a.hasUl').addClass('drop');
						$(this).addClass('expand');
					} 
				});
			}
		});
	}


	if(domain === '') {
		//domain not found looks like is in testing phase
		var pageUrl = window.location.pathname.split( '/' );
		var winLoc = pageUrl.pop(); // get last item
		setCurrentClass(mainNavLinkAll, winLoc);

	} else {
		if(absoluteUrl === 0) {
			//absolute url is disabled
			var afterDomain = window.location.pathname;
			if(folder !='') {
				afterDomain = afterDomain.replace(folder + '/','');
			} else {
				afterDomain = afterDomain.replace('/','');
			}
			setCurrentClass(mainNavLinkAll, afterDomain);
		} else {
			//absolute url is enabled
			var newDomain = 'http://' + domain + window.location.pathname;
			setCurrentClass(mainNavLinkAll, newDomain);
		}
	}

	//hover magic add blue color to icons when hover - remove or change the class if not you like.
	mainNavLinkAll.hover(
	  function () {
	    $(this).find('span.icon16').addClass('blue');
	  }, 
	  function () {
	    $(this).find('span.icon16').removeClass('blue');
	  }
	);

	//click magic
	mainNavLink.click(function(event) {
		$this = $(this);
		if($this.hasClass('hasUl')) {
			event.preventDefault();
			if($this.hasClass('drop')) {
				$(this).siblings('ul.sub').slideUp(250).siblings().toggleClass('drop');
			} else {
				$(this).siblings('ul.sub').slideDown(250).siblings().toggleClass('drop');
			}			
		} 
	});
	mainNavSubLink.click(function(event) {
		$this = $(this);
		if($this.hasClass('hasUl')) {
			event.preventDefault();
			if($this.hasClass('drop')) {
				$(this).siblings('ul.sub').slideUp(250).siblings().toggleClass('drop');
			} else {
				$(this).siblings('ul.sub').slideDown(250).siblings().toggleClass('drop');
			}			
		} 
	});

	//responsive buttons
	$('.resBtn>a').click(function(event) {
		$this = $(this);
		if($this.hasClass('drop')) {
			$this.removeClass('drop');
		} else {
			$this.addClass('drop');
		}
		if($('#sidebar').length) {
			$('#sidebar').toggleClass('offCanvas');
			$('#sidebarbg').toggleClass('offCanvas');
			if($('#sidebar-right').length) {
				$('#sidebar-right').toggleClass('offCanvas');
			}
		}
		if($('#sidebar-right').length) {
			$('#sidebar-right').toggleClass('offCanvas');
			$('#sidebarbg-right').toggleClass('offCanvas');
		}
		$('#content').toggleClass('offCanvas');
		if($('#content-one').length) {
			$('#content-one').toggleClass('offCanvas');
		}
		if($('#content-two').length) {
			$('#content-two').toggleClass('offCanvas');
			$('#sidebar-right').removeClass('offCanvas');
			$('#sidebarbg-right').removeClass('offCanvas');
		}
	});

	$('.resBtnSearch>a').click(function(event) {
		$this = $(this);
		if($this.hasClass('drop')) {
			$('.search').slideUp(250);
		} else {
			$('.search').slideDown(250);
		}
		$this.toggleClass('drop');
	});
	
	//Hide and show sidebar btn

	$(function () {
		//var pages = ['grid.html','charts.html'];
		var pages = [];
	
		for ( var i = 0, j = pages.length; i < j; i++ ) {

		    if($.cookie("currentPage") == pages[i]) {
				var cBtn = $('.collapseBtn.leftbar');
				cBtn.children('a').attr('title','Show Left Sidebar');
				cBtn.addClass('shadow hide');
				cBtn.css({'top': '20px', 'left':'200px'});
				$('#sidebarbg').css('margin-left','-299'+'px');
				$('#sidebar').css('margin-left','-299'+'px');
				if($('#content').length) {
					$('#content').css('margin-left', '0');
				}
				if($('#content-two').length) {
					$('#content-two').css('margin-left', '0');
				}
		    }

		}
		
	});

	$( '.collapseBtn' ).bind( 'click', function(){
		$this = $(this);

		//left sidbar clicked
		if ($this.hasClass('leftbar')) {
			
			if($(this).hasClass('hide-sidebar')) {
				//show sidebar
				$this.removeClass('hide-sidebar');
				$this.children('a').attr('title','Hide Left Sidebar');

			} else {
				//hide sidebar
				$this.addClass('hide-sidebar');
				$this.children('a').attr('title','Show Left Sidebar');		
			}
			$('#sidebarbg').toggleClass('hided');
			$('#sidebar').toggleClass('hided')
			$('.collapseBtn.leftbar').toggleClass('top shadow');
			//expand content
			
			if($('#content').length) {
				$('#content').toggleClass('hided');
			}
			if($('#content-two').length) {
				$('#content-two').toggleClass('hided');
			}	

		}

		//right sidebar clicked
		if ($this.hasClass('rightbar')) {
			
			if($(this).hasClass('hide-sidebar')) {
				//show sidebar
				$this.removeClass('hide-sidebar');
				$this.children('a').attr('title','Hide Right Sidebar');
				
			} else {
				//hide sidebar
				$this.addClass('hide-sidebar');
				$this.children('a').attr('title','Show Right Sidebar');
			}
			$('#sidebarbg-right').toggleClass('hided');
			$('#sidebar-right').toggleClass('hided');
			if($('#content').length) {
				$('#content').toggleClass('hided-right');
			}
			if($('#content-one').length) {
				$('#content-one').toggleClass('hided');
			}
			if($('#content-two').length) {
				$('#content-two').toggleClass('hided-right');
			}	
			$('.collapseBtn.rightbar').toggleClass('top shadow')
		}
	});


	//------------- widget panel magic -------------//

	var widget = $('div.panel');
	var widgetOpen = $('div.panel').not('div.panel.closed');
	var widgetClose = $('div.panel.closed');
	//close all widgets with class "closed"
	widgetClose.find('div.panel-body').hide();
	widgetClose.find('.panel-heading>.minimize').removeClass('minimize').addClass('maximize');

	widget.find('.panel-heading>a').click(function (event) {
		event.preventDefault();
		var $this = $(this);
		if($this .hasClass('minimize')) {
			//minimize content
			$this.removeClass('minimize').addClass('maximize');
			$this.parent('div').addClass('min');
			cont = $this.parent('div').next('div.panel-body')
			cont.slideUp(500, 'easeOutExpo'); //change effect if you want :)
			
		} else  
		if($this .hasClass('maximize')) {
			//minimize content
			$this.removeClass('maximize').addClass('minimize');
			$this.parent('div').removeClass('min');
			cont = $this.parent('div').next('div.panel-body');
			cont.slideDown(500, 'easeInExpo'); //change effect if you want :)
		} 
		
	})

	//show minimize and maximize icons
	widget.hover(function() {
		    $(this).find('.panel-heading>a').show(50);	
		}
		, function(){
			$(this).find('.panel-heading>a').hide();	
	});

	//add shadow if hover panel
	widget.not('.drag').hover(function() {
		    $(this).addClass('hover');	
		}
		, function(){
			$(this).removeClass('hover');	
	});

	//------------- Search forms  submit handler  -------------//
	if($('#tipue_search_input').length) {
		$('#tipue_search_input').tipuesearch({
          'show': 5
	     });
		$('#search-form').submit(function() {
		  return false;
		});

		//make custom redirect for search form in .heading
		$('#searchform').submit(function() {
			var sText = $('.top-search').val();
			var sAction = $(this).attr('action');
			var sUrl = sAction + '?q=' + sText;
			$(location).attr('href',sUrl);
			return false;
		});
	}
	//------------- To top plugin  -------------//
	$().UItoTop({ easingType: 'easeOutQuart' });

	//------------- Tooltips -------------//

	//top tooltip
	$('.tip').qtip({
		content: false,
		position: {
			my: 'bottom center',
			at: 'top center',
			viewport: $(window)
		},
		style: {
			classes: 'qtip-tipsy'
		}
	});

	//tooltip in right
	$('.tipR').qtip({
		content: false,
		position: {
			my: 'left center',
			at: 'right center',
			viewport: $(window)
		},
		style: {
			classes: 'qtip-tipsy'
		}
	});

	//tooltip in bottom
	$('.tipB').qtip({
		content: false,
		position: {
			my: 'top center',
			at: 'bottom center',
			viewport: $(window)
		},
		style: {
			classes: 'qtip-tipsy'
		}
	});

	//tooltip in left
	$('.tipL').qtip({
		content: false,
		position: {
			my: 'right center',
			at: 'left center',
			viewport: $(window)
		},
		style: {
			classes: 'qtip-tipsy'
		}
	});

	//------------- Jrespond -------------//
	var jRes = jRespond([
        {
            label: 'small',
            enter: 0,
            exit: 1000
        },{
            label: 'desktop',
            enter: 1001,
            exit: 10000
        }
    ]);

    jRes.addFunc({
        breakpoint: 'small',
        enter: function() {
            $('#sidebarbg,#sidebar,#content').removeClass('hided');
            if($('#content-two').length > 0) {
           		$('.collapseBtn.rightbar').addClass('offCanvas hide-sidebar').find('a').attr('title','Show Right Sidebar');
           		$('#content-two').addClass('hided-right showRb');
           		$('#sidebarbg-right').addClass('hided showRb');
           		$('#sidebar-right').addClass('hided showRb');
            }
        },
        exit: function() {
            $('.collapseBtn.top.hide').removeClass('top hide');
            $('.collapseBtn.rightbar').removeClass('offCanvas');
            $('#content-two').removeClass('hided-right showRb');
            $('#sidebarbg-right').removeClass('hided showRb');
           	$('#sidebar-right').removeClass('hided showRb');
        }
    });


	//remove overlay and show page
	$("#qLoverlay").fadeOut(250);
	$("#qLbar").fadeOut(250);

});

if( window['Clonify'] === undefined ) {
  window['Clonify'] = {};
}

Clonify.namespace = function(){
  var o, d;
  $.each(arguments, function(i, v) {
      d = v.split(".");
    o = window[d[0]] = window[d[0]] || {};
    $.each(d.slice(1), function(i, v2){
        o = o[v2] = o[v2] || {};
    });
  });
  return o;
}

Clonify.hasNamespace = function(ns) {
  return eval( ns + " != undefined" );
}

Clonify.ns = Clonify.namespace;

Clonify.ns('Clonify.SCC');
Clonify.ns('Clonify.MCC');
Clonify.ns('Clonify.FCS');
Clonify.ns('Clonify.FCC');
Clonify.FCC = {
	viewCodeData: function(path, fid, file_name){
	    var _url = base_url + "home/customloadcode";
	    window_id = window_id + 1;
	    $("#code_window1").css("overflow", "");
	    $("#code_window2").css("overflow", "");
	    var invocation_id = $("#sidebar_invocation_id").val();
	    var _params = {
	      file_path : path,
	      fid : fid,
	      file_name : file_name,
	      window_id: window_id
	    };
	    
	    $.post(_url, _params, function(r) {
	      $(".code-window-containter").show();
	      if ($("#code_window1").html() == ""){
	        $(".code-window1").show();
	        $("#file1").html('File Name : '+file_name);
	        $("#code_window1").html(r);        
	        window.location.hash='geshi-window'+window_id+'-'+start_line;
	      }else{	          
	        $("#code_window1").removeClass('col-md-11');
	        $("#code_window1").addClass('col-md-5');
	        $(".code-window2").show();
	        $("#file2").html('File Name : '+file_name);
	        $("#code_window2").html(r);        
	        window.location.hash='geshi-window'+window_id+'-'+start_line;
	      }      
    });
	
    	$('#code-window1').wrap('<div class="responsive" />');
    	$('#code-window2').wrap('<div class="responsive" />');

    	$("div.responsive").each(function(){
    		$(this).niceScroll({
				cursoropacitymax: 0.7,
				cursorborderradius: 6,
				cursorwidth: "4px"
			});
    	});
    
  }

}

function heightlightParentRow(_me){
  if (_me != null && _me != undefined){
      $("tr").removeClass('selected-row');
      $("tr").removeClass('selected-row0');
      $("tr").removeClass('selected-row1');
      $(_me).addClass('selected-row');
  }
}


Clonify.SCC = {
    
  viewSCCCloneInstance: function(_scc_id, _me){  
    heightlightParentRow(_me);
    $(".scc_instance_list").hide();
    $("#scc_instance_list_"+_scc_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#scc_instance_list_"+_scc_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                         			 null,
                                     { sSelector: "#gidnumberfilter",type: "number" },
                                     { sSelector: "#didnumberfilter",type: "number" },
                                     { sSelector: "#fidnumberfilter",type: "number" },
                                     null,
                                     null
                                     ]
                		});
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
                $('.dataTables_filter').hide();
  },
  viewFccGroupInst: function(_scc_id, _me){
    heightlightParentRow(_me);
    
    $(".scc_instance_list").hide();
    $("#scc_instance_list_"+_scc_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#scc_instance_list_"+_scc_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                         			 null,
                                     { sSelector: "#fccidfilter",type: "number" },
                                     { sSelector: "#didfilter",type: "number" },
                                     { sSelector: "#fidnumberfilter",type: "number" },
                                     null,
                                     ]
                		});
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
                $('.dataTables_filter').hide();
  },
  viewSCSAcrossCloneInstance: function(_scs_id, _me){
    heightlightParentRow(_me);
  	$(".scs_instance_list").hide();
    $("#scs_instance_list_"+_scs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#scs_instance_list_"+_scs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
            "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}
		}).columnFilter({
                         aoColumns: [
                         			 null,
                                     { sSelector: "#gidnumberfilter",type: "number" },
                                     { sSelector: "#didnumberfilter",type: "number" },
                                     { sSelector: "#fidnumberfilter",type: "number" },
                                     { sSelector: "#tcnumberfilter",type: "number" },
                                     { sSelector: "#pcnumberfilter",type: "number" },
                                     null
                                     ]
                		});
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();

  },
  viewSCSCloneInstance: function(_scs_id, _me){
    heightlightParentRow(_me);
    
    $(".scs_instance_list").hide();
    $("#scs_instance_list_"+_scs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#scs_instance_list_"+_scs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                         			 null,
                                     { sSelector: "#cidnumberfilter",type: "number" },
                                     { sSelector: "#scsidnumberfilter",type: "number" },
                                     { sSelector: "#scsinumberfilter",type: "number" },
                                     { sSelector: "#scsfidnumberfilter",type: "number" },
                                     null
                                     ]
                		});
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();
  },
  
  viewCodeData: function(_scc_id, _clone_list_id, path, fid, start_line, end_line, strt_col, end_col, file_name, _me){
    var _url = base_url + "home/loadCode";
    window_id = window_id + 1;
    var col = window_id % 2;
    var css_class = "selected-row" + col;
    
    if (_me != null && _me != undefined){      
      
      if ($(_me).hasClass("selected-row0") || $(_me).hasClass("selected-row1")){
        window_id = window_id - 1;
        return;
      }else{
        if ($("."+css_class).length > 0){
          $("." + css_class).removeClass(css_class);
        }
        $(_me).addClass(css_class);
      }      
    }
    
    $("#code_window1").css("overflow", "");
    $("#code_window2").css("overflow", "");
    var invocation_id = $("#sidebar_invocation_id").val();
    var _params = {
      scc_id : _scc_id,
      clone_list_id : _clone_list_id,
      file_path : path,
      fid : fid,
      start_line : start_line,
      file_name : file_name,
      end_line : end_line,
      strt_col : strt_col,
      end_col : end_col,
      invocation_id: invocation_id,
      window_id: window_id
    };
    
    $.post(_url, _params, function(r) {
      $(".code-window-containter").show();
      if ($("#code_window1").html() == ""){
        code_compare_global_attributes.file_1_path = path;
        code_compare_global_attributes.file_1_start_line = start_line;
        code_compare_global_attributes.file_1_end_line = end_line;
        code_compare_global_attributes.file_1_start_col = strt_col;
        code_compare_global_attributes.file_1_end_col = end_col;
        code_compare_global_attributes.file_1_window_id = window_id;
        $(".code-window1").show();
        $("#file1").html('File Name : '+file_name);
        $("#code_window1").html(r);        
        new FlexibleNav('#code_window1', new FlexibleNavMaker('.geshi-window'+window_id+'-minimap-index').make().prependTo('#code_map1') );
        if (start_line == null || start_line == ""){
          start_line = $("#startline-"+window_id).val();
        }
        window.location.hash='geshi-window'+window_id+'-'+start_line;
      }else{
          
        $("#code_window1").removeClass('col-md-11');
        $("#code_window1").addClass('col-md-5');
        $(".code-window2").show();        
        
        var load_1st_bar_map = false;
        if ($("#code_window2").html() != ""){
          
          
          code_compare_global_attributes.file_1_path = code_compare_global_attributes.file_2_path;
          code_compare_global_attributes.file_1_start_line = code_compare_global_attributes.file_2_start_line;
          code_compare_global_attributes.file_1_end_line = code_compare_global_attributes.file_2_end_line;
          code_compare_global_attributes.file_1_start_col = code_compare_global_attributes.file_2_start_col;
          code_compare_global_attributes.file_1_end_col = code_compare_global_attributes.file_2_end_col;        
          code_compare_global_attributes.file_1_window_id = code_compare_global_attributes.file_2_window_id;

          code_compare_global_attributes.file_2_path = path;
          code_compare_global_attributes.file_2_start_line = start_line;
          code_compare_global_attributes.file_2_end_line = end_line;
          code_compare_global_attributes.file_2_start_col = strt_col;
          code_compare_global_attributes.file_2_end_col = end_col;        
          code_compare_global_attributes.file_2_window_id = window_id;
          
          
          $("#file1").html( $("#file2").html() );
          $("#code_window1").html( $("#code_window2").html() );
          $("#code_map2").html("");
          $("#code_map1").html("");
          load_1st_bar_map = true;
        }else{
          code_compare_global_attributes.file_2_path = path;
          code_compare_global_attributes.file_2_start_line = start_line;
          code_compare_global_attributes.file_2_end_line = end_line;
          code_compare_global_attributes.file_2_start_col = strt_col;
          code_compare_global_attributes.file_2_end_col = end_col;        
          code_compare_global_attributes.file_2_window_id = window_id;
          
        }
        $("#file2").html('File Name : '+file_name);
        $("#code_window2").html(r);
        if (load_1st_bar_map){
          new FlexibleNav('#code_window1', new FlexibleNavMaker('.geshi-window'+(window_id - 1)+'-minimap-index').make().prependTo('#code_map1') );
        }
        
        new FlexibleNav('#code_window2', new FlexibleNavMaker('.geshi-window'+window_id+'-minimap-index').make().prependTo('#code_map2') );
        
        Clonify.SCC.calculateCloneDifferences();        
        if (start_line == null || start_line == ""){
          start_line = $("#startline-"+window_id).val();
        }
        window.location.hash='geshi-window'+window_id+'-'+start_line;
      }      
    });
	
    	$('#code-window1').wrap('<div class="responsive" />');
    	$('#code-window2').wrap('<div class="responsive" />');

    	$("div.responsive").each(function(){
    		$(this).niceScroll({
				cursoropacitymax: 0.7,
				cursorborderradius: 6,
				cursorwidth: "4px"
			});
    	});
    
  },
  calculateCloneDifferences : function(){
      
      console.debug(code_compare_global_attributes);
      
        var _url = base_url + "home/cloneDifference";
        $.post(_url, code_compare_global_attributes, function(r) { 
          
          console.log(r);

            var selector2 = "";
            for (var i = code_compare_global_attributes.file_2_start_line; i <= code_compare_global_attributes.file_2_end_line; i++){
                selector2 += '#geshi-window'+code_compare_global_attributes.file_2_window_id+'-'+i+",";
                
//                if (i == code_compare_global_attributes.file_2_start_line){
//                  var sec = '#geshi-window'+code_compare_global_attributes.file_2_window_id+'-'+i;
//                  var t = $(sec).find('div').html();
//                  t = t.substring(code_compare_global_attributes.file_2_start_col);
//                  $(sec).css('background-color', '#000000 !important');
//                  console.log(t);
//                  t = '<div style="background-color: #FFFF00;">'+t+'</div>';
//                  $(sec).find('div').html(t);
//                }
                
            }
            selector2 = selector2.substring(0, selector2.length-1);
            
            console.log("selector 2 : " + selector2);

            $(selector2).poshytip({
              content: 'Clone Difference is : '+r
            });
            
            var temp = r.split(",");
            var file_1_difference_arr = temp;
            var file_2_difference_arr = temp;
                        
            $(selector2).each(function(){
                var str = $(this).find('div').html();
                for(var i = 0; i < file_2_difference_arr.length; i++){
                    var temp = $.trim(file_2_difference_arr[i]);
                    if (temp.indexOf("." != -1)){
                      var temp1 = temp.split(".");
                      for (var j = 0; j < temp1.length; j++){
                        str = str.replace(temp1[j],"<span style='background-color: red !important'>"+temp1[j]+"</span>");
                      }
                    }else                    
                      str = str.replace(temp,"<span style='background-color: red !important'>"+temp+"</span>");                    
                }
                $(this).find('div').html(str);
            });            

            var selector1 = "";
            for (var i = code_compare_global_attributes.file_1_start_line; i <= code_compare_global_attributes.file_1_end_line; i++){
                selector1 += '#geshi-window'+code_compare_global_attributes.file_1_window_id+'-'+i+",";
            }

            selector1 = selector1.substring(0, selector1.length-1);
            
            $(selector1).each(function(){
                var str = $(this).find('div').html();
                for(var i = 0; i < file_1_difference_arr.length; i++){
                    var temp = $.trim(file_1_difference_arr[i]);
                    if (temp.indexOf("." != -1)){
                      var temp1 = temp.split(".");
                      for (var j = 0; j < temp1.length; j++){
                        str = str.replace(temp1[j],"<span style='background-color: red !important'>"+temp1[j]+"</span>");
                      }
                    }else                                        
                      str = str.replace(temp,"<span style='background-color: red !important'>"+temp+"</span>");                    
                }
                $(this).find('div').html(str);
            });            
            

            $(selector1).poshytip({
              content: 'Clone Difference is : '+r
            });

        });      
    
      
  }
  
};

Clonify.FCS = {
    
  viewInstanceWithinGroup: function(_fcs_id){
    $(".scc_instance_list").hide();
    $("#fcs_instance_list_"+_fcs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#fcs_instance_list_"+_fcs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                               null,
                                     { sSelector: "#cloneId",type: "number" },
                                     null
                                     ]
                    });
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();
  },
  viewInstanceAcrossGroup: function(_fcs_id){
  	$(".scc_instance_list").hide();
    $("#fcs_instance_list_"+_fcs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#fcs_instance_list_"+_fcs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
            "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}
		}).columnFilter({
                         aoColumns: [
                               null,
                                     { sSelector: "#cloneId",type: "number" },
                                     null
                                     ]
                    });;
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();

  },
  viewInstanceWithinDirectory: function(_fcs_id){
    $(".scc_instance_list").hide();
    $("#fcs_instance_list_"+_fcs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#fcs_instance_list_"+_fcs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                         			 null,
                                     { sSelector: "#cloneId",type: "number" },
                                     null
                                     ]
                		});
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();
  },
  viewInstanceCrossDirectory: function(_fcs_id){
    $(".scc_instance_list").hide();
    $("#fcs_instance_list_"+_fcs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#fcs_instance_list_"+_fcs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                               null,
                                     { sSelector: "#cloneId",type: "number" },
                                     null
                                     ]
                    });;
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();
  },
  viewInstanceFileByDir: function(_fcs_id){
    $(".scc_instance_list").hide();
    $("#fcs_instance_list_"+_fcs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#fcs_instance_list_"+_fcs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                               		null,
                                     { sSelector: "#gidfilter",type: "number" },
                                     { sSelector: "#fileidfilter",type: "number" },
                                     null
                                     ]
                    });;
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();
  },
   viewInstanceFccByDirectory: function(_fcs_id){
    $(".scc_instance_list").hide();
    $("#fcs_instance_list_"+_fcs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#fcs_instance_list_"+_fcs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
	                               null,
	                               { sSelector: "#fccidfilter",type: "number" },
	                               { sSelector: "#groupidfilter",type: "number" },
	                               { sSelector: "#fileidfilter",type: "number" },
	                               null
                                ]
                    });;
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();
  }
  
};

Clonify.MCC = {
    
  viewMCCCloneInstance: function(_mcc_id){
    $(".mcc_instance_list").hide();
    $("#mcc_instance_list_"+_mcc_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#mcc_instance_list_"+_mcc_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                         			 null,
                                     { sSelector: "#gidnumberfilter",type: "number" },
                                     { sSelector: "#didnumberfilter",type: "number" },
                                     { sSelector: "#fidnumberfilter",type: "number" },
                                     null,
                                     null
                                     ]
                		});
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();
  },
  viewMCSAcrossCloneInstance: function(_scs_id){
  	$(".scs_instance_list").hide();
    $("#scs_instance_list_"+_scs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#scs_instance_list_"+_scs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
            "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}
		}).columnFilter({
                         aoColumns: [
                         			 null,
                                     { sSelector: "#gidnumberfilter",type: "number" },
                                     { sSelector: "#didnumberfilter",type: "number" },
                                     { sSelector: "#fidnumberfilter",type: "number" },
                                     { sSelector: "#tcnumberfilter",type: "number" },
                                     { sSelector: "#pcnumberfilter",type: "number" },
                                     null
                                     ]
                		});
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();

  },
  viewMCSCloneInstance: function(_scs_id){
    $(".scs_instance_list").hide();
    $("#scs_instance_list_"+_scs_id).show();
    $(".code-window-containter").hide();
    $("#code_window1").html("");
    $("#code_window2").html("");
    $("#code_map1").html("");
    $("#code_map2").html("");
    $(".code-window1").hide();
    $(".code-window2").hide();
    window.location.hash='';
    $("#scs_instance_list_"+_scs_id+" table").dataTable( {
			"sDom": "<'row'<'col-lg-6'><'col-lg-6'f>r>t<'row'<'col-lg-6'i l><'col-lg-6'p>>",
			"sPaginationType": "bootstrap",
			"bJQueryUI": false,
			"bAutoWidth": false,
            "iDisplayLength" : 5,
            "aLengthMenu" : [5,10,25,50],
             "bDestroy": true,
			"oLanguage": {
				"sSearch": "<span></span> _INPUT_",
				"sLengthMenu": "<span>_MENU_</span>",
				"oPaginate": { "sFirst": "First", "sLast": "Last" }
			}

		}).columnFilter({
                         aoColumns: [
                         			 null,
                                     { sSelector: "#cidnumberfilter",type: "number" },
                                     { sSelector: "#scsidnumberfilter",type: "number" },
                                     { sSelector: "#scsinumberfilter",type: "number" },
                                     { sSelector: "#scsfidnumberfilter",type: "number" },
                                     null
                                     ]
                		});
		$('.dataTables_length select').uniform();
		$('.dataTables_paginate > ul').addClass('pagination');
		$('.dataTables_filter>label>input').addClass('form-control');
        $('.dataTables_filter').hide();
  },
  
  viewCodeData: function(_mcc_id, _clone_list_id, path, fid, start_line, end_line, strt_col, end_col, file_name, _mid, _me){	
    var _url = base_url + "home/loadCode";
    window_id = window_id + 1;
    var col = window_id % 2;
    var css_class = "selected-row" + col;
    
    if (_me != null && _me != undefined){      
      
      if ($(_me).hasClass("selected-row0") || $(_me).hasClass("selected-row1")){
        window_id = window_id - 1;
        return;
      }else{
        if ($("."+css_class).length > 0){
          $("." + css_class).removeClass(css_class);
        }
        $(_me).addClass(css_class);
      }      
    }
    
    $("#code_window1").css("overflow", "");
    $("#code_window2").css("overflow", "");
    var invocation_id = $("#sidebar_invocation_id").val();
    var _params = {
      mcc_id : _mcc_id,
      clone_list_id : _clone_list_id,
      file_path : path,
      fid : fid,
      start_line : start_line,
      file_name : file_name,
      end_line : end_line,
      strt_col : strt_col,
      end_col : end_col,
      invocation_id: invocation_id,
	  mid: _mid,
      window_id: window_id
    };    
    
    $.post(_url, _params, function(r) {
      $(".code-window-containter").show();
      if ($("#code_window1").html() == ""){
        code_compare_global_attributes.file_1_path = path;
        code_compare_global_attributes.file_1_start_line = start_line;
        code_compare_global_attributes.file_1_end_line = end_line;
        code_compare_global_attributes.file_1_window_id = window_id;
        $(".code-window1").show();
        $("#file1").html('File Name : '+file_name);
        $("#code_window1").html(r);        
        new FlexibleNav('#code_window1', new FlexibleNavMaker('.geshi-window'+window_id+'-minimap-index').make().prependTo('#code_map1') );
        if (start_line == null || start_line == ""){
          start_line = $("#startline-"+window_id).val();
        }
        window.location.hash='geshi-window'+window_id+'-'+start_line;
      }else{
        code_compare_global_attributes.file_2_path = path;
        code_compare_global_attributes.file_2_start_line = start_line;
        code_compare_global_attributes.file_2_end_line = end_line;
        code_compare_global_attributes.file_2_window_id = window_id;
          
        $("#code_window1").removeClass('col-md-11');
        $("#code_window1").addClass('col-md-5');
        $(".code-window2").show();
        var load_1st_bar_map = false
        if ($("#code_window2").html() != ""){
          $("#file1").html( $("#file2").html() );
          $("#code_window1").html( $("#code_window2").html() );
          $("#code_map2").html("");
          $("#code_map1").html("");
          load_1st_bar_map = true;
        }
        
        $("#file2").html('File Name : '+file_name);
        $("#code_window2").html(r);
        if (load_1st_bar_map){
          new FlexibleNav('#code_window1', new FlexibleNavMaker('.geshi-window'+(window_id - 1)+'-minimap-index').make().prependTo('#code_map1') );
        }
        
        new FlexibleNav('#code_window2', new FlexibleNavMaker('.geshi-window'+window_id+'-minimap-index').make().prependTo('#code_map2') );        
        
        Clonify.MCC.calculateCloneDifferences();        
        if (start_line == null || start_line == ""){
          start_line = $("#startline-"+window_id).val();
        }
        window.location.hash='geshi-window'+window_id+'-'+start_line;
      }      
    });
	
    	$('#code-window1').wrap('<div class="responsive" />');
    	$('#code-window2').wrap('<div class="responsive" />');

    	$("div.responsive").each(function(){
    		$(this).niceScroll({
				cursoropacitymax: 0.7,
				cursorborderradius: 6,
				cursorwidth: "4px"
			});
    	});
    
  },
  calculateCloneDifferences : function(){
      
        var _url = base_url + "home/cloneDifference";
        $.post(_url, code_compare_global_attributes, function(r) {                    

            var selector2 = "";
            for (var i = code_compare_global_attributes.file_2_start_line; i <= code_compare_global_attributes.file_2_end_line; i++){
                selector2 += '#geshi-window'+code_compare_global_attributes.file_2_window_id+'-'+i+",";
            }
            selector2 = selector2.substring(0, selector2.length-1);

            $(selector2).poshytip({
              content: 'Clone Difference is : '+r
            });
            
            var temp = r.split(",");
            var file_1_difference_arr = temp[0].split(" ");
            var file_2_difference_arr = temp[1].split(" ");
                        
            $(selector2).each(function(){
                for(var i = 0; i < file_2_difference_arr.length; i++){
                    var temp = $.trim(file_2_difference_arr[i]);
                    var str = $(this).find('div').html();
                    str = str.replace(temp,"<span style='background-color: red !important'>"+temp+"</span>");                    
                }
                $(this).find('div').html(str);
            });            

            var selector1 = "";
            for (var i = code_compare_global_attributes.file_1_start_line; i <= code_compare_global_attributes.file_1_end_line; i++){
                selector1 += '#geshi-window'+code_compare_global_attributes.file_2_window_id+'-'+i+",";
            }

            selector1 = selector1.substring(0, selector1.length-1);
            
            $(selector1).each(function(){
                for(var i = 0; i < file_1_difference_arr.length; i++){
                    var temp = $.trim(file_1_difference_arr[i]);
                    var str = $(this).find('div').html();
                    str = str.replace(temp,"<span style='background-color: red !important'>"+temp+"</span>");                    
                }
                $(this).find('div').html(str);
            });            
            

            $(selector1).poshytip({
              content: 'Clone Difference is : '+r
            });

        });      
    
      
  }
  
};

