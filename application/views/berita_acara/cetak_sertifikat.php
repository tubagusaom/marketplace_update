<style type="text/css">
	.label-font-italic{
	font-style: italic;
	font-size:13px;
	 font-family: Times;
}
.label-font-bold{
	font-weight:bold;
	font-size:13px;
	 font-family: Times;
}
.label-font{
	
	font-size:13px;
	font-family: Times;
}

.label-font-bold-header{
	font-weight:bold;
	font-size:14px;
	 
}
#footer{
    position:absolute;
   
   bottom:40px;
   height:150px;
   width:100%;
   
}
</style>

  
 <?php foreach($peserta as $key => $value) {
 ?>
 <page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
  	<table border="0" width="500px" cellpadding="0px" cellspacing="0px">
  		<tr><td align="center" style="height:220px;"></td></tr>
		<tr><td style="width:600px;" align="center" ><label class="label-font-bold">No. <?=$sertifikat[$key]->no_sertifikat?></label></td></tr>
		<tr><td align="center" style="height:30px;"></td></tr>
		<tr style="height:200px"><td align="center"  ><label class="label-font">Dengan ini menyatakan bahwa,</label></td></tr>
		<tr><td align="center" ><label class="label-font-italic">This is certify that,</label></td></tr>
		<tr><td align="center" style="height:30px;"></td></tr>
		<tr><td align="center"><label style="font-weight:bold;font-size:30px;font-family:Times;"><?=ucwords(strtolower(str_replace('.','',$sertifikat[$key]->nama_lengkap)))?></label></td></tr>
		<tr><td align="center"><label class="label-font-bold">No Reg. <?=$sertifikat[$key]->no_registrasi?></label></td></tr>
		<tr><td align="center" style="height:30px;"></td></tr>
		
		<tr><td align="center"><label class="label-font">Telah memenuhi persyaratan dan kompeten pada kualifikasi:</label></td></tr>
		<tr><td align="center"><label class="label-font-italic">Meet the requirements and competent for the below qualification:</label></td></tr>
		<tr><td align="center" style="height:22px;"></td></tr>

		<tr><td align="center"><label style="font-weight:bold;font-size:16px;"><?=$sertifikat[$key]->skema?></label></td></tr>
		<tr><td align="center"><label style="font-style:italic;font-size:16px;"><?=$sertifikat[$key]->title_skema?></label></td></tr>
		<tr><td align="center" style="height:22px;"></td></tr>

		<tr><td align="center"><label class="label-font">Pada bidang pekerjaan:</label></td></tr>
		<tr><td align="center"><label class="label-font-italic">In the area of:</label></td></tr>
		<tr><td align="center" style="height:22px;"></td></tr>
		
		<tr><td align="center"><label style="font-weight:bold;font-size:16px;"><?=$sertifikat[$key]->bidang?></label></td></tr>
		<tr><td align="center"><label style="font-style:italic;font-size:16px;"><?=$sertifikat[$key]->bidang_title?></label></td></tr>

		<tr><td align="center" style="height:25px;"></td></tr>
		<tr><td align="center"><label class="label-font">Sertifikat ini berlaku untuk:   3 (tiga) Tahun</label></td></tr>
		<tr><td align="center"><label class="label-font-italic">This certificate is valid for:   3 (three) Years</label></td></tr>
		<tr><td align="center" style="height:30px;"></td></tr>
		<tr><td align="center"><label class="label-font">Jakarta,  <?=tgl_indo($sertifikat[$key]->tanggal_terbit)?></label></td></tr>
		<tr><td align="center" style="height:33px;"></td></tr>
		<tr><td align="center"><label class="label-font">Atas nama ( </label><label class="label-font-italic">On behalf of</label><label class="label-font"> ) BNSP</label></td></tr>
		<tr><td align="center"><label class="label-font"><?=$aplikasi->nama_unit?></label></td></tr>
		<tr><td align="center" ><label class="label-font-italic"><?=$aplikasi->unit_name?></label></td></tr>
		<tr><td align="center" style="height:98px;"></td></tr>
		<tr><td align="center"><label class="label-font-bold"><?=$aplikasi->ketua?></label></td></tr>
		<tr><td align="center" style="height:1px;"></td></tr>
		<tr><td align="center"><label class="label-font">Ketua</label></td></tr>
		<tr><td align="center" ><label class="label-font-italic">Chairman</label></td></tr>
		
	</table>

  </page> 

  
<?php } ?>

