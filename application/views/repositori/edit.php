<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Document Name : </td>
                    <td>
                        <input id="nama_dokumen" name="nama_dokumen" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_dokumen ?>">
                    </td>
                </tr>
               <tr>
                    <td style="width: 100px;">Kategori : </td>
                    <td>
                    <?php 
                    
                    echo form_dropdown('id_categories', $id_categories, $data->id_categories, 'id="id_categories" class="easyui-combobox"  data-options="required: true"'); ?>
                        
                    </td>
                </tr>
                <tr>
					<td style="width: 80px;text-align: right; margin-left: 0;">Browse : </td>
					<td>
						<input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'">
                        <input type="hidden" value="<?=$data->nama_file?>" name="foto_hidden" id="foto_hidden">
                        <input type="hidden" value="<?=$data->extension?>" name="ext_hidden" id="ext_hidden">
                        <input type="hidden" value="<?=$data->file_size?>" name="size_hidden" id="size_hidden">
                        <input type="hidden" value="<?=$data->id?>" name="kode_hidden" id="kode_hidden">
                        
					</td>
				</tr>
               
                <tr>
                    <td style="width: 100px;">Permissions : </td>
                    <td>
                     <?php echo form_dropdown('permisions', $permisions, $data->permisions, 'id="permisions" class="easyui-combobox"  data-options="required: true"');
                        ?>
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Summary : </td>
                    <td>
                        <textarea id="summary" name="summary" style="width: 250px;" rows="3" cols="50" ><?=$data->summary?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Description : </td>
                    <td>
                        <textarea id="description" name="description" style="width: 250px;" rows="3" cols="50" ><?=$data->description?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;"> </td>
                    <td>
                        <a onclick="simpan_artikel_repositori()" id="btn-save" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'">Simpan Artikel</a>
                </tr> 
                <tr>
                    <td style="width: 150px;">Images Cover: </td>
                    <td>
                        <input id="img_cover" name="img_cover" class="nama_file" value="<?=$data->img_cover?>">
                       
                        <a onclick="buka()" href="javascript:void(0)">Browse</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;"> </td>
                     <td><img src="<?=base_url().'assets/files/repositori/'.$data->img_cover?>" width="350" height="300"/>
                        
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
 <div id="dd" ></div>
<script type="text/javascript">
$("#description").cleditor({
        width:550, height:230
    });
function simpan_artikel_repositori(){
    var description = $('#description').val();
   // var $ = jQuery;
  var editor = $('#description').cleditor()[0];
  var sResult = editor.$area.val();
    var id = $('#kode_hidden').val();
    var link_href = 'repositori/proses';
            var link_url = "";
            if(link_href.charAt(link_href.length -1) == "/")
            {
                link_url = link_href;
            }
            else
            {
                link_url = link_href + '/';
            }
    $.ajax({
        url: link_url,
        data:'isi='+sResult+'&id='+id,
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
    $('#dd').dialog({
        title: 'Browse File',
        width: 600,
        height: 500,
        closed: true,
        cache: false,
        
        modal: true
    });
    function buka(){
        $('#dd').dialog('open');
        $('#dd').dialog('refresh', 'sertifikat/file');
    }
</script>
                       
                    