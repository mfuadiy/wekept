<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">

			<div class="card" style="height: 720px; overflow-y: scroll;">
				<div class="card-header">
					<!-- <a href="#" onclick="history.back()" class="fas fa-arrow-circle-left mr-2"></a> -->
					<a href="<?= base_url(); ?>aktif" class="fas fa-arrow-circle-left ml-2"></a>
					Proyeksi Manfaat
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
						<a class="nav-link active" href="<?= base_url(); ?>atif/detail_simulasi/<?= $alldata['npk']; ?>">Simulasi Pensiun</a>
						<a class="nav-link" href="<?= base_url(); ?>aktif/riwayat/<?= $alldata['npk']; ?>">Riwayat Perubahan</a>
					</nav>

					<?php
					// Deklarasi POST
					$henti 			= $_POST['tgl_brnt'] ?? null;
					$mulai 			= $_POST['tgl_mb'] ?? null;
					$ns 			= $_POST['ns'] ?? null;
					$naik       	= $_POST['naik'] ?? null;
					$persen20   	= $_POST['persen20'] ?? null;
					$st_kwn     	= $_POST['st_kwn'] ?? null;
					$mkth_diakui 	= $_POST['mkth_diakui'] ?? 0;
					$mkbl_diakui 	= $_POST['mkbl_diakui'] ?? 0;
					$phdp 			= $_POST['phdp'] ?? 0;
					$setor     		= intval($_POST['setor'] ?? 0);
					$penghasilan	= intval($_POST['penghasilan'] ?? 0);

					$lhr 			= $alldata['tgl_lhr'] ?? '1970-01-01';
					$mp 			= "";
					$x 				= 0;

					// Hitung tanggal pensiun: usia 57 tahun, efektif tanggal 1 bulan berikutnya
					$tgl_ulangtahun_57 = date('Y-m-d', strtotime('+57 year', strtotime($lhr)));
					$next_month = date('Y-m-01', strtotime($tgl_ulangtahun_57 . ' +1 month'));
					$pensiun = $next_month;

					$p_henti		= date('Y-m-d', strtotime("+{$mkth_diakui} year +{$mkbl_diakui} month", strtotime($henti)));
					$brnt 			= new DateTime($p_henti);
					$mli			= new DateTime($mulai);
					$pensi 			= new DateTime($henti);
					$now			= new DateTime();
					$sisaMb			= $now->diff($pensi);
					$sisaMbTh 		= $sisaMb->y;

					// Deklarasi CodeIgniter
					$ci 			= get_instance();

					// Menghitung Masa Kerja
					$pro_mbk		= new DateTime($lhr);
					$valkrj			= $pro_mbk->diff(new DateTime($henti));
					$lamakrj		= ($valkrj->y + $mkth_diakui) + round(($valkrj->m + $mkbl_diakui + 1) / 12, 2);
					$t 				= $valkrj->y;
					$b 				= $valkrj->m;

					// Cek Kategori TER
					$kategori_ter 	= $ci->db->get_where('kategori_ter', ['kwn' => $st_kwn])->row_array();
					$ptkp 			= $kategori_ter['ptkp'] ?? 0;
					$status_kawin	= $kategori_ter['status_kwn'] ?? 'TK';

					$thbl = "202405";
					$where = [
						'umr_th' 	=> $t,
						'umr_bln' 	=> $b,
						'stkwn'		=> $status_kawin,
						'thbl'		=> $thbl
					];

					$result 	= $ci->db->get_where('aktuaria', $where)->row_array();
					$fgus 		= isset($_POST['hitung']) ? floatval($result['fktr_sgus']) : floatval($_POST['fgus'] ?? 0);

					// Hitung Masa Kerja Total
					$intervalmk 	= $mli->diff($brnt);
					$mk				= $intervalmk->y + round(($intervalmk->m) / 12, 2);

					// Saat tombol hitung diklik
					if (isset($_POST['hitung'])) {
						$mp_max	= $phdp * 0.8;

						// Jika ada kenaikan
						if ($naik) {
							while ($x < $sisaMbTh) {
								$phdp *= 1.04;
								$x++;
							}
						}

						$mp = $mk * $ns * 0.025 * $phdp;
						$mp = min($mp, $phdp * 0.8);

						$biaya_pensiun = ($mp < 4000000) ? $mp * 0.05 : 200000;

						$bln_henti = intval(date('m', strtotime($henti)));
						$sisabln = ($penghasilan == 0) ? 12 : 13 - $bln_henti;

						$mpnetto_p1 = ($mp - $biaya_pensiun) * $sisabln;
						$jml_netto_thn_p1 = $mpnetto_p1 + $penghasilan;

						$round_pkp_p1 = round($jml_netto_thn_p1 - $ptkp);
						$pkp_p1 = max(intval(substr($round_pkp_p1, 0, -3) . "000"), 0);

						// Pajak progresif
						$pph21thn_p1 = hitung_pph21($pkp_p1);

						// Tarif TER & Pajak Bulanan
						$tarif_ter = $ci->db->get_where('tarif_ter', [
							'kategori_ter' => $kategori_ter['kategori_ter'],
							'mulai_gaji <=' => $mp,
							'sampai_gaji >=' => $mp
						])->row_array();

						$pph21mpber_p1	= ($pph21thn_p1 - $setor) / $sisabln;
						$ter_jan_nov_p1	= $tarif_ter['tarif_ter'] * $mp;
						$ter_des_p1		= ($pph21thn_p1 - $setor) - ($ter_jan_nov_p1 * ($sisabln - 1));
						$totpenmp_p1 	= $mp - $pph21mpber_p1;

						// Pilihan 2
						$mp80 = $mp * 0.8;
						$mpsek = $mp * $fgus;
						$mpsek20 = $mp * $fgus * 0.2;
						$sek2050 = round(($mpsek20 - 50000000), -2);
						$pph2120 = max(round($sek2050 * 0.05, -2), 0);

						$bj = ($mp80 < 4000000) ? $mp80 * 0.05 : 200000;
						if (!isset($persen20)) {
							$bj = ($mp < 4000000) ? $mp * 0.05 : 200000;
						}

						$mpnetto = isset($persen20) ? ($mp80 - $bj) * $sisabln : ($mp - $bj) * $sisabln;
						$hasil_tahun = $mpnetto + $penghasilan;
						$pkp = max(intval(substr(round($hasil_tahun - $ptkp), 0, -3) . "000"), 0);

						$pph21thn = hitung_pph21($pkp);
						$pph21mpber = ($pph21thn - $setor) / $sisabln;

						// Tarif TER Pilihan 2
						$gaji_cari = isset($persen20) ? $mp80 : $mp;
						$tarif_ter = $ci->db->get_where('tarif_ter', [
							'kategori_ter' => $kategori_ter['kategori_ter'],
							'mulai_gaji <=' => $gaji_cari,
							'sampai_gaji >=' => $gaji_cari
						])->row_array();

						$ter_jan_nov = $tarif_ter['tarif_ter'] * $gaji_cari;
						$ter_des = ($pph21thn - $setor) - ($ter_jan_nov * ($sisabln - 1));

						$totpenmp = $gaji_cari - $pph21mpber;
						$totalmp_pajak = ((($mp - $bj) * 12) - $ptkp);
						$totpenmp80 = $mp80 - $pph21mpber;
					}

					// Format Rupiah
					function rupiah($angka)
					{
						return "Rp. " . number_format($angka, 0, ',', '.');
					}

					// Hitung Pajak Progresif
					function hitung_pph21($pkp)
					{
						$pph = 0;
						if ($pkp <= 60000000) {
							$pph = $pkp * 0.05;
						} elseif ($pkp <= 250000000) {
							$pph = 60000000 * 0.05 + ($pkp - 60000000) * 0.15;
						} elseif ($pkp <= 500000000) {
							$pph = 60000000 * 0.05 + 190000000 * 0.15 + ($pkp - 250000000) * 0.25;
						} elseif ($pkp <= 5000000000) {
							$pph = 60000000 * 0.05 + 190000000 * 0.15 + 250000000 * 0.25 + ($pkp - 500000000) * 0.30;
						} else {
							$pph = 60000000 * 0.05 + 190000000 * 0.15 + 250000000 * 0.25 + 4500000000 * 0.30 + ($pkp - 5000000000) * 0.35;
						}
						return $pph;
					}

					$gaji 	= $alldata['phdp'] ?? 0;
					$hasil 	= $gaji;
					$sisaMsBk = $sisaMbTh;
					?>



					<!-- Form Perhitungan Proyeksi -->
					<form method="post" action="">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_pes" id="nama_pes" value="<?= $alldata['nama_pes'] ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">NPK</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="noreg" id="noreg" value="<?= $alldata['npk'] ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Perkiraan Pensiun</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_pensiun" id="p_pensiun" value="<?php echo date("01/m/Y", strtotime($pensiun)); ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Perkiraan Masa Bekerja</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_mk" id="p_mk" value="<?php
																										$pensN		= new DateTime($pensiun);
																										$pro_mbk		= new DateTime($alldata['tgl_mb']);
																										$intervalkrj = date_diff($pro_mbk, $pensN);
																										$lamakerja	= $intervalkrj->y + round((($intervalkrj->m + 1) / 12), 2);
																										//var_dump($lamakerja);
																										echo $intervalkrj->y . ' Tahun ';
																										echo $intervalkrj->m . ' Bulan ';
																										// echo $intervalkrj->d.' hari.';
																										?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Usia</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="usia" id="usia" value="<?php
																										$pensN		= new DateTime($pensiun);
																										$lhr		= new DateTime($alldata['tgl_lhr']);
																										$now		= new DateTime();
																										$intervallhr = "";
																										if (isset($_POST['hitung'])) {
																											$intervallhr = date_diff($lhr, $brnt);
																										} else {
																											$intervallhr = date_diff($lhr, $now);
																										}
																										//$intervallhr= date_diff($lhr, $now);

																										$usia	= $intervallhr->y + round((($intervallhr->m + 1) / 12), 2);
																										//var_dump($lamakerja);
																										echo $intervallhr->y . ' Tahun ';
																										echo $intervallhr->m . ' Bulan ';
																										//echo $intervalkrj->d.' hari.';
																										?>" readonly>
							</div>
						</div>


						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Sisa Masa Bekerja</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="s_mk" id="s_mk" value="<?php

																										$sisaMb		= date_diff($pensN, $now);
																										//$lamakerja	= $interval->y + round((($interval->m)/12),2);
																										//var_dump($lamakerja);
																										echo $sisaMb->y . ' tahun ';
																										echo $sisaMb->m . ' bulan ';
																										//echo $intervallhr->d.' hari.';

																										?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Lahir</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="tgl_lhr" id="tgl_lhr" value="<?= $alldata['tgl_lhr'] ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Mulai Kerja</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="tgl_mb" id="tgl_mb" value="<?= $alldata['tgl_mb'] ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Berhenti</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="tgl_brnt" id="tgl_brnt" value="<?= @$_POST['tgl_brnt']; ?>" required>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Masa Kerja Diakui</label>
							<div class="col-sm-8">
								<div class="form-row">
									<div class="col">
										<input type="number" class="form-control" name="mkth_diakui" id="mkth_diakui" value="<?php if (isset($_POST['hitung'])) {
																																	echo $mkth_diakui;
																																} else {
																																	echo "0";
																																}  ?>">
									</div>
									<div class="col col-form-label">
										<label>Tahun</label>
									</div>
									<div class="col">
										<input type="number" class="form-control" name="mkbl_diakui" id="mkbl_diakui" value="<?php if (isset($_POST['hitung'])) {
																																	echo $mkbl_diakui;
																																} else {
																																	echo "0";
																																}  ?>">
									</div>
									<div class="col col-form-label">
										<label>Bulan</label>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PhDP Saat Ini
							</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="phdp" id="phdp" value="<?php if (isset($_POST['hitung'])) {
																											echo @$_POST['phdp'];
																										} else {
																											echo $gaji;
																										}
																										?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Status Kawin</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="st_kwn" id="st_kwn" value="<?php if (isset($_POST['hitung'])) {
																												echo $st_kwn;
																											} else {
																												echo $alldata['st_kwn'];
																											}
																											?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Faktor Sekaligus</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="fgus" id="fgus" value="<?php

																										if (isset($_POST['hitung'])) {
																											echo $fgus;
																										} else {
																											echo $akt['fktr_sgus'];
																										}
																										//$akt['fktr_sgus'];
																										?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Nilai Sekarang</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="ns" id="ns" value="<?php if (isset($_POST['hitung'])) {
																										echo @$_POST['ns'];
																									} else {
																										echo "1";
																									} ?>" required>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Asumsi Kenaikan 4%</label>
							<div class="col-sm-8">
								<input type="checkbox" class="form-control" name="naik" id="naik" value="checked" <?= @$_POST['naik']; ?>>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">MP Sekaligus 20%</label>
							<div class="col-sm-8">
								<input type="checkbox" class="form-control" name="persen20" id="persen20" value="checked" <?= @$_POST['persen20']; ?>>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Sebelumnya</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="penghasilan" id="penghasilan" value="<?php if (isset($_POST['hitung'])) {
																															echo @$_POST['penghasilan'];
																														} else {
																															echo "0";
																														} ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Pajak Yang Sudah Disetorkan</label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="setor" id="setor" value="<?php if (isset($_POST['hitung'])) {
																												echo @$_POST['setor'];
																											} else {
																												echo "0";
																											} ?>">
							</div>
						</div>

						<button type="submit" class="btn btn-success mt-2 mb-4" id="hitung" name="hitung">Hitung</button>
					</form>

					<!-- Tampilan Perhitungan Proyeks -->
					<form method="post" action="<?php
												if (isset($_POST['persen20'])) {
													echo base_url(); ?>laporan/pdf_proyeksi_mp_sekaligus/<?= $alldata['npk'];
																										} else {
																											echo base_url(); ?>laporan/pdf_proyeksi_mp/<?= $alldata['npk'];
																																					}

																																						?>" target="_blank">
						<!-- Data Hidden -->
						<div hidden>
							<input type="text" class="form-control" name="nama_pes" id="nama_pes" value="<?= $alldata['nama_pes'] ?>">
							<input type="text" class="form-control" name="noreg" id="noreg" value="<?= $alldata['npk'] ?>">
							<input type="text" class="form-control" name="p_pensiun" id="p_pensiun" value="<?php echo date("01/m/Y", strtotime($pensiun)); ?>">


							<input type="text" class="form-control" name="usia" id="usia" value="<?php
																									$pensN		= new DateTime($pensiun);
																									$lhr		= new DateTime($alldata['tgl_lhr']);
																									$now		= new DateTime();
																									$intervallhr = date_diff($lhr, $now);
																									$usia	= $intervallhr->y + round((($intervallhr->m + 1) / 12), 2);
																									//var_dump($lamakerja);
																									echo $intervallhr->y . ' Tahun ';
																									echo $intervallhr->m . ' Bulan ';
																									//echo $intervalkrj->d.' hari.';
																									?>">
							<input type="text" class="form-control" name="s_mk" id="s_mk" value="<?= $mk; 	?>">
							<input type="text" class="form-control" name="total_penmp_pil_1" id="total_penmp_pil_1" value="<?php error_reporting(0);
																															echo rupiah($mp - $pph21mpber); 	?>">
							<input type="date" class="form-control" name="tgl_lhr" id="tgl_lhr" value="<?= $alldata['tgl_lhr'] ?>">
							<input type="date" class="form-control" name="tgl_mb" id="tgl_mb" value="<?= $alldata['tgl_mb'] ?>">
							<input type="date" class="form-control" name="tgl_brnt" id="tgl_brnt" value="<?= @$_POST['tgl_brnt']; ?>">
							<input type="text" class="form-control" name="phdp" id="phdp" value="<?php
																									$gaji 	= $alldata['phdp'];
																									$hasil 	= $gaji;
																									$sisaMsBk = $sisaMb->y;
																									echo ($phdp); ?>">


							<input type="number" class="form-control" name="phdp_1" id="phdp_1" value="<?php echo $phdp; ?>">


							<input type="text" class="form-control" name="st_kwn" id="st_kwn" value="<?= $st_kwn; ?>">
							<input type="text" class="form-control" name="p_mpsek2050" id="p_mpsek2050" value="<?php if (isset($_POST['hitung'])) {
																													echo rupiah($mpsek2050);
																												} else {
																													echo "1";
																												} ?>">
							<input type="text" class="form-control" name="totpenmp80" id="totpenmp80" value="<?php if (isset($_POST['hitung'])) {
																													echo rupiah($totpenmp80);
																												} else {
																													echo "1";
																												} ?>">
							<input type="text" class="form-control" name="par20" id="par20" value="<?php if (isset($_POST['persen20'])) {
																										echo "1";
																									} else {
																										echo "0";
																									} ?>">
							<input type="text" class="form-control" name="fgus" id="fgus" value="<?= $fgus; ?>">
							<input type="text" class="form-control" name="totpenmp_p1" id="totpenmp_p1" value="<?= rupiah($totpenmp_p1); ?>">
							<input type="text" class="form-control" name="ns" id="ns" value="<?php if (isset($_POST['hitung'])) {
																									echo @$_POST['ns'];
																								} else {
																									echo "1";
																								} ?>" required>

						</div>
						<!-- Akhir Data Hidden -->

						<!-- Hasil Perhitungan -->
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PhDP <br><br></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_phdp" id="p_phdp" value="<?php error_reporting(0);
																											echo rupiah($phdp); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Usia Pensiun<br><br></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="usia_pensiun" id="usia_pensiun" value="<?php echo $t . ' tahun ' . $b . ' bulan'; ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Masa Bekerja<br><br></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_mk" id="p_mk" value="<?php

																										$lamakerja	= $intervalmk->y + round((($intervalmk->m + 1) / 12), 2);

																										echo ($intervalmk->y) . ' Tahun ';
																										echo $intervalmk->m . ' Bulan ';

																										?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label"><b>*Pilihan 1</b></label>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Proyeksi Manfaat Pensiun <br>
								<small style="color: blue;"><?= rupiah($phdp); ?> x 2.5% x <?= $mk; ?> x <?= $ns; ?></small></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_mp" id="p_mp" value="<?php error_reporting(0);
																										echo rupiah($mp); ?>">
							</div>
						</div>

						<div class="form-group row" hidden>
							<label for="inputEmail3" class="col-sm-4 col-form-label">Pajak Manfaat Pensiun </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pph21mpber_p1" id="pph21mpber_p1" value="<?php error_reporting(0);
																														echo rupiah($pph21mpber_p1); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label">Pajak TER Manfaat Pensiun Januari-November</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="ter_jan_nov_p1" id="ter_jan_nov_p1" value="<?php error_reporting(0);
																															echo rupiah($ter_jan_nov_p1); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label">Pajak TER Manfaat Pensiun Desember</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="ter_des_p1" id="ter_des_p1" value="<?php error_reporting(0);
																													echo rupiah($ter_des_p1); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label"><b>Total MP Januari-November</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="mp_jan_nov_p1" id="mp_jan_nov_p1" value="<?php error_reporting(0);
																														echo rupiah($mp - $ter_jan_nov_p1); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label"><b> Total MP Desember</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="mp_des_p1" id="mp_des_p1" value="<?php error_reporting(0);
																												echo rupiah($mp - $ter_des_p1); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label"><b>*Pilihan 2</b> <br><br>Proyeksi Nilai Sekarang Manfaat Pensiun <br>
								<small style="color: blue;"><?= $fgus; ?> x <?= rupiah($mp); ?></small></label>
							<div class="col-sm-8">
								<br><br>
								<input type="text" class="form-control" name="p_mpsek" id="p_mpsek" value="<?php error_reporting(0);
																											echo rupiah($mpsek); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label">Proyeksi MP Sekaligus 20% <br>
								<small style="color: blue;"><?= rupiah($mpsek); ?> x 20%</small></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_mpsek20" id="p_mpsek20" value="<?php error_reporting(0);
																												echo rupiah($mpsek20); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh 21 MP Sekaligus 20% <br>
								<small style="color: blue;"><?= rupiah($mpsek20); ?> x 5%</small></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_pph2120" id="p_pph2120" value="<?php error_reporting(0);
																												echo rupiah($pph2120); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label">Penerimaan MP Sekaligus 20% <br>
								<small style="color: blue;"><?= rupiah($mpsek20) . " - " . rupiah($pph2120); ?></small></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_mp20" id="p_mp20" value="<?php error_reporting(0);
																											echo rupiah($mpsek20 - $pph2120); ?>">
							</div>
						</div>

						<div class="form-group row" <?php if (isset($_POST['persen20'])) {
														echo "";
													} else {
														echo "hidden";
													} ?>>
							<label for="inputEmail3" class="col-sm-4 col-form-label">Proyeksi MP Berkala 80% <br>
								<small style="color: blue;"><?= rupiah($mp); ?> x 80%</small></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="p_mp80" id="p_mp80" value="<?php error_reporting(0);
																											echo rupiah($mp80); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Netto <?= $sisabln; ?> Bulan</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="hasil_tahun" id="hasil_tahun" value="<?= rupiah($mpnetto); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Netto Sebelumnya <?php if ($penghasilan == 0) {
																														echo "";
																													} else {
																														echo $bln_henti - 1 . " Bulan";
																													} ?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="hasil_tahun" id="hasil_tahun" value="<?= rupiah($penghasilan); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan 1 Tahun</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="hasil_tahun" id="hasil_tahun" value="<?= rupiah($hasil_tahun); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PTKP</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="ptkp" id="ptkp" value="<?= rupiah($ptkp); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Penghasilan Kena Pajak</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pkp" id="pkp" value="<?= rupiah($pkp); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (5%)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pph5" id="pph5" value="<?= rupiah($pph5); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (15%)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pph15" id="pph15" value="<?= rupiah($pph15); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (25%)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pph25" id="pph25" value="<?= rupiah($pph25); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (30%)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pph30" id="pph30" value="<?= rupiah($pph30); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 (35%)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pph30" id="pph30" value="<?= rupiah($pph35); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 / Tahun</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pph30" id="pph30" value="<?= rupiah($pph21thn); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 Yang Telah Dipotong / Disetor</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="setor" id="setor" value="<?= rupiah($setor); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">PPh Pasal 21 MP Berkala Perbulan<br>
								<small style="color: blue;"><?php
															$abc = $pph21thn - $setor;
															echo rupiah($pph21thn) . "  -  " . rupiah($setor) . " = " . rupiah($abc) . " / " . $sisabln;  ?></small></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pph21mpber" id="pph21mpber" value="<?= rupiah($pph21mpber); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Pajak TER Manfaat Pensiun Januari-November</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="ter_jan_nov" id="ter_jan_nov" value="<?php error_reporting(0);
																													echo rupiah($ter_jan_nov); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Pajak TER Manfaat Pensiun Desember</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="ter_des" id="ter_des" value="<?php error_reporting(0);
																											echo rupiah($ter_des); ?>">
							</div>
						</div>


						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label"><b>Total MP Januari-November</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="mp_jan_nov" id="mp_jan_nov" value="<?php error_reporting(0);
																													if (isset($_POST['persen20'])) {
																														$totpenmp 	= $mp80;
																													} else {
																														$totpenmp 	= $mp;
																													}
																													echo rupiah($totpenmp - $ter_jan_nov); ?>">
							</div>
						</div>

						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label"><b> Total MP Desember</b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="mp_des" id="mp_des" value="<?php error_reporting(0);
																											if (isset($_POST['persen20'])) {
																												$totpenmp 	= $mp80;
																											} else {
																												$totpenmp 	= $mp;
																											}
																											echo rupiah($totpenmp - $ter_des); ?>">
							</div>
						</div>
						<button type="submit" class="btn btn-danger mt-2 mb-4" id="cetak_pdf" name="cetak_pdf" <?php if (isset($_POST['hitung'])) {
																												} else {
																													echo "disabled";
																												} ?>>Export PDF</button>
					</form>

					<small>
						*Berdasarkan PDP Karyawan BPJS Ketenagakerjaan, besarnya manfaat pensiun setinggi-tingginya 80% dari PhDP(Gaji Pokok 3 Tahun Terkahir) <br>
						**Nilai Aktuaria saat ini adalah 147,35181
					</small>

				</div>
			</div>
		</div>
	</div>
</div>
</div>