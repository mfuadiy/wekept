<form>
<div class="container">
    <div class="row mt-3">
      <div class="col-md-10">

  <div class="form-group">
    <label>Nama</label>
    <input type="text" class="form-control" id="nama" name="nama" value="<?= $peoples['nama_pes']; ?>">
  </div>

  <div class="form-group">
    <label>NPK</label>
    <input type="text" class="form-control" id="npk" name="npk" value="<?= $peoples['npk']; ?>">
  </div>

  <div class="form-group">
    <label>Nomor Pensiun</label>
    <input type="text" class="form-control" id="nopen" name="nopen" value="<?= $peoples['nopen']; ?>">
  </div>

  <div class="form-group">
    <label>Tempat Lahir</label>
    <input type="text" class="form-control" id="tp_lhr" name="tp_lhr" value="<?= $detail['tp_lhr']; ?>">
  </div>

  <div class="form-group">
    <label>Tanggal Lahir</label>
    <input type="text" class="form-control" id="tgl_lhr" name="tgl_lhr" value="<?= $peoples['tgl_lhr']; ?>">
    <small>Format = yyyy-mm-dd</small>
  </div>

  <div class="form-group">
    <label>Jenis Kelamin</label>
    <input type="text" class="form-control" id="jnkel" name="jnkel" value="<?= $peoples['jnkel']; ?>">
    <small>L = Laki-Laki | P = Perempuan</small>
  </div>
 
  <div class="form-group">
    <label>Alamat</label>
    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $detail['alamat']; ?>">
  </div>

  <div class="form-group">
    <label>RT/RW</label>
    <input type="text" class="form-control" id="rt_rw" name="rt_rw" value="<?= $detail['rt_rw']; ?>">
  </div>

  <div class="form-group">
    <label>Kelurahan</label>
    <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="<?= $detail['kelurahan']; ?>">
  </div>

  <div class="form-group">
    <label>Kecamatan</label>
    <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= $detail['kecamatan']; ?>">
  </div>

  <div class="form-group">
    <label>Kota</label>
    <input type="text" class="form-control" id="kota" name="kota" value="<?= $detail['kota']; ?>">
  </div>

  <div class="form-group">
    <label>Kode Pos</label>
    <input type="text" class="form-control" id="kodepos" name="kodepos" value="<?= $detail['kodepos']; ?>">
  </div>

  <div class="form-group">
    <label>Nomor Telepon</label>
    <input type="text" class="form-control" id="telp" name="telp" value="<?= $detail['telp']; ?>">
  </div>

  <div class="form-group">
    <label>Status Kawin</label>
    <input type="text" class="form-control" id="stts_kwn" name="stts_kwn" value="<?= $peoples['stts_kwn']; ?>">
    <small>Format = yyyy-mm-dd</small>
  </div>

  <div class="form-group">
    <label>Tanggal Mulai Kerja</label>
    <input type="text" class="form-control" id="tgl_mlai_krj" name="tgl_mlai_krj" value="<?= $peoples['tgl_mlai_krj']; ?>">
    <small>Format = yyyy-mm-dd</small>
  </div>

  <div class="form-group">
    <label>Golongan</label>
    <input type="text" class="form-control" id="gol" name="gol" value="<?= $detail['gol']; ?>">
  </div>

  <div class="form-group">
    <label>Jabatan</label>
    <input type="text" class="form-control" id="st_peg" name="st_peg" value="<?= $detail['st_peg']; ?>">
  </div>

  <div class="form-group">
    <label>Gaji Pokok</label>
    <input type="text" class="form-control" id="phdp" name="phdp" value="<?= $peoples['phdp']; ?>">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>


</div>
</div>
</div>
</form>