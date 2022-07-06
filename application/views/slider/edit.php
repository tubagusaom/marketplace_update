<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
         <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 50px;">Text Atas : </td>
                    <td>
                        <input id="nama_slide1" name="nama_slide1" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_slide1 ?>">
                    </td>
                </tr>
                  <tr>
                      <td style="width: 50px;">Text Bawah : </td>
                      <td>
                          <input id="nama_slide2" name="nama_slide2" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_slide2 ?>">
                      </td>
                  </tr>
                <tr>
                    <td style="width: 150px;">Image : </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" value="<?php echo $data->foto_slide ?>" data-options="buttonText: 'Pilih Slide'"  />

                        <input type="hidden" name="foto_hidden" id="foto_hidden" value="<?php echo $data->foto_slide ?>" />
                </tr>
            </table>
        </form>
    </div>
</div>
