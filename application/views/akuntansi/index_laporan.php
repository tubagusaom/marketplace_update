&nbsp;&nbsp;&nbsp;
<br>
&nbsp;&nbsp;&nbsp;
1. <a href="#" id="lap_jurnal">Laporan Jurnal</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
2. <a href="#" id="lap_bb">Laporan Buku Besar</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
3. <a href="#" id="lap_ns">Laporan Neraca</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
4. <a href="#" id="lap_lr">Laporan Laba Rugi</a>&nbsp;&nbsp;&nbsp;
<br><br><br>
<iframe id="iframe" src="<?php echo base_url() . "assets/akuntansi/gli/laporan_jurnal.php";?>" frameborder="no" width=100% height="600px"></iframe>
<script>
	$('#lap_jurnal').click(function(){
		$('#iframe').attr('src', '<?php echo base_url();?>assets/akuntansi/gli/laporan_jurnal.php');
	});
	$('#lap_bb').click(function(){
		$('#iframe').attr('src', '<?php echo base_url();?>assets/akuntansi/gli/laporan_bb.php');
	});
	$('#lap_ns').click(function(){
		$('#iframe').attr('src', '<?php echo base_url();?>assets/akuntansi/gli/laporan_neraca.php');
	});
	$('#lap_lr').click(function(){
		$('#iframe').attr('src', '<?php echo base_url();?>assets/akuntansi/gli/cetak_rl_dagang.php');
	});
</script>