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
                    <span>Sertifikasi</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?= base_url() ?>sertifikasi/pra_asesmen">Pra Asesmen</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Edit Pra Asesmen</span>
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
                            <span class="caption-subject bold uppercase">Edit Pra Asesmen</span>
                        </div>

                    </div>
                    <div class="portlet-body table-responsive">
                      <form class="" action="<?php echo base_url('sertifikasi/pra_asesmen_update') ?>" method="post">
                        <table class="table" >
                            <thead>
                                <tr>
                                  <th>Bukti Pendukung</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="odd gradeX">
                                <td>

                                  <table class="table table-striped table-bordered table-hover " >
                                    <thead>
                                      <tr>
                                        <th>Dokumen</th>
                                        <th>Validitas</th>
                                      </tr>
                                    </thead>

                                    <tbody>
                                      <?php
                                        $validitas_dokumen = unserialize($data_asesi->validitas_dokumen);
                                        foreach ($files_asesi as $key => $value) {

                                          $extFile = explode(".", @$value->nama_file);
                                          $jmlArr = count($extFile) - 1;
                                          switch ($extFile[$jmlArr]) {
                                              case "ppt":
                                                  $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . strtoupper($value->nama_dokumen) . "</a>";
                                                  break;
                                              case "pptx":
                                                  $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . strtoupper($value->nama_dokumen) . "</a>";
                                                  break;
                                              case "doc":
                                                  $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . strtoupper($value->nama_dokumen) . "</a>";
                                                  break;
                                              case "docx":
                                                  $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . strtoupper($value->nama_dokumen) . "</a>";
                                                  break;
                                              case "xls":
                                                  $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . strtoupper($value->nama_dokumen) . "</a>";
                                                  break;
                                              case "xlsx":
                                                  $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . strtoupper($value->nama_dokumen) . "</a>";
                                                  break;
                                              default:
                                                  $linkFile = "<a href='" . base_url('repo/asesi/' . @$value->nama_file) . "' target='_blank'>" . strtoupper($value->nama_dokumen) . "</a>";
                                                  break;
                                          }
                                      ?>
                                        <tr>
                                          <td><?=$linkFile?> </td>
                                          <td width="5%" align="center">
                                            <input class="checkbox_validitas" type="checkbox" name="validitas_dokumen[<?=$key?>]" value="1" <?=isset($validitas_dokumen[$key]) && $validitas_dokumen[$key]=='1' ? 'checked' : '' ?> />
                                          </td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>

                                </td>
                              </tr>
                            </tbody>

                            <!-- batas 1 -->

                            <thead>
                                <tr>
                                  <th colspan="2">Biodata Peserta / APL 01</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="odd gradeX">
                                <td>

                                  <table class="table table-bordered" >
                                    <thead>
                                      <tr>
                                        <td width="20%">No Identitas</td>
                                        <td width="80%"><?=$data_asesi->no_identitas ?></td>
                                      </tr>
                                      <tr>
                                        <td>Nama Lengkap</td>
                                        <td><?=$data_asesi->nama_lengkap ?></td>
                                      </tr>
                                      <tr>
                                        <td>Telpon</td>
                                        <td><?=$data_asesi->telp ?></td>
                                      </tr>
                                      <tr>
                                        <td>Email</td>
                                        <td><?=$data_asesi->email ?></td>
                                      </tr>
                                      <tr>
                                        <td>Tempat Lahir</td>
                                        <td><?=$data_asesi->tempat_lahir ?></td>
                                      </tr>
                                      <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>
                                          <?php
                                            $jk=$data_asesi->jenis_kelamin;
                                            if ($jk == 1) {
                                              echo "Laki - Laki";
                                            }elseif ($jk == 2) {
                                              echo "Perempuan";
                                            }else {
                                              echo "";
                                            }
                                          ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>Alamat</td>
                                        <td><?=$data_asesi->alamat ?></td>
                                      </tr>
                                    </thead>
                                  </table>

                                </td>
                              </tr>
                            </tbody>

                            <!-- batas 2 -->

                            <thead>
                                <tr>
                                  <th colspan="2">Asesmen Mandiri / APL 02</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr class="odd gradeX">
                                <td>

                                  <table class="table" >
                                    <thead>
                                      <?=$apl02 ?>
                                    </thead>
                                  </table>

                                </td>
                              </tr>
                            </tbody>

                            <!-- batas 3 -->

                            <thead>
                              <tr>
                                <th colspan="2">Hasil Rekomendasi Pra Asesmen</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="odd gradeX">
                                <td>

                                  <table class="table" >
                                    <thead>
                                      <tr>
                                        <td width="20%">Perangkat yang digunakan</td>
                                        <td width="80%">
                                          <?php
                                            $valid_perangkat = unserialize($data_asesi->valid_perangkat);
                                            foreach ($perangkat as $key => $value) {
                                          ?>

                                            <input class="checkbox_validitas" type="checkbox" name="perangkat[<?=$key?>]" value="1" <?=isset($valid_perangkat[$key]) && $valid_perangkat[$key]=='1' ? 'checked' : '' ?> /> <?=$value->perangkat_detail?><br>

                                          <?php } ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="20%">Hasil Rekomendasi Pra Asesmen</td>
                                        <td width="80%" width="80%">
                                          <select class="form-control" id="sel1">
                                            <option>-</option>
                                            <option>Lanjut</option>
                                            <option>Tidak Lanjut</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>Catatan Asesmen</td>
                                        <td> <textarea class="form-control" rows="3" id="comment"></textarea> </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                          <input type="submit" name="" value="Simpan" class="btn btn-primary btn-block">
                                        </td>
                                      </tr>
                                    </thead>
                                  </table>

                                </td>
                              </tr>
                            </tbody>
                        </table>
                      </form>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
  </div>
