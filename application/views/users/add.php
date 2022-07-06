<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
	<div class="x-panel-bwrap">
		<form id="myform">
			<table class="table-data">
				<tr>
					<td style="width: 160px;">Username : </td>
					<td>
						<input id="akun" name="akun" style="width: 180px;" class="easyui-textbox" data-options="required: true, validType: 'length[5,18]'">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Nama User : </td>
					<td>
						<input id="nama_user" name="nama_user" style="width: 180px;" class="easyui-textbox" data-options="required: true">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Kelompok User : </td>
					<td>
						<?php echo form_dropdown('jenis_user', $jenis_user, '', 'id="jenis_user" class="easyui-combobox"  data-options="required: true"'); ?>
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">TUK/Asesor/Asesi : </td>
					<td>
						<input name="pegawai_id" id="pegawai_id">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Password : </td>
					<td>
						<input id="sandi" name="sandi" style="width: 180px;" class="easyui-textbox" data-options="required: true" type="password">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;">Email : </td>
					<td>
						<input id="email" name="email" style="width: 200px;" class="easyui-textbox" data-options="required: true, validType: 'email'">
					</td>
				</tr>
                <tr>
					<td style="width: 100px;">HP : </td>
					<td>
						<input id="hp" name="hp" style="width: 200px;" class="easyui-textbox" data-options="required: true" >
					</td>
				</tr>
				<tr>
					<td>Aktif : </td>
					<td>						
						<input id="aktif" name="aktif" style="width: 20px;" type="radio" value="1" checked>Ya
						<input id="aktif" name="aktif" style="width: 20px;" type="radio" value="0">Tidak
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
	$("#pegawai_id").combogrid({panelWidth: 450,idField:'id',mode: 'remote'});
	$("#jenis_user").combobox({
		onChange: function(newVal, oldVal){
		  $("#pegawai_id").combogrid({panelWidth: 450,idField:'id', textField:'nama_lengkap',mode: 'remote'});
		  	$("#pegawai_id").combogrid('clear');
			var pgrid = $("#pegawai_id").combogrid('grid');
			if(newVal == 1 ){
				var cols = [[
					{field:'id',hidden:true},
					{field:'no_identitas',title:'Nomor Identitas',width:100},
					{field:'nama_lengkap',title:'Nama Lengkap',width:200}
				]];
				pgrid.datagrid({
					columns:cols,
					pagination: true,
					url: '<?php echo base_url() ?>asesi/combogrid/1',
					fitColumns: true,
                    mode: 'remote',
                    
				});
			} else if(newVal == 2) {
			     $("#pegawai_id").combogrid({panelWidth: 450,idField:'id', textField:'users',mode: 'remote'});
	
				$("#pegawai_id").combogrid('clear');
				pgrid.datagrid({
					columns:[[
						{field:'id',hidden:true},
						{field:'users',title:'Nama Asesor',width:300},
					]],
					pagination: true,	
					url: '<?php echo base_url() ?>asesor/combogrid',
					fitColumns: true,
                    mode: 'remote',
                    
				});
			} else if(newVal == 3) {
			     $("#pegawai_id").combogrid({panelWidth: 450,idField:'id', textField:'tuk',mode: 'remote'});
	
				$("#pegawai_id").combogrid('clear');
				pgrid.datagrid({
					columns:[[
						{field:'id',hidden:true},
						{field:'tuk',title:'Nama TUK',width:300},
					]],
					pagination: true,	
					url: '<?php echo base_url() ?>tuk/combogrid',
					fitColumns: true,
                    mode: 'remote',
                    onChange: function(newVal, oldVal){
                        var g = $('#pegawai_id').combogrid('grid');	
                        var r = g.datagrid('getSelected');	// get the selected row
                        $('#nama_user').val(r.tuk);
                    }
				});
			} else {
				pgrid.datagrid({columns:[[]], url:'', pagination: false,mode: 'remote'});
			}
            
		}
	});
    
</script>