<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                 <tr>
                    <td style="width: 150px;">Program Studi : </td>
                    <td>
                        <?php echo form_dropdown('id_prodi', $prodi,'', 'id="id_prodi" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Kode Prodi TUK : </td>
                    <td>
                        <input id="no_cab" name="no_cab" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Nama Prodi TUK : </td>
                    <td>
                        <input id="tuk" name="tuk" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Alamat : </td>
                    <td>
                        <textarea rows="3" cols="40" id="alamat" name="alamat"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">No Telepon : </td>
                    <td>
                        <input id="telp" name="telp" style="width: 250px;" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Email : </td>
                    <td>
                        <input id="email_tuk" name="email_tuk" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Provinsi : </td>
                    <td>
                        <input id="provinsi" name="provinsi" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Kabupaten / Kota: </td>
                    <td>
                        <input id="kabupaten" name="kabupaten" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>