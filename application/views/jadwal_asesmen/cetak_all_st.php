<style>
td,th{
    padding: 1mm;
}
div,p{
    font-family: arial;
}
</style>
<page backtop="10mm" backbottom="10mm" backleft="15mm" backright="15mm">
    <page_header>
        <div style="margin-left: 555px; ">
            <img src="<?php echo base_url().'assets/img/logo.png';?>" width="70" height="70" />
        </div>
        <div style="float: left; margin-top: -65px; margin-left:  80px;">
            <img src="<?php echo base_url().'assets/img/bnsp_logo.png';?>" width="125" height="65" />
        </div>
        <br />
        <p style="font-size: 18px; font-weight: bold; margin-top:-10px;" align="center" >
            <?=$aplikasi->nama_unit?>
        </p>
        <hr style="width: 100%;">
    </page_header>
    <page_footer>
            <p>
            <div style="color: red; font-size: 20px; font-weight:bold; text-align: center;">Sekretariat</div>
            <div style="text-align: center; font-weight: bold;"><?=$aplikasi->alamat?></div>
            <div style="text-align: center; font-weight: bold;">Telp./Fax.: <?=$aplikasi->no_telpon?>/<?=$aplikasi->no_fax?></div>
            <div style="text-align: center; font-weight: bold; font-style: italic;">e-mail: <?=$aplikasi->alamat_email?> , web-site : www.<?=$aplikasi->url_aplikasi?></div>
            </p>
    </page_footer>
    <h2 style="text-decoration: underline; margin-top: 100px;" align="center">SURAT TUGAS</h2>

    <h5 align="center" style="margin-top: -15px;">No : <?=$no_st?></h5>

    <h4 align="center" style="font-style: italic; font-weight: 0; margin-top:-5px;">Tentang</h4>
    <p style="font-weight: bold; font-size:16px; margin-top: -5px;" align="center">
        Pelaksanaan
        <br>
        Uji Kompetensi Profesi Sektor Pariwisata
    </p>

    <table  border="0" style="width:100%;" >
        <tr>
            <td style="width:17%;vertical-align: top;">Pertimbangan :</td>
            <td style="width:5%;vertical-align: top;">1.</td>
            <td style="width:77%;text-align: justify;">bahwa berdasarkan Keputusan Rapat Pengurus <?=$aplikasi->singkatan_unit?>, Uji Kompetensi <?=$skema_sertifikasi?> bagi para peserta uji yang dilaksanakan pada tanggal <?=tgl_indo($jadual_asesmen->tanggal)?> s/d <?=tgl_indo($jadual_asesmen->tanggal_akhir)?></td>
        </tr>
        <tr>
            <td style="width:17%;vertical-align: top;"></td>
            <td style="width:5%;vertical-align: top;">2.</td>
            <td style="width:77%;text-align: justify;">bahwa dalam rangka pelaksanaan Uji Kompetensi tersebut, dibutuhkan adanya Penanggung Jawab, Asesor, Penyelenggara dan Penyusun Laporan Uji Kompetensi sehingga perlu ditunjuk petugas</td>
        </tr>
        <tr>
            <td style="width:17%;vertical-align: top;">Dasar :</td>
            <td colspan="2" style="width:82%;text-align: justify;">Surat Keputusan Ketua <?=$aplikasi->nama_unit?> Nomor: <?=$no_st?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;">M e n u g a s k a n </td>
        </tr>
        <tr>
            <td style="width:17%;vertical-align: top;">Kepada :</td>
            <td colspan="2" style="width:82%;text-align: justify;">Para Petugas yang namanya tercantum pada lampiran Surat Tugas ini</td>
        </tr>
         <tr>
            <td style="width:17%;vertical-align: top;">Untuk :</td>
            <td style="width:5%;vertical-align: top;">1.</td>
            <td style="width:77%;text-align: justify;">Mempersiapkan sarana dan prasarana Uji Kompetensi mulai dari tanggal <?=$tanggal_persiapan?></td>
        </tr>
        <tr>
            <td style="width:17%;vertical-align: top;"></td>
            <td style="width:5%;vertical-align: top;">2.</td>
            <td style="width:77%;text-align: justify;">Dalam melaksanakan tugasnya perlu memperhatikan hal-hal sebagai berikut <br/>
            <ol style="margin-bottom: -10px;margin-top: -10px;margin-left: -20px;list-style: none;list-style-type: lower-alpha;">
                <li>Data kelengkapan Uji Kompetensi</li>
                <li>Membawa peralatan masing-masing, antara lain Kalkulator, Flashdisk, Laptop dan Alat Tulis</li>
                <li>Menjelang Pelaksanaan Uji Kompetensi diadakan Rapat Persiapan Uji antara Penanggung Jawab, Penyelenggara dan Asesor</li>
                <li>Uji Kompetensi Profesi Sektor Pariwisata diadakan pada <?=tgl_indo($jadual_asesmen->tanggal)?> s/d <?=tgl_indo($jadual_asesmen->tanggal_akhir)?> 06.30 – 17.00 WIB</li>
            </ol>
            </td>
        </tr>
        <tr>
            <td style="width:17%;vertical-align: top;"></td>
            <td style="width:5%;vertical-align: top;">3.</td>
            <td style="width:77%;text-align: justify;">Melaksanakan tugas dengan sebaik-baiknya dan melaporkan hasil pelaksanaan tugasnya kepada Ketua <?=$aplikasi->singkatan_unit?></td>
        </tr>
        <tr>
            <td style="width:17%;vertical-align: top;"></td>
            <td style="width:5%;vertical-align: top;">4.</td>
            <td style="width:77%;text-align: justify;">Surat Tugas ini berlaku terhitung mulai tanggal dikeluarkan</td>
        </tr>
    </table>

    <div style="margin-left: 380px;margin-top: 20px;">
        Dikeluarkan di : B a n d u n g
        <p style="text-decoration: underline;">
        Pada tanggal : <?=tgl_indo($jadual_asesmen->tanggal)?></p>
        <p style="margin-left: 50px; font-weight: bold;">
            Ketua <?=$aplikasi->singkatan_unit?>
        </p>
        <div style="font-weight: bold; margin-left: 70px; "><qrcode style="margin-left: 150px;" value="<?php echo $qr_ketua_lsp; ?>" ec="Q" style="width: 20mm;"></qrcode></div>
        <div style="font-weight: bold; margin-left: 50px; margin-top: 10px;"><?=$aplikasi->ketua?></div>
    </div>
    <div style="text-decoration: underline; font-style: italic; font-weight: bold;">Disampaikan kepada yth</div>
    Para Penanggung Jawab, Penyelenggara, Asesor<div></div>
    <div style="text-decoration: underline; font-style: italic; font-weight: bold;">Tembusan kepada yth </div>
    Arsip
