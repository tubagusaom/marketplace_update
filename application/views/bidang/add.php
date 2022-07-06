<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 140px;">Nama Asesor : </td>
                    <td>
                        <input id="id_asesor" name="id_asesor" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Kode Skema : </td>
                    <td>
                        <input id="id_skema" name="id_skema[]" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Sertifikat Teknis : </td>
                    <td>
                        <input id="sertifikat_teknis" name="sertifikat_teknis" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="-">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php

echo $asesor_grid;
echo $skema_grid;
?>
$("#id_skema").combogrid({multiple: 'true',panelWidth:500});
</script>