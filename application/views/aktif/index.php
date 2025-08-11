<div class="container">
	<div class="card shadow">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary">Daftar Peserta Aktif</h4>
		</div>
		<div class="card-body">
			<a href="<?= base_url('aktif/analisaPesertaAktif'); ?>" class="btn btn-danger">Analisa Peserta Aktif</a>
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
						<?php if (empty($aktif)) : ?>
							<tr>
								<td colspan="4">
									<div class="alert alert-danger" role="alert">
										DATA TIDAK DITEMUKAN!
									</div>
								</td>
							</tr>
						<?php endif; ?>
						<?php foreach ($aktif as $ppl) : ?>
							<tr>
								<th><?= ++$start; ?></th>
								<td><?= $ppl['nopes']; ?></td>
								<td><?= $ppl['npk']; ?></td>
								<td><?= $ppl['nama_pes']; ?></td>
								<td style="text-align: center;">
									<a href="<?= base_url(); ?>aktif/detail/<?= $ppl['npk']; ?>" class="badge badge-warning">lihat</a>
									<a href="<?= base_url(); ?>aktif/detail_peserta_simulasi/<?= $ppl['npk']; ?>" class="badge badge-success">Hitung Proyeksi</a>
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