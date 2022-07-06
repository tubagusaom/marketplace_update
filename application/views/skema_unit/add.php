<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Skema : </td>
                    <td>
                        <?php echo form_dropdown('id_skema', $skema, '', 'id="id_skema" class="easyui-combobox" style="width:350px;"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 120px;">Unit Kompetensi : </td>
                    <td><input id="id_unit_kompetensi" name="id_unit_kompetensi" >
                    </td>
                </tr>
                 <tr>
                    <td style="width: 120px;">No Urut : </td>
                    <td>
                        <input id="no_urut" name="no_urut" style="width: 280px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $unit_kompetensi;
?>
</script>