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
    <h4> SURAT TUGAS ASESOR UJI KOMPETENSI </h4>
    Nama Jadwal : <?=$jadwal->jadual?><br />
    Tanggal Uji Kompetensi : <?=tgl_indo($jadwal->tanggal).' - '.tgl_indo($jadwal->tanggal_akhir)?><br /><br />

   <table style="width:100%" border="1"  style="border-collapse: collapse;">
  <tr nobr="true">
    <td colspan="2" style="width:30%;text-align: left;"><strong>MENUGASKAN SEBAGAI ASESOR KOMPETENSI</strong></td>

  </tr>
   <tr>
        <th style="width:30%;text-align: center;"> No Registrasi </th>
        <th style="width:30%;text-align: center;"> Nama Asesor  </th>
    </tr>
   <?php foreach ($asesor as $key => $value) {
    ?>
    <tr>
        <td style="width:30%;text-align: center;"> <?=$value->no_reg?></td>
        <td style="width:70%;text-align: center;"> <?=$value->users?>  </td>
    </tr>
    <?php
        $skema_sertifikasi = $value->skema;
        $id_skema = $value->id_skema;
    } ?>


</table>
<br/>
<table style="width:100%" border="1"  style="border-collapse: collapse;">
  <tr nobr="true">
    <td style="width:30%;text-align: left;">SKEMA SERTIFIKASI</td>
    <td style="width:70%;text-align: left;"><?=$skema_sertifikasi?></td>

  </tr>
   <tr>
        <th style="width:30%;text-align: center;"> Kode Unit Kompetensi </th>
        <th style="width:30%;text-align: left;"> Unit Kompetensi  </th>
    </tr>
   <?php foreach ($unit_kompetensi as $key => $value) {
    ?>
    <tr>
        <td style="width:30%;text-align: center;"> <?=$value->id_unit_kompetensi?></td>
        <td style="width:70%;text-align: left;"> <?=$value->unit_kompetensi?>  </td>
    </tr>
    <?php } ?>


</table>

<br/><br/><br/>
<table style="width:100%" border="0"  style="border-collapse: collapse;">
  <tr nobr="true">
    <td style="width:70%;text-align: left;"></td>
    <td style="width:30%;text-align: center;">Dikeluarkan di : Surabaya</td>

  </tr>
  <tr nobr="true">
    <td style="width:70%;text-align: left;height:100px;"></td>
    <td style="width:30%;text-align: center;"></td>

  </tr>
  <tr nobr="true">
    <td style="width:70%;text-align: left;"></td>
    <td style="width:30%;text-align: center;">DIREKTUR LSP COHESPA</td>

  </tr>
  <tr nobr="true">
    <td style="width:70%;text-align: left;"></td>
    <td style="width:30%;text-align: center;">(<?=$aplikasi->ketua?>)</td>

  </tr>

</table>

</page>

<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
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
    <h4> DAFTAR PESERTA UJI KOMPETENSI </h4>
     <table style="width:100%" border="1"  style="border-collapse: collapse;">

   <tr>
        <th style="width:30%;text-align: center;"> No Uji Kompetensi </th>
        <th style="width:30%;text-align: center;"> Nama Asesi  </th>
        <th style="width:30%;text-align: center;"> Nama Asesor  </th>
    </tr>
   <?php foreach ($data_asesi as $key => $value) {
    ?>
    <tr>
        <td style="width:30%;text-align: center;"> <?=$value->no_uji_kompetensi?></td>
        <td style="width:35%;text-align: center;"> <?=strtoupper($value->nama_lengkap)?>  </td>
        <td style="width:35%;text-align: center;"> <?=$value->users?>  </td>
    </tr>
    <?php

    } ?>


</table>


</page>
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url().'assets/img/logo48.png';?>" /></td>
                <td style="text-align: left;    width: 44%;font-weight: lighter;">
                    <?=$aplikasi->nama_unit?>
                </td>
                <td style="text-align: right;    width: 40%"><img src="<?php echo base_url().'assets/img/logobnsp.png';?>" /></td>

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
    <br/>
    <br/>
    <br/>
    <h3 style="text-align:center;"> SURAT TUGAS  </h3>
    <h6 style="text-align:center; margin-top:-10px;">Nomor : <?=$no_surat_tugas_pra?></h6>
    <h5 style="text-align:center;"> Tentang Pelaksanaan Pra Asesmen </h5>
<h5 style="text-align:center;">    </h5>
   <br /><br />
<div>Yang bertanda tangan di bawah ini Ketua LEMBAGA SERTIFIKASI PROFESI (LSP) COHESPA, dengan ini memberi tugas kepada :</div>
<br/>


   <table style="width:100%" border="1"  style="border-collapse: collapse;">
   <tr>
        <th style="width:30%;text-align: center;"> No Registrasi </th>
        <th style="width:30%;text-align: center;"> Nama Asesor  </th>
    </tr>
   <?php foreach ($asesor_pra_asesmen as $key => $value) {
    ?>
    <tr>
        <td style="width:30%;text-align: center;"> <?=$value->no_reg?></td>
        <td style="width:70%;text-align: center;"> <?=$value->nama_user?>  </td>
    </tr>
    <?php

    } ?>


</table>
<br/>
<div>Untuk melaksanakan Pra Assesmen sebagai Asesor Kompetensi pada jadwal <b><?=$jadwal->jadual?></b> pada tanggal <b><?=tgl_indo($jadwal->tanggal).' s/d '.tgl_indo($jadwal->tanggal_akhir)?> </b>dengan skema dan daftar peserta terlampir.</div>
<br/>
<div>Setelah Saudara/I melaksanakan tugas, mohon menyampaikan laporan kegiatan kepada Sdr/I Direktur LSP Cohespa.</div>
<br/>
<div>Demikian Surat Tugas ini untuk dilaksanakan dengan penuh tanggung jawab.</div>

<br/><br/><br/><br/><br/>
<table style="width:100%" border="0"  style="border-collapse: collapse;">
  <tr nobr="true">
    <td style="width:70%;text-align: left;"></td>
    <td style="width:30%;text-align: center;">Surabaya, <?=tgl_indo($jadwal->tanggal)?></td>

  </tr>
  <tr nobr="true">
    <td style="width:70%;text-align: left;"></td>
    <td style="width:30%;text-align: center;">DIREKTUR LSP Home Depo</td>

  </tr>
  <tr nobr="true">
    <td style="width:70%;text-align: left;height:80px;"></td>
    <td style="width:30%;text-align: center;"></td>

  </tr>

  <tr nobr="true">
    <td style="width:70%;text-align: left;"></td>
    <td style="width:30%;text-align: center;"><?=$aplikasi->ketua?></td>

  </tr>

</table>

</page>
