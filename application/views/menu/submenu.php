        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<!-- Page Heading -->
        	<div class="row">
        		<div class="col-lg">


        			<div class="card shadow mb-4">
        				<div class="card-header py-3">
        					<h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        				</div>
        				<div class="card-body">
        					<div class="table-responsive">
        						<?php if (validation_errors()) : ?>
        							<div class="alert alert-danger" role="alert">
        								<?= validation_errors(); ?>
        							</div>
        						<?php endif; ?>

        						<?= $this->session->flashdata('message'); ?>

        						<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Submenu</a>
        						<table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
        							<thead>
        								<tr>
        									<th scope="col">#</th>
        									<th scope="col">Judul</th>
        									<th scope="col">Menu</th>
        									<th scope="col">Url</th>
        									<th scope="col">Icon</th>
        									<th scope="col">Status</th>
        									<th scope="col">Aksi</th>
        								</tr>
        							</thead>
        							<tbody>
        								<?php $i = 1;
										foreach ($subMenu as $sm) : ?>
        									<tr>
        										<th scope="row"><?= $i++ ?></th>
        										<td><?= $sm['title']; ?></td>
        										<td><?= $sm['menu']; ?></td>
        										<td><?= $sm['url']; ?></td>
        										<td><?= $sm['icon']; ?></td>
        										<td><?= $sm['is_active']; ?></td>
        										<td>
        											<a href="" data-toggle="modal" data-target="#edit<?= $sm['id']; ?>" class="badge badge-warning">edit</a>
        											<a href="" class="badge badge-danger">hapus</a>
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

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



        <!-- Modal -->
        <div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModal" aria-hidden="true">
        	<div class="modal-dialog modal-dialog-centered" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="newSubMenuModal">Add New Submenu</h5>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<form action="<?= base_url('menu/submenu'); ?>" method="post">
        				<div class="modal-body">
        					<div class="form-group">
        						<input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
        					</div>
        					<div class="form-group">
        						<select name="menu_id" id="menu_id" class="form-control">
        							<option value="">Select Menu</option>
        							<?php foreach ($menu as $m) : ?>
        								<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
        							<?php endforeach; ?>

        						</select>
        					</div>
        					<div class="form-group">
        						<input type="text" class="form-control" id="url" name="url" placeholder="Submenu URL">
        					</div>
        					<div class="form-group">
        						<input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu Icon">
        					</div>
        					<div class="form-group">
        						<div class="form-check">
        							<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
        							<label class="form-check-label" for="is_active">
        								Active?
        							</label>
        						</div>
        					</div>
        				</div>
        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        					<button type="submit" class="btn btn-primary">Tambah</button>
        				</div>
        			</form>
        		</div>
        	</div>
        </div>

        <!-- Modal Edit-->
        <?php foreach ($subMenu as $sm1) : ?>
        	<div class="modal fade" id="edit<?= $sm1['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $sm1['id']; ?>" aria-hidden="true">
        		<div class="modal-dialog modal-dialog-centered" role="document">
        			<div class="modal-content">
        				<div class="modal-header">
        					<h5 class="modal-title" id="edit<?= $sm1['id']; ?>">Edit Sub-Menu <?= $sm1['title']; ?></h5>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
        				</div>
        				<form action="<?= base_url('menu/update_submenu'); ?>" method="post">
        					<div class="modal-body">
        						<input type="text" class="form-control" id="id" name="id" value="<?= $sm1['id']; ?>" hidden>
        						<div class="form-group">
        							<span>Title</span>
        							<input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title" value="<?= $sm1['title']; ?>">
        						</div>
        						<div class="form-group">
        							<span>Menu</span>
        							<select name="menu_id" id="menu_id" class="form-control">
        								<?php foreach ($menu as $m) : ?>
        									<option value="<?= $m['id']; ?>" <?php if ($m['id'] == $sm1['menu_id']) {
																					echo "selected";
																				} ?>><?= $m['menu']; ?></option>
        								<?php endforeach; ?>

        							</select>
        						</div>
        						<div class="form-group">
        							<span>URL</span>
        							<input type="text" class="form-control" id="url" name="url" placeholder="Submenu URL" value="<?= $sm1['url']; ?>">
        						</div>
        						<div class="form-group">
        							<span>Icon</span>
        							<input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu Icon" value="<?= $sm1['icon']; ?>">
        						</div>
        						<div class="form-group">
        							<div class="form-check">
        								<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if ($sm1['is_active'] == '1') {
																																		echo "checked";
																																	} ?>>
        								<label class="form-check-label" for="is_active">
        									Active?
        								</label>
        							</div>
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