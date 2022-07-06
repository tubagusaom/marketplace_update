<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Pekerjaan : </td>
                    <td>
                        <input id="pekerjaan" name="pekerjaan" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->pekerjaan ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Perusahaan : </td>
                    <td>
                        <input id="perusahaan" name="perusahaan" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->perusahaan ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Fungsi Kerja : </td>
                    <td>
                        <input id="fungsi_kerja" name="fungsi_kerja" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->fungsi_kerja ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Industri : </td>
                    <td>
                        <input id="industri" name="industri" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->industri ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Gaji : </td>
                    <td>
                        <input id="gaji" name="gaji" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->gaji ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Tanggal : </td>
                    <td>
                        <input id="date" name="date" style="width: 250px;" class="easyui-datebox" data-options="required: true" value="<?php echo date('d/m/Y', strtotime($data->date)) ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Link : </td>
                    <td>
                        <input id="link" name="link" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->link ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>