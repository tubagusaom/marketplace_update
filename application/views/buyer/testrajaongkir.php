<p>Lokasi Asal :</p>
<div class="form-group">
  <select class="form-control select2" id="sel1">
    <option value=""> Pilih Provinsi</option>

    <?php foreach ($provinsi_ro as $key => $value) { ?>

    <option value="<?=$value['province_id']?>"><?=$value['province']?></option>

    <?php } ?>

  </select>
</div>

<div class="form-group">
  <select class="form-control select2" id="sel2" disabled>
    <option value=""> Pilih Kota</option>
  </select>
</div>

<p>Lokasi Tujuan :</p>

<div class="form-group">
  <select class="form-control" id="sel11">
    <option value=""> Pilih Provinsi</option>

    <?php foreach ($provinsi_ro as $key => $value) { ?>

    <option value="<?=$value['province_id']?>"><?=$value['province']?></option>

    <?php } ?>
  </select>
</div>

<div class="form-group">
  <select class="form-control" id="sel22" disabled>
    <option value=""> Pilih Kota</option>
  </select>
</div>

<div class="form-group">
  <select class="form-control" id="kurir" disabled>
    <option value=""> Pilih Kurir</option>
    <option value="jne">JNE</option>
    <option value="tiki">TIKI</option>
    <option value="pos">POS Indonesia</option>
  </select>
</div>

<div id="hasil" class="datatable-responsive">
  <div class="card-header" id="hasil-pengecekan">
    Hasil Pengecekan
  </div>

  <div class="card-body">
    <table id="tabel-hasil-pengecekan" class="display">
      <thead>
        <tr>
          <th width="1%">No</th>
          <th>Kurir</th>
          <th>Jenis Layanan</th>
          <th>Tarif</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

</div>

<!-- <div class="col-md-12">
  <div class="card">
    <div class="card-header" id="hasil-pengecekan">
      Hasil Pengecekan
    </div>
    <div class="card-body">
      <table id="tabel-hasil-pengecekan" class="display">
        <thead>
          <tr>
            <th width="1%">No</th>
            <th>Kurir</th>
            <th>Jenis Layanan</th>
            <th>Tarif</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div> -->
