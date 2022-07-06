<style>
	.c6, .c6:hover {
		background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #2984a4 0px, #24748f 100%) repeat scroll 0 0;
		border-color: #1f637b;
		color: #fff;
	}
	a.c6:hover {
		background: #24748f none repeat scroll 0 0;
		filter: none;
	}
</style>
<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 100px;">Username : </td>
					<td>
						<input id="akun" name="akun" style="width: 180px;" class="easyui-textbox" data-options="required: true, validType: 'length[5,18]'" value="<?php echo $data->akun ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Nama User : </td>
					<td>
						<input id="nama_user" name="nama_user" value="<?php echo $data->nama_user ?>" style="width: 180px;" class="easyui-textbox" data-options="required: true">
                        <input type="hidden" id="sandi" name="sandi" value="<?php echo $data->sandi ?>" >
                        <input type="hidden" id="pegawai_id" name="pegawai_id" value="<?php echo $data->pegawai_id ?>" >
                        <input type="hidden" id="jenis_user" name="jenis_user" value="<?php echo $data->jenis_user ?>" >
                        <input type="hidden" id="sandi_asli" name="sandi_asli" value="<?php echo $data->sandi_asli ?>" >
					</td>
				</tr>
                
				<tr>
					<td style="width: 100px;">Email : </td>
					<td>
						<input id="email" name="email" style="width: 200px;" class="easyui-textbox" data-options="required: true, validType: 'email'" value="<?php echo $data->email ?>">
					</td>
				</tr>
                <tr>
					<td style="width: 100px;">HP : </td>
					<td>
						<input id="hp" name="hp" style="width: 200px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->hp ?>">
					</td>
				</tr>
				<tr>
					<td>Aktif : </td>
					<td>						
						<input id="aktif" name="aktif" style="width: 20px;" type="radio" value="1" checked>Ya
						<input id="aktif" name="aktif" style="width: 20px;" type="radio" value="0">Tidak
					</td>
				</tr>
				<tr>
					<td></td>
					<td><a href="javascript: void(0);" class="easyui-linkbutton c6" iconCls="icon-password" onclick="chg_passwd($(this))">Ganti Password</a></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
	<?php //echo $pegawai_grid ?>
	function chg_passwd(obj)
	{
		var parent_tbl = obj.parents('table');
		var link_text = obj.find('.l-btn-text').text();
		if(link_text == 'Ganti Password')
		{
			parent_tbl.append("<tr id='row-chg-passwd'><td>Sandi Baru : </td><td><input name='new_pwd' id='new_pwd' type='password' style='width: 200px;'/></td><tr>");
			$('#new_pwd').textbox();
			obj.linkbutton({text:'Batal Ganti Password'});
		}
		else
		{
			parent_tbl.find('#row-chg-passwd').remove();
			obj.linkbutton({text:'Ganti Password'});
		}
	}
</script>