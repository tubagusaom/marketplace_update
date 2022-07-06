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
                      <?= $table ?>
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