<?php foreach($peserta as $keys => $values) {
 ?>
 <page backtop="10mm" backbottom="5mm" backleft="18mm" backright="10mm" id="divid">
	<div style="height:25px;"></div>
<div style="margin 0 auto;text-align:center;" ><label class="label-font-bold-header">Daftar Unit Kompetensi</label></div>
<div style="margin 0 auto;text-align:center;" ><label class="label-font-italic">List of Units(s) of Competency</label></div>
<div style="height:30px;"></div>
<table style="width: 100%;border: solid 1px ; border-collapse: collapse; border-spacing:1px;" border="1" cellpadding="2px" cellspacing="2px">
<tr>
			<td style='width: 5%;padding:5px;'  align='center' ><label class="label-font-bold">NO</label></td>
			<td  style='width:26%;padding:5px;' align='center' ><label class="label-font-bold">Kode Unit Kompetensi</label> <br/>
			<label class="label-font-italic">Code of Competency Unit</label></td>
			<td style='width:64%;padding:5px;' align='center'><label class="label-font-bold">Judul Unit Kompetensi</label> <br/>
			<label class="label-font-italic">Title of Competency Unit</label></td>
		</tr>

<?php foreach ($unit as $keyx => $valuex) {
	echo "<tr>
			<td style='width: 5%;' align='center' rowspan='2'><label class='label-font'>".($keyx+1)."</label></td>
			<td style='width: 26%;' align='center' rowspan='2'><label class='label-font'>".$valuex->id_unit_kompetensi."</label></td>
			<td style='width: 64%;padding:5px;'><label class='label-font'>".$valuex->unit_kompetensi."</label></td>
		</tr>";
	echo "<tr>

			<td style='width: 68%;border-collapse:collapse;border-left:0px;padding:5px;'><label class='label-font-italic'>".$valuex->translate."</label></td>
		</tr>";
}
?>
</table>


<div id="footer">
<style type="text/css">
	 #table_unit td,th{
    padding: 1mm;
}
</style>
	<table style="border-collapse: collapse;">
		<tr><td align="center" style="width:42%"></td><td  style="width:58%;text-align:center;"><label style="text-align:center" class="label-font">Jakarta,  <?=tgl_indo($sertifikat[$keys]->tanggal_terbit)?></label>
		<br/><br/>
		<label class="label-font">Atas nama ( </label><label class="label-font-italic">On behalf of</label><label class="label-font"> ) BNSP</label>
		<br/>
		<label class="label-font-bold"><?=$aplikasi->nama_unit?></label>
		<br/>
		<label class="label-font-italic"><?=$aplikasi->unit_name?></label>
		</td></tr>
		<tr><td style="width:42%;height:80px"></td><td style="width:58%;height:80px" ></td></tr>
		<tr><td align="center" >
		<label class="label-font-bold" style="text-decoration: underline;"><?=ucwords(strtolower(str_replace('.','',$sertifikat[$keys]->nama_lengkap)))?></label>
		<br/>
		<label class="label-font">Tanda tangan pemilik</label>
		<br/>
		<label class="label-font-italic">Signature of holder</label>
		</td><td align="center" ><label class="label-font-bold" style="text-decoration: underline;"><?=$aplikasi->manajer_sertifikasi?></label><br/>
		<label class="label-font">Manajer Sertifikasi</label>
		<br/>
		<label class="label-font-italic">Manager of Certification</label>
		</td></tr>
		
	</table>
	
</div>
</page>

<?php } ?>
<page backtop="12mm" backbottom="10mm" backleft="5mm" backright="15mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?=$path_image?></td>
                <td style="text-align: left;    width: 44%;font-weight: lighter;"><?=$konfigurasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 20%"><?=$konfigurasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 35%"> <?=$konfigurasi->alamat?> <?=$konfigurasi->no_telpon?></td>
                <td style="text-align: right;    width: 45%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
<h4 style="text-align:center;">BERITA ACARA PENYERAHAN SERTIFIKAT</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_kompeten as $key=>$value){
    if($value->rekomendasi_asesor == '0'){
        $rekomendasi_asesor = ' ';
    }else if($value->rekomendasi_asesor == '1'){
        $rekomendasi_asesor = 'K';
    }else{
        $rekomendasi_asesor = 'BK';
    }
    $datax .= '<tr height="500">
    <td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
    <td style="width:40%;"> '.$value->organisasi.'   <br> </td>
    <td style="width:32%;"> '.strtoupper($value->nama_lengkap).'   <br> </td>
    <td style="width:23%;"> '.$value->users.'   <br> </td>
    ';
$datax .='</tr>';
$noxx++;    
$no_urut++;
}
?> 
Pada hari <b><?=getday($jadwal->tanggal,'-')?></b> Tanggal <b><?=tgl_indo($jadwal->tanggal)?></b> <br/>
Bertempat di LSP P2KGK Jakarta Pusat telah dilaksanakan proses asesmen <br/>
Skema : <b><?=$skema?></b><br/>
Yang diikuti oleh<b> <?=$jumlah_peserta?></b> orang peserta <br/>
Dari hasil asesmen, peserta yang dinyatakan<br/><<br/>
<b>KOMPETEN</b> : <?=$kompeten?> Orang <br/>




<?php
    if(count($daftar_kompeten) > 0){
?>
<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
        <td style="width:5%;text-align: center;"> No </td>
        <td style="width:40%;text-align: center;"> NAMA SEKOLAH </td>
        <td style="width:32%;text-align: center;"> NAMA LENGKAP </td>
         <td style="width:23%;text-align: center;"> NAMA ASESOR </td>
         
    </tr> 
    <?=$datax?>  
</table>
<?php
    }else{
        echo"<h3>Belum Ada Peserta</h3>";
    }
?>
<p></p>
<table style="width:100%;" border="1" cellpadding="3" cellspacing="0">
    <tr>
        <td style="width:50%;" > NAMA SEKOLAH PENERIMA   </td>
        <td style="width:50%;" colspan="2"> TANDA TANGAN </td>
        
    </tr>
    <tr>
        <td style="width:50%;height:20px;  " >1.   </td>
        <td style="width:25%;" rowspan="2">1.   </td>
        <td style="width:25%;" rowspan="2">2.   </td>
        
    </tr>
    <tr>
        <td style="width:50%;height:20px;" >2.   </td>
        
        
    </tr>
    <tr>
        <td style="width:50%;height:20px;  " >3.   </td>
        <td style="width:25%;" rowspan="2">3.   </td>
        <td style="width:25%;" rowspan="2">4.   </td>
        
    </tr>
    <tr>
        <td style="width:50%;height:20px;" >4.   </td>
        
        
    </tr>
    
</table>
</page>