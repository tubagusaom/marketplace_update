<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Nama Controller : </td>
                    <td>
                        <input id="controller_name" name="controller_name" style="width: 200px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->controller_name ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Nama Method : </td>
                    <td>
                        <input id="method_name" name="method_name" style="width: 200px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->method_name ?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Role ID : </td>
                    <td>
                        <?php echo form_dropdown('role_id', $role, '', 'id="role_id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Request Method : </td>
                    <td>
                        <?php echo form_dropdown('request_method', $ajax, '', 'id="request_method" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>