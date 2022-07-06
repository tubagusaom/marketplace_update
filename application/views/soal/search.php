<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">No Identitas: </td>
                    <td>
                        <input id="no_identitas" name="no_identitas" style="width: 200px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">No UJK: </td>
                    <td>
                        <input id="no_uji_kompetensi" name="no_uji_kompetensi" style="width: 200px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Nama Lengkap: </td>
                    <td>
                        <input id="nama_lengkap" name="nama_lengkap" style="width: 200px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Email: </td>
                    <td>
                        <input id="email" name="email" style="width: 200px;" class="easyui-textbox">
                    </td>
                </tr>
               <tr>
                    <td>Dari Tanggal : </td>
                    <td>
                        <input id="from_time" name="from_time" style="width: 200px;" class="easyui-datebox" data-options="required: true" >
                    </td>
                </tr>
                <tr>
                    <td>Sampai Tanggal : </td>
                    <td>
                        <input id="to_time" name="to_time" style="width: 200px;" class="easyui-datebox" data-options="required: true" >
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a id="btn" href="#" onclick="cetak_pencarian_asesi()" class="easyui-linkbutton" data-options="iconCls:'icon-print'">Cetak Pencarian</a>
                    </td>
                </tr>
               
            </table>
        </form>
    </div>
</div>
<script>
var base_url = "<?php echo base_url() ?>";
function cetak_pencarian_asesi(){
    var nama_lengkap = $('#nama_lengkap').val();
    var from_time = $('#from_time').datebox('getValue');
    var to_time = $('#to_time').datebox('getValue');
    if(from_time == "" && to_time == "" && nama_lengkap != ""){
        window.open(base_url+'asesi/cetak_pencarian/'+nama_lengkap);    
    }else if(from_time != "" && to_time != "" && nama_lengkap == ""){
        var tanggal = from_time.toString();
        var tanggal = from_time.split('/');
        var tanggal = tanggal[2]+'-'+tanggal[1]+'-'+tanggal[0];
        
        var tanggal2 = to_time.toString();
        var tanggal2 = to_time.split('/');
        var tanggal2 = tanggal2[2]+'-'+tanggal2[1]+'-'+tanggal2[0]
   
        window.open(base_url+'asesi/cetak_pencarian/nama_lengkap/'+tanggal+'/'+tanggal2);    
    }else if(from_time != "" && to_time != "" && nama_lengkap != ""){
        var tanggal = from_time.toString();
        var tanggal = from_time.split('/');
        var tanggal = tanggal[2]+'-'+tanggal[1]+'-'+tanggal[0];
        
        var tanggal2 = to_time.toString();
        var tanggal2 = to_time.split('/');
        var tanggal2 = tanggal2[2]+'-'+tanggal2[1]+'-'+tanggal2[0]
   
        window.open(base_url+'asesi/cetak_pencarian/'+nama_lengkap+'/'+tanggal+'/'+tanggal2);    
    }else{
        window.open(base_url+'asesi/cetak_pencarian/');
    }
    
}
$(function(){
    
})
</script>