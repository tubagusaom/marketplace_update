  <div class="page-content-wrapper">
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
                            <span class="caption-subject bold uppercase">Pra Asesmen</span>
                        </div>

                    </div>
                    <div class="portlet-body table-responsive">

                        <table class="table table-striped table-bordered table-hover " >
                            <thead>
                              <tr>
                                <!-- <th>#</th> -->
                                <th>Nama Lengkap</th>
                                <th>Kode / Judul Unit</th>
                                <th>L / TL</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($data as $key => $value) { ?>
                              <tr>
                                  <!-- <input type="radio" id="id" name="id" class="test" value="<?= $value->id ?>"></td> -->
                                  <td style="width: 35%;"><a href="<?= site_url().'pra_asesmen/edit_asesor/'.$value->id ?>"> <?= $value->nama_calon ?></a></td>
                                  <td style="width: 55%;"><?= $value->judul_unit ?></td>
                                  <td style="width: 10%;"><?= $status[$value->pra_asesmen] ?></td>
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
