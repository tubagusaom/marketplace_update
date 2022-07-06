<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Plane Code : </td>
                    <td>
                        <input id="plane_code" name="plane_code" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Plane Name : </td>
                    <td>
                        <input id="plane_name" name="plane_name" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tahun Pembuatan : </td>
                    <td>
                        <input id="tahun_buat" name="tahun_buat" style="width: 250px;" class="easyui-datebox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Kategori : </td>
                    <td>
                        <?php echo form_dropdown('kategori', $kategori, '', 'id="id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>