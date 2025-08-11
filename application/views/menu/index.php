        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<!-- Page Heading -->

        	<div class="card shadow mb-4">
        		<div class="card-header py-3">
        			<h6 class="m-0 font-weight-bold text-primary">Menu Management</h6>
        		</div>
        		<div class="card-body">
        			<div class="table-responsive">
        				<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

        				<?= $this->session->flashdata('message'); ?>

        				<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Tambah Menu Baru</a>

        				<table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
        					<thead>
        						<tr>
        							<th scope="col">#</th>
        							<th scope="col">Menu</th>
        							<th scope="col">Controller</th>
        							<th scope="col">Nomor Urut</th>
        							<th scope="col">Aksi</th>

        						</tr>
        					</thead>
        					<tbody>
        						<?php $i = 1;
								foreach ($menu as $m) : ?>
        							<tr>
        								<th scope="row"><?= $i++ ?></th>
        								<td><?= $m['menu']; ?></td>
        								<td><?= $m['controller']; ?></td>
        								<td><?= $m['no_urut']; ?></td>
        								<td>
        									<a href="" data-toggle="modal" data-target="#edit<?= $m['id']; ?>" class="badge badge-warning">edit</a>
        									<a href="<?= base_url('menu/delete_menu'); ?>/<?= $m['id']  ?>" class="badge badge-danger" onclick="konfirmasi()">hapus</a>
        								</td>
        							</tr>
        						<?php endforeach; ?>
        						<script type="text/javascript">
        							function konfirmasi() {
        								confirm('Anda Yakin?')
        							}
        						</script>
        					</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Modal -->
        <div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModal" aria-hidden="true">
        	<div class="modal-dialog modal-dialog-centered" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="newMenuModal">Tambah Menu Baru</h5>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<form action="<?= base_url('menu'); ?>" method="post">
        				<div class="modal-body">
        					<div class="form-group">
        						<input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
        					</div>
        					<div class="form-group">
        						<input type="text" class="form-control" id="ctrl" name="ctrl" placeholder="Nama Controller">
        					</div>
        					<div class="form-group">
        						<input type="number" class="form-control" id="no_urut" name="no_urut" placeholder="Nomor Urut">
        					</div>
        				</div>
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        					<button type="submit" class="btn btn-primary">Add</button>
        				</div>
        			</form>
        		</div>
        	</div>
        </div>

        <!-- Modal Edit-->
        <?php foreach ($menu as $em) : ?>
        	<div class="modal fade" id="edit<?= $em['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $em['id']; ?>" aria-hidden="true">
        		<div class="modal-dialog modal-dialog-centered" role="document">
        			<div class="modal-content">
        				<div class="modal-header">
        					<h5 class="modal-title" id="editMenuModalLabel">Edit Menu <?= $em['menu'] ?></h5>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
        				</div>
        				<form action="<?= base_url('menu/edit_menu'); ?>" method="post">
        					<div class="modal-body">
        						<div class="form-group">
        							<input type="hidden" id="id" name="id" value="<?= $em['id']; ?>">
        							<label for="menu"> Nama Menu</label>
        							<input type="text" class="form-control" id="menu" name="menu" value="<?= $em['menu']; ?>">
        						</div>
        						<div class="form-group">
        							<label for="controller">Controller</label>
        							<input type="text" class="form-control" id="controller" name="controller" value="<?= $em['controller']; ?>">
        						</div>
        						<div class="form-group">
        							<label for="no_urut">Nomor Urut</label>
        							<input type="number" class="form-control" id="no_urut" name="no_urut" value="<?= $em['no_urut']; ?>">
        						</div>
        					</div>
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        						<button type="submit" class="btn btn-primary">Simpan</button>
        					</div>
        				</form>
        			</div>
        		</div>
        	</div>
        <?php endforeach; ?>