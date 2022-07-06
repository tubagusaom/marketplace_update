<div class="form-panel" style="margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <tr>
                    <td>Tag Iklan : </td>
                    <td>
                        <input id="nama_iklan" name="nama_iklan" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>
                  <tr>
                      <td>Status Iklan : </td>
                      <td>
                          <select class="form_dropdown" name="status_iklan" style="width: 280px;">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                          </select>
                      </td>
                  </tr>

                  <tr>
                      <td>Urutan : </td>
                      <td>
                          <input id="urutan_iklan" type="number" name="urutan_iklan" style="width: 280px;" class="easyui-numberbox" >
                      </td>
                  </tr>

                <tr>
                    <td>image : </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 280px;" data-options="buttonText: 'Pilih gambar'" />
                        <br> <b style="color:red;font-size:11px;float:right;">Ukuran gambar 305 x 129</b>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script type="text/javascript">
<?php
 // echo $status_iklan;
?>
</script>
