<style type="text/css">
/*Panel tabs*/
.panel-primary{
  border-color: #2c4b87;
}
.panel-primary>.panel-heading{
  color: #fff;
  background-color: #365899;
  border-color: #2c4b87;
}

.panel-tabs {
  position: relative;
  bottom: 30px;
  clear:both;
  border-bottom: 1px solid transparent;
}

.panel-tabs > li {
  float: left;
  margin-bottom: -1px;
  color: #fff;
}

.panel-tabs > li > a {
  margin-right: 2px;
  margin-top: 4px;
  line-height: .85;
  border: 1px solid transparent;
  border-radius: 4px 4px 0 0;
  color: #b3c7f0;
}

.panel-tabs > li > a:hover {
  border-color: transparent;
  color: #fff;
  background-color: transparent;
}

.panel-tabs > li.active > a,
.panel-tabs > li.active > a:hover,
.panel-tabs > li.active > a:focus {
  color: #fff;
  cursor: default;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  background-color: #102857;
  border-bottom-color: transparent;
}
#tabFB{
  margin-right: 10px;
}
img.fbwae{
  width: 140px;
  height: 100px;
  margin-bottom: 22px;
  margin-right: 5px;
  /* padding-right: 10px; */
}

.tab-pane a{
  color: #365899;
}
div.abc{
  height: 120px;
  float: left;
  margin-top: 15px;
}
div.ttl{
  height: 120px;
  margin-top: 15px;
}
div.art{
  text-align: center;
  margin-top: -15px;
}

.art:hover{
  cursor: pointer;
  opacity: 1.0;
  background: #F0F3F4;
}
.lsp{
  height: 30px;
  margin-top: -50px;
}
.lsp a{
  text-decoration: none;
}
</style>

