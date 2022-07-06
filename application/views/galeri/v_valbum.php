<div class="pageSection container-fluid-full" >
	<div class="bannerPage container">
		<img class="img-thumbnail" src="<?=base_url().'assets/files/artikel/218870268slide1.jpg'?>">
	</div>
	<div class="container" style="margin-top: 15px;"></div>
<div class="banner container">
	<div class="col-md-12 well" style="background-color: #FFFFFF;">
	 <div class="col-md-3">
        	<?php $this->load->view('artikel/left_menu_artikel');?>
        </div>
        <div class="col-md-9">
			<ol class="breadcrumb well well-sm">
			<li><a href="<?=base_url()?>">Home</a></li>
			<li class="active">Berita LSP</li>
		</ol>
            <?php foreach($value as $row){ ?>
            <div class="col-md-4" style="padding: 3px;">
				<div class="panel panel-default">
            <div class="panel-image">
			     <a class="thumbnail" href="<?php echo base_url().'album_galeri/galeri_video/'.$row->id ?>">
				<div class="panel-image hide-panel-body">
                    <img class="panel-title" src="<?php echo base_url()."uploads/favicon.ico"?>" alt="sertifikasi" class="panel-image-preview" /><b style="font-size:10px;"><?php echo $row->nama_album ?></b>
				</div>
				</a>
				
				<div class="panel-body text-center">
                    <p style="padding-bottom: 0px;font-size:10px"><?php echo $row->keterangan ?></p>
                
				</div>
				
            </div>
			</div>
			</div>
            <?php } ?>
            <div class="col-md-12" style="margin: 0px;"><h4>Artikel / Berita Lainnya</h4>
                    <ul>
                        <?php
                            foreach($berita_lainnya as $value){
                                echo "<li><a href='".base_url()."profile/index/".$value->id.".html'>".strip_tags($value->headline)."</a></li>";
                            }
                        ?>
                    </ul>  
                    <hr />
                </div>
                
                <div class="col-md-4 list_bottom" style="margin: 0px;"><h4>Tautan Populer</h4>
                    <ul>
                        <a target="_blank" href="http://www.bnsp.go.id"><li>BNSP</li></a>
                        <a target="_blank" href="http://www.online.lspteknisiakuntansi.or.id"><li>Pendaftaran Online</li></a>
                        <a target="_blank" href="<?=base_url().'kontak/index'?>"><li>Kontak LSP</li></a>
                        
                    </ul>  
                </div>
               <div class="col-md-4 list_bottom" style="margin: 0px;"><h4>Lembaga Pendukung</h4>
                <ul>
                    <a target="_blank" href="http://www.bnsp.go.id"><li>BNSP</li></a>
                    <a target="_blank" href="http://www.kemdikbud.go.id"><li>KEMNDIKBUD</li></a>
                    <a target="_blank" href="http://ristekdikti.go.id"><li>KEMRISTEK DIKTI</li></a>
                    <a target="_blank" href="http://www.pu.go.id"><li>KEMENTRIAN PUPR</li></a>
                    <a target="_blank" href="http://www.bpn.go.id"><li>KEMENTRIAN ATR</li></a>
					<a target="_blank" href="http://www.kemenkeu.go.id"><li>KEMENKEU</li></a>
                </ul>  </div> 
                <div class="col-md-4 list_bottom" style="margin: 0px;"><h4>LSP Jejaring</h4>
                    <ul>
                        <a target="_blank" href="http://www.lspteknisiakuntansi.or.id"><li>LSP Teknisi Akuntansi</li></a>
                        <a target="_blank" href="http://www.lsp-abi.org"><li>LSP Alat Berat Indonesia</li></a>
                        <a target="_blank" href="http://www.lspgeomatika.or.id"><li>LSP Geomatika</li></a>
                        <a target="_blank" href="http://www.lspkomputer.id"><li>LSP Komputer</li></a>
                        <a target="_blank" href="http://www.lsp-migas.org"><li>LSP Migas</li></a>
                        <a target="_blank" href="http://www.lspmsdm.org"><li>LSP MSDMI</li></a>
                    </ul> 
                </div>
				</div>
		</div>
	</div>
</div>
        