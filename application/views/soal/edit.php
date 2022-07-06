<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
         <form id="myform">
             <table class="table-data">
                
                <tr>
                    <td style="width: 140px;">Nama Perangkat Detail: </td>
                    <td>
                        <input value="<?=$data->id_perangkat_detail?>" data-options="required: true" id="id_perangkat_detail" name="id_perangkat_detail" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Unit Kompetensi: </td>
                    <td>
                        <input value="<?=$data->id_unit_kompetensi?>" data-options="required: true" id="id_unit_kompetensi" name="id_unit_kompetensi" >
                    </td>
                </tr>
               
                <tr>
                    <td style="width: 140px;">Jenis Soal : </td>
                    <td>
                        <?php echo form_dropdown('jenis_soal', $jenis_soal, $data->jenis_soal, 'id="jenis_soal" class="easyui-combobox" style="width:250px;"  data-options="required: true"'); ?>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Pertanyaan : </td>
                    <td><textarea rows="4" cols="40" name="pertanyaan" id="pertanyaan" ><?=$data->pertanyaan?></textarea>
                    </td>
                </tr>

                <tr>
                    <td style="width: 100px;">Opsi Jawaban A : </td>
                    <td>
                        <input value="<?=$data->jawaban_a?>" id="jawaban_a" name="jawaban_a" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Opsi Jawaban B : </td>
                    <td>
                        <input value="<?=$data->jawaban_b?>" id="jawaban_b" name="jawaban_b" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Opsi Jawaban C : </td>
                    <td>
                        <input value="<?=$data->jawaban_c?>" id="jawaban_c" name="jawaban_c" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Opsi Jawaban D : </td>
                    <td>
                        <input value="<?=$data->jawaban_d?>" id="jawaban_d" name="jawaban_d" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Opsi Jawaban E : </td>
                    <td>
                        <input value="<?=$data->jawaban_e?>" id="jawaban_e" name="jawaban_e" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
<!--                 <tr>
                    <td style="width: 140px;">Tipe Soal : </td>
                    <td>
                        <?php //echo form_dropdown('tipe_soal', $tipe_soal, $data->tipe_soal, 'id="tipe_soal" class="easyui-combobox" style="width:250px;"  data-options="required: true"'); ?>
                    </td>
                </tr> -->
                <tr>
                    <td style="width: 100px;">Jawaban Benar : </td>
                    <td>
                        A<input  id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="A" <?=in_array('A', $jawaban_benar) ? 'checked':''?>>
                        B<input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="B" <?=in_array('B', $jawaban_benar) ? 'checked':''?>>
                        C<input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="C" <?=in_array('C', $jawaban_benar) ? 'checked':''?>>
                        D<input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="D" <?=in_array('D', $jawaban_benar) ? 'checked':''?>>
                        E<input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="E" <?=in_array('E', $jawaban_benar) ? 'checked':''?>>
                    </td>
                </tr>
               
                <tr>
                    <td style="width: 100px;">Urutan : </td>
                    <td>
                        <input value="<?=$data->urutan?>" id="urutan" name="urutan" style="width: 250px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td style="width: 80px;text-align: right; margin-left: 0;">Link Image / Video : </td>
                    <td>
                    <input type="hidden" value="<?=$data->file_soal?>" id="file_soal" name="file_soal" >

                        <input id="file_soal" value="<?=$data->file_soal?>"  name="file_soal" style="width: 250px;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $perangkat;
echo $unit;
?>
</script>
<script>
$("#pertanyaan").cleditor({
        width:550, height:230
    });
</script>