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
                    <a href="#">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Proses Sertifikasi</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Detail</span>
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
                <form action="<?= base_url() . 'profil/edit' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">

                        <input name="organisasi" value="<?= $id ?>" type="hidden" placeholder="Organisasi" class="form-control" />

                        <div class="form-group">
                            <label class="control-label col-md-3">Skema Sertifikasi</label>
                            <div class="col-md-9">
                                <b><?= $detail_asesmen->skema ?></b>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Sertifikat Kompetensi</label>
                            <div class="input-group">
                            <?php if ($detail_asesmen->file_sertifikat == "" && $detail_asesmen->file_sertifikat_belakang == "") {
                            ?>
                            <img style="float: left;margin: 10px;" src="<?= base_url()?>assets/img/logo_mes.png" class="img-thumbnail" width="300px">
                            <img style="float: left;margin: 10px;" src="<?= base_url()?>assets/img/logo_mes.png" class="img-thumbnail" width="300px">

                            <?php
                                } else {
                            ?>
                                <img style="float: left;margin: 10px;" src="<?= $detail_asesmen->file_sertifikat ?>" class="img-thumbnail" width="300px">
                                <img src="<?= $detail_asesmen->file_sertifikat_belakang ?>" class="img-thumbnail" width="300px" style="margin: 10px;">
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"></label>
                            <div class="input-group">
                                <a href="<?= base_url() . 'sertifikasi/detail/' . $id ?>" class="btn btn-primary">Kembali</a></div>
                        </div>

                </form>
                <!-- END FORM-->
            </div>
</div></div></div>
          