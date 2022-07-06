<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
         <form id="myform" >
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
                        <div id="div_select_unit"></div>
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
                        <textarea rows="4" cols="40" name="pertanyaan" id="pertanyaan" ></textarea>
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
                        A <input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="A">
                        B <input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="B">
                        C <input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="C">
                        D <input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="D">
                        E <input id="jawaban_benar" name="jawaban_benar[]"  type="checkbox" value="E">
                    </td>
                </tr>
               
                <tr>
                    <td style="width: 100px;">Urutan : </td>
                    <td>
                        <input id="urutan" name="urutan" style="width: 250px;" class="easyui-textbox">
                    </td>
                </tr>
                <tr>
                    <td style="width: 80px;text-align: right; margin-left: 0;">Link Image / Video : </td>
                    <td>
                        <input id="file_soal" name="file_soal" style="width: 250px;" > <a style="color: red;font-weight: bold;" onclick="buka()" href="javascript:void(0)">...</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
<?php
echo $perangkat;
//echo $unit;
?>
$('#id_perangkat_detail').combogrid({

    onChange: function(newVal, oldVal){
                        
    $.ajax({
        url:'<?php echo base_url(); ?>soal/get_unit',
        method:'POST',
        data:{id:newVal},
        dataType:'JSON',
        success:function(data){
            var html = '<div id="select_unit"><select required class="form-control" name="id_unit_kompetensi" id="id_unit_kompetensi">';
            var i;
            for(i=0; i<data.length; i++){
                html += '<option value="'+data[i].id+'">'+data[i].unit_kompetensi+'</option>';
            }
            html += '</select></div>';

            $('#select_unit').remove();
            $('#div_select_unit').append(html);
        }
    }); 



    }
})
</script>
<script>
$("#pertanyaan").cleditor({
        width:550, height:230
    });
</script>
<div id="div_dd">
<div id="dd" >
    <h3>Upload File</h3>
    <form  id="form_upload">
        <input type="file" name="filename_soal">
        <input type="submit" name="Kirim">
    </form>
</div>
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
        //$('#dd').dialog('refresh', 'sertifikat/file');
    }
</script>
<script>
   //form Submit
   //$("#simpan_file").on()
   $("#form_upload").submit(function(evt){   
      evt.preventDefault();
      var formData = new FormData($(this)[0]);
   $.ajax({
       url: 'soal/upload',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
        //alert(response);
        $('#file_soal').val(response);
        $('#dd').dialog('close');
        $('#dd').remove();
        $('#div_dd').append('<div id="dd"><form  id="form_upload"><input type="file" name="filename_soal"><input type="submit" name="Kirim"></form></div>');
        $('#dd').dialog({
        title: 'Browse File',
        width: 600,
        height: 500,
        closed: true,
        cache: false,
        
        modal: true
    });
       }
   });
   return false;
 });
</script>
