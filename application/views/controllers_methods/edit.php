<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 150px;">Controller ID : </td>
					<td>
						<?php echo form_dropdown('controller_id', $controller, $data->controller_id, 'id="controller_id" class="easyui-combobox"  data-options="required: true"'); ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Method ID : </td>
					<td>
						<?php echo form_dropdown('method_id', $method, $data->method_id, 'id="method_id" class="easyui-combobox"  data-options="required: true"'); ?>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>