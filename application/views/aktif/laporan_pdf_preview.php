<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>



	<!-- <img src="assets/img/logo/dapenbp.png" style="width: 30%;height: auto;position: absolute;"> -->

	<img src="assets/img/logo/dapen.jpg" style="width: 30%;height: auto;position: absolute;">



	<br><br><br>
	<h3 style="text-align: center;">Perubahan Data</h3>
	<br> <br>

	<table width="100%">
		<tr>
			<th>
				Keterangan
			</th>
			<th>
				Data Baru
			</th>
			<th>
				Data Lama
			</th>
		</tr>
		<tr>
			<th>
				Data Pribadi
			</th>
			<td>

			</td>
			<td>

			</td>
		</tr>
		<tr>
			<td>
				Nama
			</td>
			<td>
				<?= $alldata1['nama_pes']; ?>
			</td>
			<td>
				<?= $backup['nama_pes']; ?>
			</td>
		</tr>
		<tr>
			<td>
				Jenis Kelamin
			</td>
			<td>
				<?= $alldata1['jk']; ?>
			</td>
			<td>
				<?= $backup['jk']; ?>
			</td>
		</tr>
		<tr>
			<td>
				Tempat Lahir
			</td>
			<td>
				<?= $alldata1['tp_lhr']; ?>
			</td>
			<td>
				<?= $backup['tp_lhr']; ?>
			</td>
		</tr>

		<tr>
			<td>
				Tanggal Lahir
			</td>
			<td>
				<?= date('d/m/Y', strtotime($alldata1['tgl_lhr'])); ?>
			</td>
			<td>
				<?= date('d/m/Y', strtotime($backup['tgl_lhr'])); ?>
			</td>
		</tr>
		<tr>
			<td>
				NIK
			</td>
			<td>
				<?= $alldata1['nik']; ?>
			</td>
			<td>
				<?= $backup['nik']; ?>
			</td>
		</tr>
		<tr>
			<th>
				Pekerjaan
			</th>
			<td>

			</td>
			<td>

			</td>
		</tr>
		<tr>
			<td>
				Jabatan
			</td>
			<td>
				<?= $alldata1['st_peg']; ?>
			</td>
			<td>
				<?= $backup['st_peg']; ?>
			</td>
		</tr>
		<tr>
			<td>
				NPK
			</td>
			<td>
				<?= $alldata1['npk']; ?>
			</td>
			<td>
				<?= $backup['npk']; ?>
			</td>
		</tr>
		<tr>
			<td>
				Tanggal Masuk
			</td>
			<td>
				<?= date('d/m/Y', strtotime($alldata1['tgl_mb'])); ?>
			</td>
			<td>
				<?= date('d/m/Y', strtotime($backup['tgl_mb'])); ?>
			</td>
		</tr>
		<tr>
			<td>
				Golongan
			</td>
			<td>
				<?= $alldata1['golongan']; ?>
			</td>
			<td>
				<?= $backup['golongan']; ?>
			</td>
		</tr>
		<tr>
			<td>
				Gaji Pokok
			</td>
			<td>
				<?= $alldata1['phdp']; ?>
			</td>
			<td>
				<?= $backup['phdp']; ?>
			</td>
		</tr>
		<tr>
			<td>
				SK Terakhir
			</td>
			<td>
				<?= $alldata1['nskst']; ?>
			</td>
			<td>
				<?= $backup['nskst']; ?>
		</tr>
		<tr>
			<th>
				Alamat
			</th>
			<td>

			</td>
			<td>

			</td>
		</tr>
		<tr>
			<td>
				Alamat
			</td>
			<td>
				<?= $alldata1['almt']; ?>
			</td>
			<td>
				<?= $backup['almt']; ?>
		</tr>
		<tr>
			<td>
				RT/RW
			</td>
			<td>
				<?= $alldata1['rt_rw']; ?>
			</td>
			<td>
				<?= $backup['rt_rw']; ?>
		</tr>
		<tr>
			<td>
				Kelurahan
			</td>
			<td>
				<?= $alldata1['kelurahan']; ?>
			</td>
			<td>
				<?= $backup['kelurahan']; ?>
		</tr>
		<tr>
			<td>
				Kecamatan
			</td>
			<td>
				<?= $alldata1['kecamatan']; ?>
			</td>
			<td>
				<?= $backup['kecamatan']; ?>
		</tr>
		<tr>
			<td>
				Kota
			</td>
			<td>
				<?= $alldata1['kota']; ?>
			</td>
			<td>
				<?= $backup['kota']; ?>
		</tr>
		<tr>
			<td>
				Kode Pos
			</td>
			<td>
				<?= $alldata1['kodepos']; ?>
			</td>
			<td>
				<?= $backup['kodepos']; ?>
		</tr>
		<tr>
			<td>
				Nomor Telepon
			</td>
			<td>
				<?= $alldata1['phone']; ?>
			</td>
			<td>
				<?= $backup['phone']; ?>
		</tr>
	</table>


	<h3 style="text-align: center;">Data Keluarga</h3>
	<table>

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
						Status Keluarga
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
						Dokumen Pendukung
					</p>
				</th>

			</tr>
		</thead>

		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($riwayat as $r) : ?>
				<tr>
					<td> <?= $i++; ?> </td>

					<td> <?= $r['nama_aw']; ?> </td>
					<td> <?php
							if ($r['jk_aw'] == 'L') {
								echo "Laki-Laki";
							} else {
								echo "Perempuan";
							} ?>
					</td>
					<td> <?php
							if ($r['stts_kel'] == 1) {
								echo "Suami/Istri";
							} else if ($r['stts_kel'] == 2) {
								echo "Anak Kandung";
							} else if ($r['stts_kel'] == 3) {
								echo "Orang Tua";
							} else if ($r['stts_kel'] == 4) {
								echo "Pihak yang ditunjuk";
							} else {
								echo "Peserta";
							} ?>
					</td>
					<td> <?= date('d/m/Y', strtotime($r['tgl_lhr_aw'])); ?> </td>
					<td> <?= $r['stts_tanggn']; ?> </td>
					<td> <?= $r['ket']; ?> </td>
					<td> <?= $r['dok_pendukung']; ?> </td>
				</tr>
				<tr>

				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>

</body>

</html>