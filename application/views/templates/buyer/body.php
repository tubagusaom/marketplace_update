<style media="screen">

  @media (min-width: 480px) {
    .responsivetb-product{
      width:200px; height:200px;
      /* background: rgba(255, 0, 0, 0.1)!important; */
    }

    .imgtb-responsive{
      height:192px!important;
    }

  }

  @media (max-width: 991px) {
    #viewhp{
      display: none!important;
    }
    #viewpc{
      display: block!important;
    }
  }

  @media (min-width: 991px) {
    #viewhp{
      display: block!important;
    }
    #viewpc{
      display: none!important;
    }
  }

  .addtocart{
    background:#fff!important;
    color:#ee3d43!important;
  }

  .del-favorit{
    background:#ee3d43;
    color:#fff;

    visibility: visible;
    left: auto;
    right: auto;
    transition: all 0.2s;
    text-align: center;
    margin-top: 0;
    margin-bottom: 0;


  	font-size: 14px;
  	padding: 2px 10px 0 10px;
  	height: 32px;
  	line-height: 30px;
  }
  .del-favorit:hover{
    background:#fff;
    color:#ee3d43;
    border: 1px solid #ee3d43;
  }

  .in-favorit{
    background:#fff;
    color:#ee3d43;

    visibility: visible;
    left: auto;
    right: auto;
    transition: all 0.2s;
    text-align: center;
    margin-top: 0;
    margin-bottom: 0;


  	font-size: 14px;
  	padding: 0 10px 0 10px;
  	height: 32px;
  	line-height: 30px;
    border: 1px solid #ee3d43;
  }
  .in-favorit:hover{
    background:#ee3d43;
    color:#fff;
    border: 1px solid #ee3d43;
  }

  @media (max-width: 992px) {
    .container-product{
      padding-top: 130px;
    }
  }
  @media (min-width: 992px) {
    .container-product{
      padding-top: 20px;
    }
  }

</style>

<div role="main" class="main">

<div id="viewhp" class="banners-container">
  <div class="container">
    <div class="row">

      <div class="slider-area">
        <div class="owl-carousel owl-theme" data-plugin-options="{'items':1, 'loop': true}">

          <?php foreach ($slideshow as $key => $slides) { ?>

          <!-- <a href="#" class="banner"> -->
            <img src="<?=base_url()?>assets/img/slides/<?=$slides->foto_slide?>" alt="<?=$slides->nama_slide1?>">
            <!-- <img style="height:405px;" src="<?=base_url()?>assets/img/slides/<?=$slides->foto_slide?>" alt="<?=$slides->nama_slide1?>"> -->
          <!-- </a> -->

          <?php } ?>

          <!-- <a href="#" class="banner">
            <img src="<?=base_url()?>assets/img/demos/slides/shop8/slide1.jpg" alt="Banner">
          </a> -->

        </div>
      </div>

      <div class="side-area">
        <div class="row">
          <div class="col-md-12 col-sm-4 col-xs-12">

            <?php foreach ($showiklan as $key => $iklan) { ?>

            <a href="#" class="banner">
              <img src="<?=base_url()?>assets/img/iklan/<?=$iklan->foto_iklan?>" alt="<?=$iklan->nama_iklan?>">
              <!-- <img style="height:129px;" src="<?=base_url()?>assets/img/iklan/<?=$iklan->foto_iklan?>" alt="<?=$iklan->nama_iklan?>"> -->
            </a>

            <?php } ?>
          </div>

          <!-- <div class="col-md-12 col-sm-4 col-xs-12">
            <a href="#" class="banner">
              <img src="<?=base_url()?>assets/img/demos/banners/shop8/banner2.jpg" alt="Banner">
            </a>
          </div>

          <div class="col-md-12 col-sm-4 col-xs-12">
            <a href="#" class="banner">
              <img src="<?=base_url()?>assets/img/demos/banners/shop8/banner3.jpg" alt="Banner">
              <img src="<?=base_url()?>img/slide/banner-free-ongkir.jpeg" alt="Free Ongkir">
            </a>
          </div> -->
        </div>
      </div>

    </div>
  </div>
</div>

