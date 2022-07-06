<!-- select2 -->
<link href="<?=base_url();?>assets/plugins/select2-4.0.3/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

<div role="main" class="main">

<section class="form-section register-form">
  <div class="container">
    <h1 class="h2 heading-primary font-weight-normal mb-md mt-xlg">DAFTAR BUYER</h1>

    <div class="featured-box featured-box-primary featured-box-flat featured-box-text-left mt-md">
      <div class="box-content">
        <form action="<?=base_url()?>welcome/save_pendaftaran" method="post">

          <h4 class="heading-primary text-uppercase mb-lg">
            <b style="color:#1c2a5f!important;">INFORMASI PRIBADI</b>
          </h4>
          <div class="row">
            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">Nama <span class="required">*</span></label>
                <input type="text" name="nm_buyer" class="form-control" required>
              </div>
            </div>
            <div class="col-sm-4 col-md-12">
              <div class="">
                <div>
                  <label class="font-weight-normal">Jenis Kelamin <span class="required">*</span></label>
                </div>
              </div>
              <div class="">
                <div class="form-group">
                  <select id="klamin_buyer" class="form-control select2" name="klamin_buyer" required>
                    <option value="">Pilih Klamin</option>

                    <option value="1">Pria</option>
                    <option value="2">Perempuan</option>
                    <option value="0">Lainnya</option>

                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">No Tlp <span class="required">*</span></label>
                <input type="text" name="hp_buyer" class="form-control" required>
              </div>
            </div>
            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">Email <span class="required">*</span></label>
                <input type="email" name="email_buyer" class="form-control" required>
              </div>
            </div>
            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">Tgl Lahir</label>
                <input type="date" name="tgl_lahir_buyer" class="form-control">
              </div>
            </div>
          </div>

          <h4 class="heading-primary text-uppercase mb-lg">
            <b style="color:#1c2a5f!important;"> INFORMASI ALAMAT </b>
          </h4>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Label Alamat <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="text" name="label_alamat" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Alamat Lengkap <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <textarea class="form-control" name="alamat_buyer" rows="4"></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Provinsi <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <select id="id_provinsi" class="form-control select2" name="id_provinsi" required>
                  <option value="">Pilih Provinsi</option>

                  <?php foreach ($provinsi as $key => $value) { ?>

                  <option value="<?=$value->province_id?>"><?=$value->province_name?></option>

                  <?php } ?>

                </select>
              </div>
            </div>
          </div>

          <div id="div_kabupaten" class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Kabupaten/Kota <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <select id="id_kabupaten" class="form-control select2" name="id_kabupaten">
                  <option value="">Pilih Kabupaten</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Kode Pos <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="text" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <h4 class="heading-primary text-uppercase mb-lg">
            <b style="color:#1c2a5f!important;">INFORMASI LOGIN</b>
          </h4>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="font-weight-normal">Password <span class="required">*</span></label>
                <input type="password" id="pass1" name="pass1" class="form-control" required>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="font-weight-normal">
                  Konfirmasi Password <span class="required">*</span>
                </label>
                <input type="password" id="pass2" name="pass2" class="form-control" required>
              </div>
            </div>

            <!-- <div class="row col-xs-12 col-md-12">
              Lihat Password <span class="fa fa-eye" id="view_pass" title="Lihat Password" style="cursor:pointer;"></span>
              <button type="button" class="fa fa-eye" id="view_pass" title="Lihat Password" name="button">Lihat Password</button>
            </div> -->

            <div id="message" class="col-md-12"></div>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <p class="required mt-lg mb-none">* Wajib Diisi</p>

              <div class="form-action clearfix mt-none">
                <a href="<?=base_url()?>" class="pull-left"><i class="fa fa-angle-double-left"></i> Kembali</a>

                <input type="submit" id="simpanData" class="btn btn-primary" value="Simpan">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

</div>

<!-- select2 -->
<!-- <script src="<?= base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script> -->
<script src="<?= site_url(); ?>assets/plugins/select2-4.0.3/dist/js/select2.full.min.js" type="text/javascript"></script>

<script type="text/javascript">

  $("#klamin_buyer").select2({
        placeholder: "Pilih Kelamin",
        allowClear: true
  });

  $("#id_provinsi").select2({
        placeholder: "Cari Provinsi",
        allowClear: true
  });

  $("#id_kabupaten").select2({
        placeholder: "Cari Kabupaten",
        allowClear: true
  });

  $('#div_kabupaten').hide();

  $("#id_provinsi").change(function (){

    var valProv = $(this).val();
    // alert(valProv);

    if (valProv === '') {
      $('#div_kabupaten').hide();
    }else {
      var url = "<?php echo site_url('welcome/get_kota');?>/"+$(this).val();
      $('#id_kabupaten').load(url);
      $('#div_kabupaten').show();
      return false;
    }


  })


  $('#simpanData').hide();
  $('#pass1, #pass2').on('keyup', function () {
    if ($('#pass1').val() == $('#pass2').val()) {
      $('#message').html('Password Cocok').css('color', 'green');
      $('#pass1').css('border-color', '');
      $('#pass2').css('border-color', '');
      $('#simpanData').show();
    } else {
      $('#message').html('Password Tidak Cocok').css('color', 'red');
      $('#pass1').css('border-color', 'red');
      $('#pass2').css('border-color', 'red');
      $('#simpanData').hide();
    }
  });

  $(document).on('click', '#view_pass', function(e) {
       e.preventDefault();
       // var password = $("#pass1").val();
       if($("#pass1").hasClass("active")) {

          $("#pass1").attr('type', 'text');
          $("#pass1").removeClass("active");
          $("#pass2").attr('type', 'text');
          $("#pass2").removeClass("active");

       } else {

          $("#pass1").attr('type', 'password');
          $("#pass1").addClass("active");
          $("#pass2").attr('type', 'password');
          $("#pass2").addClass("active");

      }
  });

</script>
