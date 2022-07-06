<?php @session_start(); 
//include "otentik_gli.php"; 
include ("../include/infoclient.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
input.kanan{ text-align:right; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#frmijin").validate({
		rules: {
			password: "required",
			password_again: {
		equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: "E-mail harus diisi",
				email: "Masukkan E-mail yang valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
})
</script>

</head>

<body>

<br />
<form method="post" action="cetak_bb.php" id="frmijin">
<table width="680" align="center" cellspacing="1" bgcolor="#000000">
	<tr background="../images/impactg.png" height="30">
		<td colspan="5" align="center"><strong><font color="#FFFFFF">LAPORAN BUKU BESAR </font></strong> </td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td width="66">Periode</td>
		<td width="209"><input type="text" name="tgl_awal" id="tgl_awal" size="10" value="01-01-2017" class="required" title="Harap Mengisi Tanggal Awal Dahulu" />
      <a href="javascript:showCalendar('tgl_awal')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0" /></a></td>
		<td width="28" rowspan="2"></td>
		<td width="83">acc_divisi</td>
		<td width="276">
		
		<!--
		<select name="acc_divisi">
          <? if($_SESSION["sess_kelasuser"]<>"User"){?>
          <option value="">-ALL-</option>
          <? }?>
				  <?
					$SQL = "SELECT * FROM acc_divisi WHERE subdiv <> ''";
					if($_SESSION["sess_kelasuser"]=="User"){
						$SQL = $SQL . " AND subdiv = '".$_SESSION["sess_tipe"]."'";
					}
					
					$hasil = mysql_query($SQL) or die(mysql_error());
					while($baris = mysql_fetch_array($hasil)){
				?>
					  <option value="<?=$baris['subdiv']?>">
						<?php echo $baris['namadiv']?>
					  </option>
				  <? } ?>
      </select>
	  
	  -->
	  </td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td>S/d</td>
		<td><input type="text" name="tgl_akhir" id="tgl_akhir" size="10" class="required" title="Harap Mengisi Tanggal Akhir Dahulu" value="31-12-2017" />
          <a href="javascript:showCalendar('tgl_akhir')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0" /></a></td>
		<td>No. Rek </td>
		<td><select name="norek" class="" title="Pilih Nomor acc_rekening Dahulu" >
          <option value="">-ALL-</option>
          <?php
				$SQL = "SELECT * FROM acc_rekening WHERE substr(kode_akun, -3) <> '000' AND level = 4 ORDER BY kode_akun";
				$result = $dbh_mbs->query($SQL);
				while($baris = $result->fetch_assoc()){
			?>
         			 <option value="<?php echo $baris['kode_akun']?>"><?php echo $baris['nama_akun']?>-<?php echo $baris['kode_akun']; ?></option>
          	<?php } ?>
        </select></td>
	</tr>
	<tr  bgcolor="#FFFFCC">
		<td colspan="5" align="center"><input type="submit" name="pdf" value="Cetak PDF" /><input style="display: none;" type="submit" name="excell" value="Export to Excell" /></td>
	</tr>
</table>
</form>
</body>

</html>