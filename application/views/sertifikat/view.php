<html dir="ltr" lang="en-US">
  <head>
  <style>

  	body {
  background: rgb(204,204,204); 
  
	}
	#footer{
    position:absolute;
   
   bottom:100px;
   height:250px;
   width:100%;
   
}
page {
  
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;

  
}
page[size="A4"] {  
  width: 21cm;
  height: 32cm; 
}


@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
.label-font-italic{
	font-style: italic;
	font-size:15px;
	font-family: Tahoma; 
}
.label-font-bold{
	font-weight:bold;
	font-size:15px;
	font-family: Tahoma; 
}
.label-font{
	
	font-size:15px;
	font-family: Tahoma; 
}
#unit_div{
	position: relative;
}
.label-font-bold-header{
	font-weight:bold;
	font-size:17px;
	font-family: Tahoma; 
}
.label-font-ttd{
	
	font-size:13px;
	font-family: Tahoma; 
}
.label-font-italic-ttd{
	font-style: italic;
	font-size:13px;
	font-family: Tahoma; 
}
.label-font-bold-ttd{
	font-weight:bold;
	font-size:13px;
	font-family: Tahoma; 
}
  </style>

  </head>
  <page size="A4" >
  	<table border="0x" width="100%" id="section-to-print" style="" cellpadding="1px" cellspacing="1px">
		<tr><td align="center" height="275px"></td></tr>
		<tr><td align="center" ><label class="label-font-bold">No. <?=$sertifikat->no_sertifikat?></label></td></tr>
		<tr><td align="center" height="30px"></td></tr>
		<tr><td align="center" height=""><label class="label-font">Dengan ini menyatakan bahwa,</td></tr>
		<tr><td align="center" ><label class="label-font-italic">This is certify that,</label></td></tr>
		<tr><td align="center" height="35px"></td></tr>
		<tr><td align="center"><label style="font-weight:bold;font-size:30px;"><?=ucwords(strtolower($sertifikat->nama_lengkap))?></label></td></tr>
		<tr><td align="center"><label class="label-font-bold">No Reg. <?=$sertifikat->no_registrasi?></label></td></tr>
		<tr><td align="center" height="35px"></td></tr>
		
		<tr><td align="center"><label style="font-family:arial;font-size:16px;">Telah memenuhi persyaratan dan kompeten pada kualifikasi:</label></td></tr>
		<tr><td align="center"><label style="font-family:arial;font-size:16px;font-style:italic;">Meet the requirements and competent for the below qualification:</label></td></tr>
		<tr><td align="center" height="28px"></td></tr>

		<tr><td align="center"><label style="font-weight:bold;font-size:16px;"><?=$sertifikat->skema?></label></td></tr>
		<tr><td align="center"><label style="font-style:italic;font-size:16px;"><?=$sertifikat->title_skema?></label></td></tr>
		<tr><td align="center" height="25px"></td></tr>

		<tr><td align="center"><label class="label-font">Pada bidang pekerjaan:</label></td></tr>
		<tr><td align="center"><label class="label-font-italic">In the area of:</label></td></tr>
		<tr><td align="center" height="24px"></td></tr>
		
		<tr><td align="center"><label style="font-weight:bold;font-size:16px;"><?=$sertifikat->bidang?></label></td></tr>
		<tr><td align="center"><label style="font-style:italic;font-size:16px;"><?=$sertifikat->bidang_title?></label></td></tr>

		<tr><td align="center" height="30px"></td></tr>
		<tr><td align="center"><label class="label-font">Sertifikat ini berlaku untuk:   3 (tiga) Tahun</label></td></tr>
		<tr><td align="center"><label class="label-font-italic">This certificate is valid for:   3 (three) Years</label></td></tr>
		<tr><td align="center" height="33px"></td></tr>
		<tr><td align="center"><label class="label-font">Semarang,  <?=tgl_indo($sertifikat->tanggal_terbit)?></label></td></tr>
		<tr><td align="center" height="30px"></td></tr>
		<tr><td align="center"><label class="label-font">Atas nama ( </label><label class="label-font-italic">On behalf of</label><label class="label-font"> ) BNSP</label></td></tr>
		<tr><td align="center"><label class="label-font"><?=$aplikasi->nama_unit?></label></td></tr>
		<tr><td align="center" ><label class="label-font-italic"><?=$aplikasi->unit_name?></label></i></td></tr>
		<tr><td align="center" height="103px"></td></tr>
		<tr><td align="center"><label class="label-font-bold"><?=$aplikasi->ketua?></label></td></tr>
		<tr><td align="center" height="3px"></td></tr>
		<tr><td align="center"><label class="label-font">Ketua (Chairman)</label></td></tr>
		
	</table>

  </page> 
