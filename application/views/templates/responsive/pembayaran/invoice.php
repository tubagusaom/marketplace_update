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
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> Riwayat Invoice</span>
                        </div>

                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%" style="text-align: center;"> No Invoice </th>
                                    <th width="25%"> Nama Jadwal </th>
                                    <th width="5%"> Metode Bayar </th>
                                    <th width="5%"> Nilai Bayar </th>
                                    <th width="5%"> Tanggal Bayar</th>
                                    <th width="5%"> Aksi</th>
                                    <th width="5%"> Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($riwayat_sertifikasi as $key => $value) {
                                    if ($value->administrasi_ujk == '0') {
                                        $label = 'Belum Lunas';
                                    } else if ($value->administrasi_ujk == '1') {
                                        $label = 'Sudah Konfirmasi';
                                    } else if ($value->administrasi_ujk == '2') {
                                        $label = 'Sudah Lunas';
                                    } else {
                                        $label = 'Terbit Invoice. Silahkan melakukan pembayaran';
                                    }
                                    if ($value->metode_bayar == '0') {
                                        $metode_bayar = 'Perseorangan';
                                    } else {
                                        $metode_bayar = 'Kolektif';
                                    }
                                    ?>
                                    <tr class="odd gradeX">

                                        <td style="text-align: center;"> <?= $value->invoice_no ?> </td>
                                        <td>
                                            <?= $value->jadual ?>
                                        </td>
                                        <td><?= $metode_bayar ?>
                                        </td>

                                        <td> <?= 'Rp ' . number_format(round($value->biaya_skema / 0.98), 0, '.', '.') ?>

                                        </td>
                                        <td><?= tgl_indo($value->tanggal_bayar) ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a style="margin: 5px;" class="btn btn-xs green" href="<?= base_url() . 'pembayaran/detail/' . $value->id ?>">
                                                    Detail </a>
                                                <?php
                                                //var_dump($value->administrasi_ujk);
                                                if ($value->administrasi_ujk == '0') {
                                                    ?>
                                                    <a  style="margin: 5px;" class="btn btn-xs blue" href="<?= base_url() . 'pembayaran/form_konfirmasi/'.$value->id ?>">
                                                        Konfirmasi Pembayaran </a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td class="center"> <span> <?= $label ?> </span> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                            <thead>
                              <tr><br>
                                <th colspan="7">NOTE : Status pembayaran akan dikonfirmasi dan diupdate oleh admin LSP menjadi "SUDAH LUNAS" apabila pembayaran valid.</th>
                              </tr>
                            </thead>
                        </table>
                        <div class="col-md-12">

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
