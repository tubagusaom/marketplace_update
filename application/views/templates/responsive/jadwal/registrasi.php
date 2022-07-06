
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
                    <span>Jadwal</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Pendaftaran</span>
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
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= base_url() . 'jadwal/add' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Pilih Jadwal Uji Kompetensi</label>
                            <div class="col-md-9">
                                <input type="hidden" name="id_jadwal" value="<?= $id ?>">

                                <?php echo $row_jadwal_combo[$id]; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Metode Pembayaran</label>
                            <div class="col-md-9">

                                <?php echo form_dropdown('metode_bayar', array(""=>"-Pilih-","Perseorangan"=>"Perseorangan", "Kolektif"=>"Kolektif"), '', 'class="form-control" id="metode_bayar" onchange="kolektif()"'); ?>
                                <span class="help-block"> Kolektif / Administrasi pembayaran di kelola oleh perusahaan atau Lembaga pengusul. Pribadi / Administrasi pembayaran di bayar secara personal </span>
                            </div>
                        </div>
                        <div class="form-group div_kolektif" style="display: none;">
                            <label class="control-labelx col-md-3">Nama Lembaga </label>
                            <div class="col-md-9">
                                <input type="text" name="organisasi" class="form-control" >

                                <span class="help-block"> Perusahaan/Lembaga tempat bekerja </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Tujuan Asesmen</label>
                            <div class="col-md-9">
                                <?php echo form_dropdown('tujuan_asesmen', array("Sertfikasi", "RCC", "RPL", "Pencapaian Proses Pembelajaran"), '', 'class="form-control" '); ?>
                                <span class="help-block"> </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label col-md-12">Biodata Peserta Uji. <a href="<?= base_url() . 'profil/index' ?>">Update</a></label>

                        </div>

                        <div class="form-group">
                            <label class="control-labelx col-md-3">No Identitas</label>
                            <div class="col-md-9">
                                <?= $biodata->no_identitas ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Nama Lengkap</label>
                            <div class="col-md-9">
                                <?= $biodata->nama_user ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-labelx col-md-3">Tempat Lahir</label>
                            <div class="col-md-9">
                                <?= $biodata->tempat_lahir ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <?= tgl_indo($biodata->tgl_lahir) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <?php
                                $jenis_kelamin = array('1' => 'Laki-laki', '2' => 'Perempuan');
                                $kewarganegaraan = array('1' => 'WNI', '2' => 'WNA');
                                echo $jenis_kelamin[$biodata->jenis_kelamin]
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Kewarganegaraan</label>
                            <div class="col-md-9">
                                <?= $kewarganegaraan[$biodata->kewarganegaraan] ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Email</label>
                            <div class="input-group">

                                <?= $biodata->email ?> </div>

                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">No HP</label>
                            <div class="input-group">

                                <?= $biodata->hp ?></div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <?= $biodata->alamat ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-labelx col-md-3">Data Pekerjaan</label>
                            <div class="col-md-9">
                                <?php
                                $dpekerjaan = array();
                                foreach ($data_pekerjaan as $pekerjaan) {
                                    $dpekerjaan[] = $pekerjaan->nama_pekerjaan;
                                }

                                echo implode(", ", $dpekerjaan);
                                ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">
                                        <i class="fa fa-save"></i> Submit APL 01</button>

                                </div>
                            </div>
                        </div>
                </form>
                <!-- END FORM-->
            </div>
            <script type="text/javascript">
                function kolektif() {
                    //console.log($(this));
                    var ok = $('#metode_bayar').val();
                    if (ok == '0') {
                        $('.div_kolektif').hide();
                    } else {
                        $('.div_kolektif').show();
                    }

                }
            </script>
