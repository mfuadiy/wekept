<div class="container">
    <div class="row mt-2">
        <div class="col-12">

            <div class="card ">
                <div class="card-header" style="text-align: center;">
                    Data Ulang Pensiunan
                </div>
                <div class="card-body">


                    <?= $this->session->flashdata('simadu'); ?>
                    <?= $this->session->flashdata('pesan'); ?>

                    <div class="table-responsive">
                        <table class="table">
                            <form action="<?= base_url('datul/update'); ?>" method="post" enctype="multipart/form-data">
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td><input class="form-control" type="text" name="nama" id="nama" value="<?php
                                                                                                                if ($jum > 0) {
                                                                                                                    echo ($datul['nama']);
                                                                                                                } else {
                                                                                                                    echo ($pensiun['nama']);
                                                                                                                } ?>" readonly></td>
                                </tr>

                                <tr>
                                    <th scope="row">Tanggal Lahir</th>
                                    <td><input class="form-control" type="text" name="tgl_lahir" id="tgl_lahir" value="<?php
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
                                    <th scope="row">NPWP</th>
                                    <td><input class="form-control" type="text" name="npwp" id="npwp" value="<?php if ($jum > 0) {
                                                                                                                    echo ($datul['kodepos']);
                                                                                                                } else {
                                                                                                                    echo ($pensiun['npwp']);
                                                                                                                } ?>" required></td>
                                </tr>

                        </table>
                    </div>

                </div>

                <!-- Data Ahli Waris -->
                <h4 class="mt-4" style="text-align: center;">Data Ahli Waris</h4><br>

                <div class="input-group control-group after-add-more">
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
                                        <td scope="col">


                                            <?= $aw['nama']; ?>


                                        </td>
                                        <td scope="col">
                                            <?= $aw['tgl_lhr_aw']; ?>

                                        </td>
                                        <td scope="col">

                                            <?php
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
                                            ?>

                                        </td>
                                        <td scope="col">
                                            <?= $aw['st_tangg']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Akhir AHli Waris -->

                <div class="card-body">
                    <h4 class="mt-4" style="text-align: center;">Dokumen Penunjang</h4><br>


                    <div class="alert alert-success mt-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_ktp" name="file_ktp" accept=".jpg,.png,.jpeg,.bmp, .pdf" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <label>Masukan Scan KTP </label>
                    </div>

                    <div class="alert alert-success mt-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_kk" name="file_kk" accept=".jpg,.png,.jpeg,.bmp, .pdf" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <label>Masukan Scan Kartu Keluarga Baru </label>
                    </div>

                    <div class="alert alert-success mt-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_npwp" name="file_npwp" accept=".jpg,.png,.jpeg,.bmp, .pdf" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <label>Masukan Scan NPWP </label>
                    </div>

                    <div class="alert alert-success mt-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_sk_kematian" name="file_sk_kematian" accept=".jpg,.png,.jpeg,.bmp, .pdf">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <label>Masukan Scan Surat Keterangan Meninggal jika Ahli Waris diatas telah meninggal dunia </label>
                    </div>

                    <div class="alert alert-success mt-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_akta_nikah" name="file_akta_nikah" accept=".jpg,.png,.jpeg,.bmp, .pdf">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <label>Masukan Scan Salinan Akta Nikah </label>
                    </div>
                    <label>*Maksimal 2 Megabites</label>
                </div>


                <!-- Form Input Dokumen -->
                <div class="col-2">
                    <button class="btn btn-danger add-more mt-2 mb-4" type="submit" <?= $ada; ?>>
                        <i class="glyphicon glyphicon-plus"></i> Simpan
                    </button>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>



<script>
    function goBack() {
        window.history.back();
    }
</script>