<style>
td,th{
    padding: 1mm;
}
table{
    font-size: 8px;
}
</style>
<page backtop="15mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 44%;font-weight: lighter;">
                    <?=$aplikasi->nama_unit?>
                </td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
    <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 20%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 35%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 45%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <h4> TANDA TERIMA SERTIFIKAT KOMPETENSI </h4>
    Telah terima dari : <?=$aplikasi->singkatan_unit?><br />
    Berupa : Sertifikat kompetensi asli sebagai berikut:<br /><br />

   <table style="width:100%" border="1"  style="border-collapse: collapse;font-size: 10px;">
  
   <tr>
        <th style="width:15%;text-align: center;"> Nama </th>
        <th style="width:10%;text-align: center;"> No Seri  </th>
        <th style="width:10%;text-align: center;"> No Sertifikat  </th>
        <th style="width:15%;text-align: center;"> No Registrasi  </th>
        <th style="width:50%;text-align: center;" colspan="3" > Unit Kompetensi  </th>
    </tr>
   
    <tr>
        <td style="width:15%;text-align: center;" rowspan="<?php echo '8' ?>"> <?=$sertifikat->nama_lengkap?></td>
        <td style="width:10%;text-align: center;" rowspan="<?php echo '8' ?>"> <?=$sertifikat->no_seri?>  </td>
        <td style="width:10%;text-align: center;" rowspan="<?php echo '8' ?>"> <?=$sertifikat->no_sertifikat?>  </td>
        <td style="width:15%;text-align: center;" rowspan="<?php echo '8' ?>" colspan="2"> <?=$sertifikat->no_registrasi?>  </td>
       
        
    </tr>
    
  <?php foreach($unit as $key => $value) {?>
        <tr> 
        <td style="text-align: center;width: 25%"> <?=$value->id_unit_kompetensi?>  </td>
        <td style="text-align: center;width: 25%"> <?=$value->unit_kompetensi?>  </td>
        </tr>
        <?php } ?>
  
</table>
<h4>Surat Pernyataan atas Penggunaan Sertifikat</h4>
Sehubungan dengan telah diterbitkannya Sertifikat Kompetensi, maka saya yang bertanda tangan di bawah ini :
 <table style="width:100%" border="0"  style="border-collapse: collapse;font-size: 10px;font-weight: bold;">
    <tr>
        <td style="width:25%;font-weight: bold;">Nama Pemegang Sertifikat : </td><td><?=$sertifikat->nama_lengkap?></td>
    </tr>
    <tr>
        <td style="width:25%;font-weight: bold;">No Register Sertifikat : </td><td><?=$sertifikat->no_registrasi?></td>
    </tr>
    <tr>
        <td style="width:25%;font-weight: bold;">Telp / HP Pemegang Sertifikat : </td><td><?=$sertifikat->telp?></td>
    </tr>
</table>
Saya menyatakan menyetujui dan mentaati seluruh persyaratan yang telah di tetapkan oleh Lembaga Sertifikasi Profesi Cohespa, sehubungan dengan penerbitan sertifikat kompetensi tersebut diatas.
<ol>
<li>Memenuhi ketentuan skema sertifikasi yang relevan</li>
<li>Sertifikasi hanya berlaku untuk ruang lingkup sertifikasi yang telah di berikan</li>
<li>Tidak menyalahgunakan sertifikat yang merugikan <?=$aplikasi->nama_unit?> atau pihak lain ?> </li>
<li>Menghentikan penggunaan semua pernyataan yang berhubungan dengan sertifikat, bilaman sertifikatnya dicabut oleh <?=$aplikasi->nama_unit?></li>
<li>Sanggup untuk di lakukan survailen minimal 6(enam) bulan</li>
<li>Bersedia mengembalikan Sertifikat kepad <?=$aplikasi->nama_unit?>, bilamana sertifikat saya dicabut oleh <?=$aplikasi->nama_unit?></li>
</ol>

................, .....................<br/><br/><br/><br/><br/><br/>
.................................<br/>
(Pemegang Sertifikat)
</page> 