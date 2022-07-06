<style media="screen">

	.scrollmenu {
		overflow-x: auto;
		overflow-y: hidden;
		white-space: nowrap;
	}

</style>

<div class="header-container header-nav">
	<div class="container">
		<div class="header-nav-main">
			<nav class="">
				<ul class="nav nav-pills" id="mainNav">
					<!-- <li class="active">
						<a href="<?=base_url()?>">
							<i class="fa fa-home"></i> Home
						</a>
					</li> -->

					<?php
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

					<?php } ?>







					<!-- <li class="dropdown dropdown-full-color dropdown-primary">
						<a class="dropdown-toggle" href="#"> Menuxxx </a>
						<ul class="dropdown-menu">
								<li class="dropdown-submenu">
									<a href="#"> Kategorixxx </a>

										<ul class="dropdown-menu">
												<li>
													<a href="#">
														Sub Kategori
													</a>
												</li>
										</ul>
								</li>
						</ul>
					</li> -->

					<?php // $divmenu ?>




					<?php
						// foreach ($menu_join as $key => $menu_join) {
					?>

					<!-- <li class="dropdown dropdown-full-color dropdown-primary">
						<a class="dropdown-toggle" href="<?=base_url().'f/'.$menu_join->menu_kategori?>">
							<?=$menu_join->menu_kategori?>
						</a>

						<ul class="dropdown-menu">
							<li class="dropdown-submenu">
								<a href="<?=base_url().'f/'.$menu_join->menu_kategori.'/'.$menu_join->kategori ?>">
									<?=$menu_join->kategori?>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">sub sub kategori</a></li>
								</ul>
							</li>
						</ul>

					</li> -->

					<?php
						// }
					?>




					<!-- <li class="pull-right">
						<a href="https://homedepo.co.id" target="_blank">
							Tentang Kami
							<span class="tip tip-hot">Hot!</span>
						</a>
					</li> -->

				</ul>
			</nav>
		</div>
	</div>
</div>
