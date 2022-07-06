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
            <input type="hidden" name="nama_lengkap" value="<?php echo $data->nama_lengkap ?>" />
            
                
                <tr>
                    <td style="width: 150px;">No Blanko / No Seri: </td>
                    <td>
                        <input  id="no_seri" name="no_seri" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_seri ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tanggal Pengiriman: </td>
                    <td>
                        <input  id="tgl_pengiriman" name="tgl_pengiriman" style="width: 200px;" class="easyui-datebox" value="<?php echo date('d/m/Y', strtotime($data->tgl_pengiriman)) ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Kurir: </td>
                    <td><input  id="via_pengiriman" name="via_pengiriman" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->via_pengiriman ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tertuju: </td>
                    <td>
                        <input  id="tertuju" name="tertuju" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->tertuju ?>">
                    </td>
                </tr>
                
                <tr>
                    <td style="width: 150px;">Tanggal Merima: </td>
                    <td>
                        <input  id="tgl_menerima" name="tgl_menerima" style="width: 200px;" class="easyui-datebox" value="<?php echo date('d/m/Y', strtotime($data->tgl_menerima)) ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Nama Penerima: </td>
                    <td><input  id="nama_penerima" name="nama_penerima" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->nama_penerima ?>">
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
