<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?=$rolename?> - <?=$aplikasi->singkatan_unit ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Marketplace belanja online homedepo" name="description" />
        <meta content="" name="author" />

				<link rel="shortcut icon" href="<?=base_url()?>assets/img/logo.jpg" type="image/x-icon" />
        <link rel="apple-touch-icon" href="<?=base_url()?>assets/img/homedepo_icon.jpg">

        <!-- font-awesome -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets_mobile/fonts/css/fontawesome-all.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css"/>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets_mobile/styles/framework.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets_mobile/styles/style.css">

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

        <script type="text/javascript">
            var base_url = '<?= site_url(); ?>';
        </script>
        <script src="<?php echo base_url() ?>assets_mobile/js/jquery.min.js"></script>
        <link rel="icon" href="<?= base_url(); ?>favicon.ico">

        <style media="screen">
          .highlight-blue .menu-items .bg-highlight{
            background-color: #1a8fb7!important;
          }
        </style>

    </head>
    <!-- END HEAD -->

    <!-- <div id="preloader" class="preloader-light"> -->
    <div id="preloader" class="preloader-light">
        <h1 class="center-text color-black ultrabold uppercase bottom-0 fa-2x">
            <span class="color-blue-dark" style="color:#1a8fb7!important">
              <?= $aplikasi->singkatan_unit ?>
            </span>
        </h1>

        <!-- <div id="preload-spinner"> -->
        <div id="" style="padding-left:350px;">
          <img src="<?=base_url()?>loading.gif" alt="<?= $aplikasi->singkatan_unit ?>" style="width:50%;">
        </div>

        <em>Copyright <?=$aplikasi->singkatan_unit ?> 2021. Develop By TB</em>
    </div>

    <body>
    <div id="" class="page-build highlight-blue">
        <div class="header header-light header-logo-center">
            <a href="<?=base_url() ?>home" class="header-logo header-logo-text-tb">
              <!-- <?=$aplikasi->singkatan_unit ?> -->
              <font class="header-text-0"><?=$rolename?></font>
              <font class="header-text-1">Home</font>
              <font class="header-text-2">Depo</font>
            </a>

            <a data-menu="menu-utama" href="#" class="header-icon header-icon-1">
							<i class="fas fa-bars color-blue-dark"></i>
						</a>
            <a data-menu="menu-profile" href="#" class="header-icon header-icon-4">
							<i class="fas fa-cog color-blue-dark "></i>
						</a>
        </div>

        <div id="menu-utama" class="menu-sidebar menu-homedepo menu-sidebar-left menu-sidebar-reveal">
          <?php $this->load->view('templates/seller/menu_kiri.php'); ?>
        </div>

        <div id="menu-profile" class="menu-sidebar menu-homedepo menu-sidebar-right menu-sidebar-reveal">
          <?php $this->load->view('templates/seller/menu_kanan.php'); ?>
        </div>

        <div class="page-content header-clear" style="background:whitesmoke">
          <div class="content">
