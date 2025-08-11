<form action="<?= base_url(); ?>aktif/insert_ahliwaris" method="post" enctype="multipart/form-data">
  <div class="container">
    <h2>Tambah Ahli Waris</h2>
    <div class="row mt-3">
      <div class="col-md-10">

        <div class="form-group">
          <label>NPK</label>
          <input type="text" class="form-control" id="noreg" name="noreg" value="<?= $alldata['npk']; ?>" readonly>
        </div>

        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="" required>
        </div>

        <div class="form-group">
          <label>Jenis Kelamin</label>
          <select id="jk_aw" name="jk_aw" class="form-control">
            <?php foreach ($jk as $j) : ?>
              <option value="<?= $j['id']; ?>">
                <?= $j['jk']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Status Keluarga</label>
          <select id="stts_kel" name="stts_kel" class="form-control">
            <?php foreach ($status_keluarga as $sk) : ?>
              <option value="<?= $sk['id']; ?>">
                <?= $sk['stts_kel']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Status Tanggungan</label>
          <select id="stts_tanggn" name="stts_tanggn" class="form-control">
            <?php foreach ($status_tanggungan as $st) : ?>
              <option value="<?= $st['id']; ?>">
                <?= $st['stts_tanggn']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Tanggal Lahir</label>
          <input type="date" id="tgl_lhr_aw" name="tgl_lhr_aw" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Keterangan</label>
          <input type="text" class="form-control" id="ket" name="ket" value="">
        </div>



        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image" name="image" required>
          <label class="custom-file-label" for="image">Choose file</label>

          <label for="exampleFormControlFile1">Masukan Dokumen pendukung (Akta Kelahiran/Buku Nikah) Maks. 2 Megabyte</label>
        </div>


        <br><br>
        <button type="submit" class="btn btn-success" onclick="konfirmasi()">Tambah</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href = 'javascript:window.history.go(-1);';">Kembali</button>


      </div>
    </div>
  </div>
</form>
</div>
<script type="text/javascript">
  function konfirmasi() {
    confirm('Anda Yakin?')
  }
</script>
