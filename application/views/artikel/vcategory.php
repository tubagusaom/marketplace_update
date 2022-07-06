<style type="text/css">
  .cuadro_intro_hover{
	padding: 0px;
    position: relative;
    overflow: hidden;
    height: 200px;
  }
  .cuadro_intro_hover:hover .caption{
    opacity: 1;
    transform: translateY(-150px);
    -webkit-transform:translateY(-150px);
    -moz-transform:translateY(-150px);
    -ms-transform:translateY(-150px);
    -o-transform:translateY(-150px);
  }
  .cuadro_intro_hover img{
    z-index: 4;
  }
  .cuadro_intro_hover .caption{
    position: absolute;
    top:150px;
    -webkit-transition:all 0.3s ease-in-out;
    -moz-transition:all 0.3s ease-in-out;
    -o-transition:all 0.3s ease-in-out;
    -ms-transition:all 0.3s ease-in-out;
    transition:all 0.3s ease-in-out;
    width: 100%;
  }
  .cuadro_intro_hover .blur{
    background-color: rgba(0,0,0,0.7);
    height: 300px;
    z-index: 5;
    position: absolute;
    width: 100%;
  }
  .cuadro_intro_hover .caption-text{
    z-index: 10;
    color: #fff;
    position: absolute;
    height: 300px;
    text-align: center;
    top:-20px;
    width: 100%;
  }
</style>
<div class="pageSection container-fluid-full" >
	<div class="bannerPage container">
		<img class="img-thumbnail" src="<?=base_url().'assets/files/artikel/'.$berita_lsp->foto;?>">
	</div>
	<div class="container" style="margin-top: 15px;"></div>
	<div class="bannerPage container">
	  <div class="col-md-12 well" style="background-color: #FFFFFF;">
	  <div class="col-md-3 clearfix">
		  <?php $this->load->view('artikel/left_menu_artikel');?>
		  <div class="row">
			<div class="cuadro_intro_hover ">
			<p style="text-align:center; margin-top:20px;">
			  <img src="<?=base_url().'assets/files/artikel/'.$berita_bnsp->foto;?>" class="img-responsive" alt="">
			</p>
			<div class="caption">
			  <div class="blur"></div>
			  <div class="caption-text">
				<h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Berita LSP</h3>
				<p><?=$berita_bnsp->judul?></p>
				<a class=" btn btn-default" href="<?=base_url().'profile/index/'.$berita_bnsp->id?>"><span class="glyphicon glyphicon-plus"> Detail</span></a>
			  </div>
			</div>
			</div>
		  </div>
	  </div>
	  <div class="col-md-9 clearfix">
		<ol class="breadcrumb well well-sm">
			<li><a href="<?=base_url()?>">Home</a></li>
			<li class="active">Berita LSP</li>
		</ol>
		<div class="col-lg-13">
		<div class="col-lg-8">
            <img class="img-thumbnail" src="<?=base_url().'assets/img/spa2.jpg'?>">
            <!--<img class="img-thumbnail" src="<?//=base_url().'assets/files/artikel/'.$berita_lsp->foto;?>">-->
        </div>
		<div class="col-lg-4"> 
		<h5 style="font-weight: bold;"><?=$berita_lsp->judul?></h5>
		<p><?=$berita_lsp->isi?></p>
		</div>
		</div>
		  <div class="col-md-12">
		  <hr style="" size="3" />
		  </div>
		  
		  <div class="col-md-12">
			<div class="col-md-6">
				  <h3>Tautan Populer:</h3>
							<ul>
					<li><a href=""><i class="fa fa-globe"></i> Uji Online</a></li>
					<li><a href=""><i class="fa fa-file"></i> Skema LSP</a></li>
					<li><a href=""><i class="fa fa-book"></i> SKKNI</a></li>
					<li><a href=""><i class="fa fa-book"></i> Download</a></li>
					<li><a href=""><i class="fa fa-book"></i> Berita BNSP</a></li>
					<li><a href=""><i class="fa fa-book"></i> Knowledge Base</a></li>
					<li><a href=""><i class="fa fa-book"></i> FAQ</a></li>
					</ul>
				</div>

				<div class="col-md-6">
					<h3>Kontak:</h3>
					<p>Ada pertanyaan atau saran yang membangun? Kontak Kami!</p>
					<p><a href="<?=base_url().'kontak/index'?>" title="Contact me!"><i class="fa fa-envelope"></i> Kontak</a></p>
					<h3>Follow:</h3>
					<a href="" id="gh" target="_blank" title="Twitter"><span class="fa-stack fa-lg">
					  <i class="fa fa-square-o fa-stack-2x"></i>
					  <i class="fa fa-twitter fa-stack-1x"></i>
					</span>
					Twitter</a>
					<a href=""  target="_blank" title="GitHub"><span class="fa-stack fa-lg">
					  <i class="fa fa-square-o fa-stack-2x"></i>
					  <i class="fa fa-github fa-stack-1x"></i>
					</span>
					GitHub</a>
				</div>
		  </div>
</div>
	  </div>
	</div>
</div>

