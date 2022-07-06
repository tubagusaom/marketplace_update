<div class="decoration"></div>
<h4 class="uppercase bolder color-blue-dark center-text">
  Tambah Produk
</h4>

<div class="decoration bottom-10"></div>

<form action="<?= base_url() . 'product/add' ?>" method="post">

<div class="content bottom-30">
  <h4 class="uppercase bolder">Upload Produk</h4>
  <p class="bottom-15">
    <i class="fa fa-exclamation-triangle" style="color:orange;"></i>
    Hindari berjualan produk palsu, supaya produkmu tidak dihapus.
  </p>
  <div class="decoration"></div>

  <p class="bottom-0">
    <i class="fa fa-exclamation-circle" style="color:red;"></i>
    Format gambar <b>.jpg .jpeg .png</b> dan ukuran minimum <b>200 x 200px</b>
  </p>
  <div class="input-simple-1 has-icon input-green left-15">
    <strong>Wajib</strong><em><b>Foto Utama</b></em>
    <i class="fa fa-file-image"></i>

    <input type="file" id="produk_1" accept="image/*" required style="cursor:pointer;">
  </div>
  <div id="produk_1div"></div>

  <div class="input-simple-1 has-icon input-green left-15">
    <strong>Wajib</strong><em><b>Foto 2</b></em>
    <i class="fa fa-file-image"></i>
    <input type="file" id="produk_2" accept="image/*" required style="cursor:pointer;">
  </div>
  <div id="produk_2div"></div>

  <div class="input-simple-1 has-icon input-green left-15">
    <strong>Wajib</strong><em><b>Foto 3</b></em>
    <i class="fa fa-file-image"></i>
    <input type="file" id="produk_3" accept="image/*" required style="cursor:pointer;">
  </div>
  <div id="produk_3div"></div>

</div>

<!-- <div class="decoration decoration-margins top-30"></div> -->

<div class="content top-30 bottom-50">
  <h4 class="uppercase bolder bottom-15">Informasi Produk</h4>
  <div class="decoration"></div>

  <div class="select-box select-box-1 left-15">
    <strong>Wajib</strong>
    <em><b>Jenis Product</b></em>
    <input type="hidden" name="id_member" value="<?=$id_member?>">
    <select id="id_menu_kategori" name="id_menu_kategori" required>
      <option value="">Pilih Jenis Produk</option>
      <?php foreach ($jenis as $key => $jenis) { ?>
        <option value="<?=$jenis->id?>"><?=$jenis->menu_kategori ?></option>
      <?php } ?>
    </select>
  </div>

  <div id="div_kategori" class="select-box select-box-1 left-15">
    <strong>Wajib</strong>
    <em><b>Jenis Kategori</b></em>
    <select id="id_kategori" name="id_kategori" required>
      <!-- <option value="">-PILIH JENIS PRODUK DULU-</option> -->
    </select>
  </div>

  <div id="div_subkategori" class="select-box select-box-1 left-15">
    <strong>Wajib</strong>
    <em><b>Kategori</b></em>
    <select id="id_sub_kategori" name="id_sub_kategori" required>
      <!-- <option value="">-PILIH JENIS PRODUK DULU-</option> -->
    </select>
  </div>

  <div class="input-simple-1 has-icon input-green bottom-30 left-15">
    <strong>Wajib</strong><em><b>Nama Produk</b></em>
    <i class="fa fa-newspaper"></i><input type="text" id="nama_product" name="nama_product" placeholder="Nama Produk" required>
  </div>

  <div class="clear"></div>


  <h4 class="uppercase bolder bottom-15">Detail Produk</h4>
  <div class="decoration"></div>

  <div class="input-simple-1 has-icon input-green bottom-10 left-15">
    <strong>Wajib</strong>
    <em><b>Kondisi</b></em><i class="fa fa-check-circle"></i>
    <div class="fac fac-radio-full fac-green"><span></span>
      <input id="radio-baru" type="radio" name="kondisi_product" value="1" checked>
      <label for="radio-baru">Baru</label>
    </div>
    <div class="fac fac-radio-full fac-green"><span></span>
      <input id="radio-bekas" type="radio" name="kondisi_product" value="2">
      <label for="radio-bekas">Bekas</label>
    </div>
  </div>

  <div class="input-simple-1 textarea has-icon bottom-10 left-15">
    <i class="fa fa-edit"></i><em><b>Deskripsi Produk</b></em>
    <textarea id="ket_product" name="ket_product" class="textarea-simple-1" placeholder="WC Duduk Toko HomeDepo
