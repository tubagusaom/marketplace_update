<div class="col-md-12 formStep3">
    <fieldset><legend><h3> UPLOAD BUKTI PENDUKUNG</h3>
            <h5>Upload beberapa dokumen yang menunjukan bukti pemenuhan persyaratan dasar sertifikasi yang ditetapkan dalam dokumen skema sertifikasi.</h5></legend></fieldset>
    <div class="col-md-12" id="div_unit_dipilih">
        <div id="unit_dipilih"></div>
    </div>

    <div class="col-md-12" id="div_list_bukti_pendukung">
        <div class="alert alert-info">
            Pada bagian ini, anda diminta untuk memilih bukti-bukti pendukung yang anda anggap relevan terhadap setiap elemen/KUK unit kompetensi. Pilihan dapat lebih dari 1(Satu) bukti pendukung.
            Tekan tombol <input type="button" class="btn btn-info" style="margin-top: 5px;" value="Tambah Dokumen" />
            untuk menambah kolom input untuk bukti pendukung selain dari mandatori dokumen(Paspoto, Ijazah Terakhir, Identitas Pribadi)
        </div>

        <div class="col-md-6 col-xs-12" align="right">Foto (Passfoto) <b class="harus_diisi">*</b> :</div>
        <div class="col-md-6 col-xs-12">
            <input type="hidden" name="nama_dokumen[]" class="nama_dokumen" value="foto" />
            <input  accept="image/*,.pdf" type="file" name="file_data[]" id="foto" class="form-control input-sm uploadData" required />
        </div>
        <div style="clear: both;margin-bottom: 10px;"></div>

        <div class="col-md-6 col-xs-12" align="right">Identitas Pribadi (KTP / SIM / Kartu Pelajar / Passport) <b class="harus_diisi">*</b> :</div>
        <div class="col-md-6 col-xs-12">
            <input type="hidden" name="nama_dokumen[]" class='nama_dokumen' value="ktp" />
            <input  accept="image/*,.pdf"  type="file" name="file_data[]" id="ktp" class="form-control input-sm uploadData" required />
        </div>
        <div style="clear: both;margin-bottom: 10px;"></div>

        <div class="col-md-6 col-xs-12" align="right">CV (daftar riwayat hidup) <b class="harus_diisi">*</b> :</div>
        <div class="col-md-6 col-xs-12">
            <input type="hidden" name="nama_dokumen[]" id="ijazah" class="nama_dokumen" value="ijazah" />
            <input accept="image/*,.pdf" type="file" name="file_data[]" class="form-control input-sm uploadData" required />
        </div>
        <div style="clear: both;margin-bottom: 10px;"></div>

        <div class="col-md-6 col-xs-12" align="right">Bukti Pendukung Kompetensi <b class="harus_diisi">*</b> :</div>
        <div class="col-md-6 col-xs-12">
            <input type="hidden" name="nama_dokumen[]" id="ijazah" class="nama_dokumen" value="ijazah" />
            <input accept="image/*,.pdf" type="file" name="file_data[]" class="form-control input-sm uploadData" required />
        </div>
        <div style="clear: both;margin-bottom: 10px;"></div>

        <div style="clear: both;margin-bottom: 10px;"></div>
        <fieldset>
            <legend>Upload Dokumen Tambahan / Lainnya</legend>
            <div class="col-md-12 col-xs-12" id="addmore">
                <button type="button" name="btn_addmore" id="btn_addmore" class="btn btn-info">Tambah Dokumen</button>
            </div>
            <div style="clear: both;margin-bottom: 10px;"></div>

            <div class="dokumen_tambah"></div>
        </fieldset>

        <div style="clear: both;margin-bottom: 30px;"></div>
        <!--
                <fieldset><legend>IJAZAH PENDIDIKAN FORMAL ATAU BIODATA PRIBADI</legend>
                    <input type="hidden"  name="wajib1" id="wajib1"  required>
                    <input type="hidden"  name="folder" id="folder" value="<?= $folder ?>"  required>
                    <input type="hidden"  name="drophidden" id="drophidden"  required>
                    <div class="col-md-12">
                        <input type="button" id="bukti_pendukung_add" class="btn btn-primary" style="margin-top: 5px;" value=" ADD MORE ">
                    </div>
                    <div id="list_isi"></div>
                </fieldset>
                <br />
        
                <fieldset><legend>SERTIFIKAT KETERAMPILAN / PELATIHAN</legend>
                    <div class="col-md-12">
                        <input type="button" id="bukti_pendukung_add2" class="btn btn-primary" style="margin-top: 5px;" value=" ADD MORE ">
                    </div>
                    <div id="list_isi2"></div>
        
                </fieldset><br />
        
                <fieldset><legend>PORTOFOLIO / PENGALAMAN KERJA</legend>
                    <div class="col-md-12">
                        </form>
        
        
                        <input type="button" id="bukti_pendukung_add3" class="btn btn-primary" style="margin-top: 5px;" value=" ADD MORE ">
                    </div>
                    <div id="list_isi3"></div>
                </fieldset>
        
                <br />
        
                <div class="alert alert-warning" style="margin-top: 10px;">
                    Note : Dapat lebih dari 1 bukti pendukung.
                </div>
        
                <fieldset><legend>UPLOAD BUKTI PENDUKUNG </legend>
                    <div class="col-md-12">
        
                        <div id="upload_drop" class="dropzone"></div>
                    </div>
        
        
                </fieldset>-->

        <br />
        <div class="col-md-12" style="margin-bottom: 20px;">
            <button class="btn btn-success nextBtn btn-md pull-left" type="button" id="selanjutnya-3">Selanjutnya (Langkah 4)</button>
        </div>   
    </div>

