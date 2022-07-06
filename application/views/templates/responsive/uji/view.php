<form action="<?= base_url() . 'uji/proses' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped" id="frmUji">

    <div class="col-md-8 col-xs-12">

        <div class="col-md-6 col-xs-12" style="vertical-align:bottom;font-size: 12pt;padding: 6px;font-weight: bold;">Unit Kompetensi : Membuat Syllabus</div>
        <div class="clearfix" style="clear:both;"></div>

        <div class="container content"> 
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval='false'> 
                <!-- Wrapper for slides --> 
                <div class="carousel-inner"> 
                    <?php
                    $no = 0;
                    $nomor = 0;
                    foreach ($pertanyaan as $tanya) {
                        $nomor++;
                        ?>
                        <div class="item <?= $aktif = $no == 0 ? 'active' : ''; ?> "> 
                            <div class="row"> 
                                <div class="col-xs-12">
                                    <div class="col-md-7 col-xs-12" id="tagPertanyaan">
                                        <div class="form-group pertanyaan_<?= $no; ?>">
                                            <?php if (!empty($tanya->img)) { ?>
                                                <img src="<?= $tanya->img; ?>" class="img-responsive" width="50%" />
                                            <?php } ?>
                                            <label class="control-label"><?= $nomor . ". "; ?> <?= $tanya->pertanyaan; ?></label>

                                            <input type="hidden" name="idsoal[]" id="idsoal" value="<?= $tanya->id; ?>" />
                                            <div class="radio">
                                                <label><input type="radio" name="opsi_<?= $no; ?>" class="opsi_<?= $no; ?>" value="<?= $tanya->opsi_a; ?>" onclick="inputJawab(<?= $no; ?>);">A. <?= $tanya->opsi_a; ?></label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opsi_<?= $no; ?>" class="opsi_<?= $no; ?>" value="<?= $tanya->opsi_b; ?>" onclick="inputJawab(<?= $no; ?>);">B. <?= $tanya->opsi_b; ?></label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opsi_<?= $no; ?>" class="opsi_<?= $no; ?>" value="<?= $tanya->opsi_c; ?>" onclick="inputJawab(<?= $no; ?>);">C. <?= $tanya->opsi_c; ?></label>
                                            </div> 
                                            <div class="radio">
                                                <label><input type="radio" name="opsi_<?= $no; ?>" class="opsi_<?= $no; ?>" value="<?= $tanya->opsi_d; ?>" onclick="inputJawab(<?= $no; ?>);">D. <?= $tanya->opsi_d; ?></label>
                                            </div> 

                                            <a class="btn btn-sm btn-warning" data-target="#carousel-example-generic" data-slide-to="<?= $no - 1; ?>">Kembali</a> 
                                            <a class="btn btn-sm btn-info" data-target="#carousel-example-generic" data-slide-to="<?= $no + 1; ?>">Selanjutnya</a> 
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
    <div class="col-md-4 col-xs-12">
        <h2>SISA WAKTU</h2>
        <span style="font-size:14pt;color: red;" class="timerDown"></span>
        <div class="clearfix"></div>

        <h2>NAVIGASI</h2>
        <div class="col-md-12 col-xs-12" id="btn_navigasi">
            <?php
            $countPertanyaan = count($pertanyaan);
            $no = 0;
            for ($i = 0; $i < $countPertanyaan; $i++) {
                $no++;
                ?>
                <a class="btn btn-danger btn-sm" id="btnNav_<?= $i; ?>" data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>"><?= $no; ?></a>
                <?php
            }
            ?>
        </div>
        <div class="clearfix" style="clear:both;margin-bottom: 20px;"></div>

        <div class="col-md-12 col-xs-12">
            Pastikan semua pertanyaan telah dijawab
        </div>
        <div class="clearfix" style="clear:both;margin-bottom: 20px;"></div>

        <button id="btnKirim" class="btn btn-primary btn-lg">Kirim Semua Jawaban</button>
    </div>

</form>


<script type="text/javascript">

//    function saveData(no) {
//        var idpertanyaan = ".pertanyaan_" + no;
//        var idsoal = $(idpertanyaan + " #idsoal").val();
//        var jawaban = $(idpertanyaan + " .opsi_" + no + ":checked").val();
//        alert(idsoal + " & " + jawaban);
//    }



    var timer2 = "60:00";
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
            $("#btnKirim").hide();
        }
    }, 1000);

    $("#frmUji").submit(function () {
        $("#btnKirim").hide();
        var data_uji = $(this).serializeArray();
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: data_uji,
            dataType: 'json',
            success: function (hsl) {
                if (hsl.msgType == true) {
                    alert(hsl.msgValue);
                } else {
                    alert(hsl.msgValue);
                }
            }
        })
        return false;
    });

    function inputJawab(no) {
        $("#btn_navigasi #btnNav_" + no).removeClass('btn-danger');
        $("#btn_navigasi #btnNav_" + no).addClass('btn-info');
        return false;
    }


</script>