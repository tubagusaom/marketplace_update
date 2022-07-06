<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Status Blanko : </td>
                    <td>
                        <?php echo form_dropdown('status_blanko', $status_blanko, $data->status_blanko, 'id="status_blanko" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Keterangan : </td>
                    <td>
                        <input id="status_kondisi" name="status_kondisi" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->status_kondisi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nama Pemegang Sertifikat : </td>
                    <td>
                        <input disabled id="nama_lengkap" name="nama_lengkap" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_lengkap ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">No Registrasi : </td>
                    <td>
                        <input disabled id="no_registrasi" name="no_registrasi" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->no_registrasi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">NO Sertifikat : </td>
                    <td>
                        <input disabled id="no_sertifikat" name="no_sertifikat" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->no_sertifikat ?>">
                    </td>
                </tr>
               
            </table>
        </form>
    </div>
</div>