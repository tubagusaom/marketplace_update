
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

  #copyUsername{
    border:none;
    background:transparent;
  }

  #copyUsername::selection, #copyUsername:focus{
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
    <div class="">

      <div class="col-md-12 my-account form-section">

        <h1 class="h2 heading-primary font-weight-normal">Biodata Saya</h1>

        <div class="featured-box featured-box-primary featured-box-flat featured-box-text-left mt-md">
          <!-- <div class="box-content"> -->

            <!-- MAINTENANCE -->

            <div class="tabs product-tabs">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#biodata-detail" data-toggle="tab">Biodata</a>
                </li>

                <li>
                  <a href="#akun-alamat" data-toggle="tab">Alamat</a>
                </li>
              </ul>

              <div class="tab-content">
                <div id="biodata-detail" class="tab-pane active">
                  <div class="product-desc-area">
                    <div style="overflow-x:auto;">
                      <table class="table_tb table-responsive">

                        <tr>
                          <td>Name</td>
                          <td><?=$buyer->nm_buyer ?></td>
                        </tr>

                        <tr>
                          <td>Username</td>
                          <td>
                            <input type="text" value="<?=$buyer->akun ?>" id="copyUsername" readonly>
                            <button id="copyBtn" style="border:none;background:transparent;font-size:10px;" title="Copy Username">
                              <i class="fa fa-clipboard"></i>
                            </button>
                          </td>
                        </tr>

                        <tr>
                          <td>Jenis Kelamin</td>
                          <td>
                            <?php
                              $jk = $buyer->klamin_buyer;

                              if ($jk == 1) {
                                echo "Pria &nbsp; <i class='fa fa-mars' style='color:#1f39ca; font-size:12px; font-weight: bold;'></i>";
                              }elseif ($jk == 2) {
                                echo "Perempuan <i class='fa fa-venus' style='color:#d94398; font-size:12px; font-weight: bold;'></i>";
                              }else {
                                echo "Lainnya";
                              }
                            ?>
                          </td>
                        </tr>

                        <tr>
                          <td>Handphone</td>
                          <td><?=$buyer->hp_buyer ?></td>
                        </tr>

                        <tr>
                          <td>Email</td>
                          <td><?=$buyer->email_buyer ?></td>
                        </tr>

                        <tr>
                          <td>Tanggal Lahir</td>
                          <td><?= tgl_indo($buyer->tgl_lahir_buyer) ?></td>
                        </tr>

                      </table>
                    </div>
                  </div>
                </div>

                <div id="akun-alamat" class="tab-pane">

                  <?php
                    foreach ($buyer_alamat as $key => $alamat) {
                  ?>

                  <div class="row">
    								<div class="col-xs-12">
    									<div class="panel-box">
    										<div class="panel-box-title">
    											<h3><?=strtoupper($alamat->nm_penerima) ?> <font style="font-size:10px;"> [<?=$alamat->label_alamat ?>] </font></h3>

                            <?php
                              $jenis_alamat = $alamat->jenis_alamat;

                              if ($jenis_alamat == 1) {
                                echo '<b class="panel-box-edit" style="background:green;color:#fff;padding:3px;border-radius:4px;">UTAMA</b>';
                              }
                            ?>

    										</div>

    										<div class="panel-box-content">
    											<div class="row">
    												<div class="col-sm-12">
    													<address>
                                <?=$alamat->tlp_penerima ?> <br>
                                <?=$alamat->alamat_buyer ?> <br>
                                <?=$alamat->province_name ?> ,
                                <?=$alamat->city_name ?> ,
                                <?=$alamat->kode_pos ?> <br><br>

                                <a href="#<?=$alamat->id ?>">Ubah Alamat</a>
    													</address>
    												</div>
    											</div>
    										</div>
    									</div>
    								</div>
    							</div>

                  <?php } ?>

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



    <script src="<?=base_url('assets/js/sweetalert.js')?>"></script>
    <script>
      const copyBtn = document.getElementById('copyBtn')
      const copyText = document.getElementById('copyUsername')

      copyBtn.onclick = () => {
        copyText.select();    // Selects the text inside the input
        document.execCommand('copy');    // Simply copies the selected text to clipboard
        Swal.fire({         //displays a pop up with sweetalert
          icon: 'success',
          title: 'Username berhasil di copy',
          showConfirmButton: false,
          timer: 1000
        });
      }
    </script>
