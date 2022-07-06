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
                    <a href="<?= base_url('home'); ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Bukti Pendukung</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Daftar Bukti Pendukung</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div><?= tgl_indo(date('Y-m-d')) ?>
                    <i class="icon-calendar"></i>&nbsp;
                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                </div>
            </div>
        </div>

        <?php
        $jenis_portofolio = array('1' => 'Pendidikan Formal', '2' => 'Sertifikasi', '3' => 'Pelatihan', '4' => 'Penghargaan', '5' => 'Hasil Kerja / Portofolio', '6' => 'Lain-Lain');
        ?>

        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light">
                    <div class="row portlet-title">
                        <div class="caption font-dark col-md-6">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> Dokumen Bukti Pendukung</span>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url() . 'bukti_pendukung/upload' ?>" style="float: right;" id="sample_editable_1_new" class="btn sbold green"> Add New
                                <i class="icon-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="row" style="padding:5px">
                        <div class="row">
                            <div class="mt-element-ribbon bg-grey-steel">
                                <div class="ribbon ribbon-round ribbon-color-primary uppercase">Persyaratan Dasar</div>
                                <div class="ribbon-content">
                                    <p style="color: red;font-weight: bold;">Identitas Pribadi(KTP, SIM), Ijazah Formal(Bidang Hukum), CV (Wajib dilengkapi)</p>

                                    <div class="clearfix" style="margin-bottom: 5px;">

                                    <?php
                                    if (!empty($jns_portofolio['1'])) {
                                        ?>

                                        <table class="table table-bordered table-hover" style="background-color: #fff;">
                                            <thead>
                                                <tr class="warning">
                                                    <th width="20%">Jenis Dokumen</th>
                                                    <th width="20%">Nama Dokumen</th>
                                                    <th width="20%">File Size</th>
                                                    <th width="10%" style="text-align: center;">Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($jns_portofolio['1'] as $jportofolio) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $jenis_portofolio[$jportofolio['jenis_portofolio']]; ?></td>
                                                        <td><?= $jportofolio['nama_dokumen']; ?></td>
                                                        <td><?= $jportofolio['file_size']; ?></td>
                                                        <td align="center">
                                                            <a href="<?= base_url() . 'repo/asesi/' . $jportofolio['nama_file'] ?>" target="_blank"> <i class="icon-cloud-download font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Hapus Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/hapus/' . $jportofolio['id'] ?>"> <i class="icon-ban font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Edit Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/edit/' . $jportofolio['id'] ?>"> <i class="icon-pencil font-dark"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table></div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-element-ribbon bg-grey-steel">
                                <div class="ribbon ribbon-round ribbon-color-primary ribbon-shadow uppercase">Pelatihan</div>
                                <div class="ribbon-content" > <p style="color: red;font-weight: bold;">Sertifikat pelatihan dari Jimly School atau Kartu Identitas Peserta Pelatihan (Wajib dilengkapi)</p>

                                    <div class="clearfix" style="margin-bottom: 30px;"></div>

                                    <?php
                                    if (!empty($jns_portofolio['3'])) {
                                        ?>

                                        <table class="table table-bordered table-hover" style="background-color: #fff;">
                                            <thead>
                                                <tr class="warning">
                                                    <th width="20%">Jenis Dokumen</th>
                                                    <th width="20%">Nama Dokumen</th>
                                                    <th width="20%">File Size</th>
                                                    <th width="10%" style="text-align: center;">Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($jns_portofolio['3'] as $jportofolio) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $jenis_portofolio[$jportofolio['jenis_portofolio']]; ?></td>
                                                        <td><?= $jportofolio['nama_dokumen']; ?></td>
                                                        <td><?= $jportofolio['file_size']; ?></td>
                                                        <td align="center">
                                                            <a href="<?= base_url() . 'repo/asesi/' . $jportofolio['nama_file'] ?>" target="_blank"> <i class="icon-cloud-download font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Hapus Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/hapus/' . $jportofolio['id'] ?>"> <i class="icon-ban font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Edit Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/edit/' . $jportofolio['id'] ?>"> <i class="icon-pencil font-dark"></i></a>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-element-ribbon bg-grey-steel">
                                <div class="ribbon ribbon-round ribbon-color-primary uppercase">Sertifikasi</div>
                                <div class="ribbon-content">Sertifikasi terkait skema yang akan diambil. Baik itu sertifikat profesi maupun sertififikat profesional

                                    <div class="clearfix" style="margin-bottom: 30px;"></div>

                                    <?php
                                    if (!empty($jns_portofolio['2'])) {
                                        ?>

                                        <table class="table table-bordered table-hover" style="background-color: #fff;">
                                            <thead>
                                                <tr class="warning">
                                                    <th width="20%">Jenis Dokumen</th>
                                                    <th width="20%">Nama Dokumen</th>
                                                    <th width="20%">File Size</th>
                                                    <th width="10%" style="text-align: center;">Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($jns_portofolio['2'] as $jportofolio) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $jenis_portofolio[$jportofolio['jenis_portofolio']]; ?></td>
                                                        <td><?= $jportofolio['nama_dokumen']; ?></td>
                                                        <td><?= $jportofolio['file_size']; ?></td>
                                                        <td align="center">
                                                            <a href="<?= base_url() . 'repo/asesi/' . $jportofolio['nama_file'] ?>" target="_blank"> <i class="icon-cloud-download font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Hapus Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/hapus/' . $jportofolio['id'] ?>"> <i class="icon-ban font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Edit Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/edit/' . $jportofolio['id'] ?>"> <i class="icon-pencil font-dark"></i></a>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="mt-element-ribbon bg-grey-steel">
                                <div class="ribbon ribbon-round ribbon-color-primary ribbon-shadow uppercase">Penghargaan</div>
                                <div class="ribbon-content"> Terkait prestasi atau pencapaian dalam hal komptensi

                                    <div class="clearfix" style="margin-bottom: 30px;"></div>

                                    <?php
                                    if (!empty($jns_portofolio['4'])) {
                                        ?>

                                        <table class="table table-bordered table-hover" style="background-color: #fff;">
                                            <thead>
                                                <tr class="warning">
                                                    <th width="20%">Jenis Dokumen</th>
                                                    <th width="20%">Nama Dokumen</th>
                                                    <th width="20%">File Size</th>
                                                    <th width="10%" style="text-align: center;">Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($jns_portofolio['4'] as $jportofolio) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $jenis_portofolio[$jportofolio['jenis_portofolio']]; ?></td>
                                                        <td><?= $jportofolio['nama_dokumen']; ?></td>
                                                        <td><?= $jportofolio['file_size']; ?></td>
                                                        <td align="center">
                                                            <a href="<?= base_url() . 'repo/asesi/' . $jportofolio['nama_file'] ?>" target="_blank"> <i class="icon-cloud-download font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Hapus Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/hapus/' . $jportofolio['id'] ?>"> <i class="icon-ban font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Edit Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/edit/' . $jportofolio['id'] ?>"> <i class="icon-pencil font-dark"></i></a>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-element-ribbon bg-grey-steel">
                                <div class="ribbon ribbon-round ribbon-color-primary uppercase">Hasil Kerja / Portofolio</div>
                                <div class="ribbon-content">Curiculum Vitae atau Hasil Perkerjaan yang pernah di buat

                                    <div class="clearfix" style="margin-bottom: 30px;"></div>
                                    <?php
                                    if (!empty($jns_portofolio['5'])) {
                                        ?>
                                        <table class="table table-bordered table-hover" style="background-color: #fff;">
                                            <thead>
                                                <tr class="warning">
                                                    <th width="20%">Jenis Dokumen</th>
                                                    <th width="20%">Nama Dokumen</th>
                                                    <th width="20%">File Size</th>
                                                    <th width="10%" style="text-align: center;">Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($jns_portofolio['5'] as $jportofolio) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $jenis_portofolio[$jportofolio['jenis_portofolio']]; ?></td>
                                                        <td><?= $jportofolio['nama_dokumen']; ?></td>
                                                        <td><?= $jportofolio['file_size']; ?></td>
                                                        <td align="center">
                                                            <a href="<?= base_url() . 'repo/asesi/' . $jportofolio['nama_file'] ?>" target="_blank"> <i class="icon-cloud-download font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Hapus Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/hapus/' . $jportofolio['id'] ?>"> <i class="icon-ban font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Edit Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/edit/' . $jportofolio['id'] ?>"> <i class="icon-pencil font-dark"></i></a>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-element-ribbon bg-grey-steel">
                                <div class="ribbon ribbon-round ribbon-color-primary ribbon-shadow uppercase">Lain-lain</div>
                                <div class="ribbon-content">
                                  <div style="text-align: justify;">
                                    Dokumen lain yang belum tersebut di atas
                                  </div>

                                    <div class="clearfix" style="margin-bottom: 30px;"></div>

                                    <?php
                                    if (!empty($jns_portofolio['6'])) {
                                        ?>
                                        <table class="table table-bordered table-hover" style="background-color: #fff;">
                                            <thead>
                                                <tr class="warning">
                                                    <th width="20%">Jenis Dokumen</th>
                                                    <th width="20%">Nama Dokumen</th>
                                                    <th width="20%">File Size</th>
                                                    <th width="10%" style="text-align: center;">Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($jns_portofolio['6'] as $jportofolio) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $jenis_portofolio[$jportofolio['jenis_portofolio']]; ?></td>
                                                        <td><?= $jportofolio['nama_dokumen']; ?></td>
                                                        <td><?= $jportofolio['file_size']; ?></td>
                                                        <td align="center">
                                                            <a href="<?= base_url() . 'repo/asesi/' . $jportofolio['nama_file'] ?>" target="_blank"> <i class="icon-cloud-download font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Hapus Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/hapus/' . $jportofolio['id'] ?>"> <i class="icon-ban font-dark"></i></a>
                                                            &nbsp
                                                            <a alt="Edit Bukti Pendukung" href="<?= base_url() . 'bukti_pendukung/edit/' . $jportofolio['id'] ?>"> <i class="icon-pencil font-dark"></i></a>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>




        <!-- tubagus aom -->
        <script>  </script>

        <script src="<?= base_url() ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= base_url() ?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
