<div id="dlg" style="display: none;margin: auto;"><div id="dialog-content"></div></div>
<div class="easyui-layout" data-options="fit:'true'">
	<div data-options="region:'north'" style="height:50px">
		<div class="easyui-layout" data-options="fit:true, border: false">
			<div data-options="region:'west', border: false, fit: true" style="width: 60%;background-color: #fff;">
				<table border="0" cellpadding="0" cellspacing="0" style="margin: 0;">
					<tr>
						<td>
							<a href=""><img src="<?php echo base_url() ?>assets/img/logo48.png" style="margin:0px; padding: 0px; margin-top: 5px;margin-left: 5px; float: left;border:0px;"/></a>
						</td>
					</tr>
				</table>
			</div>
			<div data-options="region:'east', border: false" style="width: 40%;background-color: #fff;">
				<div style="float: right; margin: 10px;">
					<a href="javascript: void(0);" class="easyui-menubutton" iconCls="icon-person" menu="#mm1"><?php echo $nama_user ?></a>
					<a href="<?php echo base_url() ?>home/about" class="easyui-menubutton" iconCls="icon-help" menu="#help-menu"> Bantuan</a>
					<a href="javascript: void(0);" onclick="detail_pesan()" class="easyui-linkbutton" iconCls="icon-email"> <?=$unread_message?> Pesan</a>
                    <a href="<?php echo base_url() ?>users/logout" class="easyui-linkbutton" iconCls="icon-logout"> Logout&nbsp;&nbsp;</a>
					<div id="mm1" style="width:150px;">
						<div id="role-btn">Role: <?php echo $rolename ?></div>
						<div class="menu-sep"></div>
						<div data-options="name:'change_pwd',iconCls:'icon-password'" onclick="change_pwd();">Ganti Password</div>
					</div>
					<div id="help-menu" style="width:150px;">
						<div>FAQ</div>
						<div class="menu-sep"></div>
						<div onclick="simple_modal({url:'<?php echo base_url() ?>home/about'})">Tentang Aplikasi</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div data-options="region:'south',split:true" style="height:50px;">
		<div class="x-form-copyright" style="bottom: 10px;"> &copy;2021 <?=$aplikasi->singkatan_unit?>, Developed By <a href="http://aom.my.id" target="_blank">TB</a> Team </div>
	</div>
	<div data-options="region:'west',split:true" title="" style="width:250px;" id="west-layout">
		<div class="easyui-accordion" id="accordion-menu" data-options="fit:true,border:false">
			<div class="easyui-accordion" style="width:100%;height:100%;">
				<?php if(isset($menus)) echo $menus ?>
			</div>
		</div>
	</div>
	<div data-options="region:'center', iconCls:'icon-ok'" style="height: 100%;">
		<div class="easyui-tabs" data-options="fit:true,border:false,plain:false" id="tt">
			<div title="Selamat Datang" style="margin:20px;padding:10px;">
				<div class="form-intro-label">  Anda Login Sebagai Calon Pemegang Sertifikat / Asesi <?=$aplikasi->singkatan_unit?></div>
				<p>Modul yang dapat anda akses antara lain : </p>
				<ul>
					<li>PENDAFTARAN ONLINE</li>
					Ini adalah formulir yang pertama kali di akses. Setelah di validasi oleh admin maka anda baru bisa mengakses halaman ini
					<li>PENDAFTARAN UJK (UJI KOMPETENSI)</li>
					Untuk mengubah data pendaftaran, upload ulang bukti pendukung atau merubah data profil, langkah-langkah nya sebagai berikut :
					<ol type="1">
						<li>Pilih Menu Pendaftaran UJK</li>
						<li>Seleksi record hingga berubah latar nya menjadi warna kuning</li>
						<li>Klik Tombol Edit</li>
						<li>Upload ulang bukti pendukung sesuai dengan yang diminta oleh Asesor pada <b>revisi bukti pendukung</b></li>
						<li>Klik Tombol save di bagian pojok kanan form</li>
						<li>Apabila berhasil maka sistem akan mengirim notifikasi ke asesor untuk melakukan verifikasi bukti-bukti baru</li>
					</ol>
					<li>PRA ASESMEN</li>
					Hasil rekomendasi dari asesor. Lanjut atau Tidak Lanjut
					<li>Administrasi</li>
					Adalah tahapan verifikasi pembayaran / Biaya administrasi yang di butuhkan
					<li>Real Asesmen</li>
					Adalah tahapan memetakan asesi kedalam jadwal asesmen
					<li>Uji Kompetensi</li>
					Tahapan setelah ada penilaian dari asesor. Langkah-langkah untuk melihat hasil dan update beberapa form adalah
					<ol type="1">
						<li>Pilih Menu Uji Kompetensi</li>
						<li>Seleksi record hingga berubah latar nya menjadi warna kuning</li>
						<li>Klik Tombol Edit</li>
						<li>MAK 02 Formulir Banding</li>
						<li>MAK 03 Persetujuan Asesmen</li>
						<li>MAK 05 Umpan Balik Asesi</li>
						<li>Klik Tombol save di bagian pojok kanan form</li>
					</ol>

				</ul>
				<div class="form-intro-label" style="margin-bottom:100px;">Untuk lebih jelasnya hubungi <?=$aplikasi->sms_center?> </div>
			</div>
		</div>
	</div>
</div>
