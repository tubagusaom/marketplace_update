<div class="header-container container">
  <div class="header-row">
    <div class="header-column">
      <div class="header-logo">
        <a href="<?=base_url()?>">
          <img alt="Porto" width="76" height="51" src="<?=base_url()?>assets/img/logo_transparent.png">
        </a>
      </div>
    </div>
    <div class="header-column">
      <div class="row">
        <div class="cart-area">

          <!-- <div class="custom-block">
            <i class="fa fa-phone"></i>
            <span>+62811 1380 1802</span>
            <span class="split"></span>
            <a href="https://homedepo.co.id" target="_blank">TENTANG KAMI</a>
          </div> -->

          <div class="custom-block">
            <!-- <i class="fa fa-phone"></i> -->
            <span>
              <i class="fa fa-whatsapp">
                <a class="a-tb-wa" href="https://api.whatsapp.com/send?phone=6287814091972&text=Hai%20Homemin ,%20tolong%20bantu%20saya :)" target="_blank" title="WA">
                  +62 878-1409-1972
                </a>
              </i>
            </span>

            <span class="split"></span>

            <span>
              <i class="fa fa-whatsapp">
                <a class="a-tb-wa" href="https://api.whatsapp.com/send?phone=6281113801802&text=Hai%20Homemin ,%20tolong%20bantu%20saya :)" target="_blank" title="WA">+62811 1380 1802</a>
              </i>
            </span>

            <span class="split"></span>

            <a href="https://homedepo.co.id" target="_blank">TENTANG KAMI</a>
          </div>

          <div class="cart-dropdown">
            <a href="<?=base_url()?>buyer/keranjang" class="cart-dropdown-icon">
              <i class="minicart-icon"></i>
              <span class="cart-info" style="top:45%;">
                <span class="cart-qty">
                  <?=$total_keranjang?>
                </span>
                <!-- <span class="cart-text">item(s)</span> -->
              </span>
            </a>

            <div class="cart-dropdownmenu right">
              <div class="dropdownmenu-wrapper">
                <div class="cart-totals">
                  Lihat <span>Keranjang</span>
                </div>
              </div>
            </div>
          </div>


          <!-- favorit -->
          <!-- <div class="cart-dropdown">
            <a href="<?=base_url()?>buyer/favorit" class="cart-dropdown-icon">
              <i class="fa fa-heart" style="color:#db0c13;"></i>
              <span class="cart-info" style="top:35%;">
                <span class="cart-qty">
                  <?=count($product_favorite)?>
                </span>
                <span class="cart-text">item(s)</span>
              </span>
            </a>

            <div class="cart-dropdownmenu right">
              <div class="dropdownmenu-wrapper">
                <div class="cart-products">

                  <div class="cart-totals">
                    Lihat <span>Favorit</span>
                  </div>

                </div>
              </div>
            </div>
          </div> -->

        </div>

        <div class="header-search">
          <a href="#" class="search-toggle"><i class="fa fa-search"></i></a>
          <form action="<?=base_url()?>search/show/" method="GET">

            <div class="header-search-wrapper">

              <input type="text" class="form-control" name="q" id="Qword" placeholder="Cari..." required>
              <input type="hidden" name="rftb" value="true">
              <!-- <input type="hidden" name="srp_component_id" value=""> -->

              <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>

            </div>

          </form>
        </div>

        <!-- <div class="header-search">
          <a href="#" class="search-toggle"><i class="fa fa-search"></i></a>
          <form action="<?=base_url()?>product/filter" method="post">
            <div class="header-search-wrapper">
              <input type="text" class="form-control" name="q" id="q" placeholder="Search..." required>

              <select id="cat" name="cat" style="width:40%;">
                <option value="">All Categories</option>

                <?php
                  foreach ($kategori as $key => $dkategori) {
                ?>

                  <option value="<?=$dkategori->id?>">
                    <?=$dkategori->kategori?>
                  </option>

                  <?php
                    foreach ($sub_kategori as $key => $dsub_kategori) {
                      if ($dsub_kategori->id_kategori == $dkategori->id) {
                  ?>

                    <option value="<?=$dsub_kategori->id?>">
                      - <?=$dsub_kategori->sub_kategori?>
                    </option>

                  <?php }} ?>

                <?php } ?>
              </select>

              <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div> -->

        <a href="#" class="mmenu-toggle-btn" title="Toggle menu">
          <i class="fa fa-bars"></i>
        </a>
      </div>
    </div>
  </div>
</div>
