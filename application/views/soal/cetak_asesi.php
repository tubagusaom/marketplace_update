<style>
td,th{
    padding: 1mm;
}
</style>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 64%;font-weight: lighter;">
                    <?=$aplikasi->nama_unit?>
                </td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <h4> FR-APL-01.FORMULIR PERMOHONAN SERTIFIKASI KOMPETENSI </h4>
    <table style="width:100%;" border="0" cellpadding="4" cellspacing="3">
  <tr nobr="true">
    <td colspan="6"><strong>Bagian 1 : Rincian Data Pemohon Sertifikasi</strong></td>
 
  </tr>
   <tr nobr="true">
    <td colspan="6">Pada Bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini</td>
 
  </tr>
  <tr nobr="true">
    <td style="width:4%;"><strong>a.</strong></td>
    <td width="30%"><strong>Data Pribadi</strong></td>
    <td colspan="4"> </td>
  
  </tr>
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Nama Lengkap</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?php echo strtoupper($data_asesi->nama_lengkap) ?> </td>
  
  </tr>
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Tempat / Tgl.Lahir</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?php echo $data_asesi->tempat_lahir.', '.tgl_indo($data_asesi->tgl_lahir) ?> </td>
  </tr>
  
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Jenis Kelamin</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?php echo $data_asesi->jenis_kelamin=='1' ?'Laki-Laki':'Wanita' ?>   </td>
  
  </tr>
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Kebangsaan</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> Indonesia   </td>
  </tr>
    
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td>Alamat Rumah</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?php echo $data_asesi->alamat ?>  </td>
  </tr>
  
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%"></td>
    <td width="3%;">  </td>
    <td width="60%;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp; &nbsp; Kode Pos : _________________  </td>
  </tr>
  
   <tr nobr="true">
    <td style="width:4%;"> </td>
    <td>Nomor Telepon/HP/Email</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?php echo $data_asesi->telp.' / '.$data_asesi->email ?></td>
  </tr>
  
   <tr nobr="true">
    <td style="width:4%;"> </td>
    <td>Pendidikan Terakhir</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?php echo strtoupper($data_asesi->pendidikan_terakhir) ?> </td>
  </tr>
  
  

<tr nobr="true">
    <td style="width:4%;"><strong>b.</strong></td>
    <td width="30%"><strong>Data Pekerjaan Sekarang</strong></td>
    <td colspan="4"> </td>
  
  </tr>
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Nama Lembaga / Perusahaan</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?php echo $data_asesi->jabatan ?></td>
  
  </tr>
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Alamat</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?=$data_asesi->alamat_company?></td>
  
  </tr>
  
  
   <tr nobr="true">
    <td style="width:4%;"> </td>
    <td>Nomor Telepon/Email</td>
    <td width="3%;"> :  </td>
    <td width="60%;"> Telp :<?=$data_asesi->telp_company?> &nbsp; &nbsp; Fax : <?=$data_asesi->telp_company?> </td>
  </tr>
  
   <tr nobr="true">
    <td colspan="3"> </td>
    
    <td width="60%;"> Email : <?=$data_asesi->email_company?> </td>
  </tr>
 
 

<tr nobr="true">
    <td style="width:4%;"><strong>c.</strong></td>
    <td width="30%"><strong>Data Permohonan Sertifikasi</strong></td>
    <td colspan="4"> </td>
  
  </tr>
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Tujuan Assessment </td>
    <td width="3%;"> :  </td>
    <td width="60%;">Sertifikasi</td>
  
  </tr>
  
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Skema Sertifikasi </td>
    <td width="3%;"> :  </td>
    <td width="60%;"> Okupasi : </td>
    
  </tr>
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Kontak Asesmen </td>
    <td width="3%;"> :  </td>
    <td width="60%;"> TUK Mandiri </td>
 </tr>
 <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">Acuan Pembanding </td>
    <td width="3%;"> :  </td>
    <td width="60%;"> SKKNI </td>
 </tr>
 <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%">TUK </td>
    <td width="3%;"> :  </td>
    <td width="60%;"> <?=$data_asesi->tempat_uji?> </td>
 </tr>

  <tr nobr="true">
    <td style="width:100%;border: 1px solid;text-align: justify;" colspan="4" >
        PERNYATAAN : Dalam rangka mengikuti kegiatan uji kompetensi yang di adakan oleh <?=$aplikasi->nama_unit?>, dengan ini
        saya menyatakan dengan sesungguhnya bahwa dokumen-dokumen serta informasi yang saya berikan dalam formulir online
        pendaftaran Uji Kompetensi ini adalah sah dan benar. Apabila di kemudian hari terbukti bahwa dokumen yang telah saya sampaikan ternyata tidak sah dan manipulasi, saya bersedia untuk diproses melalui jalur hukum sesuai dengan ketentuan yang telah di tetapkan. Sesuai dengan ketentuan LSP, dokumen ini telah di tanda tangani secara elektronik sehinga tidak diperlukan lagi tanda tangan basah.</td>
    
  </tr>
 <tr nobr="true">
    <td style="width:4%;height: 2px;"> </td>
    <td width="30%"> </td>
    <td width="3%;">  </td>
    <td width="60%;"> </td>
  </tr>
  <tr nobr="true">
    <td style="width:4%;"> </td>
    <td width="30%"> </td>
    <td width="3%;">  </td>
    <td width="60%;" style="font-weight: bold;"><?php echo 'Jakarta, '.tgl_indo(date("Y-m-d", strtotime($data_asesi->u_date_create))) ?> </td>
  </tr>
  <tr nobr="true">
    <td style="width:4%;height: 35px;"> </td>
    <td width="30%"> </td>
    <td width="3%;">  </td>
    <td width="60%;"><qrcode value="<?php echo $msg; ?>" ec="Q" style="width: 30mm;"></qrcode> </td>
  </tr>
  
  <tr nobr="true">
    <td style="width:4%;height: 20px;"> </td>
    <td width="30%"> </td>
    <td width="3%;">  </td>
    <td width="60%;"> <b><?=$data_asesi->nama_lengkap?></b></td>
  </tr>
  
