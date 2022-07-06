

<form id="frmUji" action="<?= base_url() . 'perangkat_asesmen/save' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
<input type="hidden" name="id_asesor" value="<?=$data_asesi->id_asesor?>">
<input type="hidden" name="id_skema" value="<?=$data_asesi->skema_sertifikasi?>">
<input type="hidden" name="id_asesi" value="<?=$data_asesi->id?>">
<input type="hidden" name="id_perangkat_detail" value="<?=$detail_perangkat[0]->id_perangkat_detail?>">
<div class="col-md-12 col-xs-12 table-tb-soal" style="border: 1px solid #ccc;border-radius: 25px;background-color: #f5fca9;position: right;">
    <h2>SISA WAKTU : <b style="color: red; font-weight:600" class="timerDown"></b></h2>
    <div class="clearfix"></div>

    <h2>NAVIGASI</h2>
    <div class="col-md-12 col-xs-12" id="btn_navigasi">
        <?php
        $countPertanyaan = count($detail_perangkat);
        $no = 0;
        for ($i = 0; $i < $countPertanyaan; $i++) {
            $no++;
            ?>
            <a style="width: 35px;height: 35px;margin-bottom: 5px;" class="btn btn-danger btn-sm" id="btnNav_<?= $i; ?>" data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>"><?= $no; ?></a>
            <?php
        }
        ?>
    </div>
    <div class="clearfix" style="clear:both;margin-bottom: 20px;"></div>

    <div class="col-md-12 col-xs-12">
        Pastikan semua pertanyaan telah dijawab.<br/>
        <span class="span-tb">
            Tombol akan hilang setelah waktu habis dan ditekan (klik). Jawaban akan disimpan secara otomatis apabila waktu telah habis.
        </span>
    </div>
    <div class="clearfix" style="clear:both;margin-bottom: 20px;"></div>
    <button type="button" class="btn btn-primary btn-lg btn-tb" data-toggle="modal" data-target="#exampleModal">
      Kirim Semua Jawaban
    </button>
    <!-- <input type="submit" id="btnKirim" value="Kirim Semua Jawaban" class="btn btn-primary btn-lg btn-tb"/> -->
    <div style="clear: both;margin-bottom: 20px;"></div>
