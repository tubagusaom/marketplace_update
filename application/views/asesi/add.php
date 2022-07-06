<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 140px;">Code Instruktur : </td>
                    <td>
                        <input id="instruktur_code" name="instruktur_code" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">NIK : </td>
                    <td>
                        <input id="nik" name="nik" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nama Instruktur : </td>
                    <td>
                        <input id="instruktur_name" name="instruktur_name" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Base Location : </td>
                    <td>
                        <?php echo form_dropdown('base', $base, '', 'id="base" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">No Lisence : </td>
                    <td>
                        <input id="no_lisensi" name="no_lisensi" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Flight Hours : </td>
                    <td>
                        <input id="jam_terbang" name="jam_terbang" style="width: 250px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">End of License : </td>
                    <td>
                        <input id="awal_kontrak" name="awal_kontrak" style="width: 250px;" class="easyui-datebox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">End of Contract : </td>
                    <td>
                        <input id="habis_kontrak" name="habis_kontrak" style="width: 250px;" class="easyui-datebox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Alamat : </td>
                    <td>
                        <textarea id="alamat" name="alamat" style="width: 250px;" class="easyui-textbox" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Telepon : </td>
                    <td>
                        <input id="telepon" name="telepon" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Email : </td>
                    <td>
                        <input id="email" name="email" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Status : </td>
                    <td>
                        <input id="status" name="status" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Description : </td>
                    <td>
                        <input id="description" name="description" style="width: 250px;" class="easyui-textbox">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $pra_asesmen_grid;

?>
</script>