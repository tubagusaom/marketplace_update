
<div id="page-transitions" class="page-build highlight-red">
<div class="page-content header-clear-larger">
  <div class="content">
    <h4 class="uppercase bolder bottom-15">Pesanan Baru</h4>
    <!-- <a href="#" class="demo-settings bg-highlight" data-menu="menu-3">SEttings</a>
    <p>
      Showcase the products in your cart on separete page, available in 2 versions.
    </p> -->
  </div>
  <div class="decoration decoration-margins"></div>

  <div class="content">

    <?php
      foreach ($pesanan_baru as $key => $value_pb) {
    ?>

    <div class="store-cart-2">

      <img src="<?=base_url()?>assets_mobile/images/placeholders/5b.jpg" data-src="<?=base_url()?>assets_mobile/images/placeholders/5b.jpg" alt="img">

      <!-- <div class="preload-image"> -->
        <!-- 1. -->
      <!-- </div> -->
      <!-- <strong> -->
        <a href="javascript:void(0)" data-accordion="ord-detail-<?=$key?>" style="color:#000;font-size:13px;font-weight:bold;">
           ( Qty <?=$value_pb->jumlah_product?> ) <?=$value_pb->nama_product?>
        </a>
      <!-- </strong> -->
      <!-- <span>Free Shipping December</span> -->
      <em>
        <a href="javascript:void(0)" data-accordion="ord-detail-<?=$key?>" class="color-highlight">
          Rincian Pesanan
        </a>
        <!-- <del> Was $500</del> -->
      </em>
      <a href="" class="" style="position:unset;">
        <font style="background-color:red;color:white;padding:3px;border-radius:3px;">
          Proses Pesanan
        </font>
      </a>
      <!-- <input type="text" placeholder="1"> -->
    </div>

    <div class="accordion-content" id="ord-detail-<?=$key?>" style="background:whitesmoke!important;padding:10px;">
      Rincian Pesanan <b> <?=$value_pb->nama_product?> </b>
      <ul class="link-list">
        <li>
          <a href="#"><i>.</i><span>Like us on Facebook</span></a>
        </li>
        <li>
          <a href="#"><i>.</i><span>Folllow us on Twitter</span></a>
        </li>
        <li>
          <a href="#"><i>.</i><span>Give us a  Plus on Google +</span></a>
        </li>
      </ul>
    </div>
    <div class="decoration"></div>

    <?php } ?>



    <!-- <a href="#" class="button bg-highlight button-rounded button-full button-sm ultrabold uppercase">Proceed to Checkout</a> -->
  </div>

  <!-- <div class="decoration decoration-margins"></div> -->

</div>
</div>
