<?php
  if ($data->id_kategori==4) {
?>

<aside class="sidebar">
    <h4 class="heading-primary">Berita Lainnya</h4>
    <ul class="list list-icons list-primary list-side-borders mt-xlg">
      <?php foreach ($berita_lsp_lainnya as $key=>$value) { ?>
        <li>
          <a href="<?=base_url()."profile/index/".$value->id?>" >
            <img  class="img-thumbnail "  src="<?=base_url() . 'assets/files/artikel/' . $value->foto ?>"  style="min-height: 40px;min-width:30%;"/>
            <br> <?=$value->judul ?>
          </a>
        </li>
      <?php } ?>
    </ul>
</aside>

<?php
  }else {
?>

        <aside class="sidebar">
            <h4 class="heading-primary">Profil LSP</h4>
            <ul class="list list-icons list-primary list-side-borders mt-xlg">
                <li><i class="fa fa-check"></i> <a href="<?=base_url();?>profile/index/7/sejarah" > Sejarah</a></li>
                <li><i class="fa fa-check"></i> <a href="<?=base_url();?>profile/index/8/visi-misi" > Visi & Misi</a></li>
                <li><i class="fa fa-check"></i> <a href="<?=base_url();?>profile/index/12/ruang-lingkup"> Ruang Lingkup</a></li>
                <li><i class="fa fa-check"></i> <a href="<?=base_url();?>profile/index/32/dasar-hukum"> Dasar Hukum</a></li>
            </ul>
        </aside>

<?php } ?>
