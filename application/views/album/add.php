<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Judul Album : </td>
                    <td>
                         <input id="nama_album" name="nama_album" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Kategori : </td>
                    <td>
                        <?php echo form_dropdown('id_kategori', $kategori, '', 'id="id_kategori" class="easyui-combobox" style="width: 250px;" data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Description : </td>
                    <td>
                         <input id="keterangan" name="keterangan" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
<!--                 <tr>
                    <td style="width: 150px;">Image: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'" />
                    </td>
                </tr> -->
            </table>
        </form>
    </div>
</div>