<div id="viewpc" class="banners-container">
  <div class="container container-product">
    <div class="row">

      <div class="slider-area">
        <img class="img-responsive" src="<?=base_url()?>assets/img/slides/banner1.jpg" alt="homedepo">
      </div>

    </div>
  </div>
</div>

<!-- <div class="homepage-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <i class="fa fa-truck bar-icon"></i>
        <div class="bar-textarea">
          <h3>GRATIS ONGKIR</h3>
          <p>Hingga Rp. 500.000,-</p>
        </div>
      </div>
      <div class="col-md-4">
        <i class="fa fa-dollar bar-icon"></i>
        <div class="bar-textarea">
          <h3>GRATIS MASKER</h3>
          <p>Syarat dan ketentuan berlaku</p>
        </div>
      </div>
      <div class="col-md-4">
        <i class="fa fa-support bar-icon"></i>
        <div class="bar-textarea">
          <h3>DUKUNGAN ONLINE 24/7</h3>
          <p>
            <i class="fa fa-whatsapp" style="color: #4ced69;">
              <a class="a-tb-wa" href="https://api.whatsapp.com/send?phone=6281113801802&text=Hai%20Homemin ,%20tolong%20bantu%20saya :)" target="_blank" title="WA">+62811 1380 1802</a>
            </i>
          </p>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="container" style="padding-top:20px;">
  <div class="row">
    <div class="col-md-12 normal">
      <div class="tabs home-products-tab">
        <ul class="nav nav-links">
          <li class="active">
            <a href="#ProdukTerbaru" data-toggle="tab">Produk Terbaru</a>
          </li>
          <!-- <li>
            <a href="#Diskon" data-toggle="tab">Kejar Diskon</a>
          </li> -->
        </ul>

        <div class="tab-content">

          <div id="ProdukTerbaru" class="tab-pane active">
            <ul class="products-grid columns5">

              <?php
                foreach ($product_terbaru as $key => $productterbaru) {
              ?>

              <li>
                <div class="product">
                  <figure class="product-image-area responsivetb-product">

                    <a href="<?=base_url()?>product/detail/<?=$productterbaru->id?>/<?=$productterbaru->nama_file?>" title="<?=$productterbaru->nama_product?>" class="product-image">
                      <img class="imgtb-responsive" src="<?=base_url()?>assets/img/product/<?=$productterbaru->nama_file?>" alt="<?=$productterbaru->tag_product?>">
                      <!-- <img src="<?=base_url()?>assets/img/product/<?=$productterbaru->nama_file?>" alt="<?=$productterbaru->tag_product?>" class="product-hover-image"> -->
                    </a>

                    <a href="<?=base_url()?>product/detail/<?=$productterbaru->id?>/<?=$productterbaru->nama_file?>" class="product-quickview">
                      <i class="fa fa-share-square-o"></i>
                      <span>Lihat Produk</span>
                    </a>



                    <div class="product-actions" id="divProductActions">

                      <?php
                        $this->db->from(kode_tbl().'product_favorite'.' a');
                        // $this->db->join(kode_tbl().'product b','a.id_product=b.id');
                        $this->db->where('a.id_product', $productterbaru->id);
                        $this->db->where('a.id_buyer', $id_member);
                        $favorites = $this->db->get()->row();

                        if ($favorites->id_product == $productterbaru->id) {
                          $classf = 'del-favorit';
                          $titlef = 'Hapus Favorit';
                          $onclickf = 'deletFavorit';
                          $idf = $favorites->id;
                        }else {
                          $classf = 'in-favorit';
                          $titlef = 'Favoritkan';
                          $onclickf = 'addFavorit';
                          $idf = $productterbaru->id;
                        }

                      ?>

                      <a href="<?=base_url()?>home" onclick="<?=$onclickf?>(<?=$idf; ?>)" id="FaVorit" class="<?=$classf?>" title="<?=$titlef?>">
                        <i class="fa fa-heart" style="padding-top:8px;"></i>
                      </a>

                      <a id="addKeranjang" href="<?=base_url()?>home" onclick="addKeranjang(<?=$productterbaru->id; ?>)" class="addtocart" title="Masukan Keranjang">
                        <i class="fa fa-shopping-cart" style="padding-top:8px;"></i>
                      </a>

                      <!-- <a href="<?=base_url()?>product/bagikan/<?=$productterbaru->nama_file?>/<?=$productterbaru->id?>" class="comparelink" title="Bagikan">
                        <i class="fa fa-link" style="padding-top:8px;"></i>
                      </a> -->
                    </div>




                  </figure>
                  <div class="product-details-area">

                    <h2 class="product-name" style="text-align:left;font-size:10px;font-weight:700;">
                      <a href="#" title="homedepo" style="color:#1c2a5f!important">
                        <i class="fa fa-building" style="color:#db0c13;"></i>
                        <?=$productterbaru->member?>
                      </a>
                    </h2>

                    <h2 class="product-name">
                      <a href="<?=base_url()?>product/detail/<?=$productterbaru->id?>/<?=$productterbaru->nama_file?>" title="<?=$productterbaru->nama_product?>">
                        <?=$productterbaru->nama_product?>
                      </a>
                    </h2>
                    <!-- <div class="product-ratings">
                      <div class="ratings-box">
                        <div class="rating" style="width:60%"></div>
                      </div>
                    </div> -->

                    <div class="product-price-box">
                      <span class="product-price">
                        Rp. <?= number_format($productterbaru->harga_product,0,',','.') ?>
                      </span>
                    </div>
                  </div>
                </div>
              </li>

              <?php } ?>

            </ul>
          </div>

          <div id="Diskon" class="tab-pane">
            <ul class="products-grid columns4">

              <li>PRODUK KEJAR DISKON</li>

            </ul>
          </div>

        </div>
      </div>

    </div>

    <!-- <aside class="col-md-3 sidebar shop-sidebar">
      <?=$this->load->view('templates/bootstraps/menu_samping'); ?>
    </aside> -->

  </div>
