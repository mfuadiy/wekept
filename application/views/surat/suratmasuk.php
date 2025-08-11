<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container-fluid">
    <div class="card shadow" style="height: 720px; overflow-y: scroll;">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Surat Masuk</h4>
        </div>
        <div class="card-body">


            <div class="card-body">
                <?php if (isset($_POST['tsm'])) : ?>
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?= $this->session->flashdata('message'); ?>
                <div class="row mt-2">
                    <div class="col-md-5">
                        <form action="<?= base_url('surat/suratmasuk'); ?>" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari Surat" id="keyword" name="keyword" autocomplete="off" autofocus value="<?= set_value('keyword'); ?>">
                                <div class="input-group-append">
                                    <input class="btn btn-primary" type="submit" name="submit" style="font-family: 'FontAwesome';" value="&#xf002;">
                                </div>
                            </div>
                        </form>
                        <p class="mb-2" style="text-align: left;">Hasil pencarian: <?= $total_rows; ?></p>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#myModal">Tambah Surat Masuk</button>
                        <a href="<?= base_url('surat/excel5'); ?>" class="btn btn-danger mb-2">Export Excel</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-top-align" style="vertical-align: top; text-align: center;">
                            <tr>
                                <th scope="col">#</th>
                                <!-- <th scope="col">Pengirim</th> -->
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Nomor Agenda</th>
                                <th scope="col">Tanggal Agenda</th>
                                <th scope="col">Perihal</th>
                                <!-- <th scope="col">Tujuan</th> -->
                                <!-- <th scope="col">Isi Disposisi</th> -->
                                <th scope="col">Di Salurkan</th>
                                <th scope="col">Berkas</th>
                                <!-- <th scope="col">Lama Surat</th> -->
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($allSurat as $as) : ?>
                                <tr>
                                    <th scope="row"><?= ++$start; ?></th>
                                    <td style="word-wrap: break-word; max-width:200px;"><?= $as['no_surat']; ?></td>
                                    <td style="word-wrap: break-word; max-width:200px;"><?= $as['tgl_surat']; ?></td>
                                    <td style="word-wrap: break-word; max-width:200px;"><?= $as['no_agenda']; ?></td>
                                    <td style="word-wrap: break-word; max-width:200px;"><?= $as['tgl_agenda']; ?></td>
                                    <td style="word-wrap: break-word; max-width:350px;"><?= $as['perihal']; ?></td>
                                    <!-- <td style="word-wrap: break-word"><?= $as['tujuan']; ?></td> -->
                                    <!-- <td style="word-wrap: break-word"><?= $as['disposisi']; ?></td> -->
                                    <td style="word-wrap: break-word"><?= $as['salur']; ?></td>
                                    <td style="word-wrap: break-word; max-width:150px; overflow: hidden; text-overflow:ellipsis; white-space: nowrap;">
                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal<?= $i ?>">
                                            <?= $as['berkas']; ?>
                                        </button>
                                    </td>
                                    <!-- <td>
                                        <?php
                                        $now = new DateTime();
                                        $msk = new DateTime($as['tgl_agenda']);
                                        $int = date_diff($msk, $now)->days;
                                        echo $int . " hari";
                                        ?>
                                    </td> -->
                                    <td style="text-align: center;">
                                        <input class="surat" id="surat" type="checkbox" <?= surat($as['id'], $as['status']); ?> data-id="<?= $as['id']; ?>" data-status="<?= $as['status']; ?>">
                                    </td>
                                    <td style="word-wrap: break-word">
                                        <!-- <a href="<?= base_url(); ?>surat/editsurat/<?= $as['id']; ?>" class="badge badge-primary">Lihat</a> -->

                                        <a href="" id="editSuratModal" data-toggle="modal" data-target="#suratModal" class="badge badge-warning btn-edit-surat" data-id="<?= $as['id']; ?>">Edit</a>

                                        <a href="<?= base_url(); ?>surat/delete_surat_masuk/<?= $as['id']; ?>"
                                            class="badge badge-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModal<?= $i ?>">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?= $as['berkas']; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php $a11 = $as['berkas']; ?>
                                                <iframe src="<?php echo base_url('assets/mail/inbox/') . $a11; ?>" frameborder="0" width="100%" height="700px"></iframe>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                // $i++; 
                                ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Surat Modal -->
