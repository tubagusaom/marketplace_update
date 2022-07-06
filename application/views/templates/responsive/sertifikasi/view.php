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
                        <span>Sertifikasi</span>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Riwayat Sertifikasi</span>
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
                                <span class="caption-subject bold uppercase"> Riwayat Sertifikasi</span>
                            </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">-</th>
                                        <th> Nama Jadwal </th>
                                        <th> Tanggal Daftar </th>
                                        <th> Tanggal Uji </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no=1;
                                    foreach ($riwayat_sertifikasi as $key => $value) {
                                        if ($value->rekomendasi_asesor == '0') {
                                            $label = '-';
                                        } else if ($value->rekomendasi_asesor == '1') {
                                            $label = 'K';
                                        } else {
                                            $label = 'BK';
                                        }
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$no ?></td>
                                            <td><?= $value->jadual ?> </td>
                                            <td><?= tgl_indo($value->tanggal_mulai_uji) ?></td>
                                            <td class="center"><?= tgl_indo($value->tanggal_akhir_uji) ?></td>
                                            <td align="center"><?=$label ?></td>
                                        </tr>
                                    <?php $no++;} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
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
