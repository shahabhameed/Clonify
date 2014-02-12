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
	 
	<link href="<?=asset_url('css/bootstrap/bootstrap.css')?>" rel="stylesheet" />
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
	
    </head>
	<body>
	<div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="/home/"><?=$this->config->item('site_title');?>.<span class="slogan">DSSD</span></a>                
				</div>
			  </div>
		    </div>
	</div>