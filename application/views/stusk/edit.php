<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 150px;">Jadwal : </td>
					<td>
						<?php echo form_dropdown('id_jadwal', $jadwal, $data->id_jadwal, 'id="id_jadwal" class="easyui-combobox" style="width: 250px;" data-options="required: true"'); ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Asesor : </td>
					<td>
						<?php echo form_dropdown('id_asesor', $user, $data->id_asesor, 'id="id_asesor" class="easyui-combobox" style="width: 250px;" data-options="required: true"'); ?>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
