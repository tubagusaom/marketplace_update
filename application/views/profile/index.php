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
                    <li class="active">Detail Artikel</li>
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
                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post">

                       <?php
                       $bulan = date("M", strtotime($data->created_when));
                       $tanggal = date("d", strtotime($data->created_when));
                       ?>
                       <div class="post-date">
                        <span class="day"><?=$tanggal?></span>
                        <span class="month"><?=$bulan?></span>
                    </div>

                    <div>


                        <div >
                            <span><i class="fa fa-user"></i> By <a href="#">Admin</a> </span>
                            <span>
                              <i class="fa fa-tag"></i>
                              <a href="#">
                                <?php
                                  $kategori=$data->id_kategori;

                                  if ($kategori==4) {
                                    echo "Berita LSP";
                                  }else {
                                    echo "Profil LSP";
                                  }
                                ?>
                              </a>
                            </span>

                        </div>
                        <div style="">
                           <?php
                             if ($data->show_image == '1') {
                                if ($data->foto != '') {
                                    $gambar_db = isset($data->foto) ? $data->foto : '';
                                    if ($gambar_db == "") {
                                        $gambar = base_url() . 'assets/img/logo.png';
                                    } else {
                                        $gambar = base_url() . 'assets/files/artikel/' . $data->foto;
                                    }
                                    echo '<img  class="img-thumbnail "  src="' . $gambar . '"  style="min-height: 300px;min-width:100%;"/>';
                                }
                             }
                          ?>
                        </div>
                        <p align="justify" style="margin-top: 10px;"><?=$data->isi?></p>
                </div>
            </article>

        </div>
    </div>

    <div class="col-md-3">
      <?php $this->load->view('profile/left_menu_profile'); ?>
    </div>
</div>

</div>
