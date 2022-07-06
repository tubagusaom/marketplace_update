<!--Banner Start-->
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li class="active">Kontak</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>KONTAK KAMI</h1>
                </div>
            </div>
        </div>
    </section>

    <div id="main">
    <section class="generic-heading-3">
        <div class="container">
          <?php
            if($this->session->flashdata('result')!=''){
              ?>

                <div class="alert alert-<?=$this->session->flashdata('mode_alert')?>" role="alert" id="Div-Alert">
                  <button class="close" onclick="hide('Div-Alert')">×</button>
                  <h4 class="alert-heading"><u>Terimakasih</u></h4>
                  <?php echo $this->session->flashdata('result'); ?>
                </div>
              <?php
            }
          ?>
        </div>
    </section>
    <!--Contact Page Start-->
    <section class="contact-page">
	<div class="row">
	<div class="container">

        <div class="contact-map">
            <div class="col-md-12">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.1842758455455!2d107.5924419144975!3d-6.868509395036532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e695ada83bff%3A0xccb5b367a25ab49e!2sSekolah+Tinggi+Pariwisata+Bandung!5e0!3m2!1sid!2sid!4v1533394545275"
                    width="100%"
                    height="350"
                    frameborder="0"
                    style="border:0">
                </iframe>
            </div>
        </div>

               

                    
                        <div class="col-md-6">
                            <h2 class="mb-sm mt-sm"><strong>Contact</strong> Us</h2>
                            <form id="contactForm" action="<?php echo base_url('kontak/save') ?>" method="POST">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label>Your name *</label>
                                            <input type="text" name="nama_kontak" id="nama_kontak" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Your email address *</label>
                                            <input type="email" name="email_kontak" id="email_kontak" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Subject</label>
                                            <input type="text" name="subject_kontak" id="subject_kontak" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Message *</label>
                                            <textarea name="message_kontak" id="message_kontak" maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="btn-message" type="submit" value="Send Message" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6" style="margin-top: 15px;">

                            <h4 class="heading-primary">Alamat <strong><?=$aplikasi->singkatan_unit?></strong></h4>
                            <ul class="list list-icons list-icons-style-3 mt-xlg">
                                <li><i class="fa fa-map-marker"></i> <strong>Alamat :</strong> &nbsp;<?=$aplikasi->alamat?></li>
                                <li><i class="fa fa-phone"></i> <strong>Phone :</strong>&nbsp;<?=$aplikasi->no_telpon?> </li>
																<li><i class="fa fa-fax"></i> <strong>Fax :</strong>&nbsp;<?=$aplikasi->no_fax?> </li>
                                <li><i class="fa fa-envelope"></i> <strong>Email :</strong> <a href="mailto:mail@example.com">&nbsp;<?=$aplikasi->alamat_email?></a></li>
																<li><i class="fa fa-globe"></i> <strong>Url Aplikasi :</strong><a href="http://asahi.or.id" target="_blank">&nbsp;<?=$aplikasi->url_aplikasi?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

    </section>
    <!--Contact Page End-->
</div>


<script type="text/javascript">
  function hide(target) {
    document.getElementById(target).style.display = 'none';
  }
</script>
