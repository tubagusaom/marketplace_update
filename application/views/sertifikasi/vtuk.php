<div class="body">

  <section class="page-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="<?=base_url();?>welcome/lsp">Home</a></li>
            <li class="active">TUK</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h1>TEMPAT UJI KOMPETENSI</h1>
        </div>
      </div>
    </div>
  </section>

  <div class="container">

    <div class="col-md-12">
      <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.1842758455455!2d107.5924419144975!3d-6.868509395036532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e695ada83bff%3A0xccb5b367a25ab49e!2sSekolah+Tinggi+Pariwisata+Bandung!5e0!3m2!1sid!2sid!4v1533394545275" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
<!--         <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5740457563984!2d106.82168261440118!3d-6.187712695520385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f425e1bb5c07%3A0x557c23d6dc2ef837!2sJimly+School+Of+Law+And+Government!5e0!3m2!1sen!2sid!4v1513931668386"
            class="google-map"
            style="border:0; margin-top:25px">
        </iframe> -->
      </div>
    </div>

          <div class="row">

        <?php 
        $step = 0;
        foreach($data as $key=>$value){?>
          <div class="col-md-4 col-sm-3">
            <div class="featured-box featured-box-tertiary featured-box-effect-4 mt-xlg appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="<?= $step += 80;?>">
              <div class="box-content">
                <i class="icon-featured fa fa-location-arrow"></i>
                <h4 class="text-uppercase"><?=$value->tuk?></h4>
                <p><?=$value->alamat?></p>
                <p><?=$value->kabupaten?></p>
                <p><?=$value->telp?></p>
                <!-- <p><a href="/" class="lnk-tertiary learn-more">Learn more <i class="fa fa-angle-right"></i></a></p> -->
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
   


  </div>

</div>
