<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo base_url()."medhical/upload" ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 180px;">Student Name : </td>
                    <td>
                        <input id="siswa_id" name="siswa_id" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Medhical Name : </td>
                    <td>
                        <input id="medhical_name" name="medhical_name" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Created Date : </td>
                    <td>
                        <input id="certificate_date" name="certificate_date" style="width: 250px;" class="easyui-datebox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Expired Date : </td>
                    <td>
                        <input id="certificate_expired_date" name="certificate_expired_date" style="width: 250px;" class="easyui-datebox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Signature By : </td>
                    <td>
                        <input id="assign_by" name="assign_by" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                
                <tr>
                    <td style="width: 150px;">File Attachment: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div><script type="text/javascript">
	<?php 
		echo $siswa_grid; 
        
</script>