</div>
<div class="col-md-12 col-xs-12" style="float: left;margin-bottom: 50px; padding:0px!important">

    <div class="content jumbotron">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval='false'>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
                $no = 0;
                $nomor = 0;
                foreach ($detail_perangkat as $key=>$tanya) {
                    $nomor++;
                    ?>
                    <div class="item <?= $aktif = $no == 0 ? 'active' : ''; ?> ">
                        <div class="row">
                            <div class="">

                                <div class="col-md-12 col-xs-12" id="tagPertanyaan">
                                    <div class="form-group pertanyaan_<?= $no; ?>">
                                    <label style="font-weight: bold;font-size: 10px;">Unit Kompetensi : <?= $tanya->unit_kompetensi; ?></label><br/>
                                        <label><?= $nomor . ". "; ?> <?= $tanya->pertanyaan; ?></label>
                                        <?php
                                        if($tanya->file_soal != ""){
                                            echo '<br/><img src="'.base_url().'assets/files/soal/'.$tanya->file_soal.'"';
                                        }

                                        ?>

                                        <input type="hidden" name="idsoal[]" id="idsoal" value="<?= $tanya->id; ?>" />
                                        <?php
                                            if($tanya->jenis_soal == '1'){
                                        ?>
                                        <div class="radio">
                                            <label><input type="radio" name="opsi[<?=$key?>]" class="opsi[]" value="A" onclick="inputJawab(<?= $no; ?>);"><b>A.</b> <?= $tanya->jawaban_a; ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="opsi[<?=$key?>]" class="opsi[]" value="B" onclick="inputJawab(<?= $no; ?>);"><b>B.</b> <?= $tanya->jawaban_b; ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="opsi[<?=$key?>]" class="opsi[]" value="C" onclick="inputJawab(<?= $no; ?>);"><b>C.</b> <?= $tanya->jawaban_c; ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="opsi[<?=$key?>]" class="opsi[]" value="D" onclick="inputJawab(<?= $no; ?>);"><b>D.</b> <?= $tanya->jawaban_d; ?></label>
                                        </div>
                                        <?php
                                        //var_dump($tanya->jawaban_e);
                                        if($tanya->jawaban_e != "" && $tanya->jawaban_e !="0"){
                                        ?>
                                            <div class="radio">
                                            <label><input type="radio" name="opsi[<?=$key?>]" class="opsi[]" value="E" onclick="inputJawab(<?= $no; ?>);"><b>E.</b> <?= $tanya->jawaban_e; ?></label>
                                            </div>
                                        <?php }
                                        }else if($tanya->tipe_soal == '1'){
                                        ?>
                                          <div class="checkbox">
                                            <label><input type="checkbox" name="opsi[<?=$key?>][]" class="opsi[]" value="A" onclick="inputJawab(<?= $no; ?>);"><b>A.</b> <?= $tanya->jawaban_a; ?></label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="opsi[<?=$key?>][]" class="opsi[]" value="B" onclick="inputJawab(<?= $no; ?>);"><b>B.</b> <?= $tanya->jawaban_b; ?></label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="opsi[<?=$key?>][]" class="opsi[]" value="C" onclick="inputJawab(<?= $no; ?>);"><b>C.</b> <?= $tanya->jawaban_c; ?></label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="opsi[<?=$key?>][]" class="opsi[]" value="D" onclick="inputJawab(<?= $no; ?>);"><b>D.</b> <?= $tanya->jawaban_d; ?></label>
                                        </div>
                                        <?php
                                        if($tanya->jawaban_e != "" || $tanya->jawaban_e !="0"){ ?>
                                            <div class="checkbox">
                                            <label><input type="checkbox" name="opsi[<?=$key?>][]" class="opsi[]" value="E" onclick="inputJawab(<?= $no; ?>);"><b>E.</b> <?= $tanya->jawaban_e; ?></label>
                                        </div>
                                        <?php
                                        }
                                        }else if($tanya->tipe_soal == '3'){
                                        ?>
                                            <div class="radio">
                                            <label><input type="radio" name="opsi[<?=$key?>]" class="opsi[]" value="A" onclick="inputJawab(<?= $no; ?>);">Benar</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opsi[<?=$key?>]" class="opsi[]" value="B" onclick="inputJawab(<?= $no; ?>);">Salah</label>
                                            </div>
                                        <?php

                                        }else{ ?>
                                            <div class="inputbox">
                                            <label><input type="textbox" name="opsi[<?=$key?>] form-control" class="opsi[]"  onclick="inputJawab(<?= $no; ?>);"> </label>
                                        </div>
                                            <?php
                                        }
                                        ?>

                                        <hr class="my-4">

                                        <!-- <div class="col-md-12">
                                          <div class="col-md-6">

                                          </div>
                                        </div> -->
                                        <a style="margin-right:5px" class="btn btn-sm btn-warning btn-tb-kembali" data-target="#carousel-example-generic" data-slide-to="<?= $no - 1; ?>">Kembali</a>
                                        <a class="btn btn-sm btn-info btn-tb-selanjutnya" data-target="#carousel-example-generic" data-slide-to="<?= $no + 1; ?>">Selanjutnya</a>


                                        <!--                                                                <button type="button" name="btnpilih" id="btnpilih" class="btn btn-sm btn-primary" onclick="saveData(<?= $no; ?>);">Pilih Jawaban</button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    $no++;
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Semua Jawaban akan dikirm, apakah yakin ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <input type="submit" id="btnKirim" value="Kirim" class="btn btn-primary"/>
      </div>
    </div>
  </div>
</div>

</form>

<input type="hidden" id="dtTimer" value="<?= $data->waktu_pengerjaan ?>"/>

<script type="text/javascript">

//    function saveData(no) {
//        var idpertanyaan = ".pertanyaan_" + no;
//        var idsoal = $(idpertanyaan + " #idsoal").val();
//        var jawaban = $(idpertanyaan + " .opsi_" + no + ":checked").val();
//        alert(idsoal + " & " + jawaban);
//    }
var base_url = "<?= base_url(); ?>";

var dtTime = $("#dtTimer").val();
//alert(dtTime);
var timer2 =  dtTime + ":00";
var interval = setInterval(function () {
    var timer = timer2.split(':');
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);
    --seconds;
    minutes = (seconds < 0) ? --minutes : minutes;
    if (minutes < 0)
        clearInterval(interval);
    seconds = (seconds < 0) ? 59 : seconds;
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    //minutes = (minutes < 10) ?  minutes : minutes;
    $('.timerDown').html(minutes + ':' + seconds);
    timer2 = minutes + ':' + seconds;
    if (timer2 == "0:00") {
        $("#frmUji").submit();
        //$("#btnKirim").hide();
    }
}, 1000);

$("#frmUji").submit(function () {
    // $("#btnKirim").hide();

    var data_uji = $(this).serializeArray();
    $.ajax({
        type: 'post',
        url: $(this).attr('action'),
        data: data_uji,
        dataType: 'json',
        success: function (hsl) {
            //console.log(hsl);
            if (hsl.msgType == true) {
                alert(hsl.msgValue);
window.location= base_url ;
            } else {
                alert(hsl.msgValue);
                $("#btnKirim").show();
            }

        }
    });

    return false;
});

function inputJawab(no) {
    $("#btn_navigasi #btnNav_" + no).removeClass('btn-danger');
    $("#btn_navigasi #btnNav_" + no).addClass('btn-info');
    return false;
}


</script>
