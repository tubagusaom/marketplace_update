<!DOCTYPE html>
<html>
  <head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 

    <title>ASOSIASI AUDITOR HUKUM INDONESIA</title> 

    <meta name="keywords" content="ASAHI" />
    <meta name="description" content="ASAHI">
    <meta name="author" content="okler.net">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?=base_url()?>assets/img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/theme.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/theme-elements.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/theme-blog.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/rs-plugin/css/navigation.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/circle-flip-slideshow/css/component.css">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/skins/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/custom.css">
    <style type="text/css">
      .btn a:hover{
        color: #fff;
        text-decoration: none;
      }
    </style>
      <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- Head Libs -->
    <script src="<?=base_url()?>assets/vendor/modernizr/modernizr.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstraps/bootbox.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    var base_url = "<?php echo base_url() ?>";
    </script>
    <script src="<?php echo base_url() ?>assets/js/public/login.js" type="text/javascript"></script>
      <script type="text/javascript">
    function login_click(){
        $('#btn-login').click();
    }
    </script>
  </head>
  </header>
<div class="modal fade bs-modal" role="dialog" id="myModal">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Login</h4>
    </div>
    <div class="modal-body">
    <div class="form-group">
      <div class="row">
        <div class="col-xs-2">
          <label class="control-label labeled-form" for="inputUsername">Username</label>
        </div>
        <div class="col-xs-10 tooltip-wide">
          <div class="input-group merged">
             <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user fa-xs"></i></span>
             <input type="text" class="form-control login-control" aria-describedby="basic-addon1" name="inputUsername" id="inputUsername">
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="row">
        <div class="col-xs-2">
          <label class="control-label labeled-form" for="inputPassword">Password</label>
        </div>
        <div class="col-xs-10 tooltip-wide">
          <div class="input-group merged">
            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-key fa-xs"></i></span>
            <input type="password" class="form-control login-control" aria-describedby="basic-addon2" name="inputPassword" id="inputPassword" onkeypress="if(event.keyCode==13) login_click();">
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary disabled" id="btn-login">Login</button>
    </div>
  </div>
  </div>
</div> 
<body>
<header id="header" class="header-narrow" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 57, 'stickySetTop': '-57px', 'stickyChangeLogo': false}">
        <div class="header-body">
          <div class="header-top header-top-style-4">
            <div class="container">
              <div class="header-search hidden-xs">
                <form id="searchForm" action="page-search-results.html" method="get">
                  <div class="input-group">
                    <input type="text" class="form-control" name="q" id="q" placeholder="Search..." required>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </form>
              </div>
             
              <p class="pull-right">
                <span class="mr-xs"><i class="icon-call-end icons mr-xs"></i>021 39833450</span><span class="hidden-xs"></span>
              </p>
            </div>
          </div>
          <div class="header-container container">
            <div class="header-row">
             
             
            </div>
          </div>
        </div>
      </header>
<div class="container">
<div class="row">
            <div class="col-md-12" style="text-align: center;">
              <h4 class="mb-sm"><strong>Asosiasi Auditor Hukum Indonesia</strong></h4>
              <p>Akses sistem terintegrasi kami untuk penyelenggaraan Pelatihan, Sertifikasi dan Asosiasi Profesi</p>
            </div>
          </div>

          <div class="row">
            <div class="pricing-table">
              <div class="col-md-4 col-sm-6">
                <div class="plan">
                  <h3>Lembaga Diklat dan Pelatihan<span>LDP</span></h3>
                  <a class="btn btn-lg btn-primary" href="https://www.jimlyschool.com/" target="_blank">Detail</a>
                  <ul>
                    <li>Penyelenggara kegiatan Diklat yang bekerja sama dengan LSP Auditor Hukum Indonesia dengan materi berbasis Standar Kompetensi</li>
                   
                  </ul>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 center">
                <div class="plan most-popular">
                  <div class="plan-ribbon-wrapper"><div class="plan-ribbon">Popular</div></div>
                  <h3>Sertifikasi<span>LSP</span></h3>
                  <a class="btn btn-lg btn-primary" href="<?=base_url().'welcome/lsp'?>">Detail</a>
                  <ul>
                    <li>Pengakuan kompetensi dari Industri terkait dengan di terbitkan nya sertifikat kompetensi oleh LSP yang sudah di terlisensi oleh <a href="http://bnsp.go.id">BNSP</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="plan">
                  <h3>Stakeholder Profesi<span>ASAHI</span></h3>
                  <a class="btn btn-lg btn-primary" href="#">Detail</a>
                  <ul>
                    <li>Organisasi resmi yang mewadahi para Ahli dan Profesional di bidang Hukum. Akses fitur keanggotaan, agenda dan kegiatan</li>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
