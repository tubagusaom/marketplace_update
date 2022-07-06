<link rel="stylesheet" href="<?=base_url().'assets/css/dropzone.css'?>" />
<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <input type="hidden" value="<?=$data->is_perpanjangan; ?>" id="is_perpanjangan" name="is_perpanjangan">
        <div id="tips">
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Bukti pendukung dan Hasil Pra Asesmen</a></li>
                </ol>
            </div>
<style>
#ul_bukti{
    margin-left:-10px;
}
</style>

            <table border="1" id="table_bukti_pendukung">
            <thead>
                <tr><th data-options="field:'code',width:300">Nama Dokumen</th>
                <th data-options="field:'code2',width:400">Nama File</th>
                <th data-options="field:'code3'width:200">Validitas</th></tr>
            </thead>
            <tbody>

                 <?php
                 $jumlah_dokumen = 0;
                 $jumlah_array = 0;
                 $validitas_dokumen = unserialize($data->validitas_dokumen);
                 foreach ($files_asesi as $key => $value) {
 //foreach ($files_asesi as $key => $value) {
//foreach ($pendukung as $dt) {
                            $extFile = explode(".", @$value->nama_file);
                            $jmlArr = count($extFile) - 1;
                            switch ($extFile[$jmlArr]) {
                                case "ppt":
                                    $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . limit_string($value->nama_file,10) . "</a>";
                                    break;
                                case "pptx":
                                    $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . limit_string($value->nama_file,10) . "</a>";
                                    break;
                                case "doc":
                                    $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . limit_string($value->nama_file,10) . "</a>";
                                    break;
                                case "docx":
                                    $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . limit_string($value->nama_file,10) . "</a>";
                                    break;
                                case "xls":
                                    $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . limit_string($value->nama_file,10) . "</a>";
                                    break;
                                case "xlsx":
                                    $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . limit_string($value->nama_file,10) . "</a>";
                                    break;
                                default:
                                    $linkFile = "<a href='javascript:void(0);' onclick='buka(\"" . @$value->nama_file . "\");'>" . limit_string($value->nama_file,10) . "</a>";
                                    break;
                            }


                ?>
                 <tr>
                    <td><?= strtoupper($value->nama_dokumen) ?></td>
                    <td><?=$linkFile?></td>
                    <td style="text-align: center;">
                        <input class="checkbox_validitas" type="checkbox" name="validitas_dokumen[<?=$key?>]" value="1" <?=isset($validitas_dokumen[$key]) && $validitas_dokumen[$key]=='1' ? 'checked' : '' ?> />
                    </td>
                </tr>

                <?php
                    $jd = is_array($validitas_dokumen);
                    $ja = count($validitas_dokumen[$key]);

                    $jumlah_dokumen +=$jd;
                    $jumlah_array   +=$ja;
                ?>

                <?php }; ?>


                </tbody>
            </table>
            <table style="margin-top: 15px;">

              <tr>
                  <td style="width: 150px;">Jenis Asesmen</td>
                  <td style="width: 1%;">:</td>
                  <td>
                    Sertifikasi
                    <input id="tujuan_asesmen" name="tujuan_asesmen" type="hidden" value="<?php echo $data->tujuan_asesmen ?>">
                  </td>
              </tr>
              <tr>
                  <td style="width: 150px;">Jadwal Asesmen</td>
                  <td style="width: 1%;">:</td>
                  <td>
                    <?php echo $jadwal->jadual ?>
                    <input id="jadwal_id" name="jadwal_id" type="hidden" value="<?php echo $data->jadwal_id ?>">
                  </td>
              </tr>
              <tr>
                    <td style="width: 150px;">Tanggal Pra Asesmen </td>
                    <td style="width: 1%;">:</td>
                    <td><?php
                            if($data->pra_asesmen_date == ""){
                                $tanggal_pra_asesmen = date('d/m/Y', strtotime(date('Y-m-d')));
                            }else{
                                $tanggal_pra_asesmen = date('d/m/Y', strtotime($data->pra_asesmen_date));
                            }
                            //var_dump($data->pra_asesmen_date);
                        ?>
                        <input id="pra_asesmen_date" name="pra_asesmen_date" style="width: 200px;" class="easyui-datebox" value="<?php echo $tanggal_pra_asesmen ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Perangkat Asesmen</td>
                    <td style="width: 1%;">:</td>
                    <td>
                    <?php
                    // foreach ($perangkat_ygdipakai as $key => $value) {
                    //     if (in_array($key, $perangkat_ygdipakai)) {
                    //             //if ($perangkat_asesmen[$key] == $key) {
                    //         $selected = 'checked';
                    //     }else{
                    //         $selected = '';
                    //     }
                    //     echo '<input name="perangkat[]" type="checkbox" '.$selected.'  value="1" />'.$value->perangkat_detail.'<br/>';
                    // }
                    ?>


                    <?php
                      $perangkat_dipakai = unserialize($data->perangkat);
                      foreach ($perangkat_ygdipakai as $key => $value) {
                    ?>

                      <input class="checkbox_validitas" type="checkbox" name="perangkat[<?=$key?>]" value="1" <?=isset($perangkat_dipakai[$key]) && $perangkat_dipakai[$key]=='1' ? 'checked' : '' ?> /> <?=$value->perangkat_detail?><br>

                    <?php } ?>

                    </td>

                </tr>
                </table>
            <div id="tips">
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Biodata Peserta / APL 01</a></li>
                </ol>
            </div>
            <table class="table-data">
                <tr>
                    <td style="width: 150px;">No Identitas: </td>
                    <td style="width: 50%">

                    <input type="hidden" id="u_date_create" name="u_date_create" value="<?php echo $data->u_date_create ?>">
                    <input type="hidden" id="id_users" name="id_users" value="<?php echo $data->id_users ?>">
                    <input type="hidden" id="id_tuk" name="id_tuk" value="<?php echo $data->id_tuk ?>">
                    <input type="hidden" id="skema_sertifikasi" name="skema_sertifikasi" value="<?php echo $data->skema_sertifikasi ?>">
                    <input type="hidden" id="pra_asesmen_checked" name="pra_asesmen_checked" value="<?php echo $data->pra_asesmen_checked ?>"><b><?php echo $data->no_identitas ?></b>
                        <input type="hidden" id="no_identitas" name="no_identitas" style="width: 200px;"  value="<?php echo $data->no_identitas ?>">
                    <input type="hidden" id="jadwal_id" name="jadwal_id" style="width: 200px;"  value="<?php echo $data->jadwal_id ?>">



                    </td>
                    <td rowspan="6">
                       <?php
                          if($foto->foto_profil == "" ||  empty($foto->foto_profil) || $foto->foto_profil == "0"){
                            echo "Belum upload foto";
                          }else{ ?>
                            <a href="<?= base_url() . 'repo/profil/' . $foto->foto_profil ?>" target="_blank">
                           
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                 <img height="170px" width="145px" src="<?= base_url() . 'repo/profil/' . $foto->foto_profil ?>" alt="Foto Asesi" />
                                </div>
                           
                            </a>
                            
                            <?php } ?>
                    
                    </td>
                </tr>
                <tr style="display: none;">
                    <td style="width: 150px;">No UJK: </td>
                    <td>
                        <input id="no_uji_kompetensi" name="no_uji_kompetensi" style="width: 200px;" class="easyui-textbox" value="<?php echo $data->no_uji_kompetensi ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Nama Lengkap: </td>
                    <td><b><?php echo $data->nama_lengkap ?></b>
                        <input id="nama_lengkap" name="nama_lengkap" style="width: 200px;" type="hidden" value="<?php echo $data->nama_lengkap ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Telpon : </td>
                    <td><b><?php echo $data->telp ?></b>
                        <input id="telp" name="telp" style="width: 200px;" type="hidden" value="<?php echo $data->telp ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Email: </td>
                    <td><b><?php echo $data->email ?></b>
                        <input id="skema" name="email" style="width: 200px;" type="hidden" value="<?php echo $data->email ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tempat Lahir: </td>
                    <td><b><?php echo $data->tempat_lahir ?></b>
                        <input id="tempat_lahir" name="tempat_lahir" style="width: 200px;" type="hidden" value="<?php echo $data->tempat_lahir ?>">
                    </td>
                </tr>
                 <tr style="display: none;">
                    <td style="width: 150px;">Tanggal Lahir: </td>
                    <td>
                        <input id="tgl_lahir" name="tgl_lahir" style="width: 200px;" class="easyui-datebox" value="<?php echo date('d/m/Y', strtotime($data->tgl_lahir)) ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Jenis Kelamin: </td>
                    <td> <b><?php echo $jenis_kelamin[$data->jenis_kelamin] ?></b>
                        <input id="jenis_kelamin" name="jenis_kelamin" type="hidden" value="<?php echo $data->jenis_kelamin ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Alamat: </td>
                    <td colspan="2"> <b><?php echo $data->alamat ?></b>
                        <input id="alamat" name="alamat" type="hidden" value="<?php echo $data->alamat ?>">

                    </td>

                </tr>


            </table>
            <div id="tips">
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Asesmen Mandiri / APL 02</a></li>
                </ol>
            </div>
            <style>
            #apl02 td,th{
                padding: 1mm;
            }
            </style>

            <?php
                if ($jumlah_array != 0 && $jumlah_array == $jumlah_dokumen) {
                    $display = "";
                }else{
                    $display = "none";
                }
            ?>

            <table id="apl02"  style="width:97.5%;font-size: 11px;border-collapse: collapse;display: <?php echo $display; ?>;" border="1">
            <thead>
                <tr><th data-options="field:'code'" style="width: 40%;">KUK(Kriteria Unjuk Kerja)</th>
                <th data-options="field:'code1'" style="width: 27%;">Jenis Bukti</th>
                <th style="width: 5%;text-align: center;">K</th>
                <th style="width: 5%;text-align: center;">BK</th>
                <!--
                <th style="width: 5%;text-align: center;" >V<br /><input type="checkbox" id="v_all" onclick="alertsv()" /></th>
                <th style="width: 5%;text-align: center;">A<br /><input type="checkbox" id="a_all" onclick="alertsa()" /></th>
                <th style="width: 5%;text-align: center;">T<br /><input type="checkbox" id="t_all" onclick="alertst()" /></th>
                <th style="width: 5%;text-align: center;">M<br /><input type="checkbox" id="m_all" onclick="alertsm()" /></th>
                -->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($detail_asesi as $value){
                    if($value['v'] == '1'){
                        $checkedv = 'checked';
                    }else{
                        $checkedv = '';
                    }
                    if($value['a'] == '1'){
                        $checkeda = 'checked';
                    }else{
                        $checkeda = '';
                    }
                    if($value['t'] == '1'){
                        $checkedt = 'checked';
                    }else{
                        $checkedt = '';
                    }
                    if($value['m'] == '1'){
                        $checkedm = 'checked';
                    }else{
                        $checkedm = '';
                    }
                    if($value['is_kompeten']=='k'){
                        echo '<tr><td>'.$value['elemen'].'</td><td style="padding-left:10px">'.$bukti_pendukung.'</td>
                        <td style="text-align: center;">K</td><td style="text-align: center;">-</td>
                        <!--
                        <td style="text-align: center;"><input type="checkbox" class="v_all" name="v['.$value['id'].']" '.$checkedv.' /></td>
                        <td style="text-align: center;"><input type="checkbox" class="a_all"  name="a['.$value['id'].']" '.$checkeda.'  /></td>
                        <td style="text-align: center;"><input type="checkbox" class="t_all"  name="t['.$value['id'].']" '.$checkedt.'  /></td>
                        <td style="text-align: center;"><input type="checkbox" class="m_all"  name="m['.$value['id'].']" '.$checkedm.'  /></td>
                        -->
                        </tr>';
                    }else{
                        echo '<tr><td>'.$value['elemen'].'</td><td>'.$bukti_pendukung.'</td><td style="text-align: center;">-</td><td style="text-align: center;">BK</td>
                        <td style="text-align: center;"><input type="checkbox" class="v_all" name="v['.$value['id'].']" '.$checkedv.' /></td>
                        <td style="text-align: center;"><input type="checkbox" class="a_all"  name="a['.$value['id'].']" '.$checkeda.'  /></td>
                        <td style="text-align: center;"><input type="checkbox" class="t_all"  name="t['.$value['id'].']" '.$checkedt.'  /></td>
                        <td style="text-align: center;"><input type="checkbox" class="m_all"  name="m['.$value['id'].']" '.$checkedm.'  /></td>
                        </tr>';
                    }

                }
                ?>
            </tbody>
            </table>

            <table style="display: <?php echo $display; ?>" id="rekomendasiapl02">
                <tr>
                    <td style="width: 150px;">Hasil Rekomendasi : </td>
                    <td>
                        <?php echo form_dropdown('pra_asesmen', $pra_asesmen, $data->pra_asesmen, 'id="pra_asesmen" onchange="rekomendasi(this)"'); ?>

                    </td>
                </tr>

                <tr>
                    <td style="width: 150px;">Catatan Asesmen: </td>
                    <td>
                        <textarea rows="4" cols="40" name="pra_asesmen_description" id="pra_asesmen_description" ><?php echo $data->pra_asesmen_description ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;"></td>
                    <td>
                        <input type="checkbox" name="kirim_notifikasi" value="1" /> Kirim Notifikasi

                    </td>
                </tr>

            </table>

          <?php //} ?>
          <!-- tubagus aom -->
        </form>

    </div>
