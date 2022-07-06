<link href="<?= base_url() ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?= base_url() ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Pembayaran</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Invoice</span>
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
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="invoice">
                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <h3>Ditagihkan Kepada:</h3>
                            <ul class="list-unstyled">
                                <li>&nbsp;</li>
                                <li style="font-weight: bold;"> <?= strtoupper($riwayat_sertifikasi->nama_lengkap) ?> </li>
                                <li> <?= $riwayat_sertifikasi->alamat ?> </li>
                                <li> <?= $riwayat_sertifikasi->email ?> </li>
                                <li> <?= $riwayat_sertifikasi->telp ?> </li>

                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h3>Perihal:</h3>
                            <ul class="list-unstyled">
                                <li> Pembayaran </li>
                                <li> Invoice No : <?=$no_invoice;?></li>
                                <li> Uji Kompetensi </li>
                                <li> dengan Skema Sertifikasi </li>
                                <li> <?= $riwayat_sertifikasi->skema ?> </li>

                            </ul>
                        </div>
                        <div class="col-md-4 invoice-payment">
                            <h3>Payment Details:</h3>
                            <ul class="list-unstyled">
                                <li>&nbsp;</li>
                                <li>
                                    <strong>NPWP:</strong> <?= $aplikasi->npwp ?> </li>
                                <li>
                                    <strong>Bank:</strong> <?= $aplikasi->bank ?></li>
                                <li>
                                    <strong>An:</strong> <?= $aplikasi->bank_atas_nama ?> </li>
                                <li>
                                    <strong>No Rekening:</strong> <?= $aplikasi->bank_no_rekening ?> </li>

                            </ul>
                        </div>
                    </div>

                    <div class="invoice">
                        <div class="table-responsive col-md-12">
                            <table class="table table-striped table-bordered-none table-hover">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th class="tb"> Deskripsi </th>
                                        <th class="tb" style="text-align: center;"> Kuantitas </th>
                                        <th class="tb"> Jumlah Pembayaran </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td class="tb"> Biaya Penyelenggaran Uji Kompetensi sesuai Skema  </td>
                                        <td class="tb" style="text-align: center;"> 1 </td>
                                        <td class="tb"> <?= 'Rp ' . number_format($riwayat_sertifikasi->biaya_skema, 0, '.', '.') ?> </td>

                                    </tr>
                                    <tr>
                                        <td> 2 </td>
                                        <td class="tb"> Pajak </td>
                                        <td class="tb" style="text-align: center;"> 1 </td>
                                        <td class="tb"> <?= 'Rp ' . number_format(round(($riwayat_sertifikasi->biaya_skema / 0.98) - $riwayat_sertifikasi->biaya_skema), 0, '.', '.') ?> </td>

                                    </tr>
                                    <tr>
                                        <td>  </td>
                                        <td class="tb">  </td>
                                        <td class="tb" style="text-align: right;font-weight: bold;"> TOTAL TAGIHAN </td>
                                        <td class="tb" style="font-weight: bold;">  <?= 'Rp ' . number_format(round($riwayat_sertifikasi->biaya_skema / 0.98), 0, '.', '.') ?> </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <div class="well">
                                <address>
                                    <strong><?= $aplikasi->nama_unit ?></strong>
                                    <br/> <?= $aplikasi->alamat ?>
                                    <span class="glyphicon glyphicon-earphone"></span> <?= $aplikasi->no_telpon ?> </address>
                                <address>
                                    <strong>Email</strong>
                                    <br/>
                                    <a href="mailto:#"> <?= $aplikasi->alamat_email ?> </a>
                                </address>
                            </div>
                        </div>
                        <div class="col-md-8 invoice-block">
                            <a href="<?= base_url('pembayaran/cetak/' . $riwayat_sertifikasi->id); ?>" class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank"> Cetak
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url() ?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
