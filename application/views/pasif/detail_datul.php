<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Roboto', sans-serif;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background-color: #007bff;
        color: white;
        border-radius: 10px 10px 0 0;
        font-size: 1.25rem;
        font-weight: 500;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table th {
        font-weight: 500;
    }

    .form-control {
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .img-thumbnail {
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .modal-content {
        background-color: white;
    }

    .modal-body {
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .img-fluid {
        max-width: 100%;
        max-height: 80vh;
        /* Batasi tinggi gambar agar tidak melebihi layar */
        transition: transform 0.3s ease;
    }

    .rotate-90 {
        transform: rotate(90deg);
    }

    .rotate-180 {
        transform: rotate(180deg);
    }

    .rotate-270 {
        transform: rotate(270deg);
    }

    .zoom-in {
        transform: scale(1.5);
    }
</style>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="<?= base_url(); ?>pasif/datul" class="text-white"><i class="fas fa-arrow-circle-left"></i></a>
                    <span>Data Ulang Pensiunan</span>
                    <div></div> <!-- Placeholder untuk alignment -->
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('simadu'); ?>
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="table-responsive">
                        <table class="table">
                            <form action="<?= base_url('pasif/update'); ?>" method="post">
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td><input class="form-control" type="text" name="nama" id="nama" value="<?php if ($jum > 0) {
                                                                                                                    echo ($datul['nama']);
                                                                                                                } else {
                                                                                                                    echo ($pensiun['nama']);
                                                                                                                } ?>" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Lahir</th>
                                    <td><input class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" value="<?php
                                                                                                                        if ($jum > 0) {
                                                                                                                            echo ($datul['tgl_lahir']);
                                                                                                                        } else {
                                                                                                                            echo ($pensiun['tglhr']);
                                                                                                                        } ?>" readonly></td>
                                </tr>

                                <tr>
                                    <th scope="row">Nomor Pensiun</th>
                                    <td><input class="form-control" type="text" name="nopen" id="nopen" value="<?php if ($jum > 0) {
                                                                                                                    echo ($datul['nopen']);
                                                                                                                } else {
                                                                                                                    echo ($pensiun['nopen']);
                                                                                                                } ?>" readonly></td>
                                </tr>

                                <tr>
                                    <th scope="row">Nomor Pegawai</th>
                                    <td><input class="form-control" type="text" name="npk" id="npk" value="<?php if ($jum > 0) {
                                                                                                                echo ($datul['npk']);
                                                                                                            } else {
                                                                                                                echo ($pensiun['npk']);
                                                                                                            } ?>" readonly></td>
                                </tr>

                                <tr>
                                    <th scope="row">Status Pensiun</th>
                                    <td>
                                        <?php
                                        $ci = get_instance();
                                        $tjp = "";

                                        if ($jum > 1) {
                                            $tjp = $datul['stppp'];
                                        } else {
                                            $tjp = $pensiun['stppp'];
                                        }

                                        $hjp = $ci->db->get_where('jenis_pensiun', ['stppp' => $tjp])->row_array();
                                        ?>

                                        <input class="form-control" type="text" value="<?= $hjp['desk1'] . "-" . $hjp['desk2']; ?>" readonly>

                                        <select id="stppp" name="stppp" class="form-control" hidden>
                                            <?php foreach ($jenis_pensiun as $jp) : ?>
                                                <option value="<?= $jp['stppp']; ?>" <?php
                                                                                        if ($jum > 1) {
                                                                                            if ($datul['stppp'] == $jp['stppp']) {
                                                                                                echo "selected";
                                                                                            }
                                                                                        } else {
                                                                                            if ($pensiun['stppp'] == $jp['stppp']) {
                                                                                                echo "selected";
                                                                                            }
                                                                                        }

                                                                                        ?>>
                                                    <?php echo "" . $jp['stppp'] . "-" . $jp['desk1'] . "-" . $jp['desk2']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td><input class="form-control" type="text" name="alamat" id="alamat" value="<?php if ($jum > 0) {
                                                                                                                        echo ($datul['alamat']);
                                                                                                                    } else {
                                                                                                                        echo ($pensiun['alamat']);
                                                                                                                    } ?>" required></td>
                                </tr>

                                <tr>
                                    <th scope="row">RT/RW</th>
                                    <td><input class="form-control" type="text" name="rt_rw" id="rt_rw" value="<?php if ($jum > 0) {
                                                                                                                    echo ($datul['rt_rw']);
                                                                                                                } else {
                                                                                                                    echo ($pensiun['rt_rw']);
                                                                                                                } ?>" required></td>
                                </tr>

                                <tr>
                                    <th scope="row">Kelurahan</th>
                                    <td><input class="form-control" type="text" name="kelurahan" id="kelurahan" value="<?php if ($jum > 0) {
                                                                                                                            echo ($datul['kelurahan']);
                                                                                                                        } else {
                                                                                                                            echo ($pensiun['kelurahan']);
                                                                                                                        } ?>" required></td>
                                </tr>

                                <tr>
                                    <th scope="row">Kecamatan</th>
                                    <td><input class="form-control" type="text" name="kecamatan" id="kecamatan" value="<?php if ($jum > 0) {
                                                                                                                            echo ($datul['kecamatan']);
                                                                                                                        } else {
                                                                                                                            echo ($pensiun['kecamatan']);
                                                                                                                        } ?>" required></td>
                                </tr>

                                <tr>
                                    <th scope="row">Kota</th>
                                    <td><input class="form-control" type="text" name="kota" id="kota" value="<?php if ($jum > 0) {
                                                                                                                    echo ($datul['kota']);
                                                                                                                } else {
                                                                                                                    echo ($pensiun['kota']);
                                                                                                                } ?>" required></td>
                                </tr>

                                <tr>
                                    <th scope="row">Provinsi</th>
                                    <td>
                                        <select id="provinsi" name="provinsi" class="form-control" required>
                                            <?php foreach ($prov as $p) : ?>
                                                <option <?php if ($jum > 0) {
                                                            if ($datul['provinsi'] == $p['prov']) {
                                                                echo "selected";
                                                            }
                                                        } ?>>
                                                    <?php echo $p['prov']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Kode Pos</th>
                                    <td><input class="form-control" type="text" name="kodepos" id="kodepos" value="<?php if ($jum > 0) {
                                                                                                                        echo ($datul['kodepos']);
                                                                                                                    } else {
                                                                                                                        echo ($pensiun['kodepos']);
                                                                                                                    } ?>" required></td>
                                </tr>

                                <tr>
                                    <th scope="row">Nomor Telepon/HP</th>
                                    <td><input class="form-control" type="text" name="no_hp" id="no_hp" value="<?php if ($jum > 0) {
                                                                                                                    echo ($datul['no_hp']);
                                                                                                                } else {
                                                                                                                    echo ($pensiun['hp']);
                                                                                                                } ?>" required></td>
                                </tr>

                                <tr>
                                    <th scope="row">Nomor Emergency</th>
                                    <td><input class="form-control" type="text" name="no_hplain" id="no_hplain" value="<?php if ($jum > 0) {
                                                                                                                            echo ($datul['no_hplain']);
                                                                                                                        } ?>" required></td>
                                </tr>

                                <tr>
                                    <th scope="row">Email</th>
                                    <td><input class="form-control" type="text" name="email" id="email" value="<?php if ($jum > 0) {
                                                                                                                    echo ($datul['email']);
                                                                                                                } ?>"></td>
                                </tr>

                                <tr>
                                    <th scope="row">NIK</th>
                                    <td><input class="form-control" type="text" name="nik" id="nik" value="<?php if ($jum > 0) {
                                                                                                                echo ($datul['nik']);
                                                                                                            } else {
                                                                                                                echo ($pensiun['nik']);
                                                                                                            } ?>" required></td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Data Ahli Waris</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableDatulAWPens" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status Keluarga</th>
                                    <th>Status Tanggungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ahli_waris as $aw) : ?>
                                    <tr>
                                        <td><?= $aw['nama']; ?></td>
                                        <td><?= $aw['tgl_lhr_aw']; ?></td>
                                        <td><?php
                                            if ($aw['st_kel'] == "1") {
                                                echo "Suami/Istri";
                                            } elseif ($aw['st_kel'] == "2") {
                                                echo "Anak";
                                            } elseif ($aw['st_kel'] == "3") {
                                                echo "Orang Tua";
                                            } elseif ($aw['st_kel'] == "4") {
                                                echo "Pihak Ditunjuk";
                                            } else {
                                                echo "Peserta";
                                            }
                                            ?></td>
                                        <td><?= $aw['st_tangg']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dokumen Penunjang -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Dokumen Penunjang</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <div style="text-align: center;">
                                    <label>KTP</label>
                                    <div class="input-group">
                                        <?php
                                        $ktp = isset($datul['file_ktp']) ? substr($datul['file_ktp'], -3) : null;
                                        if ($ktp == "pdf") :
                                        ?>
                                            <br><br><br>
                                            <p><iframe src="<?= 'http://dpkbpjamsostek.test/assets/img/datul/ktp/' . $datul['file_ktp'];  ?>" width="100%" height="300px">
                                                </iframe></p>
                                        <?php else : ?>
                                            <img class="img-thumbnail" style="margin-left: auto; margin-right: auto;" src="<?php if (empty($datul['file_ktp'])) {
                                                                                                                                echo base_url('assets/img/kk/default.jpg');
                                                                                                                            } else {
                                                                                                                                echo ('http://dpkbpjamsostek.test/assets/img/datul/ktp/' . $datul['file_ktp']);
                                                                                                                            } ?>" width="200" height="100" data-toggle="modal" data-target="#file_ktp">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <div style="text-align: center;">
                                    <label>Kartu Keluarga</label>
                                    <div class="input-group">
                                        <?php
                                        $kk = isset($datul['file_kk']) ? substr($datul['file_kk'], -3) : null;
                                        if ($kk == "pdf") :
                                        ?>
                                            <br><br><br>
                                            <p><iframe src="<?= 'http://dpkbpjamsostek.test/assets/img/datul/kk/' . $datul['file_kk'];  ?>" width="200%" height="300px">
                                                </iframe></p>
                                        <?php else : ?>
                                            <img class="img-thumbnail" style="margin-left: auto; margin-right: auto;" src="<?php if (empty($datul['file_kk'])) {
                                                                                                                                echo base_url('assets/img/kk/default.jpg');
                                                                                                                            } else {
                                                                                                                                echo ('http://dpkbpjamsostek.test/assets/img/datul/kk/' . $datul['file_kk']);
                                                                                                                            } ?>" width="200" height="100" data-toggle="modal" data-target="#file_kk">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <div style="text-align: center;">
                                    <label>Surat Keterangan Belum Menikah</label>
                                    <div class="input-group">
                                        <?php
                                        $skbm = isset($datul['file_skbm']) ? substr($datul['file_skbm'], -3) : null;
                                        if ($skbm == "pdf") :
                                        ?>
                                            <br><br><br>
                                            <p><iframe src="<?= base_url('assets/img/datul/skbm/') . $datul['file_skbm'];  ?>" width="200%" height="300px">
                                                </iframe></p>
                                        <?php else : ?>
                                            <img class="img-thumbnail" style="margin-left: auto; margin-right: auto;" src="<?php if (empty($datul['file_skbm'])) {
                                                                                                                                echo base_url('assets/img/kk/default.jpg');
                                                                                                                            } else {
                                                                                                                                echo ('http://dpkbpjamsostek.test/assets/img/datul/skbm/' . $datul['file_skbm']);
                                                                                                                            } ?>" width="200" height="100" data-toggle="modal" data-target="#file_skbm">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <div style="text-align: center;">
                                    <label>NPWP</label>
                                    <div class="input-group">
                                        <?php
                                        $npwp = isset($datul['file_npwp']) ? substr($datul['file_npwp'], -3) : null;
                                        if ($npwp == "pdf") :
                                        ?>
                                            <br><br><br>
                                            <p><iframe src="<?= base_url('assets/img/datul/npwp/') . $datul['file_npwp'];  ?>" width="200%" height="300px">
                                                </iframe></p>
                                        <?php else : ?>
                                            <img class="img-thumbnail" style="margin-left: auto; margin-right: auto;" src="<?php if (empty($datul['file_npwp'])) {
                                                                                                                                echo base_url('assets/img/kk/default.jpg');
                                                                                                                            } else {
                                                                                                                                echo base_url('assets/img/datul/npwp/' . $datul['file_npwp']);
                                                                                                                            } ?>" width="200" height="100" data-toggle="modal" data-target="#file_npwp">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <div style="text-align: center;">
                                    <label>Surat Keterangan Meningal</label>
                                    <div class="input-group">
                                        <?php
                                        $skkematian = isset($datul['file_kematian']) ? substr($datul['file_skkematian'], -3) : null;
                                        if ($skkematian == "pdf") :
                                        ?>
                                            <br><br><br>
                                            <p><iframe src="<?= base_url('assets/img/datul/sk_kematian/') . $datul['file_skkematian'];  ?>" width="200%" height="300px">
                                                </iframe></p>
                                        <?php else : ?>
                                            <img class="img-thumbnail" style="margin-left: auto; margin-right: auto;" src="<?php if (empty($datul['file_skkematian'])) {
                                                                                                                                echo base_url('assets/img/kk/default.jpg');
                                                                                                                            } else {
                                                                                                                                echo base_url('assets/img/datul/sk_kematian/' . $datul['file_skkematian']);
                                                                                                                            } ?>" width="200" height="100" data-toggle="modal" data-target="#file_skkematian">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <div style="text-align: center;">
                                    <label>Akta Menikah</label>
                                    <div class="input-group">
                                        <?php
                                        $aktanikah = isset($datul['file_aktanikah']) ? substr($datul['file_aktanikah'], -3) : null;
                                        if ($aktanikah == "pdf") :
                                        ?>
                                            <br><br><br>
                                            <p><iframe src="<?= base_url('assets/img/datul/akta_nikah/') . $datul['file_aktanikah'];  ?>" width="200%" height="300px">
                                                </iframe></p>
                                        <?php else : ?>
                                            <img class="img-thumbnail" style="margin-left: auto; margin-right: auto;" src="<?php if (empty($datul['file_aktanikah'])) {
                                                                                                                                echo base_url('assets/img/kk/default.jpg');
                                                                                                                            } else {
                                                                                                                                echo base_url('assets/img/datul/akta_nikah/' . $datul['file_aktanikah']);
                                                                                                                            } ?>" width="200" height="100" data-toggle="modal" data-target="#file_aktanikah">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal KTP -->
