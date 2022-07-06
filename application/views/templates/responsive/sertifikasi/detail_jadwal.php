<link href="<?=$aplikasi->url_cdn?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->

        <!-- END THEME PANEL -->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="#">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Proses Sertifikasi</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Detail</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div><?= tgl_indo(date('Y-m-d')) ?>
                    <i class="icon-calendar"></i>&nbsp;
                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                </div>
            </div>
        </div>


        <div class="row" style="margin-top: 10px;">
            <?php
            if ($this->session->flashdata('result') != '') {
                ?>
                <div class="alert alert-<?= $this->session->flashdata('mode_alert') ?>" role="alert"><?php echo $this->session->flashdata('result'); ?></div>
                <?php
            }
            ?>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= base_url() . 'profil/edit' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap</label>
                            <div class="col-md-9">
                                <b><?= $detail_asesmen->nama_lengkap ?></b>
                                <input name="organisasi" value="<?= $id ?>" type="hidden" placeholder="Organisasi" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Skema Sertifikasi</label>
                            <div class="col-md-9">
                                <b><?= $detail_asesmen->skema ?></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Jadwal Uji Kompetensi</label>
                            <div class="col-md-9">
                                <b><?= $detail_asesmen->jadual ?></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Uji</label>
                            <div class="col-md-9">
                                <b><?= tgl_indo($detail_asesmen->tanggal) . ' s/d ' . tgl_indo($detail_asesmen->tanggal_akhir) ?></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tempat Uji Kompetensi</label>
                            <div class="col-md-9">
                                <b><?= $detail_asesmen->tuk ?></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-globe"></i>
                                </span>
                                <dt style="padding-left:10px;" class="responsive"><?= $detail_asesmen->alamat ?></dt>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Asesor Penguji</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <dt style="padding-left:10px;"><?= $detail_asesmen->users ?></dt>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"></label>
                            <div class="input-group">
                                <a href="<?= base_url() . 'sertifikasi/detail/' . $id ?>" class="btn btn-primary">Kembali</a></div>
                        </div>

                </form>
                <!-- END FORM-->
            </div>

            <script src="<?=$aplikasi->url_cdn?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
            <script src="<?=$aplikasi->url_cdn?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="<?=$aplikasi->url_cdn?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <script src="<?=$aplikasi->url_cdn?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="<?=$aplikasi->url_cdn?>global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
            <script src="<?=$aplikasi->url_cdn?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="<?=$aplikasi->url_cdn?>global/scripts/app.min.js" type="text/javascript"></script>

            <script src="<?=$aplikasi->url_cdn?>pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
