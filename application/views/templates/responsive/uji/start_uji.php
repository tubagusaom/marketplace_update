<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Uji teori LSP Home Depo</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Lembaga Sertifikasi Profesi terlisensi oleh BNSP" name="description" />
        <meta content="" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/css/responsive.tb.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= base_url() ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?= base_url() ?>assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet" type="text/css" id="style_color" />

        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?= base_url() ?>favicon.ico" />
        <script src="<?= base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="<?= base_url() ?>assets/css/global.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

        <style>
            .carousel-indicators .active{ background: #31708f; } .content{ margin-top:20px; }
            .adjust1{ float:left; width:100%; margin-bottom:0; }
            .adjust2{ margin:0; } .carousel-indicators li{ border :1px solid #ccc; }
            .carousel-control{ color:#31708f; width:5%; }
            .carousel-control:hover, .carousel-control:focus{ color:#31708f; }
            .carousel-control.left, .carousel-control.right { background-image: none; }
            .media-object{ margin:auto; margin-top:15%; }
            @media screen and (max-width: 768px) { .media-object{ margin-top:0; } }

            .page-container .page-content-wrapper{
                margin-top: -35px;
            }

        </style>

    </head>
   <body>

     <div class="container" style="margin-top: 10px;">
       <div class="col-md-12">


       </div>
     </div>

       <div class="container">
           <div class="col-md-12">
                    <div class="row" style="margin-top: 10px;">
                        <?php

                        if ($this->session->flashdata('result') != '') {
                            ?>
                            <div class="alert alert-<?= $this->session->flashdata('mode_alert') ?>" role="alert"><?php echo $this->session->flashdata('result'); ?></div>
                            <?php
                        }
                        ?>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <style type="text/css">
                                .required_span{
                                    color: red;
                                    font-weight: bold;
                                }
                            </style>

                            <div class="col-md-12 col-xs-12 table-tb">
                                <h2>UJI KOMPETENSI ONLINE</h2>

                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <th scope="row" class="th-tb">Nama Perangkat</th>
                                      <td>: <?= $data->perangkat_detail ?></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Jumlah Soal</th>
                                      <td>: <?= $jenis_soal[$data->jenis_perangkat] ?></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Jumlah Soal</th>
                                      <td>: <?= $data->jumlah_soal ?></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Waktu</th>
                                      <td>: <?= $data->waktu_pengerjaan ?> Menit</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">&nbsp;</th>
                                      <th scope="row" style="float:right">Nama : <?php echo $this->auth->get_user_data()->nama_user;?></th>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <hr style="border:1px solid #000;"/>

                            <div class="col-md-12 col-xs-12 table-tb" id="startUji">
                                <h3>Jawablah setiap pertanyaan dengan benar. Jawaban dapat lebih dari satu !.</h3>
                                <button type="button" id="mulaiUji" class="btn btn-success col-md-12 col-xs-12">Mulai Uji</button>
                                <input type="hidden" id="idPerangkat" value="<?=$id;?>" />
                            </div>

                            <?php
                              // $this->load->view('templates/responsive/uji/view_uji');
                            ?>

                        </div>

            </div>
          </div>
       </div>
   </body>

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

        <script type="text/javascript">

            $("#mulaiUji").click(function () {
                var idperangkat = $("#idPerangkat").val();
                $("#startUji").empty();

                var urlUji = "<?= base_url(); ?>perangkat_asesmen/view_uji/" + idperangkat;
                $("#startUji").load(urlUji);
                return false;
            })

        </script>

        <script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url() ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>

    </body>

</html>
