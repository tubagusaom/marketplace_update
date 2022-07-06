  <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?= base_url() ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Perangkat Asesmen</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Hasil Jawaban</span>
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
                            <span class="caption-subject bold uppercase">Hasil Jawaban</span>
                        </div>

                    </div>
                    <div class="portlet-body table-responsive">

                        <table class="table table-striped table-bordered table-hover " >
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Nama Asesi</th>
                                <th>Skema Sertifikasi</th>
                                <th>B</th>
                                <th>S</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $no = 0; foreach ($data as $key => $value) { $no++; $total += count($value->skema); ?>
                                <tr>
                                  <td style="width: 5%;"><?= $no ?></td>
                                  <td style="width: 40%;text-align: left;padding-left: 3px;"><a href="<?=base_url().'hasil/proses_dpl/'.$value->id_asesi.'/'.$value->id_perangkat_detail ?>" ><?= strtoupper($value->nama_lengkap) ?></a></td>
                                  <td style="width: 35%;"><b><?= $value->skema ?></b></td>
                                  <td style="width: 10%;"><?= $value->jawaban_benar ?></td>
                                  <td style="width: 10%;"><?= $value->jawaban_salah ?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pagination-round">
                      <?= $halaman ?>
                    </div>                    
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>        
    </div>
  </div>        