</div>

<!-- posisi pop up iklan -->

</div>


<script type="text/javascript">

var baseUrl = '<?=base_url()?>';

function addKeranjang(id){
  // alert(id);

  var toUrl = "buyer/tambah_keranjang";
  var urlTarget = baseUrl+toUrl;

  $.ajax({
    url: urlTarget+'/'+id+'/1',
    type: 'POST',
    data: id,
    processData: false,
    contentType: false,
    success: function (data) {
      // data = JSON.parse(data);
      if(data.error){
        // $('#myOverlay').hide();
        // $('#loadingGIF').hide();
        alert(data.error);
      }else{
        alert('Produk berhasil ditambahkan ke keranjang');
        // $("#FaVorit").load();
        // $("#divFaVorit").load();
      }
      // alert('ok');
      // $("#divFaVorit").load();
    },
    error: function (request, status, error) {
      // alert(request.responseText);
      // $('#myOverlay').hide();
      // $('#loadingGIF').hide();
    }
  });

};

function addFavorit(id){
  // alert(id);

  var toUrlf = "buyer/tambah_favorit";
  var urlTargetf = baseUrl+toUrlf;

  $.ajax({
    url: urlTargetf+'/'+id,
    type: 'POST',
    data: id,
    processData: false,
    contentType: false,
    success: function (data) {
      // data = JSON.parse(data);
      if(data.error){
        // $('#myOverlay').hide();
        // $('#loadingGIF').hide();
        alert(data.error);
      }else{
        // alert('ok');
        alert('Produk berhasil ditambahkan ke favorit');
      }
    },
    error: function (request, status, error) {
      // alert(request.responseText);
      // $('#myOverlay').hide();
      // $('#loadingGIF').hide();
    }
  });

};

function deletFavorit(id){
  // alert(id);

  var toUrl = "buyer/hapus_favorit";
  var urlTarget = baseUrl+toUrl;

  $.ajax({
    url: urlTarget+'/'+id,
    type: 'POST',
    data: id,
    processData: false,
    contentType: false,
    success: function (data) {
      // data = JSON.parse(data);
      if(data.error){
        // $('#myOverlay').hide();
        // $('#loadingGIF').hide();
        alert(data.error);
      }else{
        // alert('ok');
        alert('Produk berhasil dihapus dari daftar favorit');
      }
    },
    error: function (request, status, error) {
      alert(request.responseText);
      // $('#myOverlay').hide();
      // $('#loadingGIF').hide();
    }
  });

};

</script>
