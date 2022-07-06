<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Program Studi : </td>
                    <td>
                      <input type="hidden" id="is_user" name="is_user"  value="0" >
                        <?php echo form_dropdown('id_prodi', $prodi,'', 'id="id_prodi" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Angkatan : </td>
                    <td>
                        <?php echo form_dropdown('id_angkatan', $angkatan,'', 'id="id_angkatan" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Nim : </td>
                    <td>
                        <input id="nim_calon" name="nim_calon" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td>Nama : </td>
                    <td>
                        <input id="nama_calon" name="nama_calon" style="width: 280px;" class="easyui-textbox"  data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td>Kelas : </td>
                    <td>
                        <input id="kelas_calon" name="kelas_calon" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td>Semester : </td>
                    <td>
                        <input id="semester_calon" name="semester_calon" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>

                <tr>
                    <td>Email : </td>
                    <td>
                        <input type="email" id="email_calon" name="email_calon" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td>HP : </td>
                    <td>
                        <input type="number" id="hp_calon" name="hp_calon" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
