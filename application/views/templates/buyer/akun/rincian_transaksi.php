
<style>
  .table_tb {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
  }

  .table_tb th, .table_tb td {
    text-align: left;
    padding: 8px;
  }

  .table_tb tr:nth-child(even){background-color: #f2f2f2}

  .textcopy{
    border:none;
    background:transparent;
  }

  .textcopy::selection, .textcopy:focus{
    outline: none;
  }



  @media (max-width: 992px) {
    .container-product{
      padding-top: 145px;
    }
  }
  @media (min-width: 992px) {
    .container-product{
      padding-top: 20px;
    }
  }
</style>
<script src="<?=base_url('assets/js/sweetalert.js')?>"></script>

<!-- <div id="mobile-menu-overlay"></div> -->

<div role="main" class="main" style="padding-top:10px;">

<!-- <section class="page-header">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="#">Home</a></li>

      <li class="active">My Account</li>
    </ul>
  </div>
</section> -->

  <div class="container container-product">
    <div class="row">

      <div class="col-md-12 my-account form-section">

        <h1 class="h2 heading-primary font-weight-normal">Transaksi Saya</h1>

        <div class="featured-box featured-box-primary featured-box-flat featured-box-text-left mt-md">
          <!-- <div class="box-content"> -->

            <!-- MAINTENANCE -->

            <div class="tabs product-tabs">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#trans-belum" data-toggle="tab">Belum Bayar</a>
                </li>

                <li>
                  <a href="#trans-kemas" data-toggle="tab">Dikemas</a>
                </li>

                <li>
                  <a href="#trans-kirim" data-toggle="tab">Dikirim</a>
                </li>

                <li>
                  <a href="#trans-selesai" data-toggle="tab">Selesai</a>
                </li>
              </ul>

              <div class="tab-content">

                <div id="trans-belum" class="tab-pane active">
                  <div class="row">
    								<div class="col-xs-12">
    									<div class="panel-box">
    										<div class="panel-box-title">
    											<h3>
                            <?=count($trans_belum) == 0 ? '<font style="color:#db0c13;">Belum Ada Pesanan</font>':'Belum Bayar' ?>
                          </h3>
    										</div>

                        <?php
                          foreach ($trans_belum as $key1 => $belum) {
                        ?>
    										<div class="panel-box-content">
    											<div class="row">
    												<div class="col-sm-12">
    													<address>
                                <font style="font-size:10px;">Jumlah pemesanan <?=$belum->jumlah_product ?></font>
                                <h5 style="color:#1c2a5f"><?=$belum->nama_product ?></h5>

                                <b style="font-size:10px;color:#db0c13;">Silahkan Lakukan pembayaran ke nomor berikut :</b> <br>

                                <?=$belum->nmrek_tujuan ?> <br>
                                <input type="text" id="copyVaTxt<?=$key1?>" name="copyvatxt" style="width:130px;" class="textcopy" value="<?=$belum->norek_tujuan ?>" readonly>
                                <button id="copyVaBtn<?=$key1?>" style="border:none;background:transparent;font-size:10px;color:#1c2a5f;" title="Copy Virtual Account">
                                  <i class="fa fa-clipboard"></i>
                                </button>
                                <br><br>

                                <b style="font-size:10px;color:#db0c13;">Jumlah yg harus dibayarkan</b> <br>
                                Rp. <input type="text" id="copyRpTxt<?=$key1?>" name="copyrptxt" style="width:70px;" class="textcopy" value="<?=rupiah($belum->total_transaksi) ?>" readonly>
                                <button id="copyRpBtn<?=$key1?>" style="border:none;background:transparent;font-size:10px;color:#1c2a5f;" title="Copy jumlah pembayaran">
                                  <i class="fa fa-clipboard"></i>
                                </button>
                                <br><br>

                                <?php
                                  if (count($trans_belum) > 0) {
                                    echo '<a href="#'.$belum->id.'" style="font-weight:bold;color:#1c2a5f;" >Rincian Pesanan</a>';
                                  }
                                ?>

    													</address>
    												</div>
    											</div>
    										</div>

                        <script>
                          const copyVaBtn<?=$key1?> = document.getElementById('copyVaBtn<?=$key1?>')
                          const copyVaTxt<?=$key1?> = document.getElementById('copyVaTxt<?=$key1?>')

                          copyVaBtn<?=$key1?>.onclick = () => {
                            copyVaTxt<?=$key1?>.select();    // Selects the text inside the input
                            document.execCommand('copy');    // Simply copies the selected text to clipboard
                            Swal.fire({         //displays a pop up with sweetalert
                              icon: 'success',
                              title: 'Virtual Account berhasil di copy',
                              showConfirmButton: false,
                              timer: 1000
                            });
                          }

                          const copyRpBtn<?=$key1?> = document.getElementById('copyRpBtn<?=$key1?>')
                          const copyRpText<?=$key1?> = document.getElementById('copyRpTxt<?=$key1?>')

                          copyRpBtn<?=$key1?>.onclick = () => {
                            copyRpText<?=$key1?>.select();    // Selects the text inside the input
                            document.execCommand('copy');    // Simply copies the selected text to clipboard
                            Swal.fire({         //displays a pop up with sweetalert
                              icon: 'success',
                              title: 'Nominal berhasil di copy',
                              showConfirmButton: false,
                              timer: 1000
                            });
                          }
                        </script>

                        <?php } ?>

    									</div>
    								</div>
    							</div>
                </div>

                <div id="trans-kemas" class="tab-pane">
                  <div class="row">
    								<div class="col-xs-12">
    									<div class="panel-box">
    										<div class="panel-box-title">
                          <h3><?=count($trans_dikemas) == 0 ? '<font style="color:red;">Belum Ada Pesanan</font>':'Dikemas' ?></h3>
    										</div>

                        <?php
                          foreach ($trans_dikemas as $key2 => $kemas) {
                        ?>
    										<div class="panel-box-content">
    											<div class="row">
    												<div class="col-sm-12">
    													<address>
                                <?=$kemas->nama_product ?>
    													</address>
    												</div>
    											</div>
    										</div>
                        <?php } ?>

    									</div>
    								</div>
    							</div>
                </div>

                <div id="trans-kirim" class="tab-pane">
                  <div class="row">
    								<div class="col-xs-12">
    									<div class="panel-box">
    										<div class="panel-box-title">
                          <h3><?=count($trans_dikirim) == 0 ? '<font style="color:red;">Belum Ada Pesanan</font>':'Dikirim' ?></h3>
    										</div>

                        <?php
                          foreach ($trans_dikirim as $key3 => $kirim) {
                        ?>
    										<div class="panel-box-content">
    											<div class="row">
    												<div class="col-sm-12">
    													<address>
                                <?=$kirim->nama_product ?>
    													</address>
    												</div>
    											</div>
    										</div>
                        <?php } ?>

    									</div>
    								</div>
    							</div>
                </div>

                <div id="trans-selesai" class="tab-pane">
                  <div class="row">
    								<div class="col-xs-12">
    									<div class="panel-box">
    										<div class="panel-box-title">
                          <h3><?=count($trans_selesai) == 0 ? '<font style="color:red;">Belum Ada Pesanan</font>':'Selesai' ?></h3>
    										</div>

                        <?php
                          foreach ($trans_selesai as $key4 => $selesai) {
                        ?>
    										<div class="panel-box-content">
    											<div class="row">
    												<div class="col-sm-12">
    													<address>
                                <?=$selesai->nama_product ?>
    													</address>
    												</div>
    											</div>
    										</div>
                        <?php } ?>

    									</div>
    								</div>
    							</div>
                </div>

              </div>
            </div>


          <!-- </div> -->
        </div>

      </div>

      <!-- xxx -->

    </div>
  </div>

</div>
