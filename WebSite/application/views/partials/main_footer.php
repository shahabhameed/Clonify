<div class="modal fade " id="file-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="filemodallabel"></h4>
            </div>
            <div class="modal-body " id="file-modal-content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>    

<!-- plugins -->
<!-- Charts plugins -->

<script type="text/javascript" src="<?= asset_url('plugins/charts/flot/jquery.flot.js'); ?>"></script>        
<script type="text/javascript" src="<?= asset_url('plugins/charts/flot/jquery.flot.grow.js'); ?>"></script>        
<script type="text/javascript" src="<?= asset_url('plugins/charts/flot/jquery.flot.resize.js'); ?>"></script>    
<script type="text/javascript" src="<?= asset_url('plugins/charts/flot/jquery.flot.tooltip_0.4.4.js'); ?>"></script>     
<script type="text/javascript" src="<?= asset_url('plugins/charts/flot/jquery.flot.orderBars.js'); ?>"></script>    
  
    
<script type="text/javascript" src="<?= asset_url('plugins/charts/sparkline/jquery.sparkline.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/charts/knob/jquery.knob.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/uniform/jquery.uniform.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/validate/jquery.validate.min.js'); ?>"></script>      

<script type="text/javascript" src="<?= asset_url('plugins/forms/wizard/jquery.bbq.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/wizard/jquery.form.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/wizard/jquery.form.wizard.js'); ?>"></script>


<script type="text/javascript" src="<?= asset_url('plugins/forms/elastic/jquery.elastic.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/inputlimiter/jquery.inputlimiter.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/maskedinput/jquery.maskedinput-1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/togglebutton/jquery.toggle.buttons.js'); ?>"></script>    
<script type="text/javascript" src="<?= asset_url('plugins/forms/globalize/globalize.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/color-picker/colorpicker.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/timeentry/jquery.timeentry.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/select/select2.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/forms/dualselect/jquery.dualListBox-1.3.min.js'); ?>"></script>    
<script type="text/javascript" src="<?= asset_url('plugins/forms/tiny_mce/tinymce.min.js'); ?>"></script>


<script type="text/javascript" src="<?= asset_url('plugins/misc/prettify/prettify.js'); ?>"></script><!-- Code view plugin -->
<script type="text/javascript" src="<?= asset_url('plugins/misc/search/tipuesearch_set.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/misc/search/tipuesearch_data.js'); ?>"></script><!-- JSON for searched results -->
<script type="text/javascript" src="<?= asset_url('plugins/misc/search/tipuesearch.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/misc/pnotify/jquery.pnotify.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/tree/js/jquery.ztree.core-3.5.js'); ?>"></script>
<?php if (isset($treedata)) { ?>
    <script type="text/javascript" src="<?= asset_url('plugins/tree/js/custom.js'); ?>"></script>
<?php } ?>

<script type="text/javascript" src="<?= asset_url('plugins/tables/dataTables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/tables/dataTables/jquery.dataTables.columnFilter.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/tables/dataTables/jquery.dataTables.yadcf.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/tables/dataTables/TableTools.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/tables/dataTables/ZeroClipboard.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/tables/responsive-tables/responsive-tables.js'); ?>"></script>

<script type="text/javascript" src="<?= asset_url('plugins/misc/animated-progress-bar/jquery.progressbar.js'); ?>"></script>


<script type="text/javascript" src="<?= asset_url('plugins/misc/nicescroll/jquery.nicescroll.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/misc/qtip/jquery.qtip.min.js'); ?>"></script>    
<script type="text/javascript" src="<?= asset_url('plugins/misc/fullcalendar/fullcalendar.min.js'); ?>"></script><!-- Calendar plugin -->
<script type="text/javascript" src="<?= asset_url('plugins/misc/qtip/jquery.qtip.min.js'); ?>"></script><!-- Custom tooltip plugin -->
<script type="text/javascript" src="<?= asset_url('plugins/misc/totop/jquery.ui.totop.min.js'); ?>"></script> <!-- Back to top plugin -->
<script type="text/javascript" src="<?= asset_url('plugins/files/elfinder/elfinder.min.js'); ?>"></script>

<?php if (isset($treemapdata)) { ?>
<!-- JQWidgets for TreeMap -->
<script type="text/javascript" src="<?= asset_url('plugins/jqwidgets/jqxcore.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/jqwidgets/jqxtooltip.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('plugins/jqwidgets/jqxtreemap.js'); ?>"></script>
<?php } ?>
<!-- Init plugins -->
<script type="text/javascript" src="<?= asset_url('js/jquery.mousewheel.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/jRespond.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/main.js'); ?>"></script><!-- Core js functions -->
<script type="text/javascript" src="<?= asset_url('js/tables.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/datatable.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/elements.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/jquery.poshytip.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/flexible-nav.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/forms.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/form-validation.js'); ?>"></script>
<script type="text/javascript" src="<?= asset_url('js/charts.js'); ?>"></script>


</html>