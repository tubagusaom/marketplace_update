<style>
.nav-sidebar { 
    width: 100%;
    padding: 8px 0; 
    border-right: 1px solid #ddd;
}
.nav-sidebar a {
    color: #333;
    -webkit-transition: all 0.08s linear;
    -moz-transition: all 0.08s linear;
    -o-transition: all 0.08s linear;
    transition: all 0.08s linear;
    border-radius: 0; 
}
.nav-sidebar .active a { 
    cursor: default;
    background-color: #428bca; 
    color: #fff;
    text-shadow: 1px 1px 1px #666; 
}
.nav-sidebar .active a:hover {
    background-color: #428bca;   
}
.nav-sidebar .text-overflow a,
.nav-sidebar .text-overflow .media-body {
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis; 
}
.box-categories .fa-ul > li > * {
    line-height: inherit;
    margin: 0;
}
</style>
<div class="container">
	<div class="row">
    <div class="col-md-2">
        <?php
            $this->load->view('templates/bootstraps/left_menu');
        ?>
    </div>
    <div class="col-md-10" style="padding-top: 15px;">
            <div class="col-md-8">
                <h2>Alamat Website Pendaftaran Online Uji Kompetensi</h2>
                <p>
                    Untuk dapat mengakses aplikasi uji kompetensi online, anda dapat mengakses di http://www.online.lspteknisiakuntansi.or.id
                    dan klik tombol pendaftaran uji kompetensi pada pojok kanan atas
                </p>
                <a target="_blank" class="btn btn-success btn-sm" href="http://data.bnsp.go.id/public.php?service=files&t=b4c5b26ad2768cf285c017f0afef46a9">
                    <i class="fa fa-file-text-o"></i>
                       Download Manual
                    </a>
                <a target="_blank" class="btn btn-success btn-sm" href="http://data.bnsp.go.id/public.php?service=files&t=74683c65729f313347bed9fe96c6ae27">
                    <i class="fa fa-youtube-play"></i>
                       Video Tutorial
                    </a>
            </div>
	       <div class="col-md-4">
                <section class="box-categories well">
                    <h1 class="section-title h4 clearfix">
                    <i class="line"></i>
                    <i class="fa fa-folder-open-o fa-fw text-muted"></i>
                    <small class="pull-right">
                    <i class="fa fa-hdd-o fa-fw"></i>
                    6
                    </small>
                    Pendaftaran Uji
                    </h1>
                    <ul class="fa-ul">
                        <li>
                        <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                        <h3 class="h5">
                        <a href="<?=base_url().'welcome/tutorial/1'?>">Alamat website pendaftaran</a>
                        </h3>
                        </li>
                        <li>
                        <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                        <h3 class="h5">
                        <a href="<?=base_url().'welcome/tutorial/2'?>">Pengisian Apl 01 & 02</a>
                        </h3>
                        </li>
                        <li>
                        <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                        <h3 class="h5">
                        <a href="#">Akses Login calon peserta  uji kompetensi</a>
                        </h3>
                        </li>
                        </ul>
                        <p class="more-link text-center">
                        <a class="btn btn-custom btn-xs" href="#">View All</a>
                        </p>
                    
                </section>
            </div>	
            
    </div>
	</div>
</div>