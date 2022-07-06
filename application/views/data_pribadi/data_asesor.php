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
                    <td style="width: 150px;">No Registrasi / No MET : </td>
                    <td>
                        <input id="nis" name="nis" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $profil_asesor->no_reg ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nama Lengkap : </td>
                    <td>

                        <input id="nama" name="nama" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $profil_asesor->users ?>">
                    </td>
                </tr>
                
                <tr>
                    <td style="width: 100px;">Jenis Kelamin : </td>
                    <td>
                        <?php echo form_dropdown('sex', $sex, $profil_asesor->sex, 'id="id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Place of birth : </td>
                    <td>
                        <input id="tempat_lahir" name="tempat_lahir" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $profil_asesor->tempat_lahir ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Date of birth : </td>
                    <td>
                        <input id="tgl_lahir" name="tgl_lahir" style="width: 250px;" class="easyui-datebox" data-options="required: true" value="<?php echo date('d/m/Y', strtotime($profil_asesor->tgl_lahir)) ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Email : </td>
                    <td>
                        <input id="email" name="email" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $profil_asesor->email ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Telephone : </td>
                    <td>
                        <input id="hp" name="hp" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $profil_asesor->hp ?>">
                    </td>
                </tr>
               
                 <tr>
                    <td style="width: 100px;">Type Identity : </td>
                    <td>
                        <input placeholder="KTP/SIM/Kartu Pelajar" id="identity_type" name="identity_type" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->identity_type ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Identity Number : </td>
                    <td>
                        <input id="identity_number" name="identity_number" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->identity_number ?>">
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
                        <textarea id="alamat" name="alamat" rows="4" cols="40"><?php echo $profil_asesor->alamat ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Postal Code : </td>
                    <td>
                        <input id="pos_code" name="pos_code" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->pos_code ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nationality : </td>
                    <td>
                        <input id="nationality" name="nationality" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->nationality ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Province : </td>
                    <td>
                        <input id="province" name="province" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->province ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">District : </td>
                    <td>
                        <input id="district" name="district" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->district ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Sub District : </td>
                    <td>
                        <input id="sub_district" name="sub_district" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->sub_district ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Village / Kelurahan: </td>
                    <td>
                        <input id="village" name="village" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->village ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">RT : </td>
                    <td>
                        <input id="rt" name="rt" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->rt ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">RW : </td>
                    <td>
                        <input id="rw" name="rw" style="width: 250px;" class="easyui-textbox"  value="<?php echo $profil_asesor->rw ?>">
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
                        <input type="hidden" name="foto_hidden" id="foto_hidden" value="<?php echo $profil_asesor->foto_user ?>" />
                </tr>				
            </table>
        </form>
    </div>
</div>