</table>

    
</page> 

<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 64%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <h4>Bagian  2 :  Daftar Unit Kompetensi</h4>
    <div style="text-align: justify;">
    Pada bagian 2 ini berisikan Unit Kompetensi yang anda ajukan untuk dinilai/diuji kompetensi dalam rangka mendapatkan pengakuan sesuai dengan latar belakang pendidikan, pelatihan serta pengalaman kerja yang anda miliki.   Unit kompetensi yang diajukan sesuai dengan Skema Sertifikasi 
    </div>
    <div style="margin-top: 15px;padding: 1mm;">Judul Skema : <?=$data_asesi->skema?></div>
    <div style="padding: 1mm;">No Skema : <?=$data_asesi->kode_skema?></div>
    <table  style="width: 100%;border: solid 1px ; border-collapse: collapse; margin-top: 25px;" cellpadding="3"   >
        <thead>
            <tr>
                <th style="width: 5%; text-align: left; border: solid 1px;text-align:center;background-color: #5DC8CD; ">No</th>
                <th style="width: 25%; text-align: left; border: solid 1px;text-align:center;background-color: #5DC8CD; ">Kode Unit Kompetensi</th>
                <th style="width: 45%; text-align: left; border: solid 1px;text-align:center;background-color: #5DC8CD; ">Unit Kompetensi</th>
                <th style="width: 25%; text-align: left; border: solid 1px;text-align:center;background-color: #5DC8CD; ">Jenis Standar (Standar Khusus/Standar Internasional/SKKNI)</th>
            </tr>
        </thead>
        <tbody>
<?php
    foreach ($unit_kompetensi as $key=>$value) {
?>
            <tr>
                <td style="width: 5%; text-align: center; border: solid 1px ;">
                    <?=$key+1?>
                </td>
                <td style="width: 25%; text-align: center; border: solid 1px ">
                    <?=$value->id_unit_kompetensi?>
                </td>
                <td style="width: 45%; text-align: left; border: solid 1px ">
                    <?=$value->unit_kompetensi?></td>
                <td style="width: 25%; text-align: center; border: solid 1px ">
                    SKKNI</td>
            </tr>
<?php
    }
?>
        </tbody>
       
    </table>
    <h4>Bagian  3 :  Bukti Kelengkapan Pemohon</h4>
    <table  style="width: 100%;border: solid 1px ; border-collapse: collapse; margin-top: 25px;" cellpadding="3"   >
        <thead>
            <tr>
                <th style="width: 5%; text-align: left; border: solid 1px;text-align:center;background-color: #5DC8CD; ">No</th>
                <th style="width: 50%; text-align: left; border: solid 1px;text-align:center;background-color: #5DC8CD; ">Unit/Elemen Kompetensi </th>
                <th style="width: 45%; text-align: left; border: solid 1px;text-align:center;background-color: #5DC8CD; ">Bukti (paling relevan) : 
                Rincian Pendidikan/Pelatihan,    Pengalaman Kerja, Pengalaman Hidup  
                </th>
                
            </tr>
        </thead>
        <tbody>
<?php
    foreach ($asesi_detail as $key=>$value) {
?>
            <tr>
                <td style="width: 5%; text-align: center; border: solid 1px ;">
                    <?=$key+1?>
                </td>
                <td style="width: 50%; text-align: left; border: solid 1px ">
                    <?=$value->elemen?>
                </td>
                <td style="width: 45%; text-align: center; border: solid 1px ">
                    <?=$value->jenis_bukti?></td>
            </tr>
<?php
    }
?>
        </tbody>
       
    </table>
    <br />
    <table style="width:100%" border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
 <tr nobr="true">
    <td rowspan="3" style="width: 50%;"> <strong>Rekomendasi</strong> </td>
    <td colspan="2" style="width: 50%;"> <strong>Pemohon :</strong> </td> 
 </tr>

<tr nobr="true">
 
    <td style="width: 25%;"> Nama </td>
    <td style="width: 25%;"> <?=$data_asesi->nama_lengkap?> </td> 
 </tr>


<tr nobr="true">
     
    <td> Tanda Tangan / Tanggal </td>
    <td style="height: 35px;">  </td> 
 </tr>

 <tr nobr="true">
    <td rowspan="4"> <strong>Catatan :</strong> </td>
    <td colspan="2"> <strong>Asesor /Admin LSP  :</strong> </td> 
 </tr>

<tr nobr="true">
 
    <td> Nama </td>
    <td>  </td> 
 </tr>

<tr nobr="true">
 
    <td> No.Reg </td>
    <td>  </td> 
 </tr>


<tr nobr="true">
     
    <td> Tanda Tangan / Tanggal </td>
    <td style="height: 35px;">  </td> 
 </tr>



</table>
</page>

<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 64%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <h3>FR-APL-02 ASESMEN MANDIRI</h3>
<br/><br/>
<table style="width:100%">
    <tr  nobr="true">
        <td style="width: 20%;font-weight: bold;"> Nama Peserta</td>
        <td style="width: 35%;">: <?=strtoupper($data_asesi->nama_lengkap)?></td>
        <td style="width: 20%;font-weight: bold;">Tanggal/Waktu</td>
        <td style="width: 25%;">: <?=$data_asesi->u_date_create?></td>
    </tr>
    <tr  nobr="true">
        <td style="width: 20%;font-weight: bold;"> Nama Asesor</td>
        <td style="width: 35%;">:  </td>
        <td style="width: 20%;font-weight: bold;">TUK</td>
        <td style="width: 25%;">: </td>
    </tr>
