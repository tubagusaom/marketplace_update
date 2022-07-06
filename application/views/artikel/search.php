<div class="form-panel" style="margin-left: -10px;margin-top: 30px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td>Batch : </td>
                    <td>
                        <?php echo form_dropdown('id_kategori', $kategori, '', 'id="id_kategori" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
</div>