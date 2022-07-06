<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
        <div id="tips">
                    <ol class="rounded-list">
                        <li><a href="javascript: void(0)">Penilaian Hasil Jawaban Asesmen</a></li>
                    </ol>
                </div>
            <input type="hidden" name="tanggal_posting" value="<?=$data->tanggal_posting?>">
            <input type="hidden" name="id_asesi" value="<?=$data->id_asesi?>">
            <input type="hidden" name="id_asesor" value="<?=$data->id_asesor?>">
            <input type="hidden" name="id_skema" value="<?=$data->id_skema?>">
            <input type="hidden" name="id_perangkat_detail" value="<?=$data->id_perangkat_detail?>">
            <input type="hidden" name="jawaban_asesi" value="<?=$data->jawaban_asesi?>">
            <input type="hidden" name="jawaban_benar" value="<?=$data->jawaban_benar?>">
            <input type="hidden" name="jawaban_salah" value="<?=$data->jawaban_salah?>">
            <input type="hidden" name="file_jawaban" value="<?=$data->file_jawaban?>">
            <table class="table-data">
                
                <tr>
                    <td style="width: 150px;">Summary Penilaian: </td>
                    <td>
                        <textarea rows="4" cols="40" name="penilaian_asesor" id="penilaian_asesor" ><?php echo $data->penilaian_asesor ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Status Hasil Jawaban</td>
                    <td>
                        <?php echo form_dropdown('koreksi_asesor', $koreksi_asesor, $data->koreksi_asesor, 'id="koreksi_asesor" class="easyui-combobox"  data-options="required: true"'); ?>
                        
                    </td>
                </tr>
                </table>
             <?php
		//var_dump($data->file_jawaban);
//var_dump($data->jawaban_benar );



             if($data->jawaban_benar > 0 || $data->jawaban_salah > 0){
            $jawaban_asesi =unserialize(str_replace('|', '"', $data->jawaban_asesi));
             
            //var_dump($jawaban_yang_benar);
            ?>
            <table border="1">
                <tr><th>No</th><th>Pertanyaan</th><th>Jawaban</th><th>Jawaban Peserta</th><th>B/S</th></tr>
                <?php foreach ($soal as $key => $value) {
                    if($value->tipe_soal =='0' || $value->tipe_soal =='3'){
                        $jawaban = $value->jawaban_benar;
                        $jawaban_peserta = $jawaban_asesi[$key];
                    }else if($value->tipe_soal =='1'){
                        $unserialize_jawaban = unserialize($value->jawaban_benar);
                        $jawaban = implode(',', $unserialize_jawaban);


                        $jawaban_peserta = implode(',', $jawaban_asesi[$key]);
                    }else{
                        $jawaban = "";
                        $jawaban_peserta = "";
                    }

                    $bs = $jawaban == $jawaban_peserta ? 'Benar' : 'Salah';
                    $bs_color = $jawaban == $jawaban_peserta ? '' : 'red';
                 ?>
                 <tr>
                 <td style="text-align: center;"><?=($key + 1)?></td>
                 
                 <td><?=$value->pertanyaan?></td>
                 <td style="text-align: center;"><?=$jawaban?></td>
                 <td style="text-align: center;"><?=$jawaban_peserta?></td>
                 <td style="text-align: center;background-color: <?=$bs_color?>"><?=$bs?></td>
                 
                 </tr>
                 <?php
                }
                ?>
               
            </table> 
            <?php }else{ 
                $file_jawaban_array =unserialize(str_replace('|', '"', $data->file_jawaban));
                //var_dump($file_jawaban_array);
                //$file_jawaban = unserialize($data->file_jawaban);
                if(count($file_jawaban_array) > 0){
                    echo'<div style="margin-left:170px;">';
                    $files = array_unique($file_jawaban_array);
                    foreach ($files as $key => $value) { ?>
                        <a href="javascript:void(0);" onclick="buka('<?= @$value; ?>');"><?= @$value; ?></a><br/>

                       
                
                    <?php 
                }
                     echo'</div>';
                }
                
                ?> 

             
            <?php } ?>
        </form>
    </div>
</div>
<div id="vFile" >
    <input type="hidden">
</div>
<script type="text/javascript">
    var base_url = "<?= base_url(); ?>";

    function buka(data) {
        $('#vFile').empty();
        $('#vFile').dialog({
            title: 'View File ' + data,
            width: 900,
            height: 500,
            closed: true,
            cache: false,
            modal: true
        });

        $('#vFile').dialog('open');
        $('#vFile').dialog('refresh', base_url + 'hasil/show_file?nmfile=' + data);
        //return false;
    }
</script>