<div class="modal fade" id="suratModal" tabindex="-1" role="dialog" aria-labelledby="suratModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="suratModalLabel">Edit Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="<?= base_url('surat/updatesurat'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" class="form-control" id="id" name="id" required hidden>
                    <!-- Nomor Surat -->
                    <div class="form-group row">
                        <label for="no_surat" class="col-md-4 col-form-label">Nomor Surat</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                        </div>
                    </div>

                    <!-- Tanggal Surat -->
                    <div class="form-group row">
                        <label for="tgl_surat" class="col-md-4 col-form-label">Tanggal Surat</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="tgl_surat" name="tgl_surat" required>
                        </div>
                    </div>

                    <!-- Nomor Agenda -->
                    <div class="form-group row">
                        <label for="no_agenda" class="col-md-4 col-form-label">Nomor Agenda</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="no_agenda" name="no_agenda" required>
                        </div>
                    </div>

                    <!-- Tanggal Agenda -->
                    <div class="form-group row">
                        <label for="tgl_agenda" class="col-md-4 col-form-label">Tanggal Agenda</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="tgl_agenda" name="tgl_agenda" required>
                        </div>
                    </div>

                    <!-- Perihal -->
                    <div class="form-group row">
                        <label for="perihal" class="col-md-4 col-form-label">Perihal</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="perihal" name="perihal" required>
                        </div>
                    </div>

                    <!-- Pengirim -->
                    <div class="form-group row">
                        <label for="pengirim" class="col-md-4 col-form-label">Pengirim</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                        </div>
                    </div>

                    <!-- Tujuan -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"><strong>Tujuan</strong></label>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="dirut" value="Direktur Utama" id="dirut">
                                <label class="form-check-label" for="dirut">1. Direktur Utama</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="direktur" value="Direktur" id="direktur">
                                <label class="form-check-label" for="direktur">2. Direktur</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="menku" value="Manager Keuangan" id="menku">
                                <label class="form-check-label" for="menku">3. Manager Keuangan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="menkep" value="Manager Kepesertaan" id="menkep">
                                <label class="form-check-label" for="menkep">4. Manager Kepesertaan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="menum" value="Manager SDM Umum & TI" id="menum">
                                <label class="form-check-label" for="menum">5. Manager SDM Umum & TI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="audit" value="Audit" id="audit">
                                <label class="form-check-label" for="audit">6. Audit</label>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label">Status</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                    </div>

                    <!-- Salur -->
                    <div class="form-group row">
                        <label for="salur" class="col-md-4 col-form-label">Salur</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="salur" name="salur" required>
                        </div>
                    </div>

                    <!-- Berkas -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"><strong>Berkas Sebelumnya</strong></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="berkasLama" name="berkasLama" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berkas" class="col-md-4 col-form-label"><strong>Berkas Baru</strong></label>
                        <div class="col-md-8">
                            <input type="file" class="form-control-file" id="berkas" name="berkas">
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Surat -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Surat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <form action="<?= base_url('surat/suratmasuk'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="no_surat" class="col-form-label">Nomor Surat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="no_surat" name="no_surat">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="tgl_surat" class="col-form-label">Tanggal Surat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="tgl_surat" name="tgl_surat">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="no_agenda" class="col-form-label">Nomor Agenda</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="no_agenda" name="no_agenda">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="tgl_agenda" class="col-form-label">Tanggal Agenda</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="tgl_agenda" name="tgl_agenda">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="perihal" class="col-form-label">Perihal</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="perihal" name="perihal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="pengirim" class="col-form-label">Pengirim</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="pengirim" name="pengirim">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <b><label for="tujuan">Tujuan</label></b>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="" type="checkbox" name="dirut" value="Direktur Utama," id="dirut">
                                <label class="form-check-label" for="dirut">1. Direktur Utama</label>
                            </div>
                            <div class="form-check">
                                <input class="" type="checkbox" name="direktur" value="Direktur," id="direktur">
                                <label class="form-check-label" for="direktur">2. Direktur</label>
                            </div>
                            <div class="form-check">
                                <input class="" type="checkbox" name="menku" value="Manager Keuangan," id="menku">
                                <label class="form-check-label" for="menku">3. Manager Keuangan</label>
                            </div>
                            <div class="form-check">
                                <input class="" type="checkbox" name="menkep" value="Manager Kepesertaan," id="menkep">
                                <label class="form-check-label" for="menkep">4. Manager Kepesertaan</label>
                            </div>
                            <div class="form-check">
                                <input class="" type="checkbox" name="menum" value="Manager SDM Umum & TI" id="menum">
                                <label class="form-check-label" for="menum">5. Manager SDM Umum & TI</label>
                            </div>
                            <div class="form-check">
                                <input class="" type="checkbox" name="audit" value="Audit" id="audit">
                                <label class="form-check-label" for="audit">6. Audit</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="status" class="col-form-label">Status</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="status" name="status">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="salur" class="col-form-label">Salur</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="salur" name="salur">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="berkas" class="col-form-label">Berkas</label>
                        </div>
                        <div class="col-md-8">
                            <input type="file" class="form-control" id="berkas" name="berkas">
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary" id="tsm" name="tsm">Tambah Surat Masuk</button>

            </form>
        </div>
    </div>
</div>

</div>
</div>

<script>
    document.querySelectorAll('.btn-edit-surat').forEach(function(button) {
        // Ketika tombol edit diklik
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var suratId = $(this).data('id'); // Ambil ID dari tombol
            var url = '<?= base_url('surat/getSuratById/'); ?>' + suratId; // Buat URL
            // Cetak URL ke console
            console.log('Fetching data from URL:', url);

            // Kirim AJAX request ke server
            $.ajax({
                url: '<?= base_url('surat/getSuratById/'); ?>' + suratId, // Ganti dengan URL yang benar di server Anda
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Jika berhasil, masukkan data ke dalam form di modal
                    $('#no_surat').val(data.no_surat);
                    $('#tgl_surat').val(data.tgl_surat);
                    $('#perihal').val(data.perihal);
                    $('#pengirim').val(data.pengirim);
                    $('#no_agenda').val(data.no_agenda);
                    $('#tgl_agenda').val(data.tgl_agenda);
                    $('#status').val(data.status);
                    $('#salur').val(data.salur);
                    $('#berkasLama').val(data.berkas);
                    // Masukkan ID surat ke dalam hidden field
                    $('#id').val(data.id);

                    // Proses tujuan checkbox, misalnya tujuan dipisah dengan koma
                    var tujuan = data.tujuan.split(','); // Asumsikan data.tujuan adalah string yang dipisah dengan koma
                    // Reset semua checkbox terlebih dahulu
                    $('input[type="checkbox"]').prop('checked', false);

                    // Cek checkbox sesuai dengan nilai tujuan
                    tujuan.forEach(function(item) {
                        // Trim item untuk menghilangkan spasi ekstra
                        item = item.trim();

                        // Sesuaikan nilai checkbox dengan item
                        if (item === 'Direktur Utama') {
                            $('#dirut').prop('checked', true);
                        } else if (item === 'Direktur') {
                            $('#direktur').prop('checked', true);
                        } else if (item === 'Manager Keuangan') {
                            $('#menku').prop('checked', true);
                        } else if (item === 'Manager Kepesertaan') {
                            $('#menkep').prop('checked', true);
                        } else if (item === 'Manager SDM Umum & TI') {
                            $('#menum').prop('checked', true);
                        } else if (item === 'Audit') {
                            $('#audit').prop('checked', true);
                        }
                    });

                    console.log('Data user berhasil diambil:', data);
                },
                error: function() {
                    console.log('Gagal mengambil data surat.');
                }
            });
        });
    });
</script>