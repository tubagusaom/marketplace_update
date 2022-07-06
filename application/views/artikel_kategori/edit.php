<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Categories : </td>
                    <td>
                        <input id="kategori" name="kategori" style="width: 200px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->kategori ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Description: </td>
                    <td>
                        <input id="description" name="description" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->description ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>