<style media="screen">
  @media only screen and (max-width: 699px) {
    #hp {
      display: block;
    }

    #pc {
      display: none;
    }
  }

  @media only screen and (min-width: 700px) {
    #hp {
      display: none;
    }

    #pc {
      display: block;
    }
  }

  .jumlah-angka{
    float: right;
    margin: 10px;
    padding: 0 2px 0 2px !important;
    border-radius: 10px;
    /* background: #1c2a5f; */
    background: #db0c13;
    border: 1px solid #db0c13;
    color:#fff;
  }

</style>



    <div class="decoration decoration-margins"></div>

    <!-- <a href="#"> -->
      <!-- <div class="content content-boxed content-boxed-padding content-margins pricing-tb bottom-50" style="max-width:1170px!important;">
    		<div class="above-overlay">
          <h1 class="pricing-title center-text bg-blue-dark uppercase bolder bottom-10" style="background:rgb(28, 42, 96)!important">
            Selamat Datang <?= $nama_user ?>
          </h1>
          <p class="center-text color-white bottom-5 opacity-90" style="font-weight: bold;">

            Anda Login Sebagai Merchant
            <?=$aplikasi->singkatan_unit?>
          </p>
    		</div>
    		<div class="overlay bg-blue-dark opacity-90" style="background:#db0c13!important"></div>
    	</div> -->
    <!-- </a> -->

    <div class="decoration decoration-margins"></div>

    <div class="content-full">
			<h4 class="uppercase ultrabold top-30 bottom-10 center-text"><i class="fa fa-bookmark icon-clear-right color-homedepo"></i>Aktivitas hari ini</h4>
			<p class="center-text bottom-30">
				Aktivitas yang perlu kamu pantau untuk jaga kepuasan pembeli.
			</p>
			<div class="store-categories bottom-30">

				<!-- <a href="<?=base_url()?>my_shop/new_order_"> -->
        <a href="<?=base_url()?>">
          <div class="jumlah-angka">0</div>
          <i class="fa fa-mobile color-fa-homedepo fa-2x"></i><em>Pesanan Baru</em>
        </a>

				<!-- <a href="<?=base_url()?>my_shop/send_order_"> -->
        <a href="<?=base_url()?>">
          <i class="fa fa-truck color-fa-homedepo fa-2x"></i><em>Siap Dikirim</em>
        </a>

        <!-- <a href="<?=base_url()?>my_shop/order_completed_"> -->
        <a href="<?=base_url()?>">
          <i class="fa fa-shopping-cart color-fa-homedepo font-19"></i><em>Pesanan Selesai </em>
        </a>

				<!-- <a href="<?=base_url()?>my_shop/order_discussion_"> -->
        <a href="<?=base_url()?>">
          <i class="fa fa-desktop color-fa-homedepo font-18"></i><em>Diskusi Baru</em>
        </a>

				<!-- <a href="<?=base_url()?>my_shop/order_complaint_"> -->
        <a href="<?=base_url()?>">
          <i class="fa fa-laptop color-fa-homedepo font-20"></i><em>Komplainan</em>
        </a>

        <!-- <a href="<?=base_url()?>my_shop/balance_"> -->
        <a href="<?=base_url()?>">
          <i class="fa fa-money color-fa-homedepo font-19"></i><em>Saldo </em>
        </a>

				<!-- <a href="<?=base_url()?>"><i class="fa fa-tv color-fa-homedepo font-19"></i><em>TV Sets</em></a>
				<a href="<?=base_url()?>"><i class="fa fa-battery-full color-fa-homedepo font-20"></i><em>Batteries</em></a>
				<a href="<?=base_url()?>"><i class="fa fa-suitcase color-fa-homedepo font-15"></i><em>Accessories</em></a>
				<a href="<?=base_url()?>"><i class="fa fa-tablet color-fa-homedepo font-18"></i><em>Free Shipping</em></a> -->

				<div class="decoration"></div>
				<div class="clear"></div>
			</div>
		</div>

    <!-- <div id="pc" class="content" style="background:#fff;padding:50px 15px 30px 15px;">

      <div class="content">
        <div class="one-third">
  				<a href="<?=base_url().'pra_asesmen/index_asesor'?>" class="button button-full button-rounded button uppercase ultrabold" style="background:#3bb8e3!important">
            <i class="fa fa-edit"></i> Pra Asesmens
          </a>
  			</div>
  			<div class="one-third">
  				<a href="<?=base_url().'penilaian_asesor/index_asesor'?>" class="button button-full button-rounded button uppercase ultrabold" style="background:#3eadd2!important">
            <i class="fa fa-edit"></i> Rekomendasi Asesor
          </a>
  			</div>
  			<div class="one-third last-column">
  				<a href="<?=base_url() ?>portofolio" class="button button-full button-rounded button uppercase ultrabold" style="background:#1a8fb7!important">
            <i class="fa fa-edit"></i> Cek Portofolio
          </a>
  			</div>

      </div>

      <div class="decoration decoration-margins"></div>

      <div class="content">
  			<a href="<?=base_url() ?>st_asesor_kompetensi/index_asesor" class="button button-full button-rounded button uppercase ultrabold" style="background:#73d13a!important">
          <i class="fa fa-file-pdf"></i> Surat Tugas
        </a>
  			<div class="decoration"></div>
  		</div>
    </div> -->

    <!-- <div id="hp" class="content content-boxed " style="background:whitesmoke;padding:50px 15px 30px 15px;">

      <div class="content">

        <a href="<?=base_url().'pra_asesmen/index_asesor'?>" class="button button-full button-rounded button uppercase ultrabold" style="background:#3bb8e3!important">
          Pra Asesmen
        </a>

        <a href="<?=base_url().'penilaian_asesor/index_asesor'?>" class="button button-full button-rounded button uppercase ultrabold" style="background:#3eadd2!important">
          Rekomendasi Asesor
        </a>

        <a href="<?=base_url() ?>portofolio" class="button button-full button-rounded button uppercase ultrabold" style="background:#1a8fb7!important">
          Cek Portofolio
        </a>

        <a href="<?=base_url() ?>st_asesor_kompetensi/index_asesor" class="button button-full button-rounded button uppercase ultrabold" style="background:#73d13a!important">
          <i class="fa fa-file-pdf"></i> Surat Tugas
        </a>

      </div>
    </div> -->
