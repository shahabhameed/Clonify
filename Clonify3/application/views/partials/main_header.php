<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$this->config->item("site_title");?></title>
    <!-- <meta name="author" content="SuggeElson" />
    <meta name="description" content="Supr admin template - new premium responsive admin template. This template is designed to help you build the site administration without losing valuable time.Template contains all the important functions which must have one backend system.Build on great twitter boostrap framework" />
    <meta name="keywords" content="admin, admin template, admin theme, responsive, responsive admin, responsive admin template, responsive theme, themeforest, 960 grid system, grid, grid theme, liquid, masonry, jquery, administration, administration template, administration theme, mobile, touch , responsive layout, boostrap, twitter boostrap" />
    <meta name="application-name" content="Supr admin template" /> -->

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Force IE9 to render in normla mode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Le styles -->
	 
	<link href="<?=asset_url('css/bootstrap/bootstrap.min.css')?>" rel="stylesheet" />
    <link href="<?=asset_url('css/bootstrap/bootstrap-responsive.min.css')?>" rel="stylesheet" />
	<link href="<?=asset_url('css/bootstrap/bootstrap-theme')?>" rel="stylesheet" />
    <link href="<?=asset_url('css/supr-theme/jquery.ui.supr.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=asset_url('css/icons.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=asset_url('css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
	
	    <link href="<?=asset_url('plugins/forms/uniform/uniform.default.css')?>" type="text/css" rel="stylesheet" />
    <link href="<?=asset_url('plugins/misc/pnotify/jquery.pnotify.default.css')?>" type="text/css" rel="stylesheet" />
	<link href="<?=asset_url('plugins/misc/qtip/jquery.qtip.css')?>" rel="stylesheet" type="text/css" />
	
	<link rel="stylesheet" type="text/css"  href="<?=asset_url('css/elfinder.min.css')?>">
	<link rel="stylesheet" type="text/css" media="screen" href="<?=asset_url('css/jquery-ui.css')?>" />
	<link rel="stylesheet" type="text/css"  href="<?=asset_url('css/theme.css')?>" />

    <!-- Main stylesheets -->
    <link href="<?=asset_url('css/main.css')?>" rel="stylesheet" type="text/css" /> 

    <!--[if IE 8]><link href="css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
      <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script type="text/javascript" src="js/libs/respond.min.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
   

    <script type="text/javascript" src="<?=asset_url('js/modernizr.js')?>"></script>
    <script  type="text/javascript" src="<?=asset_url('js/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?=asset_url('js/jquery-migrate-1.2.1.js');?>"></script>
    <script type="text/javascript" src="<?=asset_url('js/bootstrap/bootstrap.js');?>"></script>  
    <script type="text/javascript" src="<?=asset_url('plugins/forms/validate/jquery.validate.min.js');?>"></script>
    <script type="text/javascript" src="<?=asset_url('plugins/forms/uniform/jquery.uniform.min.js');?>"></script>
    <script type="text/javascript" src="<?=asset_url('plugins/misc/pnotify/jquery.pnotify.min.js');?>"></script>
	<script type="text/javascript" src="<?=asset_url('js/jquery-ui.min.js');?>"></script>
	<script type="text/javascript" src="<?=asset_url('js/elfinder.min.js');?>"></script>
	<script type="text/javascript" charset="utf-8">
    $().ready(function() {
        var elf = $('#elfinder').elfinder({
            // lang: 'ru',             // language (OPTIONAL)
            url : 'http://203.135.63.151/Team2/Clonify3/ex_cont/elfinder_init'  // connector URL (REQUIRED)
        }).elfinder('instance');            
    });
	</script>
    </head>
    <body>    
    

		
		
		 <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                 <div class="navbar-header">
                <a class="navbar-brand" href="/home/"><?=$this->config->item('site_title');?>.<span class="slogan">DSSD</span></a>                
            </div>
				 <?php if ($this->tank_auth->is_logged_in()) {?>
                <div class="nav-no-collapse">
                              <ul class="nav">
                        <li><a href="dashboard.html"><span class="icon16 icomoon-icon-screen-2"></span> Dashboard</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon16 icomoon-icon-cog"></span> Settings
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul>
                                        <li>                                                    
                                            <a href="#"><span class="icon16 icomoon-icon-equalizer"></span>Site config</a>
                                        </li>
                                        <li>                                                    
                                            <a href="#"><span class="icon16 icomoon-icon-wrench"></span>Plugins</a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="icon16 icomoon-icon-picture-2"></span>Themes</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon16 icomoon-icon-mail-3"></span>Messages <span class="notification">8</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul class="messages">    
                                        <li class="header"><strong>Messages</strong> (10) emails and (2) PM</li>
                                        <li>
                                           <span class="icon"><span class="icon16 icomoon-icon-user-3"></span></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>Sammy Morerira</strong></a><span class="time">35 min ago</span></span>
                                            <span class="msg">I have question about new function ...</span>
                                        </li>
                                        <li>
                                           <span class="icon avatar"><img src="images/avatar.jpg" alt="" /></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>George Michael</strong></a><span class="time">1 hour ago</span></span>
                                            <span class="msg">I need to meet you urgent please call me ...</span>
                                        </li>
                                        <li>
                                            <span class="icon"><span class="icon16 icomoon-icon-mail-3"></span></span>
                                            <span class="name"><a data-toggle="modal" href="#myModal1"><strong>Ivanovich</strong></a><span class="time">1 day ago</span></span>
                                            <span class="msg">I send you my suggestion, please look and ...</span>
                                        </li>
                                        <li class="view-all"><a href="#">View all messages <span class="icon16 icomoon-icon-arrow-right-8"></span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                  
                    
                  
                    <ul class="nav pull-right usernav">
					<li class="dropdown">
                         
                        
                        </li>
                    
                    <li><a href="<?=site_url('auth/logout');?>"><span class="icon16 icomoon-icon-exit"></span><span class="txt"> Logout</span></a></li>
                
                    </ul>
					
					<ul class="nav pull-right usernav">
                        <li class="dropdown">
                            
                            
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                               <img src="<?=asset_url('images/user.gif');?>" alt="" class="image" /> 
                                <span class="txt"><?php echo $this->tank_auth->get_username();?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul>
                                  <li><a href="#"><span class="icon16 icomoon-icon-user-plus"></span>Update Profile</a></li>  
                                  <li><a href="/auth/change_password"><span class="icon16 icomoon-icon-user-plus"></span>Change Password</a></li>                                    
                                </ul>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
			<?php }?>
          </div><!-- /navbar --> 
		
		
		
		        <div id="sidebar">                    

		          <div class="sidenav">

                <div class="sidebar-widget" style="margin: -1px 0 0 0;">
                    <h5 class="title" style="margin-bottom:0">Navigation</h5>
                </div><!-- End .sidenav-widget -->

                <div class="mainnav">
                    <ul>
                        <li><a href="<?php echo base_url()?>index.php/invoke"><span class="icon16 icomoon-icon-stats-up"></span>Invoke</a></li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-list-view-2"></span>Forms<span class="notification red">sub2</span></a>
                            <ul class="sub">
                                <li><a href="forms.html"><span class="icon16 icomoon-icon-file"></span>Forms Stuff</a></li>
                                <li><a href="forms-validation.html"><span class="icon16 icomoon-icon-file"></span>Validation</a></li>
                                <li>
                                    <a href="#"><span class="icon16 icomoon-icon-file"></span>Sub Level 2<span class="notification red">new</span></a>
                                     <ul class="sub">
                                        <li><a href="#"><span class="icon16 icomoon-icon-arrow-right-2"></span>Item</a></li>
                                        <li><a href="#"><span class="icon16 icomoon-icon-arrow-right-2"></span>Item</a></li>
                                        <li><a href="#"><span class="icon16 icomoon-icon-arrow-right-2"></span>Item</a></li>
                                        <li><a href="#"><span class="icon16 icomoon-icon-arrow-right-2"></span>Item</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-grid"></span>Tables</a>
                            <ul class="sub">
                                <li><a href="tables.html"><span class="icon16 icomoon-icon-arrow-right-2"></span>Static</a></li>
                                <li><a href="data-table.html"><span class="icon16 icomoon-icon-arrow-right-2"></span>Data table</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-equalizer-2"></span>UI Elements</a>
                            <ul class="sub">
                                <li><a href="icons.html"><span class="icon16 icomoon-icon-rocket"></span>Icons</a></li>
                                <li><a href="buttons.html"><span class="icon16 icomoon-icon-file"></span>Buttons</a></li>
                                <li><a href="elements.html"><span class="icon16 icomoon-icon-cogs"></span>Elements</a></li>
                            </ul>
                        </li>
                        <li><a href="typo.html"><span class="icon16 icomoon-icon-font"></span>Typography</a></li>
                        <li><a href="grid.html"><span class="icon16 icomoon-icon-grid-view"></span>Grid</a></li>
                        <li><a href="calendar.html"><span class="icon16 icomoon-icon-calendar"></span>Calendar</a></li>
                        <li>
                            <a href="widgets.html"><span class="icon16 icomoon-icon-cube"></span>Widgets<span class="notification green">35</span></a>
                        </li>
                        <li><a href="file.html"><span class="icon16 icomoon-icon-upload"></span>File Manager</a></li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-file"></span>Error pages<span class="notification">6</span></a>
                            <ul class="sub">
                                <li><a href="403.html"><span class="icon16 icomoon-icon-file"></span>Error 403</a></li>
                                <li><a href="404.html"><span class="icon16 icomoon-icon-file"></span>Error 404</a></li>
                                <li><a href="405.html"><span class="icon16 icomoon-icon-file"></span>Error 405</a></li>
                                <li><a href="500.html"><span class="icon16 icomoon-icon-file"></span>Error 500</a></li>
                                <li><a href="503.html"><span class="icon16 icomoon-icon-file"></span>Error 503</a></li>
                                <li><a href="offline.html"><span class="icon16 icomoon-icon-file"></span>Offline page</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-box"></span>Other pages<span class="notification blue">11</span></a>
                            <ul class="sub">
                                <li><a href="invoice.html"><span class="icon16 icomoon-icon-file"></span>Invoice page</a></li>
                                <li><a href="profile.html"><span class="icon16 icomoon-icon-file"></span>User profile</a></li>
                                <li><a href="search.html"><span class="icon16 icomoon-icon-search-3"></span>Search page</a></li>
                                <li><a href="email.html"><span class="icon16 icomoon-icon-mail-3"></span>Email page</a></li>
                                <li><a href="support.html"><span class="icon16  icomoon-icon-support"></span>Support page</a></li>
                                <li><a href="faq.html"><span class="icon16 icomoon-icon-flag-3"></span>FAQ page</a></li>
                                <li><a href="structure.html"><span class="icon16 icomoon-icon-file"></span>Blank page</a></li>
                                <li><a href="fixed-topbar.html"><span class="icon16 icomoon-icon-file"></span>Fixed topbar</a></li>
                                <li><a href="right-sidebar.html"><span class="icon16 icomoon-icon-file"></span>Right sidebar</a></li>
                                <li><a href="two-sidebars.html"><span class="icon16 icomoon-icon-file"></span>Two sidebars</a></li>
                                <li><a href="drag.html"><span class="icon16 icomoon-icon-move"></span>Drag &amp; Drop <span class="notification red">new</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- End sidenav -->
		
						            <div class="sidebar-widget">
                <h5 class="title">Monthly Bandwidth Transfer</h5>
                <div class="content">
                    <span class="icon16 icomoon-icon-loop left"></span>
                    <div class="progress progress-mini progress-danger left tip" title="87%">
                      <div class="bar" style="width: 87%;"></div>
                    </div>
                    <span class="percent">87%</span>
                    <div class="stat">19419.94 / 12000 MB</div>
                </div>

            </div><!-- End .sidenav-widget -->

            <div class="sidebar-widget">
                <h5 class="title">Disk Space Usage</h5>
                <div class="content">
                    <span class="icon16 icomoon-icon-drive left"></span>
                    <div class="progress progress-mini progress-success left tip" title="16%">
                      <div class="bar" style="width: 16%;"></div>
                    </div>
                    <span class="percent">16%</span>
                    <div class="stat">304.44 / 8000 MB</div>
                </div>

            </div><!-- End .sidenav-widget -->

            <div class="sidebar-widget">
                <h5 class="title">Ad sense stats</h5>
                <div class="content">
                    
                    <div class="stats">
                        <div class="item">
                            <div class="head clearfix">
                                <div class="txt">Advert View</div>
                            </div>
                            <span class="icon16 icomoon-icon-eye left"></span>
                            <div class="number">21,501</div>
                            <div class="change">
                                <span class="icon24 icomoon-icon-arrow-up-2 green"></span>
                                5%
                            </div>
                            <span id="stat1" class="spark"></span>
                        </div>
                        <div class="item">
                            <div class="head clearfix">
                                <div class="txt">Clicks</div>
                            </div>
                            <span class="icon16 icomoon-icon-thumbs-up left"></span>
                            <div class="number">308</div>
                            <div class="change">
                                <span class="icon24 icomoon-icon-arrow-down-2 red"></span>
                                8%
                            </div>
                            <span id="stat2" class="spark"></span>
                        </div>
                        <div class="item">
                            <div class="head clearfix">
                                <div class="txt">Page CTR</div>
                            </div>
                            <span class="icon16 icomoon-icon-heart left"></span>
                            <div class="number">4%</div>
                            <div class="change">
                                <span class="icon24 icomoon-icon-arrow-down-2 red"></span>
                                1%
                            </div>
                            <span id="stat3" class="spark"></span>
                        </div>
                        <div class="item">
                            <div class="head clearfix">
                                <div class="txt">Earn money</div>
                            </div>
                            <span class="icon16 icomoon-icon-coin left"></span>
                            <div class="number">$376</div>
                            <div class="change">
                                <span class="icon24 icomoon-icon-arrow-up-2 green"></span>
                                26%
                            </div>
                            <span id="stat4" class="spark"></span>
                        </div>
                    </div>

                </div>
			
			
			 </div><!-- End #sidebar -->

		
		
		
    </div><!-- End #header -->