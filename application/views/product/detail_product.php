<style media="screen">
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

.container-iframe {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 56.25%; /* 1:1 Aspect Ratio */
}

.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}

@media (max-width: 992px) {
  .container-product{
    padding-top: 140px;
  }
}
@media (min-width: 992px) {
  .container-product{
    padding-top: 20px;
  }
}
</style>

<div id="mobile-menu-overlay"></div>

<div role="main" class="main">

  <section class="page-header mb-lg" style="background: #db0c13;">
    <div class="container container-product">
      <ul class="breadcrumb">
        <li><a href="<?=base_url()?>">Home</a></li>

        <li><a href="#"><?=$detail_product->kategori?></a></li>
        <li class="active"><?=$detail_product->sub_kategori?></li>
      </ul>
    </div>
  </section>

  <div class="container mt-lg">
    <div class="product-view">
      <div class="product-essential">
        <div class="row">
          <div class="product-img-box col-sm-5">
            <div class="product-img-box-wrapper">

              <div class="product-img-wrapper">
                <!-- <img id="product-zoom" style="width:366.16px; height:488.2px;" src="<?=base_url()?>assets/img/product/<?=$file_product?>" data-zoom-image="<?=base_url()?>assets/img/product/<?=$file_product?>" alt="Product main image"> -->
                <img id="product-zoom" src="<?=base_url()?>assets/img/product/<?=$file_product?>" data-zoom-image="<?=base_url()?>assets/img/product/<?=$file_product?>" alt="Home Depo">

              </div>

              <a href="#" class="product-img-zoom" title="Zoom" style="right:13px;bottom:15px;">
                <span class="glyphicon glyphicon-search"></span>
              </a>
            </div>

            <div class="owl-carousel manual" id="productGalleryThumbs">

              <?php
                foreach ($file_product_detail as $key => $fpd) {
              ?>


              <div class="product-img-wrapper">
                <a href="#" data-image="<?=base_url()?>assets/img/product/<?=$fpd->nama_file?>" data-zoom-image="<?=base_url()?>assets/img/product/<?=$fpd->nama_file?>" class="product-gallery-item product-img-zoom">
                  <img src="<?=base_url()?>assets/img/product/<?=$fpd->nama_file?>" alt="homedepo">
                </a>
              </div>

              <?php } ?>

            </div>


          </div>

          <div class="product-details-box col-sm-7">
            <!-- <div class="product-nav-container">
              <div class="product-nav product-nav-prev">
                <a href="#" title="Previous Product">
                  <i class="fa fa-chevron-left"></i>
                </a>

                <div class="product-nav-dropdown">
                  <img src="../img/demos/shop/products/product1.jpg" alt="Product">
                  <h4>Blue Denim Dress</h4>
                </div>
              </div>
              <div class="product-nav product-nav-next">
                <a href="#" title="Next Product">
                  <i class="fa fa-chevron-right"></i>
                </a>

                <div class="product-nav-dropdown">
                  <img src="../img/demos/shop/products/product2.jpg" alt="Product">
                  <h4>Black Woman Shirt</h4>
                </div>
              </div>
            </div> -->

            <h2 class="product-name" style="text-align:left;font-size:10px;font-weight:700;">
              <a href="#" title="homedepo" style="color:#1c2a5f!important">
                <i class="fa fa-building" style="color:#db0c13;"></i>
                <?=$detail_product->member?>
              </a>
            </h2>

            <h1 class="product-name">
              <?=$detail_product->nama_product?>
            </h1>

            <!-- <div class="product-rating-container">
              <div class="product-ratings">
                <div class="ratings-box">
                  <div class="rating" style="width:60%"></div>
                </div>
              </div>

              <div class="review-link">
                <a href="#" class="review-link-in" rel="nofollow"> <span class="count">1</span> customer review</a> |
                <a href="#" class="write-review-link" rel="nofollow">Add a review</a>
              </div>
            </div> -->

            <!-- <div class="product-short-desc">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div> -->

            <div class="product-detail-info">
              <div class="product-price-box">
                <!-- <span class="old-price">$99.00</span> -->
                <span class="product-price">
                  Rp <?=rupiah($detail_product->harga_product)?>
                </span>
              </div>
              <p class="availability">
                <span class="font-weight-semibold">Berat : </span>
                <?=$detail_product->berat_product?> Kg
              </p>
              <p class="availability">
                <span class="font-weight-semibold">Ketersediaan : </span>
                <?=$detail_product->jumlah_product?>
              </p>
              <!-- <p class="email-to-friend"><a href="#">Email to a Friend</a></p> -->
            </div>

            <div class="product-actions">

              <div class="product-detail-qty">
                <input type="number" required value="1" class="qty-input" id="productvqty" onkeypress="return event.charCode >= 48 && event.charCode <=57" style="width:55px!important;border-radius:4px;">
              </div>

              <!-- <a href="#" class="addtocart" title="Add to Cart">
                <i class="fa fa-shopping-cart"></i>
                <span>Tambah Keranjang</span>
              </a> -->

              <?php
                if (!empty($id_member)) {
              ?>

              <button type="button" name="button" id="addKeranjang" class="addtocart" style="border-radius:5px;height:40px;" datasisa="<?=$detail_product->jumlah_product - $detail_product->jumlah_terjual?>" dataid="<?=$detail_product->id?>">
                <i class="fa fa-shopping-cart"></i>
                <span>Tambah Keranjang</span>
              </button>

              <?php }else { ?>

              <button type="button" id="login-btn" data-toggle="modal" data-target="#myModal" href="#" class="addtocart" style="border-radius:5px;height:40px;">
                <i class="fa fa-shopping-cart"></i>
                <span>Tambah Keranjang</span>
              </button>

              <?php } ?>

              <div class="actions-right" style="padding-right:350px;">
                <a id="CopyLink" class="in-favorit" title="Bagikan" data-toggle="modal" data-target="#shareModal">
                  <i class="fa fa-share-square-o" style="padding-top:8px;font-size:16px!important;cursor:pointer"></i>
                </a>

                <!-- <a href="#" class="comparelink" title="Add to Compare">
                  <i class="glyphicon glyphicon-signal"></i>
                </a> -->
              </div>



              <!-- modal share -->
        			<div class="modal fade bs-modal" role="dialog" id="shareModal" style="padding-top:200px;">
        			  <div class="modal-dialog">
        				<div class="modal-content">

        				  <div class="modal-header" style="background: #1c2a5f; border-bottom: 1px solid #e5e5e5;">
        						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        							<b class="modal-title" style="color:#fff;"> X </b>
        						</button>
        						<h4 class="modal-title">
        							<b style="color:#fff;"> Bagikan </b>
        						</h4>
        				  </div>

        					<hr style="margin:0; padding:0;">

        				  <div class="modal-body" style="padding:0 25px 25px 25px;">

        					<div class="form-group">
        						<div class="row" style="padding-top:20px;">

                      <div class="col-xs-12">
        								<label class="control-label labeled-form" for="inputUsername" style="float:right;color:#db0c13">Copy Link</label>
        							</div>

        							<div class="col-xs-12 tooltip-wide">
        								<div class="input-group merged">
        								   <input type="text" name="inputLink" id="inputLink" value="<?=base_url()."$_SERVER[REQUEST_URI]";?>" class="form-control" readonly>

                           <span class="input-group-addon" id="copyBtnLink" title="Copy Link" style="color:#1c2a5f; cursor:pointer">
                             <i class="fa fa-clipboard fa-xs"></i>
                           </span>
        								</div>
        							</div>
        						</div>
        					</div>

        				  </div>

        				</div>
        			  </div>
        			</div>




              <div class="tabs product-tabs">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#product-detail" data-toggle="tab">Detail Product</a>
                  </li>
                  <!-- <li>
                    <a href="#product-add" data-toggle="tab">Tambahan</a>
                  </li> -->
                </ul>

                <div class="tab-content">
                  <div id="product-detail" class="tab-pane active">
                    <div class="product-desc-area">
                      <?=$detail_product->ket_product?>
                    </div>
                  </div>

                  <!-- <div id="product-add" class="tab-pane">
                    <table class="product-table">
                      <tbody>
                        <tr>
                          <td class="table-label">Color</td>
                          <td>Black</td>
                        </tr>
                        <tr>
                          <td class="table-label">Size</td>
                          <td>16mx24mx18m</td>
                        </tr>
                      </tbody>
                    </table>
                  </div> -->

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>







    <!-- <h2 class="slider-title">
      <span class="inline-title">Also Purchased</span>
      <span class="line"></span>
    </h2> -->

    <!-- <div class="owl-carousel owl-theme" data-plugin-options="{'items':4, 'margin':20, 'nav':true, 'dots': false, 'loop': false}">
      <div class="product">
        <figure class="product-image-area">
          <a href="#" title="Product Name" class="product-image">
            <img src="../img/demos/shop/products/product1.jpg" alt="Product Name">
            <img src="../img/demos/shop/products/product1-2.jpg" alt="Product Name" class="product-hover-image">
          </a>

          <a href="#" class="product-quickview">
            <i class="fa fa-share-square-o"></i>
            <span>Quick View</span>
          </a>
          <div class="product-label"><span class="discount">-10%</span></div>
          <div class="product-label"><span class="new">New</span></div>
        </figure>
        <div class="product-details-area">
          <h2 class="product-name"><a href="#" title="Product Name">Noa Sheer Blouse</a></h2>
          <div class="product-ratings">
            <div class="ratings-box">
              <div class="rating" style="width:60%"></div>
            </div>
          </div>

          <div class="product-price-box">
            <span class="old-price">$99.00</span>
            <span class="product-price">$89.00</span>
          </div>

          <div class="product-actions">
            <a href="#" class="addtowishlist" title="Add to Wishlist">
              <i class="fa fa-heart"></i>
            </a>
            <a href="#" class="addtocart" title="Add to Cart">
              <i class="fa fa-shopping-cart"></i>
              <span>Add to Cart</span>
            </a>
            <a href="#" class="comparelink" title="Add to Compare">
              <i class="glyphicon glyphicon-signal"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="product">
        <figure class="product-image-area">
          <a href="#" title="Product Name" class="product-image">
            <img src="../img/demos/shop/products/product2.jpg" alt="Product Name">
            <img src="../img/demos/shop/products/product2-2.jpg" alt="Product Name" class="product-hover-image">
          </a>

          <a href="#" class="product-quickview">
            <i class="fa fa-share-square-o"></i>
            <span>Quick View</span>
          </a>
          <div class="product-label"><span class="discount">-25%</span></div>
        </figure>
        <div class="product-details-area">
          <h2 class="product-name"><a href="#" title="Product Name">Women Fashion Blouse</a></h2>
          <div class="product-ratings">
            <div class="ratings-box">
              <div class="rating" style="width:0%"></div>
            </div>
          </div>

          <div class="product-price-box">
            <span class="old-price">$120.00</span>
            <span class="product-price">$90.00</span>
          </div>

          <div class="product-actions">
            <a href="#" class="addtowishlist" title="Add to Wishlist">
              <i class="fa fa-heart"></i>
            </a>
            <a href="#" class="addtocart" title="Add to Cart">
              <i class="fa fa-shopping-cart"></i>
              <span>Add to Cart</span>
            </a>
            <a href="#" class="comparelink" title="Add to Compare">
              <i class="glyphicon glyphicon-signal"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="product">
        <figure class="product-image-area">
          <a href="#" title="Product Name" class="product-image">
            <img src="../img/demos/shop/products/product3.jpg" alt="Product Name">
          </a>

          <a href="#" class="product-quickview">
            <i class="fa fa-share-square-o"></i>
            <span>Quick View</span>
          </a>
        </figure>
        <div class="product-details-area">
          <h2 class="product-name"><a href="#" title="Product Name">Fashion Dress</a></h2>
          <div class="product-ratings">
            <div class="ratings-box">
              <div class="rating" style="width:60%"></div>
            </div>
          </div>

          <div class="product-price-box">
            <span class="product-price">$70.00</span>
          </div>

          <div class="product-actions">
            <a href="#" class="addtowishlist" title="Add to Wishlist">
              <i class="fa fa-heart"></i>
            </a>
            <a href="#" class="addtocart" title="Add to Cart">
              <i class="fa fa-shopping-cart"></i>
              <span>Add to Cart</span>
            </a>
            <a href="#" class="comparelink" title="Add to Compare">
              <i class="glyphicon glyphicon-signal"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="product">
        <figure class="product-image-area">
          <a href="#" title="Product Name" class="product-image">
            <img src="../img/demos/shop/products/product4.jpg" alt="Product Name">
          </a>

          <a href="#" class="product-quickview">
            <i class="fa fa-share-square-o"></i>
            <span>Quick View</span>
          </a>
          <div class="product-label"><span class="discount">-20%</span></div>
        </figure>
        <div class="product-details-area">
          <h2 class="product-name"><a href="#" title="Product Name">Fashion Sweater</a></h2>
          <div class="product-ratings">
            <div class="ratings-box">
              <div class="rating" style="width:80%"></div>
            </div>
          </div>

          <div class="product-price-box">
            <span class="old-price">$100.00</span>
            <span class="product-price">$90.00</span>
          </div>

          <div class="product-actions">
            <a href="#" class="addtowishlist" title="Add to Wishlist">
              <i class="fa fa-heart"></i>
            </a>
            <a href="#" class="addtocart" title="Add to Cart">
              <i class="fa fa-shopping-cart"></i>
              <span>Add to Cart</span>
            </a>
            <a href="#" class="comparelink" title="Add to Compare">
              <i class="glyphicon glyphicon-signal"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="product">
        <figure class="product-image-area">
          <a href="#" title="Product Name" class="product-image">
            <img src="../img/demos/shop/products/product11.jpg" alt="Product Name">
          </a>

          <a href="#" class="product-quickview">
            <i class="fa fa-share-square-o"></i>
            <span>Quick View</span>
          </a>
        </figure>
        <div class="product-details-area">
          <h2 class="product-name"><a href="#" title="Product Name">Woman Shee Blouse</a></h2>
          <div class="product-ratings">
            <div class="ratings-box">
              <div class="rating" style="width:0%"></div>
            </div>
          </div>

          <div class="product-price-box">
            <span class="product-price">$70.00</span>
          </div>

          <div class="product-actions">
            <a href="#" class="addtowishlist" title="Add to Wishlist">
              <i class="fa fa-heart"></i>
            </a>
            <a href="#" class="addtocart" title="Add to Cart">
              <i class="fa fa-shopping-cart"></i>
              <span>Add to Cart</span>
            </a>
            <a href="#" class="comparelink" title="Add to Compare">
              <i class="glyphicon glyphicon-signal"></i>
            </a>
          </div>
        </div>
      </div>
    </div> -->
  </div>

