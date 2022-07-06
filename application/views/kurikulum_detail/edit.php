
<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data" style="border: 1;">
				<tr>
					<td style="width: 150px;">Kurikulum : </td>
					<td>
						<input id="nama_kurikulum" name="nama_kurikulum" style="width: 300px;" class="easyui-textbox" data-options="required: true" value="<?php echo $nama_kurikulum ?>" disabled>
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Category : </td>
					<td>
						<input id="category" name="category" style="width: 300px;" class="easyui-textbox" value="<?php echo $data->category ?>">
					</td>
				</tr>
                <tr>
					<td style="width: 150px;">Subject Name : </td>
					<td>
						<input id="nama_subjek" name="nama_subjek" style="width: 300px;" class="easyui-textbox" data-options="required: true"value="<?php echo $data->nama_subjek ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Hours : </td>
					<td>
						<input id="hours" name="hours" style="width: 100px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->hours ?>">
					</td>
				</tr>
				
			</table>
		</form>
	</div>
</div>