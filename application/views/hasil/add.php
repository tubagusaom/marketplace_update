<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
         <form id="myform" enctype="multipart/form-data" action="<?php echo base_url() ?>soal/upload">
             <table class="table-data">
                
                <tr>
                    <td style="width: 140px;">Nama Perangkat Detail: </td>
                    <td>
                        <input data-options="required: true" id="id_perangkat_detail" name="id_perangkat_detail" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Unit Kompetensi: </td>
                    <td>
                        <input data-options="required: true" id="id_unit_kompetensi" name="id_unit_kompetensi" >
                    </td>
                </tr>
               
                <tr>
                    <td style="width: 140px;">Jenis Soal : </td>
                    <td>
                        <?php echo form_dropdown('jenis_soal', $jenis_soal, '', 'id="jenis_soal" class="easyui-combobox" style="width:250px;"  data-options="required: true"'); ?>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 100px;">Pertanyaan : </td>
                    <td>
                        <input id="pertanyaan" name="pertanyaan" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>

                <tr>
                    <td style="width: 100px;">Opsi Jawaban A : </td>
                    <td>
                        <input id="jawaban_a" name="jawaban_a" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Opsi Jawaban B : </td>
                    <td>
                        <input id="jawaban_b" name="jawaban_b" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Opsi Jawaban C : </td>
                    <td>
                        <input id="jawaban_c" name="jawaban_c" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Opsi Jawaban D : </td>
                    <td>
                        <input id="jawaban_d" name="jawaban_d" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Opsi Jawaban E : </td>
                    <td>
                        <input id="jawaban_e" name="jawaban_e" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>

                <tr>
                    <td style="width: 100px;">Jawaban Benar : </td>
                    <td>
                        <input id="jawaban_benar" name="jawaban_benar" style="width: 250px;" class="easyui-textbox" >
                    </td>
                </tr>
               
                <tr>
                    <td style="width: 100px;">Urutan : </td>
                    <td>
                        <input id="urutan" name="urutan" style="width: 250px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td style="width: 80px;text-align: right; margin-left: 0;">Browse : </td>
                    <td>
                        <input id="fileToUpload" class="easyui-filebox" name="fileToUpload" style="width: 250px;" data-options="buttonText: 'Pilih File'">
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