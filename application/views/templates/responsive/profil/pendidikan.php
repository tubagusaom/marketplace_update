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
                    <span>Pendidikan</span>
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
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Data Pendidikan Formal </div>

                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">
                            <form method="POST" action="<?= base_url() . 'profil/pendidikan_update' ?>" class="mt-repeater form-horizontal">
                                <h3 class="mt-repeater-title">Pendidikan Formal</h3>
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item class="mt-repeater-item">
                                        <!-- jQuery Repeater Container -->
                                        <div class="mt-repeater-input">
                                            <label class="control-label">Jenjang Pendidikan/Sederajat</label>
                                            <br/>
                                            <select name="jenjang_pendidikan" class="form-control">
                                                <option value="" selected>-Pilih-</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select> </div>
                                        <div class="mt-repeater-input">
                                            <label class="control-label">Sekolah/Institusi</label>
                                            <br/>
                                            <input type="text" name="institusi_pendidikan" class="form-control" /> </div>
                                        <div class="mt-repeater-input">
                                            <label class="control-label">Tahun</label>
                                            <input placeholder="Ex : 2010-2013" type="text" name="tahun_pendidikan" class="form-control" />

                                        </div>
                                        <div class="mt-repeater-input">
                                            <label class="control-label">Jurusan</label>
                                            <br/>
                                            <input type="text" name="jurusan" class="form-control" /> </div>
                                        <div class="mt-repeater-input">
                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                <i class="fa fa-close"></i> Delete</a>
                                        </div>
                                    </div>

                                    <?php foreach ($pendidikan as $key => $value) {
                                        ?>
                                        <div data-repeater-item class="mt-repeater-item">
                                            <!-- jQuery Repeater Container -->
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Jenjang Pendidikan/Sederajat</label>
                                                <br/>
                                                <?php echo form_dropdown('jenjang_pendidikan', array('SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'S1' => 'Strata 1', 'S2' => 'Strata 2', '3' => 'Strata 3'), $value->jenjang_pendidikan, 'class="form-control"'); ?> </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Sekolah/Institusi</label>
                                                <br/>
                                                <input value="<?= $value->institusi_pendidikan ?>" type="text" name="institusi_pendidikan" class="form-control" /> </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Tahun</label>
                                                <input value="<?= $value->tahun_pendidikan ?>" type="text" name="tahun_pendidikan" class="form-control" />

                                            </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Jurusan</label>
                                                <br/>
                                                <input value="<?= $value->jurusan ?>" type="text" name="jurusan" class="form-control" /> </div>
                                            <div class="mt-repeater-input">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                    <i class="fa fa-close"></i> Delete</a>
                                            </div>
                                        </div>
                                        <?php
                                        # code...
                                    }
                                    ?>
                                </div>

                                <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
                                    <i class="fa fa-plus"></i> Add</a> <br/>
                                <hr/>
                                <button type="submit" class="btn green">
                                    <i class="fa fa-save"></i> Update Pendidikan</button>
                            </form>
                        </div>
                    </div>
                </div>
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
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="<?= base_url() ?>assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="<?= base_url() ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