</div>

<script src="<?=base_url('assets/js/sweetalert.js')?>"></script>
<script type="text/javascript">

  var baseUrl = '<?=base_url()?>';

  const copyBtn = document.getElementById('copyBtnLink')
  const copyText = document.getElementById('inputLink')

  copyBtn.onclick = () => {
    copyText.select();    // Selects the text inside the input
    document.execCommand('copy');    // Simply copies the selected text to clipboard
    Swal.fire({         //displays a pop up with sweetalert
      icon: 'success',
      title: 'Link berhasil di salin ke clipboard',
      showConfirmButton: false,
      timer: 1500
    });
  }

  $(document).ready(function () {

    // dataval  = ($("#productvqty").val());


    $("#addKeranjang").click(function(){
      nol      = parseInt(0);
      satu     = parseInt(1);
      dataid   = $(this).attr('dataid');
      dataval  = ($("#productvqty").val());
      datasisa = parseInt($(this).attr('datasisa'));
      // alert(dataid);

      if (dataval > datasisa) {
        var postVal = datasisa;
        var notiV = alert('Maks. beli '+datasisa+' barang');
      }else if (dataval == 0 || dataval == '') {
        var postVal = satu;
        var notiV = alert('Jumlah barang harus diisi');
      }else {
        var postVal = dataval;
        var notiV = alert('Produk berhasil ditambahkan ke keranjang');

        var toUrl = "buyer/tambah_keranjang/"+dataid+"/"+postVal;
        var urlTarget = baseUrl+toUrl;

        $.ajax({
          type: 'POST',
          url: urlTarget,
          // data: data,
          success: function() {
            // notiV;
            location.reload();
            // $('#dataKeranjang').ajax.reload();
          }
        });
        return false;
      }

    });

  });

</script>

<script src="<?php echo base_url() ?>assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>

<script src="<?php echo base_url() ?>assets/vendor/elevatezoom/jquery.elevatezoom.js"></script>

<!-- <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-581b726c069c6315"></script> -->
