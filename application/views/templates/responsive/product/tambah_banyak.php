<div class="decoration"></div>
<h4 class="uppercase bolder color-blue-dark center-text">
  Tambah Banyak Produk
</h4>

<div class="decoration bottom-10"></div>

<form action="<?= base_url() . 'product/add_product' ?>" method="post" enctype="multipart/form-data">

<div class="content bottom-30">
  <h4 class="uppercase bolder">Upload File</h4>
  <p class="bottom-15">
    <!-- <i class="fa fa-exclamation-triangle" style="color:orange;"></i> -->
    Format File
      <a href="<?=base_url('assets/files/excels/ei_produk_homedepo.xls')?>" target="_blank">
        Download <i class="fa fa-file-excel-o"></i>
      </a> <br> <font style="font-size:10px; color:red;">* Format file terbaru /tgl 8 Maret 2022</font>
  </p>
  <div class="decoration"></div>

  <div class="input-simple-1 has-icon input-green left-15">
    <strong>Wajib</strong><em><b>File Product Excel</b></em>
    <i class="fa fa-file-excel-o"></i>
    <input type="hidden" name="id_member" value="<?=$id_member?>">
    <input type="file" name="file_1" id="file_1" accept="application/vnd.ms-excel" required style="cursor:pointer;">
  </div>
  <div id="file_1div"></div>

</div>

  <div class="clear"></div>
</div>


<div class="content demo-buttons">
  <button type="submit" name="button" class="button button-full button-round button-blue" style="cursor:pointer;">
    <i class="fa fa-plus"></i> Tambah Produk
  </button>

  <!-- <input type="submit" value="Tambah Produk" name="submit" class="button button-full button-round button-blue" style="cursor:pointer;"> -->
</div>

</form>

<div class="decoration decoration-margins"></div>
