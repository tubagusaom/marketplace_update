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
                        <span>Sertifikasi</span>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Detail Sertifikasi</span>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Detail Asesmen Mandiri</span>
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
                            <i class="fa fa-gift"></i>Data Bukti Pendukung </div>

                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group">
                                <form method="POST" action="<?= base_url() . 'sertifikasi/detail_asesmen_update' ?>" class="mt-repeater form-horizontal">
                                    Dokumen yang harus di upload antara lain <?= $syarat_pendaftaran ?>. Minimal dokumen yang wajib di upload adalah <b><?= $minimal_syarat_pendaftaran ?></b>
                                    <hr/>

                                    <h3 class="mt-repeater-title">Portofolio</h3>
                                    <div data-repeater-list="group-a">
                                        <?php
                                        if (count($detail_asesmen) == 0) {
                                            ?>
                                            <div data-repeater-item class="mt-repeater-item">
                                                <!-- jQuery Repeater Container -->
                                                <div class="mt-repeater-input">
                                                    <label class="control-label">Nama Dokumen</label>
                                                    <br/>
                                                    <?php echo form_dropdown('id_repositori', $detail_repositori, '', 'class="form-control"'); ?> </div>
                                                <input type="hidden" value="<?= $id ?>" name="id_asesi">
                                                <div class="mt-repeater-input mt-repeater-textarea">
                                                    <label class="control-label"> Deskripsi </label>
                                                    <br/>
                                                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                                                </div>

                                                <div class="mt-repeater-input">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                        <i class="fa fa-close"></i> Delete</a>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                        foreach ($detail_asesmen as $key => $value) {
                                            ?>
                                            <div data-repeater-item class="mt-repeater-item">
                                                <!-- jQuery Repeater Container -->
                                                <div class="mt-repeater-input">
                                                    <label class="control-label">Nama Dokumen</label>
                                                    <br/>
                                                    <?php echo form_dropdown('id_repositori', $detail_repositori, $value->id_repositori, 'class="form-control"'); ?> </div>

                                                <input type="hidden" value="<?= $id ?>" name="id_asesi">


                                                <div class="mt-repeater-input mt-repeater-textarea">
                                                    <label class="control-label"> Deskripsi </label>
                                                    <br/>
                                                    <textarea name="deskripsi" class="form-control" rows="3"><?= $value->deskripsi ?></textarea>
                                                </div>

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
                                        <i class="fa fa-save"></i> Update Portofolio</button> &nbsp
                                    <a href="<?= base_url() . 'bukti_pendukung/upload' ?>" class="btn btn-primary mt-repeater-add">
                                        <i class="fa fa-plus"></i> Upload Portofolio</a>
                                    &nbsp
                                    <a href="<?= base_url() . 'sertifikasi/asesmen_mandiri/' . $id ?>" class="btn btn-primary mt-repeater-add">
                                        <i class="fa fa-user"></i> Asesmen Mandiri</a>
                                    <br>
                                    Note : Apabila belum ada pilihan 'Nama Dokumen', Klik tombol 'Upload Portofolio' untuk mengupload beberapa dokumen pendukung dan kembali lagi ke halaman ini. Klik halaman Asesmen mandiri untuk melengkapi Formulir APL 02
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
                <!-- END THEME GLOBAL SCRIPTS -->
                <!-- BEGIN PAGE LEVEL SCRIPTS -->
                <script src="<?= base_url() ?>assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
                <!-- END PAGE LEVEL SCRIPTS -->
                <!-- BEGIN THEME LAYOUT SCRIPTS -->
                <script src="<?= base_url() ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
                <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
