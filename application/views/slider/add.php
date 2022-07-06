<div class="form-panel" style="margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <!-- <tr>
                    <td>Text Atas : </td>
                    <td>
                        <input id="nama_slide1" name="nama_slide1" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>
                  <tr>
                      <td>Text Bawah : </td>
                      <td>
                          <input id="nama_slide2" name="nama_slide2" style="width: 280px;" class="easyui-textbox" >
                      </td>
                  </tr> -->
                <tr>
                    <td>image : </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 280px;" data-options="buttonText: 'Pilih slide'" />
                        <br> <b style="color:red;font-size:11px;float:right;">Ukuran gambar 820 x 405</b>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
