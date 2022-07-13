<style media="screen">
@media (max-width: 992px) {
  .container-product{
    padding-top: 130px;
  }
}
@media (min-width: 992px) {
  .container-product{
    padding-top: 20px;
  }
}
</style>

<!-- select2 -->
<link href="<?=base_url();?>assets/plugins/select2-4.0.3/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

<!-- <div id="mobile-menu-overlay"></div> -->

<div role="main" class="main">
  <div class="checkout">
    <div class="container container-product">
      <h1 class="h2 heading-primary mt-lg mb-md clearfix">
        Checkout

        <?php
          // foreach ($datatoko as $key => $value) {
          //   echo $value->member;
          // }
        ?>

      </h1>

      <div class="checkout-menu clearfix">
        <a href="<?=base_url('buyer/keranjang')?>" class="btn btn-primary pull-left mb-sm">Kembali</a>

        <div class="dropdown pull-right checkout-review-dropdown">
          <button class="btn btn-secondary mb-sm" id="reviewTable" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shopping-cart"></i>
            Rp. <?=rupiah($grand_total)?>
          </button>
          <div class="dropdown-menu" aria-labelledby="reviewTable">
              <h3>Rincian Pesanan</h3>
              <table>
                <thead>
                  <tr>
                    <th><b>Produk</b></th>
                    <!-- <th class="text-center"><b>Jumlah</b></th> -->
                    <th class="text-right"><b>Harga Satuan</b></th>
                  </tr>
                </thead>

                <tbody>

                  <?php foreach ($keranjang_buyer as $keyk => $keranjang) { ?>

                  <tr>
                    <td>
                      <?=$keranjang->nama_product?> <br> (<?=$keranjang->jumlah_product?> Produk)
                    </td>
                    <td class="text-right" style="vertical-align:bottom">
                      Rp.<?=rupiah($keranjang->harga_product)?>
                    </td>
                  </tr>

                  <?php } ?>

                </tbody>

                <tfoot>
                  <tr style="">
                    <td class="text-left" style="border-top: 2px solid #1c2a5f;padding-left:15px;color:#db0c13;"><b>Subtotal</b></td>
                    <td class="text-right" style="border-top: 2px solid #1c2a5f;color:#db0c13;">
                      <b>Rp.<?=rupiah($grand_total)?></b>
                    </td>
                  </tr>
                </tfoot>
              </table>
          </div>
        </div>
      </div>

      <div class="row" style="border-top: 1px solid #ccc;padding-top:17px;">
        <div class="col-md-4">
          <div class="form-col">
            <h3>
              Alamat Pengiriman
              <span class="tip tip-new" style="font-size:10px;">Utama</span>
            </h3>

            <div class="row">
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>
                    <b><?=$alamat_utama_buyer->nm_penerima?></b>
                    <font style="font-size:10px;letter-spacing: 1.5px;">(<?=$alamat_utama_buyer->label_alamat?>)</font>
                  </label>
                </div>
              </div>

              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label><?=$alamat_utama_buyer->tlp_penerima?></label>
                </div>
              </div>

              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label><?=$alamat_utama_buyer->alamat_buyer?></label>

                  <input type="hidden" id="kotabuyer" name="kotabuyer" value="<?=$alamat_utama_buyer->id_kabupaten?>">

                  <!-- <input type="text" id="nmprovbuyer" name="nmprovbuyer" value="<?=$kota_buyer->province?>">
                  <input type="text" id="nmkotabuyer" name="nmkotabuyer" value="<?=$kota_buyer->city_name?>"> -->
                </div>
              </div>
            </div>

          </div>
        </div>

        <form id="formCheckout" class="" action="<?=base_url()?>buyer/transaksi" method="post">
        <div class="col-md-4">
          <div class="form-col">

            <?php
              foreach ($datatoko as $key => $toko) {
            ?>

            <h3 style="border-bottom:1px solid #ccc;">
              Pesanan <?=$key+1?>

              <div class="dropdown pull-right checkout-review-dropdown">

                <a href="#" id="reviewTable" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <b style="font-size:12px;">Detail Pesanan</b>
                </a>

                <div class="dropdown-menu" aria-labelledby="reviewTable" style="width:390px;">
                    <h3><?=$toko->member?></h3>
                    <table>
                      <thead>
                        <tr>
                          <th><b>Produk</b></th>
                          <!-- <th class="text-center"><b>Jumlah</b></th> -->
                          <th class="text-right"><b>Harga Satuan</b></th>
                        </tr>
                      </thead>

                      <tbody>

                        <?php
                          foreach ($keranjang_buyer as $keyk => $keranjang) {

                            $id_keranjang[$keyk] = $keranjang->id;

                            if ($keranjang->id_member == $toko->id) {
                        ?>

                        <tr>
                          <td>
                            <input type="hidden" name="id_keranjang[]" value="<?=$keranjang->id?>">
                            <?=$keranjang->nama_product?> <br> (<?=$keranjang->jumlah_product?> Produk)
                          </td>
                          <td class="text-right" style="vertical-align:bottom">
                            Rp.<?=rupiah($keranjang->harga_product)?>
                          </td>
                        </tr>

                        <?php }} ?>

                      </tbody>

                      <tfoot>
                        <tr style="">
                          <td class="text-left" style="border-top: 2px solid #1c2a5f;padding-left:15px;color:#db0c13;"><b>Subtotal</b></td>
                          <td class="text-right" style="border-top: 2px solid #1c2a5f;color:#db0c13;">
                            <b>Rp.<?=rupiah($grand_total)?></b>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                </div>
              </div>

            </h3>

            <div class="ship-list">

              <?php
                if ($berat_keranjang_pertoko[$key] > 30) {
              ?>

              <p style="font-size:12px;">
                <font style="color:red;">Berat barang lebih dari 30kg</font>
                <br> Silahkan pilih pengiriman yg disediakan oleh toko
              </p>
              <select class="form-control" required id="datakurir[]" idKr="<?=$id_keranjang[$key]?>" idkm="<?=$toko->id_kabupaten_member?>" idM="<?=$toko->id?>" bKm="<?=$berat_keranjang_pertoko[$key]?>" idB="<?=$id_member?>" style="background:#1c2a5f;color:#fff;">
                <option value="">Berat barang melebihi batas maksimal 30kg</option>
              </select>

              <?php }else { ?>

              <p>Pilih Pengiriman :</p>
              <select class="form-control" required id="datakurir[]" idKr="<?=$id_keranjang[$key]?>" idkm="<?=$toko->id_kabupaten_member?>" idM="<?=$toko->id?>" bKm="<?=$berat_keranjang_pertoko[$key]?>" idB="<?=$id_member?>" style="background:#1c2a5f;color:#fff;">
                <option value="">Pilih Kurir</option>

                <?php
                  $jkm = unserialize($toko->jasa_kirim_member);

                  foreach ($jkm as $keyjkm => $value_jkm) {
                ?>

                <!-- <option value="<?=$value_jkm?>" <?=$detail_kurir_kirim[$key]==$value_jkm?'selected':''?>>
                  <?php
                    if ($value_jkm == 'jne') {
                      echo "JNE";
                    }elseif ($value_jkm == 'tiki') {
                      echo "TIKI";
                    }else {
                      echo "POS INDONESIA";
                    }
                  ?>
                </option> -->

                <option value="<?=$value_jkm?>">
                  <?php
                    if ($value_jkm == 'jne') {
                      echo "JNE";
                    }elseif ($value_jkm == 'tiki') {
                      echo "TIKI";
                    }else {
                      echo "POS INDONESIA";
                    }
                  ?>
                </option>

                <?php } ?>

                <!-- <option <?=$detail_kurir_kirim[$key]=='jne'?'selected':''?> value="jne">JNE</option>
                <option <?=$detail_kurir_kirim[$key]=='tiki'?'selected':''?> value="tiki">TIKI</option>
                <option <?=$detail_kurir_kirim[$key]=='pos'?'selected':''?> value="pos">POS Indonesia</option> -->
              </select>

              <?php } ?>


              <input type="hidden" id="kotatoko" name="kotatoko" value="<?=$toko->id_kabupaten_member?>">
              <input type="hidden" name="id_buyer" value="<?=$id_member?>">
              <!-- <input type="text" id="nmprovtoko" name="nmprovtoko" value="<?=$prov_toko[$key]?>">
              <input type="text" id="nmkotatoko" name="nmkotatoko" value="<?=$kota_toko[$key]?>"> -->

              <div class="form-col" style="border: 1px solid #dddddd;padding: 10px;box-shadow: 1px 1px #dddddd;">
                <div style='font-size:12px;'>
                  Pengiriman Dari : <br>
                  <!-- <b style="padding-left:5px;"> <?=$prov_toko[$key]?> ( <?=$kota_toko[$key]?> )</b> ke <br>
                  <b style="padding-left:5px;"> <?=$kota_buyer->province?> ( <?=$kota_buyer->city_name?> ) </b> <br> -->

                  <b style="padding-left:5px;"> <?=$toko->province_name?> ( <?=$toko->city_name?> )</b> ke <br>
                  <b style="padding-left:5px;"> <?=$alamat_utama_buyer->province_name?> ( <?=$alamat_utama_buyer->city_name?> ) </b> <br>

                  berat barang <b> <?=$berat_keranjang_pertoko[$key]?> kg </b>
                </div>

                <input type="hidden" name="id_toko[]" value="<?=$toko->id?>">
                <input type="hidden" name="id_kurir_kirim[]" value="<?=$id_kurir_kirim[$key]?>">

                <input id="intOngkir_<?=$toko->id?>" type="hidden" class="intongkirs" name="intongkir[]" required="true" value="<?=$detail_biaya_kirim[$key]?>">
                <div id="hasilOngkir_<?=$toko->id?>" class=""></div>
              </div>

            </div>



          <?php } ?>

        </div>

        <!-- <div class="datatable-responsive">

        </div> -->

          <?php
            // echo $this->load->view('buyer/testrajaongkir');
          ?>



        </div>

        <div class="col-md-4">

          <div class="form-col">
            <h3>Ringkasan belanja</h3>
          </div>

          <div class="checkout-review-action">
            <h5>
              Total Harga (<?=$sel_total_keranjang?> produk)
              <span class="pull-right">Rp. <?=rupiah($grand_total)?></span>
            </h5>

            <h5>
              Total Ongkos Kirim
              <input type="hidden" id="grandTotal" name="grandtotal" value="<?=$grand_total?>">
              <input type="hidden" id="valtOngKir" name="valtongkir" value="">
              <input type="hidden" id="jumlahBayar" name="jumlah_bayar" value="">

              <!-- <span id="t-OngKir" class="pull-right">Rp. <?=rupiah($total_biaya_kirim)?></span> -->
              <span id="t-OngKir" class="pull-right"></span>
              <input type="hidden" id="beratbarang" name="beratbarang" value="<?=$berat_keranjang?>">
              <input type="hidden" name="total_transaksi" value="<?=$grand_total+$total_biaya_kirim?>">
            </h5>

            <h4 style="padding-top:10px;border-top: 1px solid #bbb; font-weight:bold;color:red;">
              Total Tagihan
              <span id="jumlahBayar1" class="pull-right"></span>
            </h4>
          </div>

          <div class="checkout-review-action">
            <a href="#" id="pilihPembayaran" class="btn btn-primary btn-block" data-toggle="modal" data-target=".shop-pembayaran-modal">Pilih Pembayaran</a>
            <!-- <input id="pilihPembayaran" type="submit" class="btn btn-primary btn-block" name="" data-toggle="modal" data-target=".shop-pembayaran-modal" value="Pesan sekarang"> -->
            <!-- <button id="pilihPembayaran" type="submit" class="btn btn-primary btn-block" name="button" data-toggle="modal" data-target=".shop-pembayaran-modal">Pilih Pembayaran</button> -->
            <!-- <button id="pilihPembayaran" type="submit" class="btn btn-primary btn-block" name="button" data-toggle="modal" data-target="">Pilih Pembayaran</button> -->
          </div>

        </div>

        <?=$this->load->view('buyer/payment'); ?>

        </form>

        <!-- <div class="col-md-4">
          <div class="form-col">
            <h3>Pilih Pembayaran</h3>

            <div class="checkout-payment-method">
              <div class="radio">
                <label>
                  <input type="radio" value="checkmo" name="payment[method]" checked="checked" class="payment-card-check">
                  Check / Money order
                </label>
              </div>

              <div class="radio">
                <label>
                  <input type="radio" value="checkcard" name="payment[method]" class="payment-card-check">
                  Credit Card (saved)
                </label>
              </div>

              <div id="payment-credit-card-area">
                <div class="form-group wide mb-md">
                  <label>Name on Card<span class="required">*</span></label>
                  <input type="text" class="form-control" required>
                </div>

                <div class="form-group wide mb-md">
                  <label>Credit Card Type<span class="required">*</span></label>
                  <select class="form-control">
                    <option value="&nbsp;">Please Select</option>
                    <option value="AE">American Express</option>
                    <option value="VI">Visa</option>
                    <option value="MC">MasterCard</option>
                  </select>
                </div>

                <div class="form-group wide mb-md">
                  <label>Credit Card number<span class="required">*</span></label>
                  <input type="text" class="form-control" required>
                </div>

                <div class="form-group wide mb-md">
                  <label>Credit Card Type<span class="required">*</span></label>
                  <div class="clearfix">
                    <select class="form-control pull-left">
                      <option value="&nbsp;">Month</option>
                      <option value="1">01 - January</option>
                      <option value="2">02 - February</option>
                      <option value="3">03 - March</option>
                      <option value="4">04 - April</option>
                      <option value="5">05 - May</option>
                      <option value="6">06 - June</option>
                      <option value="7">07 - July</option>
                      <option value="8">08 - August</option>
                      <option value="9">09 - September</option>
                      <option value="10">10 - October</option>
                      <option value="11">11 - November</option>
                      <option value="12">12 - December</option>
                    </select>

                    <select class="form-control pull-left ml-md">
                      <option value="&nbsp;">Year</option>
                      <option value="2017">2017</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                    </select>
                  </div>
                </div>

                <div class="form-group mb-lg">
                  <label>Card Verification Number<span class="required">*</span></label>
                  <input type="text" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="checkout-review-action">
              <h5>Total Harga <span>Rp. <?=rupiah($grand_total)?></span></h5>
              <a href="#" class="btn btn-primary btn-block">Pesan sekarang</a>
            </div>
          </div>
        </div> -->

      </div>
    </div>
  </div>

