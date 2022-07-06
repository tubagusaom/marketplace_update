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
			<li class="active">Galeri Video</li>
		</ol>
                <?php $this->load->view('galeri/vdetail'); ?>

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
<script>
    //===============http://kutubaru.blogspot.co.id/2015/03/responsive-photo-galeri-bootstrap.html=======
    // Untuk menjalankan lightbox atau modal
    $(document).ready(function(){
    $('li img').on('click',function(){
    var src = $(this).attr('src');
    var img = '<img src="' + src + '" class="img-responsive"/>';
    
    //Show
    var index = $(this).parent('li').index();
    
    var html = '';
    html += img;
    html += '<div style="height:25px;clear:both;display:block;">';
    html += '<a class="controls next" href="'+ (index+2) + '">next &raquo;</a>';
    html += '<a class="controls previous" href="' + (index) + '">&laquo; prev</a>';
    html += '</div>';
    
    $('#KutubaruModal').modal();
    $('#KutubaruModal').on('shown.bs.modal', function(){
    $('#KutubaruModal .modal-body').html(html);
    
    //new code
    $('a.controls').trigger('click');
    })
    $('#KutubaruModal').on('hidden.bs.modal', function(){
    $('#KutubaruModal .modal-body').html('');
    });
    });
    })
    
    //button controls
    $(document).on('click', 'a.controls', function(){
    var index = $(this).attr('href');
    var src = $('ul.row li:nth-child('+ index +') img').attr('src');
    $('.modal-body img').attr('src', src);
    var newPrevIndex = parseInt(index) - 1;
    var newNextIndex = parseInt(newPrevIndex) + 2;
    if($(this).hasClass('previous')){
    $(this).attr('href', newPrevIndex);
    $('a.next').attr('href', newNextIndex);
    }else{
    $(this).attr('href', newNextIndex);
    $('a.previous').attr('href', newPrevIndex);
    }
    var total = $('ul.row li').length + 1;
    
    //hide next button
    if(total === newNextIndex){
    $('a.next').hide();
    }else{
    $('a.next').show()
    }
    
    //hide previous button
    if(newPrevIndex === 0){
    $('a.previous').hide();
    }else{
    $('a.previous').show()
    }
    return false;
    });
</script>