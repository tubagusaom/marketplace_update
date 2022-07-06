<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 80px;">Judul : </td>
                    <td>
                        <input id="judul" name="judul" style="width: 280px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 80px;">Kategori : </td>
                    <td>
                        <?php echo form_dropdown('id_kategori', $kategori, '', 'id="id_kategori" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 80px;">Headline : </td>
                    <td>
                        <input id="headline" name="headline" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 80px;">Isi Artikel : </td>
                    <td>
                        <textarea id="isi" name="isi"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">Foto: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 280px;" data-options="buttonText: 'Pilih File'" /> 
                        <input type="checkbox" class="" name="show_image" id="show_image" /> Show Image
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    $(function(){
        $("#isi").cleditor({
        width:550, height:230
    });
    })
</script>