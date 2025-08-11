
<div class="container">
<div class="row mt-3">
	<div class="col-md-12">

	<div class="card">
			<div class="card-header">
				   <a href="<?= base_url(); ?>peoples" class="fas fa-arrow-circle-left"></a> Preview
			</div>
			<div class="card-body">

				<table class="table">
				<tr>
					<th width="40%">
						<img class="img-thumbnail" src="<?php if($alldata['img'] !== ''){
							echo base_url('assets/img/profile/').$alldata['img'];
						} else {
							echo base_url('assets/img/profile/default.jpg');
						} ?>" width="155">
						<br>
						

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

				<!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  					<li class="nav-item">
    					<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Data Pribadi</a>
  					</li>
			  		<li class="nav-item">
			    		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pekerjaan</a>
			  		</li>
			  		<li class="nav-item">
			    		<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Alamat</a>
			  		</li>
			  		<li class="nav-item">
			    		<a class="nav-link" id="pills-keluarga-tab" data-toggle="pill" href="#pills-keluarga" role="tab" aria-controls="pills-keluarga" aria-selected="false">Data Keluarga</a>
			  		</li>
			  		<li class="nav-item">
			    		<a class="nav-link" id="pills-pensiun-tab" data-toggle="pill" href="#pills-pensiun" role="tab" aria-controls="pills-pensiun" aria-selected="false">Simulasi Manfaat Pensiun</a>
			  		</li>
				</ul> -->

				<nav class="nav nav-pills nav-justified mb-4">
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail/<?= $alldata['noreg']; ?>">Data Pribadi</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_pekerjaan/<?= $alldata['noreg']; ?>">Pekerjaan</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_alamat/<?= $alldata['noreg']; ?>">Alamat</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_keluarga/<?= $alldata['noreg']; ?>">Data Keluarga</a>
				  <a class="nav-link active" href="#">Simpan Semua Data</a>

				  <a class="nav-link" href="<?= base_url(); ?>peoples/detail_simulasi/<?= $alldata['noreg']; ?>">Simulasi Pensiun</a>
				  <a class="nav-link" href="<?= base_url(); ?>peoples/riwayat/<?= $alldata['noreg']; ?>">Riwayat Perubahan</a>
				</nav>


				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-savedata" role="tabpanel" aria-labelledby="pills-savedata-tab">

	<form action="<?= base_url(); ?>peoples/update_preview/<?= $alldata['noreg'];  ?>" method="post" enctype="multipart/form-data">
	<div class="col-md-12">
		
		<table class="table" width="100%">

			<thead>

				<tr>
					<th>
				    	<p class="card-text">
				    		Keterangan
				    	</p>
				    </th>

				    <th>
				    	<p class="card-text">
				    		Data Lama
				    	</p>
				    </th>

				    <th>
				    	<p class="card-text ml-3">
				    		Data Baru
				    	</p>
				    </th>
				</tr>

			</thead>
			<tbody>

				<tr>
					<th>
				    	<p class="card-text">
				    		--------------------
				    	</p>
				    </th>
				    <th>
				    	<p class="card-text">
				    		Data Pribadi
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text ml-3">
				    		--------------------
				    	</p>
				    </td>
				</tr>
				
				<tr>
					<th>
				    	<p class="card-text">
				    		Nama
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['nama_pes']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
							<input type="text" id="nama" name="nama" class="form-control" value="<?= $temp['nama_pes']; ?>" required <?php if ($temp['nama_pes'] == ''){echo "";} else{echo "readonly";} ?>>
						</div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Jenis Kelamin
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?php if ($alldata['jk'] == 'L'){
				    			echo "Laki-Laki";
				    		} else{
				    			echo "Perempuan";
				    		}?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					    	<!-- <input type="text" id="jk" name="jk" class="form-control" value="<?= $temp['jk']; ?>"> -->

					    	<select id="jk" name="jk" class="form-control" readonly>
						    <?php foreach ($jk as $j) : ?>
						        <option value="<?= $j['id']; ?>" <?php if($temp['jk'] == $j['id']){ echo "selected";} ?>>
						          <?= $j['jk']; ?>
						        </option>
						    <?php endforeach; ?>
						    </select>

					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Agama
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?php if($alldata['agama'] == 1){
				    			echo "Islam";
				    		}elseif($alldata['agama'] == 2){
				    			echo "Kristen";
				    		}elseif($alldata['agama'] == 3){
				    			echo "Katolik";
				    		}elseif($alldata['agama'] == 4){
				    			echo "Hindu";
				    		}elseif($alldata['agama'] == 5){
				    			echo "Budha";
				    		}elseif($alldata['agama'] == 6){
				    			echo "Lain-lain";
				    		} ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					    	<select id="agama" name="agama" class="form-control" readonly>
						    <?php foreach ($agama as $ag) : ?>
						        <option value="<?= $ag['id']; ?>" <?php if($temp['agama'] == $ag['id']){ echo "selected";} ?>>
						          <?= $ag['agama']; ?>
						        </option>
						    <?php endforeach; ?>
						    </select>

					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Tempat Lahir
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['tp_lhr']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
				      		<input type="text" id="tp_lhr" name="tp_lhr" class="form-control" value="<?= $temp['tp_lhr']; ?>" required <?php if ($temp['tp_lhr'] == ''){echo "";} else{echo "readonly";} ?>>
				    	</div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Tanggal Lahir
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= date('d/m/Y', strtotime($alldata['tgl_lhr'])); ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="date" id="tgl_lhr" name="tgl_lhr" class="form-control" value="<?= $temp['tgl_lhr']; ?>" required <?php if ($temp['tgl_lhr'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		NPWP
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['npwp']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="npwp" name="npwp" class="form-control" value="<?= $temp['npwp']; ?>" required <?php if ($temp['npwp'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		NIK
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['nik']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="nik" name="nik" class="form-control" value="<?= $temp['nik']; ?>" required <?php if ($temp['nik'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		--------------------
				    	</p>
				    </th>
				    <th>
				    	<p class="card-text">
				    		Pekerjaan
				    	</p>
				    </th>
				    <th>
				    	<p class="card-text ml-3">
				    		--------------------
				    	</p>
				    </th>
				</tr>
				
				<tr>
					<th>
				    	<p class="card-text">
				    		Jabatan
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['st_peg']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="st_peg" name="st_peg" class="form-control" value="<?= $temp['st_peg']; ?>" required <?php if ($temp['st_peg'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Cabang
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['cab']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<!-- <input type="text" id="st_peg" name="st_peg" class="form-control" value="<?= $temp['st_peg']; ?>" required readonly> -->

					      	<select id="cabang" name="cabang" class="form-control" readonly>
						      <?php foreach ($cabang as $cab) : ?>
						        <option value="<?= $cab['cab']; ?>" <?php if($temp['cab'] == $cab['cab']){ echo "selected";} ?>>
						          <?= $cab['nama_cab']; ?>
						        </option>
						      <?php endforeach; ?>
						    </select>
						    
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		NPK
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['noreg']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
							<input type="text" id="noreg" name="noreg" class="form-control" value="<?= $temp['noreg']; ?>" readonly>
						</div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Tanggal Masuk
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= date('d/m/Y', strtotime($alldata['tgl_mb'])); ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="date" id="tgl_mb" name="tgl_mb" class="form-control" value="<?= $temp['tgl_mb']; ?>" required <?php if ($temp['tgl_mb'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Golongan
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['golongan']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="golongan" name="golongan" class="form-control" value="<?= $temp['golongan']; ?>" required <?php if ($temp['golongan'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Gaji Pokok
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['phdp']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="phdp" name="phdp" class="form-control" value="<?= $temp['phdp']; ?>" required <?php if ($temp['phdp'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		SK Terakhir Kenaikan Gaji Pokok/Golongan
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['nskst']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="nskst" name="nskst" class="form-control" value="<?= $temp['nskst']; ?>" required <?php if ($temp['nskst'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		--------------------
				    	</p>
				    </th>
				    <th>
				    	<p class="card-text">
				    		Alamat
				    	</p>
				    </th>
				    <th>
				    	<p class="card-text ml-3">
				    		--------------------
				    	</p>
				    </th>
				</tr>
				
				<tr>
					<th>
				    	<p class="card-text">
				    		Alamat
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['almt']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="almt" name="almt" class="form-control" value="<?= $temp['almt']; ?>" required <?php if ($temp['almt'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		RT/RW
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['rt_rw']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="rt_rw" name="rt_rw" class="form-control" value="<?= $temp['rt_rw']; ?>" required <?php if ($temp['rt_rw'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Kelurahan
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['kelurahan']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="kelurahan" name="kelurahan" class="form-control" value="<?= $temp['kelurahan']; ?>" required <?php if ($temp['kelurahan'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Kecamatan
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['kecamatan']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="kecamatan" name="kecamatan" class="form-control" value="<?= $temp['kecamatan']; ?>" required <?php if ($temp['kecamatan'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Kota
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['kota']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="kota" name="kota" class="form-control" value="<?= $temp['kota']; ?>" required <?php if ($temp['kota'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Kode Pos
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['kodepos']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="kodepos" name="kodepos" class="form-control" value="<?= $temp['kodepos']; ?>" required <?php if ($temp['kodepos'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Nomor Telepon
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['phone']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="phone" name="phone" class="form-control" value="<?= $temp['phone']; ?>" required <?php if ($temp['phone'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

				<tr>
					<th>
				    	<p class="card-text">
				    		Nomor Handphone
				    	</p>
				    </th>
				    <td>
				    	<p class="card-text">
				    		<?= $alldata['telphp']; ?>
				    	</p>
				    </td>
				    <td>
				    	<div class="col-sm-14">
					      	<input type="text" id="hp" name="hp" class="form-control" value="<?= $temp['telphp']; ?>" required <?php if ($temp['telphp'] == ''){echo "";} else{echo "readonly";} ?>>
					    </div>
				    </td>
				</tr>

			</tbody>
			
		</table>

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
				    		
				    		
				    </tr>
					</thead>
					<tbody>
					<?php foreach ($ahli_waris as $aw) : ?>
					<tr>
						<td>
							<?= $aw['nama_aw'] ?>
							
						</td>
						<td>
							<?php 
							if($aw['jk_aw'] == "P") 
							{
								echo "Perempuan";
							}
							else{echo "Laki-Laki";}
							?>
								
						</td>
						<td>
							<?php 
							if($aw['stts_kel'] == "1"){
								echo "Suami/Istri";
							}
							elseif($aw['stts_kel'] == "2"){
								echo "Anak";
							}
							elseif($aw['stts_kel'] == "3"){
								echo "Orang Tua";
							}
							elseif($aw['stts_kel'] == "4"){
								echo "Pihak Ditunjuk";
							}
							else{
								echo "Peserta";
							}
							?>
							
						</td>
						<td><?= date('d/m/Y', strtotime($aw['tgl_lhr_aw'])); ?></td>
						<td>
							<?php
							if($aw['stts_tanggn'] == "MT"){
								echo "Menjadi Tanggungan";
							}
							else{
								echo "Tidak Menjadi Tanggungan";
							}
							?>
							
						</td>
						<td><?= $aw['ket'] ?></td>
						
					</tr>
					<?php endforeach; ?>
					</tbody>
					</table>
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
	
	<button type="button" class="btn btn-success ml-3"  onclick="window.location.href = 'javascript:window.history.go(-1);';">Kembali</button>
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