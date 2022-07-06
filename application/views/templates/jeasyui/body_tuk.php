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
				<div class="form-intro-label">  Anda Login Sebagai TUK <?=$aplikasi->singkatan_unit?></div>
				<p>Modul yang dapat anda akses antara lain : </p>
				<ul>
					<li>PENDAFTARAN UJK (UJI KOMPETENSI)</li>
					Adalah data calon asesi yang masuk melalui pendaftaran online. Data calon asesi akan tampil di halaman ini dengan syarat asesi <b>memilih TUK <?php echo $nama_user ?></b>. <br/>
					Adapun langkah selanjutnya adalah menentukan asesor siapa yang akan melakukan pra asesmen. Ringkasan langkah nya adalah sebagai berikut :
					<ol type="1">
						<li>Pilih Menu Pendaftaran UJK</li>
						<li>Seleksi record hingga berubah latar nya menjadi warna kuning</li>
						<li>Klik Tombol Edit</li>
						<li>Tentukan Pra asesmen checked / Asesor yang ditugaskan melakukan pra asesmen</li>
						<li>Centang Notifikasi artinya membuat akun login untuk calon asesi agar asesi dapat mengubah datanya sendiri atau mengupload ulang bukti-bukti pendukung</li>
						<li>Klik Tombol save di bagian pojok kanan form</li>
						<li>Apabila berhasil maka kolom <i>Checked Pra Asesmen</i> akan terisi dengan nama asesor yang di tugaskan</li>
						<li>Status data adalah diterima menjadi <b>calon asesi</b></li>
					</ol>

					<li>PRA ASESMEN</li>
					Adalah tahapan verifikasi kesesuaian antara bukti pendukung yang telah di upload dengan skema yang dipilih. Ringkasan langkah nya adalah sebagai berikut :
					<ol type="1">
						<li>Pilih Menu Pra Asesmen</li>
						<li>Seleksi record hingga berubah latar nya menjadi warna kuning</li>
						<li>Klik Tombol Edit</li>
						<li>Download bukti pendukung dan sesuaikan dengan nama-nama bukti yang sudah di sebutkan</li>
						<li>Checklist <i>VATM (Valid,Asli,Terkini dan Memadai)</i> yang ada di bagian bawah form</li>
						<li>Berikan <b>Hasil Rekomendasi Pra Asesmen</b> Lanjut / Tidak Lanjut</li>
						<li>Berikan catatan tambahan bila diperlukan pada <i>pra asesmen description<i></li>
						<li>Centang Kirim Notifikasi artinya mengirim notifikasi hasil pra asesmen ke calon asesi</li>
						<li>Klik Tombol save di bagian pojok kanan form</li>
						<li>Apabila berhasil maka kolom <i>Pra Asesmen</i> akan terisi dengan <b>Lanjut/Tidak Lanjut</b></li>
						<li>Jika Lanjut maka status data adalah diterima menjadi <b>asesi</b></li>
						<li>Jika Tidak lanjut maka calon asesi harus mengupload ulang bukti</li>
					</ol>
					<li>Administrasi</li>
					Adalah tahapan verifikasi pembayaran / Biaya administrasi yang di butuhkan :
					<ol type="1">
						<li>Pilih Menu Administrasi</li>
						<li>Seleksi record hingga berubah latar nya menjadi warna kuning</li>
						<li>Klik Tombol Edit</li>
						<li>Ubah status pembayaran menjadi <b>Selesai</b></li>
						<li>Isian lainnya bisa dikosongkan</li>
						<li>Klik Tombol save di bagian pojok kanan form</li>
						<li>Apabila berhasil maka kolom <i>Adm Status </i> akan terisi dengan <b>Selesai/Belum Selesai</b></li>
						<li>Status data sudah diverifikasi di bagian administrasi dan menuju ke tahap penjadwalan</li>
					</ol>
					<li>Jadwal Asesmen</li>
					Adalah tahapan pembuatan jadwal asesmen :
					<ol type="1">
						<li>Pilih Menu Jadwal Asesmen</li>
						<li>Klik Tombol Input untuk membuat jadwal baru</li>
						<li>Isi sesuai dengan ketentuan. Nama jadwal di isi dengan yang mudah di mengerti dan bermakna. Contohnya "Jadwal PSKK TUK Jakarta 2016 Ruang 1" atau "Jadwal Mandiri UJK TUK Bali Tanggal 17 Agustus 2016"</li>
						<li>Klik Tombol save di bagian pojok kanan form</li>
						<li>Apabila berhasil maka data baru akan tampil sesuai dengan yang di input</li>
						<li>Klik Tombol Edit dan ubah isian sesuai kebutuhan</li>
						<li>Klik Tombol View untuk melihat siapa saja asesi yang termasuk di dalamnya. Dan untuk mencetak dokumen administrasi UJK</li>
					</ol>
					<li>Real Asesmen</li>
					Adalah tahapan memetakan asesi kedalam jadwal asesmen yang sudah dibuat sebelum nya. Langkah - langkah nya sebagai berikut :
					<ol type="1">
						<li>Pilih Menu Real Asesmen</li>
						<li>Seleksi record hingga berubah latar nya menjadi warna kuning</li>
						<li>Klik Tombol Edit</li>
						<li>Secara default, jadwal asesmen terisi dengan jadwal terakhir dan asesor yang bertugas adalah asesor yang melakukan pra asesmen</li>
						<li>Update bilamana ada perubahan</li>
						<li>Klik Tombol save di bagian pojok kanan form</li>
						<li>Apabila berhasil maka kolom nama jadwal dan nama asesor akan terisi</li>
						<li>Pada tahap ini data asesi berstatus siap untuk di uji kompetensi</li>
					</ol>
					<li>Uji Kompetensi</li>
					Pada tahapan ini belum di lakukan secara online, perangkat asesmen tetap di cetak dan diujikan kepada asesi. Namun hasil dari uji perangkat tersebut akan di input ke dalam sistem pada langkah selanjutnya
					<li>Penilaian Asesor</li>
					Adalah tahapan memberikan penilaian dari hasil uji perangkat asesmen. Hanya bisa di lakukan dari login sebagai asesor.
					<li>Laporan Asesmen</li>
					Hasil dari penilaian asesor. Langkah-langkah untuk mengakses menu tersebut adalah :
					<ol type="1">
						<li>Pilih Menu Report => Laporan Asesmen</li>
						<li>Akan ditampilkan data per jadwal asesmen dan jumlah K/BK</li>
						<li>Cetak data untuk keperluan laporan</li>
					</ol>

				</ul>
				<div class="form-intro-label" style="margin-bottom:100px;">Untuk lebih jelasnya hubungi <?=$aplikasi->sms_center?> </div>
			</div>
		</div>
	</div>
</div>
