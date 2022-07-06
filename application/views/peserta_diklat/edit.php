<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <div>
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Mengirim Akses Login Peserta</a></li>
                </ol>
            </div>
            <table class="table-data">
                <input type="hidden" value="<?= $data->id; ?>" id="id" name="id">
                <input type="hidden" value="<?= $data->dk_status_paid; ?>" id="dk_status_paid" name="dk_status_paid">
                <tr>
                    <td style="width: 150px;"></td>
                    <td>
                        <input type="checkbox" value="<?=$data->akses_login?>" name="akses_login" value="1" /> Akses Login

                    </td>
                </tr>
            </table>
            <div id="tips">
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Biodata Peserta Diklat</a></li>
                </ol>
            </div>
            
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Nama Lengkap: </td>
                    <td>
                        <input id="dk_name_full" name="dk_name_full" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->dk_name_full ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tempat Lahir: </td>
                    <td>
                        <input id="dk_born_place" name="dk_born_place" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->dk_born_place ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tanggal Lahir: </td>
                    <td>
                        <input id="dk_born_date" name="dk_born_date" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->dk_born_date ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Alamat: </td>
                    <td><textarea rows="4" cols="40" name="dk_address" id="dk_address" ><?php echo $data->dk_address ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Perusahaan : </td>
                    <td>
                        <input id="dk_office_name" name="dk_office_name" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->dk_office_name ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Posisi: </td>
                    <td>
                        <input id="dk_office_position" name="dk_office_position" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->dk_office_position ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Pendidikan: </td>
                    <td>
                        <input id="dk_edu" name="dk_edu" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->dk_edu ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">HP: </td>
                    <td>
                        <input id="dk_hp" name="dk_hp" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->dk_hp ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Email: </td>
                    <td>
                        <input id="dk_email" name="dk_email" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->dk_email ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
