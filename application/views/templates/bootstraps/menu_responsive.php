<style media="screen">
	.activetb{
		color: #db0c13!important;
	}

	.menuhome{
		padding: 15px 0;
    background-color: #db0c13;
    border-bottom: none;
		text-align: center;
		margin-bottom: 20px;
	}
	.menuhome a{
		color: #fff;
		text-decoration: none;
	}
	

</style>

<div class="mobile-nav">

	<div class="menuhome">
		<a href="<?=base_url()?>">
			<!-- <i class="fa fa-home"></i> -->
			HOME DEPO
		</a>
	</div>

	<div class="mobile-nav-wrapper">
		<ul class="mobile-side-menu">
			<!-- <li>
				<a href="<?=base_url()?>">
					<i class="fa fa-home"></i>
					Beranda
				</a>
			</li> -->

			<?php
				foreach ($menu as $key => $menus) {
			?>

			<li>
				<span class="mmenu-toggle"></span>
				<a href="<?=base_url().'f/'.$menus->menu_kategori.'/'.$menus->id?>" class="<?= $this->uri->segment(3) == $menus->id ? 'activetb' : '' ?>">
					<?=$menus->menu_kategori?>
				</a>

				<ul>

					<?php
						foreach ($kategori as $keyk => $datakategoris) {
							if ($datakategoris->id_menu == $menus->id) {
					?>

					<li>
						<span class="mmenu-toggle"></span>
						<a href="<?=base_url().'f/'.$menus->menu_kategori.'/'.$menus->id.'/'.$datakategoris->kategori.'/'.$datakategoris->id ?>" class="<?= $this->uri->segment(5) == $datakategoris->id ? 'activetb' : '' ?>">
							<?=$datakategoris->kategori?>
						</a>
						<ul>

							<?php
								foreach ($sub_kategori as $keysks => $data_sub_kategoris) {
									if ($data_sub_kategoris->id_kategori == $datakategoris->id) {
							?>

							<li>
								<a href="<?=base_url().'f/'.$menus->menu_kategori.'/'.$menus->id.'/'.$datakategoris->kategori.'/'.$datakategoris->id.'/'.$data_sub_kategoris->sub_kategori.'/'.$data_sub_kategoris->id ?>" class="<?= $this->uri->segment(7) == $data_sub_kategoris->id ? 'activetb' : '' ?>">
									<?=$data_sub_kategoris->sub_kategori?>
								</a>
							</li>

							<?php }} ?>

						</ul>
					</li>

					<?php }} ?>

				</ul>
			</li>

			<?php } ?>

			<li>
				<span class="mmenu-toggle" style="margin-top:100px;"></span>
				<a href="#" style="padding-top:100px;">Hubungi Kami</a>
				<!-- </span> -->
				<ul>
					<a class="a-tb-wa" href="https://api.whatsapp.com/send?phone=6287814091972&text=Hai%20Homemin ,%20tolong%20bantu%20saya :)" target="_blank" title="WA">
						<i class="fa fa-whatsapp"></i> +62 878-1409-1972
					</a>
				</ul>

				<ul>
					<a class="a-tb-wa" href="https://api.whatsapp.com/send?phone=6281230222470&text=Hai%20Homemin ,%20tolong%20bantu%20saya :)" target="_blank" title="WA">
						<i class="fa fa-whatsapp"></i> +62 812-3022-2470
					</a>
				</ul>
				<ul>
					<a href="https://homedepo.co.id" target="_blank" style="font-size:12px;color:#ff8589;">
						<i class="fa fa-globe"></i> TENTANG KAMI
					</a>
				</ul>
			</li>

		</ul>
	</div>
</div>

<div id="mobile-menu-overlay"></div>