<page size="A4" id="unit_div">
<div style="height:20px;"></div>
<div style="margin 0 auto;text-align:center;" ><label class="label-font-bold-header">Daftar Unit Kompetensi</label></div>
<div style="margin 0 auto;text-align:center;" ><label class="label-font-italic">List of Units(s) of Competency</label></div>
<div style="height:40px;"></div>
<table style="margin:20px; margin-left:60px; border-collapse: collapse; border: 1px solid black;" width="88%" border="1px" cellspacing="2" cellpadding="2">
<tr>
			<td style='border: 1px solid black;' width='30px' align='center' ><label class="label-font-bold">NO</label></td>
			<td width='220px' style='border: 1px solid black;' align='center' ><label class="label-font-bold">Kode Unit Kompetensi</label> <br/>
			<label class="label-font-italic">Code of Competency Unit</label></td>
			<td style='border: 1px solid black;	font-size:18px;' align='center'><label class="label-font-bold">Judul Unit Kompetensi</label> <br/>
			<label class="label-font-italic">Title of Competency Unit</label></td>
		</tr>

<?php foreach ($unit as $key => $value) {
	echo "<tr>
			<td style='border: 1px solid black;' width='30px' align='center'><label class='label-font'>".($key+1)."</label></td>
			<td style='border: 1px solid black;' align='center'><label class='label-font'>".$value->id_unit_kompetensi."</label></td>
			<td style='border: 1px solid black;	font-size:14px;padding-left:5px;'><label class='label-font'>".$value->unit_kompetensi."</label></td>
		</tr>";
	}
?>
</table>
<div id="footer">
<style type="text/css">
	 #table_unit td,th{
    padding: 1mm;
}

div.solid {
        border: 1px solid black;
        width: 120px;
        height: 160px;
        margin-left: 25px;
        bottom: 240px;
       position: relative;
       text-align: center;
       vertical-align: middle;
       
    }
    </style>
	<table id="table_unit" border="0x" width="90%"   style="border-collapse: collapse;margin-left:50px;">
		<tr><td align="center" width="50%"></td><td align="center" width="50%"><label class="label-font-ttd">Semarang,  <?=tgl_indo($sertifikat->tanggal_terbit)?></label>
		<br/><br/>
		<label class="label-font-ttd">Atas nama ( </label><label class="label-font-italic-ttd">On behalf of</label><label class="label-font-ttd"> ) BNSP</label>
		<br/>
		<label class="label-font-bold-ttd"><?=$aplikasi->nama_unit?></label>
		<br/>
		<label class="label-font-italic-ttd"><?=$aplikasi->unit_name?></label>
		</td></tr>
		<tr><td align="center" height="97px"></td><td align="center" ></td></tr>
		<tr><td align="center" >
		<label class="label-font-bold-ttd" style="text-decoration: underline;"><?=ucwords(strtolower($sertifikat->nama_lengkap))?></label>
		<br/>
		<label class="label-font-ttd">Tanda tangan pemilik</label>
		<br/>
		<label class="label-font-italic-ttd">Signature of holder</label>
		</td><td align="center" ><label class="label-font-bold-ttd" style="text-decoration: underline;"><?=$aplikasi->manajer_sertifikasi?></label><br/>
		<label class="label-font-ttd">Manajer Sertifikasi</label>
		<br/>
		<label class="label-font-italic-ttd">Manager of Certification</label>
		</td></tr>
		
	</table>
	<div class="solid">Foto 3 X 4</div>
</div>
</page>
