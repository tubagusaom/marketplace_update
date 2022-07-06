<link href="<?= $aplikasi->url_cdn ?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<script src="<?= $aplikasi->url_cdn ?>assets/datepicker.js"></script>

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
                    <a href="<?= base_url(); ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Pembayaran</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Form Konfirmasi</span>
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
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Konfirmasi Pembayaran </div>

                </div>

                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">
                            <!-- BEGIN FORM-->
                            <style type="text/css">
                                .required_span{
                                    color: red;
                                    font-weight: bold;
                                }
                            </style>
                            <form enctype="multipart/form-data" action="<?= $formURL; ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"> No. Invoice<span class="required_span">*</span></label>
                                        <div class="col-md-5">
                                            <input disabled value="<?= $no_invoice ?>" class="form-control">
                                            <input type="hidden" name="id" id="id" class="form-control"  required value="<?= $id ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"> Total yang harus di bayar <span class="required_span">*</span></label>
                                        <div class="input-group">
                                            <?php
                                            $pajak = 0.98;
                                            $totalbayar = round($jumlah_bayar / $pajak);
                                            ?>
                                            <?= rupiah($totalbayar);//$total_bayar ?>
                                            <input name="total_bayar" required type="hidden" class="form-control" placeholder="Jumlah Pembayaran" value="<?= $totalbayar ?>">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tanggal Bayar <span class="required_span">*</span></label>
                                        <div class="col-md-5">
                                            <input type="text" name="tanggal_bayar" required id="tanggal_bayar" class="form-control date date-picker" data-date-format="dd/mm/yyyy" placeholder="Tanggal Pembayaran" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Pembayaran Via <span class="required_span">*</span></label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('metode_pembayaran', array('-', 'Tunai', 'Transfer Bank'), $data->metode_pembayaran, 'id="metode_pembayaran" class="form-control"  required'); ?>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nama Pemegang Rekening <span class="required_span">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="atas_nama" id="atas_nama" class="form-control" placeholder="Nama pemegang atau No rekening" required />

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Bukti Pembayaran <span class="required_span">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-file"></i>
                                            </span>
                                            <input name="bukti_pembayaran" required type="file" class="form-control" placeholder="Browse File" accept="image/*" > <br>
                                            File bukti pembayaran yang diizinkan hanya gambar dengan ekstensi .jpg atau .png
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">
                                                    <i class="fa fa-check"></i> Submit</button>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <script>
            $(function () {
                $(".date-picker").datepicker({
                    format: 'dd/mm/yyyy',

                });
            })
        </script>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= $aplikasi->url_cdn ?>global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
        <script src="<?= $aplikasi->url_cdn ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?= $aplikasi->url_cdn ?>pages/scripts/form-repeater.min.js" type="text/javascript"></script>
        <script src="<?= $aplikasi->url_cdn ?>pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>


        <script>
            $(function () {
                $(".date-picker").datepicker({
                    format: 'yyyy-mm-dd'
                });
            })
        </script>
