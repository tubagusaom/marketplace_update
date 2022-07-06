<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
<form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Nama Jadwal Asesmen: </td>
                    <td>
                         <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $data->tanggal ?>" />
                         <input id="jadual" name="jadual" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->jadual ?>">
                    </td>
                </tr>

                 <tr>
                    <td style="width: 150px;">Status Jadwal: </td>
                    <td>
                        <?php echo form_dropdown('status_jadwal', $status_jadwal, $data->status_jadwal, 'id="status_jadwal" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Ringkasan : </td>
                    <td>
                        <textarea rows="4" cols="40" name="ringkasan_asesmen" id="ringkasan_asesmen" ><?php echo $data->ringkasan_asesmen ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Dokumen Lampiran : </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'"  />
                        <input type="hidden" name="dokumen_berita_acara" id="dokumen_berita_acara" value="<?php echo $data->dokumen_berita_acara ?>" />
                    </td>
                </tr>

            </table>
            <table class="easyui-datagrid" style="width: 97%;" data-options="nowrap:false,striped:true,rownumbers:true">
            <thead>
                <tr><th data-options="field:'kode_unit'" style="width: 52%;">Nama Peserta Uji</th>
                <th data-options="field:'nama_unit',align:'center'" style="width: 25%;">Rekomendasi Asesor</th>
                <th data-options="field:'nama_unit2',align:'center'" style="width: 15%;">Sertifikat</th>

            </thead>
            <tbody>
                <?php
                foreach($asesi_kompeten as $value){
                        if($value->rekomendasi_asesor=='1'){
                            $rekomendasi = 'Kompeten';
                        }else if($value->rekomendasi_asesor=='2'){
                            $rekomendasi = 'Belum Kompeten';
                        }else{
                            $rekomendasi = '-';
                        }
                        echo '<tr><td>'.$value->nama_lengkap.'</td><td>'.$rekomendasi.'</td>
                        <td style="text-align:center;">
                        <input type="checkbox" name="terbitkan_sertifikat['.$value->id.']" value="1" '.($value->terbitkan_sertifikat=='on'?"checked":"").'/></td>
                        </tr>';
                    }
                ?>
            </tbody>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $pra_asesmen_grid;

?>
</script>
