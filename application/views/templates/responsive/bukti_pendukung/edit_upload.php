
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
                    <span>Bukti Pendukung</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Ubah</span>
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
                <form enctype="multipart/form-data" action="<?= base_url() . 'bukti_pendukung/edit_upload' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
                    <input value="<?=$row->id?>" name="id" type="hidden" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis Dokumen</label>
                            <div class="col-md-9">

                                <?php echo form_dropdown('jenis_portofolio', array('1' => 'Pendidikan Formal', '2' => 'Sertifikasi', '3' => 'Pelatihan', '4' => 'Penghargaan', '5' => 'Hasil Kerja / Portofolio', '6' => 'LAIN_LAIN'), $row->jenis_portofolio, 'class="form-control"'); ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"> Nama Dokumen</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-folder"></i>
                                </span>
                                <input value="<?=$row->nama_dokumen?>" name="nama_dokumen"  required type="text" class="form-control" placeholder="Nama Dokumen"> </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">File</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-file"></i>
                                </span>
                                <input name="nama_file" required type="file" class="form-control" placeholder="Browse File" value="<?=$row->nama_file?>"> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Deskripsi Dokumen</label>
                            <div class="col-md-9">
                                <textarea name="description" rows="4" class="form-control"><?=$row->description?></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">
                                        <i class="fa fa-check"></i> Ubah Dokumen</button>

                                </div>
                            </div>
                        </div>
                </form>
                <!-- END FORM-->
            </div>
