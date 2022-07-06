 <div style="padding: 5px;">  <div id="p" class="easyui-panel" title="Dashboard Report Student" 
            style="width:auto;height:450px;padding:10px;background:#fafafa;"
            data-options="closable:false,
                    collapsible:false,minimizable:false,maximizable:false">
        <a href="report_angkatan/cetak"><h3>Cetak Laporan</h3></a><br />
        <table class="table-data">
                <tr>
                    <td style="width: 100px;">Student Name : </td>
                    <td>
                        <input id="siswa_id" name="siswa_id" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Batch : </td>
                    <td>
                        <?php echo form_dropdown('batch_id', $angkatan, '', 'id="batch_id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;"></td>
                    <td>
                        <a href="#" onclick="search_log_book()" class="easyui-linkbutton">Search</a>
                    </td>
                </tr>
        </table>
        <h3>LOG BOOK STUDENT</h3>
        <table class="easyui-datagrid" style="width:auto;height:auto">
        <thead>
        <tr><th data-options="field:'code5',width:100,align:'center'">BATCH</th>
        <th data-options="field:'code6'">NAMA</th>
        <th data-options="field:'code',width:100,align:'center'">NIS</th>
        <th data-options="field:'code2'">CURRICULUME</th>
        <th data-options="field:'code3'">HOURS LESSON</th>
        <th data-options="field:'price',width:100,align:'center'">HOURS STUDY</th>
        <th data-options="field:'price2',width:100,align:'center'">REMAIN</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach($query_jam_terbang as $value){
                echo "<tr>
                <td>".$value['batch_name']."</td>
                <td>".$value['nama']."</td>
                <td>".$value['nis']."</td>
                <td>".$value['nama_kurikulum']."</td>
                <td>".$value['total_hours']."</td>
                <td>".$value['total_flight']."</td>
                <td>".$value['remain']."</td></tr>";
            }
			if(isset($download)) {
        ?>
			<tr>
				<td colspan="6"><a href="<?php echo base_url() ?>report_angkatan/download/pdf" target="_blank">Download Pdf</a></td>
			</tr>
		<?php } ?>
        </tbody>
        </table>
        
    </div></div>
<script type="text/javascript">
function search_log_book(){
    
}
<?php
echo $siswa_grid;
?>
</script>