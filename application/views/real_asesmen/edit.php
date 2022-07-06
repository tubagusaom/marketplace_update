<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
            <tr>
                    <td style="width: 150px;">Pra Asesmen Checked: </td>
                    <td>
                        <?php echo $checked.' ('.$kategori_checked.')' ?>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Nama Lengkap: </td>
                    <td>
                        <input id="nama_lengkap" name="nama_lengkap" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->nama_lengkap ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Tempat Uji Kompetensi: </td>
                    <td>
                        <input id="id_tuk" name="id_tuk" style="width: 200px;"  value="<?php echo $data->id_tuk ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Jadwal Asesmen: </td>
                    <td>
                    <input type="hidden" id="administrasi_ujk" name="administrasi_ujk" value="<?php echo $data->administrasi_ujk ?>">
                    <input type="hidden" id="skema_sertifikasi" name="skema_sertifikasi" value="<?php echo $data->skema_sertifikasi ?>">
                    <input type="hidden" id="pra_asesmen_checked" name="pra_asesmen_checked" value="<?php echo $data->pra_asesmen_checked ?>">
                    <input type="hidden" id="id_users" name="id_users" value="<?php echo $data->id_users ?>">
                    <input type="hidden" id="telp" name="telp" value="<?php echo $data->telp ?>">
                    
                        <input id="jadwal_id" name="jadwal_id"  value="<?php echo $data->jadwal_id ?>">
                        <br/>Default jadwal adalah jadwal yg terakhir kali di buat
                    </td>
                </tr>
               
                <tr>
                    <td style="width: 150px;">No Uji Kompetensi : </td>
                    <td>
                        <input id="no_uji_kompetensi" name="no_uji_kompetensi" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_uji_kompetensi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Nama Asesor: </td>
                    <td>
                        <input id="id_asesor" name="id_asesor" style="width: 200px;"  value="<?php echo $data->id_asesor ?>"><br/>
                        Default Asesor adalah asesor yg di tugaskan pra asesmen
                    </td>
                </tr>
               
                <tr>
                    <td style="width: 150px;"></td>
                    <td>
                        <input type="checkbox" name="notifikasi" value="1" /> Notifikasi Calon Peserta
                        
                    </td>
                </tr>
                
            </table>
      </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $jadwal_grid;
echo $asesor_grid;
echo $tuk_grid;
?>
//$("#pegawai_id").combogrid({panelWidth: 450,idField:'id',mode: 'remote'});
var no_uji = $('#no_uji_kompetensi').val();
if(no_uji == ""){
    $("#jadwal_id").combogrid({
        onChange: function(newVal, oldVal){
            var link_href = 'real_asesmen/generate_number';
            var link_url = "";
            if(link_href.charAt(link_href.length -1) == "/")
            {
                link_url = link_href;
            }
            else
            {
                link_url = link_href + '/';
            }
            $.ajax({
                type: 'post',
                url: link_url,
                data: {id:newVal},

                cache: false,
                success: function(data){
                    $('#no_uji_kompetensi').textbox('setValue',data);
                    //alert(data);
                }
            })
        }    
    });
}
var jadual = '<?php echo $jadual?>';
var id_jadual = '<?php echo $id_jadual?>';
var checked = '<?php echo $checked?>';
var id_checked = '<?php echo $id_checked?>';

console.log(jadual);
if(id_jadual != '0'){
    $("#jadwal_id").combogrid('setValue',{id:id_jadual,jadual:jadual});
}
if(id_checked != '0'){
    $("#id_asesor").combogrid('setValue',{id:id_checked,users:checked});
}
</script>