</table> 
<br/>
<div style="left: -10px;">
    Pada bagian ini, anda diminta untuk menilai diri sendiri terhadap unit(unit-unit) kompetensi yang akan di-ases.
<br/>
    <table cellpadding="2" style="border-collapse: collapse;">
        <tr  nobr="true">
            <td style="width: 3%;">1.</td>
            <td style="width: 95%;text-align: justify;">Pelajari seluruh standar Kriteria Unjuk Kerja (KUK), batasan variabel, panduan penilaian dan aspek kritis serta yakinkan bahwa anda sudah benar-benar memahami seluruh isinya.</td>
        </tr>
        <tr  nobr="true">
            <td style="width: 3%;">2.</td>
            <td style="width: 95%;text-align: justify;">Laksanakan penilaian mandiri dengan mempelajari dan menilai kemampuan yang anda miliki secara obyektif terhadap seluruh
            daftar pertanyaan yang ada, serta tentukan apakah sudah kompeten (K) atau belum kompeten (BK) dengan mencantumkan tanda <B>V</b> 
            dan tuliskan bukti-bukti pendukung yang anda anggap relevan terhadap setiap elemen/KUK unit kompetensi.
            </td>
        </tr>
        <tr  nobr="true">
            <td style="width: 3%;">3.</td>
            <td style="width: 95%;text-align: justify;">Asesor dan Peserta menandatangani form Asesmen Mandiri</td>
        </tr>
    </table>
    <br />
</div>

    
<table border="1" cellpadding="2" style="border-collapse: collapse;" >
   
    <tr  nobr="true">
        <td style="font-weight: bolder;width: 30%;font-weight: bold;">Nomor Skema Sertifikasi</td>
        <td style="width: 70%;"> <?=$data_asesi->kode_skema?> </td>
    </tr>
    <tr  nobr="true">
        <td style="font-weight: bolder;font-weight: bold;">Judul Skema Sertifikasi</td>
        <td><?=$data_asesi->skema?></td>
    </tr>
    <tr  nobr="true">
        <td style="font-weight: bolder;font-weight: bold;" valign="middle">Kode Unit Kompetensi</td>
        <td style="margin-left: 20px;"><?=$kode_unit?>
        </td>
    </tr>
    <tr  nobr="true">
        <td style="font-weight: bold;" valign="middle">Judul Unit Kompetensi</td>
        <td><?=$unit?>
        </td>
    </tr>
</table>
<br/>
<table border="1"  cellpadding="2" style="border-collapse: collapse;width: 100%;font-size: 10px;">
    <tr  nobr="true">
        <td rowspan="2" style="text-align: center;font-weight: bold;width: 15%;background-color: #5DC8CD;">Unit Kompetensi</td>
        <td rowspan="2" style="text-align: center;font-weight: bold;width: 40%;background-color: #5DC8CD;">Daftar Pertanyaan <br/> (Assesmen Mandiri/Self Assesment)</td>
        <td colspan="2" style="text-align: center;font-weight: bold;width: 8%;background-color: #5DC8CD;">Penilaian</td>
        <td rowspan="2" style="text-align: center;font-weight: bold;width: 25%;background-color: #5DC8CD;">Bukti-bukti Pendukung</td>        
        <td colspan="4" style="text-align: center;font-weight: bold;width: 10%;background-color: #5DC8CD;">Diisi Asesor</td>
    </tr>
    <tr  nobr="true">
        <td style="text-align: center;font-weight: bold;background-color: #5DC8CD;width: 4%;">K</td>
        <td style="text-align: center;font-weight: bold;background-color: #5DC8CD;width: 4%;">BK</td>
        <td style="text-align: center;font-weight: bold;background-color: #5DC8CD;width: 5%;">V</td>
        <td style="text-align: center;font-weight: bold;background-color: #5DC8CD;width: 5%;">A</td>
        <td style="text-align: center;font-weight: bold;background-color: #5DC8CD;width: 5%;">T</td>
        <td style="text-align: center;font-weight: bold;background-color: #5DC8CD;width: 5%;">M</td>
    </tr> 
    <?php
    foreach($asesi_detail as $key=>$value){
        
    ?>
    <tr>
        <td style="width: 15%;text-align: center;" ><?=$value->unit_kompetensi_id ?></td>
        <td style="width: 40%;"><?=$value->elemen ?></td>
        <td style="text-align: center;width: 4%;">K</td>
        <td style="text-align: center;width: 4%;"></td>
        <td style="text-align: center;width: 25%;"><?=$value->jenis_bukti ?></td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
    </tr>
    <?php
    }
    ?>
</table>
<br />
 <table style="width:100%" border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
 <tr nobr="true">
    <td rowspan="3" style="width: 50%;"> <strong>Rekomendasi Asesor</strong> </td>
    <td colspan="2" style="width: 50%;"> <strong>Pemohon :</strong> </td> 
 </tr>

<tr nobr="true">
 
    <td style="width: 25%;"> Nama </td>
    <td style="width: 25%;"> <?=$data_asesi->nama_lengkap?> </td> 
 </tr>


<tr nobr="true">
     
    <td> Tanda Tangan / Tanggal </td>
    <td style="height: 35px;">  </td> 
 </tr>

 <tr nobr="true">
    <td rowspan="4"> <strong>Catatan :</strong> </td>
    <td colspan="2"> <strong>Asesor /Admin LSP  :</strong> </td> 
 </tr>

<tr nobr="true">
 
    <td> Nama </td>
    <td>  </td> 
 </tr>

<tr nobr="true">
 
    <td> No.Reg </td>
    <td>  </td> 
 </tr>


