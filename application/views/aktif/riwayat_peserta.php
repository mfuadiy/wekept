<div class="container">
<div class="row mt-3">
	<div class="col-md-12">

		<div class="card">
			<div class="card-header">
				    Riwayat Perubahan Data
			</div>
			<div class="card-body">
<!-- 
<h1 class="h3 mb-4 text-gray-800" align="center"><?= $title; ?></h1> -->

<table class="table">
				<tr>
					<th width="40%">
						<img class="img-thumbnail" src="<?php if($alldata['img'] !== ''){
							echo base_url('assets/img/profile/').$alldata['img'];
						} else {
							echo base_url('assets/img/profile/default.jpg');
						} ?>" width="155">
						  <br>

						<!-- <a href="<?= base_url(); ?>peoples" class="btn btn-success mt-3">kembali</a> -->
						<!-- <a href="<?= base_url(); ?>peoples/preview/<?= $alldata['noreg']; ?>" class="btn btn-primary mt-3">Preview</a> -->
						
					</th>

					<td>
				<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" value="<?= $alldata['nama_pes']; ?>" readonly>
				    </div>
				</div>

				<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-3 col-form-label">NPK</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" value="<?= $alldata['noreg']; ?>" readonly>
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
							    	$intervallhr= date_diff($lahir, $now);
							    	//$lamakerja	= $interval->y + round((($interval->m)/12),2);
							    	//var_dump($lamakerja);
							    	echo $intervallhr->y.' tahun ';
							    	echo $intervallhr->m.' bulan ';
							    	//echo $intervallhr->d.' hari.';
							    	
							    	?>" readonly>
				    </div>
				</div>

					</td>

				</tr>
				</table>

				<nav class="nav nav-pills nav-justified mb-4">
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_peserta/<?= $alldata['noreg']; ?>">Data Pribadi</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_peserta_pekerjaan/<?= $alldata['noreg']; ?>">Pekerjaan</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_peserta_alamat/<?= $alldata['noreg']; ?>">Alamat</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_peserta_keluarga/<?= $alldata['noreg']; ?>">Data Keluarga</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/preview_peserta/<?= $alldata['noreg']; ?>">Simpan Semua Data</a>

				  <a class="nav-link active" href="#">Riwayat Perubahan</a>
				</nav>
<!-- <button type="button" class="btn btn-success ml-3 mb-4"  onclick="window.location.href = 'javascript:window.history.go(-1);';">Kembali</button> -->
<div style="height:300px;width:100%;border:1px solid #ccc; overflow:auto; font-size: 11px;"> 
	<form action="<?= base_url(); ?>peoples/update_preview/<?= $alldata['noreg'];  ?>" method="post" enctype="multipart/form-data">
	
		
		<table class="table">

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
				    		Tanggal Penyuntingan
				    	</p>
				    </th>
				</tr>

			</thead>
			<tbody>
				<?php $i=1; ?>
				<?php foreach ($riwayat as $r) : ?>
				<tr>
					<td> <?= $i++; ?> </td>
					<td> <?= $r['nama_pes']; ?> </td>
					<td> <?= $r['jk']; ?> </td>
					<td> <?= $r['tp_lhr']; ?> </td>
					<td> <?= date('d/m/Y', strtotime($r['tgl_lhr']));?> </td>
					<td> <?= $r['nik']; ?> </td>
					<td> <?= $r['st_peg']; ?> </td>
					<td> <?= $r['noreg']; ?> </td>
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
	
</form>

</div>
</div>
</div>
</div>
</div>
</div>
