
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
    <h4>DAFTAR KEHADIRAN PESERTA UJI KOMPETENSI</h4>


    <?php
    $noxx = 1;
    $no_urut = 1;
    $datax = '';
    foreach ($daftar_hadir as $key => $value) {
        $datax .= '<tr height="500">
    <td style="width:3%;text-align:center"> ' . $noxx . '  <br> </td>
    <td style="width:19%;text-align:center"> ' . $value->no_uji_kompetensi . '  <br> </td>
    <td style="width:16%;text-align:center"> <qrcode value="' . $value->nama_lengkap . ' - ' . $value->no_uji_kompetensi . ' ' . $konfigurasi->url_aplikasi . '/qrcode/asesi/' . $value->id . '" ec="Q" style="width: 15mm;"></qrcode></td>
    <td style="width:27%;"> ' . strtoupper($value->nama_lengkap) . '   <br> </td>';
        if ($noxx % 2 != 0) {
            $datax .= '<td style="width:17%;" rowspan="2"> ' . $no_urut . '......   <br> </td>
            <td style="width:18%;" rowspan="2"> ' . ($no_urut + 1) . '......   <br> </td>
        ';
        }
        $datax .= '</tr>';
        $noxx++;
        $no_urut++;
    }
    ?> 
    Nama Jadwal : <?= $jadwal->jadual ?><br />
    Tanggal Uji Kompetensi : <?= tgl_indo($jadwal->tanggal) . ' - ' . tgl_indo($jadwal->tanggal_akhir) ?><br /><br />

    <?php
    if (count($daftar_hadir) > 0) {
        ?>
        <table style="width:100%;" border="1" cellpadding="3" cellspacing="0" >
            <tr style="font-weight:bold;">
                <td style="width:3%;text-align: center;"> No </td>
                <td style="width:19%;text-align: center;"> No UJK</td>
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
    ?>
</page>

<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm" ">
    <table style="width: 845px; border:0px;">
        <?php
        foreach ($daftar_hadir as $key => $value) {
            $msg = $value->nama_lengkap . ' - ' . $value->no_uji_kompetensi . ' ' . $konfigurasi->url_aplikasi . '/qrcode/asesi/' . $value->id;
            ?>
            <tr>
                <td style="width: 320px">
                    <table style="border:1px;">
                        <tr>
                            <td style="width: 15px"><img src="<?php echo base_url() . 'assets/img/logo48.png'; ?>" /></td>
                            <td style="width:200px"><b><?= $konfigurasi->nama_unit ?></b></td>
                            <td rowspan="2" style="width:30px;"><table style="border:1px;"><tr><td style="height:80px;">FOTO 3 X 4</td></tr></table></td>
                        </tr>
                        <tr>
                            <td colspan="2">Nama Peserta : <b><?= $value->nama_lengkap ?></b></td>


                        </tr>
                        <tr>
                            <td colspan="2"><b><?= tgl_indo($jadwal->tanggal) . ' - ' . tgl_indo($jadwal->tanggal_akhir) ?></b></td>
                            <td rowspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b><?= $value->skema ?></b></td>

                        </tr>
                        <tr style="text-align:center;">
                            <td><qrcode value="<?= $msg ?>" ec="Q" style="width: 15mm;"></qrcode></td><td style="height:50px;" colspan="2"><h3><?= $value->no_uji_kompetensi ?></h3></td>

            </tr>


        </table>

    </td>
    <td style="width: 320px">
        <table style="border:1px;">
            <tr>
                <td style="height:205px;width:315px;">
                    Persyaratan Uji Kompetensi : 
                    <ul>
                        <li>Membawa foto ukuran 3 X 4 sebanyak 3 lembar</li>
                        <li>Datang 30 menit di Tempat Uji Kompetensi sebelum kegiatan di mulai</li>
                        <li>Membawa bukti-bukti pendukung fisik untuk di cek keasliannya</li>
                        <li>Membawa peralatan tulis</li>
                        <li>Disarankan membawa Laptop/Notebook</li>
                    </ul>
                </td>

            </tr>



        </table>

    </td>

    </tr>

    <?php
}
?>
</table>


</page>