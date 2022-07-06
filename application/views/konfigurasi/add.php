<div class="form-panel" style="margin-left: 0;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap" style="margin-left: 0;">
		
		<form id="myform">
		<div id="tips">
			<ol class="rounded-list">
				<li><a href="javascript: void(0)">Format nomor telepon yang benar 0xxx-nomor telepon atau 0xx-nomor telepon</a></li>
			</ol>
		</div>
			<table class="table-data">
				<tr>
					<td style="width: 150px;">Nama Unit : </td>
					<td style="width: 300px;">
						<input id="nama_unit" value="<?php if(isset($data->nama_unit)) echo $data->nama_unit ?>" name="nama_unit" class="easyui-textbox" data-options="required: true" style="width: 300px;">
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Singkatan Unit : </td>
					<td style="width: 300px;">
						<input id="singkatan_unit" value="<?php if(isset($data->singkatan_unit)) echo $data->singkatan_unit ?>" name="singkatan_unit" class="easyui-textbox" data-options="required: true" style="width: 300px;">
					</td>
				</tr>
				<tr>
					<td>Alamat : </td>
					<td>
						<input id="alamat" value="<?php if(isset($data->alamat)) echo $data->alamat ?>" name="alamat" class="easyui-textbox" data-options="required: true" style="width: 300px;">
					</td>
				</tr>
				<tr>
					<td>No. Telepon : </td>
					<td style="width: 300px;">
						<input id="no_telpon" name="no_telpon" value="<?php if(isset($data->no_telpon)) echo $data->no_telpon ?>" class="easyui-textbox" data-options="required: true,validType:'phonenumber'" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>No. Fax : </td>
					<td>
						<input id="no_fax" name="no_fax" value="<?php if(isset($data->no_fax)) echo $data->no_fax ?>" class="easyui-textbox" data-options="required: true,validType:'phonenumber'" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>Alamat Email : </td>
					<td>
						<input id="alamat_email" name="alamat_email" value="<?php if(isset($data->alamat_email)) echo $data->alamat_email ?>" class="easyui-textbox" data-options="required: true, validType: 'email'" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>No. SMS Center : </td>
					<td>
						<input id="sms_center" name="sms_center" value="<?php if(isset($data->sms_center)) echo $data->sms_center ?>" class="easyui-textbox" data-options="required: true, validType:'mobile'" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>URL Aplikasi : </td>
					<td>
						<input id="url_aplikasi" name="url_aplikasi" value="<?php if(isset($data->url_aplikasi)) echo $data->url_aplikasi ?>" class="easyui-textbox" data-options="required: true" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>Kode LSP : </td>
					<td>
						<input id="kode_lsp" name="kode_lsp" value="<?php if(isset($data->kode_lsp)) echo $data->kode_lsp ?>" class="easyui-textbox" data-options="required: true" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>Kode Sektor : </td>
					<td>
						<input id="kode_sektor" name="kode_sektor" value="<?php if(isset($data->kode_sektor)) echo $data->kode_sektor ?>" class="easyui-textbox" data-options="required: true" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>Ketua / Direktur : </td>
					<td>
						<input id="ketua" name="ketua" value="<?php if(isset($data->ketua)) echo $data->ketua ?>" class="easyui-textbox" data-options="required: true" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>Manajer Sertifikasi : </td>
					<td>
						<input id="manajer_sertifikasi" name="manajer_sertifikasi" value="<?php if(isset($data->manajer_sertifikasi)) echo $data->manajer_sertifikasi ?>" class="easyui-textbox" data-options="required: true" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>Certification Body : </td>
					<td>
						<input id="unit_name" name="unit_name" value="<?php if(isset($data->unit_name)) echo $data->unit_name ?>" class="easyui-textbox" data-options="required: true" style="width: 200px;">
					</td>
				</tr>
				<tr>
					<td>No Urut Sertifikat : </td>
					<td>
						<input id="no_urut_sertifikat" name="no_urut_sertifikat" value="<?php if(isset($data->no_urut_sertifikat)) echo $data->no_urut_sertifikat ?>" class="easyui-textbox" data-options="required: true" style="width: 200px;">
					</td>
				</tr>
				
			</table>
			<div id="tips">
			<ol class="rounded-list">
				<li><a href="javascript: void(0)">Format Pesan atau Notifikasi Sistem</a></li>
			</ol>
		</div>
			<table class="table-data">
				<tr>
					<td style="width: 150px;">Pesan Pendaftaran Sukses : </td>
					<td style="width: 300px;">
						<input id="pesan_sukses_pendaftaran" value="<?=$data->pesan_sukses_pendaftaran ?>" name="pesan_sukses_pendaftaran" class="easyui-textbox" data-options="required: true" style="width: 300px;">
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Pesan Gagal Double : </td>
					<td style="width: 300px;">
						<input id="pesan_gagal_double" value="<?=$data->pesan_gagal_double ?>" name="pesan_gagal_double" class="easyui-textbox" data-options="required: true" style="width: 300px;">
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Format Rekomendasi Pra Asesmen : </td>
					<td style="width: 300px;">
						<input id="format_rekomendasi_pra_asesmen" value="<?=$data->format_rekomendasi_pra_asesmen ?>" name="format_rekomendasi_pra_asesmen" class="easyui-textbox" data-options="required: true" style="width: 300px;">
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Format Rekomendasi Asesor : </td>
					<td style="width: 300px;">
						<input id="format_rekomendasi_asesor" value="<?=$data->format_rekomendasi_asesor ?>" name="format_rekomendasi_asesor" class="easyui-textbox" data-options="required: true" style="width: 300px;">
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Format Keputusan Asesmen : </td>
					<td style="width: 300px;">
						<input id="format_keputusan_asesmen" value="<?=$data->format_keputusan_asesmen ?>" name="format_keputusan_asesmen" class="easyui-textbox" data-options="required: true" style="width: 300px;">
					</td>
				</tr>
			</table>
			<div id="tips">
			<ol class="rounded-list">
				<li><a href="javascript: void(0)">Skema Sertifikasi</a></li>
			</ol>
		</div>
			<table class="table-data">
				<tr>
					<td style="width: 150px;">Persyaratan Dasar Skema : </td>
					<td style="width: 300px;">
					<textarea name="persyaratan_dasar_skema" id="persyaratan_dasar_skema" rows="4" cols="50"><?php echo $data->persyaratan_dasar_skema ?></textarea>
						
					</td>
				</tr>
		</form>
	</div>
</div>
<script>
    $(function(){
        $("#persyaratan_dasar_skema").cleditor({
        width:550, height:230
    });
    })
</script>