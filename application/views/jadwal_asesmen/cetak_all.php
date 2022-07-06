
<style>
td,th{
    padding: 1mm;
}
</style>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
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
<h4>DAFTAR KEHADIRAN PESERTA UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir as $key=>$value){
 	$datax .= '<tr height="500">
	<td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
	<td style="width:60%;"> '.strtoupper($value->nama_lengkap).'   <br> </td>';
    if($noxx % 2 != 0){
        $datax .='<td style="width:17%;" rowspan="2"> '.$no_urut.'......   <br> </td>
        	<td style="width:18%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;	
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
    	<td style="width:5%;text-align: center;"> No </td>
    	<td style="width:60%;text-align: center;"> NAMA LENGKAP </td>
    	<td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
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
<h4>DAFTAR PENERIMA ATK UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir as $key=>$value){
 	$datax .= '<tr height="500">
	<td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
	<td style="width:60%;"> '.strtoupper($value->nama_lengkap).'   <br> </td>';
    if($noxx % 2 != 0){
        $datax .='<td style="width:17%;" rowspan="2"> '.$no_urut.'......   <br> </td>
        	<td style="width:18%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;	
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
    	<td style="width:5%;text-align: center;"> No </td>
    	<td style="width:60%;text-align: center;"> NAMA LENGKAP </td>
    	<td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
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
<h4>DAFTAR PENERIMA KONSUMSI PESERTA UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir as $key=>$value){
 	$datax .= '<tr height="500">
	<td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
	<td style="width:60%;"> '.strtoupper($value->nama_lengkap).'   <br> </td>';
    if($noxx % 2 != 0){
        $datax .='<td style="width:17%;" rowspan="2"> '.$no_urut.'......   <br> </td>
        	<td style="width:18%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;	
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
    	<td style="width:5%;text-align: center;"> No </td>
    	<td style="width:60%;text-align: center;"> NAMA LENGKAP </td>
    	<td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
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
<h4>DAFTAR PENERIMA BAHAN UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir as $key=>$value){
 	$datax .= '<tr height="500">
	<td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
	<td style="width:60%;"> '.strtoupper($value->nama_lengkap).'   <br> </td>';
    if($noxx % 2 != 0){
        $datax .='<td style="width:17%;" rowspan="2"> '.$no_urut.'......   <br> </td>
        	<td style="width:18%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;	
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
    	<td style="width:5%;text-align: center;"> No </td>
    	<td style="width:60%;text-align: center;"> NAMA LENGKAP </td>
    	<td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
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
<h4>DAFTAR HADIR ASESOR UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir_asesor as $key=>$value){
 	$datax .= '<tr height="500">
	<td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
	<td style="width:60%;"> '.strtoupper($value->users).'   <br> </td>';
    if($noxx % 2 != 0){
        $datax .='<td style="width:17%;" rowspan="2"> '.$no_urut.'......   <br> </td>
        	<td style="width:18%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;	
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
    	<td style="width:5%;text-align: center;"> No </td>
    	<td style="width:60%;text-align: center;"> NAMA LENGKAP </td>
    	<td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
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
<h4>DAFTAR PENERIMA KONSUMSI ASESOR UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir_asesor as $key=>$value){
 	$datax .= '<tr height="500">
	<td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
	<td style="width:60%;"> '.strtoupper($value->users).'   <br> </td>';
    if($noxx % 2 != 0){
        $datax .='<td style="width:17%;" rowspan="2"> '.$no_urut.'......   <br> </td>
        	<td style="width:18%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;	
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
    	<td style="width:5%;text-align: center;"> No </td>
    	<td style="width:60%;text-align: center;"> NAMA LENGKAP </td>
    	<td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
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
<h4>DAFTAR KEHADIRAN PANITIA UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir_panitia as $key=>$value){
 	$datax .= '<tr height="500">
	<td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
	<td style="width:60%;"> '.strtoupper($value).'   <br> </td>';
    if($noxx % 2 != 0){
        $datax .='<td style="width:17%;" rowspan="2"> '.$no_urut.'......   <br> </td>
        	<td style="width:18%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;	
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
    	<td style="width:5%;text-align: center;"> No </td>
    	<td style="width:60%;text-align: center;"> NAMA LENGKAP </td>
    	<td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
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
<h4>DAFTAR PENERIMA KONSUMSI PANITIA UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir_panitia as $key=>$value){
 	$datax .= '<tr height="500">
	<td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
	<td style="width:60%;"> '.strtoupper($value).'   <br> </td>';
    if($noxx % 2 != 0){
        $datax .='<td style="width:17%;" rowspan="2"> '.$no_urut.'......   <br> </td>
        	<td style="width:18%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;	
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
    	<td style="width:5%;text-align: center;"> No </td>
    	<td style="width:60%;text-align: center;"> NAMA LENGKAP </td>
    	<td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
</page>