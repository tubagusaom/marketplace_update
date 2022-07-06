
<style>
td,th{
    padding: 1mm;
}
</style>
<page backtop="12mm" backbottom="10mm" backleft="5mm" backright="15mm" ">
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
                <td style="text-align: left;    width: 10%"><?=$konfigurasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 45%"> <?=$konfigurasi->alamat?> <?=$konfigurasi->no_telpon?></td>
                <td style="text-align: right;    width: 45%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
<h4>LAPORAN PELAKSANAAN UJI KOMPETENSI</h4>
<?php
$noxx =1;
$no_urut=1;
$datax = '';
foreach($daftar_hadir as $key=>$value){
    if($value->rekomendasi_asesor == '0'){
        $rekomendasi_asesor = ' ';
    }else if($value->rekomendasi_asesor == '1'){
        $rekomendasi_asesor = 'K';
    }else if($value->rekomendasi_asesor == '2'){
        $rekomendasi_asesor = 'BK';
    }else{
        $rekomendasi_asesor = 'AL';
    }
    $datax .= '<tr height="500">
    <td style="width:5%;text-align:center"> '.$noxx.'  <br> </td>
    <td style="width:15%;text-align:center;"> '.$value->no_uji_kompetensi.'   <br> </td>
    <td style="width:15%;"> '.strtoupper($value->nama_lengkap).'   <br> </td>
    <td style="width:23%;"> '.$value->organisasi.'   <br> </td>
    <td style="width:21%;"> '.strtoupper($value->users).'   <br> </td>
   <td style="width:5%;text-align: center;"> '.$rekomendasi_asesor.'   <br> </td>';

    if($noxx % 2 != 0){
        $datax .='<td style="width:11%;" rowspan="2"> '.$no_urut.'......   <br> </td>
            <td style="width:11%;" rowspan="2"> '.($no_urut + 1).'......   <br> </td>
        ';
        
    }
$datax .='</tr>';
$noxx++;    
$no_urut++;
}
?> 
Nama Jadwal : <?=$jadwal->jadual?><br />
Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

<?php
    if(count($daftar_hadir) > 0){
?>
<table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
    <tr style="font-weight:bold;">
        <td style="width:5%;text-align: center;"> No </td>
        <td style="width:15%;text-align: center;"> No Uji </td>
        <td style="width:15%;text-align: center;"> NAMA LENGKAP </td>
         <td style="width:23%;text-align: center;"> ORGANISASI </td>
         <td style="width:21%;text-align: center;"> NAMA ASESOR </td>
         
         <td style="width:5%;text-align: center;"> K/BK </td>
        <td colspan="2" style="width:22%;text-align: center;"> TANDA TANGAN </td>
    </tr> 
    <?=$datax?>  
</table>
<?php
    }else{
        echo"<h3>Belum Ada Peserta</h3>";
    }
?>
<p></p><p></p>
<table style="width:50%;" border="1" cellpadding="3" cellspacing="0">
    <tr>
        <td style="width:50%;text-align: center;" colspan="2"> ASESOR KOMPETENSI </td>
        
    </tr>
    <?php foreach ($asesor as $key => $value) {
    ?>
    <tr style="height:200px;" height="200px;">
        <td style="width:50%;text-align: center;height:70px;"> <?=$value->users?> <br/> <?=$value->no_reg?></td>
        <td style="width:50%;text-align: center;">  </td>
    </tr>
    <?php } ?>
</table>
</page>