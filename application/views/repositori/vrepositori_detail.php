<style type="text/css">
    a {
        text-decoration: none;
    }
   
</style>
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li class="active">Download Kategori</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1><?php
                    echo $data->judul;
                    ?></h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">

    <div class="row">
    <div class="col-md-9 well well-sm">
                <b><h3><?=$data->nama_dokumen?></h3></b>
                <?php if($data->img_cover != "0"){?><br />
                <img src="<?=base_url().'assets/files/repositori/'.$data->img_cover?>" width="350" height="300"><br /><?php } ?>

                <label style="font-size: 10px;font-weight: normal;"><?=$data->description?></label>

                <br />
                <ul class="list-inline list-unstyled">
                    <li><span><i class="glyphicon glyphicon-calendar"></i> <?=tgl_indo($data->created_when)?> </span></li>
                    <li>|</li>
                    <span><i class="glyphicon glyphicon-download"></i> <?=$data->jumlah_download?></span>
                     <li>|</li>
                     <li><?=$data->extension?></li>
                    </ul>
                

                <a href=" <?=base_url().'repositori/klik_download/'.$data->id?>" class="btn btn-success btn-sm">
                    <span class="glyphicon glyphicon-download"></span> Download
                  </a>

                
               </div>    
    </div>

    <div class="col-md-3">
      <?php $this->load->view('profile/left_menu_profile'); ?>
    </div>
    </div>

</div>