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
                    <span>Jadwal</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Jadwal Uji Kompetensi</span>
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
                            <span class="caption-subject bold uppercase"> Jadwal Uji Kompetensi</span>
                        </div>

                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover " >
                            <thead>
                                <tr>
                                    <th> Nama Jadwal </th>
                                    <th> Batas Waktu </th>
                                    <th> Status </th>
                                    <th> Kuota </th>
                                    <th> Sisa Kuota </th>
                                    <th> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_jadwal as $key => $value) {
                                    if ($value->status_jadwal == '0') {
                                        $label_jadwal = 'Tersedia';
                                        $label_status_jadwal = 'success';
                                    } else if ($value->status_jadwal == '1') {
                                        $label_jadwal = 'Pending';
                                        $label_status_jadwal = 'warning';
                                    } else {
                                        $label_jadwal = 'Selesai';
                                        $label_status_jadwal = 'error';
                                    }
                                    $batas_waktu = date('Y-m-d', strtotime('-2 days', strtotime( $value->tanggal )));

                                    $dStart = new DateTime($value->tanggal);
                                $dEnd  = new DateTime(date('Y-m-d'));
                                $dDiff = $dStart->diff($dEnd);
                                $hasil = $dDiff->format('%R').$dDiff->days;
                                if($hasil < -1 ){
                                        if($value->status_aktif=='Y'){
                                            $status_jadwal = 'On Schedule dan <br/>Pendaftaran aktif';
                                            $link = '<a href="' . base_url() . 'jadwal/registrasi/'.$value->id .'">Registrasi</a>';
                                            $label_status_jadwal = 'success';
                                        }else{
                                            $status_jadwal = 'Jadwal di batalkan';
                                            $link = '';
                                            $label_status_jadwal = 'danger';
                                        }
                                   }else{
                                        $status_jadwal = 'On Schedule dan <br/>Pendaftaran Manual. Silahkan Kontak admin';
                                        $link = '-' ;
                                        $label_status_jadwal = 'warning';
                                   }

                                    ?>
                                    <tr class="odd gradeX">

                                        <td> <?= $value->jadual ?> </td>
                                        <td>
                                            <?= tgl_indo($batas_waktu) ?>
                                        </td>
                                        <td width="15%" style="width: 15%"><span class="label label-sm label-<?= $label_status_jadwal ?>"> <?= $status_jadwal ?> </span>
                                        </td>
                                        <td> <?= $value->kuota_peserta ?> </td>
                                        <td> <?= $value->kuota_peserta - $value->total_asesi ?> </td>
                                        <td>
                                            <?=$link?>
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
