<div class="form-panel" style="margin-left: -10px;margin-top: 30px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">NIS : </td>
                    <td>
                        <input id="nis" name="nis" style="width: 300px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td>Nama : </td>
                    <td>
                        <input id="nama" name="nama" style="width: 300px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td>Batch : </td>
                    <td>
                        <?php echo form_dropdown('batch_id', $angkatan, '', 'id="batch_id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Base : </td>
                    <td>
                        <?php echo form_dropdown('base', $base, '', 'id="base" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Current Program : </td>
                    <td>
                        <?php echo form_dropdown('current_program', $current_program, '', 'id="current_program" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>