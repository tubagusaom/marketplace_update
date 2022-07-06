<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <div id="tips">
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Data Sertifikat</a></li>
                </ol>
            </div>
            <table class="table-data">
            <input type="hidden" name="skema_sertifikasi" value="<?php echo $data->skema_sertifikasi ?>" />
            <input type="hidden" name="id_asesor" value="<?php echo $data->id_asesor ?>" />
            <input type="hidden" name="is_posting" value="<?php echo $data->is_posting ?>" />
            <input type="hidden" name="nama_lengkap" value="<?php echo $data->nama_lengkap ?>" />
            
                 <tr>
                    <td style="width: 150px;">No Registrasi: </td>
                    <td><input  id="no_registrasi" name="no_registrasi" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_registrasi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">No Sertifikat: </td>
                    <td>
                        <input  id="no_sertifikat" name="no_sertifikat" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_sertifikat ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">No Blanko / No Seri: </td>
                    <td>
                        <input  id="no_seri" name="no_seri" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_seri ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tanggal Terbit: </td>
                    <td>
                        <input  id="tanggal_terbit" name="tanggal_terbit" style="width: 200px;" class="easyui-datebox" value="<?php echo date('d/m/Y', strtotime($data->tanggal_terbit)) ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tanggal Expired: </td>
                    <td>
                        <input  id="tanggal_rcc" name="tanggal_rcc" style="width: 200px;" class="easyui-datebox" value="<?php echo date('d/m/Y', strtotime($data->tanggal_rcc)) ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">File Sertifikat Bagian Depan: </td>
                    <td>
                        <input id="file_sertifikat" name="file_sertifikat" value="<?php echo $data->file_sertifikat ?>">
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">File Sertifikat Bagian Belakang: </td>
                    <td>
                        <input id="file_sertifikat_belakang" name="file_sertifikat_belakang" value="<?php echo $data->file_sertifikat_belakang ?>">
                        
                    </td>
                </tr>
                
            </table>
            
      </form>
    </div>
</div>
<div id="dd" >
    <h3>Browse File</h3>
    <input type="text">
</div>
<script type="text/javascript">
    $('#dd').dialog({
        title: 'Browse File',
        width: 600,
        height: 500,
        closed: true,
        cache: false,
        
        modal: true
    });
    function buka(){
        $('#dd').dialog('open');
        $('#dd').dialog('refresh', 'sertifikat/file');
    }
</script>
