<div class="modal fade shop-pembayaran-modal" tabindex="-1" role="dialog" aria-labelledby="myLoginModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- <form id="formBayar" action="#"> -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
          <h4 class="modal-title" id="myLoginModal">PEMBAYARAN</h4>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label class="mb-xs">
              Metode Pembayaran
              <span class="required">
                <!-- Lihat Semua -->
                <a href="#" class="btn btn-link" data-toggle="modal" data-target=".shop-metode-modal" data-dismiss="modal">Lihat Semua</a>
              </span>
            </label>
            <div id="metodeBayar" class=""></div>
            <input type="hidden" id="metodeAtm" name="metodeatm"  required="true" value="">
            <input type="hidden" name="nm_penerima" value="<?=$alamat_utama_buyer->nm_penerima?>">
            <input type="hidden" name="tlp_penerima" value="<?=$alamat_utama_buyer->tlp_penerima?>">
            <div class="notivBayar"></div>
          </div>
        </div>

        <div class="modal-footer">
          <label class="pull-left">
            Total Bayar <br>
            <b id="j-Bayar" style="color:#db0c13">
              <!-- Rp.<?=rupiah($grand_total+$total_biaya_kirim)?> -->
            </b>
          </label>
          <!-- <input id="subBayar" type="submit" class="btn btn-primary" value="Bayar"> -->
          <button id="subBayar" type="submit" class="btn btn-primary" name="button">Bayar</button>
        </div>
      <!-- </form> -->

    </div>
  </div>
</div>

