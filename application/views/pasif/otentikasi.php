<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">DAFTAR OTENTIKASI</h3>
        </div>
        <div class="card-body">
            <a href="<?= base_url('otentikasi/analisaOtentikasi'); ?>" class="btn btn-danger">Analisa Otentikasi</a>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NPK</th>
                            <th>Bulan</th>
                            <th>Gambar</th>
                            <th>Tanggal Dibuat</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($otentikasi)) : ?>
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-danger" role="alert">
                                        DATA TIDAK DITEMUKAN!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($otentikasi as $data) : ?>
                            <tr>
                                <td><?= $data['npk']; ?> </td>
                                <td><?= $data['bln']; ?></td>
                                <td>
                                    <img src="<?= base_url('assets/img/otentikasi/' . $data['nama_foto']); ?>" alt="Gambar Otentikasi" style="width: 100px; height: auto;">
                                </td>
                                <td><?= date('d F Y', $data['date_created']); ?></td>
                                <td style="text-align: center;">
                                    <a href="#" <?= ($data['status'] == 1) ? 'class="badge badge-success"' : 'class="badge badge-warning"'; ?> id="approvalLink" data-toggle="modal" data-target="#staticBackdrop">
                                        <?= ($data['status'] == 1) ? 'Disetujui' : 'Setuju'; ?>
                                    </a>

                                    <!-- Anda bisa menambahkan aksi lain seperti hapus atau edit -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Gambar Otentikasi" class="img-fluid">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirm Bootstrap -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Persetujuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3 mt-3 mb-3" style="text-align: left;">
                    Apakah Anda yakin ingin menyetujui?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmApprovalBtn">Setuju</button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<style>
    /* Buat modal full screen */
    .modal-dialog {
        display: flex;
        align-items: center;
        justify-content: center;

        min-height: 90vh;
    }

    .modal-body {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .modal-body img {
        max-width: 150%;
        /* Ukuran lebar maksimal 90% dari layar */
        max-height: 60vh;
        /* Ukuran tinggi maksimal 90% dari layar */
    }
</style>

<script>
    // Event listener untuk gambar
    document.querySelectorAll('img').forEach(image => {
        image.addEventListener('click', function() {
            const src = this.src;
            const modalImage = document.getElementById('modalImage');
            modalImage.src = src;
            $('#imageModal').modal('show');
        });
    });
</script>

<script>
    document.getElementById('confirmApprovalBtn').addEventListener('click', function() {
        var npk = "<?= $data['npk']; ?>"; // Ganti ini dengan variabel NPK sesuai kebutuhan
        var url = "<?= base_url(); ?>otentikasi/approval/" + npk;

        // Mengirimkan permintaan AJAX ke server
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                // Jika kamu perlu mengirimkan data tambahan, kamu bisa menambahkannya di sini
                // body: JSON.stringify({ key: value })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Approval status updated successfully.') {
                    // Tutup modal setelah sukses
                    $('#staticBackdrop').modal('hide');
                    // Ubah warna tautan menjadi hijau
                    document.getElementById('approvalLink').classList.remove('badge-warning');
                    document.getElementById('approvalLink').classList.add('badge-success');
                    document.getElementById('approvalLink').innerText = 'Disetujui'; // Opsional, ubah teks tautan
                } else {
                    // Tampilkan notifikasi atau pesan error
                    alert('Gagal mengupdate status persetujuan.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupdate status persetujuan.');
            });
    });
</script>