<div class="col-md-6" style="margin-top: 20px">
  <div class="panel panel-primary class="appear-animation" data-appear-animation="fadeInLeft" data-appear-animation-delay="100">
    <div class="panel-heading">
      <h3 class="panel-title">LSP Home Depo</h3>
      <span class="pull-right">
        <!-- Tabs -->
        <ul class="nav panel-tabs">
          <li class="active"><a href="#tab3" data-toggle="tab" title="video"><i class="glyphicon glyphicon-facetime-video"></i></a></li>
          <!-- <li ><a href="#tabIG" data-toggle="tab"><i class="glyphicon glyphicon-facebook"> </i> Facebook</a></li> -->
          <!-- <li><a href="#tabFB" data-toggle="tab"> IG</a></li> -->
        </ul>
      </span>
    </div>
    <div class="panel-body">
      <div class="tab-content col-md-6" style="width: auto; height: 330px;  overflow-y: scroll; overflow-x: hidden; text-decoration: none;">
        <div class="tab-pane active" id="tab3" style="width: 100%">
          <iframe width="450" height="350" src="https://www.youtube.com/embed/lzTCe7P4kyg" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
        <!-- <div class="tab-pane" id="tabIG" > -->
          <?php
          // foreach ($coba as $value) {
            // $token = 'EAACxkoCbptoBADlLzt0hPhPCBhkNLphKfZBZBhumpJq3FDjgeWFVmqZC9UHuPf4BQtYu7txmLs8QFJz1wqzlZAeO0QD8bvDV6gmahNKEKkpQZBJhWGhPgGKVQY1vKaSB2k9Qd7gxlQcCZBFO98AbvmizgfjrFdQEgZD';
            // $a = $value['id'];
            //
            // $link_like = "https://graph.facebook.com/{$a}/likes?&summary=total_count&access_token={$token}";
            //
            // $headers = array("Content-type: application/json");
            //
            // $like = curl_init();
            // curl_setopt($like, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($like, CURLOPT_URL, $link_like);
            // curl_setopt($like, CURLOPT_FOLLOWLOCATION, 1);
            // curl_setopt($like, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($like, CURLOPT_COOKIEJAR,'cookie.txt');
            // curl_setopt($like, CURLOPT_COOKIEFILE,'cookie.txt');
            // curl_setopt($like, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($like, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
            // curl_setopt($like, CURLOPT_SSL_VERIFYPEER, false);
            //
            // $get_like = curl_exec($like);
            // $result_like = json_decode($get_like,TRUE);
            // $test_like = $result_like['summary'];
            //
            // curl_close($like);

    // ===============================CURL GET COUNT COMMENTS==================================== //

            // $link_comments = "https://graph.facebook.com/{$a}/comments?&summary=total_count&access_token={$token}";
            //
            // $headers = array("Content-type: application/json");
            //
            // $comments = curl_init();
            // curl_setopt($comments, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($comments, CURLOPT_URL, $link_comments);
            // curl_setopt($comments, CURLOPT_FOLLOWLOCATION, 1);
            // curl_setopt($comments, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($comments, CURLOPT_COOKIEJAR,'cookie.txt');
            // curl_setopt($comments, CURLOPT_COOKIEFILE,'cookie.txt');
            // curl_setopt($comments, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($comments, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
            // curl_setopt($comments, CURLOPT_SSL_VERIFYPEER, false);
            //
            // $get_comments = curl_exec($comments);
            // $result_comments = json_decode($get_comments,TRUE);
            // $test_comments = $result_comments['summary'];
            //
            // curl_close($comments);
            ?>
            <!-- <div style="float: left; border-bottom: 1px solid #ddd; margin-top: 15px; background-color: red;"> -->

              <!-- <div class="col-md-4 abc">
                <img class="img-responsive fbwae" src="<?= $value['full_picture']; ?>" align="left">
              </div>
              <div class="col-md-8 ttl">
                <a href="<?= $value['permalink_url'] ?>" target="_blank">
                  <p style="text-align: justify; font-size: 15px;">
                    <?php echo character_limiter($value['message'], 65); ?>
                  </p>
                </a>
              </div>
              <div class="col-md-12" style="border-bottom: 1px solid #ddd;">
                <div class="col-md-4"></div>
                <div class="col-md-8 lsp">
                  <p align="right">
                    <a href="<?= $value['permalink_url'] ?>" target="_blank">
                      <div class="col-md-4 art">
                        <i class="fa fa-thumbs-up">&nbsp;</i><?php echo $test_like['total_count']; ?>
                        &nbsp;&nbsp;
                      </div>
                    </a>
                    <a href="<?= $value['permalink_url'] ?>" target="_blank">
                      <div class="col-md-4 art">
                        <i class="fa fa-comments"></i>&nbsp;<?php echo $test_comments['total_count']; ?>
                      </div>
                    </a>
                    <a href="<?= $value['permalink_url'] ?>" target="_blank">
                      <div class="col-md-4 art">
                        <i class="fa fa-share-square"></i>
                      </div>
                    </a>
                  </p>
                </div>
              </div> -->
              <!-- <br> -->
              <!-- </div> -->
              <?php
                // }
              ?>
            <!-- </div> -->

            <div class="tab-pane" id="tabFB">
              <?php
                // foreach ($rst as $value) {
              ?>
              <!-- <div class="col-md-4">
                <a href="<?= $value['link'] ?>" target="_blank">
                  <span class="thumb-info thumb-info-centered-info thumb-info-hide-info-hover" style="margin-top: 25px;">
                    <span class="thumb-info-wrapper">
                      <img height="100" src="<?= $value['images']['standard_resolution']['url'] ?>" class="rtl" alt="">
                      <span class="thumb-info-title">
                        <span class="thumb-info-inner">
                          <i class="fa fa-heart"></i>
                          <?= $value['likes']['count'] ?>
                          &nbsp;
                          <i class="fa fa-comment"></i>
                          <?= $value['comments']['count'] ?>
                        </span>
                      </span>
                    </span>
                  </span>
                </a>
              </div> -->
              <?php
                // }
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6" style="margin-top: 20px">

      <div class="panel panel-primary class="appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
        <div class="panel-heading">
          <h3 class="panel-title">Populer</h3>
          <span class="pull-right">
            <!-- Tabs -->
            <ul class="nav panel-tabs">
              <li class="active"><a href="#tab1" data-toggle="tab" title="Jadwal Uji"><i class="glyphicon glyphicon-calendar"> </i></a></li>
              <li><a href="#tab2" data-toggle="tab" title="file"><i class="glyphicon glyphicon-file"></i></a></li>

            </ul>
          </span>
        </div>
        <div class="panel-body">
          <div class="tab-content">

            <div class="tab-pane active" id="tab1">
              <h4>Jadwal Uji Kompetensi</h4>
              <?php foreach ($jadwal as $key => $value) { ?>
              <div class="well">
                <a href="<?= base_url().'uji_kompetensi.html'?>" target="_blank"><?= $value->jadual ?> ( <?= tgl_indo($value->tanggal) ?> )</a>
              </div>
              <?php } ?>

              <?php
                if ($value == "") {
                  echo '';
                }else {
                  echo '
                        <a href="jadwal_ujk/view">
                          <button type="button" name="button" class="btn btn-large btn-block btn-primary">Selengkapnya</button>
                        </a>
                       ';
                }
              ?>

            </div>

            <div class="tab-pane" id="tab2">
              <h4>Download Dokumen</h4>
              <?php foreach ($repo as $key => $value) { ?>
              <a href="<?=base_url().'repositori/klik_download/'.$value->id?>" style="font-size: 14px;font-style: bold;">
                <?php
                $string = $value->nama_dokumen;
                echo word_limiter($string, 10);
                ?></a><br/>
                <label style="font-size: 10px;"><?= $value->nama_file ?></label>
                <br>
                <?php  } ?>
              </div>



            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
