<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-ui/jquery-ui.min.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/elfinder/theme.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/elfinder/elfinder.min.css'); ?>" />

<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#elfinder-tag').elfinder({
			url: base_url+'filemgr/filemgr_init',
			requestType: 'post',
			urlUpload: base_url+'filemgr/upload'
		}).elfinder('instance');
	});
</script>
<div id="elfinder-tag"></div>