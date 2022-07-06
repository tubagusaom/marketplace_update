<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                
                <tr>
                    <td style="width: 150px;">Nama Lengkap: </td>
                    <td>
                        <input id="nama_lengkap" name="nama_lengkap" style="width: 200px;" class="easyui-textbox">
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