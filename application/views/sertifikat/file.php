Nama Direktori  <?=$virtual_root?> <br/>
Path  <?=$path_in_url?> <br/>
Nama File <br/>
<a href="#" onclick="pilih_file()">Pilih</a>
<table id="table_file" class="easyui-datagrid" border="1" style="width:100%;height:250px"
 data-options="rownumbers:'true',fitColumns:true,singleSelect:true,checkbox:'true'">
    <thead>
        <tr>
            <th data-options="field:'name',width:500">File Name</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($files as $key => $value) {

			echo '<tr><td>'.$value['name'].'</td></tr>'	;
		}
		?>
    </tbody>
</table>
<script type="text/javascript">
	function pilih_file(){
		$('#dd').dialog('close');
		row = $('#table_file').datagrid('getSelected');
		$('#foto').val(row.name);
	}
</script>