<tr nobr="true">
     
    <td> Tanda Tangan / Tanggal </td>
    <td style="height: 35px;">  </td> 
 </tr>



</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 54%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
<h4> FR-MAK-01 :  CEKLIS MENGASES KOMPETENSI  </h4>
<br/>
<table style="width:100%" border="1"  style="border-collapse: collapse;">
    <tr>
        <td style="width:15%;"> Nama Peserta </td>
        <td style="width:2%;"> : </td>
        <td style="width:35%;"> <?=$data_asesi->nama_lengkap?> </td>
        <td style="width:10%;"> Tanggal </td>
        <td style="width:2%;"> : </td>
        <td style="width:36%;">  </td>
    </tr>
    <tr>
        <td style="width:15%;"> Nama Asesor </td>
        <td style="width:2%;"> : </td>
        <td style="width:35%;">  </td>
        <td style="width:10%;"> Tempat </td>
        <td style="width:2%;"> : </td>
        <td style="width:36%;"> </td>
    </tr>
</table>
<br/>
<br/>

<table style="width:100%;font-size: 11px;" border="1"  style="border-collapse: collapse;">
    <tr style="text-align:center;">
        <td colspan="2" style="background-color:#5DC8CD ;width: 30%;"> LANGKAH </td>
        <td style="background-color:#5DC8CD ;width: 30%;"> SKENARIO </td>
        <td style="background-color:#5DC8CD ;width: 10%;"> KETERANGAN </td>
    </tr>
    <tr>
        <td colspan="4"> 1. Menyiapkan dan memelihara lingkungan asesmen </td>
         
    </tr>
    <tr>
        <td style="width:5%;"> 1.1 </td>
        <td style="width:30%; text-align:justify;">
        Tempatkan peserta sertifikasi di posisi yang nyaman sebagai salah satu cara untuk memberikan lingkungan asesmen 
        yang nyaman . </td>
        <td style="width:30%; text-align:justify;">Mengucapkan salam.
Mempersilahkan peserta duduk. 
Menegur sapa dan kabar.
Menayakan maksud dan tujuan
  </td>
        <td style="width:15%;">   </td> 
    </tr>
    <tr>
        <td style="width:5%;"> 1.2 </td>
        <td style="width:40%; text-align:justify;">Pastikan peserta anda sudah diterima menjadi peserta sertifikasi dan 
        benar-benar memiliki kompetensi yang akan diases. </td>
        <td style="width:40%; text-align:justify;">Membaca permohonan dan asesmen mandiri yang sudah diisi oleh 
        peserta anda direkomendasikan untuk mengikuti proses selanjutnya </td>
        <td style="width:20%;">   </td> 
    </tr>
    
    <tr>
        <td colspan="4"> 2. Mengumpulkan bukti yang berkualitas</td>
         
    </tr>
    <tr>
        <td style="width:5%;"> 2.1 </td>
        <td style="width:40%; text-align:justify;">Bersama peserta sertifikasi, kaji ulang acuan pembanding dan rencana 
        asesmen termasuk jenis bukti, metode, sumber daya yang akan digunakan pada asesmen.</td>
        <td style="width:40%; text-align:justify;">Memeriksa SKKNI, bukti langsung dan tidak langsung dan tambahan, 
        metode observasi, DPT, DPL dan sumber daya yang akan digunakan pada asesmen / tidak usah membawa apa-apa Karena 
        semua sudah di siapkan oleh organiser. </td>
        <td style="width:15%;">   </td> 
    </tr>
    <tr>
        <td style="width:5%;"> 2.2 </td>
        <td style="width:40%; text-align:justify;">Menerapkan prinsip asesmen dan aturan bukti dalam pengumpulan bukti 
        yang dijelaskan melaui MMA 01 yang telah dibuat.</td>
        <td style="width:40%; text-align:justify;">Menjelaskan prinsip asesmen dan aturan bukti dalam pengumpulan bukti. </td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 2.3 </td>
        <td style="width:40%; text-align:justify;">Menentukan kesempatan pengumpulan bukti pada saat bekerja atau dalam 
        aktifitas kerja yang disimulasikan bersama peserta berdasarkan APL 02 yang telah dikumpulkan bukti-buktinya.</td>
        <td style="width:40%; text-align:justify;">Bukti-bukti yang relevan telah anda penuhi sesuai dengan bidang 
        pekerjaan saudara berdasarkan asesmen mandiri yang saudara isi.</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 2.4 </td>
        <td style="width:40%; text-align:justify;">Mengidentifikasi kesempatan untuk aktifitas asesmen terpadu dan jika 
        memungkinkan memodifikasi perangkat asesmen.</td>
        <td style="width:40%; text-align:justify;">Perangkat yang dipergunakan adalah CLO, DPT, DPL dan Proses Wawancara</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 2.5 </td>
        <td style="width:40%; text-align:justify;">Membahas kebijakan yang relevan dan memastikan bahwa peserta mengerti 
        implikasinya.</td>
        <td style="width:40%; text-align:justify;">Menjelaskan prosedur dan ketentuan yang ada di LSP</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 2.6 </td>
        <td style="width:40%; text-align:justify;">Mendokumentasikan semua kesepakatan di atas lembar persetujuan termasuk
         persetujuan tanggal, tempat, waktu serta durasi asesmen lanjut.</td>
        <td style="width:40%; text-align:justify;">Menyampaikan Kapan asesi siap untuk di uji ?
