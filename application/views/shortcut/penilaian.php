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
                    <td style="width: 150px;">Recomendation Date: </td>
                    <td>
                        <input id="rekomendasi_date" name="rekomendasi_date" style="width: 200px;" class="easyui-datebox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Penilaian Asesor : </td>
                    <td>
                        <?php echo form_dropdown('rekomendasi_asesor', $rekomendasi_asesor, $data->rekomendasi_asesor , 'id="rekomendasi_asesor" class="easyui-combobox"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Keterangan : </td>
                    <td>
                        <textarea name="rekomendasi_description" id="rekomendasi_description" rows="4" cols="40"><?=$data->rekomendasi_description?></textarea>
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
$("#rekomendasi_asesor").combobox({
        onChange: function(newVal, oldVal){
            if(newVal=='1'){
                $('#rekomendasi_description').val('Direkomendasikan kompeten untuk skema yang telah di uji. Tingkatkan dengan skema yang lebih tinggi!');
            }else if(newVal=='2'){
                $('#rekomendasi_description').val('Silahkan melakukan banding sesuai dengan rekomendasi perbaikan dari asesor. Atau melaksanakan asesmen lanjutan!');
            }else{
                $('#rekomendasi_description').val('');
            }
        }
})
</script>