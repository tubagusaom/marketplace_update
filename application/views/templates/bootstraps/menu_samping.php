<div class="side-block">
  <h4><i class="fa fa-bars"></i> KATEGORI</h4>
  <ul class="category-list">

    <?php
      foreach ($kategori as $key_k => $kategori_s) {
    ?>
    <li>
      <a href="<?=base_url().'f/'.$kategori_s->kategori?>"><?=$kategori_s->kategori?></a>
      <a href="#" class="plus"></a>

      <ul>
        <?php
          foreach ($sub_kategori as $key_k => $sub_kategori_s) {
            if ($sub_kategori_s->id_kategori == $kategori_s->id) {
        ?>
        <li>
          <a href="<?=base_url().'f/'.$kategori_s->kategori.'/'.$sub_kategori_s->sub_kategori ?>">
            <?=$sub_kategori_s->sub_kategori?>
          </a>

        </li>
        <?php }} ?>
      </ul>

    </li>
    <?php } ?>

  </ul>
</div>