</div>

<script type="text/javascript">

    $("#btn_addmore").click(function () {

        var addmore = $(".dokumen_tambah");
        var item = "<div style='clear:both;margin-top:20px;'></div>";
        item += "<div class='col-md-6 col-xs-12'>";

        item += dropdown_dokumen();

        item += "</div>";
        item += "<div class='col-md-6 col-xs-12'><input accept='image/*,.pdf'' type='file' name='file_data[]' class='form-control inputControl uploadData' /></div>";
        item += "<div style='clear:both;margin-top:10px;'></div>";

        addmore.append(item);

        return false;
    })

    function dropdown_dokumen() {
        var data = [
            {name: '', value: '- Nama Dokumen -'},
            {name: 'foto', value: 'Foto'},
            {name: 'ktp', value: 'KTP'},
            {name: 'ijazah', value: 'Ijazah'},
            {name: 'skkd', value: 'Surat Keterangan Keaslian Dok.'},
            {name: 'cp', value: 'Contoh / Report Pekerjaan (CP)'},
            {name: 'surat_pelatihan', value: 'Sertifikat Pelatihan (SK)'},
            {name: 'surat_referensi', value: 'Surat Referensi dari Perusahaan'},
            {name: 'job_description', value: 'Job Description (JD)'},
            {name: 'demonstrasi_pekerjaan', value: 'Demonstrasi Pekerjaan (De)'},
            {name: 'ws', value: 'Wawancara dg. Supervisor, teman atau klien'},
            {name: 'pengalaman_industri', value: 'Pengalaman Industri (Pe)'},
            {name: 'bukti_relevan', value: 'Bukti-Bukti Lain yang Masih Relevan / CV'},
            {name: 'sertifikat_expired', value: 'Sertifikat Expired'}
        ];

        var dropdown = "<select name='nama_dokumen[]' class='form-control nmdokumen'>";
        $.each(data, function (key, hasil) {
            //console.log(hasil);
            dropdown += "<option value='" + hasil.name + "'>" + hasil.value + "</option>";
        });
        dropdown += "</select>";

        return dropdown;
    }



</script>