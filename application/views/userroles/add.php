<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 150px;">Nama Role : </td>
					<td>
						<input id="role_name" name="role_name" style="width: 200px;" class="easyui-textbox" value="<?php echo $role_name ?>" disabled>
					</td>
				</tr>
				<tr>
					<td style="width: 150px;">Nama User : </td>
					<td>
						<input id="user_id" name="user_id" style="width: 200px;">
					</td>
				</tr>
                <tr>
					<td style="width: 150px;"></td>
					<td>
						<a onclick="sendsms_user()" id="btn" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-email'">Kirim Notifikasi</a>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type='text/javascript'>
	<?php echo $users ?>
</script>
<script type="text/javascript">
function sendsms_user(){
        var base_url = "<?php echo base_url() ?>";
        var user_id = $('#user_id').combogrid('getValue');
        $.messager.progress(); 
        var dt = {user_id:user_id};
        $.ajax({
            type:"POST",
            url:base_url+"userroles/sms",
            data:dt,
            success:function(result){
                $.messager.progress('close');
            }
         })
}
</script>