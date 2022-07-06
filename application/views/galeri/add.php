<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Nama File : </td>
                    <td>
                        <input id="nama_file" name="nama_file" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Kategori : </td>
                    <td>
                        <?php echo form_dropdown('id_kategori', $kategori, '', 'id="id_kategori" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Album : </td>
                    <td>
                        <?php echo form_dropdown('id_album', $nama_album, '', 'id="id_album" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Keterangan : </td>
                    <td>
                        <input id="keterangan" name="keterangan" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Image: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>