<div class="modal fade" id="file_ktp" tabindex="-1" role="dialog" aria-labelledby="file_ktp_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file_ktp_label">KTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center bg-white">
                <img id="img_ktp" class="img-fluid" src="<?php if (empty($datul['file_ktp'])) {
                                                                echo base_url('assets/img/kk/default.jpg');
                                                            } else {
                                                                echo ('http://dpkbpjamsostek.test/assets/img/datul/ktp/' . $datul['file_ktp']);
                                                            } ?>" alt="KTP">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="rotateImage('img_ktp')">Rotasi Gambar</button>
                <button type="button" class="btn btn-secondary" onclick="zoomImage('img_ktp')">Perbesar Gambar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal KK -->
<div class="modal fade" id="file_kk" tabindex="-1" role="dialog" aria-labelledby="file_kk_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file_kk_label">Kartu Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center bg-white">
                <img id="img_kk" class="img-fluid" src="<?php if (empty($datul['file_kk'])) {
                                                            echo base_url('assets/img/kk/default.jpg');
                                                        } else {
                                                            echo ('http://dpkbpjamsostek.test/assets/img/datul/kk/' . $datul['file_kk']);
                                                        } ?>" alt="Kartu Keluarga">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="rotateImage('img_kk')">Rotasi Gambar</button>
                <button type="button" class="btn btn-secondary" onclick="zoomImage('img_kk')">Perbesar Gambar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal SKBM -->
