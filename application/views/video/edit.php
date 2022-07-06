<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 100px;">Nama File : </td>
                    <td>
                        <input id="nama_video" name="nama_video" style="width: 250px;" class="easyui-textbox" data-options="required: true" value="<?php echo $data->nama_video ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Keterangan : </td>
                    <td>
                        <input id="link_video" name="link_video" style="width: 250px;" class="easyui-textbox" value="<?php echo $data->link_video ?>" >
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
