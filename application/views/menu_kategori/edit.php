<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;text-align:left;">Menu </td>
                    <td>
                        : <input id="menu_kategori" name="menu_kategori" style="width: 280px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->menu_kategori ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;text-align:left;">Keterangan Menu </td>
                    <td>
                        : <input id="description" name="description" style="width: 280px;" class="easyui-textbox" value="<?php echo $data->description ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
