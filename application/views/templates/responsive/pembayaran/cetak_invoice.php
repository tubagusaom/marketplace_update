<style>
    td,th{
        padding: 1mm;
    }
    .tblBox tr td{
        padding: 0px;
    }
</style>

<page backtop="10mm" backbottom="10mm" backleft="5mm" backright="5mm" ">

    <page_header>
        <table style="width: 100%; border: 0px;">
            <tr>
                <td style="text-align: left;    width: 5%">
                    <img src="<?php echo base_url() . 'assets/img/header.png'; ?>" style="width: 750px; margin-top: -25px;" />
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer></page_footer>

    <div style="margin-bottom:50px;"></div>

    <h4 style="text-align:center;">INVOICE</h4>
    <h4 style="text-align:center;margin-top: -10px;">SERTIFIKASI KOMPETENSI KEUANGAN SYARIAH</h4>

    <table>
        <tr>
            <td>Kepada Yth : </td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">
                <label style="font-weight: bold;"><?= strtoupper($riwayat_sertifikasi->nama_lengkap); ?></label><br/>
                <?= $riwayat_sertifikasi->alamat ?><br/>
                <?= $riwayat_sertifikasi->email ?><br/>
                <?= $riwayat_sertifikasi->telp ?><br/>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr>
            <td>Invoice No : </td>
        <td><?= $no_invoice; ?></td>
        </tr>
    </table>

    <br/>
    
    <table style="border:1px;border-collapse: collapse;width: 100%;">
        <tr style="font-weight: bold;border:1px;">
            <td style="border:1px;width: 2%;text-align: center"> No </td>
            <td style="border:1px;width: 55%;" align="center"> Deskripsi </td>
            <td style="border:1px;width: 15%;" align="center"> Kuantitas </td>
            <td style="border:1px;width: 25%;" align="right"> Jumlah Pembayaran </td>
        </tr>

        <tr style="border:1px;">
            <td style="border:1px;text-align: center;"> 1 </td>
            <td style="border:1px;"><?= $riwayat_sertifikasi->skema ?></td>
            <td style="border:1px;" align="center"> 1 </td>
            <td style="border:1px;" align="right"> <?= 'Rp ' . number_format($riwayat_sertifikasi->biaya_skema, 0, ',', '.') ?> </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td>SUB TOTAL</td>
            <td align="right">
                <?php

                    $sub_total = number_format(round($riwayat_sertifikasi->biaya_skema), 0, '.', '.');
                    echo 'Rp ' .$sub_total; ?>

            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>PPH</td>
            <td align="right">
                <?php
                $pajak = number_format(round(($riwayat_sertifikasi->biaya_skema / 0.98)-$riwayat_sertifikasi->biaya_skema));

                //$pjk = number_format($pajak, 0, ',', '.');
                //echo 'Rp ' . $pajak;
                ?>
                <?= 'Rp ' . number_format(round(($riwayat_sertifikasi->biaya_skema / 0.98)-$riwayat_sertifikasi->biaya_skema), 0, '.', '.') ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>TOTAL</td>
            <td align="right">
                <?php
                //$total = $sub_total + $pph
                //echo $total;
                $totalBayar = $riwayat_sertifikasi->biaya_skema + $pajak;
                ?>
                <?= 'Rp ' . number_format(round($riwayat_sertifikasi->biaya_skema / 0.98), 0, '.', '.') ?> 
            </td>
        </tr>
    </table>

    <br/>

    <table>
        <tr style="font-style: italic;">
            <td>Terbilang : </td>
            <td><?php echo terbilang($totalBayar); ?></td>
        </tr>
    </table>

    <br/>

    <table style="width:100%;">
        <tr>
            <td style="width:50%">
                Pembayaran dapat ditransfer melalui : <strong><br/>
                    Yayasan LSP Keuangan Syariah <br/>
                    Bank Syariah Mandiri Cabang Sahardjo<br/>
                    A/c. 7099025365
                </strong>
            </td>
            <td style="width:50%;border: 1px solid #000;">
                <table class="tblBox" style="width:100%;vertical-align: top;line-height: 1;font-size: 12px;">
                    <tr style="font-weight: bold;">
                        <td style="width:15%;">NPWP </td>
                        <td style="width:5%;">:</td>
                        <td style="width:80%;">76.207.087.8-022.000</td>
                    </tr>
                    <tr>
                        <td>KLU </td>
                        <td style="width:5%;">:</td>
                        <td>Jasa Sertifikasi</td>
                    </tr>
                    <tr>
                        <td>Nama </td>
                        <td style="width:5%;">:</td>
                        <td style="word-wrap: break-word;">Yayasan Lembaga Sertifikasi Profesi <br/>Keuangan Syariah</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br/>

    <table style="width:90%;">
        <tr>
            <td style="width:43%;">
                <strong>Jatuh Tempo : <?=tgl_indo($batas_waktu)?></strong>
                <div style="clear:both;margin-bottom: 20px;"></div>
                Jakarta, <?php echo tgl_indo($riwayat_sertifikasi->u_date_create); ?>
            </td>
            <td style="width: 35%;">
        <qrcode value="<?= $riwayat_sertifikasi->id; ?>/INV-SERT/LSP-KS/<?= date('Y'); ?>" ec="Q" style="width: 25mm;"></qrcode>
        </td>
        </tr>
    </table>
    <br/>

    <div style="float:left;width: 50%;padding: 10px;font-weight: bold;">
        YAYASAN LEMBAGA SERTIFIKASI PROFESI KEUANGAN SYARIAH
    </div>

    <br/>
    <br/>

    <div style="float:left;width: 50%;padding: 10px;margin-top: 20px;">
        <strong>Dini Saptianti Indriani</strong><br/>
        Bendahara
    </div>

</page>
