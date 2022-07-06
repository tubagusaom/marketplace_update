<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
            <tr>
                    <td style="width: 140px;">Nama Asesi : </td>
                    <td>
                        <input id="id_asesi" name="id_asesi" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->id_asesi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Jumlah Pembayaran : </td>
                    <td>
                        <input id="jumlah_pembayaran" name="jumlah_pembayaran" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->jumlah_pembayaran ?>">
                        <input type="hidden" id="created_when" name="created_when" value="<?php echo $data->created_when ?>">
                        <input type="hidden" id="bukti_pembayaran" name="bukti_pembayaran" value="<?php echo $data->bukti_pembayaran ?>">
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Tanggal Pembayaran : </td>
                    <td>
                        <input id="tanggal_pembayaran" name="tanggal_pembayaran" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->tanggal_pembayaran ?>" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Atas Nama : </td>
                    <td>
                        <input id="atas_nama" name="atas_nama" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->atas_nama ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Catatan : </td>
                    <td>
                        <input id="catatan" name="catatan" style="width: 250px;" class="easyui-textbox"  value="<?php echo $data->catatan ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 140px;">Status Pembayaran : </td>
                    <td>
                        <?php echo form_dropdown('status_pembayaran', $status_pembayaran, $data->status_pembayaran, 'id="status_pembayaran" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $id_asesi;
?>
var nama_asesi = '<?php echo $nama_asesi?>';
var id_asesi = '<?php echo $data->id_asesi?>';
console.log(id_asesi);
if(id_asesi != '0'){
    $("#id_asesi").combogrid('setValue',id_asesi);
    $("#id_asesi").combogrid('setText',nama_asesi);
}

</script>