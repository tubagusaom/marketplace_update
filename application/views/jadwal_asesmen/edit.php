<div class="form-panel" style="margin-left: 20px;margin-top: 20px; margin-bottom: 30px;">
    <div class="x-panel-bwrap">
        <form id="myform">
            <div id="tips">
                <ol class="rounded-list">
                    <li><a href="javascript: void(0)">Data pengajuan jadwal</a></li>
                </ol>
            </div>
            <table class="table-data">
                <input type="hidden" name="status_jadwal" value="0">
                <!-- <input value="<?=$data->id ?>" class="easyui-textbox"> -->
                <tr>
                    <td style="width: 150px;">Nama Jadwal : </td>
                    <td>
                        <input name="jadual" value="<?= $data->jadual ?>" class="easyui-textbox" style="width: 450px;">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Skema Sertifikasi : </td>
                    <td>
                        <?php echo form_dropdown('id_skema', $skema_grid, $data->id_skema, 'id="id_skema" style="width:450px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Angkatan : </td>
                <input type="hidden" name="id_tuk" value="<?= $data->id_tuk ?>">

                <td><input type="hidden" name="nama_mahasiswa_hidden" value="<?= $nama_string_mahasiswa ?>">
                    <input type="hidden" name="id_skema" value="<?= $row_skema->id ?>">
                    <?php echo form_dropdown('id_angkatan', $angkatan, $data->id_angkatan, 'id="id_angkatan" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Program Studi : </td>
                    <td>
                        <?php echo form_dropdown('id_prodi', $prodi, $data->id_prodi, 'id="id_prodi" style="width:250px;" class="easyui-combobox"  data-options="required: true"'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Kelas : </td>
                    <td><?= $data->kelas ?>
                        <input id="kelas" name="kelas" type="hidden" value="<?= $data->kelas ?>">

                    </td>
                </tr>
                <tr>
                    <td>Semester : </td>
                    <td><?= $data->semester ?>
                        <input id="semester_calon" name="semester" type="hidden" value="<?= $data->semester ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Tanggal Mulai: </td>
                     <td>
                        <?php
                            if($data->tanggal == ""){
                                $tanggal = date('d/m/Y', strtotime(date('Y-m-d')));
                            }else{
                                $tanggal = date('d/m/Y', strtotime($data->tanggal));
                            }
                                                    ?>
                        <input id="tanggal" name="tanggal" style="width: 200px;" class="easyui-datebox" value="<?php echo $tanggal ?>">
                    </td>
                </tr>
                 <tr>
                    <td style="width: 150px;">Tanggal Berakhir: </td>
                     <td>
                        <?php
                            if($data->tanggal_akhir == ""){
                                $tanggal_akhir= date('d/m/Y', strtotime(date('Y-m-d')));
                            }else{
                                $tanggal_akhir= date('d/m/Y', strtotime($data->tanggal));
                            }
                                                    ?>
                        <input id="tanggal_akhir" name="tanggal_akhir" style="width: 200px;" class="easyui-datebox" value="<?php echo $tanggal_akhir?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 140px;">Jumlah Asesi : </td>
                    <td><input id="jumlah_asesi" name="jumlah_asesi" type="hidden" value="<?= $data->jumlah_asesi ?>">
                        <?= $data->jumlah_asesi ?>
                    </td>
                </tr>
                <tr>
                <input type="hidden" name="status_jadwal_hidden" value="<?= $data->status_jadwal ?>">
                <td style="width: 140px;">Status permohonan : </td>
                <td><?php echo form_dropdown('status_jadwal', array('0' => 'Permohonan Baru', '1' => 'Disetujui', '2' => 'Ditolak'), $data->status_jadwal, 'id="status_jadwal" style="width:250px;height:auto;" class="easyui-combobox"  data-options="required: true"'); ?>
                </td>
                </tr>

            </table>
            <h4>Daftar Calon Peserta</h4>
            <?= $nama_mahasiswa ?>
            <h4>Mapping Unit Kompetensi</h4>
            <table border="1" style="width:99%;">
                <tr>
                    <th>No</th>
                    <th>Kode Unit Kompetensi</th>
                    <th>Judul Unit Kompetensi</th>
                    <th>Asesor Kompetensi</th>

                </tr>
                <?php
                foreach ($unit_kompetensi as $key => $value) {
                   
                    ?>
                    <tr>
                        <td><?= ($key + 1) ?></td>
                        <td><?= $value->id_unit_kompetensi ?><input type="hidden" name="kode_unit_hidden[]" value="<?= $value->id_unit_kompetensi ?>"></td>
                        <td><?= $value->unit_kompetensi ?> <input type="hidden" name="unit_hidden[]" value="<?= $value->unit_kompetensi ?>"></td>
                        <td><?= $asesor ?></td>
                    </tr>
                <?php } ?>
            </table>

        </form>
    </div>
</div>

