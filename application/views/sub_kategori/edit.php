<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
              <tr>
                  <td style="width: 100px;text-align:left;">Kategori</td>
                  <td>
                      : <?php echo form_dropdown('id_kategori', $kategori, $data->id_kategori, 'id="id_menu" class="easyui-combobox" style="width: 250px;" data-options="required: true"'); ?>
                  </td>
              </tr>
                <tr>
                    <td style="width: 100px;text-align:left;">Sub Kategori</td>
                    <td>
                         : <input id="sub_kategori" name="sub_kategori" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?=$data->sub_kategori?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;text-align:left;">Description</td>
                    <td>
                        : <input id="description" name="description" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?=$data->description?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
