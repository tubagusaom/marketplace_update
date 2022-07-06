<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <input type="hidden" id="is_user" name="is_user" value="<?php echo $data->is_user ?>">
                <tr>
                    <td>Nim : </td>
                    <td>
                        <input id="nim_calon" name="nim_calon" style="width: 280px;" class="easyui-textbox"  value="<?php echo $data->nim_calon ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nama : </td>
                    <td>
                        <input id="nama_calon" name="nama_calon" style="width: 280px;" class="easyui-textbox"  value="<?php echo $data->nama_calon ?>">
                    </td>
                </tr>
                <tr>
                    <td>Kelas : </td>
                    <td>
                        <input id="kelas_calon" name="kelas_calon" style="width: 280px;" class="easyui-textbox"  value="<?php echo $data->kelas_calon ?>">
                    </td>
                </tr>
                <tr>
                    <td>Semester : </td>
                    <td>
                        <input id="semester_calon" name="semester_calon" style="width: 280px;" class="easyui-textbox"  value="<?php echo $data->semester_calon ?>">
                    </td>
                </tr>
                <tr>
                    <td>Tahun Akademik : </td>
                    <td>
                        <?php echo form_dropdown('id_angkatan', $angkatan,$data->id_angkatan, 'id="id_angkatan" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Program Studi : </td>
                    <td>
                        <!-- <input id="program_studi_calon" name="program_studi_calon" style="width: 280px;" class="easyui-textbox"  value="<?php echo $data->program_studi_calon ?>"> -->
                        <?php echo form_dropdown('id_prodi', $prodi,$data->id_prodi, 'id="id_prodi" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Email : </td>
                    <td>
                        <input id="email_calon" name="email_calon" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->email_calon ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">HP : </td>
                    <td>
                        <input id="hp_calon" name="hp_calon" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->hp_calon ?>">
                    </td>
                </tr>

                <?php
                  $login=$data->is_user;

                  if ($login == 1) {
                    echo "";
                  }else {
                ?>

                <tr>
                    <td style="width: 140px;"></td>
                    <td>
                        <input type="checkbox" id="akses_login" name="akses_login" value="1" <?=$checked ?> /> Akses Login
                    </td>
                </tr>

                <?php } ?>
            </table>
        </form>
    </div>
</div>
