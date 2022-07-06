<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
        <div id="tips" style="background-color: aqua;">
			<ol >
				<li><a href="javascript:void(0)" id="mb" class="easyui-menubutton"
                        data-options="menu:'#mm',iconCls:'icon-print'">Cetak Dokumen Administrasi UJK</a>
                    <div id="mm" style="width:auto;">
                        <div data-options="iconCls:'icon-print'"><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/1/'.$data->id ?>">Daftar Hadir</a></div>
                        <div data-options="iconCls:'icon-print'"><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/2/'.$data->id ?>">Daftar Penerima ATK</a></div>
                        <div data-options="iconCls:'icon-print'"><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/3/'.$data->id ?>">Daftar Penerima Konsumsi</a></div>
                        <div data-options="iconCls:'icon-print'"><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/4/'.$data->id ?>">Daftar Penerima Bahan Uji</a></div>
                        <div class="menu-sep"></div>
                        <div><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/5/'.$data->id ?>">Daftar Hadir Asesor</a></div>
                        <div><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/6/'.$data->id ?>">Daftar Penerima Konsumsi Asesor</a></div>
                        <div><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/7/'.$data->id ?>">Daftar Hadir Panitia</a></div>
                        <div><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/8/'.$data->id ?>">Daftar Penerima Konsumsi Panitia</a></div>
                        <div class="menu-sep"></div>
                        <div data-options="iconCls:'icon-print'"><a target="_blank" href="<?php echo base_url().'jadwal_asesmen/cetak/9/'.$data->id ?>">Cetak Semua</a></div>

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
                <tr>
                    <td style="width: 100px;">Perangkat Asesmen : </td>
                    <td>
                        <a href="<?php echo base_url().'assets/files/jadwal_asesmen/'.$data->file_jadual ?>" target="_blank">Download</a>

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
