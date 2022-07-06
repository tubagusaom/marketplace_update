<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
              <tr>
                  <td style="width: 100px;text-align:left;">Menu</td>
                  <td>
                      : <?php echo form_dropdown('id_menu', $menu, '', 'id="id_menu" class="easyui-combobox" style="width: 250px;" data-options="required: true"'); ?>
                  </td>
              </tr>
                <tr>
                    <td style="width: 100px;text-align:left;">Kategori</td>
                    <td>
                         : <input id="kategori" name="kategori" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;text-align:left;">Keterangan</td>
                    <td>
                        : <input id="description" name="description" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