Tanggal …, Tempat …. Dan lama  waktu pelaksanaan</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    
    <tr>
        <td colspan="4"> 3. Mendukung Peserta</td>
         
    </tr>
    <tr>
        <td style="width:5%;"> 3.1 </td>
        <td style="width:40%; text-align:justify;">Menempatkan peserta sertifikasi pada situasi yang nyaman sebagai 
        persiapan pembimbingan.</td>
        <td style="width:40%; text-align:justify;">Mengarahkan peserta untuk bisa mengikuti pelaksanaan program asesmen </td>
        <td style="width:15%;">   </td> 
    </tr>
    <tr>
        <td style="width:5%;"> 3.2 </td>
        <td style="width:40%; text-align:justify;">Menggunakan keterampilan komunikasi interpersonal pada saat menggunakan 
        perangkat asesmen, termasuk mengomunikasikan penyesuaian yang memungkinkan.</td>
        <td style="width:40%; text-align:justify;">Menilai sesuai dengan criteria unjuk kerja dan menyesuaikan perangkat
         yang akan di gunakan.</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 3.3 </td>
        <td style="width:40%; text-align:justify;">Menyediakan dukungan spesialis bila diperlukan.</td>
        <td style="width:40%; text-align:justify;">Menyampaikan tenaga spesialis yang akan membantu dalam pelaksaaan 
        asesmen.</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 3.4 </td>
        <td style="width:40%; text-align:justify;">Mengelola kesehatan dan keselamatan kerja pada saat pelaksanaan asesmen.</td>
        <td style="width:40%; text-align:justify;">Menyampaikan kepada peserta agar mengikuti standarr k3 yang telah di 
        tetapkan. Dan memberikan informasi kepada asesor apabila ada suatu kondisi yang mana asesi merasa tidak nyaman.</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 3.5 </td>
        <td style="width:40%; text-align:justify;">Mencatat hasil asesmen sesuai dengan metode dan  perangkat yang 
        digunakan.</td>
        <td style="width:40%; text-align:justify;">Melakukan pencatatan hasil asesmen sesuai dengan metode dan perangkat 
        yang dipergunakan.</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 3.6 </td>
        <td style="width:40%; text-align:justify;">Jika seluruh bukti sudah dikumpulkan, sediakan waktu untuk anda 
        mempertimbangkan hasil pengumpulan bukti.</td>
        <td style="width:40%; text-align:justify;">Memberikan waktu kepada peserta setelah melaksanakan asesmen untuk 
        menunggu hasil pengumpulan bukti pada tempat yang telah di sediakan sementara asesor merekap pelaksanaan asesmen.</td>
        <td style="width:15%;">   </td> 
    </tr>


    <tr>
        <td colspan="4"> 4. Membuat keputusan dan umpan balik asesmen</td>
         
    </tr>
    <tr>
        <td style="width:5%;"> 4.1 </td>
        <td style="width:40%; text-align:justify;">Pastikan peserta sertifikasi diberikan umpan balik yang konstruktif.</td>
        <td style="width:40%; text-align:justify;">Berikan peserta umpan balik yang dapat membangun kompetensi nya menjadi
         lebih baik lagi.</td>
        <td style="width:15%;">   </td> 
    </tr>
    <tr>
        <td style="width:5%;"> 4.2 </td>
        <td style="width:40%; text-align:justify;">Selesaikan dan tanda tangani laporan hail asesmen.</td>
        <td style="width:40%; text-align:justify;">Menandatangani semua format yang berkaitan dengan asesmen.</td>
        <td style="width:15%;">   </td> 
    </tr>
    
    <tr>
        <td style="width:5%;"> 4.3 </td>
        <td style="width:40%; text-align:justify;">Ucapkan selamat atau memberikan motivasi kepada peserta sertifikasi.</td>
        <td style="width:40%; text-align:justify;">Memberikan ucapan selamat dan motivasi yang baik kepada peserta agar 
        dapat mempergunakan hasil asesmen dengan tepat guna dan sasaran.</td>
        <td style="width:15%;">   </td> 
    </tr>
</table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 54%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
<h4> FR-MAK-02  :  FORMULIR BANDING ASESMEN </h4>
<br/>


<table style="width:100%" border="1"  style="border-collapse: collapse;">
    <tr>
        <td colspan="3" style="width:100%;"> Nama Peserta : <?=strtoupper($data_asesi->nama_lengkap)?></td>
         
    </tr>
    <tr>
        <td colspan="3" style="width:100%;"> Nama Asesor : </td>
         
    </tr>
    <tr>
        <td colspan="3" style="width:100%;"> Tanggal Asesmen : </td>
         
    </tr>
    <tr>
        <td style="width:80%;"> Jawablah dengan <strong>Ya</strong> atau <strong>Tidak</strong> pertanyaan-pertanyaan berikut ini :</td>
        <td style="width:10%; text-align=center;"> YA </td>
        <td style="width:10%; text-align=center;"> TIDAK </td>
    </tr>
    <tr>
        <td style="width:80%;"> Apakah Proses Banding telah dijelaskan kepada Anda? </td>
        <td style="width:10%;">   </td>
        <td style="width:10%;">   </td>
    </tr>
    <tr>
        <td style="width:80%;"> Apakah Anda telah mendiskusikan Banding dengan Asesor? </td>
        <td style="width:10%;">   </td>
        <td style="width:10%;">   </td>
    </tr>
    <tr>
        <td style="width:80%;"> Apakah Anda mau melibatkan “orang lain” membantu Anda dalam Proses Banding? </td>
        <td style="width:10%;">   </td>
        <td style="width:10%;">   </td>
    </tr>
    <tr>
        <td colspan="3" style="width:100%;">Banding ini diajukan atas Keputusan Asesmen yang dibuat terhadap Unit Kompetensi berikut :
        <br/> No. Unit Kompetensi   :
         <br/>
 Judul Unit Kompetensi :
</td>
</tr>
<tr>
        <td colspan="3" style="width:100%;"> Banding ini diajukan atas alasan sebagai berikut :
        <br/>
        <br/>
        <br/>
        <br/>
