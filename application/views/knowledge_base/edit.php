<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo $url ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Title of Knowledge : </td>
                    <td>
                        <input value="<?php echo $data->title ?>" id="title" name="title" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Category : </td>
                    <td>
                        <?php echo form_dropdown('kbc_id', $kategori, $data->kbc_id, 'id="kbc_id" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Link Download Dokumen: </td>
                    <td>
                        <input value="<?php echo $data->link_download ?>" id="link_download" name="link_download" style="width: 200px;" class="easyui-textbox" >
                        <a href="<?php echo $data->link_download ?>" target="_blank" >Download</a>
                    </td>
                </tr>
                
                <tr>
                    <td style="width: 150px;">Link Download Video: </td>
                    <td>
                        <input value="<?php echo $data->link_video ?>" id="link_video" name="link_video" style="width: 200px;" class="easyui-textbox" >
                        <a href="<?php echo $data->link_video ?>" target="_blank" >Download</a>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Image Description: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'">
                        <input type="hidden" name="hidden_field" value="<?=$data->image_description?>" id="hidden_field"/>
                        
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Position Number: </td>
                    <td>
                        <input value="<?php echo $data->no_urut ?>" id="no_urut" name="no_urut" style="width: 200px;" class="easyui-textbox" >
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Summary : </td>
                    <td>
                        <textarea rows="4" cols="40" name="summary" id="summary" ><?php echo $data->summary ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Description : </td>
                    <td>
                        <textarea rows="4" cols="40" name="description" id="description" ><?php echo $data->description ?></textarea>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>