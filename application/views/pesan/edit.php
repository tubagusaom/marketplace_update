<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">NIS : </td>
                    <td>
                        <input id="nis" name="nis" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nis ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nama Siswa : </td>
                    <td>
                        <input id="nama" name="nama" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tahun Angkatan : </td>
                    <td>
                        <?php echo form_dropdown('batch_id', $angkatan, $data->batch_id, 'id="batch_id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Base Location : </td>
                    <td>
                        <?php echo form_dropdown('base', $base, $data->base, 'id="base" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Program Study : </td>
                    <td>
                        <?php echo form_dropdown('program_id', $program, $data->program_id, 'id="program_id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Current Program : </td>
                    <td>
                        <?php echo form_dropdown('current_program', $current_program, $data->current_program, 'id="current_program" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">License Number : </td>
                    <td>
                        <input id="spl" name="spl" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->spl ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Gender : </td>
                    <td>
                        <?php echo form_dropdown('gender', $gender, $data->gender, 'id="id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tempat Lahir : </td>
                    <td>
                        <input id="tempat_lahir" name="tempat_lahir" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->tempat_lahir ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tanggal Lahir : </td>
                    <td>
                        <input id="tgl_lahir" name="tgl_lahir" style="width: 250px;" class="easyui-datebox" data-options="required: true" value="<?php echo date('d/m/Y', strtotime($data->tgl_lahir)) ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Agama : </td>
                    <td>
                        <?php echo form_dropdown('agama', $agama, $data->agama, 'id="id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Alamat : </td>
                    <td>
                        <input id="alamat" name="alamat" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->alamat ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Email : </td>
                    <td>
                        <input id="email_siswa" name="email_siswa" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->email_siswa ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Telepon : </td>
                    <td>
                        <input id="telepon" name="telepon" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->telepon ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Orang Tua : </td>
                    <td>
                        <input id="orang_tua" name="orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->orang_tua ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Pekerjaan Orang Tua : </td>
                    <td>
                        <input id="kerja_orang_tua" name="kerja_orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->kerja_orang_tua ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Telepon Orang Tua : </td>
                    <td>
                        <input id="telepon_orang_tua" name="telepon_orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->telepon_orang_tua ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Email Orang Tua : </td>
                    <td>
                        <input id="email_orang_tua" name="email_orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->email_orang_tua ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Foto: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'"  />
                        <input type="hidden" name="foto_hidden" id="foto_hidden" value="<?php echo $data->foto ?>" />
                </tr>				
            </table>
        </form>
    </div>
</div>

