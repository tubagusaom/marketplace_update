<?php @session_start();  include ("../include/functions.php");?>
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
<form method="post" action="cetak_neraca_v2.php" id="frmijin">
<table width="536" align="center" cellspacing="1" bgcolor="#000000">
	<tr background="../images/impactg.png" height="30">
		<td colspan="5" align="center"><strong><font color="#FFFFFF">LAPORAN NERACA SALDO </font></strong></td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td width="81">Periode</td>
	  <td width="171"><input type="text" name="tgl_awal" id="tgl_awal" size="10" value="<?php echo $_SESSION["tgl_awal"]?>" class="required" readonly title="Harap Mengisi Tanggal Awal Dahulu" />
      </td>
		<td width="43" rowspan="2"></td>
		<td width="74">Divisi</td>
		<td width="149"><select name="divisi">
          <option value="">-ALL-</option>
         
      </select></td>
	</tr>
	<tr bgcolor="#FFFFCC">
		<td>S/d</td>
	  <td><input type="text" name="tgl_akhir" readonly id="tgl_akhir" size="10"  value="<?=$_SESSION["tgl_akhir"]?>" class="required" title="Harap Mengisi Tanggal Akhir Dahulu" />
        </td>
		<td>Tipe</td>
	  <td>
			<input type="radio" value="rupiah" name="tipe" checked="checked" />	
			Rupiah &nbsp;		</td>
	</tr>
	<tr  bgcolor="#FFFFCC">
		<td colspan="5" align="center"><input type="submit" name="pdf" value="Cetak PDF" /><input style="display: none;"  type="submit" name="excell" value="Export to Excell" /></td>
	</tr>
</table>
</form>
</body>

</html>
