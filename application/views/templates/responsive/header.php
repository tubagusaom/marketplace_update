<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Sistem Sertifikasi LSP</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= base_url() ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?= base_url() ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet" type="text/css" id="style_color" />

        <link href="<?= base_url() ?>assets/vendor/snackbarjs/snackbar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/vendor/snackbarjs/material.css" rel="stylesheet" type="text/css" />

        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?= base_url() ?>logo.ico" /> </head>
        <script src="<?= base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <style type="text/css">
        .modal-gif {
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) 
                        url('http://lspstpbandung.id/assets/img/39.gif') 
                        50% 50% 
                        no-repeat;
            display: none;
        }        
    </style>


    <!-- END HEAD -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?= base_url() ?>">
                            <img class="img-rounded"  src="<?= base_url() . 'assets/img/logo49.png' ?>" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                              <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i>
                                    <span class="badge badge-default"> <?= count($query_pesan_unread) ?> </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>You have
                                            <span class="bold"><?= count($query_pesan) ?></span> Messages</h3>
                                        <a href="#">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <?php foreach ($query_pesan as $key => $value) {
                                                ?>
                                                <li>
                                                    <a href="<?= base_url() . 'pesan/index' ?>">
                                                        <span class="photo">
                                                            <img src="<?= base_url() ?>assets/img/logo49.png" class="img-circle" alt=""> </span>
                                                        <span class="subject">
                                                            <span class="from"> Administrator </span>
                                                            <span class="time">Just Now </span>
                                                        </span>
                                                        <span class="message"> <?= $value->title ?> </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <?php

                                    $foto = ($this->asesi->foto_profil != "") ? $this->asesi->foto_profil : 'logo49.png';
                                    ?>
                                    <img alt="" class="img-circle" src="<?= base_url() ?>assets/files/asesi/<?= $foto ?>" />
                                    <span class="username username-hide-on-mobile"> <?= $this->auth->get_user_data()->nama_user ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?= base_url() . '' ?>">
                                            <i class="icon-user"></i> Akun </a>
                                    </li>

                                    <?php
                                      $jenisuser=$this->auth->get_user_data()->jenis_user;

                                      if ($jenisuser == 1) {
                                    ?>

                                    <li>
                                        <a href="#">
                                            <i class="icon-calendar"></i> Jadwal Uji </a>
                                    </li>

                                    <?php }else { echo ""; } ?>

                                    <li class="divider"> </li>
                                    <li>
                                        <a href="<?= base_url() . 'users/logout' ?>">
                                            <i class="fa fa-sign-out"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="<?= base_url() . 'users/logout' ?>" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <div class="clearfix"> </div>

            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <?php
                          if ($jenisuser == 1) {
                            $this->load->view('templates/responsive/menu');
                          }elseif ($jenisuser == 2) {
                            $this->load->view('templates/responsive/menu_asesor');
                          }else {
                            echo "";
                          }
                        ?>
                    </div>
                </div>