</td>
</tr>
<tr>
        <td colspan="3" style="width:100%;">Anda mempunyai hak mengajukan banding jika Anda mendapatkan hasil yang <strong>Tidak Sah</strong> dan/atau <strong>Proses Tidak Sah</strong> atau <strong>Tidak Adil</strong>. 
    <br/>   
</td>
</tr>
<tr>
        <td colspan="3" style="width:100%;">
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        Tanda tangan Asesi : ____________________________. Tanggal :  
</td></tr></table>
</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 54%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
<h4> FR-MAK-03  :  FORMULIR PERSETUJUAN ASESMEN DAN KERAHASIAAN </h4>
<br/>
<br/>

<table style="width:100%;" border="1" cellpadding="3" cellspacing="0">
    <tr>
        <td colspan="2"> Persetujuan Asesmen ini untuk menjamin bahwa Peserta telah diberi arahan secara rinci tentang proses asesmen </td>
         
    </tr>
    
    <tr>
        <td style="width:25%;">Nama Calon Peserta  </td>
        <td style="width:75%;"> <?=strtoupper($data_asesi->nama_lengkap)?></td>
    </tr>
    
    <tr>
        <td style="width:25%;">Nama Asesor  </td>
        <td style="width:75%;"> </td>
    </tr>
    
    <tr>
        <td style="width:25%;">Judul Skema Kompetensi  </td>
        <td style="width:75%;"> <?=strtoupper($data_asesi->skema)?></td>
    </tr>
    
    <tr>
        <td style="width:25%;">Bukti Yang Dikumpulkan :  </td>
        <td style="width:75%;"> <?=$jenis_bukti;?></td>
    </tr>
    
    <tr>
    <td colspan="2">Pelaksanaan asesmen akan dilaksanakan pada:
        <br/>
Hari/ Tanggal   : 
<br/>
Tempat      : 
</td>
         
    </tr>

<tr>
    <td colspan="2" ><strong>Peserta Sertifikasi:</strong>
    <br/>
    <br/>
<strong>Saya setuju mengikuti asesmen dengan pemahaman bahwa informasi yang dikumpulkan hanya digunakan untuk 
pengembangan profesional dan hanya dapat diakses oleh orang tertentu saja. 
</strong> 
</td>
         
    </tr>
<tr>
    <td colspan="2"><strong>Asesor:</strong>
    <br/>
    <br/>
<strong>Menyatakan tidak akan membuka hasil pekerjaan yang saya peroleh karena penugasan saya sebagai asesor
 dalam pekerjaan Asesmen kepada siapapun atau organisasi apapun selain kepada pihak yang berwenang sehubungan 
 dengan kewajiban saya sebagai Asesor yang ditugaskan oleh LSP. 
</strong> 
</td>
         
    </tr>
    
    <tr>
    <td colspan="2">  
    <br/>
    <br/>
Tanda tangan Peserta    : _____________________________         Tanggal : 
<br/>
<br/>
<br/>
<br/>
Tanda tangan Asesor     : _____________________________         Tanggal :  
<br/><br/>
 </td>
</tr>
    


</table>

</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 54%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
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
<h4> FR-MAK- 04 :  KEPUTUSAN DAN UMPAN BALIK ASESMEN </h4>
<br/>
<br/>

<table style="width:100%" border="0"  style="border-collapse: collapse;">
    <tr>
        <td style="width:25%;font-weight: bold;"> <strong>Skema Sertifikasi</strong> </td>
        <td style="width:4%;"> : </td>
        <td style="width:60%;"> <?=$data_asesi->skema?></td>
         
    </tr>
    
    <tr>
        <td style="width:25%;font-weight: bold;"> <strong>Nomor Skema </strong> </td>
        <td style="width:4%;"> : </td>
        <td style="width:60%;"> <?=$data_asesi->kode_skema?></td>
         
    </tr>
     
</table>


<br/>
<br/>

<table style="width:100%" border="1"  style="border-collapse: collapse;">
    <tr>
        <td style="width:15%;"> Nama Peserta </td>
        <td style="width:4%;"> : </td>
        <td style="width:30%;">  <?=strtoupper($data_asesi->nama_lengkap)?> </td>
        <td style="width:15%;"> Tanggal Waktu </td>
        <td style="width:4%;"> : </td>
        <td style="width:32%;"> </td>
    </tr>
    <tr>
        <td style="width:15%;"> Tim Asesor </td>
        <td style="width:4%;"> : </td>
        <td style="width:30%;">   </td>
        <td style="width:15%;"> Tempat </td>
        <td style="width:4%;"> : </td>
        <td style="width:32%;">   </td>
    </tr>
</table>

