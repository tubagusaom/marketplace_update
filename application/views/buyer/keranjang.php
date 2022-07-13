
<style media="screen">

  @media (max-width: 1199px){
    .product-action-td{
      position: revert!important;
    }
  }

  .td-toko{
    /* background-color: #f5f5f5;
    border-radius: 5px; */
    /* top: -32px; */
  }
  .td-toko .nmtoko a{
    color: #1c2a5f;
  }
  .td-toko .nmtoko a:hover{
    color: #db0c13;
    text-decoration: none;
  }

  .nmproduct{
    color: #1c2a5f!important;
  }
  .nmproduct:hover{
    color: #db0c13!important;
    text-decoration: none!important;
  }


  #myOverlay, #loadingGIF, #textLoadTop, #textLoadBottom{
    position:fixed;
    display:none;
  }

  #myOverlay{
    top:0px;
    bottom:0px;
    width:100%;
    overflow-y:auto;
  }
  #myOverlay{background:black;opacity:.8;z-index:3;}

  #loadingGIF{top:40%;left:53%;z-index:4;}
  #textLoadTop{
    top:46.0%;
    left:50.3%;
    z-index:5;
    background:#00556f;
    opacity:.6;
    color:#fff;
    font-size: 12px;
    font-weight: bold;
    padding: 3px 6px 3px 6px;
    border-radius: 3px;
  }
  #textLoadBottom{
    position:fixed;
    top:53%;
    left:47.3%;
    z-index:5;
    background:rgba(203, 243, 255, 0.3);
    color:#022e3c;
    font-weight: bold;
    padding: 3px 7px 3px 7px;
    border-radius: 3px;
  }

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

<!-- <div id="mobile-menu-overlay"></div> -->

<div id="myOverlay"></div>
<div id="textLoadTop">
  PLEASE WAIT
</div>
<div id="loadingGIF">
  <img src="<?= base_url() . 'assets/img/loading.gif' ?>" style="width:25px;" />
</div>
<div id="textLoadBottom">
  UPDATE KERANJANG
</div>


