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
                      <form id="pra_asesmen">
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
                                        $validitas_dokumen = unserialize($data->validitas_dokumen);
                                        foreach ($dokumen_asesi as $key => $value) {

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
                                            <input type="hidden" name="id" value="<?= $data->id ?>">
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
                                        <td width="80%"><?=$biodata->no_identitas ?></td>
                                      </tr>
                                      <tr>
                                        <td>Nama Lengkap</td>
                                        <td><?=$biodata->nama_user ?></td>
                                      </tr>
                                      <tr>
                                        <td>Telpon</td>
                                        <td><?=$biodata->hp ?></td>
                                      </tr>
                                      <tr>
                                        <td>Email</td>
                                        <td><?=$biodata->email ?></td>
                                      </tr>
                                      <tr>
                                        <td>Tempat Lahir</td>
                                        <td><?=$biodata->tempat_lahir ?></td>
                                      </tr>
                                      <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>
                                          <?php
                                            $jk=$biodata->jenis_kelamin;
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
                                        <td><?=$biodata->alamat ?></td>
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
                          <?php
                          if ($data->perangkat != "") {
                              $perangkat_asesmen = @unserialize($data->perangkat);
                          } else {
                              $perangkat_asesmen = array('1', '3');
                          }
                          ?>                              
                            <thead>
                              <tr>
                                <th colspan="2">Perangkat Yang Digunakan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="odd gradeX">
                                <td>
                                  <table class="table">
                                    <tr>
                                      <td>
                                          <select name="perangkat[]" multiple required style="width: 100%;"> 
                                            <?php
                                            foreach ($data_perangkat as $key => $value) {
                                              if (in_array($key, $perangkat_asesmen)) {
                              //if ($perangkat_asesmen[$key] == $key) {
                                                $selected = 'selected';
                              //$test = $perangkat_asesmen[$key];
                                              } else {
                                                $selected = '';
                              //$test = '00';
                                              }
                                              echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                                            }
                                            ?>
                                          </select>                                         
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
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
                                        <td width="20%">Hasil Rekomendasi Pra Asesmen</td>
                                        <td width="80%" width="80%">
<!--                                           <select class="form-control" name="pra_asesmen" id="sel1">
                                            <option value="0" <?= ($data->pra_asesmen == '0' ? 'selected="selected"' :'') ?>>-</option>
                                            <option value="1" <?= ($data->pra_asesmen == '1' ? 'selected="selected"' :'') ?>>Lanjut</option>
                                            <option value="2" <?= ($data->pra_asesmen == '2' ? 'selected="selected"' :'') ?>>Tidak Lanjut</option>
                                          </select> -->
                                           <?php echo form_dropdown('pra_asesmen', array('-', 'Lanjut', 'Tidak Lanjut'), $data->pra_asesmen, 'id="base" class="form-control"  data-options="required: true"'); ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>Catatan Asesmen</td>
                                        <td> <textarea class="form-control" rows="3" name="pra_asesmen_description"><?= $data->pra_asesmen_description ?></textarea> </td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                          <a id="simpan" class="btn btn-primary btn-block"> Simpan </a>
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

  <script>
    $(document).ready(function() {
         $('a#simpan').click(function(){;
            $.ajax({
                url: base_url + 'pra_asesmen/save_asesor',
                type: 'POST',
                dataType: 'JSON',
                data: $('#pra_asesmen').serialize(),
                success: function(response) {
                  if (response.msgType == 'success') {
                    var options =  {
                        content: response.msgValue, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function(){ } // callback called when the snackbar gets closed.
                    }

                    $.snackbar(options);    

                    window.setTimeout(function(){
                            document.location.replace(document.referrer)
                    }, 3000);                                     
                  }else{
                    var options =  {
                        content: response.msgValue, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 3000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function(){ } // callback called when the snackbar gets closed.
                    }

                    $.snackbar(options);                        
                  }
                }
            });           
         });      
    });
  </script>
