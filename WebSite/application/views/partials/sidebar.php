<!--Responsive navigation button-->  
<div class="resBtn">
    <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
</div>

<!--Left Sidebar collapse button-->  
<div class="collapseBtn leftbar">
    <a href="#" class="tipR" title="Hide Left Sidebar"><span class="icon12 minia-icon-layout"></span></a>
</div>

<script>

	function loadNow(){
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/invoke/isInvocationInProgressControllerFunc/",
			success: function(result) {
				//alert("result: " + result);
				var repositoryListItemObj = document.getElementById("repositoryListItem")
				
				if(result == true){
					
					$( "#repositoryListItem" ).fadeOut( "slow", function() {
						repositoryListItemObj.style.display='none'; 
					});
				}
				else{
					
					$( "#repositoryListItem" ).fadeIn( "slow", function() {
						repositoryListItemObj.style.display='block';
					});
				}
				
			},
			error: function(xhr) {
				alert("An error occured: " + xhr.status + " " + xhr.statusText);
			}
		});
		setTimeout('loadNow()',5000);
	}
	
	$(function(){
		loadNow();
	});

</script>

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
				
				<li id="repositoryListItem" style="display:none;"><a href="<?php echo site_url(); ?>"><span class="icon16 fa fa-cloud-upload"></span>Repository</a></li>
				
                <li><a href=" <?php echo site_url('invoke/'); ?>"><span class="icon16  icomoon-icon-equalizer-2"></span>Clone Detection</a></li>

                <?php if ($this->tank_auth->get_role_id() == 1) { ?>
                    <li><a href="<?php echo site_url('updatetokens/'); ?>"><span class="icon16 icomoon-icon-user-plus"></span>Update Tokens</a></li>
                <?php } ?>

                <li><a href="<?php echo site_url('load_results/'); ?>"><span class="icon16 icomoon-icon-user-plus"></span>View Results</a></li>



                <?php if (isset($showCloneView) && $invocationId) { ?>
                    <input type="hidden" id="sidebar_invocation_id" value="<?php echo $invocationId; ?>"/>
                    <li>
                        <a href="#"><span class="icon16 fa fa-desktop"></span>Clone Table View</a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo site_url('home/SingleCloneClass') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>SCC
                                </a>
                                <a href="<?php echo site_url('home/SCCByMethod') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>SCC By Method
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
                                <a href="<?php echo site_url('FCS/FCSWithinGroup') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>FCS Within Group
                                </a>
                                <a href="<?php echo site_url('FCS/FCSCrossGroup') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>FCS Across Group
                                </a>
                                <a href="<?php echo site_url('FCS/FCSWithinDirectory') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>FCS Within Directory
                                </a>
                                <a href="<?php echo site_url('FCS/FCSCrossDirectory') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>FCS Across Directory
                                </a>
                                <a href="<?php echo site_url('home/MethodCloneClass') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>MCC
                                </a>
                                <a href="<?php echo site_url('home/MethodCloneClassByFile') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>MCC By File
                                </a>
                                <a href="<?php echo site_url('home/MethodCloneStructureAcrossFile') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>MCS Across File
                                </a>
                                <a href="<?php echo site_url('home/MethodByFile') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>Methods By File
                                </a>
                                 <a href="<?php echo site_url('FCS/filecloneclass') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>FCC
                                </a> 
                                <a href="<?php echo site_url('home/filecloneclassbydir') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>FCC BY Directory
                                </a>
                                <a href="<?php echo site_url('home/fileCloneClassByGroup') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>FCC BY Group
                                </a>
                                <a href="<?php echo site_url('home/filebydir') . "/" . $invocationId; ?>">
                                    <span class="icon16 fa fa fa-caret-right"></span>Files BY Directory
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <li><a href="<?php echo site_url('general/tree_map/'); ?>"><span class="icon16 icomoon-icon-exit"></span>About Us</a></li>
            </ul>
        </div>
    </div><!-- End sidenav --> 
</div><!-- End #sidebar -->      