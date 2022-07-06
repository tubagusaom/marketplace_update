<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                
                <tr>
                    <td style="width: 100px;">Nama Asesi: </td>
                    <td>
                        <input id="nama_lengkap" name="nama_lengkap" style="width: 250px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Prodi : </td>
                    <td>
                        <input id="id_tuk" name="id_tuk" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
               
            </table>
        </form>
    </div>
</div>
<script>
var base_url = "<?php echo base_url() ?>";


<?php
 echo $prodi;
?>
</script>