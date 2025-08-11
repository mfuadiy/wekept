<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Daftar Pensiunan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <a href="<?= base_url('pasif/export_datul'); ?>" class="btn btn-success"><i class="fas fa-download"></i> Export Data Excel</a>
                <br><br>

                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NPK</th>
                            <th>Nomor Pensiun</th>
                            <th>Nama Peserta</th>
                            <th>Status</th>
                            <th style="text-align: center;">Update Simadu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($peoples)) : ?>
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger" role="alert">
                                        DATA TIDAK DITEMUKAN!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php $i = 1;
                        foreach ($peoples as $ppl) : ?>
                            <tr>
                                <?php
                                $npk = $ppl['npk'];
                                $ci         = get_instance();

                                $ci->db->where('npk', $npk);
                                $getDatul   = $ci->db->get('datul');
                                $row        = $getDatul->num_rows(); ?>
                                <th><?= $i++; ?></th>
                                <td><?= $ppl['npk']; ?></td>
                                <td><?= $ppl['nopen']; ?></td>
                                <td><?= $ppl['nama']; ?></td>
                                <td>
                                    <?php
                                    if ($row < 1) {
                                        echo "Not Completed";
                                    } else {
                                        echo "Completed";
                                    }

                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <input class="simadu" id="simadu" type="checkbox"
                                        <?= simadu($ppl['nopen'] ?? '', $datul['simadu'] ?? ''); ?>
                                        data-nopen="<?= $ppl['npk'] ?? ''; ?>"
                                        data-simadu="<?= $datul['simadu'] ?? ''; ?>">
                                </td>
                                <td>
                                    <a href="<?= base_url(); ?>pasif/detail_datul/<?= $ppl['npk']; ?>" class="badge badge-warning">update</a>
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