<br/>
<br/>
<table style="width:100%" border="0"  style="border-collapse: collapse;">
    <tr>
        <td colspan="2" style="width:100%;"> <strong>Penjelasan untuk Asesor :</strong> </td>
         
    </tr>
    <tr>
        <td style="width:5%;">1.</td>
        <td style="width:85%;">Asesor mengorganisasikan pelaksanaan asesmen berdasarkan metoda dan instrumen/sumber-sumber asesmen seperti yang tercantum dalam perencanaan asesmen. </td>
    </tr>
    <tr>
        <td style="width:5%;">2.</td>
        <td style="width:85%;">Asesor melaksanakan kegiatan pengumpulan bukti serta mendokumentasikan seluruh bukti pendukung yang dapat ditunjukkan oleh Asesi sesuai dengan kriteria unjuk kerja yang dipersyaratkan. </td>
    </tr>
    <tr>
        <td style="width:5%;">3.</td>
        <td style="width:85%;">Asesor membuat keputusan apakah Asesi sudah Kompeten <strong>(K)</strong>,  Belum kompeten <strong>(BK)</strong> atau Asesmen Lanjut (AL), untuk setiap kriteria unjuk kerja berdasarkan bukti-bukti. </td>
    </tr>
    <tr>
        <td style="width:5%;">4.</td>
        <td style="width:85%;">Asesor mengorganisasikan pelaksanaan asesmen berdasarkan metoda dan instrumen/sumber-sumber asesmen seperti yang tercantum dalam perencanaan asesmen. </td>
    </tr>
    <tr>
        <td style="width:5%;">5.</td>
        <td style="width:85%;">Asesor mengorganisasikan pelaksanaan asesmen berdasarkan metoda dan instrumen/sumber-sumber asesmen seperti yang tercantum dalam perencanaan asesmen. </td>
    </tr>
    <tr>
        <td style="width:5%;">6.</td>
        <td style="width:85%;">Asesor mengorganisasikan pelaksanaan asesmen berdasarkan metoda dan instrumen/sumber-sumber asesmen seperti yang tercantum dalam perencanaan asesmen. </td>
    </tr>
    
    
</table>

<br/>
<br/>
<h4> PENCAPAIAN KOMPETENSI: </h4>
<?=$elemen_kuk?>


<br/>
<br/>
<br/>

<table style="width:100%" border="1"  style="border-collapse: collapse;">
<tr>
    <td> <strong>Umpan balik terhadap pencapaian unjuk kerja : </strong> 
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    </td>
</tr>

<tr>
    <td> <strong>Identifikasi kesenjangan pencapaian unjuk kerja : </strong> 
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    </td>
</tr>

<tr>
    <td style="width:100%;"> <strong>Saran tindak lanjut hasil asesmen  : </strong> 
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    </td>
</tr>

</table>

<br/>
<br/>
<table style="width:100%" border="1"  style="border-collapse: collapse;">
   <tr>
    <td style="width:40%;"><strong>Rekomendasi Asesor :</strong></td>
    <td colspan="2" style="width:60%;"><strong>Peserta :</strong></td>
  </tr>
  <tr>
    <td rowspan="6" style="width: 40%;">&nbsp;</td>
    <td style="width:30%;">Nama</td>
    <td style="width:30%;"><?=strtoupper($data_asesi->nama_lengkap)?> </td>
  </tr>
  <tr>
    <td>Tanda Tangan &amp; Tanggal</td>
    <td><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p></p></td>
  </tr>
  <tr>
    <td><strong>Asesor :</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td></td>
  </tr>
  <tr>
    <td>No.Reg</td>
    <td></td>
  </tr>
  <tr>
    <td><p>&nbsp;</p>
       
    <p>Tanda Tangan &amp; Tanggal</p>
    
    </td>
    <td><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p></p></td>
  </tr>
</table>

</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 54%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>

<h4> FR-MAK-05  :  UMPAN BALIK DARI ASESI </h4>
<br/>
<br/>
<table style="width:100%" border="1"  style="border-collapse: collapse;">
  <tr align="center">
    <td rowspan="2" style="width:45%;">Komponen</td>
    <td colspan="2" style="width:16%;">Hasil</td>
    <td rowspan="2" style="width:49%;">Catatan / Komentar Asesi</td>
  </tr>
  
  <tr align="center">
    <td style="width:8%;">Ya</td>
    <td style="width:8%;">Tidak</td>
  </tr>
  
  <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">1. </td>
        <td style="width:95%;">Saya mendapatkan penjelasan yang cukup memadai mengenai proses asesmen/uji kompetensi </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">2. </td>
        <td style="width:95%;">Asesor memberikan kesempatan untuk mendiskusikan/ menegosiasikan metoda, 
        instrumen dan sumber asesmen serta jadwal asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">3. </td>
        <td style="width:95%;">Asesor berusaha menggali seluruh bukti pendukung yang sesuai dengan latar belakang pelatihan dan pengalaman yang saya miliki </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
  <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">4. </td>
        <td style="width:95%;">Saya mendapatkan jaminan kerahasiaan hasil asesmen serta penjelasan penanganan dokumen asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">5. </td>
        <td style="width:95%;">Saya sepenuhnya diberikan kesempatan untuk mendemonstrasikan kompetensi yang saya miliki selama asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">6. </td>
        <td style="width:95%;">Saya mendapatkan penjelasan yang memadai mengenai keputusan asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">7. </td>
        <td style="width:95%;">Asesor memberikan umpan balik yang mendukung setelah asesmen serta tindak lanjutnya </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
   <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">8. </td>
        <td style="width:95%;">Asesor menggunakan keterampilan komunikasi yang efektif selama asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
    <tr>
     <td style="width:45%;">
    <table border="0"  style="border-collapse: collapse;">
      <tr style="text-align:justify;">
        <td style="width:3%;">9. </td>
        <td style="width:95%;">Asesor bersama saya menandatangani semua dokumen hasil asesmen </td>
        </tr>
    </table>
    </td>
     <td style="width:8%;">&nbsp;</td>
    <td style="width:8%;">&nbsp;</td>
    <td style="width:49%;">&nbsp;</td>
   </tr>
</table>

</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 54%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>

<h4> FR-MAK-06  :  FORMULIR LAPORAN ASESMEN </h4>