</div>

        <section id="team">
          <div class="container">
            <div class="row mt-xlg">
              <div class="col-md-12 center">
                <h2>Kegiatan <strong>Terbaru</strong></h2>
              </div>
            </div>
            <div class="row mb-xlg">
            <?php 
              foreach ($berita_lsp_list as $key => $value) {
            ?>
              <div class="col-md-4 col-sm-6 col-xs-12">
                <span class="thumb-info thumb-info-hide-wrapper-bg">
                  <span class="thumb-info-wrapper">
                    <a href="<?php echo base_url().'artikel/view/'.$value->id ?>">
                    <img class="img-responsive mb-lg img-circle" src="<?= base_url().'assets/files/artikel/'.$value->foto ?>" alt="">
                      <span class="thumb-info-title">
                        <span class="thumb-info-inner"><?= $value->judul?></span>
                      </span>
                    </a>
                      <div style="text-align: right; font-size: 11px; color: #3498DB;">
                                <i class="fa fa-user"></i>
                                  By Admin |
                                <?php echo $tanggal = date("F d, Y", strtotime(
                                $value->created_when)); ?>
                      </div>
                  </span>
                  <span class="thumb-info-caption">
                    <span class="thumb-info-caption-text" style="font-size: 14px; color: #423C3C; text-align: justify;">
                      <?php
                        $string = $value->isi;
                        echo word_limiter($string, 25);
                      ?> 
                    </span>
                  </span>
                </span>
              </div>
                          <?php } ?>
            </div>
          </div>
        </section>

<footer id="footer">
        <div class="container">
          <div class="row">
            <div class="footer-ribbon">
              <span>ASAHI</span>
            </div>
            <div class="col-md-4">
              <div class="contact-details">
                <h4>Contact Us</h4>
                <ul class="contact">
                  <li><p><i class="fa fa-map-marker"></i> <strong>Alamat:</strong> <?=$aplikasi->alamat?></p></li>
                  <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> <?=$aplikasi->no_telpon?> Fax : <?=$aplikasi->no_fax?></p></li>
                  <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:<?=$aplikasi->alamat_email?>"><?=$aplikasi->alamat_email?></a></p></li>
                </ul>
              </div>
            </div>
            <div class="col-md-2">
              <h4>Follow Us</h4>
              <ul class="social-icons">
                <li class="social-icons-facebook"><a href="https://www.facebook.com/LSP-AHI-1998220023831768/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
            <div class="col-md-6">
              <h4>Location</h4>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.574017985156!2d106.82162521431327!3d-6.187716395520395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f425e1ebb9df%3A0x8831eb5b0df677da!2sJl.+M.H.+Thamrin+No.11%2C+Gondangdia%2C+Menteng%2C+Kota+Jakarta+Pusat%2C+Daerah+Khusus+Ibukota+Jakarta+10350!5e0!3m2!1sid!2sid!4v1513854486729"
                    width="100%"
                    height="250"
                    frameborder="0"
                    style="border:0">
                </iframe>
            </div>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                <p>© Copyright 2017. Develoved by Mitra Buana Solusindo</p>
              </div>
              <div class="col-md-4">
                <nav id="sub-menu">
                  <ul>
                    <li><a href="#">FAQ's</a></li>
                    <li><a href="#">Sitemap</a></li>
                    <li><a href="#">Contact</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </footer>

    <!-- Vendor -->
    <script src="<?=base_url()?>assets/vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/jquery-cookie/jquery-cookie.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/common/common.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/jquery.validation/jquery.validation.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/isotope/jquery.isotope.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/vide/vide.min.js"></script>
    
    <!-- Theme Base, Components and Settings -->
    <script src="<?=base_url()?>assets/js/theme.js"></script>
    
    <!-- Current Page Vendor and Views -->
    <script src="<?=base_url()?>assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js"></script>
    <script src="<?=base_url()?>assets/js/views/view.home.js"></script>
    
    <!-- Theme Custom -->
    <script src="<?=base_url()?>assets/js/custom.js"></script>
    
    <!-- Theme Initialization Files -->
    <script src="<?=base_url()?>assets/js/theme.init.js"></script>

    <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-12345678-1', 'auto');
      ga('send', 'pageview');
    </script>
     -->

  </body>
</html>