<div class="modal fade" id="file_skbm" tabindex="-1" role="dialog" aria-labelledby="file_skbm_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file_skbm_label">Surat Keterangan Belum Menikah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center bg-white">
                <img id="img_skbm" class="img-fluid" src="<?php if (empty($datul['file_skbm'])) {
                                                                echo base_url('assets/img/kk/default.jpg');
                                                            } else {
                                                                echo ('http://dpkbpjamsostek.test/assets/img/datul/skbm/' . $datul['file_skbm']);
                                                            } ?>" alt="Kartu Keluarga">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="rotateImage('img_skbm')">Rotasi Gambar</button>
                <button type="button" class="btn btn-secondary" onclick="zoomImage('img_skbm')">Perbesar Gambar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal NPWP -->
<div class="modal fade" id="file_npwp" tabindex="-1" role="dialog" aria-labelledby="file_npwp_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file_npwp_label">NPWP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center bg-white">
                <img id="img_npwp" class="img-fluid" src="<?php if (empty($datul['file_npwp'])) {
                                                                echo base_url('assets/img/kk/default.jpg');
                                                            } else {
                                                                echo base_url('assets/img/datul/npwp/' . $datul['file_npwp']);
                                                            } ?>" alt="NPWP">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="rotateImage('img_npwp')">Rotasi Gambar</button>
                <button type="button" class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="rotateImage('img_npwp')">Rotasi Gambar</button>
                    <button type="button" class="btn btn-secondary" onclick="zoomImage('img_npwp')">Perbesar Gambar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal SK Kematian -->
