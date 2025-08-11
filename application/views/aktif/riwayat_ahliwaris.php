<div class="container" >
<div class="row mt-3">
	

		<div class="card">
			<div class="card-header">
				    Riwayat Perubahan Data
			</div>
			<div class="card-body">


				<div style="height:300px;width:100%;border:1px solid #ccc; overflow:auto; font-size: 14px;"> 
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
							<td> <?= $r['nama_aw']; ?> </td>
							<td> <?php 
								if($r['jk_aw']=='L'){
									echo "Laki-Laki";
								} else{
									echo "Perempuan";
								} ?> 
							</td>
							<td> <?php 
									if($r['stts_kel'] == 1){
										echo "Suami/Istri";
									} else if($r['stts_kel'] == 2){
										echo "Anak Kandung";
									} else if($r['stts_kel'] == 3){
										echo "Orang Tua";
									} else if($r['stts_kel'] == 4){
										echo "Pihak yang ditunjuk";  
									} else{
										echo "Peserta"; 
									}?>
							</td>
							<td> <?=  date('d/m/Y', strtotime($r['tgl_lhr_aw'])); ?> </td>
							<td> <?= $r['stts_tanggn']; ?> </td>
							<td> <?= $r['ket']; ?> </td>
							<td> <?= $r['dok_pendukung']; ?> </td>
							<td> <?= $r['penyunting']; ?> </td>
							<td> <?php 
								date_default_timezone_set('Asia/Jakarta');
								echo date('d/m/Y H:i:s',  $r['date_created']); ?> 
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>

					</table>

									</div>


				<button type="button" class="btn btn-primary mt-4"  onclick="window.location.href = 'javascript:window.history.go(-1);';">Kembali</button>
			</div>
		</div>

	</div>
</div>

</div>
