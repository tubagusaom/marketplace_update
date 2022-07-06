<style type="text/css">
    .cnegara{
        display: none;
    }
</style>
<link href="<?= base_url(); ?>assets/plugins/select2-4.0.3/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
<div class="col-xs-12 formStep2">
    <div class="col-md-12" style="margin-bottom: 20px;">

        <fieldset><legend><h3> FR-APL-01. FORMULIR PERMOHONAN SERTIFIKASI KOMPETENSI</h3>
                <h5> Pada bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini. Untuk bagian yang bertanda (*) wajib di isi.</h5></legend></fieldset>
       
    <div class="col-md-3">
            <label class="control-label">Pendaftar <b class="harus_diisi">*</b></label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
            <select name="marketing" id="marketing" class="form-control">
                <option value="perorangan">Perorangan</option>
                <option value="organisasi">Organisasi</option>
                <option value="jejaring">Jejaring</option>
            </select>
            </div>
        </div>
        <div class="col-md-3">
            <label class="control-label">No.Identitas <b class="harus_diisi">*</b></label>
        </div>
        <div class="col-md-9">
            <div class="form-group">

                <input  maxlength="100" type="text" name="no_identitas" id="no_identitas" required class="form-control" placeholder="Masukkan Nomor Identitas (KTP)"  /> 
                <input type="hidden" id="step_langkah">      </div>
        </div>
        <div id="div_pilih">

        </div>
        <div class="col-md-3">
            <label class="control-label">Nama Lengkap <b class="harus_diisi">*</b> </label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <input  maxlength="100" type="text" name="nama_lengkap" id="nama_lengkap" required class="form-control" placeholder="Masukkan Nama Lengkap"  />       </div>
        </div>
        

        <div class="col-md-3">
            <label class="control-label">Sertifikasi Ulang </label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <input  maxlength="100" type="checkbox" name="is_perpanjangan" id="is_perpanjangan" value="1"   /> Checklist jika merupakan perpanjangan sertifikat sebelumnya      </div>
        </div>
        <div class="col-md-3">
            <label class="control-label">Tempat - Tanggal Lahir</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input  maxlength="100" type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir"  />      

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input  maxlength="100" type="text" id="tanggal_lahir" name="tanggal_lahir"  class="form-control" placeholder="Contoh 05/10/1985"  />        </div>
        </div>        

        <div class="col-md-3">
            <label class="control-label">Jenis Kelamin </label>
        </div>

        <div class="col-md-9">
            <div class="form-group">

                <select class="form-control validate[required]" name="jenis_kelamin" id="jenis_kelamin" >
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                </select>
            </div>
            <div id="div_bukti" style="display:none;"></div>

        </div>

        <div class="col-md-3">
            <label class="control-label">Kewarganegaraan</label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <select class="form-control" name="kewarganegaraan" id="kewarganegaraan">
                    <option value="">Pilih</option>
                    <option value="WNI">WNI</option>
                    <option value="WNA">WNA</option>
                </select>     
            </div>
            
        </div>
        
        <div class="col-md-3">
            <label class="control-label">Provinsi</label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <input name="provinsi" id="provinsi" class="form-control" placeholder="Ketikkan Provinsi"> </input>
            </div>
        </div>


        <div class="col-md-3">
            <label class="control-label">Alamat</label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap Domisili"> </textarea>
            </div>
        </div>

        <div class="col-md-3">
            <label class="control-label">No.Telp  <b class="harus_diisi">*</b> </label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <input  maxlength="100" type="text" name="no_telp" id="no_telp" required class="form-control" placeholder="Masukkan No Telp"  />   
            </div>
        </div>

        <div class="col-md-3">
            <label class="control-label">Email  <b class="harus_diisi">*</b> </label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <input  maxlength="100" type="text" name="email" id="email" required class="form-control" placeholder="Masukkan Email"  />   
                <input type="hidden" id="validasi_email">

            </div>
        </div>

        <div class="col-md-3">
            <label class="control-label">Pendidikan Terakhir</label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
            <select class="form-control" name="pend_terakhir" id="pend_terakhir">
              <option value="">- Pilih Pendidikan Terakhir -</option>
              <option value="SMA SEDERAJAT">SMA SEDERAJAT</option>
              <option value="D1">D1</option>
              <option value="D2">D2</option>
              <option value="D3">D3</option>
              <option value="S1">S1</option>
              <option value="S2">S2</option>
              <option value="S3">S3</option>
            </select>
                  
            </div>
        </div>
        <!--
        <div class="col-md-3">
            <label class="control-label">Nama Sekolah / Perguruan Tinggi </label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
            -->
                <input  maxlength="100" type="hidden" name="perg_tinggi" id="perg_tinggi"  class="form-control" value="Home Depo"  />   
            <!-- </div>
        </div> -->


        <div class="col-md-3">
            <label class="control-label">Program Studi</label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <select class="form-control" name="jurusan" id="jurusan">
                  <option value="">- Pilih Program Studi -</option>
                  <?php foreach($prodi as $prodi):?>
                  <option value="<?= $prodi->program_studi ?>"><?= $prodi->program_studi ?></option>
                  <?php endforeach; ?>
                </select>
                  
            </div>
        </div>


        
        <div class="col-md-3">
            <label class="control-label">Jabatan</label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <input  maxlength="100" type="text" name="jabatan" id="jabatan"  class="form-control"  placeholder="Masukkan Jabatan"  />    
            </div>
        </div>

        
        <div class="col-md-3">
            <label class="control-label">Jadual Uji Kompetensi</label>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <select name="jadwal_id" id="jadwal_id" class="combobox form-control select2" required >
                <?php foreach ($data_jadwal as $result) { ?>
                <?php 
                //$jadwal_time = strtotime($result->tanggal);
                if(strtotime(date('Y-m-d')) <= strtotime($result->tanggal)){ 
                
                ?>
                    <option value="<?php echo $result->id ?>">
                        <?php echo $result->jadual ?>
                    </option>
                <?php }}?>
            </select>  
                <div style="margin-top:20px; margin-bottom:20px;"> 
                    <button id="selanjutnya-2" class="btn btn-success nextBtn btn-md pull-left" type="button" >Selanjutnya (Langkah 3)</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?= base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/plugins/select2-4.0.3/dist/js/select2.full.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $("#id_provinsi").select2({
        placeholder: "Provinsi",
        allowClear: true
    });

    $("#jadwal_id").select2({
        placeholder: "Jadwal",
        allowClear: true
    });

    $('#kewarganegaraan').change(function(){
        var warga = $(this).val();

        if (warga == "WNA") {
            $(".cnegara").show();
        } else{
            $(".cnegara").hide();
        }
    });
</script>    