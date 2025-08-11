<div class="container-fluid">
	<div class="card mt-2 col-12">
		<div class="row mt-4">
			<div class="col">
				<center>
					<h2>Daftar User</h2>
				</center>
			</div>
		</div>

		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data User</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>NPK</th>
								<th>Email</th>
								<th>Role</th>
								<th>Status</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($list_user as $ls) : ?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $ls['name']; ?></td>
									<td><?= $ls['npk']; ?></td>
									<td><?= $ls['email']; ?></td>
									<td>
										<?php
										switch ($ls['role_id']) {
											case '1':
												echo "Admin";
												break;
											case '2':
												echo "Pegawai";
												break;
											case '3':
												echo "Peserta Aktif";
												break;
											case '4':
												echo "Pensiunan";
												break;
										}
										?>
									</td>
									<td>
										<?= $ls['is_active'] == '1' ? 'Active' : 'Non-Active'; ?>
									</td>
									<td style="text-align: center;">
										<a href="" id='btnEdit' data-toggle="modal" data-target='#editUserModal' class="badge badge-warning btn-edit-user" data-id="<?= $ls['id']; ?>">Edit</a>
										<a href="#" class="badge badge-danger">Hapus</a>
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

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="editUserForm" action="<?= base_url(); ?>admin/updateuser" method="post">
					<input type="hidden" id="user_id" name="user_id">
					<div class="form-group">
						<label for="name">Nama</label>
						<input type="text" class="form-control" id="name" name="name" required>
					</div>
					<div class="form-group">
						<label for="npk">NPK</label>
						<input type="text" class="form-control" id="npk" name="npk" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="form-group">
						<label for="role_id">Role</label>
						<select class="form-control" id="role_id" name="role_id">
							<option value="1">Admin</option>
							<option value="2">Pegawai</option>
							<option value="3">Peserta Aktif</option>
							<option value="4">Pensiunan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="is_active">Status</label>
						<select class="form-control" id="is_active" name="is_active">
							<option value="1">Active</option>
							<option value="0">Non-Active</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>

<script>
	document.querySelectorAll('.btn-edit-user').forEach(function(button) {
		// Ketika tombol edit diklik
		button.addEventListener('click', function(e) {
			e.preventDefault();

			// Ambil ID user dari atribut data-id
			var userId = $(this).data('id');
			console.log('User ID yang diklik:', userId); // Log ID user untuk debugging

			// Tampilkan URL di console
			var url = '<?= base_url(); ?>admin/getUser/' + userId;
			console.log('Fetching data from URL:', url)

			// Lakukan request AJAX untuk mendapatkan data user berdasarkan ID
			$.ajax({
				url: '<?= base_url(); ?>admin/getUser/' + userId,
				method: 'GET',
				dataType: 'json',
				success: function(data) {
					// Isi form modal dengan data yang diambil dari server
					$('#user_id').val(data.id);
					$('#name').val(data.name);
					$('#npk').val(data.npk);
					$('#email').val(data.email);
					$('#role_id').val(data.role_id);
					$('#is_active').val(data.is_active);

					// Tampilkan modal edit
					$('#editUserModal').modal('show');
					console.log('Data user berhasil diambil:', data); // Log hasil yang diterima
				},
				error: function(xhr, status, error) {
					console.log('Error:', error); // Log error untuk debugging
					alert('Gagal mengambil data user.');
				}
			});
		});
	});
</script>