</div>

<script src="<?= site_url(); ?>assets/plugins/select2-4.0.3/dist/js/select2.full.min.js" type="text/javascript"></script>

<script type="text/javascript">

  var baseUrl = '<?=base_url()?>';

  $("#id_pengiriman").select2({
        placeholder: "Cari Pengiriman",
        allowClear: true
  });
  $("#sel1").select2({
        placeholder: "Pilih Provinsi",
        allowClear: true
  });
  $("#sel2").select2({
        placeholder: "Pilih Kota",
        allowClear: true
  });

  // $(document).ready(function () {
  //   $('input').change(function () {
  //     alert(id);
  //   });
  // });

  // $("#datakurir[]").on("change", function(e){
  $("select[id='datakurir[]']").change(function(e) {

    e.preventDefault();
    var kurir     = $('option:selected', this).val();
    // var origin   = $("#kotatoko").val();
    var origin    = $(this).attr('idkm');
    var qty       = $(this).attr('bKm');
    var des       = $("#kotabuyer").val();
    // var qty      = $("#beratbarang").val();
    var idmember  = $(this).attr('idM');
    var idbuyer   = $(this).attr('idB');

    var idkeranjang   = $(this).attr('idKr');

    // var qty    = '1';

    // alert(idkeranjang);

    cekOngkir(origin,des,qty,kurir,idmember,idbuyer,idkeranjang);
  });


  function cekOngkir(origin,des,qty,cour,idmember,idbuyer,id_keranjang) {
    // var op = $("#hasilOngkir");

    // alert(idkeranjang);

    var opx = "#hasilOngkir_"+idmember;

    var i, j, x = "";

    var url = "<?php echo site_url('buyer/get_tarif');?>";
    $.getJSON(url+"/"+origin+"/"+des+"/"+qty+"/"+cour, function(data){
      $.each(data, function(i,field){



        x +="<div style='font-size:13px;padding:10px;color:red;'>pilih salah satu jenis layanan";
        x +="</div>";

        x +="<table id='tableCekongkir' class='table table-hover'>";
        x +="<thead style='font-size:13px;background:whitesmoke;'><tr>";
        x +="<th>Jenis Layanan</th><th>Tarif</th><th>Estimasi</th>";
        x +="</tr></thead>";

        for(i in field.costs)
        {

          // var barang = [];
          // $.each($("input[name='intongkir[]']:checked"), function(){
          //   barang.push($(this).val());
          // });

          // acuanidm = "intOngkir_"+idmember;
          // acuanidmval = $("#"+acuanidm).val();

          // if (acuanidmval ==='0' || acuanidmval==='') {
          //   $('#pilihPembayaran').hide();
          // }else {
          //   $('#pilihPembayaran').show();
          // }


          tarifok = field.costs[i].cost[0].value;


          x +="<tbody><tr style='cursor:pointer;'>";
          // x +="<div style='background:blue!important;'>";

          // for (j in field.costs[i].cost) {
            // x +="<td tarcour='"+cour+"' tariflyn='"+tarifok+"' tarim='"+idmember+"' tarib='"+idbuyer+"' style='font-size:10px'><b>" + field.costs[i].service + "</b> <br>";
            // x +="<font style='font-size:9px'>"+(field.costs[i].description)+"</font></td>";
            // x +="<font style='font-size:9px'>"+field.costs[i].description+"</font></td>";

            for (j in field.costs[i].cost) {
              ests = field.costs[i].cost[j].etd.substr(0, 1);

              if (parseInt(ests) === 0) {
                estimasi = "Hari Ini";
              }else {
                estimasi = field.costs[i].cost[j].etd.substr(0, 1) + " Hari";
              }

              x +="<td tarcour='"+cour+"' tarest='"+ests+"' tariflyn='"+tarifok+"' tarim='"+idmember+"' tarib='"+idbuyer+"' tarikr='"+id_keranjang+"' style='font-size:10px'><b>" + field.costs[i].service + "</b> <br>";
              x +="<font style='font-size:9px'>"+(field.costs[i].description)+"</font></td>";

              // tarifok = field.costs[i].cost[j].value;
              // var inongk = "intOngkir_"+idmember;

              // x =+"<div>";
              x +="<td tarcour='"+cour+"' tarest='"+ests+"' tariflyn='"+tarifok+"' tarim='"+idmember+"' tarib='"+idbuyer+"' tarikr='"+id_keranjang+"' style='font-size:12px'>"+ formatRupiah(tarifok) +"</td>";
              x +="<td tarcour='"+cour+"' tarest='"+ests+"' tariflyn='"+tarifok+"' tarim='"+idmember+"' tarib='"+idbuyer+"' tarikr='"+id_keranjang+"' style='font-size:12px'>"+ estimasi +"</td>";
              // x =+"</div>";
              // x +="<div>xxx</div>";

            }

          // x +="</div>";
          x +="</tr></tbody>";
          // x +="</table>";

            // x += "<p class='mb-0'><b>" + field.costs[i].service + "</b> : "+field.costs[i].description+"</p>";
            //
            //  for (j in field.costs[i].cost) {
            //    x += field.costs[i].cost[j].value +"<br>"+field.costs[i].cost[j].etd+"<br>"+field.costs[i].cost[j].note;
            //  }

        }


        x +="</table>";

        // opx.innerHTML(x);
        $(opx).html(x);

      });
    });

  }

  $(document).on('click', '#tableCekongkir td', function (e) {

    var tarifidmem  = $(this).attr('tarim');
    var tarifidbuyer  = $(this).attr('tarib');
    var tarifkurir  = $(this).attr('tarcour');
    var tarifestimasi  = $(this).attr('tarest');
    var tarifharga  = $(this).attr('tariflyn');

    var tarifidkeranjang   = $(this).attr('tarikr');

    // alert(tarifidkurir);

    inongk = "intOngkir_"+tarifidmem;

    totalin = $("#"+inongk).val(tarifharga);


    acinongk = "intOngkir_"+tarifidmem;
    acuanidmval = $("#"+acinongk).val();

    totalHarga = $("#grandTotal").val();

    // $("#t-OngKir").html(tarifharga);
    $("#t-OngKir").html(formatRupiah(tarifharga));
    $("#valtOngKir").val(parseInt(tarifharga));
    $("#jumlahBayar").val(parseInt(totalHarga)+parseInt(tarifharga));
    $("#j-Bayar").html('Rp. ' +formatRupiah(parseInt(totalHarga)+parseInt(tarifharga)));
    $("#jumlahBayar1").html('Rp. ' +formatRupiah(parseInt(totalHarga)+parseInt(tarifharga)));
    // $("#valtOngKir").attr ("attr-"+tarifidmem ,tarifharga);




    var toUrl = "buyer/update_kurir/"+tarifidkeranjang+"/"+tarifidmem+"/"+tarifidbuyer+"/"+tarifkurir+"/"+tarifestimasi+"/"+tarifharga;
    var urlTarget = baseUrl+toUrl;

    $.ajax({
      type: 'POST',
      url: urlTarget,
      // data: data,
      success: function() {
        notiV;
        location.reload();
        // $('#dataKeranjang').ajax.reload();
      }
    });
    return false;

    // alert(acuanidmval);
  });

  // $('#pilihPembayaran').hide();

  // $(function(){
	// 	$('#formCheckout').submit(function(e){
	// 		// alert('Submit forCheckout');
  //
  //     $('input[name=intongkir[]]').each(function(i, val){
  //         alert($(this).val());
  //     });
  //
  //   });
  // });



  // $("input[name='intongkir[]']:required").change(function() {
  //
  //   var intongkirval = [];
  //
  //   $.each($("input[name='intongkir[]']"), function(){
  //     intongkirval.push($(this).val());
  //   });
  //
  //   alert(intongkirval);
  //
  //   // if (intongkirval ==='0' || intongkirval ==='') {
  //   //   $('#pilihPembayaran').hide();
  //   //   // alert('Pilih Barang');
  //   // }else {
  //   //   // alert(favorite);
  //   //   $('#pilihPembayaran').show();
  //   //   $("#pilihPembayaran").attr ( "data-toggle" ,"modal" );
  //   //   $("#pilihPembayaran").attr ( "data-target" ,".shop-pembayaran-modal" );
  //   // }
  //
  // });

  // $('#pilihPembayaran').hide();
  // $(document).on('click', '#tableCekongkir td', function (e) {
  //   var tariflayanan  = $(this).attr('tariflyn');
  //
  //   // $.each(data, function(i,field){
  //
  //   // alert(tariflayanan);
  //   // $('#pilihPembayaran').show();
  // });

  function formatRupiah(angka){

    var	number_string = angka.toString(),
      sisa 	= number_string.length % 3,
      rupiah 	= number_string.substr(0, sisa),
      ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    return rupiah;

	}



