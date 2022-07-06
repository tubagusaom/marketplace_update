<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Nama Trainer : </td>
                    <td>
                         <input id="nama_trainer" name="nama_trainer" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_trainer ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Telepon : </td>
                    <td>
                         <input id="telp" name="telp" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->telp ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Email : </td>
                    <td>
                         <input id="email" name="email" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->email ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Pendidikan Terakhir : </td>
                    <td>
                         <input id="pendidikan_terakhir" name="pendidikan_terakhir" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->pendidikan_terakhir ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Bidang Keahlian : </td>
                    <td>
                         <input id="bidang" name="bidang" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->bidang ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Foto: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'" />
                        <input type="hidden" name="foto_hidden" id="foto_hidden" value="<?php echo $data->foto ?>" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>