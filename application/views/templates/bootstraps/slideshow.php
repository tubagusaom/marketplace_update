<section id="coverWrapper" class="clearfix"><!-- cover wrapper start -->
  <div id="owlCarousel" class="owl-carousel owl-theme">

    <?php
          foreach($slideshow as $key=>$value){
              if($key==0){
                  $active='active';
              }else{
                  $active='';
              }
    ?>

      <div class="item">

          <div class="text">
            <div class="content">
              <p><?php echo $value->headline; ?></p>
              <h3>Tumbuh Bersama, Sukses Bersama, Menjadi Manfaat Bagi Bersama</h3>
              <a href="<?=base_url().'welcome/uji_kompetensi'?>" class="btn btn-default btn-lg infoBUtton"> DAFTAR SEKARANG</a>
            </div>
          </div>

          <div class="media">
            <img src="<?php echo base_url()."uploads/img/artikel/".$value->foto ?>" alt="slide01" class="img-responsive">
          </div>
      </div>
      <?php
                    }
                ?>


  </div>
  <!-- script for home slider -->
  <script type="text/javascript">
    $('#owlCarousel').owlCarousel({

          autoPlay : false,
          navigation : true,
          navigationText : ['<i class="fa fa-chevron-left fa-2x"></i>', '<i class="fa fa-chevron-right fa-2x"></i>'],
          slideSpeed : 300,
          pagination : false,
          paginationSpeed : 700,
          singleItem:true,
      });
  </script>
</section><!-- cover wrapper end -->