<div role="main" class="main">
  <div class="cart">
    <div class="container container-product">
      <h1 class="h2 heading-primary mt-lg clearfix">
        <span>Keranjang Belanja</span>
        <!-- <a href="#" class="btn btn-primary pull-right">Proceed to Checkout</a> -->
      </h1>

      <form action="<?=base_url()?>buyer/checkout" method="post" id="form-keranjang">
      <div class="row">
        <div class="col-md-8 col-lg-9">
          <div class="cart-table-wrap">
            <table class="cart-table">
              <!-- <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th>Nama Produk</th>
                  <th>Harga Satuan</th>
                  <th>Jumlah</th>
                  <th>Subtotal</th>
                </tr>
              </thead> -->

              <tbody style="">

                <?php
                  foreach ($keranjang_get_member as $keyg => $get_toko) {
                ?>

                <tr style="margin:10px;padding:15px;background:whitesmoke;border-radius:5px;">
                  <td class="product-action-td td-toko" style="text-align:center;top: -32px;padding-left:5px;">
                    <input dataidtoko="<?=$get_toko->idm?>" type="checkbox" id="check_toko[]" name="check_toko[]" value="<?=$get_toko->idm?>" class="check-tb">
                  </td>
                  <td colspan="4" class="td-toko" style="">
                    <div class="nmtoko">
                      <a href="<?=base_url()?>toko">
                        <b> <?=$get_toko->nm_toko?> </b>
                        <div style="line-height: 20px;font-size:10px;">
                          <?=$get_toko->provinsi?> ( <?=$get_toko->kota?> )
                        </div>
                      </a>
                    </div>
                  </td>
                </tr>

                <?php
                  foreach ($keranjang_buyer as $keyk => $keranjang) {
                    if ( $get_toko->id_member == $keranjang->id_member ) {
                ?>

                <!-- <div id="testdiv"></div> -->
                <tr id="dataKeranjang">

                  <td class="product-action-td" style="text-align:center;">
                    <!-- <a href="#" title="Hapus Produk" class="btn-remove">
                      <i class="fa fa-times"></i>
                    </a> -->
                    <!-- <div class="btn-remove">
                      <input type="checkbox" id="check_barang[]" name="check_barang" value="<?=$get_toko->id?>" class="check-tb">
                    </div> -->
                  </td>
                  <td class="product-image-td">
                    <a href="<?=base_url()?>product/detail/<?=$keranjang->id_product?>/<?=$keranjang->nama_file?>" title="<?=$keranjang->nama_product?>">
                      <img src="<?=base_url()?>assets/img/product/<?=$keranjang->nama_file?>" alt="<?=$keranjang->tag_product?>" style="width:80px;height:80px;border-radius:4px;">
                    </a>
                  </td>
                  <td class="product-name-td">
                    <h2 class="product-name">
                      <a class="nmproduct" href="<?=base_url()?>product/detail/<?=$keranjang->id_product?>/<?=$keranjang->nama_file?>" title="<?=$keranjang->nama_product?>">
                        <div class="">
                          <?=$keranjang->nama_product?>
                        </div>

                      </a>
                      <div class="" style="color:#db0c13;font-size:12px;">
                        sisa <?=($keranjang->total_product - $keranjang->total_terjual)?>
                      </div>
                      <div class="">
                        <b> Rp <?=rupiah($keranjang->harga_product)?> </b>
                      </div>
                    </h2>
                  </td>
                  <td>
                    <div class="qty-holder">

                      <a href="#" class="qty-inc-btn" onclick="deletKeranjang(<?=$keranjang->id?>)" title="Hapus Keranjang" style="padding-top:6px;">
                        <i class="fa fa-trash"></i>
                      </a>

                      <input type="number" class="qty-input" id="jumProduct" name="jumlah_product" dataid="<?=$keranjang->id?>" datasisa="<?=$keranjang->total_product - $keranjang->total_terjual?>" value="<?=$keranjang->jumlah_product?>" onkeypress="return event.charCode >= 48 && event.charCode <=57" style="width:63px !important;" min="1">

                      <!-- <a href="#" class="qty-dec-btn" onclick="updateKeranjang(<?=$keranjang->id?>,<?=($keranjang->total_product - $keranjang->total_terjual)?>)" title="Ubah Keranjang" style="padding-top:6px;">
                        <i class="fa fa-pencil"></i>
                      </a> -->

                      <!-- <a href="<?=base_url()?>buyer/keranjang" id="hapus-keranjang" dtidkr="<?=$keranjang->id?>" class="edit-qty">
                        <input type="text" name="id_keranjang" value="<?=$keranjang->id?>">
                        <i class="fa fa-trash"></i>
                      </a> -->
                    </div>
                    <!-- <div id="notivKr<?=$keranjang->id?>" class="text-primary" style="font-size:9px;padding-top:5px;font-weight:bold;"></div> -->
                    <div class="text-primary" style="font-size:9px;padding-top:5px;font-weight:bold;">
                      <a href="#" style="color:#1c2a5f!important;"> Pindahkan Ke favorit </a>
                    </div>
                  </td>
                  <td>
                    <span class="text-primary">
                      Rp <?=rupiah($keranjang->harga_product * $keranjang->jumlah_product)?>

                      <?php
                        $total = $keranjang->harga_product * $keranjang->jumlah_product;
                        $subtotal += $total;
                      ?>
                    </span>
                  </td>
                </tr>

                <?php
                  }}}
                ?>

              </tbody>
              <tfoot>
                <tr>
                  <td colspan="6" class="clearfix">
                    <!-- <a href="<?=base_url()?>home" class="btn btn-default hover-primary btn-continue">Belanja Lagi</a> -->
                    <!-- <button class="btn btn-default hover-primary btn-continue">Belanja Lagi</button> -->
                    <!-- <button class="btn btn-default hover-primary btn-update">Update Shopping Cart</button>
                    <button class="btn btn-default hover-primary btn-clear">Clear Shopping Cart</button> -->

                    <input id="lanjut_pembelian" type="submit" class="btn btn-primary btn-block" value="lanjutkan pembelian">
                  </td>
                </tr>
              </tfoot>
            </table>

          </div>
        </div>
        <aside class="col-md-4 col-lg-3 sidebar shop-sidebar">
          <div class="panel-group">

            <!-- <div class="tampildata"></div> -->

            <!-- <div class="panel panel-default" style="margin-bottom:10px;">
              <a href="<?=base_url()?>home" class="btn btn-default hover-primary btn-continue btn-block">Belanja Lagi</a>
            </div> -->

            <!-- <div class="form-col" style="background:whitesmoke ;border:1px solid #ccc;padding:10px;border-radius:4px;">
              <h3 class="no-border">
                <i class="fa fa-discount"></i>
                Makin hemat pakai promo
                <a class="expand-plus collapsed pull-right" role="button" data-toggle="collapse" href="#discountArea" aria-expanded="false" aria-controls="discountArea" style="border-radius:3px;"></a>
              </h3>

              <div class="collapse" id="discountArea">
                <div class="form-group wide">
                  <label>Masukkan kode promo:</label>
                  <input type="text" class="form-control">
                </div>

                <a href="#" class="btn btn-primary">Terapkan</a>
              </div>
            </div> -->

            <div class="form-col panel panel-default">
              <div class="totals-table-action">
                <!-- <input id="lanjut_pembelian" type="submit" class="btn btn-primary btn-block" value="lanjutkan pembelian"> -->
                <a href="<?=base_url()?>home" class="btn btn-default hover-primary btn-continue btn-block">Belanja Lagi</a>
              </div>
            </div>

            <!-- <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" href="#panel-cart-total">
                    Ringkasan Belanja
                  </a>
                </h4>
              </div>

              <div id="panel-cart-total" class="accordion-body collapse in">
                <div class="panel-body">
                  <table class="totals-table">
                    <tbody>
                      <tr>
                        <td>Subtotal</td>
                        <td>
                          Rp <?=rupiah($subtotal) ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Total Harga</td>
                        <td>
                          Rp <?=rupiah($subtotal) ?>
                          <input type="hidden" name="grand_total" value="<?=$subtotal?>">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="totals-table-action">
                    <input id="lanjut_pembelian" type="submit" class="btn btn-primary btn-block" value="lanjutkan pembelian">
                  </div>
                </div>
              </div>
            </div> -->

          </div>
        </aside>
      </div>

      </form>

    </div>
  </div>

