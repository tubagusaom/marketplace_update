<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" enctype="multipart/form-data" action="<?php echo base_url().'pesan/upload'; ?>">
            <table class="table-data">
                <tr>
                    <td style="width: 130px;">Title : </td>
                    <td>
                    <input type="hidden" name="parent_id" id="parent_id" value="0" />
                    <input type="hidden" name="status_read_recepient" id="status_read_recepient" value="0" />
                    <input type="hidden" name="status_ticket" id="status_ticket" value="1" />
                    <input type="hidden" name="sender_id" id="sender_id" value="<?=$sender_id?>"  />
                    <input id="title" name="title" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Message : </td>
                    <td>
                        <textarea name="message" id="message" rows="4" cols="40"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Recipient : </td>
                    <td>
                        <input id="reciepent_id" name="reciepent_id" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Attachment: </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $users_grid;
?>
</script>