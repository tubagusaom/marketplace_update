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
<div class="pageSection container-fluid-full">
	<div class="bannerPage container">
		<img class="img-thumbnail" src="<?=base_url().'assets/img/spa2.jpg'?>">
	</div>
	<div class="container" style="margin-top: 15px;"></div>
	<div class="bannerPage container">
	<div class="col-md-12 well" style="background-color: #FFFFFF;">
	<div class="row">
    <div class="col-md-2">
        <?php
            $this->load->view('templates/bootstraps/left_menu');
        ?>
    </div>
    <div class="col-md-10">
        <div class="col-md-12">
       	<ol class="breadcrumb well well-sm">
    		<li><a href="<?=base_url()?>">Home</a></li>
    		<li class="active">Link Terkait</li>
    	</ol>
        </div>
        <div class="col-md-12">
        <h3>Link Terkait</h3>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Organization Name</th>
                    <th>Description</th>
                    <th>URL</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>BNSP</td>
                    <td>Badan Nasional Sertifikasi Profesi</td>
                    <td><a target="_blank" href="http://www.bnsp.go.id">http://www.bnsp.go.id</a></td>
                  </tr>
                  <tr>
                    <td>LSP TA</td>
                    <td>LSP Teknisi Akuntansi</td>
                    <td><a target="_blank" href="http://www.lspteknisiakuntansi.or.id">http://www.lspteknisiakuntansi.or.id</a></td>
                  </tr>
                  <tr>
                    <td>LSP Cohespa</td>
                    <td>LSP Cohespa</td>
                    <td><a target="_blank" href="http://www.lspcohespa.org">http://www.lspcohespa.org</a></td>
                  </tr>
                  <tr>
                    <td>LSP Geomatika</td>
                    <td>LSP Geomatika</td>
                    <td><a target="_blank" href="http://www.lspgeomatika.or.id">http://www.lspgeomatika.or.id</a></td>
                  </tr>
                  <tr>
                    <td>LSP Komputer</td>
                    <td>LSP Komputer</td>
                    <td><a target="_blank" href="http://www.lspkomputer.id">http://www.lspkomputer.id</a></td>
                  </tr>
                </tbody>
              </table>

           
        </div>
 </div>
    </div>
    </div>
	</div>
</div>
