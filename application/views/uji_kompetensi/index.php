<link rel="stylesheet" href="<?= base_url() . 'assets/css/bootstraps2.css' ?>">

<style type="text/css">


    .stepwizard-step p {
        margin-top: 10px;
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;

    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .harus_diisi{
        color:red;
        font-weight:bold;
    }
    /***
    Bootstrap Line Tabs by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    ***/

    /* Tabs panel */
    .tabbable-panel {
        border:1px solid #eee;
        padding: 10px;
    }

    /* Default mode */
    .tabbable-line > .nav-tabs {
        border: none;
        margin: 0px;
    }
    .tabbable-line > .nav-tabs > li {
        margin-right: 2px;
    }
    .tabbable-line > .nav-tabs > li > a {
        border: 0;
        margin-right: 0;
        color: #737373;
    }
    .tabbable-line > .nav-tabs > li > a > i {
        color: #a6a6a6;
    }
    .tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
        border-bottom: 4px solid #fbcdcf;
    }
    .tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {
        border: 0;
        background: none !important;
        color: #333333;
    }
    .tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
        color: #a6a6a6;
    }
    .tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
        margin-top: 0px;
    }
    .tabbable-line > .nav-tabs > li.active {
        border-bottom: 4px solid #f3565d;
        position: relative;
    }
    .tabbable-line > .nav-tabs > li.active > a {
        border: 0;
        color: #333333;
    }
    .tabbable-line > .nav-tabs > li.active > a > i {
        color: #404040;
    }
    .tabbable-line > .tab-content {
        margin-top: -3px;
        background-color: #fff;
        border: 0;
        border-top: 1px solid #eee;
        padding: 15px 0;
    }
    .portlet .tabbable-line > .tab-content {
        padding-bottom: 0;
    }

    /* Below tabs mode */

    .tabbable-line.tabs-below > .nav-tabs > li {
        border-top: 4px solid transparent;
    }
    .tabbable-line.tabs-below > .nav-tabs > li > a {
        margin-top: 0;
    }
    .tabbable-line.tabs-below > .nav-tabs > li:hover {
        border-bottom: 0;
        border-top: 4px solid #fbcdcf;
    }
    .tabbable-line.tabs-below > .nav-tabs > li.active {
        margin-bottom: -2px;
        border-bottom: 0;
        border-top: 4px solid #f3565d;
    }
    .tabbable-line.tabs-below > .tab-content {
        margin-top: -10px;
        border-top: 0;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }
    input:focus{
        background-color:#7AFFCA !important;
    }
