<div class="pageSection container-fluid-full">
	<div class="bannerPage container">
        <img class="img-thumbnail" src="<?=base_url().'assets/img/spa.png'?>">
    </div>
	<div class="container" style="margin-top: 15px;"></div>
	<div class="bannerPage container">
	<div class="col-md-12 well" style="background-color: #FFFFFF;">
	<div class="col-md-3">
		<?php $this->load->view('sertifikasi/left_menu_sertifikasi');?>
	</div>
	<div class="col-md-9">
		<ol class="breadcrumb well well-sm">
    		<li><a href="<?=base_url()?>">Home</a></li>
    		<li class="active"><?=$data->judul?></li>
    	</ol>
    	<h2>
                <?php
                    $judul = isset($data->judul) ? $data->judul : 'LSP Cohespa';
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
                if ($data->show_image == '1') {
                    if ($data->foto != '') {
                        $gambar_db = isset($data->foto) ? $data->foto : '';
                        if ($gambar_db == "") {
                            $gambar = base_url().'assets/img/images.jpg';
                        } else {
                            $gambar = base_url().'assets/files/artikel/'.$data->foto;
                        }
                        echo '<img  width="100%" class="img-thumbnail"  src="' . $gambar . '"  />';
                    }
                }
                ?>
                  <?php
                  echo $data->isi ; 
                  ?>
                <hr />
                <div class="col-md-12" style="margin: 0px;"><h4>Artikel / Berita Lainnya</h4>
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
