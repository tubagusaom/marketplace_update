<div class="mobile-nav">
	<div class="mobile-nav-wrapper">
		<ul class="mobile-side-menu">
			<li>
        <a href="<?=base_url()?>/buyer">Biodata Diri</a>
      </li>
      </li>

      <li>
        <a href="<?=base_url()?>/buyer/rincian_transaksi">Transaksi</a>
      </li>

			<!-- <?php
				foreach ($menu as $key => $menus) {
			?>

			<li>
				<span class="mmenu-toggle"></span>
				<a href="<?=base_url().'f/'.$menus->menu_kategori.'/'.$menus->id?>">
					<?=$menus->menu_kategori?>
				</a>

				<ul>

					<?php
						foreach ($kategori as $keyk => $datakategoris) {
							if ($datakategoris->id_menu == $menus->id) {
					?>

					<li>
						<span class="mmenu-toggle"></span>
						<a href="<?=base_url().'f/'.$menus->menu_kategori.'/'.$menus->id.'/'.$datakategoris->kategori.'/'.$datakategoris->id ?>">
							<?=$datakategoris->kategori?>
						</a>
						<ul>

							<?php
								foreach ($sub_kategori as $keysks => $data_sub_kategoris) {
									if ($data_sub_kategoris->id_kategori == $datakategoris->id) {
							?>

							<li>
								<a href="<?=base_url().'f/'.$menus->menu_kategori.'/'.$menus->id.'/'.$datakategoris->kategori.'/'.$datakategoris->id.'/'.$data_sub_kategoris->sub_kategori.'/'.$data_sub_kategoris->id ?>">
									<?=$data_sub_kategoris->sub_kategori?>
								</a>
							</li>

							<?php }} ?>

						</ul>
					</li>

					<?php }} ?>

				</ul>
			</li>

			<?php } ?> -->

			<!-- <li>
				<a href="demo-shop-8-contact-us.html">Contact Us</a>
			</li> -->

		</ul>
	</div>
</div>

<div id="mobile-menu-overlay"></div>
