
<script>

	function auto_reload()
    {
		window.location = "<?php echo base_url(); ?>cronController/";
	}

</script>

 <body onload="timer = setTimeout('auto_reload()', 10000);">    
 </body>