<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
        
            <table class="table-data">
               <tr>
                    <td style="width: 140px;">Nama Jadwal : </td>
                    <td>
                        <input id="jadual" name="jadual" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Skema : </td>
                    <td>
                        <input id="id_skema" name="id_skema" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">TUK : </td>
                    <td>
                        <input id="id_tuk" name="id_tuk" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tanggal Mulai : </td>
                    <td>
                        <input id="tanggal" name="tanggal" style="width: 250px;" class="easyui-datebox" data-options="">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tanggal Akhir : </td>
                    <td>
                        <input id="tanggal_akhir" name="tanggal_akhir" style="width: 250px;" class="easyui-datebox" data-options="">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Kuota Peserta : </td>
                    <td>
                        <input id="kuota_peserta" name="kuota_peserta" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Persyaratan : </td>
                    <td>
                        <textarea rows="4" cols="40" name="persyaratan" id="persyaratan" ></textarea>
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
 echo $skema_grid;
 echo $tuk_grid;
//echo $perangkat_grid;
?>
</script>
