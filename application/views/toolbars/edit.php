<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 100px;">Nama Toolbar : </td>
					<td>
						<input id="toolbar_name" name="toolbar_name" style="width: 200px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->toolbar_name ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Nama Icon : </td>
					<td>
						<input id="icon_name" name="icon_name" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->icon_name ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Nama Fungsi : </td>
					<td>
						<input id="function_type" name="function_type" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->function_type ?>">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>