</div>
<div id="vFile" >
    <input type="hidden">
</div>

<script type="text/javascript">
$(function(){

    $('.checkbox_validitas').click(function(){
        var isi_array = [];
        $('.checkbox_validitas').each(function(index) {
            var value= $(this).is(':checked');
            if(value==true){
                isi_array.push('Y');
            }else{
                isi_array.push('N');
            }

            //console.log(index);
            //var isi_array[index] = value;
            //console.log(isi_array);
            //alert(value);
        })
        if((jQuery.inArray('N', isi_array)) < 0){
            $('#rekomendasiapl02').show();
            $('#apl02').show();
            //alert('Y semua');
        }else{
            $('#rekomendasiapl02').hide();
            $('#apl02').hide();
        }
        //console.log(isi_array);
        //console.log(jQuery.inArray('N', isi_array));

    })
        //var value= $(this).is(':checked');
        //$(this).next().val(value);
        //var cek_validitas = $("input:checkbox[class='checkbox_validitas']").is(":checked");
        //console.log(cek_validitas);
        // var ckbox = $('#checkbox');
        // if ($('.checkbox_validitas input[type="checkbox"]').not(':checked').length == 0) {
        //     alert('ok');
        // }else{
        //     alert('false');
        // }
        //var nilai = $(this).val();
        //alert(value);
    //})
})
//$('#pra_asesmen_date').datebox('setValue', '6/1/2012');

