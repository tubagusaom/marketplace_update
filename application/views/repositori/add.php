<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo base_url() ?>repositori/upload">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Document Name : </td>
                    <td>
                        <input id="nama_dokumen" name="nama_dokumen" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <?php
                $jenis_user = $this->auth->get_user_data()->jenis_user;
                if($jenis_user=='4'){

                ?>
                <tr>
                    <td style="width: 100px;">Kategori : </td>
                    <td>
                    <?php 
                    
                    echo form_dropdown('id_categories', $id_categories, '', 'id="id_categories" class="easyui-combobox"  data-options="required: true"'); ?>
                        
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Path : </td>
                    <td>
                    <?php 
                    
                    echo form_dropdown('path', $path, '', 'id="path" class="easyui-combobox"  data-options="required: true"'); ?>
                        
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Permissions : </td>
                    <td>
                        <?php echo form_dropdown('permisions', $permisions, '', 'id="permisions" class="easyui-combobox"  data-options="required: true"'); ?>
                        
                    </td>
                </tr>
                <?php }else{ ?>

                    <input type="hidden" name="id_categories" value="8">
                    <input type="hidden" name="path" value="0">
                    <input type="hidden" name="permisions" value="1">
                <?php } ?>
                <tr>
					<td style="width: 80px;text-align: right; margin-left: 0;">Browse : </td>
					<td>
						<input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'">
					</td>
				</tr>
                
               
                <tr>
                    <td style="width: 150px;">Description : </td>
                    <td>
                        <textarea id="description" name="description" style="width: 250px;" rows="3" cols="50" ></textarea>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>