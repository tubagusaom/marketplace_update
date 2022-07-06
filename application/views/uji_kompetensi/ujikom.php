

<title><?=$aplikasi->singkatan_unit?> - Uji Kompetensi</title>
<link rel="shortcut icon" href="<?=base_url()?>assets/ujikom.png" type="image/x-icon" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstraps/font-awesome.min.css" type="text/css"/>
        <link href="<?=base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />


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
                        <!--  disabled="disabled" //-->
                        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                        <p>Step 4</p>
                    </div>
                </div>
            </div>

	<div class="col-lg-12">
	     <div class="row setup-content" id="step-1">
		  <div class="row" >
	     <section class="panel panel-default">

            <div class="panel-body">

                <fieldset>
                    <legend>
                        <h3> MEMILIH SKEMA SERTIFIKASI</h3>
                        <h5> Pada bagian ini,  pilihlah skema yang akan di ujikan. Pilih salah satu.</h5>
                    </legend>
                </fieldset>
	    <form class="" action="" method="get">
            <div class="input-group">

                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
                <input name="keyword" type="text" id="accordion_search_bar" class="form-control" placeholder="Cari skema yang diinginkan!">
            </div>
	    </form>
            <!-- /input-group -->


            <form role="form" method="post" action="<?php echo base_url() . "welcome/uji_kompetensi_save"; ?>" id="form_submit" enctype="multipart/form-data">
                <input type="hidden" name="skema_yang_dipilih" id="skema_yang_dipilih" />
                
                    <?php
                    $this->load->view('uji_kompetensi/step_1');
                    ?>
                </div>
                <div class="row setup-content" id="step-2">
                    <?php
                    $this->load->view('uji_kompetensi/step_2');
                    ?>
                </div>
                <div class="row setup-content" id="step-3">
                    <?php
                    $this->load->view('uji_kompetensi/step_3');
                    ?>
                </div>

                <div class="row setup-content" id="step-4">
                    <?php
                    $this->load->view('uji_kompetensi/step_4');
                    ?>
                </div>
        </div>
    </form>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.v2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/bootstraps/bootstrap.min.js" type="text/javascript"></script>

<script>
    var base_url = "<?php echo base_url() ?>";

    function add_combo() {
        var hasil = [];
        $("input[name='file_data[]']").each(function () {
            var fileName = $(this).val().split('/').pop().split('\\').pop();
            //console.log(fileName);
            hasil.push(fileName);
        });
        return hasil;
    }
    function create_combo() {
        var bukti_sertifikat = "";
        var bukti_s = "";
        var data = add_combo();
        $.each(data, function (key, value) {
            bukti_sertifikat = bukti_sertifikat + "<option value='" + value + "'>" + value + "</option>";
            bukti_s = bukti_s + "<option selected value='" + value + "'>" + value + "</option>";
        })

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
            var cekStep3 = $(".formStep3 input:required");
            var countDt = 0;
            $.each(cekStep3, function (key, value) {
                if (value.value == "") {
                    $("#" + value.id).focus();
                    return false;
                } else {
                    countDt++;
                }
            })

            if (countDt < cekStep3.length) {
                alert("Upload Data Rekomendasi terlebih dahulu !");
                return false;
            }

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
