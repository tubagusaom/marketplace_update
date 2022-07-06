<div class="form-panel" style="margin-left: -10px;margin-top: 30px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">Nama Siswa : </td>
                    <td>
                        <input id="siswa_id" name="siswa_id" style="width: 300px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td>Dari Tanggal : </td>
                    <td>
                        <input id="from_time" name="from_time" style="width: 200px;" class="easyui-datebox" data-options="required: true" >
                    </td>
                </tr>
                <tr>
                    <td>Sampai Tanggal : </td>
                    <td>
                        <input id="to_time" name="to_time" style="width: 200px;" class="easyui-datebox" data-options="required: true" >
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $siswa_grid;

?>
</script>