// function getLokasi() {
//   var $op = $("#sel1"), $op1 = $("#sel11");
//
//   $.getJSON("provinsi", function(data){
//     $.each(data, function(i,field){
//
//        $op.append('<option value="'+field.province_id+'">'+field.province+'</option>');
//        $op1.append('<option value="'+field.province_id+'">'+field.province+'</option>');
//
//     });
//
//   });
//
// }
//
// getLokasi();
//
// $("#sel11").on("change", function(e){
//   e.preventDefault();
//   var option = $('option:selected', this).val();
//   $('#sel22 option:gt(0)').remove();
//   $('#kurir').val('');
//
//   if(option==='')
//   {
//     alert('null');
//     $("#sel22").prop("disabled", true);
//     $("#kurir").prop("disabled", true);
//   }
//   else
//   {
//     $("#sel22").prop("disabled", false);
//     getKota1(option);
//   }
// });
//
//
// $("#sel1").on("change", function(e){
//   e.preventDefault();
//   var option = $('option:selected', this).val();
//
//   // alert(option);
//
//   $('#sel2 option:gt(0)').remove();
//   $('#kurir').val('');
//
//   if(option==='')
//   {
//     alert('Pilih Provinsi');
//     $("#sel2").prop("disabled", true);
//     $("#kurir").prop("disabled", true);
//   }
//   else
//   {
//     $("#sel2").prop("disabled", false);
//     getKota(option);
//   }
// });
//
//
//
//
// $("#sel22").on("change", function(e){
//   e.preventDefault();
//   var option = $('option:selected', this).val();
//   $('#kurir').val('');
//
//   if(option==='')
//   {
//     alert('null');
//     $("#kurir").prop("disabled", true);
//   }
//   else
//   {
//     $("#kurir").prop("disabled", false);
//   }
// });

