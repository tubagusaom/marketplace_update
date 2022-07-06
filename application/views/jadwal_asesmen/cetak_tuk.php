<style>
    td,th{
        padding: 1mm;
    }
</style>

<page backtop="10mm" backbottom="10mm" backleft="5mm" backright="5mm" ">
    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%"><img src="<?php echo base_url() . 'assets/img/logo48.png'; ?>" /></td>
                <td style="text-align: left;    width: 44%;font-weight: lighter;"><?= $konfigurasi->nama_unit ?></td>

            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 20%"><?= $konfigurasi->singkatan_unit ?> :
                </td>
                <td style="text-align: left;    width: 35%"> <?= $konfigurasi->alamat ?> <?= $konfigurasi->no_telpon ?></td>
                <td style="text-align: right;    width: 45%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <h4>DAFTAR PESERTA UJI KOMPETENSI</h4>


    <?php
    $noxx = 1;
    $no_urut = 1;
    $datax = '';
    $maping_asesor = '';
    foreach ($nama_mahasiswa as $key => $value) {
        $datax .= '<tr height="500">
    <td style="width:3%;text-align:center"> ' . $noxx . '  <br> </td>
    <td style="width:19%;text-align:center"> ' . $value->nim_calon . '  <br> </td>
    <td style="width:16%;text-align:center"> <qrcode value="' . $value->nama_calon . ' - ' . $value->nim_calon . ' ' . $konfigurasi->url_aplikasi . '/qrcode/asesi/' . $value->nim_calon . '" ec="Q" style="width: 15mm;"></qrcode></td>
    <td style="width:27%;"> ' . strtoupper($value->nama_calon) . '   <br> </td>';
        if ($noxx % 2 != 0) {
            $datax .= '<td style="width:17%;" rowspan="2"> ' . $no_urut . '......   <br> </td>
            <td style="width:18%;" rowspan="2"> ' . ($no_urut + 1) . '......   <br> </td>
        ';
        }
        $datax .= '</tr>';
        $noxx++;
        $no_urut++;
    }

    foreach ($asesor as $key => $value) {
        $maping_asesor .= '
            <tr>
                <td style="width: 5%; text-align: center;"> '. ($key + 1) .' </td>
                <td style="width: 25%; text-align: center;"> '. strtoupper($value->no_reg) .' </td>
                <td style="width: 70%; text-align: center;"> '. strtoupper($value->users) .' </td>
            </tr>
        ';
    }
    ?> 
    Nama Jadwal :  <?= $jadwal->jadual ?><br />
    Tanggal Uji Kompetensi : <?= tgl_indo($jadwal->tanggal) . ' - ' . tgl_indo($jadwal->tanggal_akhir) ?><br />
    Status : Disetujui

    <?php
    if (count($nama_mahasiswa) > 0) {
        ?>
        <table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
            <tr style="font-weight:bold;">
                <td style="width:3%;text-align: center;"> No </td>
                <td style="width:19%;text-align: center;"> NIM</td>
                <td style="width:16%;text-align: center;"> QRCode</td>
                <td style="width:27%;text-align: center;"> NAMA LENGKAP </td>
                <td colspan="2" style="width:35%;text-align: center;"> TANDA TANGAN </td>
            </tr> 
            <?= $datax ?>  
        </table>
        <?php
    } else {
        echo"<h3>Belum Ada Peserta</h3>";
    }

    if (count($asesor) > 0) {
    ?>
    <table style="width:100%; margin-top: 25px;" border="1" cellpadding="3" cellspacing="0" >
        <tr style="font-weight:bold;">
            <td style="width:5%;text-align: center;"> NO </td>
            <td style="width:25%;text-align: center;"> NO REG </td>
            <td style="width:70%;text-align: center;"> NAMA ASESOR </td>
        </tr>
        <?= $maping_asesor ?>
    </table>
    <?php } ?>

</page>