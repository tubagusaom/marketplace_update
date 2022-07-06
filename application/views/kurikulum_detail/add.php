<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data" style="border: 1;">
				<tr>
					<td style="width: 110px;">Subject Name : </td>
					<td>
						<input id="subject_name" name="subject_name" style="width: 300px;" class="easyui-textbox" data-options="required: true" value="<?php echo $subject_name ?>" disabled>
					</td>
				</tr>
				<tr>
					<td style="width: 110px;">Kurikulum : </td>
					<td>
						 <?php echo form_dropdown('kurikulum_id', $kurikulum_dropdown, '', 'id="kurikulum_id" class="easyui-combobox"  data-options="required: true"'); ?>
					</td>
				</tr>
                
				
			</table>
		</form>
	</div>
</div>