// $("#kurir").on("change", function(e){
//
//   e.preventDefault();
//   var option = $('option:selected', this).val();
//   var origin = $("#sel2").val();
//   var des = $("#sel22").val();
//   var qty = $("#berat").val();
//
//   // var origin = $(this).attr('idkm');
//   // var des    = ($("#kotabuyer").val());
//   // var qty    = parseInt($("#beratbarang").val());
//
//   // var origin = '154';
//   // var des    = '153';
//   // var qty    = '30';
//
//   // alert(option);
//
//   if(qty==='0' || qty==='')
//   {
//     alert('null');
//   }
//   else if(option==='')
//   {
//     alert('null');
//   }
//   else
//   {
//     getOrigin(origin,des,qty,option);
//     // hasil_pengecekan();
//   }
// });

// function hasil_pengecekan() {
//   alert('ok');
//   var posturl = "<?php echo site_url('buyer/get_tarif');?>";
//   $('#tabel-hasil-pengecekan').DataTable({
//         processing: true,
//         serverSide: true,
//         bDestroy: true,
//         responsive: true,
//         ajax: {
//           url: posturl,
//           type: "POST",
//           data: {
//             kota_asal: $('#kota_asal').val(),
//             kota_tujuan: $('#kota_tujuan').val(),
//             berat: $('#berat').val(),
//           },
//           complete: function(data) {
//             resetForm('form-cek-ongkir', ['kota_asal', 'kota_tujuan']);
//
//             $('#btn-periksa-ongkir').prop('disabled', false)
//               .text('Periksa Ongkir');
//
//           },
//         },
//         columnDefs: [{
//             targets: [0],
//             orderable: false,
//           },
//           {
//             width: "1%",
//             targets: [0],
//           },
//           {
//             className: "dt-nowrap",
//             targets: [1, 2],
//           },
//           {
//             className: "dt-right",
//             targets: [-1],
//           },
//         ],
//
//       });
// }


