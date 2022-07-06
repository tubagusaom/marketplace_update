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

<div style="margin-top:20px;text-align: right ">
	<h3> <?=$aplikasi->singkatan_unit?> </h3>
    <?=$aplikasi->alamat?><br/>
    <?=$aplikasi->no_telpon?>
</div>
<div style="background-color: #EFEFEF;margin-top:20px;padding: 7px; ">
	<h3> <?=$no_invoice?> </h3>
    Tanggal Invoice : <?=tgl_indo(date('Y-m-d'))?>
</div>
<div style="margin-top:40px;margin-bottom: 50px;width: 300px; ">
	<b>Ditagihkan kepada</b> <br/>
	<?=$asesi->nama_lengkap?> <br/>
	<?=$asesi->alamat?>
</div>  
    <table style="width:100%;" border="1" cellpadding="4" cellspacing="3">
    <tr style="background-color: #EFEFEF"><th>DESKRIPSI</th><th style="text-align: center;">TOTAL</th></tr>
  <tr nobr="true">
    <td style="width: 80%;height: 50px;">Uji Kompetensi Skema <b><?=$asesi->skema?></b></td>
    <td style="width: 20%;text-align: center;">Rp <?=$biaya_skema?></td>
 
  </tr>
  
 
 </table>
 <?php
$tutor = '<p>Bayar sesuai dengan total tagihan dengan no unik di belakang untuk memudahkan identifikasi pembayaran. Pembayaran bisa melalui Transfer ke Rekening Resmi LSP dengan detail sebagai berikut</p>
                        Bank : <b>'.$aplikasi->bank.'</b><br/>
                        Atas Nama : <b>'.$aplikasi->bank_atas_nama.'</b><br/>
                        No Rekening : <b>'.$aplikasi->bank_no_rekening.'</b><br/><br/>

                        Setelah melakukan pembayaran, silahkan konfirmasi di halaman website kami dengan cara
                        <ol>
                        <li>Masuk ke website '.$aplikasi->url_aplikasi.'</li>
                        <li>Klik menu Konfirmasi pembayaran </li>
                        <li>Masukkan Tanggal Transaksi dan Nominal sesuai dengan Invoice</li>
                        <li>Klik Simpan</li>
                        <li>Selanjutnya pembayaran anda akan dikonfirmasi terlebih dahulu oleh admin LSP, dan anda akan menerima bukti pembayaran apabila transaksi pembayaran anda telah di validasi</li>
                        <li>Anda juga akan menerima pemberitahuan mengenai estimasi jadwal atau jadwal yang telah di tetapkan oleh admin LSP</li>
                        <li>Pengembalian uang 100% apabila ada pembatalan dari LSP atau dari Calon peserta maksimal 1 minggu setelah  <b>Permohonan Pengembalian Biaya Sertifikasi</b></li>
                        </ol>
                       ';
 echo $tutor;
 ?>
 </page>