<script type="text/javascript" src="<?= asset_url('js/myTreeMap.js') ?>"></script>
<script>

    function generateTreeMap()
    {
        //var treeMapData = <?php //echo json_encode($treemapdata);                            ?>;
        var data = new Array();
        data = <?php
if ($treemapdata) {
    echo $treemapdata;
}
?>;
        //alert(data);
        return data;
    }
  
</script>
        <html> <body>

                
    </body></html>
<div id="treemap"  class="col-lg-12 "></div>
<?php if (isset($treemapdata)) : ?>
    <h1><?php echo "Tree Map" ?></h1>
<?php endif; ?>

<?php if (isset($treemapdata)) : ?>
    
echo '<script type="text/javascript"> renderTreeMap(); </script>';

<?php else : ?>
    <h3>No results found!</h3>
<?php endif; ?>
