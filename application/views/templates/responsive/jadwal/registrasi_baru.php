<style>
    .asterisk{
        font-weight: bold;
        color: red;
    }
    .red {background: red}
</style>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->

        <!-- END THEME PANEL -->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?= base_url() ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Jadwal</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Pendaftaran</span>
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
            <?php
            if ($this->session->flashdata('result') != '') {
                ?>
                <div class="alert alert-<?= $this->session->flashdata('mode_alert') ?>" role="alert"><?php echo $this->session->flashdata('result'); ?></div>
                <?php
            }
            ?>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="myForm2" action="<?= base_url() . 'jadwal/add' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped" >
                    <div class="form-body">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Jadwal & Pembayaran</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Biodata Peserta Uji</a></li>
                            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Dokumen Bukti Pendukung</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Tabs Pertama //-->
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Pilih Jadwal Uji Kompetensi</label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="id_jadwal" value="<?= $id ?>">
                                        <b><?= $row_jadwal->jadual ?></b>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Metode Pembayaran</label>
                                    <div class="col-md-9">
                                    <?php $pesan="'Mohon pilih salah satu'" ;
                                        $pesan_kosong ="''";
                                     ?>
                                        <?php echo form_dropdown('metode_bayar', array(""=>"-Pilih-","0"=>"Perseorangan", "1"=>"Kolektif"), '', 'class="form-control" id="metode_bayar" onchange="kolektif()" required  oninvalid="this.setCustomValidity('.$pesan.')"  oninput="setCustomValidity('.$pesan_kosong.')" '); ?>
                                        <span class="help-block"> Kolektif / Administrasi pembayaran di kelola oleh perusahaan atau Lembaga pengusul. Pribadi / Administrasi pembayaran di bayar secara personal </span>
                                    </div>
                                </div>
                                <div class="form-group div_kolektif" style="display: none;">
                                    <label class="control-labelx col-md-3">Nama Lembaga </label>
                                    <div class="col-md-9">
                                        <input type="text" name="organisasi" class="form-control organisasi" >

                                        <span class="help-block"> Perusahaan/Lembaga tempat bekerja </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Tujuan Asesmen</label>
                                    <div class="col-md-9">
                                        <?php echo form_dropdown('tujuan_asesmen', array(""=>"-Pilih-","Sertfikasi"=>"Sertfikasi", "RCC"=>"RCC", "RPL"=>"RPL", "Pencapaian Proses Pembelajaran"=>"Pencapaian Proses Pembelajaran"), '', 'class="form-control" required oninvalid="this.setCustomValidity('.$pesan.')" oninput="setCustomValidity('.$pesan_kosong.')" '); ?>
                                        <span class="help-block"> </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabs Kedua //-->
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <div class="form-group">
                                    <label class="col-md-12">Biodata Peserta Uji. <a href="<?= base_url() . 'profil/index' ?>">Update</a></label>
                                </div>

                                <div class="form-group">
                                    <label class="control-labelx col-md-3">No Identitas</label>
                                    <div class="col-md-9">
                                        <?= $biodata->no_identitas ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Nama Lengkap</label>
                                    <div class="col-md-9">
                                        <?= $biodata->nama_user ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Tempat Lahir</label>
                                    <div class="col-md-9">
                                        <?= $biodata->tempat_lahir ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Tanggal Lahir</label>
                                    <div class="col-md-9">
                                        <?= tgl_indo($biodata->tgl_lahir) ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Jenis Kelamin</label>
                                    <div class="col-md-9">
                                        <?php
                                        $jenis_kelamin = array('1' => 'Laki-laki', '2' => 'Perempuan');
                                        $kewarganegaraan = array('1' => 'WNI', '2' => 'WNA');
                                        echo $jenis_kelamin[$biodata->jenis_kelamin]
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Kewarganegaraan</label>
                                    <div class="col-md-9">
                                        <?= $kewarganegaraan[$biodata->kewarganegaraan] ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Email</label>
                                    <div class="input-group">

                                        <?= $biodata->email ?> </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">No HP</label>
                                    <div class="input-group">

                                        <?= $biodata->hp ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Alamat</label>
                                    <div class="col-md-9">
                                        <?= $biodata->alamat ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-labelx col-md-3">Data Pekerjaan</label>
                                    <div class="col-md-9">
                                        <?php
                                        $dpekerjaan = array();
                                        foreach ($data_pekerjaan as $pekerjaan) {
                                            $dpekerjaan[] = $pekerjaan->nama_pekerjaan;
                                        }

                                        echo implode(", ", $dpekerjaan);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabs Ketiga //-->
                            <div role="tabpanel" class="tab-pane" id="messages">
                                <?php foreach ($syarat_skema as $key => $value) {
                                    ?>
                                    <div class="form-group">
                                        <label class="control-labelx col-md-3"><?= $jenis_bukti[$value->jenis_bukti]; ?> <span class="asterisk">*</span></label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="nama_dokumen[]" value="<?= $value->jenis_bukti ?>"/>

                    <!-- <input type="file" name="file_data[]" class="form-control" required />-->
                                            <select id="mySelect<?=$key?>"  name="file_data[]" kelas="jenis<?= $value->jenis_bukti ?>" class="form-control databukti" required oninvalid="this.setCustomValidity('Mohon pilih salah satu')" oninput="setCustomValidity('')" >
                                                <option value="" selected disabled hidden>-Pilih <?= $value->nama_persyaratan?>-</option>
                                                <?php
                                                foreach ($trepositori as $repo) {
                                                    if($repo->jenis_portofolio == $value->jenis_bukti){
                                                    echo "<option value='$repo->id'>$repo->nama_dokumen</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>


                                <div style="clear:both;margin-bottom: 20px;"></div>

                                <div class="form-group">
                                    <fieldset class="col-md-12">
                                        <legend>Bukti Pendukung Tambahan</legend>
                                    </fieldset>

                                    <div class="col-md-3 col-xs-12 pull-left" id="addmore">
                                        <button type="button" name="btn_addmore" id="btn_addmore" class="btn btn-info pull-right">Tambah Dokumen</button>
                                    </div>

                                    <div class="dokumen_tambah col-md-9 col-xs-12 pull-right"></div>

                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green" id="contact_submit">
                                        <i class="fa fa-save"></i> Submit APL 01</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function kolektif() {
        //console.log($(this));
        var ok = $('#metode_bayar').val();
        if (ok == '1') {
            $('.div_kolektif').show();
            $('.organisasi').attr('required','true');

        } else {
            $('.div_kolektif').hide();
            $('.organisasi').removeAttr('required');

        }

    }
</script>

<script type="text/javascript">
    $(document).ready(function() { 
    // bind form using ajaxForm 
    $('form').submit(function() {
        alert('ok');
    })
});
    $("#contact_submit").click(function(event){
            alert('ok');
        }
    var dataFile = "";
    var dropdown = "";
    var base_url = "<?= base_url(); ?>";

    $("#btn_addmore").click(function () {

        var addmore = $(".dokumen_tambah");
        var item = "";
        item += "<div class='col-md-6 col-xs-12'>";

        item += dropdown_dokumen();

        item += "</div>";
        //item += "<div class='col-md-6 col-xs-12'><input type='file' name='file_data[]' class='form-control inputControl uploadData' /></div>";
        item += "<div class='col-md-6 col-xs-12'>";
        item += dropdown_dokumenfile();
        item += "</div>";
        item += "<div style='clear:both;margin-bottom:10px;'></div>";

        addmore.append(item);

        return false;
    });

    function dropdown_dokumen() {
//        var data = [
//            {name: '', value: '- Nama Dokumen -'},
//            {name: 'pendidikan_formal', value: 'Pendidikan Formal'},
//            {name: 'sertifikasi', value: 'Sertifikasi'},
//            {name: 'pelatihan', value: 'Pelatihan'},
//            {name: 'penghargaan', value: 'Penghargaan'},
//            {name: 'portofolio', value: 'Hasil Kerja / Portofolio'},
//            {name: 'lain_lain', value: 'Lain-Lain'}
//        ];
//
//        var dropdown = "<select name='nama_dokumen[]' class='form-control nmdokumen'>";
//        $.each(data, function (key, hasil) {
//            dropdown += "<option value='" + hasil.name + "'>" + hasil.value + "</option>";
//        });
//        dropdown += "</select>";

        var id_skema = "<?= $id_skema; ?>";
        if (dropdown == "") {
            dropdown = $.ajax({type: "GET", url: base_url + "jadwal/jenis_syarat/" + id_skema, async: false}).responseText;
        }

        return dropdown;
    }

    function dropdown_dokumenfile() {
        if (dataFile == "") {
            dataFile = $.ajax({type: "GET", url: base_url + "jadwal/bukti_pendukung", async: false}).responseText;
        }
        return dataFile;
    }
    function validasi_opsi(sel){
       var idOk = sel.id;
       var idValueOk = sel.value;
       //alert(idOk);
       var idObj = $("#"+idOk).attr('kelas');
       //alert(idObj);
       //$('select[kelas="'+idObj+'"]').hide();
       //var x = $('select[kelas="'+idObj+'"]').not('#' + idOk);
       //console.log(x);
        //x.('option[value="'+idValueOk+'"]').remove();
       //$('.'+idObj).hide();
    }
</script>
