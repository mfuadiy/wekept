<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">

			<div class="card" style="height: 720px; overflow-y: scroll;">
				<div class="card-header">
					<!-- <a href="#" onclick="history.back()" class="fas fa-arrow-circle-left mr-2"></a> -->
					<a href="<?= base_url(); ?>aktif" class="fas fa-arrow-circle-left ml-2"></a>
					Data Peserta
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
						<a class="nav-link active" href="#">Data Pribadi</a>
						<a class="nav-link" href="<?= base_url(); ?>aktif/detail_simulasi/<?= $alldata['npk']; ?>">Simulasi Pensiun</a>
						<a class="nav-link" href="<?= base_url(); ?>aktif/riwayat/<?= $alldata['npk']; ?>">Riwayat Perubahan</a>
					</nav>

					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

							<form action="<?= base_url(); ?>aktif/update_preview/<?= $alldata['npk'];  ?>" method="post" enctype="multipart/form-data">
								<p class="card-text">
									<b>Data Pribadi</b>
								</p>
								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
									<div class="col-sm-10">
										<input type="text" id="nama" name="nama" class="form-control" value="<?= $alldata['nama_pes']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Jenis Kelamin</label>
									<div class="col-sm-10">
										<select id="jk" name="jk" class="form-control">
											<?php foreach ($jk as $j) : ?>
												<option value="<?= $j['id']; ?>" <?php if ($alldata['jk'] == $j['id']) {
																						echo "selected";
																					} ?>>
													<?= $j['jk']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Agama</label>
									<div class="col-sm-10">
										<select id="agama" name="agama" class="form-control">
											<?php foreach ($agama as $ag) : ?>
												<option value="<?= $ag['id']; ?>" <?php if ($alldata['agama'] == $ag['id']) {
																						echo "selected";
																					} ?>>
													<?= $ag['agama']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tempat Lahir</label>
									<div class="col-sm-10">
										<input type="text" id="tp_lhr" name="tp_lhr" class="form-control" value="<?= $alldata['tp_lhr']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Lahir</label>
									<div class="col-sm-10">
										<input type="date" id="tgl_lhr" name="tgl_lhr" class="form-control" value="<?= $alldata['tgl_lhr']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">NIK</label>
									<div class="col-sm-10">
										<input type="text" id="nik" name="nik" class="form-control" value="<?= $alldata['nik']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">NPWP</label>
									<div class="col-sm-10">
										<input type="text" id="npwp" name="npwp" class="form-control" value="<?= $alldata['npwp']; ?>" required>
									</div>
								</div>

								<p class="card-text">
									<b>Pekerjaan</b>
								</p>


								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Jabatan</label>
									<div class="col-sm-10">
										<input type="text" id="st_peg" name="st_peg" class="form-control" value="<?= $alldata['st_peg']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Cabang</label>
									<div class="col-sm-10">
										<select id="cabang" name="cabang" class="form-control">
											<?php foreach ($cabang as $cab) : ?>
												<option value="<?= $cab['cab']; ?>" <?php if ($alldata['cab'] == $cab['cab']) {
																						echo "selected";
																					} ?>>
													<?= $cab['nama_cab']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="form-group row" hidden>
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">NPK</label>
									<div class="col-sm-10">
										<input type="text" id="noreg" name="noreg" class="form-control" value="<?= $alldata['npk']; ?>" readonly hidden>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Masuk</label>
									<div class="col-sm-10">
										<input type="date" id="tgl_mb" name="tgl_mb" class="form-control" value="<?= $alldata['tgl_mb']; ?>" required readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Golongan</label>
									<div class="col-sm-10">
										<input type="text" id="golongan" name="golongan" class="form-control" value="<?= $alldata['golongan']; ?>" required readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Gaji Pokok</label>
									<div class="col-sm-10">
										<input type="text" id="phdp" name="phdp" class="form-control" value="<?= $alldata['phdp']; ?>" required readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">SK Terakhir Kenaikan Gaji Pokok/Golongan</label>
									<div class="col-sm-10">
										<input type="text" id="nskst" name="nskst" class="form-control" value="<?= $alldata['nskst']; ?>" required readonly>
									</div>
								</div>

								<p class="card-text">
									<b>Alamat</b>
								</p>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
									<div class="col-sm-10">
										<textarea class="form-control" aria-label="With textarea" id="almt" name="almt" required><?= $alldata['almt']; ?></textarea>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">RT/RW</label>
									<div class="col-sm-10">
										<input type="text" id="rt_rw" name="rt_rw" class="form-control" value="<?= $alldata['rt_rw']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kelurahan</label>
									<div class="col-sm-10">
										<input type="text" id="kelurahan" name="kelurahan" class="form-control" value="<?= $alldata['kelurahan']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kecamatan</label>
									<div class="col-sm-10">
										<input type="text" id="kecamatan" name="kecamatan" class="form-control" value="<?= $alldata['kecamatan']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kota</label>
									<div class="col-sm-10">
										<input type="text" id="kota" name="kota" class="form-control" value="<?= $alldata['kota']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Provinsi</label>
									<div class="col-sm-10">
										<select id="provinsi" name="provinsi" class="form-control" required>
											<?php foreach ($prov as $p) : ?>
												<option <?php
														if ($alldata['provinsi'] == $p['prov']) {
															echo "selected";
														}
														?>>
													<?php echo $p['prov']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>



								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kode Pos</label>
									<div class="col-sm-10">
										<input type="text" id="kodepos" name="kodepos" class="form-control" value="<?= $alldata['kodepos']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nomor Telepon</label>
									<div class="col-sm-10">
										<input type="text" id="phone" name="phone" class="form-control" value="<?= $alldata['phone']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nomor Handphone</label>
									<div class="col-sm-10">
										<input type="text" id="hp" name="hp" class="form-control" value="<?= $alldata['telphp']; ?>" required>
									</div>
								</div>



								<a href="<?= base_url(); ?>aktif/tambah_ahliwaris/<?= $alldata['npk'] ?>" class="btn btn-success mt-3 mb-3">
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									Tambah Ahli Waris
								</a>

								<div style="height:250px;width:100%; overflow:auto;">
									<table class="table">
										<thead>
											<tr>
												<th>
													<p class="card-text">
														Nama Ahli Waris
													</p>
												</th>
												<th>
													<p class="card-text">
														Jenis Kelamin
													</p>
												</th>
												<th>
													<p class="card-text">
														Status Keluarga
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
														Status Tanggungan
													</p>
												</th>
												<th>
													<p class="card-text">
														Keterangan
													</p>
												</th>
												<th>
													<p class="card-text">
														Aksi
													</p>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($ahli_waris as $aw) : ?>
												<tr>
													<td><?= $aw['nama'] ?></td>
													<td>
														<?php
														if ($aw['jk_aw'] == "P") {
															echo "Perempuan";
														} else {
															echo "Laki-Laki";
														}
														?>

													</td>
													<td>
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
													<td><?= $aw['tplhr']; ?></td>
													<td><?= date('d/m/Y', strtotime($aw['tgl_lhr_aw'])); ?></td>
													<td>
														<?php
														if ($aw['st_tangg'] == "MT") {
															echo "Menjadi Tanggungan";
														} else {
															echo "Tidak Menjadi Tanggungan";
														}
														?>

													</td>
													<td><?= $aw['ket'] ?></td>
													<td>
														<div style="font-size: 20px;">
															<a title="Edit Ahli Waris" href="<?= base_url(); ?>aktif/edit_ahliwaris/<?= $aw['no_id'] ?>" class="fas fa-edit" style="color: orange;"></a>

															<a title="Hapus Ahli Waris" href="<?= base_url(); ?>aktif/hapus_ahliwaris/<?= $aw['no_id'] ?>" class="fas fa-trash-alt" style="color: red;" onclick="konfirmasi()"></a>

															<a title="Riwayat Perubahan" href="<?= base_url(); ?>aktif/riwayat_ahliwaris/<?= $aw['no_id'] ?>" class="fas fa-history" style="color: #5e9cf9;"></a>
														</div>

													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>

								<div class="card mt-2 mb-4">
									<div class="card-body">
										<center>
											<h4>Dokumen Pengurusan Manfaat Pensiun</h4>
										</center>


										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_sk_direksi" name="f_sk_direksi" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>SK Direksi BPJS Ketenagakerjaan</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_kk" name="f_kk" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>Kartu Keluarga</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_srt_nikah" name="f_srt_nikah" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>Surat Nikah</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_ktp_suami" name="f_ktp_suami" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>KTP Suami</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_ktp_istri" name="f_ktp_istri" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>KTP Istri</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_akta_lhr" name="f_akta_lhr" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>Akta Kelahiran Anak</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_npwp" name="f_npwp" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>NPWP</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_buku_rek" name="f_buku_rek" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>Halaman Depan Buku Rekening</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_form_aw" name="f_form_aw" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>Formulir Penunjukkan Pihak yang Berhak</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_foto" name="f_foto" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>Pas Foto Berwarna</label>
										</div>

										<div class="alert alert-success mt-4">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="f_spt" name="f_spt" accept=".jpg,.png,.jpeg,.bmp, .pdf">
													<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
												</div>
											</div>
											<label>Bukti Potong Pajak PPH 21 dari BPJS Ketenagakerjaan</label>
										</div>
										<label for=""><b>Max. 2 MegaBites</b></label>
									</div>
								</div>

								<div class="col-md-5 ml-3">
									<table>
										<tr>
											<th>
												<input type="checkbox" required>
											</th>
											<td>
												<p class="ml-3" align="justify">Saya secara sadar seluruh pernyataan data dan informasi yang saya lampirkan adalah benar</p>
											</td>
										</tr>
									</table>
								</div>
								<br>

								<!-- <button type="button" class="btn btn-success ml-3" onclick="window.location.href = 'javascript:window.history.go(-1);';">Kembali</button> -->
								<button type="submit" class="btn btn-danger" id="saveDataPribadi" onclick="konfirmasi()">Save</button>

								<script type="text/javascript">
									function konfirmasi() {
										confirm('Anda Yakin?')
									}
								</script>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>