<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" >
            <table class="table-data">
               
                        <input type="hidden" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d');?>" style="width: 280px;"  > 
                        <input type="hidden" id="jenis" name="jenis" value="Debet" style="width: 280px;"  > 
                        <input type="hidden" id="tipe_jurnal" name="tipe_jurnal" value="JUM" style="width: 280px;"  > 
                
                <tr>
                    <td style="width: 150px;">Nomor Bukti : </td>
                    <td>
                        <input id="nobukti" name="nobukti" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Akun Debet </td>
                    <td>
                        <input id="kd" name="kd" style="width: 280px;"  >
                    </td>
                </tr>
                
                <tr>
                    <td style="width: 150px;">Akun Kredit: </td>
                    <td>
                        <input id="kk" name="kk" style="width: 280px;"  >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Keterangan : </td>
                    <td>
                        <input type="hidden" id="ket" name="ket" value="Jurnal Umum" style="width: 280px;"  > 
                        <input id="ket2" name="ket2" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Jumlah : </td>
                    <td>
                        <input id="jumlah" name="jumlah" style="width: 280px;" class="easyui-textbox" >
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
 <div id="dd" ></div>
<script>
    <?php
    echo $akun_grid;
    echo $akun_grid2;
    ?>
    $(function(){
  
    })


</script>