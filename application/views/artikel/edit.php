<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
         <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
            <tr>
                    <td style="width: 50px;">Id : </td>
                    <td>
                        "<?php echo $data->id ?>"
                        <input type="hidden" id="kode_hidden" value="<?php echo $data->id ?>" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 50px;">Judul : </td>
                    <td>
                        <input id="judul" name="judul" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->judul ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 50px;">Kategori : </td>
                    <td>
                        <?php echo form_dropdown('id_kategori', $kategori, $data->id_kategori, 'id="id_kategori" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50px;">Headline : </td>
                    <td>
                        <input id="headline" name="headline" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->headline ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 50px;">Isi Artikel : </td>
                    <td>
                        <textarea name="isi" id="isi" rows="4" cols="50">
                            <?php echo $data->isi ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Foto: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'"  />
                        

                         <input type="checkbox" class="" name="show_image" id="show_image" <?php echo ($data->show_image == '1' ? 'checked' :''); ?> /> Show Image

                        <input type="hidden" name="foto_hidden" id="foto_hidden" value="<?php echo $data->foto ?>" />
                </tr>   
                <tr>
                    <td style="width: 150px;"> </td>
                    <td>
                        <a onclick="simpan_artikel()" id="btn-save" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'">Simpan Artikel</a>
                </tr>               
            </table>
        </form>
    </div>
</div>
<script>
$("#isi").cleditor({
        width:550, height:230
    });
function simpan_artikel(){
    var isi = $('#isi').val();
    var isi = "<?php urlencode("+isi+")?>";
   // var $ = jQuery;
  var editor = $('#isi').cleditor()[0];
  var sResult = editor.$area.val();
  console.log('TEXTAREA=' + sResult);

    var id = $('#kode_hidden').val();
    var link_href = 'artikel/proses';
            var link_url = "";
            if(link_href.charAt(link_href.length -1) == "/")
            {
                link_url = link_href;
            }
            else
            {
                link_url = link_href + '/';
            }
    var dubai = {isi:sResult, id:id};
   
    $.ajax({
        url: link_url,
        data:dubai,
        type: 'POST',
        success: function(result){
            if(result.msgType == 'error')
            {
                $.messager.alert('Error', 'Data berhasil di simpan');
            }           
            else
            {
                $.messager.alert('Sukses', 'Data berhasil di simpan');
            }
        }
    })
}
</script>