</style>
<script src="<?= base_url() . 'assets/js/dropzone.js' ?>"></script>
<link rel="stylesheet" href="<?= base_url() . 'assets/css/dropzone.css' ?>" />
</head>
<body>
    <div class="container" style="margin-bottom: 60px;" >
        <div class="col-md-12 col-sm-12" style="background-color: white; padding-top: 10px;">

            <div class="stepwizard" style="margin-bottom: 20px;">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Step 1</p>  
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Step 2</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>Step 3</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                        <p>Step 4</p>
                    </div>
                </div>
            </div>

            <form role="form" method="post" action="<?php echo base_url() . "welcome/uji_kompetensi_save"; ?>" id="form_submit" enctype="multipart/form-data">
                <input type="hidden" name="skema_yang_dipilih" id="skema_yang_dipilih" />
                <div class="row setup-content" id="step-1">

                    <div class="col-xs-12">
                        <fieldset><legend><h3> MEMILIH SKEMA SERTIFIKASI</h3>
                                <h5> Pada bagian ini,  pilihlah skema yang akan di ujikan. Pilih salah satu.</h5></legend></fieldset>

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?php
                            foreach ($data_skema as $key => $value) {
                                $id_heading = $key . "heading";
                                $id_collapse = $key . "collapse";
                                if ($key == 0) {
                                    $in = 'in';
                                } else {
                                    $in = '';
                                }
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="<?= $id_heading ?>">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $id_collapse ?>" aria-expanded="true" aria-controls="<?= $id_collapse ?>">
                                                <?= ($key + 1) . '. ' . strtoupper($value->skema) ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?= $id_collapse ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="<?= $id_heading ?>">
                                        <div class="panel-body" style="font-weight: normal;">
                                            <?= $value->description ?>

                                            <br />
                                            <a data-toggle="tooltip" data-placement="bottom" title="Serba-serbi mengenai skema <?php echo $value->skema; ?>" href='<?php echo $value->link_download; ?>' target="_blank" class="btn-sm btn-primary "  >DOWNLOAD SKEMA</a>
                                            <a data-toggle="tooltip" data-placement="right" title="Pilih skema ini dan ke tahapan selanjutnya" href='#' class="nextBtn btn-sm btn-success" onclick='pilih_skema(<?php echo $value->id; ?>)' >PILIH SKEMA <?= strtoupper($value->skema) ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-xs-12">
                        <div class="col-md-12" style="margin-bottom: 20px;">

                            <fieldset><legend><h3> FR-APL-01. FORMULIR PERMOHONAN SERTIFIKASI KOMPETENSI</h3>
                                    <h5>Pada bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini. Untuk bagian yang bertanda (*) wajib di isi.</h5></legend></fieldset>

                            <div class="col-md-3">
                                <label class="control-label">No.Identitas <b class="harus_diisi">*</b></label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">

                                    <input  maxlength="100" type="text" name="no_identitas" id="no_identitas" required class="form-control" placeholder="Masukkan Nomor Identitas (KTP)"  /> 
                                    <input type="hidden" id="step_langkah">      </div>
                            </div>
                            <div id="div_pilih">

                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Nama Lengkap <b class="harus_diisi">*</b> </label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="nama_lengkap" id="nama_lengkap" required class="form-control" placeholder="Masukkan Nama Lengkap"  />       </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Organisasi <b class="harus_diisi">*</b> </label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="organisasi" id="organisasi" required class="form-control" placeholder="Organisasi / Lembaga Pendidikan / Tempat Bekerja / Institusi terkait"  />       </div>
                            </div>
                            <div class="col-md-3">

                                <label class="control-label">Perpanjang ? </label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="checkbox" name="is_perpanjangan" id="is_perpanjangan" value="1"   /> Checklist jika merupakan perpanjangan sertifikat sebelumnya      </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Tempat - Tanggal Lahir</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir"  />      

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" id="tanggal_lahir" name="tanggal_lahir"  class="form-control" placeholder="Contoh 05/10/1985"  />        </div>
                            </div>        

                            <div class="col-md-3">
                                <label class="control-label">Jenis Kelamin </label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">

                                    <select class="form-control validate[required]" name="jenis_kelamin" id="jenis_kelamin" >
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </div>
                                <div id="div_bukti" style="display:none;"></div>

                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Kewarganegaraan  </label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control" name="kewarganegaraan" id="kewarganegaraan">
                                        <option value="">Pilih</option>
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>     </div>
                            </div>


                            <div class="col-md-3">
                                <label class="control-label">Alamat</label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap Domisili"> </textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">No.Telp  <b class="harus_diisi">*</b> </label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="no_telp" id="no_telp" required class="form-control" placeholder="Masukkan No Telp"  />   
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Email  <b class="harus_diisi">*</b> </label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="email" id="email" required class="form-control" placeholder="Masukkan Email"  />   
                                    <input type="hidden" id="validasi_email">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Pendidikan Terakhir</label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="pend_terakhir" id="pend_terakhir"  class="form-control" placeholder="Masukkan Pendidikan Terakhir (SMA SEDERAJAT/D1/D2/D3/S1/S2/S3)"  />   
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Nama Sekolah / Perguruan Tinggi </label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="perg_tinggi" id="perg_tinggi"  class="form-control" placeholder="Masukkan Nama Perguruan Tinggi"  />   
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label class="control-label">Jurusan</label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="jurusan" id="jurusan" class="form-control"  placeholder="Masukkan Jurusan"  />   
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label class="control-label">Nama dan Alamat Perusahaan</label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control"  placeholder="Alamat Lengkap Perusahaan"> </textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Jabatan</label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="jabatan" id="jabatan"  class="form-control"  placeholder="Masukkan Jabatan"  />    
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">No.Telp Perusahaan</label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" name="no_telp_company" id="no_telp_company"  class="form-control" placeholder="Masukkan No Telp Perusahaan"  />    
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Email Perusahaan</label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  maxlength="100" type="text" id="email_company" name="email_companny"  class="form-control" placeholder="Masukkan Email Perusahaan"  />   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label"> Tempat Uji Kompetensi</label>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="tempat_uji" id="tempat_uji" class="combobox form-control" required >
                                        <?php foreach ($data_tuk as $key => $value) {
                                            ?>
                                            <option value="<?= $value->tuk . '|' . $value->id ?>"><?= ($key + 1) . ". " . $value->tuk ?>(<?= $value->alamat ?>)</option>    
                                            <?php
                                        }
                                        ?>


                                    </select>  


                                    <div style="margin-top:20px; margin-bottom:20px;"> 
                                        <button id="selanjutnya-2" class="btn btn-success nextBtn btn-md pull-left" type="button" >Selanjutnya (Langkah 3)</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-md-12">
                        <fieldset><legend><h3> UPLOAD BUKTI PENDUKUNG</h3>
                                <h5> Cantumkan satu atau beberapa bukti pendukung (portofolio, sertifikat, ijazah dll) yang terkait dengan skema atau unit kompetensi yang telah diambil. Kemudian jika dimungkinkan scan dan upload dokumen tersebut kedalam sistem ini</h5></legend></fieldset>
                        <div class="col-md-12" id="div_unit_dipilih">
                            <div id="unit_dipilih"></div>
                        </div>

                        <div class="col-md-12" id="div_list_bukti_pendukung">
                            <div class="alert alert-info">
                                Pada bagian ini, anda diminta untuk memilih bukti-bukti pendukung yang anda anggap relevan terhadap setiap elemen/KUK unit kompetensi. Pilihan dapat lebih dari 1(Satu) bukti pendukung.
                                Tekan tombol <input type="button" class="btn btn-primary" style="margin-top: 5px;" value=" ADD MORE " />
                                untuk menambah kolom input untuk bukti pendukung. Bisa lebih dari satu <br/>
                                <ul>
                                    <li><b>IJAZAH PENDIDIKAN FORMAL/BIODATA PRIBADI</b> contohnya Ijazah SMA Sederajat, S1, S2, KTP, SIM, NPWP, Foto dll</li>
                                    <li><b>SERTIFIKAT KETERAMPILAN / PELATIHAN</b> adalah sertifikat yang berhubungan dengan Skema / Unit yang di ambil </li>
                                    <li><b>PORTOFOLIO / PENGALAMAN KERJA</b> contoh dari Portofolio antara lain Curiculum Vitae dan Hasil Perkerjaan yang pernah di buat</li>
                                </ul>
                            </div>   
                            <fieldset><legend>IJAZAH PENDIDIKAN FORMAL ATAU BIODATA PRIBADI</legend>
                                <input type="hidden"  name="wajib1" id="wajib1"  required>
                                <input type="hidden"  name="folder" id="folder" value="<?= $folder ?>"  required>
                                <input type="hidden"  name="drophidden" id="drophidden"  required>
                                <div class="col-md-12">
                                    <input type="button" id="bukti_pendukung_add" class="btn btn-primary" style="margin-top: 5px;" value=" ADD MORE ">
                                </div>
                                <div id="list_isi"></div>
                            </fieldset>
                            <br />

                            <fieldset><legend>SERTIFIKAT KETERAMPILAN / PELATIHAN</legend>
                                <div class="col-md-12">
                                    <input type="button" id="bukti_pendukung_add2" class="btn btn-primary" style="margin-top: 5px;" value=" ADD MORE ">
                                </div>
                                <div id="list_isi2"></div>

                            </fieldset><br />

                            <fieldset><legend>PORTOFOLIO / PENGALAMAN KERJA</legend>
                                <div class="col-md-12">
                                    </form>


                                    <input type="button" id="bukti_pendukung_add3" class="btn btn-primary" style="margin-top: 5px;" value=" ADD MORE ">
                                </div>
                                <div id="list_isi3"></div>
                            </fieldset>

                            <br />

                            <div class="alert alert-warning" style="margin-top: 10px;">
                                Note : Dapat lebih dari 1 bukti pendukung.
                            </div>

                            <fieldset><legend>UPLOAD BUKTI PENDUKUNG </legend>
                                <div class="col-md-12">

                                    <div id="upload_drop" class="dropzone"></div>
                                </div>


                            </fieldset>

                            <br />
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <button class="btn btn-success nextBtn btn-md pull-left" type="button" id="selanjutnya-3">Selanjutnya (Langkah 4)</button>
                            </div>   
                        </div>

                    </div>
                </div>

                <div class="row setup-content" id="step-4">
                    <div class="col-xs-12">

                        <div class="col-md-12">
                            <fieldset><legend><h3> FR-APL 02 ASESMEN MANDIRI</h3>
                                    <h5> Pastikan anda kompeten sesuai dengan elemen dan kuk yang ada pada setiap unit-unit kompetensi berikuti ini. Pasangkan elemen/kuk dengan bukti pendukung yang telah anda sebutkan sebelumnya.</h5></legend></fieldset>


                            <div class="table-responsive" id="div_skema_yang_dipilih">
                                <div id="div_inner"></div>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <button class="btn btn-success nextBtn btn-md pull-left" type="button" id="selanjutnya-4">Selesai dan Kirim</button>
                            </div>
                        </div>


                    </div>
                </div>
        </div>    
    </form>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.v2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/bootstraps/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() . "assets/js/datepicker.js"; ?>"></script>
<script src="<?php echo base_url() ?>dropzone.js"></script>
<script>
                                            var base_url = "<?php echo base_url() ?>";
                                            var folder = "<?php echo $folder ?>";
                                            Dropzone.autoDiscover = false;
                                            var myDropzone = new Dropzone("div#upload_drop", {
                                                url: base_url + "welcome/upload",
                                                paramName: 'file',
                                                maxFilesize: 50, // MB
                                                maxFiles: 10,
                                                dictDefaultMessage: 'Seret file bukti pendukung kesini, atau klik di area ini',

                                                init: function () {
                                                    this.on("uploadprogress", function (file, progress) {
                                                        //console.log("File progress", progress);
                                                    });
                                                    this.on("success", function (file, progress) {
                                                        $('#drophidden').val('1');
                                                    });
                                                },
                                                sending: function (file, xhr, formData) {
                                                    formData.append('folder', folder);
                                                }

                                            })
//var myDropzone = new Dropzone("div#okok", { url: "welcome/upload"});

</script>

<script>
    function create_combo() {
        var bukti_sertifikat = "";
        var bukti_s = "";
        $(".class_evidence").each(function () {
            //alert($(this).val());
            bukti_sertifikat = bukti_sertifikat + "<option value='" + $(this).val() + "'>" + $(this).val() + "</option>";
            bukti_s = bukti_s + "<option selected value='" + $(this).val() + "'>" + $(this).val() + "</option>";
            //var bukti_sertifikat = bukti_sertifikat+" "+opsi;
        });
        $(".class_evidence2").each(function () {
            //alert($(this).val());
            bukti_sertifikat = bukti_sertifikat + "<option value='" + $(this).val() + "'>" + $(this).val() + "</option>";
            bukti_s = bukti_s + "<option selected value='" + $(this).val() + "'>" + $(this).val() + "</option>";
            //var bukti_sertifikat = bukti_sertifikat+" "+opsi;
        });
        $(".class_evidence3").each(function () {
            //alert($(this).val());
            bukti_sertifikat = bukti_sertifikat + "<option value='" + $(this).val() + "'>" + $(this).val() + "</option>";
            bukti_s = bukti_s + "<option selected value='" + $(this).val() + "'>" + $(this).val() + "</option>";
            //var bukti_sertifikat = bukti_sertifikat+" "+opsi;
        });
        //alert(bukti_sertifikat);
        $(".select_bukti").text('');
        $(".select_bukti").append("<select name='pilih[]' required class='form-control drop-pilih'>" + bukti_sertifikat + "</select>");
        $("#div_bukti").append("<select multiple name='bukti_pendukung[]'>" + bukti_s + "</select>");
        //$("#div_bukti").show();

    }
    $('#all_k').on('click', function () {
        alert('ok');
    })
    $('#all_bk').on('click', function () {
        alert('ok');
    })
    $(document).ready(function () {
        $('#email').val();
        $('#validasi_email').val();
        $("#selanjutnya-4").click(function () {
            $('#step_langkah').val('5');
            var valuess = $("select[name^='pilih']").map(function (idx, ele) {
                $('#div_pilih').append('<input type="hidden" name="pilih_array[]" value="' + $(ele).val() + '" />');
                //console.log($(ele).val());
            }).get();
            //var pilihid = $('.drop-pilih').val();
            //console.log(pilihid);
            //return false;
            //preventDefault();
            var cek_radio = $("input:radio[class='value_bk']").is(":checked");
            if (cek_radio == true) {
                alert("Semua Elemen Kompetensi atau KUK harus Kompeten");
            } else {
                var tanya = confirm('Apakah Data yang anda isi sudah benar ?');
                if (tanya) {
                    $('#form_submit').submit();
                }

            }
            // 

        })
        $("#selanjutnya-3").on('click', function () {
            $('#step_langkah').val('4');
            var validasiwajib1 = $('#wajib1').val();
            var drophidden = $('#drophidden').val();
            var class_evidence_required = $('.class_evidence_required').val();

            //alert(drophidden);
            //console.log(validasiwajib1);

            if (class_evidence_required === 'undefined' || class_evidence_required == "") {
                alert('Masukkan Nama Bukti Pendukung. !');
                return false;
            }
            if (validasiwajib1 == '') {
                alert('Bukti Pendukung Kosong. Klik Add More!');
                preventDefault();
            } else if (drophidden == "") {
                alert('Upload Bukti Pendukung');
                preventDefault();
            } else {
                id = $('#skema_yang_dipilih').val();
                $.ajax({
                    type: 'post',
                    url: base_url + 'welcome/uji_kompetensi_skema',
                    data: {id: id},

                    cache: false,
                    success: function (data) {
                        $('#div_inner').remove();
                        $('#div_skema_yang_dipilih').append('<div id="div_inner"></div>');
                        $('#div_inner').append(data);
                        create_combo();
                        $('#all_bk').attr('checked', true);
                        $('.value_bk').attr('checked', true);
                        $('#all_k').change(function () {
                            $('#all_bk').attr('checked', false);
                            $('.value_k').prop('checked', $(this).prop("checked"));
                        })
                        $('#all_bk').click(function () {
                            $('#all_k').attr('checked', false);
                            $('.value_bk').prop('checked', $(this).prop("checked"));
                        })
                    }
                });
            }
        });
        $("#selanjutnya-2").click(function (e) {
            $('#step_langkah').val('3');
            $('#wajib1').val("");
            $('#drophidden').val("");
//validasi_email = $('#email').val();
//if(validasi_email != ""){

            id = $('#skema_yang_dipilih').val();
            $.ajax({
                type: 'post',
                url: base_url + 'welcome/detail',
                data: {id: id},

                cache: false,
                success: function (data) {
                    $('#unit_dipilih').remove();
                    $('#div_unit_dipilih').append('<div id="unit_dipilih"></div>');
                    $('#unit_dipilih').append(data);
                    create_combo();
                    $('#all_bk').attr('checked', true);
                    $('.value_bk').attr('checked', true);
                    $('#all_k').change(function () {
                        $('#all_bk').attr('checked', false);
                        $('.value_k').prop('checked', $(this).prop("checked"));
                    })
                    $('#all_bk').click(function () {
                        $('#all_k').attr('checked', false);
                        $('.value_bk').prop('checked', $(this).prop("checked"));
                    })
                    $('#file_bukti_pendukung').focus();
                }
            });



        });
    });
</script>

<script>
    $(function () {
        $("#from_date").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
        $("#to_date").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
    })
    $('[data-toggle="tooltip"]').tooltip()
</script>
<script type="text/javascript">
    function pilih_skema(id) {
        $('#skema_yang_dipilih').val(id);
        $('#step_langkah').val('2');
    }
    function hapus_evidence(id) {
        $(".evidence-" + id).remove();
        var isiwajib1 = parseInt($('#wajib1').val());
        $('#wajib1').val(isiwajib1 - 1);
    }
    function hapus_evidence2(id) {
        $(".evidence2-" + id).remove();
    }
    function hapus_evidence3(id) {
        $(".evidence3-" + id).remove();
    }
    $(document).ready(function () {
        $('#login-btn').hide();
        var i = 2;
        $("#bukti_pendukung_add").click(function () {
            var isiwajib1 = $('#wajib1').val();
            if (isiwajib1 == "") {
                isiwajib1 = 0;
            }
//var isiwajib1 = parseInt($('#wajib1').val());
            $('#wajib1').val(isiwajib1 + 1);
            var isi = "<div class='col-md-4 evidence-" + i + "' style='padding-top: 10px;'>\n\
            <input required type='text' name='evidence_name[]' class='form-control input-sm txtcomponent class_evidence_required class_evidence' required placeholder='Masukkan Nama Bukti Pendukung' />\n\
        </div>\n\
        <div class='col-md-2 evidence-" + i + "' style='padding-top: 10px;'>\n\
            <div class='btn-group evidence-" + i + "' role='group' aria-label='...'>\n\
                <button type='button' class='btn btn-danger btn-sm' id='bukti_pendukung_rem' onclick='hapus_evidence(" + i + ")'>-</button>\n\
            </div>\n\
        </div>\n\
        <div id='linebrs' class='evidence-" + i + "'></div>";
            $("#list_isi").append(isi);
            i++;
//$(".class_evidence:last").css({ backgroundColor: "green", fontWeight: "bolder" });
            $(".class_evidence:last").focus();
        });

        var ii = 2;
        $("#bukti_pendukung_add2").click(function () {
            var isi2 = "<div class='col-md-4 evidence2-" + ii + "' style='padding-top: 10px;'>\n\
            <input required type='text' name='evidence_name2[]' class='form-control input-sm txtcomponent class_evidence_required class_evidence2' placeholder='Masukkan Nama Bukti Pendukung' />\n\
        </div>\n\
        <div class='col-md-2 evidence2-" + ii + "' style='padding-top: 10px;'>\n\
            <div class='btn-group evidence2-" + ii + "' role='group' aria-label='...'>\n\
                <button type='button' class='btn btn-danger btn-sm' onclick='hapus_evidence2(" + ii + ")'>-</button>\n\
            </div>\n\
        </div>\n\
        <div id='linebrs' class='evidence2-" + ii + "'></div>";
            $("#list_isi2").append(isi2);
            ii++;
            $(".class_evidence2:last").focus();
        });

        var iii = 2;
        $("#bukti_pendukung_add3").click(function () {
            var isi3 = "<div class='col-md-4 evidence3-" + iii + "' style='padding-top: 10px;'>\n\
            <input required type='text' name='evidence_name3[]' class='form-control input-sm txtcomponent class_evidence_required class_evidence3' placeholder='Masukkan Nama Bukti Pendukung' />\n\
        </div>\n\
        <div class='col-md-2 evidence3-" + iii + "' style='padding-top: 10px;'>\n\
            <div class='btn-group evidence3-" + iii + "' role='group' aria-label='...'>\n\
                <button type='button' class='btn btn-danger btn-sm' onclick='hapus_evidence3(" + iii + ")'>-</button>\n\
            </div>\n\
        </div>\n\
        <div id='linebrs' class='evidence3-" + iii + "'></div>";
            $("#list_isi3").append(isi3);
            iii++;
            $(".class_evidence3:last").focus();
        });

        var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
                allPrevBtn = $('.prevBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function (e) {
            var steps = $('#step_langkah').val();

            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url'],input[type='file']"),
                    isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        allPrevBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

            $(".form-group").removeClass("has-error");
            prevStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });
</script>
