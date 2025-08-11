<form action="<?= base_url(); ?>aktif/update_ahliwaris" method="post" enctype="multipart/form-data">
  <div class="container">
    <div class="row mt-3">
      <div class="col-md-10">

        <div class="form-group">
          <input type="hidden" class="form-control" id="no_id" name="no_id" value="<?= $ahli_waris['no_id']; ?>">
        </div>


        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= $ahli_waris['nama_aw']; ?>" required>
        </div>

        <div class="form-group">
          <label>Jenis Kelamin</label>
          <!-- <input type="text" class="form-control" id="jk_aw" name="jk_aw" value="<?= $ahli_waris['jk_aw']; ?>"> -->

          <select id="jk_aw" name="jk_aw" class="form-control">
            <?php foreach ($jk as $j) : ?>
              <option value="<?= $j['id']; ?>" <?php if ($ahli_waris['jk_aw'] == $j['id']) {
                                                  echo "selected";
                                                } ?>>
                <?= $j['jk']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Status Keluarga</label>
          <select id="stts_kel" name="stts_kel" class="form-control">
            <?php foreach ($status_keluarga as $sk) : ?>
              <option value="<?= $sk['id']; ?>" <?php if ($ahli_waris['stts_kel'] == $sk['id']) {
                                                  echo "selected";
                                                } ?>>
                <?= $sk['stts_kel']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Tanggal Lahir</label>
          <input type="date" id="tgl_lhr_aw" name="tgl_lhr_aw" class="form-control" value="<?= $ahli_waris['tgl_lhr_aw']; ?>">
        </div>

        <div class="form-group">
          <label>Status Tanggungan</label>
          <select id="stts_tanggn" name="stts_tanggn" class="form-control">
            <?php foreach ($status_tanggungan as $st) : ?>
              <option value="<?= $st['id']; ?>" <?php if ($ahli_waris['stts_tanggn'] == $st['id']) {
                                                  echo "selected";
                                                } ?>>
                <?= $st['stts_tanggn']; ?>
              </option>
            <?php endforeach; ?>
          </select>

        </div>

        <div class="form-group">
          <label>Keterangan</label>
          <input type="text" class="form-control" id="ket" name="ket" value="<?= $ahli_waris['ket']; ?>">
        </div>
        <div class="form-group">
          <label>Dokumen Pendukung </label><br>
          <?php
          $dok = substr($ahli_waris['dok_pendukung'], -3);
          if ($dok == "pdf") :
          ?>
            <iframe src="<?= base_url('assets/img/dok_pendukung/') . $ahli_waris['dok_pendukung'];  ?>" width="100%" height="300px">
            </iframe>
          <?php else : ?>
            <img class="img-thumbnail" src="<?php if ($ahli_waris['dok_pendukung'] == '') {
                                              echo base_url('assets/img/dok_pendukung/default.jpg');
                                            } else {
                                              echo base_url('assets/img/dok_pendukung/') . $ahli_waris['dok_pendukung'];
                                            }
                                            ?>" width="200" height="100" data-toggle="modal" data-target="#fullimage1">
          <?php endif; ?>
          <div class="custom-file mt-2">
            <input type="file" class="custom-file-input" id="image" name="image" required>
            <label class="custom-file-label" for="image">Choose file</label>

            <label for="exampleFormControlFile1">Masukan Dokumen pendukung (Akta Kelahiran/Buku Nikah/Surat Cerai) Maks. 2 Megabyte</label>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="fullimage" style=" background-color: rgba(0,0,0,.0001) !important;">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style=" background-color: rgba(0,0,0,.0001) !important;">
              <!-- <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> -->

              <img class="img-thumbnail" src="<?= base_url('assets/img/kk/') . $alldata['scan_kk']; ?>" alt="Responsive image">

            </div>
          </div>
        </div>
        <!-- Akhir Modal -->
        <!-- Modal -->
        <div class="modal fade" id="fullimage1" style=" background-color: rgba(0,0,0,.0001) !important;">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style=" background-color: rgba(0,0,0,.0001) !important;">
              <!-- <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> -->

              <img class="img-thumbnail" src="<?php if ($ahli_waris['dok_pendukung'] == '') {
                                                echo base_url('assets/img/dok_pendukung/default.jpg');
                                              } else {
                                                echo base_url('assets/img/dok_pendukung/') . $ahli_waris['dok_pendukung'];
                                              }
                                              ?>" alt="Responsive image">

            </div>
          </div>
        </div>
        <!-- Akhir Modal -->


        <button type="submit" class="btn btn-danger" onclick="konfirmasi()">Update</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href = 'javascript:window.history.go(-1);';">Kembali</button>


      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  function konfirmasi() {
    confirm('Anda Yakin?')
  }
</script>