<div class="modal fade" id="file_skkematian" tabindex="-1" role="dialog" aria-labelledby="file_skkematian_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file_skkematian_label">Surat Keterangan Kematian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center bg-white">
                <img id="img_skkematian" class="img-fluid" src="<?php if (empty($datul['file_skkematian'])) {
                                                                    echo base_url('assets/img/kk/default.jpg');
                                                                } else {
                                                                    echo base_url('assets/img/datul/sk_kematian/' . $datul['file_skkematian']);
                                                                } ?>" alt="Surat Keterangan Kematian">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="rotateImage('img_skkematian')">Rotasi Gambar</button>
                <button type="button" class="btn btn-secondary" onclick="zoomImage('img_skkematian')">Perbesar Gambar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Akta Nikah -->
<div class="modal fade" id="file_aktanikah" tabindex="-1" role="dialog" aria-labelledby="file_aktanikah_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file_aktanikah_label">Akta Nikah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center bg-white">
                <img id="img_aktanikah" class="img-fluid" src="<?php if (empty($datul['file_aktanikah'])) {
                                                                    echo base_url('assets/img/kk/default.jpg');
                                                                } else {
                                                                    echo base_url('assets/img/datul/akta_nikah/' . $datul['file_aktanikah']);
                                                                } ?>" alt="Akta Nikah">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="rotateImage('img_aktanikah')">Rotasi Gambar</button>
                <button type="button" class="btn btn-secondary" onclick="zoomImage('img_aktanikah')">Perbesar Gambar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<script>
    // Fungsi untuk merotasi gambar
    function rotateImage(imgId) {
        const img = document.getElementById(imgId);
        if (img.classList.contains('rotate-90')) {
            img.classList.remove('rotate-90');
            img.classList.add('rotate-180');
        } else if (img.classList.contains('rotate-180')) {
            img.classList.remove('rotate-180');
            img.classList.add('rotate-270');
        } else if (img.classList.contains('rotate-270')) {
            img.classList.remove('rotate-270');
        } else {
            img.classList.add('rotate-90');
        }
    }

    // Fungsi untuk memperbesar gambar
    function zoomImage(imgId) {
        const img = document.getElementById(imgId);
        if (img.classList.contains('zoom-in')) {
            img.classList.remove('zoom-in');
        } else {
            img.classList.add('zoom-in');
        }
    }
</script>