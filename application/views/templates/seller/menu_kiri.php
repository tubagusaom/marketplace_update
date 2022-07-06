<style media="screen">
  .sidebar-logo-tb{
    display: block;
    margin: 30px 0px 20px 20px;
  }
  .highlight-blue .menu-homedepo .sidebar-logo a {
    background-image: url('<?=base_url() ?>assets/img/logo.jpg');
    background-repeat: no-repeat;
    background-size: 60px 53px;
    height: 70px;
  }
</style>

<div class="menu-scroll">
    <div class="sidebar-icons">
        <a href="#" class="close-menu" style="float:right"><i class="fa-fw fa fa-times"></i></a>
    </div>

    <div class="bg-white">
      <div class="sidebar-logo top-0 bottom-0" style="padding-top:15px;">
        <a href="<?=base_url()?>"></a>
        <!-- <em style="color:#fff;"><?=$aplikasi->singkatan_unit ?></em> -->
      </div>
    </div>

    <div class="sidebar-divider"></div>

    <div class="menu-items menu-icons bottom-500">
        <!-- <a href="<?=base_url() ?>home"><i class="fa fa-home"></i>Beranda</a>

        <a href="<?php echo base_url() ?>st_asesor_kompetensi/index_asesor">
          <i class="fa fa-user"></i>Profil
        </a> -->

        <a href="#" data-submenu="submenu-product" class="submenu-has-numbers <?= $this->uri->segment(1) == 'product' ? 'menu-item-active' : '' ?>">
          <i class="fa fa-object-group"></i>Produk
        </a>
          <div class="submenu" id="submenu-product">

            <a href="<?php echo base_url() ?>product/data" class="<?= $this->uri->segment(1) == 'product' && $this->uri->segment(2) == 'data' ? 'menu-item-active' : '' ?>">
              Data Produk
            </a>

            <a href="<?php echo base_url() ?>product/tambah" class="<?= $this->uri->segment(1) == 'product' && $this->uri->segment(2) == 'tambah' ? 'menu-item-active' : '' ?>">
              Tambah Produk
            </a>

            <a href="<?php echo base_url() ?>product/tambah_product" class="<?= $this->uri->segment(1) == 'product' && $this->uri->segment(2) == 'tambah_product' ? 'menu-item-active' : '' ?>">
              Tambah Banyak Produk
            </a>
          </div>

        <a href="#" data-submenu="submenu-kurir" class="submenu-has-numbers <?= $this->uri->segment(1) == 'voucher' ? 'menu-item-active' : '' ?>">
          <i class="fa fa-sticky-note"></i>Kurir
        </a>
          <div class="submenu" id="submenu-kurir">
            <!-- <a href="<?php echo base_url() ?>kurir/tambah" class="<?= $this->uri->segment(1) == 'kurir' && $this->uri->segment(2) == 'tambah' ? 'menu-item-active' : '' ?>">Tambah Kurir</a> -->
            <a href="<?php echo base_url() ?>kurir/data" class="<?= $this->uri->segment(1) == 'kurir' && $this->uri->segment(2) == 'data' ? 'menu-item-active' : '' ?>">
              Data Kurir
            </a>
          </div>

        <!-- <a href="#" data-submenu="submenu-voucher" class="submenu-has-numbers <?= $this->uri->segment(1) == 'voucher' ? 'menu-item-active' : '' ?>">
          <i class="fa fa-sticky-note"></i>voucher
        </a>
        <div class="submenu" id="submenu-voucher">
          <a href="<?php echo base_url() ?>voucher/tambah" class="<?= $this->uri->segment(1) == 'voucher' && $this->uri->segment(2) == 'tambah' ? 'menu-item-active' : '' ?>">Tambah Voucher</a>
          <a href="<?php echo base_url() ?>voucher/data" class="<?= $this->uri->segment(1) == 'voucher' && $this->uri->segment(2) == 'data' ? 'menu-item-active' : '' ?>">Data Voucher</a>
        </div> -->

        <a href="https://www.homedepo.co.id" target="blank"><i class="fas fa-book"></i>Tentang Kami</a>

    </div>

    <p class="sidebar-copyright">Copyright <span class="copyright-year"></span> <?= $aplikasi->singkatan_unit ?>. Develop By <a href="https://www.instagram.com/tera.bytee/" target="_blank">tera.bytee</a></p>
</div>
