<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 90px;">Username : </td>
					<td>
						<input id="akun" name="akun" style="width: 180px;" class="easyui-textbox" />
					</td>
				</tr>
				<tr>
					<td style="width: 70px;">Shortname : </td>
					<td>
						<input id="nama_user" name="nama_user" style="width: 180px;" class="easyui-textbox" />
					</td>
				</tr>
				<tr>
					<td style="width: 70px;">Kelompok User : </td>
					<td>
						<?php echo form_dropdown('jenis_user', $jenis_user, '', 'id="jenis_user" class="easyui-combobox"  data-options="required: true"'); ?>
					</td>
				</tr>
				
			</table>
		</form>
	</div>
</div>