<br/>
<table style="width:100%" border="1"  style="border-collapse: collapse;">
  <tr>
    <td style="width:20%;font-weight: bold;" >Nama Peserta</td>
    <td style="width:30%;" ><?=strtoupper($data_asesi->nama_lengkap)?></td>
    <td colspan="2" style="width:20%;font-weight: bold;" >Nama Asesor</td>
    <td style="width:30%;" ></td>
  </tr>
  <tr>
    <td style="width:20%;font-weight: bold;">Tanggal Pencapaian Kompetensi :</td>
    <td style="width:30%;"></td>
    <td colspan="2" style="width:20%;text-align: center;font-weight: bold;">Tanda Tangan Asesor dan Tanggal :</td>
    <td style="width:30%;"></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold;" colspan="2">Unit Kompetensi</td>
    <td style="text-align: center;font-weight: bold;">K</td>
    <td style="text-align: center;font-weight: bold;">BK</td>
    <td style="font-weight: bold;">Keterangan</td>
  </tr>
  <?=$unit_mak?>
</table>

<br/>
<table style="width:100%;border-collapse: collapse;" border="1"  >
  <tr align="center">
    <td style="width:35%;font-weight: bold;" >Aspek Negatif dan Positif Dalam Asesmen</td>
    <td style="width:35%;font-weight: bold;" >Pencatatan Penolakan Hasil Asesmen</td>
    <td style="width:35%;font-weight: bold;" >Saran Perbaikan :
(Asesor/Personil  Terkait)</td>
  </tr>
  <tr>
    <td style="height: 150px;width:33%;"> <br/> <br/> </td>
    <td style="width:33%;"> <br/> <br/> </td>
    <td style="width:34%;"> <br/> <br/> </td>
  </tr>
  <tr>
    <td colspan="3"><p>Kode File : (Diisi oleh LSP)</p></td>
  </tr>
</table>

<br/>
<br/>
<b> Catatan : Format dapat dimodifikasi sesuai dengan jumlah unit kompetensi yang diases </b>
 
<br/>
<br/>

</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm" >
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 54%;font-weight: lighter;"><?=$aplikasi->nama_unit?></td>
                
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 11%"><?=$aplikasi->singkatan_unit?> :
                </td>
                <td style="text-align: left;    width: 49%"> <?=$aplikasi->alamat?> <?=$aplikasi->no_telpon?></td>
                <td style="text-align: right;    width: 40%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    
    <h4> FR-MAK-07  :  MENINJAU PROSES ASESMEN </h4>
<br>
<table style="width:100%;border-collapse: collapse;" border="1"  >
    <tr>
        <td style="width:40%;"> <strong>Skema Sertifikasi (Unit/klaster/kualifikasi)</strong> </td>
        <td style="width:4%;text-align: center;"> : </td>
        <td style="width:55%;"><?=$data_asesi->skema?></td>
         
    </tr>
    
    <tr>
        <td style="width:40%;"> <strong>Nomor Skema Sertifikasi     </strong> </td>
        <td style="width:4%;text-align: center;"> : </td>
        <td style="width:55%;"><?=$data_asesi->kode_skema?></td>
         
    </tr>
     
</table>
<br>
<table style="width:100%;border-collapse: collapse;" border="1"  >
    <tr>
        <td colspan="2" style="width:100%;"> <strong> Penjelasan :</strong> </td>
         
    </tr>
    <tr>
        <td style="width:5%;"> 1.</td>
        <td style="width:85%;"> Kaji ulang sebaiknya dilakukan oleh Asesor yang melakukan supervisi terhadap pelaksanaan asesmen.. </td>
    </tr>
    <tr>
        <td style="width:5%;"> 2.</td>
        <td style="width:85%;"> Bila dilakukan oleh asesor pelaksana asesmen, maka dilakukan setelah selesai seluruh proses pelaksanaan asesmen. </td>
    </tr>
    <tr>
        <td style="width:5%;"> 3.</td>
        <td style="width:85%;"> Kaji ulang dapat dilakukan secara integrasi dalam suatu skema sertifikasi dan/atau kandidat kelompok yang homogen. </td>
    </tr>
  
    

</table>
<br>
<br>

<table style="width:100%;border-collapse: collapse;" border="1"  >
  <tr align="center">
    <td style="width:55%;" rowspan="2"><strong> Aspek yang dikaji ukang</strong></td>
    <td colspan="4" style="width:45%;"><strong> Pemenuhan terhadap prinsip - prinsip Asesmen</strong></td>
  </tr>
  <tr align="center">
    <td style="width:11%;"><em>Valid</em></td>
    <td style="width:11%;"><em>Reliable</em></td>
    <td style="width:11%;"><em>Flexible</em></td>
    <td style="width:12%;"><em>Fair</em></td>
  </tr>
  <tr>
    <td><p><strong> Prosedur Asesmen:</strong></p>
    <p> Perencanaan asesmen</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Pra asesmen</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Pelaksanaan asesmen</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Keputusan asesmen</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Umpan balik asesmen</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Pencatatan asesmen</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"> Rekomendasi perbaikan :
    <p>&nbsp;</p></td>
  </tr>
</table>

<br>


<table style="width:100%;border-collapse: collapse;" border="1"  >
 <tr align="center">
    <td style="width:55%;" rowspan="2"><strong> Aspek yang dikaji ulang</strong></td>
    <td colspan="4" style="width:45%;"><strong> Pemenuhan terhadap Dimensi Kompetensi</strong></td>
  </tr>
  <tr align="center">
    <td style="width:11%;font-size: 10px;"><em>Task Skill</em></td>
    <td style="width:11%;font-size: 10px;"><em>Task Management Skill</em></td>
    <td style="width:11%;font-size: 10px;"><em>Contingency Management Skill</em></td>
    <td style="width:12%;font-size: 10px;"><em>Environment Management Skill</em></td>
  </tr>
  <tr>
    <td style="width:55%;"><p><strong> Konsistensi keputusan asesmen</strong></p>
      <p>&nbsp; Bukti dari rentang asesmen di periksa terhadap  </p>
      <p>&nbsp; konsisten dimensi kompetensi</p>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="height: 90px;"> Rekomendasi perbaikan : 
    </td>
  </tr>
</table>
</page>