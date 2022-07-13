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
      padding-top: 170px;
    }
  }
  @media (min-width: 992px) {
    .container-product{
      padding-top: 20px;
    }
  }

</style>

<div role="main" class="main">

<div class="container container-product">
  <div class="row">
    <div class="col-md-12 normal">
      <div class="tabs home-products-tab">
        <ul class="nav nav-links">
          <li class="active">
            <a href="#ProdukTerbaru" data-toggle="tab"><font style="color:#777;;">Filter Berdasarkan</font> <?=str_replace('%20',' ',$ket_filter)?></a>
          </li>
          <!-- <li>
            <a href="#Diskon" data-toggle="tab">Kejar Diskon</a>
          </li> -->
        </ul>

        <div class="tab-content">

          <div id="ProdukTerbaru" class="tab-pane active">

            <?php
              $total_filter = count($show_filter_product);

              if ($total_filter == 0) {
                // echo "Produk Belum Tersedia";
            ?>

            <div class="col-md-12">
              <img id="img-notfound" src="<?=base_url()?>assets/img/produk_belum_tersedia.png" alt="homedepo">
            </div>

            <?php } ?>

            <ul class="products-grid columns5">

              <?php
                foreach ($show_filter_product as $key => $productterbaru) {
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

                        if (isset($nama_user)) {

                      ?>

                      <a href="<?=base_url()?>home" onclick="<?=$onclickf?>(<?=$idf; ?>)" id="FaVorit" class="<?=$classf?>" title="<?=$titlef?>">
                        <i class="fa fa-heart" style="padding-top:8px;"></i>
                      </a>

                      <a id="addKeranjang" href="<?=base_url()?>buyer/keranjang" onclick="addKeranjang(<?=$productterbaru->id; ?>)" class="addtocart" title="Masukan Keranjang">
                        <i class="fa fa-shopping-cart" style="padding-top:8px;"></i>
                      </a>

                      <!-- <a href="<?=base_url()?>product/bagikan/<?=$productterbaru->nama_file?>/<?=$productterbaru->id?>" class="comparelink" title="Bagikan">
                        <i class="fa fa-link" style="padding-top:8px;"></i>
                      </a> -->

                    <?php
                      }else {
                    ?>

                    <a id="login-btn" data-toggle="modal" data-target="#myModal" href="#" class="in-favorit" title="Favoritkan">
                      <i class="fa fa-heart" style="padding-top:8px;"></i>
                    </a>

                    <a id="login-btn" data-toggle="modal" data-target="#myModal" href="#" class="addtocart" title="Masukan Keranjang">
                      <i class="fa fa-shopping-cart" style="padding-top:8px;"></i>
                    </a>

                    <?php } ?>

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
                      <a href="#" title="<?=$productterbaru->nama_product?>">
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

    <!-- <div class="col-md-3" style="margin-top:20px;margin-bottom:100px; border-top: 1px solid #ddd;">

    </div>
    <div class="col-md-9" style="margin-top:20px;margin-bottom:100px; border-top: 1px solid #ddd;">
        <div class="halaman">
            <ul class="pager">
                <li class="previous">
                    Halaman :<?php echo rtrim($halaman) ."<b>/" . ceil($jmldata / $per_page); ?>
                </li>
            </ul>
        </div>
    </div> -->

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

  var toUrl = "buyer/add_keranjang";
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
        alert('Produk berhasil ditambahkan ke keranjang');
        // $("#FaVorit").load();
        // $("#divFaVorit").load();
      }
      // alert('ok');
      // $("#divFaVorit").load();
    },
    error: function (request, status, error) {
      alert(request.responseText);
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
      alert(request.responseText);
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
