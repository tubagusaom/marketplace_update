<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 200px;">Toolbar : </td>
					<td>
						<input id="toolbar_id" name="toolbar_id">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Acl : </td>
					<td>
						<input id="acl_id" name="acl_id" style="width: 250px;">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">No. Urut : </td>
					<td>
						<input id="no_urut" name="no_urut" style="width: 50px;" class="easyui-textbox" value="<?php echo $data->no_urut ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Jenis Grid : </td>
					<td>
						<?php echo form_dropdown('grid_type', $grid_type, $data->grid_type, 'id="grid_type" class="easyui-combobox"  data-options="required: true"'); ?>
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Grid Target : </td>
					<td>
						<input id="target_grid" name="target_grid" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->target_grid ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Grid Induk : </td>
					<td>
						<input id="parent_grid" name="parent_grid" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->parent_grid ?>" value="<?php echo $data->parent_grid ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Tinggi Modal Window : </td>
					<td>
						<input id="modal_height" name="modal_height" style="width: 250px;" class="easyui-numberbox" data-options="min:100" value="<?php echo $data->modal_height ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Lebar Modal Window : </td>
					<td>
						<input id="modal_width" name="modal_width" style="width: 250px;" class="easyui-numberbox" data-options="min:100" value="<?php echo $data->modal_width ?>">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
	<?php 
		echo $toolbar_grid; 
		echo $acl_grid;
	?> 
</script>