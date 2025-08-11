<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">

			<div class="card" style="height: 720px; overflow-y: scroll;">
				<div class="card-header">
					<a href="<?= base_url(); ?>aktif" class="fas fa-arrow-circle-left ml-2"></a>Riwayat Perubahan
				</div>
				<div class="card-body">

					<main class="container">
						<div class="row">
							<div class="col-md-6">
								<img class="img-thumbnail center" src="<?php if ($alldata['img'] !== '') {
																			echo base_url('assets/img/profile/') . $alldata['img'];
																		} else {
																			echo base_url('assets/img/profile/default.jpg');
																		} ?>" width="155">


								<form action="<?= base_url(); ?>aktif/update_fotoprofil" method="post" enctype="multipart/form-data">
									<div class="row mt-2">
										<div class="custom-file col-md-6">
											<input type="hidden" id="noreg" name="noreg" value="<?= $alldata['npk']; ?>">

											<input type="file" class="custom-file-input" id="image" name="image">

											<label class="custom-file-label" for="image"></label>
										</div>
										<div class="custom-file col-md-6">
											<button type="submit" class="btn btn-danger" id="savefoto">Simpan</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?= $alldata['nama_pes']; ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">NPK</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?= $alldata['npk']; ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Nomor Pensiun</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?= $alldata['nopes']; ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Jabatan</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?= $alldata['st_peg']; ?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Usia</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php /*$hitungan['usia'];*/

																						$now		= new DateTime();
																						$lahir		= new DateTime($alldata['tgl_lhr']);
																						$intervallhr = date_diff($lahir, $now);
																						echo $intervallhr->y . ' tahun ';
																						echo $intervallhr->m . ' bulan ';
																						?>" readonly>
									</div>
								</div>
							</div>
						</div>
					</main>

					<nav class="nav nav-pills nav-justified mb-4">
						<a class="nav-link" href="<?php

													if ($user['role_id'] == '3') {
														echo base_url('aktif/detailAktif');
													} else {
														echo base_url('aktif/detail/' . $alldata['npk']);
													}

													?>">Data Pribadi</a>
						<a class="nav-link" href="<?= base_url(); ?>aktif/detail_simulasi/<?= $alldata['npk']; ?>">Simulasi Pensiun</a>
						<a class="nav-link active" href="#">Riwayat Perubahan</a>
					</nav>

					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

							<div class="table-responsive">
								<table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">

									<thead>

										<tr>
											<th>
												<p class="card-text">
													No
												</p>
											</th>

											<th>
												<p class="card-text">
													Nama
												</p>
											</th>

											<th>
												<p class="card-text ml-3">
													Jenis Kelamin
												</p>
											</th>

											<th>
												<p class="card-text">
													Tempat Lahir
												</p>
											</th>

											<th>
												<p class="card-text">
													Tanggal Lahir
												</p>
											</th>

											<th>
												<p class="card-text">
													NIK
												</p>
											</th>

											<th>
												<p class="card-text">
													Jabatan
												</p>
											</th>

											<th>
												<p class="card-text">
													NPK
												</p>
											</th>

											<th>
												<p class="card-text">
													Tanggal Masuk
												</p>
											</th>

											<th>
												<p class="card-text">
													Golongan
												</p>
											</th>

											<th>
												<p class="card-text">
													Gaji Pokok
												</p>
											</th>

											<th>
												<p class="card-text">
													SK Terakhir Kenaikan
												</p>
											</th>

											<th>
												<p class="card-text">
													Alamat
												</p>
											</th>

											<th>
												<p class="card-text">
													RT/RW
												</p>
											</th>

											<th>
												<p class="card-text">
													Kelurahan
												</p>
											</th>

											<th>
												<p class="card-text">
													Kecamatan
												</p>
											</th>

											<th>
												<p class="card-text">
													Kota
												</p>
											</th>

											<th>
												<p class="card-text">
													Kode Pos
												</p>
											</th>

											<th>
												<p class="card-text">
													Nomor Telepon
												</p>
											</th>

											<th>
												<p class="card-text">
													Penyunting
												</p>
											</th>

											<th>
												<p class="card-text">
													Tanggal Diubah
												</p>
											</th>
										</tr>

									</thead>
									<tbody>
										<?php $i = 1; ?>
										<?php foreach ($riwayat as $r) : ?>
											<tr>
												<td> <?= $i++; ?> </td>
												<td> <?= $r['nama_pes']; ?> </td>
												<td> <?= $r['jk']; ?> </td>
												<td> <?= $r['tp_lhr']; ?> </td>
												<td> <?= date('d/m/Y', strtotime($r['tgl_lhr'])); ?> </td>
												<td> <?= $r['nik']; ?> </td>
												<td> <?= $r['st_peg']; ?> </td>
												<td> <?= $r['npk']; ?> </td>
												<td> <?= date('d/m/Y', strtotime($r['tgl_mb'])); ?> </td>
												<td> <?= $r['golongan']; ?> </td>
												<td> <?= $r['phdp']; ?> </td>
												<td> <?= $r['nskst']; ?> </td>
												<td> <?= $r['almt']; ?> </td>
												<td> <?= $r['rt_rw']; ?> </td>
												<td> <?= $r['kelurahan']; ?> </td>
												<td> <?= $r['kecamatan']; ?> </td>
												<td> <?= $r['kota']; ?> </td>
												<td> <?= $r['kodepos']; ?> </td>
												<td> <?= $r['phone']; ?> </td>
												<td> <?= $r['penyunting']; ?> </td>
												<td> <?php
														date_default_timezone_set('Asia/Jakarta');
														echo date('d/m/Y H:i:s', $r['date_created']);
														?> </td>

											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</div>