<div class="modal fade shop-metode-modal" tabindex="-1" role="dialog" aria-labelledby="myPembayaranModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-toggle="modal" data-target=".shop-pembayaran-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myPembayaranModal">Pilih Metode Pembayaran</h4>
      </div>

      <div class="modal-body">

        <p>Transfer Virtual Account</p>

        <ul class="list-group">
          <li  class="list-group-item" style="cursor:pointer;">
            <!-- <div id="" class="">
              Xendit Integrated :<b style="color:red;"> Lose Connection</b>
            </div> -->

            <div id="va-mandiri" class="" data-toggle="modal" data-target=".shop-pembayaran-modal" data-dismiss="modal" aria-label="Close">
              <img src="<?=base_url()?>assets/img/logo_bank/logo-mandiri.png" style="width:40px;" alt="homedepo mandiri va">
              <label style="padding-left:20px;cursor:pointer;">Mandiri Virtual Account</label>
            </div>
          </li>

          <li  class="list-group-item" style="cursor:pointer;">
            <div id="va-bni" class="" data-toggle="modal" data-target=".shop-pembayaran-modal" data-dismiss="modal" aria-label="Close">
              <img src="<?=base_url()?>assets/img/logo_bank/va/logo-bni-va.png" style="width:40px;" alt="homedepo bni va">
              <label style="padding-left:20px;cursor:pointer;">BNI Virtual Account</label>
            </div>
          </li>

          <li  class="list-group-item" style="cursor:pointer;">
            <div id="va-bri" class="" data-toggle="modal" data-target=".shop-pembayaran-modal" data-dismiss="modal" aria-label="Close">
              <img src="<?=base_url()?>assets/img/logo_bank/va/logo-bri-va.png" style="width:40px;" alt="homedepo bri va">
              <label style="padding-left:20px;cursor:pointer;">BRIVA</label>
            </div>
          </li>

          <li  class="list-group-item" style="cursor:pointer;">
            <div id="va-permata" class="" data-toggle="modal" data-target=".shop-pembayaran-modal" data-dismiss="modal" aria-label="Close">
              <img src="<?=base_url()?>assets/img/logo_bank/va/logo-permata-va.png" style="width:40px;" alt="homedepo Permata va">
              <label style="padding-left:20px;cursor:pointer;">Permata Virtual Account</label>
            </div>
          </li>

          <li  class="list-group-item" style="cursor:pointer;">
            <div id="va-cimb" class="">
              <img src="<?=base_url()?>assets/img/logo_bank/va/logo-cimb-va.png" style="width:40px;" alt="homedepo cimb va">
              <label style="padding-left:20px;cursor:pointer;">
                CIMB Virtual Account <font style="color:red;">( Maintenance )</font>
              </label>
            </div>
          </li>

        </ul>

        <p>Transfer Virtual Account Syariah</p>

        <ul class="list-group">
          <li class="list-group-item" style="cursor:pointer;">
            <div id="va-bsi" class="">
              <img src="<?=base_url()?>assets/img/logo_bank/va/logo-bsi-va.png" style="width:40px;" alt="homedepo bsi va">
              <label style="padding-left:20px;cursor:pointer;">
                Bank Syariah Indonesia <font style="color:red;">( Maintenance )</font>
              </label>
            </div>
          </li>
        </ul>

        <!-- <p>Transfer Bank (Verifikasi Manual)</p>

        <ul class="list-group">
          <li class="list-group-item" style="cursor:pointer;">
            <div id="manualtransfer-bca" class="" data-toggle="modal" data-target=".shop-pembayaran-modal" data-dismiss="modal" aria-label="Close">
              <img src="<?=base_url()?>assets/img/logo_bank/logo-bca.png" style="width:40px;" alt="bca">
              <label style="padding-left:20px;">BCA</label>
            </div>
          </li>
          <li class="list-group-item" style="cursor:pointer;">
            <div id="manualtransfer-mandiri" class="" data-toggle="modal" data-target=".shop-pembayaran-modal" data-dismiss="modal" aria-label="Close">
              <img src="<?=base_url()?>assets/img/logo_bank/logo-mandiri.png" style="width:40px;" alt="mandiri">
              <label style="padding-left:20px;">MANDIRI</label>
            </div>
          </li>
          <li class="list-group-item" style="cursor:pointer;">
            <div id="manualtransfer-bri" class="" data-toggle="modal" data-target=".shop-pembayaran-modal" data-dismiss="modal" aria-label="Close">
              <img src="<?=base_url()?>assets/img/logo_bank/logo-bri.png" style="width:30px;" alt="bri">
              <label style="padding-left:30px;">BRI</label>
            </div>
          </li>
        </ul> -->

        </div>

      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

  $('#formCheckout').submit(function(e){
    ma = $("#metodeAtm").val();
    notivbayar = '<a href="#" style="color:red;" data-toggle="modal" data-target=".shop-metode-modal" data-dismiss="modal">Pilih Bank</a>';

    if (ma === '0' || ma === '') {
      // alert('Pilih Bank');

      $(".notivBayar").html(notivbayar);
      return false;
    }

  });

  function check_required_inputs() {
    $('.required').each(function(){
        if( $(this).val() == "" ){
          alert('Please fill all the fields');

          return false;
        }
    });
    return true;
  }

  // MANDIRI
  // BNI
  // PERMATA
  // BRI

  $("#va-mandiri").click(function(){

    // alert('Mandiri');

    var ketmetode = "";
    ketmetode += "Silahkan lakukan pembayaran ke";
    ketmetode += "<p class='mb-0'><b>Mandiri Virtual Account</b></p>";

    ketmetode += "<p class='mb-0'>Klik <font style='color:red'> Bayar </font> untuk mendapatkan nomor Virtual Account</p>";


    $("#metodeBayar").html(ketmetode);
    $("#metodeAtm").val('MANDIRI');
    $(".notivBayar").html('');

  });

  $("#va-bni").click(function(){

    // alert('Mandiri');

    var ketmetode = "";
    ketmetode += "Silahkan lakukan pembayaran ke";
    ketmetode += "<p class='mb-0'><b>BNI Virtual Account</b></p>";

    ketmetode += "<p class='mb-0'>Klik <font style='color:red'> Bayar </font> untuk mendapatkan nomor Virtual Account</p>";


    $("#metodeBayar").html(ketmetode);
    $("#metodeAtm").val('BNI');
    $(".notivBayar").html('');

  });

  $("#va-bri").click(function(){

    // alert('Mandiri');

    var ketmetode = "";
    ketmetode += "Silahkan lakukan pembayaran ke";
    ketmetode += "<p class='mb-0'><b>BRI Virtual Account</b></p>";

    ketmetode += "<p class='mb-0'>Klik <font style='color:red'> Bayar </font> untuk mendapatkan nomor Virtual Account</p>";


    $("#metodeBayar").html(ketmetode);
    $("#metodeAtm").val('BRI');
    $(".notivBayar").html('');

  });

  $("#va-permata").click(function(){

    // alert('Mandiri');

    var ketmetode = "";
    ketmetode += "Silahkan lakukan pembayaran ke";
    ketmetode += "<p class='mb-0'><b>Permata Virtual Account</b></p>";

    ketmetode += "<p class='mb-0'>Klik <font style='color:red'> Bayar </font> untuk mendapatkan nomor Virtual Account</p>";


    $("#metodeBayar").html(ketmetode);
    $("#metodeAtm").val('PERMATA');
    $(".notivBayar").html('');

  });

  // $("#manualtransfer-bca").click(function(){
  //
  //   var ketmetode = "";
  //   ketmetode += "Silahkan lakukan pembayaran ke rekening berikut";
  //   ketmetode += "<p class='mb-0'><b>BCA : 6281188442 a/n TB AOM</b></p>";
  //
  //   ketmetode += "<table class='table' style='font-size:13px;margin-top:20px;'>";
  //
  //   ketmetode += "<tr>";
  //   ketmetode += "<th colspan='2'>Rek Pengirim</th>";
  //   ketmetode += "</tr>";
  //
  //   ketmetode += "<tr>";
  //   ketmetode += "<td>Bank</td>";
  //   ketmetode += "<td><input type='text' class='form-control' name='nmbank_pengirim' value='' required><input type='hidden' class='form-control' name='nmbank_tujuan' value='BCA'></td>";
  //   ketmetode += "</tr>";
  //
  //   ketmetode += "<tr>";
  //   ketmetode += "<td>No. Rekening</td>";
  //   ketmetode += "<td><input type='text' class='form-control' name='norek_pengirim' value='' required><input type='hidden' class='form-control' name='norek_tujuan' value='6281188442'></td>";
  //   ketmetode += "</tr>";
  //
  //   ketmetode += "<tr>";
  //   ketmetode += "<td>Nama Pemilik Rekening</td>";
  //   ketmetode += "<td><input type='text' class='form-control' name='nmrek_pengirim' value='' required><input type='hidden' class='form-control' name='nmrek_tujuan' value='TB AOM'></td>";
  //   ketmetode += "</tr>";
  //
  //   ketmetode += "</table>";
  //   // ketmetode += "<p class='mb-0'><b>BCA</b> : 6281188442</p>";
  //
  //   // alert("BCA");
  //
  //   $("#metodeBayar").html(ketmetode);
  //   $("#metodeAtm").val('bca');
  //   $(".notivBayar").html('');
  // });

  // $("#manualtransfer-mandiri").click(function(){
  //
  //   var ketmetode = "";
  //   ketmetode += "Silahkan lakukan pembayaran ke rekening berikut";
  //   ketmetode += "<p class='mb-0'><b>MANDIRI : 0700010320948 a/n TB AOM</b></p>";
  //
  //   ketmetode += "<table class='table' style='font-size:13px;margin-top:20px;'>";
  //
  //   ketmetode += "<tr>";
  //   ketmetode += "<th colspan='2'>Rek Pengirim</th>";
  //   ketmetode += "</tr>";
  //
  //   ketmetode += "<tr>";
  //   ketmetode += "<td>Bank</td>";
  //   ketmetode += "<td><input type='text' class='form-control' name='nmbank_pengirim' value='' required><input type='hidden' class='form-control' name='nmbank_tujuan' value='MANDIRI'></td>";
  //   ketmetode += "</tr>";
  //
  //   ketmetode += "<tr>";
  //   ketmetode += "<td>No. Rekening</td>";
  //   ketmetode += "<td><input type='text' class='form-control' name='norek_pengirim' value='' required><input type='hidden' class='form-control' name='norek_tujuan' value='0700010320948'></td>";
  //   ketmetode += "</tr>";
  //
  //   ketmetode += "<tr>";
  //   ketmetode += "<td>Nama Pemilik Rekening</td>";
  //   ketmetode += "<td><input type='text' class='form-control' name='nmrek_pengirim' value='' required><input type='hidden' class='form-control' name='nmrek_tujuan' value='TB AOM'></td>";
  //   ketmetode += "</tr>";
  //
  //   ketmetode += "</table>";
  //   // ketmetode += "<p class='mb-0'><b>BCA</b> : 6281188442</p>";
  //
  //   // alert("BCA");
  //
  //   $("#metodeBayar").html(ketmetode);
  //   $("#metodeAtm").val('mandiri');
  //   $(".notivBayar").html('');
  // });

});
</script>
