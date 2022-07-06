<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
        <div id="tips">
            <ol class="rounded-list">
                <li><a href="javascript: void(0)">Personal Data</a></li>
            </ol>
        </div>
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">NIS : </td>
                    <td>
                        <input id="nis" name="nis" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nis ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Student Name : </td>
                    <td>
                        <input id="nama" name="nama" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Batch : </td>
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
                    <td style="width: 100px;">Place of birth : </td>
                    <td>
                        <input id="tempat_lahir" name="tempat_lahir" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->tempat_lahir ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Date of birth : </td>
                    <td>
                        <input id="tgl_lahir" name="tgl_lahir" style="width: 250px;" class="easyui-datebox" data-options="required: true" value="<?php echo date('d/m/Y', strtotime($data->tgl_lahir)) ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Religion : </td>
                    <td>
                        <?php echo form_dropdown('agama', $agama, $data->agama, 'id="id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Email : </td>
                    <td>
                        <input id="email_siswa" name="email_siswa" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->email_siswa ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Telephone : </td>
                    <td>
                        <input id="telepon" name="telepon" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->telepon ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Hair Color : </td>
                    <td>
                        <input id="hair_color" name="hair_color" style="width: 250px;" class="easyui-textbox"   value="<?php echo $data->hair_color ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Eye Color : </td>
                    <td>
                        <input id="eye_color" name="eye_color" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->eye_color ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Height : </td>
                    <td>
                        <input id="height" name="height" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->height ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Weight : </td>
                    <td>
                        <input id="weight" name="weight" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->weight ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Type Identity : </td>
                    <td>
                        <input placeholder="KTP/SIM/Kartu Pelajar" id="identity_type" name="identity_type" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->identity_type ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Identity Number : </td>
                    <td>
                        <input id="identity_number" name="identity_number" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->identity_number ?>">
                    </td>
                </tr>
                </table>
                <div id="tips">
                    <ol class="rounded-list">
                        <li><a href="javascript: void(0)">Data Domicile</a></li>
                    </ol>
                </div>
            <table class="table-data">

                <tr>
                    <td style="width: 150px;">Address : </td>
                    <td>
                        <textarea id="alamat" name="alamat" rows="4" cols="40"><?php echo $data->alamat ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Postal Code : </td>
                    <td>
                        <input id="pos_code" name="pos_code" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->pos_code ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nationality : </td>
                    <td>
                        <input id="nationality" name="nationality" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->nationality ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Province : </td>
                    <td>
                        <input id="province" name="province" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->province ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">District : </td>
                    <td>
                        <input id="district" name="district" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->district ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Sub District : </td>
                    <td>
                        <input id="sub_district" name="sub_district" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->sub_district ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Village / Kelurahan: </td>
                    <td>
                        <input id="village" name="village" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->village ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">RT : </td>
                    <td>
                        <input id="rt" name="rt" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->rt ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">RW : </td>
                    <td>
                        <input id="rw" name="rw" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->rw ?>">
                    </td>
                </tr>
            </table>
                <div id="tips">
                    <ol class="rounded-list">
                        <li><a href="javascript: void(0)">Data Parents</a></li>
                    </ol>
                </div>
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Parents : </td>
                    <td>
                        <input id="orang_tua" name="orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->orang_tua ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Parents Job : </td>
                    <td>
                        <input id="kerja_orang_tua" name="kerja_orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->kerja_orang_tua ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Phone Parent : </td>
                    <td>
                        <input id="telepon_orang_tua" name="telepon_orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->telepon_orang_tua ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Email Parent : </td>
                    <td>
                        <input id="email_orang_tua" name="email_orang_tua" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->email_orang_tua ?>">
                    </td>
                </tr>
            </table>
                <div id="tips">
                    <ol class="rounded-list">
                        <li><a href="javascript: void(0)">Foto</a></li>
                    </ol>
                </div>
            <table class="table-data">
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

