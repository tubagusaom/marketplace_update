<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <a href="<?= base_url() ?>">Home</a>
          <i class="fa fa-circle"></i>
        </li>
        <li>
          <span>Dashboard Sertifikasi</span>
        </li>
      </ul>
      <div class="page-toolbar">
        <div>
          <?= tgl_indo(date('Y-m-d')) ?>
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
        </div>
      </div>
    </div>

    
    <div class="row">
      <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th colspan="4"><b>Jadwal Uji Kompetensi</b></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data_aktivitas as $key => $value) { ?>
              <tr>
                <td colspan="4">
                  <?=$value->skema ?>
                </td>
              </tr>
              <tr>
                <td colspan="4">
                  <?php
                    if ($value->jenis_perangkat == 2) {
                      $mthod = "detail";
                    }else if($value->jenis_perangkat == 1){
                      $mthod = "uji";
                    }else if($value->jenis_perangkat == 6){
                      $mthod = "portofolio";
                    }else if($value->jenis_perangkat == 4){
                      $mthod = "wawancara";
                    } else {
                      $mthod = "portofolio";
                    }

                    if (count($value->perangkat_detail) == '') {
                      echo "<font style='color:red'>Perangkat Uji Masih Kosong</font>";
                    } else {
                  ?>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th width="3%">#</th>
                            <th>Nama Perangkat</th>
                            <th>Waktu</th>
                            <th>Download</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            date_default_timezone_set('Asia/Jakarta');
                            $val2 = date('Y-m-d H:i:s');

                            if ($value->tanggal < $val2) {
                              echo '<tr><td>'.($key+1).'</td><td>' . $value->perangkat_detail . '</td>
                                    <td>' . $value->waktu_pengerjaan . ' Menit</td>
                                    <td><a target="_blank" href="' . base_url() . 'perangkat_asesmen/' . $mthod . '/'.$value->id .'">Link</a></td></tr>';
                            }else {
                              echo '<tr><td colspan="4">Perangkat Uji Belum tersedia</td><tr>';
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>

                  <?php } ?>
                </td>
              </tr>

            <?php } ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
</div>
