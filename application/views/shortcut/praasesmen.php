<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <table class="table-data">
                <tr>
                    <td style="width: 140px;">Nama Asesi Awal : </td>
                    <td>
                        <input id="id_asesi" name="id_asesi" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Nama Asesi Akhir : </td>
                    <td>
                        <input id="id_asesi2" name="id_asesi2" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                        <?php  $tanggal_bayar = date('d/m/Y', strtotime(date('Y-m-d'))); ?>
                        <input id="pra_asesmen_date" type="hidden" value="<?php echo $tanggal_bayar ?>">
                    </td>
                </tr>
               <tr>
                    <td style="width: 140px;">Tempat Uji Kompetensi : </td>
                    <td>
                        <input id="id_tuk" name="id_tuk" style="width: 250px;" class="easyui-textbox" data-options="required: true">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Pra Asesmen Date: </td>
                    <td>
                        <input id="pra_asesmen_date" name="pra_asesmen_date" style="width: 200px;" class="easyui-datebox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Hasil Rekomendasi Pra Asesmen : </td>
                    <td>
                        <?php echo form_dropdown('pra_asesmen', $pra_asesmen, '', 'id="pra_asesmen" onchange="rekomendasi(this)"'); ?>
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Perangkat yang digunakan(Tekan Ctrl untuk memilih lebih dari satu) : </td>
                    <td>
                      <select name="perangkat[]" multiple required> 
                            <?php 

                                foreach ($data_perangkat as $key => $value) {
                                echo '<option  value="'.$key.'">'.$value.'</option>';
                            } ?>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Pra Asesmen Description (Update sesuai dengan rekomendasi) : </td>
                    <td>
                        <textarea rows="4" cols="40" name="pra_asesmen_description" id="pra_asesmen_description" ></textarea>
                    </td>
                </tr>
               
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $id_asesi;
echo $id_asesi2;
echo $id_tuk;


?>
function rekomendasi(sel){
       if(sel.value == '1'){
            $('#pra_asesmen_description').val('Di rekomendasi menjadi peserta uji kompetensi');
       }else if(sel.value == '2'){
            $('#pra_asesmen_description').val('Lengkapi bukti-bukti pendukung sesuai dengan skema dan persyaratan.');
       }else{
            $('#pra_asesmen_description').val('');
       }
}
</script>