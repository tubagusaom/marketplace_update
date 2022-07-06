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
                    <span>Pra Asesmen</span>
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
                            <i class="icon-note font-dark"></i>
                            <span class="caption-subject bold uppercase"> Pra Asesmen</span>
                        </div>

                    </div>
                    <div class="portlet-body table-responsive">

                        <table class="table table-striped table-bordered table-hover " >
                            <thead>
                                <tr>
                                  <th> </th>
                                  <th> Complete Name </th>
                                  <th> Skema </th>
                                  <th> Pra Asesmen Date </th>
                                  <th> Rekomendasi</th>
                                  <th> Checked Pra Asesmen</th>
                                </tr>
                            </thead>
                            <tbody>
                                  <?php
                                    foreach ($detail_asesmen as $value) {
                                      if ($value->pra_asesmen == 1) {
                                        $pra_asesmen="Lanjut";
                                      }elseif ($value->pra_asesmen == 2) {
                                        $pra_asesmen="Tidak Lanjut";
                                      }else {
                                        $pra_asesmen="-";
                                      }
                                  ?>
                                    <tr class="odd gradeX">
                                        <td align="center">
                                          <a href="<?= base_url().'sertifikasi/pra_asesmen_edit/'.$value->id ?>"> <i class="icon-note font-dark"></i></a>
                                        </td>
                                        <td><?=$value->nama_lengkap ?></td>
                                        <td><?=$value->skema ?></td>
                                        <td><?=tgl_indo($value->pra_asesmen_date) ?></td>
                                        <td><?=$pra_asesmen ?></td>
                                        <td><?=$value->nama_user ?></td>
                                    </tr>
                                  <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div></div>


<script src="<?= base_url() ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url() ?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
