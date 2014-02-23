 <!--Responsive navigation button-->  
        <div class="resBtn">
            <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
        </div>
        
        <!--Left Sidebar collapse button-->  
        <div class="collapseBtn leftbar">
             <a href="#" class="tipR" title="Hide Left Sidebar"><span class="icon12 minia-icon-layout"></span></a>
        </div>

        <!--Sidebar background-->
        <div id="sidebarbg"></div>
 <div id="sidebar"> 
 <div class="shortcuts" style="height:50px;">
</div>                   
    <div class="sidenav">
        <div class="sidebar-widget" style="margin: -1px 0 0 0;">
            <h5 class="title" style="margin-bottom:0">Navigation</h5>
        </div><!-- End .sidenav-widget -->

        <div class="mainnav">
            <ul>
                 <li>
                    <a href="<?php echo site_url();?>"><span class="icon16 fa fa-cloud-upload"></span>File Manager</a>
                </li>
                <li><a href=" <?php echo site_url('invoke/');?>"><span class="icon16 icomoon-icon-stats-up"></span>Invoke</a></li>
				<?php if($this->tank_auth->get_role_id() == 1){?>
					<li><a href="<?php echo base_url()?>index.php/updatetokens"><span class="icon16 icomoon-icon-stats-up"></span>Update Tokens</a></li>
				<?php } ?>
				<li><a href="<?php echo base_url()?>index.php/load_results"><span class="icon16 icomoon-icon-stats-up"></span>Load Results</a></li>
                <li>
                    <a href="#"><span class="icon16 fa fa-desktop"></span>Clone Class View</a>
                    <ul class="sub">
                        <li>
                            <a href="<?php echo site_url('home/SingleCloneClass');?>">
                                <span class="icon16 fa fa fa-caret-right"></span>Single Clone Class
                            </a>
                            <a href="<?php echo site_url('home/SingleCloneClassByFile');?>">
                                <span class="icon16 fa fa fa-caret-right"></span>Single Clone Class By File
                            </a>
                            <a href="<?php echo site_url('home/SingleCloneStructureWithinFile');?>">
                                <span class="icon16 fa fa fa-caret-right"></span>Single Clone Structure Within File
                            </a>
                            <a href="<?php echo site_url('home/SingleCloneStructureAcrossFile');?>">
                                <span class="icon16 fa fa fa-caret-right"></span>Single Clone Structure Across File
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div><!-- End sidenav --> 
</div><!-- End #sidebar -->      