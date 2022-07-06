<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 140px;">Nama Asesor : </td>
                    <td>
                        <input id="users" name="users" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->users ?>">
                        <input type="hidden" id="is_users" name="is_users" value="<?php echo $data->is_users ?>">
                        <input type="hidden" name="id_group_users" value="6">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">No Registrasi : </td>
                    <td>
                        <input id="no_reg" name="no_reg" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->no_reg ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Email : </td>
                    <td>
                        <input id="email" name="email" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->email ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">HP : </td>
                    <td>
                        <input id="hp" name="hp" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->hp ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>