// function getOrigin(origin,des,qty,cour) {
//   var op = $("#hasil");
//   var i, j, x = "";
//
//   // op.innerHTML('xxx');
//   // $('#hasil').html('Password Cocok');
//
//   // var qtyx = 1;
//
//   var url = "<?php echo site_url('buyer/get_tarif');?>";
//   $.getJSON(url+"/"+origin+"/"+des+"/"+qty+"/"+cour, function(data){
//     $.each(data, function(i,field){
//
//       for(i in field.costs)
//       {
//           x += "<p class='mb-0'><b>" + field.costs[i].service + "</b> : "+field.costs[i].description+"</p>";
//
//            for (j in field.costs[i].cost) {
//                 x += field.costs[i].cost[j].value +"<br>"+field.costs[i].cost[j].etd+"<br>"+field.costs[i].cost[j].note;
//             }
//
//       }
//
//       // op.innerHTML(x);
//       $('#hasil').html(x);
//
//     });
//   });
//
// }
//
//
// function getKota1(idpro) {
//   var $op = $("#sel22");
//
//   // alert(idpro);
//
//   var url = "<?php echo site_url('buyer/get_kota');?>/"+idpro;
//   $.getJSON(url, function(data){
//     $.each(data, function(i,field){
//
//
//        $op.append('<option value="'+field.city_id+'">'+field.type+' '+field.city_name+'</option>');
//
//     });
//
//   });
//
// }
//
// function getKota(idpro) {
//   var $op = $("#sel2");
//
//   // alert(idpro);
//
//   var url = "<?php echo site_url('buyer/get_kota');?>/"+idpro;
//   $.getJSON(url, function(data){
//     $.each(data, function(i,field){
//
//
//        $op.append('<option value="'+field.city_id+'">'+field.type+' '+field.city_name+'</option>');
//
//     });
//
//   });
//
// }
</script>