</page>

<page backtop="35mm" backbottom="20mm" backleft="20mm" backright="20mm">
    <page_header>
        <div style="margin-left: 555px; ">
            <img src="<?php echo base_url().'assets/img/logo.png';?>" width="70" height="70" />
        </div>
        <div style="float: left; margin-top: -65px; margin-left:  80px;">
            <img src="<?php echo base_url().'assets/img/bnsp_logo.png';?>" width="125" height="65" />
        </div>
        <br />
        <p style="font-size: 18px; font-weight: bold; margin-top:-10px;" align="center" >
            <?=$aplikasi->nama_unit?>
        </p>
        <hr style="width: 100%;">
    </page_header>
    <page_footer>

            <p>
            <div style="color: red; font-size: 20px; font-weight:bold; text-align: center;">Sekretariat</div>
            <div style="text-align: center; font-weight: bold;"><?=$aplikasi->alamat?></div>
            <div style="text-align: center; font-weight: bold;">Telp./Fax.: <?=$aplikasi->no_telpon?>/<?=$aplikasi->no_fax?></div>
            <div style="text-align: center; font-weight: bold; font-style: italic;">e-mail: <?=$aplikasi->alamat_email?> , web-site : www.<?=$aplikasi->url_aplikasi?></div>
            </p>
    </page_footer>
    <div style="font-family: arial, sans-serif; margin-top: 5px; font-size: 16px; margin-left: 300px;">
        Lampiran Surat Tugas <div></div>
        Nomor &nbsp;&nbsp;: <?=$no_st?> <div></div>
        Tanggal : <?=tgl_indo($jadual_asesmen->tanggal)?>
    </div>
    

    <table border="1" style="margin-top: 10px;width: 100%; border-collapse: collapse; text-align: center;">
        <tr>
            <th>NO</th>
            <th>NAMA ASESI</th>
            <th>ASESOR KOMPETENSI</th>
            <th>JUDUL UNIT</th>
        </tr>
        <?php foreach ($st_asesor as $keys => $values) { ?>

        <tr>
            <td style="width: 5%;"><?=($keys + 1)?></td>
            <td style="width: 20%;"><?=$values['nama_calon']?></td>
            <td style="width: 30%;text-align: left;"><?=$values['nama_asesor']?></td>
            <td style="width: 45%;text-align: left;"><?=$values['judul_unit']?></td>
        </tr>
        <?php } ?>
    </table>
   

