  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
              </div>
              <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                  <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="npk" name="npk" placeholder="NPK" value="<?= set_value('npk'); ?>">
                  <?= form_error('npk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- <div class="form-group">
                <select id="role" name="role" class="form-control" required>
                  <?php foreach ($role as $r) : ?>
                    <option value="<?= set_value('role'); ?>">
                      <?= $r['role']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                </div> -->

                <div class="form-group ml-2" style="font-size: 14px;">
                  <?php foreach ($role as $r) : ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="role" name="role" value="<?= $r['id']; ?>" required>
                      <label class="form-check-label" for="role"><?= $r['role']; ?></label>
                    </div>
                  <?php endforeach; ?>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password" value="<?= set_value('password1'); ?>">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password" value="<?= set_value('password2'); ?>">
                  </div>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftar Akun
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
              </div>
              <div class="text-center">
                <a class="small"> Sudah punya akun? </a><a class="small" href="<?= base_url(); ?>auth"> Login!</a>
              </div>
              <br>
              <div class="text-center">
                <small style="font-size: 11px">DPK BPJamsostek &copy; <?= date('Y'); ?></small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>