<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform" class="form_elemen">
            <div id="tips">
    			<ol class="rounded-list">
    				<li><a href="javascript: void(0)">Data Elemen</a></li>
    			</ol>
    		</div>
            <table style="width: 87%;" border="1" width="89%" class="table-data">
                <tr>
                    <th style="width: 5%;"></th>
                    <th style="width: 20%;">Elemen Kompetensi</th>
                <th  style="width: 20%;">Bukti Tambahan</th>
                <th  style="width: 5%;">DPT/DPL</th>
                <th  style="width: 5%;">No KUK</th>
                <th  style="width: 10%;">Dimensi Kompetensi</th>
                <th  style="width: 20%;">Pertanyaan</th>
                <th  style="width: 20%;">Jawaban</th>
                
            </tr>
                <?php
                foreach($elemen as $value){
                    echo '<tr>
                        <td style="width: 10%;">
                    <input type="checkbox" value="'.$value['id'].'" name="ch_elemen" /></td>
                    <td style="width: 10%;">
                   
                    <textarea cols="30" rows="2" name="'.$value['id'].'">'.$value['elemen_kompetensi'].'</textarea></td>
                    <td style="width: 10%;">
                    <input value="'.$value['bukti_dpl'].'" name="txt_bukti_tambahan['.$value['id'].']" /></td>
                    <td style="width: 10%;"><input style="width:50px;" value="'.$value['perangkat_bukti_tambahan'].'" name="txt_perangkat_bukti_tambahan['.$value['id'].']" /></td>
                    <td style="width: 10%;"><input style="width:50px;" value="'.$value['no_kuk'].'" name="txt_no_kuk['.$value['id'].']" /></td>
                    <td style="width: 10%;"><input style="width:50px;" value="'.$value['dimensi_kompetensi'].'" name="txt_dimensi_kompetensi['.$value['id'].']" /></td>
                    <td style="width: 10%;"><input value="'.$value['pertanyaan'].'" name="txt_pertanyaan['.$value['id'].']" /></td>
                    <td style="width: 10%;"><textarea name="txt_jawaban['.$value['id'].']" cols="30" rows="2">'.$value['jawaban'].'</textarea></td>
                    </tr>';    
                }
                ?>   
            </table>
            <a id="btn" href="#" onclick="simpan_elemen()" class="easyui-linkbutton" data-options="iconCls:'icon-save'">Simpan Elemen</a>
            <a id="btn" href="#" onclick="hapus_elemen()" class="easyui-linkbutton" data-options="iconCls:'icon-remove'">Hapus Elemen</a>
            
        </form>
    </div>
</div>
<script type="text/javascript">
function simpan_elemen(){
    data_elemen = $('.form_elemen').serializeArray();
    console.log(data_elemen);
        //id = $('#id').val();
        //deskripsi = $('#deskripsi_permohonan').val();
        //catatan_usulan_permohonan = $('#catatan_usulan_permohonan').val();
        var base_url = "<?= base_url(); ?>";
        $.ajax({
            type: 'post',
            url: base_url + 'skema_unit/posting/',
            data: {data: data_elemen},
            cache: false,
            success: function (data) {
                $.messager.alert('Success', 'Data berhasil di update');
            }
        });
    }
    function hapus_elemen(){
    data_elemen = $('.form_elemen').serializeArray();
        var base_url = "<?= base_url(); ?>";
        $.ajax({
            type: 'post',
            url: base_url + 'skema_unit/remove/',
            data: {data: data_elemen},
            cache: false,
            success: function (data) {
                $.messager.alert('Success', 'Data berhasil di update');
            }
        });
    }
</script>