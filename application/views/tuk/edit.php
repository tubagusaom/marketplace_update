<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                 <tr>
                    <td>Program Studi : </td>
                    <td>
                        <?php echo form_dropdown('id_prodi', $prodi,$data->id_prodi, 'id="id_prodi" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Kode Prodi TUK : </td>
                    <td>
                        <input id="no_cab" name="no_cab" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->no_cab ?>">
                        <input type="hidden" id="is_users" name="is_users" value="<?php echo $data->is_users ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nama Prodi TUK : </td>
                    <td>
                        <input id="tuk" name="tuk" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->tuk ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Alamat : </td>
                    <td>
                        <textarea rows="3" cols="40" id="alamat" name="alamat"><?php echo $data->alamat ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">No Telepon : </td>
                    <td>
                        <input id="telp" name="telp" style="width: 250px;" value="<?php echo $data->telp ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">No HP : </td>
                    <td>
                        <input id="hp" name="hp" style="width: 250px;" value="<?php echo $data->hp ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Email : </td>
                    <td>
                        <input id="email_tuk" name="email_tuk" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->email_tuk ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Provinsi : </td>
                    <td>
                        <input id="provinsi" name="provinsi" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->provinsi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Kabupaten / Kota: </td>
                    <td>
                        <input id="kabupaten" name="kabupaten" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->kabupaten ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Logo: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'"  />
                       
                        <input type="hidden" name="foto_hidden" id="foto_hidden" value="<?php echo $data->foto ?>" />
                </tr>   
            </table>
        </form>
    </div>
</div>