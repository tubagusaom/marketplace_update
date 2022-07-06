<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Nama Pelatihan : </td>
                    <td>
                         <input id="nama_pelatihan" name="nama_pelatihan" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_pelatihan ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Durasi Waktu : </td>
                    <td>
                         <input id="durasi" name="durasi" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->durasi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Jam : </td>
                    <td>
                         <input id="jam" name="jam" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->jam ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Narasumber : </td>
                    <td>
                        <?php echo form_dropdown('id_trainer', $nama_trainer, $data->id_trainer, 'id="id_trainer" class="easyui-combobox"  data-options="required: true" style="width: 250px;"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Description : </td>
                    <td>
                         <input id="deskripsi" name="deskripsi" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->deskripsi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Biaya : </td>
                    <td>
                         <input id="biaya" name="biaya" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->biaya ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>