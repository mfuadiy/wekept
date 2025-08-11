<div class="container">
    <div class="card shadow">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Daftar Artikel</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahArtikelModal">Tambah Artikel</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTableUser" width="100%" cellspacing="0">
                    <!-- <thead class="table-dark"> -->
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Date Created</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($artikel)): ?>
                            <?php foreach ($artikel as $item): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($item['cover'])): ?>
                                            <img src="http://dpkbpjamsostek.test/assets/img/artikel/cover/<?= htmlspecialchars($item['cover']) ?>" alt="Cover" width="50">
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada cover</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($item['judul']) ?></td>
                                    <td><?= htmlspecialchars(substr($item['deskripsi'], 0, 50)) ?>...</td>
                                    <td>
                                        <?php if (!empty($item['file'])): ?>
                                            <a href="http://dpkbpjamsostek.test/assets/pdf/<?= htmlspecialchars($item['file']) ?>" target="_blank">Download</a>
                                        <?php else: ?>
                                            Tidak ada file
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($item['date_created']) ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada artikel ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Artikel -->
<div class="modal fade" id="tambahArtikelModal" tabindex="-1" aria-labelledby="tambahArtikelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/website/tambah_artikel" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahArtikelModalLabel">Tambah Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cover" class="form-label">Cover</label>
                        <input type="file" class="form-control" id="cover" name="cover">
                    </div>
                    <div class="mb-3">
                        <label for="urutan" class="form-label">Urutan</label>
                        <input type="number" class="form-control" id="urutan" name="urutan" required>
                    </div>
                    <div class="mb-3">
                        <label for="aktif" class="form-label">Aktif</label>
                        <select class="form-control" id="aktif" name="aktif" required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>