- Model simple
- Nyaman Digunakan"></textarea>
  </div>

  <div class="input-simple-1 has-icon input-green bottom-30 left-15">
    <em>
      <b>Video Produk</b>
      <!-- <a href="#">Selengkapnya</a> -->
      <a data-menu="menu-success" href="#"> Selengkapnya </a>


      <div id="menu-success" class="content menu-flyin bg-blue-dark notification-large">
    		<!-- <div class="menu-flyin-content"> -->

    			<h1 class="uppercase bolder">
            <a href="#" class="close-menu" style="float:right;">
              <i class="fa right-10 fa-times" style="color:#fff;margin-top:-8px;"></i>
            </a>

            Bagaimana Cara Menambah Video Produk?
          </h1>
    			<p class="color-white bottom-0 opacity-70">
    				<ol style="color:whitesmoke;font-weight:bold;">
              <li>Upload video di youtub</li>
              <li>Klik bagikan</li>
              <li>Pilih Sematkan</li>
              <li>
                Copy link di dalam src="" , contoh : <br><br>
                  < iframe width="560" height="315" <br> src="<font style="background:#000;">https://www.youtube.com/embed/7ONfxObUIOU</font>" title="YouTube video player" frameborder="0"><br>< /iframe>
              </li>
            </ol>
    			</p>
    		<!-- </div> -->
    	</div>

    </em>
    <i class="fa fa-link"></i>
    <input type="text" id="link_product" name="link_product" placeholder="Masukan URL Youtube" >
  </div>

  <h4 class="uppercase bolder bottom-15">Harga & Berat</h4>
  <div class="decoration"></div>

  <div class="input-simple-1 has-icon input-green bottom-10 left-15">
    <strong>Wajib</strong><em><b>Harga Satuan</b> (Rupiah)</em>
    <i class="fa fa-money"></i>
    <input type="number" id="harga_product" name="harga_product" placeholder="Harga Barang" required>
  </div>

  <div class="input-simple-1 has-icon input-green bottom-30 left-15">
    <strong>Wajib</strong><em><b>Berat Produk</b> (Kilogram)</em>
    <i class="fa fa-sort-numeric-asc"></i>
    <input type="number" id="berat_product" name="berat_product" placeholder="Berat Barang" required>
  </div>


  <h4 class="uppercase bolder bottom-15">Pengelolaan Produk</h4>

  <div class="input-simple-1 has-icon input-green left-15">
    <strong>Wajib</strong><em><b>Stok Produk</b></em>
    <i class="fa fa-sort-numeric-asc"></i>
    <input type="number" id="jumlah_product" name="jumlah_product" placeholder="Stok Barang" required>
  </div>

  <div class="input-simple-1 has-icon input-green left-15">
    <strong>Wajib</strong><em><b>Minimum Pemesanan</b></em>
    <i class="fa fa-sort-numeric-asc"></i>
    <input type="number" id="" name="min_pesan_product" placeholder="Minimum Pemesanan" required>
  </div>

  <div class="input-simple-1 has-icon input-green bottom-30 left-15">
    <em><b>Tag Produk</b></em>
    <i class="fa fa-slack"></i>
    <input type="text" id="tag_product" name="tag_product" placeholder="Hastag Product">
  </div>

  <div class="clear"></div>
</div>


