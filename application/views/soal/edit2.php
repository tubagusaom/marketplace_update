<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
        <div id="tips">
                    <ol class="rounded-list">
                        <li><a href="javascript: void(0)">Delegasi Pra Asesmen</a></li>
                    </ol>
                </div>
            <table class="table-data">
                <input type="hidden" value="<?=$data->file_bukti_pendukung; ?>" id="file_bukti_pendukung" name="file_bukti_pendukung">
                <input type="hidden" value="<?=$data->bukti_pendukung; ?>" id="bukti_pendukung" name="bukti_pendukung">
                <input type="hidden" value="<?=$data->tgl_lahir; ?>" id="tgl_lahir" name="tgl_lahir">
                <input type="hidden" value="<?=$data->organisasi; ?>" id="organisasi" name="organisasi">
                <input type="hidden" value="<?=$data->is_perpanjangan; ?>" id="is_perpanjangan" name="is_perpanjangan">
                
                
                 <tr>
                    <td style="width: 150px;">Pra Asesmen Checked: </td>
                    <td>
                        <input id="pra_asesmen_checked" name="pra_asesmen_checked" style="width: 200px;"  value="<?php echo $data->pra_asesmen_checked; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;"></td>
                    <td>
                        <input type="checkbox" name="akses_login" value="1" /> Akses Login
                        
                    </td>
                </tr>
                </table>
                 <div id="tips">
                    <ol class="rounded-list">
                        <li><a href="javascript: void(0)">Biodata Peserta / APL 01</a></li>
                    </ol>
                </div>
                <table class="table-data">
                <tr>
                    <td style="width: 150px;">No Identitas: </td>
                    <td>
                        <input type="hidden" id="u_date_create" name="u_date_create" value="<?php echo $data->u_date_create ?>">
                        <input id="no_identitas" name="no_identitas" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_identitas ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">No UJK: </td>
                    <td>
                        <input id="no_uji_kompetensi" name="no_uji_kompetensi" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_uji_kompetensi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">TUK : </td>
                    <td>
                        <?php echo form_dropdown('id_tuk', $tuk, $data->id_tuk, 'id="controller_id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Skema : </td>
                    <td>
                        <?php echo form_dropdown('skema_sertifikasi', $skema, $data->skema_sertifikasi, 'id="skema_sertifikasi" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Nama Lengkap: </td>
                    <td>
                        <input id="nama_lengkap" name="nama_lengkap" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->nama_lengkap ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Organisasi / Instansi: </td>
                    <td>
                        <input id="organisasi" name="organisasi" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->organisasi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Telpon : </td>
                    <td>
                        <input id="telp" name="telp" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->telp ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Email: </td>
                    <td>
                        <input id="skema" name="email" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->email ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tempat Lahir: </td>
                    <td>
                        <input id="tempat_lahir" name="tempat_lahir" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->tempat_lahir ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Tanggal Lahir: </td>
                    <td>
                        <input id="tgl_lahir" name="tgl_lahir" style="width: 200px;" class="easyui-datebox" 
                        value="<?php echo date('d/m/Y', strtotime($data->tgl_lahir)) ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Jenis Kelamin: </td>
                    <td>
                        <?php echo form_dropdown('jenis_kelamin', $jenis_kelamin, $data->jenis_kelamin, 'id="jenis_kelamin" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Alamat: </td>
                    <td>
                        <textarea rows="4" cols="40" name="alamat" id="alamat" ><?php echo $data->alamat ?></textarea>
                    </td>
                </tr>
               
               
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $pra_asesmen_grid;
?>
var nama_asesor = '<?php echo $nama_asesor?>';
var id_asesor = '<?php echo $data->pra_asesmen_checked?>';
//console.log(id_asesor);
if(id_asesor != '0'){
    $("#pra_asesmen_checked").combogrid('setValue',{id:id_asesor,nama_user:nama_asesor});
}
</script>