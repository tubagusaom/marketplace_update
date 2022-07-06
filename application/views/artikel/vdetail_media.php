<style>
div.img {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 188px;
    
}

div.img:hover {
    border: 1px solid #777;
}

div.img img {
    width: 100%;
    height: auto;
}

div.desc {
    padding: 15px;
    text-align: center;
}
</style>


<div class="pageSection container-fluid-full" >
	<div class="bannerPage container">
		<img class="img-thumbnail" src="<?=base_url().'assets/img/spa7.jpg'?>">
	</div>
<div class="container" style="margin-top: 15px;"></div>
<div class="banner container">
	<div class="col-md-12 well" style="background-color: #FFFFFF;">
		<div class="col-md-3">
			<?php $this->load->view('artikel/left_menu_artikel');?>
		</div>
		<div class="col-md-9">
			<ol class="breadcrumb well well-sm" style="color: white;" >
				<li><a href="<?=base_url()?>">Home</a></li>
				<li class="active"><?=$data->judul?></li>
			</ol>
			<h2 class="blueText">
					<?php
						$judul = isset($data->judul) ? $data->judul : 'LSP COHESPA';
						echo $judul;
					?>
			  </h2>
			  <div >
				<i class="fa fa-calendar"></i> <?php echo tgl_indo($data->tanggal_buat) ?> /
				<i class="fa fa-user"></i> admin
			  </div>

			  <div style="margin-top: 15px;"></div>
			  
			  <?php
                  //var_dump($data->foto);
                  //if($data->status_image !=0){
/*                if ($data->show_image == '1') {
                    if ($data->foto != '') {
                        $gambar_db = isset($data->foto) ? $data->foto : '';
                        if ($gambar_db == "") {
                            $gambar = base_url().'assets/img/images.jpg';
                        } else {
                            $gambar = base_url().'assets/files/artikel/'.$data->foto;
                        }?>
						<div class="">
						<?php
                        echo '<img style="width:500px; height: 300px;" class="img-thumbnail img-responsive"  src="' . $gambar . '"  />';
                    }
                }*/
                ?>
			  
			  </div>
			<div class="font-weight: bold;">		
						
				<?php
				echo "Berikut ini adalah foto-foto kegiatan ".$data->nama_album ; 
				?>
			</div>

	 	<section class="mainContent clearfix">
        <div class="row" style="color: white; font-weight: bold;">
			<?php
				foreach($galeri as $galeri){
			?>	
         
          <div class="benefit col-sm-4 panel-image">
            <div class="item greenBox thumbnail text-center" style="background-color: green;">

					<img width="85%;" src="<?=base_url().'assets/files/artikel/'.$galeri->foto;?>" class="hidden-sm img-thumbnail img-responsive">
					<h4><?php echo $galeri->nama_album; ?></h4>
					<p><?php strip_tags($galeri->headline); ?></p>
            </div>
          </div>
			<?php
				}
			?> 
        </div>
     	</section>
			  
			  
			<hr />
			<div class="col-md-12 clearfix" style="margin: 0px; display:block;"><h4>Artikel / Berita Lainnya</h4>
			<ul>
				<?php
					foreach($berita_lainnya as $value){
						echo "<li><a href='".base_url()."profile/index/".$value->id.".html'>".strip_tags($value->headline)."</a></li>";
					}
				?>
			</ul>  <hr /></div>
			
					 <div class="col-md-4 list_bottom" style="margin: 0px;"><h4>Tautan Populer</h4>
			<ul >
				<?php foreach ($link_populer as $key => $value) {
				?>
					<a target="<?=$value->target?>" href="<?=$value->link?>"><li class="link_terkait"><?=$value->title?></li></a>
				<?php
				}
				?>
			</ul>
			 </div>
					<div class="col-md-4 list_bottom" style="margin: 0px;"><h4>Lembaga Pendukung</h4>
			<ul >
				<?php foreach ($lembaga_terkait as $key => $value) {
				?>
					<a target="_blank" href="<?=$value->link?>"><li class="link_terkait"><?=$value->title?></li></a>
				<?php
				}
				?>
			</ul>
				  </div> 
			<div class="col-md-4 list_bottom" style="margin: 0px;"><h4>LSP Jejaring</h4>
			<ul >
				<?php foreach ($lsp_jejaring as $key => $value) {
				?>
					<a target="<?=$value->target?>" href="<?=$value->link?>"><li class="link_terkait"><?=$value->title?></li></a>
				<?php
				}
				?>
			</ul>
			</div>
		</div>
</div>
</div>
</div>
