<style type="text/css">
    a {
        text-decoration: none;
    }
    .container article img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 70%;
    }

    img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
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

                    <div class="post-content">


                        <div class="post-meta">
                            <span><i class="fa fa-user"></i> By <a href="#">Admin</a> </span>
                            <span><i class="fa fa-tag"></i> <a href="#">Berita Terbaru</a></span>
                            
                        </div>
                        <div class="post-image">
                        <center>
                         <?php
                                //var_dump($data->foto);
                                //if($data->status_image !=0){
                         if ($data->show_image == '1') {
                            if ($data->foto != '') {
                                $gambar_db = isset($data->foto) ? $data->foto : '';
                                if ($gambar_db == "") {
                                    $gambar = base_url() . 'assets/img/images.jpg';
                                } else {
                                    $gambar = base_url() . 'assets/files/artikel/' . $data->foto;
                                }
                                echo '<img class="img-responsive img-rounded mb-lg" src="' . $gambar . '" height="100%"/>';
                            }
                        }
                        ?>
                        </center>
                    </div>
                    <p align="justify"><?=$data->isi?></p>
<div id="disqus_thread"></div>
<script>
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            

                    <div class="post-block post-share">
                        <h3 class="heading-primary"><i class="fa fa-share"></i>Share this post</h3>

                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style ">
                            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                            <a class="addthis_button_tweet"></a>
                            <a class="addthis_button_pinterest_pinit"></a>
                            <a class="addthis_counter addthis_pill_style"></a>
                        </div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
                        <!-- AddThis Button END -->

                    </div>
                </div>
            </article>

        </div>
    </div>

    <div class="col-md-3">
        <aside class="sidebar">

            <form>
                <div class="input-group input-group-lg">
                    <input class="form-control" placeholder="Search..." name="s" id="s" type="text">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>

            <hr>
            <h4 class="heading-primary">Berita Lainnya</h4>
            <ul class="list list-icons list-primary list-side-borders mt-xlg">
            <?php foreach ($berita_lainnya as $key => $value) { ?>
                <li><i class="fa fa-check"></i> <a href="<?=base_url().'profile/index/'.$value->id?>"><?=$value->judul?></a></li>
               
            <?php } ?>
            </ul>
        </aside>
    </div>
</div>

</div>
<script id="dsq-count-scr" src="//lsp-jmkp.disqus.com/count.js" async></script>