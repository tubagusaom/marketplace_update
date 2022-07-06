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
                    <span>Konfirmasi</span>
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
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark col-md-6">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> Konfirmasi Pembayaran</span>
                        </div>
                        <div class="col-md-6 pull-right" style="float: right;">

                        </div>

                    </div>
                    <div class="portlet-body">

                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                                <tr>
                                    <th width="20%">Invoice No. </th>
                                    <th width="20%">Keterangan </th>
                                    <th width="20%" style="text-align: right;">Jumlah </th>
                                    <th width="10%" style="text-align: center;">Tanggal Bayar </th>
                                    <th width="20%">Pembayaran Via</th>
                                    <th width="10%" style="text-align: center;">Bukti Pembayaran </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($konfirmasi_pembayaran as $key => $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td width="20%"><?= $value->invoice_no ?> </td>
                                        <td width="20%"><?= $value->keterangan ?></td>
                                        <td width="20%" align="right"><?= rupiah($value->jumlah_pembayaran); ?></td>
                                        <td width="10%" align="center"><?= $value->tanggal_bayar ?></td>
                                        <td width="20%"><?= $value->pembayaran_via ?></td>
                                        <td width="10%" class="center" align="center">
                                            <a href="<?= base_url() . 'assets/files/asesi/' . $value->bukti_pembayaran ?>" target="_blank"> <i class="icon-cloud-download font-dark"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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

</div>
