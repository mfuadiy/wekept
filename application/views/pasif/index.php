<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Daftar Peserta Pensiun</h4>
        </div>
        <div class="card-body">
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Peserta</th>
                            <th>Nomor Pegawai</th>
                            <th>Nama Peserta</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pensiun)) : ?>
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger" role="alert">
                                        DATA TIDAK DITEMUKAN!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($pensiun as $ppl) : ?>
                            <tr>
                                <th><?= ++$start; ?></th>
                                <td><?= $ppl['nopen']; ?></td>
                                <td><?= $ppl['npk']; ?></td>
                                <td><?= $ppl['nama']; ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= base_url(); ?>pasif/detail/<?= $ppl['npk']; ?>" class="badge badge-warning">detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>