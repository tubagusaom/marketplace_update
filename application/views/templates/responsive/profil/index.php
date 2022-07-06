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
                    <a href="<?= base_url() ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Profil</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Biodata</span>
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
                <style type="text/css">
                    .required_span{
                        color: red;
                        font-weight: bold;
                    }
                </style>
                <form action="<?= base_url() . 'profil/edit' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">No Identitas <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <input type="hidden" name="id_user" value="<?= $biodata->id ?>">
                                <input type="hidden" name="pegawai_id" value="<?= $biodata->pegawai_id ?>">
                                <input required type="text" placeholder="No Identitas" class="form-control" name="no_identitas" value="<?= $biodata->no_identitas ?>"/>
                                <span class="help-block"> KTP / Pasport Number </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <input required  type="text" placeholder="Nama Lengkap" class="form-control" name="nama_user" value="<?= $biodata->nama_user ?>" />

                            </div>
                        </div>
                        <input name="organisasi" value="<?= $biodata->organisasi ?>" type="hidden" placeholder="Organisasi" class="form-control" />

                        <div class="form-group">
                            <label class="control-label col-md-3">Tempat Lahir <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <input required name="tempat_lahir" value="<?= $biodata->tempat_lahir ?>" type="text" placeholder="Tempat Lahir" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <input required name="tgl_lahir" value="<?= jquery_date($biodata->tgl_lahir) ?>" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" />

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis Kelamin <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <?php echo form_dropdown('jenis_kelamin', array('1' => 'Laki-laki', '2' => 'Perempuan'), $biodata->jenis_kelamin, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kewarganegaraan <span class="required_span">*</span></label>
                            <div class="col-md-9">

                                <?php echo form_dropdown('kewarganegaraan', array('1' => 'WNI', '2' => 'WNA'), $biodata->kewarganegaraan, 'class="form-control"'); ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email <span class="required_span">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input name="email" value="<?= $biodata->email ?>" required type="text" class="form-control" placeholder="Email Address"> </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No HP <span class="required_span">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input name="hp" value="<?= $biodata->hp ?>" required type="text" class="form-control" placeholder="No HP Aktif"> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat Rumah <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <textarea required name="alamat" rows="4" class="form-control"><?= $biodata->alamat ?></textarea>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-md-3">Nama Program Studi <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <input name="pendidikan_terakhir" value="<?= $biodata->pendidikan_terakhir ?>" required type="text" class="form-control" placeholder="Nama Program Studi">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenjang <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <?php echo form_dropdown('jenjang', array('SMA/SMK' => 'SMA/SMK', 'D1' => 'D1', 'D2' => 'D2', 'D3' => 'D3', 'S1/D4' => 'S1/D4', 'S2' => 'S2', 'S3' => 'S3'), $biodata->jenjang, 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Perguruan Tinggi <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <input name="nama_lembaga" value="<?= $biodata->nama_lembaga ?>" required type="text" class="form-control" placeholder="Nama Perguruan Tinggi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Gelar Akademik <span class="required_span">*</span></label>
                            <div class="col-md-9">
                                <input name="gelar" value="<?= $biodata->gelar ?>" required type="text" class="form-control" placeholder="Gelar Akademik">
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">
                                        <i class="fa fa-check"></i> Update Profil</button>
                                </div>
                            </div>
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
