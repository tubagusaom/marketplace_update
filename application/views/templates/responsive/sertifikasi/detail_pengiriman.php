<link href="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

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

                            </div>
                        </div>
                        <input name="organisasi" value="<?= $id ?>" type="hidden" placeholder="Organisasi" class="form-control" />

                        <div class="form-group">
                            <label class="control-label col-md-3">Skema Sertifikasi</label>
                            <div class="col-md-9">
                                <b><?= $detail_asesmen->skema ?></b>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal pengiriman</label>
                            <div class="input-group">

                                <b><?= tgl_indo($detail_asesmen->tgl_pengiriman) ?></b></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kurir</label>
                            <div class="input-group">

                                <b><?= $detail_asesmen->via_pengiriman ?></b></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tertuju</label>
                            <div class="input-group">

                                <b><?= $detail_asesmen->tertuju ?></b></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Menerima</label>
                            <div class="input-group">

                                <b><?= tgl_indo($detail_asesmen->tgl_menerima) ?></b></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Penerima</label>
                            <div class="input-group">

                                <b><?= $detail_asesmen->nama_penerima ?></b></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"></label>
                            <div class="input-group">
                                <a href="<?= base_url() . 'sertifikasi/detail/' . $id ?>" class="btn btn-primary">Kembali</a></div>
                        </div>

                </form>
                <!-- END FORM-->
            </div>

            <script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="<?= base_url() ?>assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

            <script src="<?= base_url() ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>


