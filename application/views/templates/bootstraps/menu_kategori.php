<style media="screen">

	.scrollmenu {
		overflow-x: auto;
		overflow-y: hidden;
		white-space: nowrap;
	}

	.header-menutb a{
		padding: 0 0 3px 0;
		color: #fff;
	}

	.mmenu-toggle-btn {
		float: left;
	}

	#header .header-search{
		float: right;
	}
	#header .header-search a{
		color: #fff;
	}

	 /* @media (min-width: 992px) {
		 .mmenu-toggle-btn {
			 float: right;
		 }
	 }

	 @media (max-width: 992px) {
		 .mmenu-toggle-btn {
			 float: left;
		 }
	 } */

</style>

<div class="header-container header-nav">
	<div class="container">

		<div class="col-md-12">

			<div class="header-search">
				<a href="#" class="search-toggle" style="text-decoration:none;">
					<i class="fa fa-search"></i> Cari
				</a>
				<form action="<?=base_url()?>search/show/" method="GET">

					<div class="header-search-wrapper">

						<input type="text" class="form-control" name="q" id="Qword" placeholder="Pencarian..." required>
						<input type="hidden" name="rftb" value="true">
						<!-- <input type="hidden" name="srp_component_id" value=""> -->

						<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>

					</div>

				</form>
			</div>

			<div class="header-menutb">
				<a href="#" class="mmenu-toggle-btn" title="Toggle menu">
					<i class="fa fa-bars"></i> Kategori
				</a>
			</div>



		</div>

	</div>
</div>