</div>

<script type="text/javascript">

  var baseUrl = '<?=base_url()?>';

  // $(document).on("click", "#jumProduct", function(){
  $(document).ready(function () {
    $('input').change(function () {

      id     = $(this).attr('id');

      if (id == 'jumProduct') {
        nol      = parseInt(0);
        satu     = parseInt(1);
        dataid   = $(this).attr('dataid');
        datasisa = parseInt($(this).attr('datasisa'));
        dataval  = parseInt($(this).val());

        if (dataval > datasisa) {
          var postVal = datasisa;
          // var notiV = $('#notivKr'+dataid).html('Maks. beli '+datasisa+' barang');
          var notiV = alert('Maks. beli '+datasisa+' barang');
        }else if (dataval == 0) {
          var postVal = satu;
          // var notiV = $('#notivKr'+dataid).html('Jumlah harus diisi');
          var notiV = alert('Jumlah harus diisi');
        }else {
          var postVal = dataval;
          var notiV = '';
        };

        var toUrl = "buyer/ubah_keranjang/"+dataid+"/"+postVal;
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

      }

    });
  });


  $("#lanjut_pembelian").prop("disabled", true);
  $("#lanjut_pembelian").attr ( "title" ,"Pilih Toko" );

  $("input[id='check_toko[]']").change(function() {

    // xxx

    var barang = [];

    $.each($("input[name='check_toko[]']:checked"), function(){
      barang.push($(this).val());
    });

    if (barang.join() ==='0' || barang.join()==='') {
      $("#lanjut_pembelian").prop("disabled", true);
      $("#lanjut_pembelian").attr ( "title" ,"Pilih Toko" );
      // alert('Pilih Barang');
    }else {
      // alert(favorite);
      $("#lanjut_pembelian").prop("disabled", false);
      $("#lanjut_pembelian").attr ( "title" ,"Lanjutkan Pembelian" );
    }

  });

  // $("input[id='check_toko[]']").change(function() {
  //   var chk_arr =  document.getElementsByName("check_toko[]");
  //   var chklength = chk_arr.length;
  //
  //   // alert(chklength);
  //
  //   for(k=0;k< chklength;k++)
  //   {
  //       // chk_arr[k].checked = false;
  //       alert(chklength[k]);
  //   }
  // });





  function deletKeranjang(id){
    // alert(id);
    if(confirm('Apakah Anda yakin akan menghapus keranjang ini ?')) {

      var toUrl = "buyer/hapus_keranjang/"+id;
      var urlTarget = baseUrl+toUrl;
      var data = $('#form-keranjang').serialize();
      var form = $(this);

      $('#myOverlay').show();
      $('#textLoadTop').show();
      $('#loadingGIF').show();
      $('#textLoadBottom').show();

      $.ajax({
      	type: 'POST',
      	url: urlTarget,
      	data: data,
      	success: function() {

          $('#myOverlay').hide();
          $('#textLoadTop').hide();
          $('#loadingGIF').hide();
          $('#textLoadBottom').hide();
          location.reload();
          // $('#dataKeranjang').ajax.reload();
      	}
      });
      return false;
    }

  };

  function updateKeranjangs(id,sisa){

    $('input').change(function () {

      val = this.value;
      idkr = $(this).attr('atrid');

      // alert(this.value);
      alert(idkr);
    });

    // var name = $("#jumProduct").val();
    // var lang = [];
    //
    // $("input[name='jumlah_product']").each(function(){
    //   var ambilVal = lang.push(this.value);
    // });

    alert(theHTML);
  };

  // $(document).ready(function(){
	// 	$("#hapus-keranjang").click(function(){
  //
  //     var toUrl = "buyer/hapus_keranjang";
  //     var urlTarget = baseUrl+toUrl;
  //
	// 		var data = $('#form-keranjang').serialize();
  //
  //     // var href = $('a').attr('href');
  //     var ambilVal = $(this).attr('dtidkr');
  //     // var ambilVal = $("#hapus-keranjang")$(this).attr('dtidkr');
  //     // attr('type');
  //     alert(ambilVal);
  //
  //     // dataString = ??? ; // array?
  //     // var jsonString = JSON.stringify(ambilVal);
  //     // alert(jsonString);
  //
	// 		// $.ajax({
	// 		// 	type: 'POST',
	// 		// 	url: urlTarget,
	// 		// 	data: data,
	// 		// 	success: function() {
	// 		// 		// $('#data-keranjang').load();
  //     //     // $('#data-keranjang').html('#data-keranjang');
  //     //     $('#data-keranjang').html('Data keranjang diperbarui');
  //     //     // document.getElementById("form-keranjang").reset();
  //     //     // $('#data-keranjang').html(html);
	// 		// 	}
	// 		// });
  //
	// 	});
	// });


</script>