var base_url = "<?php echo base_url() ?>";
var id_asesi = '<?php echo $data->id ?>';


$('#dd').dialog({
    title: 'Upload Revisi Bukti Pendukung',
    width: 500,
    height: 300,
    closed: true,
    cache: false,
    modal: true
});
function alertsv(){
    if($("#v_all").is(':checked')){
        $('.v_all').prop("checked", true);
    }else{
        $('.v_all').prop("checked", false);
    }
}
function alertsa(){
    if($("#a_all").is(':checked')){
        $('.a_all').prop("checked", true);
    }else{
        $('.a_all').prop("checked", false);
    }
}
function alertst(){
    if($("#t_all").is(':checked')){
        $('.t_all').prop("checked", true);
    }else{
        $('.t_all').prop("checked", false);
    }
}
function alertsm(){
    if($("#m_all").is(':checked')){
        $('.m_all').prop("checked", true);
    }else{
        $('.m_all').prop("checked", false);
    }
}
function sendsms_pra_asesmen(){
        var base_url = "<?php echo base_url() ?>";
        var id_users = $('#id_users').val();
        var e = document.getElementById("pra_asesmen");
        var strUser = e.options[e.selectedIndex].value;
        //var rekomendasi = $('#pra_asesmen').val();
        alert(strUser);return false;
        var pra_asesmen_description = $('#pra_asesmen_description').val();
        $.messager.progress();
        var dt = {id_users:id_users,rekomendasi:rekomendasi,pra_asesmen_description:pra_asesmen_description};
        $.ajax({
            type:"POST",
            url:base_url+"pra_asesmen/sms",
            data:dt,
            success:function(result){
                $.messager.progress('close');
            }
         })
}
function rekomendasi(sel){
       if(sel.value == '1'){
            $('#pra_asesmen_description').val('Lanjut ke Proses Asesmen!');
       }else if(sel.value == '2'){
            $('#pra_asesmen_description').val('Tidak Lanjut ke Proses Asesmen!');
       }else{
            $('#pra_asesmen_description').val('');
       }
}
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
        $('#vFile').dialog('refresh', base_url + 'asesi/show_file?nmfile=' + data);
        //return false;
    }
</script>
