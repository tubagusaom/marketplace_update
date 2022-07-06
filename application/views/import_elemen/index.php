<div style="margin: 2px;">
	<div id="import_elemen" style="width: 98.5%;"></div>
</div>
<script type="text/javascript">
	<?php echo $grid; ?> 
	function posting_(){
		$.ajax({
        url: 'import_elemen/proses',
        type: 'POST',
        success: function(result){
            if(result.msgType == 'error')
            {
                $.messager.alert('Error', 'Data berhasil di Import');
            }           
            else
            {
                $.messager.alert('Sukses', 'Data berhasil di Import');
            }
        }
    })
	  
	 }
</script>