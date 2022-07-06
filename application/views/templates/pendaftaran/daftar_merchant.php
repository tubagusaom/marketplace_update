<!-- select2 -->
<link href="<?=base_url();?>assets/plugins/select2-4.0.3/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

<div role="main" class="main">

<section class="form-section register-form">
  <div class="container">
    <h1 class="h2 heading-primary font-weight-normal mb-md mt-xlg">DAFTAR MERCHANT</h1>

    <div class="featured-box featured-box-primary featured-box-flat featured-box-text-left mt-md">
      <div class="box-content">
        <form action="<?=base_url()?>welcome/save_pendaftaran" method="post">

          <h4 class="heading-primary text-uppercase mb-lg">
            <b style="color:#1c2a5f!important;">INFORMASI MERCHANT</b>
          </h4>
          <div class="row">

            <div class="col-sm-4 col-md-12">
              <!-- <div class="form-group"> -->
                <!-- <label class="font-weight-normal">Nama <span class="required">*</span></label> -->
                <!-- <input type="text" name="nm_buyer" class="form-control" required> -->

                <input type="checkbox" name="" value=""> Perorangan
                &nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="" value=""> Badan Usaha
              <!-- </div> -->
            </div>

            <div class="col-sm-4 col-md-12">&nbsp;</div>

            <div class="col-sm-4 col-md-12">
              <!-- <div class="form-group"> -->
                <!-- <label class="font-weight-normal">Nama <span class="required">*</span></label> -->
                <!-- <input type="text" name="nm_buyer" class="form-control" required> -->

                <input type="checkbox" name="" value=""> PKP
                &nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="" value=""> NON PKP
              <!-- </div> -->
            </div>

            <div class="col-sm-4 col-md-12">&nbsp;</div>

            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">Nama Perusahaan <font style="font-size:11px;">(Nama Toko)<font><span class="required">*</span></label>
                <input type="text" name="nm_buyer" class="form-control" required>
              </div>
            </div>

            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">Alamat Perusahaan <font style="font-size:11px;">(Alamat Toko)<font><span class="required">*</span></label>
                <textarea class="form-control" name="alamat_buyer" rows="4"></textarea>
              </div>
            </div>

            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">Provinsi<span class="required">*</span></label>
                <select id="id_provinsi" class="form-control select2" name="id_provinsi" required>
                  <option value="">Pilih Provinsi</option>

                  <?php foreach ($provinsi as $key => $value) { ?>

                  <option value="<?=$value->province_id?>"><?=$value->province_name?></option>

                  <?php } ?>

                </select>
              </div>
            </div>

            <div id="div_kabupaten" class="">
              <div class="col-sm-4 col-md-12">
                <div class="form-group">
                  <label class="font-weight-normal">Kabupaten/Kota<span class="required">*</span></label>
                  <select id="id_kabupaten" class="form-control select2" name="id_kabupaten">
                    <option value="">Pilih Kabupaten</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">NPWP <span class="required">*</span></label>
                <input type="text" name="hp_buyer" class="form-control" required>
              </div>
            </div>

            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">No Tlp Perusahaan <font style="font-size:11px;">(no telepon toko)<font> <span class="required">*</span></label>
                <input type="text" name="hp_buyer" class="form-control" required>
              </div>
            </div>

            <div class="col-sm-4 col-md-12">
              <div class="form-group">
                <label class="font-weight-normal">Alamat Warehouse <span class="required">*</span></label>
                <textarea class="form-control" name="alamat_buyer" rows="4"></textarea>
              </div>
            </div>

          </div>

          <h4 class="heading-primary text-uppercase mb-lg">
            <b style="color:#1c2a5f!important;"> INFORMASI BANK </b>
          </h4>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Nama Bank <span class="required">*</span></label>
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
                <label class="font-weight-normal">No Rekening <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="text" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Nama Pemilik <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="text" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Cabang <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="text" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <h4 class="heading-primary text-uppercase mb-lg">
            <b style="color:#1c2a5f!important;"> INFORMASI BAGIAN KEUANGAN </b>
          </h4>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Nama PIC <span class="required">*</span></label>
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
                <label class="font-weight-normal">Jabatan PIC <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="text" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">HP PIC <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="text" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">Email PIC <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="text" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <h4 class="heading-primary text-uppercase mb-lg">
            <b style="color:#1c2a5f!important;">PERSYARATAN DOKUMEN</b>
          </h4>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">KTP <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="file" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">NPWP <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="file" name="kode_pos" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div>
                <label class="font-weight-normal">NIB <span class="required">*</span></label>
              </div>
            </div>
            <div class="col-sm-6 col-md-12">
              <div class="form-group">
                <input type="file" name="kode_pos" class="form-control" required>
              </div>
            </div>
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
