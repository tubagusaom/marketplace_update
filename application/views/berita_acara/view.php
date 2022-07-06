<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
        <div id="tips" style="background-color: aqua;">
			<ol >
				<li><a href="javascript:void(0)" id="mb" class="easyui-menubutton" 
                        data-options="menu:'#mm',iconCls:'icon-print'">Cetak Dokumen Administrasi UJK</a>
                    <div id="mm" style="width:auto;">
                        <div data-options="iconCls:'icon-print'"><a href="<?php echo base_url().'jadwal_asesmen/cetak/'.$data->id ?>">Daftar Hadir</a></div>
                        <div data-options="iconCls:'icon-print'">Daftar Penerima ATK</div>
                        <div data-options="iconCls:'icon-print'">Daftar Penerima Konsumsi</div>
                        <div data-options="iconCls:'icon-print'">Daftar Penerima Bahan Uji</div>
                        <div class="menu-sep"></div>
                        <div>Daftar Hadir Asesor</div>
                        <div>Daftar Penerima Konsumsi Asesor</div>
                        <div>Daftar Hadir Panitia</div>
                        <div>Daftar Penerima Konsumsi Panitia</div>
                        <div class="menu-sep"></div>
                        <div data-options="iconCls:'icon-print'">Cetak Semua</div>
                        
                    </div>
                </li>
			</ol>
		</div>
            <table class="table-data">
                 <tr>
                    <td style="width: 140px;">Nama Jadwal: </td>
                    <td>
                        <?php echo $data->jadual ?>
                    </td>
                </tr>
               
                <tr>
                    <td style="width: 100px;">Tanggal Mulai : </td>
                    <td>
                        <?php echo $data->tanggal ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tanggal Akhir : </td>
                    <td>
                        <?php echo $data->tanggal_akhir ?>
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Persyaratan : </td>
                    <td>
                        <?php echo $data->persyaratan ?>
                        
                    </td>
                </tr>
            </table>
            <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Data Peserta Asesmen</a></li>
    			</ol>
    		</div>
            <table class="easyui-datagrid" style="width: 97%;" data-options="nowrap:false,striped:true">
            <thead>
                <tr><th data-options="field:'code'" style="width: 30%;">No Uji Kompetensi</th>
                <th data-options="field:'code1'" style="width: 68%;">Nama Lengkap</th>
                
            </thead>
            <tbody>
                <?php
                foreach($peserta as $value){
                    echo '<tr><td>'.$value['no_uji_kompetensi'].'</td><td>'.$value['nama_lengkap'].'</td></tr>';    
                }
                ?>   
            </tbody> 
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
//echo $pra_asesmen_grid;

?>
</script>