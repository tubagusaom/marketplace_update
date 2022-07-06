<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 140px;">Nama Asesi Awal : </td>
                    <td>
                        <input id="id_asesi" name="id_asesi" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Nama Asesi Akhir : </td>
                    <td>
                        <input id="id_asesi2" name="id_asesi2" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                        <?php  $tanggal_bayar = date('d/m/Y', strtotime(date('Y-m-d'))); ?>
                        <input id="pra_asesmen_date" type="hidden" value="<?php echo $tanggal_bayar ?>">
                    </td>
                </tr>
               <tr>
                    <td style="width: 140px;">Tempat Uji Kompetensi : </td>
                    <td>
                        <input id="id_tuk" name="id_tuk" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Pra Asesmen Checked: </td>
                    <td>
                        <input id="pra_asesmen_checked" name="pra_asesmen_checked" style="width: 200px;"  >
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $id_asesi;
echo $id_asesi2;
echo $id_tuk;
echo $pra_asesmen_grid;

?>
</script>