<div class="content demo-buttons">
  <button type="submit" name="button" class="button button-full button-round button-blue" style="cursor:pointer;">
    <i class="fa fa-plus"></i> Tambah Produk
  </button>
</div>

</form>

<div class="decoration decoration-margins"></div>

<script type="text/javascript">

  var idMember = '<?=$id_member?>';

  $(document).ready(function(){
    upload_file_ajax("product/upload_ajax/produk_1/"+idMember,"produk_1","produk_1");
    upload_file_ajax("product/upload_ajax/produk_2/"+idMember,"produk_2","produk_2");
    upload_file_ajax("product/upload_ajax/produk_3/"+idMember,"produk_3","produk_3");
  });

  var baseUrl = '<?=base_url()?>';

  function upload_file_ajax (toUrl,stringDiv,stringReturnName){
   $('#'+stringDiv).on('change', function (e) {

       //alert(stringDiv);
       e.preventDefault();
       var urlTarget = baseUrl+toUrl;
       var f = $('#'+stringDiv);
       var listFiles = f[0].files;
       var formData = new FormData();
       formData.append('file', listFiles[0]);
       // $('#myOverlay').show();
       // $('#loadingGIF').show();
       $.ajax({
         url: urlTarget+'/'+stringDiv,
         type: 'POST',
         data: formData,
         processData: false,
         contentType: false,
         success: function (data) {
          data = JSON.parse(data);
          if(data.error){
           // $('#myOverlay').hide();
           // $('#loadingGIF').hide();
           $(stringDiv+"div").val("");
           alert(data.error);
           //alert('dasd');
       }else{
           var txt = "<div class='left-15'><b onclick='hapusFile($(this))' style='cursor:pointer;color:red;' title='Hapus Produk'><i class='fa fa-trash'></i></b> <input type='text' name='file_upload[]' style='width:95%;' class='form-control input-field' value='" + data.upload_data.file_name + "' readonly /><input type='hidden' name='jenis_file[]' value='"+stringDiv+"' /></div>";
           $("#"+stringDiv+"div").append(txt);
           // $('#myOverlay').hide();
           // $('#loadingGIF').hide();
       }
   },
   error: function (request, status, error) {
      alert(request.responseText);
      // $('#myOverlay').hide();
      // $('#loadingGIF').hide();
  }
});
       return false;
   });
}


function hapusFile(e){
 // $('#myOverlay').show();
 // $('#loadingGIF').show();
 objectSebelumnya = e.next();
     //console.log(objectSebelumnya[0].value);

     $.ajax({
      url: baseUrl+'product/hapus_file',
      type: 'POST',
      data: 'nama_file='+objectSebelumnya[0].value,
      success: function () {
         $('#myOverlay').hide();
         $('#loadingGIF').hide();
         return false;
     },
     error: function (request, status, error) {
         alert(request.responseText);
         $('#myOverlay').hide();
         $('#loadingGIF').hide();
     }
 });
     objectBerikutnya = objectSebelumnya.next();
     objectSebelumnya.remove();
     objectBerikutnya.remove();
     e.remove();
 }

 $('#div_kategori').hide();
 $('#div_subkategori').hide();

 $("#id_menu_kategori").change(function (){

   var valmenu = $(this).val();
   //alert('ok');

   if (valmenu === '') {
     $('#div_kategori').hide();
   }else {
     var url = "<?php echo site_url('product/get_kategori');?>/"+$(this).val();
     $('#id_kategori').load(url);
     $('#div_kategori').show();
     return false;
   }

 })

 $("#id_kategori").change(function (){

   var valkategori = $(this).val();
   // alert(valkategori);

   if (valkategori === '') {
     $('#div_subkategori').hide();
   }else {
   var url = "<?php echo site_url('product/get_subkategori');?>/"+$(this).val();
   $('#id_sub_kategori').load(url);
   $('#div_subkategori').show();
   return false;
   }

 })

</script>
