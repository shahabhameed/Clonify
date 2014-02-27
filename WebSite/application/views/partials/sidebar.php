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
                    <a href="<?php echo site_url(); ?>"><span class="icon16 fa fa-cloud-upload"></span>File Manager</a>
                </li>
                <li><a href=" <?php echo site_url('invoke/'); ?>"><span class="icon16  icomoon-icon-equalizer-2"></span>Invoke</a></li>
                <?php if ($this->tank_auth->get_role_id() == 1) { ?>
                    <li><a href="<?php echo site_url('updatetokens/'); ?>"><span class="icon16 icomoon-icon-user-plus"></span>Update Tokens</a></li>
                <?php } ?>
                <li><a href="<?php echo site_url('load_results/'); ?>"><span class="icon16 icomoon-icon-user-plus"></span>Load Results</a></li>
                <?php if (isset($showCloneView) && $invocationId) { ?>
                    <input type="hidden" id="sidebar_invocation_id" value="<?php echo $invocationId; ?>"/>
                    <li>
                        <a href="#"><span class="icon16 fa fa-desktop"></span>Clone Table View</a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo site_url('home/SingleCloneClass') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>SCC
                                </a>
                                <a href="<?php echo site_url('home/SingleCloneClassByFile') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>SCC By File
                                </a>
                                <a href="<?php echo site_url('home/SingleCloneStructureWithinFile') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>SCS Within File
                                </a>
                                <a href="<?php echo site_url('home/SingleCloneStructureAcrossFile') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>SCS Across File
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div><!-- End sidenav --> 
</div><!-- End #sidebar -->      