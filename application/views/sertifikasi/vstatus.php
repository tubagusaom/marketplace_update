<style type="text/css">
    

.timeline-centered {
    position: relative;
    margin-bottom: 30px;
}

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before {
        content: '';
        position: absolute;
        display: block;
        width: 4px;
        background: #f5f5f6;
        /*left: 50%;*/
        top: 20px;
        bottom: 20px;
        margin-left: 30px;
    }

    .timeline-centered .timeline-entry {
        position: relative;
        /*width: 50%;
        float: right;*/
        margin-top: 5px;
        margin-left: 30px;
        margin-bottom: 10px;
        clear: both;
    }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry.begin {
            margin-bottom: 0;
        }

        .timeline-centered .timeline-entry.left-aligned {
            float: left;
        }

            .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
                margin-left: 0;
                margin-right: -18px;
            }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
                    left: auto;
                    right: -100px;
                    text-align: left;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
                    float: right;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
                    margin-left: 0;
                    margin-right: 70px;
                }

                    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
                        left: auto;
                        right: 0;
                        margin-left: 0;
                        margin-right: -9px;
                        -moz-transform: rotate(180deg);
                        -o-transform: rotate(180deg);
                        -webkit-transform: rotate(180deg);
                        -ms-transform: rotate(180deg);
                        transform: rotate(180deg);
                    }

        .timeline-centered .timeline-entry .timeline-entry-inner {
            position: relative;
            margin-left: -20px;
        }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
                position: absolute;
                left: -100px;
                text-align: right;
                padding: 10px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span {
                    display: block;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:first-child {
                        font-size: 15px;
                        font-weight: bold;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:last-child {
                        font-size: 12px;
                    }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
                background: #fff;
                color: #737881;
                display: block;
                width: 40px;
                height: 40px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                border-radius: 20px;
                text-align: center;
                -moz-box-shadow: 0 0 0 5px #f5f5f6;
                -webkit-box-shadow: 0 0 0 5px #f5f5f6;
                box-shadow: 0 0 0 5px #f5f5f6;
                line-height: 40px;
                font-size: 15px;
                float: left;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
                    background-color: #303641;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-secondary {
                    background-color: #ee4749;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-success {
                    background-color: #00a651;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-info {
                    background-color: #21a9e1;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-warning {
                    background-color: #fad839;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-danger {
                    background-color: #cc2424;
                    color: #fff;
                }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
                position: relative;
                background: #f5f5f6;
                padding: 1em;
                margin-left: 60px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
                    content: '';
                    display: block;
                    position: absolute;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 9px 9px 9px 0;
                    border-color: transparent #f5f5f6 transparent transparent;
                    left: 0;
                    top: 10px;
                    margin-left: -9px;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2, .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
                    color: #737881;
                    font-family: "Noto Sans",sans-serif;
                    font-size: 12px;
                    margin: 0;
                    line-height: 1.428571429;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p + p {
                        margin-top: 15px;
                    }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 {
                    font-size: 16px;
                    margin-bottom: 10px;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 a {
                        color: #303641;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 span {
                        -webkit-opacity: .6;
                        -moz-opacity: .6;
                        opacity: .6;
                        -ms-filter: alpha(opacity=60);
                        filter: alpha(opacity=60);
                    }

</style><div class="pageSection container-fluid-full">
	<div class="bannerPage container">
        <img class="img-thumbnail" src="<?=base_url().'assets/img/spa.png'?>">
    </div>
	<div class="container" style="margin-top: 15px;"></div>
	<div class="bannerPage container">
	<div class="col-md-12 well" style="background-color: #FFFFFF;">
	<div class="col-md-3">
		<?php $this->load->view('sertifikasi/left_menu_sertifikasi');?>
	</div>
	<div class="col-md-9">
		<ol class="breadcrumb well well-sm">
    		<li><a href="<?=base_url()?>">Home</a></li>
    		<li class="active"><?=isset($data->nama_lengkap) ? $data->nama_lengkap : 'Data Tidak Ditemukan'?></li>
    	</ol>
    	<h2>
                <?php
                    //$judul = isset($data->judul) ? $data->judul : 'LSP Cohespa';
                    echo isset($data->nama_lengkap) ? $data->nama_lengkap : 'Data Tidak Ditemukan';
                ?>
          </h2>
          
         
    <div class="row">
    
        <div class="timeline-centered">

        <article class="timeline-entry">

            <div class="timeline-entry-inner">
            <?php
                if($data->nama_lengkap!=""){
            ?>
                <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2><a href="#"><?=$data->nama_lengkap?></a> <span>Registrasi pada <?=$data->u_date_create?></span></h2>
                    <p>Dengan Skema Sertifikasi <b><?=$data->skema?></b></p>
                </div>
            <?php }else{
            ?>
                <div class="timeline-icon bg-secondary">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2>Tahapan Registrasi</h2>
                    <p>Pada Tahapan ini calon peserta melakukan pendaftaran secara online biodata pribadi, bukti pendukung dan Asesmen mandiri secara online (APL 01 dan 02)</p>
                </div>
            <?php
            }
            ?>
            </div>

        </article>

        <article class="timeline-entry">

            <div class="timeline-entry-inner">
                <?php
                if($data->nama_user!=""){
                    
            ?>
                <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2><a href="#"><?=$data->nama_user?></a> <span>Pra Asesmen pada <?=tgl_indo($data->pra_asesmen_date)?></span></h2>
                    <p><?=$data->pra_asesmen_description?></p>
                </div>
            <?php }else{
            ?>
                <div class="timeline-icon bg-secondary">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2>Tahapan PRA Asesmen</h2>
                    <p>Pada Tahapan ini calon peserta akan di tentukan Asesor untuk Pra Asesmen / Asesmen Mandiri untuk di verifikasi bukti-bukti pendukung nya apakah sudah sesuai dengan persyaratan skema. Rekomendasi Lanjut dari asesor menjadi syarat peserta uji melangkah ke tahapan berikutnya yaitu administrasi</p>
                </div>
            <?php
            }
            ?>
                
            </div>

        </article>
       
        <article class="timeline-entry">

            <div class="timeline-entry-inner">
                 <?php
                if($data->administrasi_ujk=="1"){
            ?>
               <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2><a href="#">Admin LSP</a> <span>Status Administrasi Selesai  pada <?=tgl_indo($data->tanggal_bayar)?></span></h2>
                   
                </div>
            <?php }else{
            ?>
                <div class="timeline-icon bg-secondary">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2>Tahapan Administrasi</h2>
                    <p>Pada Tahapan ini terkait mengenai administrasi pembayaran atau administrasi dokumen yang harus di lengkapi oleh Peserta</p>
                </div>
            <?php
            }
            ?>
                
            </div>

        </article>
         <article class="timeline-entry">

            <div class="timeline-entry-inner">
                 <?php
                 
                if($data->id_asesor!=""){
            ?>
              <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2><a href="#">Admin LSP</a> <span>Menjadwalkan uji pada <?=tgl_indo($data->tanggal)?></span></h2>
                    <p>Di TUK <b><?=$data->tuk?></b> dengan Alamat <?=$data->alamat_tuk?></p>
                </div>
            <?php }else{
            ?>
                <div class="timeline-icon bg-secondary">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2>Tahapan Penjadwalan</h2>
                    <p>Peserta uji akan dijadwalkan untuk mengikuti uji kompetensi. Akan di tentukan TUK dan Asesor penguji nya</p>
                </div>
            <?php
            }
            ?>
                
            </div>

        </article>
        <article class="timeline-entry">

            <div class="timeline-entry-inner">
                <?php
                 
                if($data->rekomendasi_asesor!="0"){
            ?>
              <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2><a href="#"><?=$data->users?></a> <span>Rekomendasi pada <?=tgl_indo($data->tanggal_rekomendasi)?></span></h2>
                    <p>Hasil Rekomendasi <b><?=$rekomendasi[$data->rekomendasi_asesor]?></b>, <?=$data->rekomendasi_description?></p>
                </div>
            <?php }else{
            ?>
                <div class="timeline-icon bg-secondary">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2>Tahapan Rekomendasi Asesor</h2>
                    <p>Setelah di lakukan Uji Kompetensi, maka Hasil Rekomendasi Asesor Kompeten atau Belum Kompeten. Peserta dapat melakukan banding terhadap hasil uji</p>
                </div>
            <?php
            }
            ?>
                
            </div>

        </article>
         <article class="timeline-entry">

            <div class="timeline-entry-inner">
                 <?php
                 
                if($data->no_registrasi!=""){
            ?>
             <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2><a href="#">Komite Teknis</a> <span>memutuskan pada <?=tgl_indo($data->tanggal_terbit)?></span></h2>
                    <p>Sertifikat Kompetensi di keluarkan dengan No Registrasi <b><?=$data->no_registrasi?></b></p>
                </div>
            <?php }else{
            ?>
                <div class="timeline-icon bg-secondary">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2>Tahapan Pleno Asesmen</h2>
                    <p>Hasil uji kompetensi dan berita acara asesmen akan di lakukan Pleno. Disini baru di putuskan secara sah apakah peserta dianggap Kompeten untuk menerima sertifikat kompetensi atau Belum kompeten</p>
                </div>
            <?php
            }
            ?>
                
                
            </div>

        </article>
         <article class="timeline-entry">

            <div class="timeline-entry-inner">
                 <?php
                 
                if($data->metode_terima!=""){
            ?>
             <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2><a href="#"><?=$data->nama_lengkap?></a> <span>telah menerima sertifikat pada <?=tgl_indo($data->tanggal_terima_sertifikat)?></span></h2>
                    <p>Sertifikat di distribusikan melalui <b><?=$data->metode_terima?></b></p>
                </div>
            <?php }else{
            ?>
                <div class="timeline-icon bg-secondary">
                    <i class="entypo-feather"></i>
                </div>

                <div class="timeline-label">
                    <h2>Tahapan Penerimaan Sertifikat</h2>
                    <p>Sertifikat telah di terima oleh Pemegang sertifikat. Pelihara dan Tingkatkan Kompetensi</p>
                </div>
            <?php
            }
            ?>
                
            </div>

        </article>
        


        


       


        
    </div>

 
</div>
          
          
	</div>
</div>
</div>
	</div>
