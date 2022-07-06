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
        <?php foreach ($data as $key => $value) { 
              if($key == 0){
                $active = "active";
              }else{
                $active = "";
              }
        ?>
          <a href="<?=base_url().'repositori/vdownload/'.$value->id?>" class="list-group-item">
          <h4 class="list-group-item-heading"><?=$value->categories?></h4>
          <p class="list-group-item-text"><?=$value->description?></p>
          </a>
        <?php } ?>
    </div>

    <div class="col-md-3">
      <?php $this->load->view('profile/left_menu_profile'); ?>
    </div>
    </div>

</div>