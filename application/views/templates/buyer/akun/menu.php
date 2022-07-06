<div class="header-container header-nav">
	<div class="container">
		<div class="header-nav-main">
			<nav>
				<ul class="nav nav-pills" id="mainNav">

					<li class="<?= $this->uri->segment(1) == 'buyer' && $this->uri->segment(2) == '' ? 'active' : '' ?>">
						<a href="<?=base_url()?>buyer">
							Biodata Diri
						</a>
					</li>

          <li class="<?= $this->uri->segment(1) == 'buyer' && $this->uri->segment(2) == 'rincian_transaksi' ? 'active' : '' ?>">
						<a href="<?=base_url()?>buyer/rincian_transaksi">
							Transaksi
						</a>
					</li>

					<!-- <?php
						foreach ($menu as $key => $menu) {
					?>

					<li class="dropdown dropdown-full-color dropdown-primary <?= $this->uri->segment(3) == $menu->id ? 'active' : '' ?>">
						<a class="dropdown-toggle" href="<?=base_url().'f/'.$menu->menu_kategori.'/'.$menu->id?>">
							<?=$menu->menu_kategori?>
						</a>

						<ul class="dropdown-menu">

							<?php
								foreach ($kategori as $keyk => $datakategori) {
									if ($datakategori->id_menu == $menu->id) {
							?>

								<li class="dropdown-submenu <?= $this->uri->segment(5) == $datakategori->id ? 'active' : '' ?>">
									<a href="<?=base_url().'f/'.$menu->menu_kategori.'/'.$menu->id.'/'.$datakategori->kategori.'/'.$datakategori->id ?>">
										<?=$datakategori->kategori?>
									</a>


										<ul class="dropdown-menu">
											<?php
												foreach ($sub_kategori as $keysk => $data_sub_kategori) {
													if ($data_sub_kategori->id_kategori == $datakategori->id) {
											?>
												<li class="<?= $this->uri->segment(7) == $data_sub_kategori->id ? 'active' : '' ?>">
													<a href="<?=base_url().'f/'.$menu->menu_kategori.'/'.$menu->id.'/'.$datakategori->kategori.'/'.$datakategori->id.'/'.$data_sub_kategori->sub_kategori.'/'.$data_sub_kategori->id ?>">
														<?=$data_sub_kategori->sub_kategori?>
													</a>
												</li>
											<?php }} ?>
										</ul>

								</li>

							<?php }} ?>

						</ul>

					</li>

					<?php } ?> -->

				</ul>
			</nav>
		</div>
	</div>
</div>