</page>
<page backtop="35mm" backbottom="20mm" backleft="20mm" backright="20mm">
    <page_header>
        <div style="margin-left: 555px; ">
            <img src="<?php echo base_url().'assets/img/logo.png';?>" width="70" height="70" />
        </div>
        <div style="float: left; margin-top: -65px; margin-left:  80px;">
            <img src="<?php echo base_url().'assets/img/bnsp_logo.png';?>" width="125" height="65" />
        </div>
        <br />
        <p style="font-size: 18px; font-weight: bold; margin-top:-10px;" align="center" >
            <?=$aplikasi->nama_unit?>
        </p>
        <hr style="width: 100%;">
    </page_header>
    <page_footer>

            <p>
            <div style="color: red; font-size: 20px; font-weight:bold; text-align: center;">Sekretariat</div>
            <div style="text-align: center; font-weight: bold;"><?=$aplikasi->alamat?></div>
            <div style="text-align: center; font-weight: bold;">Telp./Fax.: <?=$aplikasi->no_telpon?>/<?=$aplikasi->no_fax?></div>
            <div style="text-align: center; font-weight: bold; font-style: italic;">e-mail: <?=$aplikasi->alamat_email?> , web-site : www.<?=$aplikasi->url_aplikasi?></div>
            </p>
    </page_footer>
     <div style="font-family: arial, sans-serif; font-weight: bold; text-transform: uppercase; font-size: 16px; padding-top:25px;">DAFTAR PENANGGUNGJAWAB, ASESOR DAN PELAKSANA</div>

    <table border="1" style="width: 100%; border-collapse: collapse; text-align: center; margin-top: 10px;">
        <thead>
            <tr>
                <th colspan="5">TUK <?=$tuk?> </th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td style="width: 5%; font-weight: bold;">NO</td>
                <td style="width: 40%; font-weight: bold;">NAMA</td>
                <td style="width: 20%; font-weight: bold;">NO REGISTER</td>
                <td style="width: 25%; font-weight: bold;">KETERANGAN</td>
            </tr>
            <?php foreach ($asesor_kompetensi as $keyx => $valuex) { ?>
            <tr>
                <td><?=($keyx + 1)?></td>
                <td><?=$valuex->users?></td>
                <td><?=$valuex->no_reg?></td>
                <td><?=$jenis_asesor[$valuex->jenis_asesmen]?></td>

            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div style="margin-left: 350px;margin-top: 50px;">
        Dikeluarkan di : B a n d u n g
        <p style="text-decoration: underline;">
        Pada tanggal : <?=tgl_indo($jadual_asesmen->tanggal)?></p>
        <p style="margin-left: 50px; font-weight: bold;">
            Ketua <?=$aplikasi->singkatan_unit?>
        </p>
        <div style="font-weight: bold; margin-left: 70px; "><qrcode style="margin-left: 150px;" value="<?php echo $qr_ketua_lsp; ?>" ec="Q" style="width: 20mm;"></qrcode></div>
        <div style="font-weight: bold; margin-left: 50px; margin-top: 10px;"><?=$aplikasi->ketua?></div>
    </div>
    <div style="text-decoration: underline; font-style: italic; font-weight: bold;">Disampaikan kepada yth</div>
    Para Penanggung Jawab, Penyelenggara, Asesor<div></div>
    <div style="text-decoration: underline; font-style: italic; font-weight: bold;">Tembusan kepada yth </div>
    Arsip

</page>
