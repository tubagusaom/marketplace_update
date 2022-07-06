<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 100px;">Rolename : </td>
					<td>
						<input id="nama_peran" name="nama_peran" style="width: 200px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_peran ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Keterangan : </td>
					<td>
						<input id="keterangan" name="keterangan" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->keterangan ?>">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>