<img src="<?=base_url().'uploads/logo.png'?>">
<br/>
<table>
	<tr><td width="150px">Nomor</td><td>:</td><td><?=$nomor?></td></tr>
	<tr><td>Lamp</td><td>:</td><td>-</td></tr>
	<tr><td>Hal</td><td>:</td><td><u><b>Pemberitahuan Hasil Uji</b></u></td></tr>
</table>
<p>Kepada Yth,</p>
<?=$nama_lengkap?><br/>
<b><?=$jabatan?></b><br/>
<b><?=$organisasi?></b><br/>
Di Tempat

<p>Assalamu'alaikum Wr.Wb</p>
Salam Sejahtera
<p>
	Berdasarkan hasil uji kompetensi pada tanggal <?=$tanggal?> di Tempat Uji Kompetensi(TUK) <?=$tuk?> serta hasil Rapat Pleno Keputusan Uji pada tanggal <?=$tanggal_uji?> yang di landasi pertimbangan dokumen pendukung dan rekomendasi asesor, maka bersamaan ini kami sampaikan pemberitahuan kepada <?=$nama?> sebagai berikut :

</p>
<ol>
<li>Terhadap Skema Sertifikasi <?=$skema?> yang terdiri dari <?=$jumlah_unit?> unit kompetensi  <u><b>terdapat unit kompetensi yang belum memenuhi kriteria kompeten</b></u> yaitu
<table border="1">
	<tr><th width="5%">No</th><th width="25%">Kode Unit</th><th width="60%">Judul Unit</th></tr>
	<?php 
	//var_dump($unit_kompetensi);
	$no= 1;
	foreach ($unit_kompetensi as $key => $value) {
		if(isset($array_hasil_bk[$key])){
			echo "<tr><td  style='text-align:center;'>".($no)."</td><td style='text-align:center;'>".$value->id_unit_kompetensi."</td><td>".$value->unit_kompetensi."</td></tr>";
			$no++;
		}
	}
	?>

</table>
</li>
<li>
	Sebagai bukti uji maka kami akan menyerahkan logbook selambat-lambatnya 60 hari setelah dikeluarkannya surat pemberitahuan hasil uji ini(sertifikat akan kami serahkan setelah memenuhi kualifikasi <?=$jumlah_unit?> unit kompetensi dinyatakan kompeten)	
</li>
<li>Untuk unit kompetensi yang belum kompeten, saudara dapat mengajukan uji ulang pada unit kompetensi tersebut</li>
</ol>

<p>
	Demikian pemberitahuan hasil uji kompetensi ini disampaikan, atas perhatian dan kerjasama nya kami ucapkan terimakasih.
</p>
<p>
	Wassalamu'alaikum Wr.Wb
</p>
<p><?=$tanggal_uji?></p>
<p><img src="<?=$src_ttd?>"></p>


<br/><br/><br/>


