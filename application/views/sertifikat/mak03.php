<style>
#table_mak03 td,th{
    padding: 1mm;
}
</style>
<table id="table_mak03" style="width:100%;" border="1" cellpadding="3" cellspacing="0">
<tr>
	<td colspan="2" ><strong>Peserta Sertifikasi:</strong> 
    <input type="hidden" value="<?php echo (isset($mak03[0]) && $mak03[0]=='1'?'1':'0'); ?>" name="mak03[0]" />
    <?php echo (isset($mak03[0]) && $mak03[0]=='1'?'Setuju':'Tidak Setuju'); ?>
	<br/>
	<br/>
<strong>Saya setuju mengikuti asesmen dengan pemahaman bahwa informasi yang dikumpulkan hanya digunakan untuk 
pengembangan profesional dan hanya dapat diakses oleh orang tertentu saja. 
</strong> 
</td>
		 
	</tr>
<tr>
	<td colspan="2"><strong>Asesor:</strong> <select name="mak03[1]">
    <option value="1" <?php echo (isset($mak03[1]) && $mak03[1]=='1'?'Selected':''); ?>>Setuju</option>
    <option value="0" <?php echo (isset($mak03[1]) && $mak03[1]=='0'?'Selected':''); ?>>Tidak Setuju</option></select>
	<br/>
	<br/>
<strong>Menyatakan tidak akan membuka hasil pekerjaan yang saya peroleh karena penugasan saya sebagai asesor
 dalam pekerjaan Asesmen kepada siapapun atau organisasi apapun selain kepada pihak yang berwenang sehubungan 
 dengan kewajiban saya sebagai Asesor yang ditugaskan oleh LSP. 
</strong> 
</td>
		 
	</tr>
</table>