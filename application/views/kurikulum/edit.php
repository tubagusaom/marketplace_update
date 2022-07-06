<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Kurikulum : </td>
                    <td>
                        <input id="nama_kurikulum" name="nama_kurikulum" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_kurikulum ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Hours : </td>
                    <td>
                        <input id="hours" name="hours" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->hours ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>