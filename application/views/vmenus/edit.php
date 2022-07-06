<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 100px;">Menu : </td>
					<td>
						<input id="menu_id" name="menu_id" value="<?php echo $data->menu_id ?>">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Acl : </td>
					<td>
						<input id="acl_id" name="acl_id" style="width: 250px;">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
	<?php 
		echo $menu_grid; 
		echo $acl_grid;
	?> 
</script>