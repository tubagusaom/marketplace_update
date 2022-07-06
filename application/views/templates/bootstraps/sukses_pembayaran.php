<div role="main" class="main">

      <!-- <section class="page-header">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Pendaftaran</li>
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h1>Pendafaran Buyer</h1>
            </div>
          </div>
        </div>
      </section> -->

      <div class="banners-container">
        <div class="container">
          <div class="row">

            <!-- <div class="alert alert-success" role="alert">
              <b> Pendaftaran Berhasil. silahkan <a href="#" id="login-btn" data-toggle="modal" data-target="#myModal" class="">login</a> menggunakan email yg didaftarkan sebagai username dan password yg anda tentukan. </b>
            </div> -->

            <div class="col-md-12">
              <?php if($this->session->flashdata('result')!=''){ ?>

                <div class="alert alert-<?=$this->session->flashdata('mode_alert')?>" role="alert">
                  <?php echo $this->session->flashdata('result'); ?> <br>
                </div>

                <div class="">
                    <?php echo $this->session->flashdata('text_result'); ?>
                </div>

                <div class="">
                  <?php echo $this->session->flashdata('count_result'); ?>
                </div>

              <?php } ?>
            </div>

          </div>
        </div>
      </div>

</div>
