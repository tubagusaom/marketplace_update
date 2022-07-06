<div class="decoration"></div>
<h4 class="uppercase bolder color-blue-dark center-text">
  data produk
</h4>

<div class="decoration"></div>

<div class="">

  <div class="clear"></div>
  <a href="<?=base_url()?>product/tambah" class="button button-xxs button-blue float-left uppercase ultrabold" style="border-radius:4px;">
    <i class="fa fa-plus"></i> Tambah Produk
  </a>

  <a href="<?=base_url()?>product/tambah_product" class="button button-xxs button-blue float-left uppercase ultrabold" style="border-radius:4px;">
    <i class="fa fa-plus"></i> Tambah Banyak Produk
  </a>

  <div class="clear"></div>

  <table class="table-borders-dark">
    <tr>
      <th class="bg-night-dark" width="10%">No</th>
      <th class="bg-night-dark">Product</th>
      <th class="bg-night-dark" width="20%">Harga <font style="font-size:9px;">(Rp)</font></th>
      <th class="bg-night-dark" width="10%">Stok</th>
      <th class="bg-night-dark" width="10%">-</th>
    </tr>

    <?php
      foreach ($data as $key => $produk) {
    ?>

    <tr>
      <td>
        <a href="#" data-accordion="accordion-<?=$key?>" style="color:#666;" title="Detail">
          <?=$key+1?>
        </a>
      </td>
      <td>
        <a href="#" data-accordion="accordion-<?=$key?>" style="color:#666;" title="Detail">
          <?=$produk->nama_product?>
        </a>
      </td>
      <td>
        <a href="#" data-accordion="accordion-<?=$key?>" style="color:#666;" title="Detail">
          <?=rupiah($produk->harga_product)?>
        </a>
      </td>
      <td>
        <a href="#" data-accordion="accordion-<?=$key?>" style="color:#666;" title="Detail">
          <?=$produk->jumlah_product?>
        </a>
      </td>
      <td>
        <a href="#" data-accordion="accordion-<?=$key?>" class="color-blue-light bold" title="Detail">
          <span class="fa fa-tasks"></span>
        </a>
      </td>
    </tr>
    <tr class="accordion-content" id="accordion-<?=$key?>">
      <td colspan="5" style="padding:10px;">
        <p class="bottom-0 left-text left-15" style="background:whitesmoke!important;padding:10px;">
          - <?php $produk->detail_product ?>
        </p>

        <div class="decoration decoration-margins top-10"></div>
        <div class="content demo-buttons">
          <a href="<?=base_url()?>product/ubah" class="button button-xs button-full button-round button-orange">
              <i class="fa fa-edit"></i> Ubah Produk
          </a>
        </div>
      </td>
    </tr>

    <?php } ?>


  </table>
</div>
