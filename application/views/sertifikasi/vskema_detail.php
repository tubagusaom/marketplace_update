<style>
    .panel-table .panel-body{
        padding:0;
    }

    .panel-table .panel-body .table-bordered{
        border-style: none;
        margin:0;
    }

    .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
        text-align:center;
        width: 100px;
    }

    .panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
    .panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
        border-right: 0px;
    }

    .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
    .panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
        border-left: 0px;
    }

    .panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
        border-bottom: 0px;
    }

    .panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
        border-top: 0px;
    }

    .panel-table .panel-footer .pagination{
        margin:0;
    }

    /*
    used to vertically center elements, may need modification if you're not using default sizes.
    */
    .panel-table .panel-footer .col{
        line-height: 34px;
        height: 34px;
    }

    .panel-table .panel-heading .col h3{
        line-height: 30px;
        height: 30px;
    }

    .panel-table .panel-body .table-bordered > tbody > tr > td{
        line-height: 19px;
    }


</style>

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li class="active"><a href="<?= base_url() . 'sertifikasi/vskema/0' ?>">Skema Kompetensi</a></li>
                    <li style="color:#ccc;"><?= $unit_kompetensi[0]->skema ?></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>DETAIL SKEMA</h1>
                </div>
            </div>
        </div>
    </section>

<section class="main-container">

    <div class="container">
        <div class="col-md-12" style="background: white;padding: 5px;border-bottom: 0px solid #ccc;">
            <div class="col-md-12 well">
                <div class="col-md-2" style="text-align: right;">Kode Skema :</div><div style="text-align: left;" class="col-md-9"><?= $unit_kompetensi[0]->kode_skema ?></div>
                <div class="col-md-2" style="text-align: right;">Judul Skema :</div><div style="text-align: left;" class="col-md-9"><?= $unit_kompetensi[0]->skema ?></div>
                <div class="col-md-2" style="text-align: right;">Dokumen Skema :</div><div style="text-align: left;" class="col-md-9"><a  target="_blank" href="<?= $unit_kompetensi[0]->link_download ?>">Link Download</a></div>
                <div class="col-md-2" style="text-align: right;">Ringkasan Skema :</div><div style="text-align: left;" class="col-md-9"><?= $unit_kompetensi[0]->description ?></div>

                <div class="col-md-2" style="text-align: right;"></div><div style="text-align: left;margin-top: 20px;" class="col-md-9"><a href="<?= base_url() . 'welcome/uji_kompetensi' ?>"  class="btn btn-info" role="button">Pendaftaran Uji Kompetensi</a></div>

            </div>
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-md-7">
                            <h3 class="panel-title">Daftar Unit Kompetensi </h3>
                        </div>
                        <div class="col col-md-5 text-right">

                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list">
                        <thead>
                            <tr>
                                <th>Kode Unit</th>
                                <th>Unit Kompetensi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($unit_kompetensi as $key => $value) { ?>
                                <tr>
                                    <td align="center">
                                        <?= $value->id_unit_kompetensi ?>
                                    </td>
                                    <td>
                                      <?= $value->unit_kompetensi ?>
                                      <br><hr style="margin:3px; padding:0px;background-color:#ccc">
                                      <?= $value->translate ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>

</section>
