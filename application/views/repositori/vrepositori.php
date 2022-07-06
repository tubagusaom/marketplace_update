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
    <div class="col-md-9">
      <?php 
             
            foreach($data as $key=>$value){
                if($value)
            ?>
                <div class="col-md-12 well well-sm">
                <div class="col-md-9">
                <b><?=$value->nama_dokumen?></b><br /><label style="font-size: 10px;font-weight: normal;"><?=$value->summary?></label>
                <br />
                <ul class="list-inline list-unstyled">
                    <li><span><i class="glyphicon glyphicon-calendar"></i> <?=tgl_indo($value->created_when)?> </span></li>
                    <li>|</li>
                    <span><i class="glyphicon glyphicon-download"></i> <?=$value->jumlah_download?></span>
                     <li>|</li>
                     <li><?=$value->extension?></li>
                    </ul>
                
                </div>
                <div class="col-md-3">
                <a href=" <?=base_url().'repositori/vdetail_download/'.$value->id?>" class="btn btn-success btn-sm">
                    <span class="glyphicon glyphicon-download"></span> Download
                  </a>
               </div> 
                
               </div>    
            <?php
            }
            ?>
    </div>

    <div class="col-md-3">
      <?php $this->load->view('profile/left_menu_profile'); ?>
    </div>
    </div>

</div>