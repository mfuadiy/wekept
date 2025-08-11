  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Halaman Masuk<img src="assets/img/logo/dapen.jpg" style="width: 30%;height: auto;"></h1>

                  </div>

                  <?= $this->session->flashdata('message'); ?>

                  <form class="user" method="post" action="<?= base_url('auth'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('auth/forgotpassword');?>">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small">Belum punya akun?</a> <a class="small" href="<?= base_url('auth/registration');?>">Buat Akun!</a>
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

    </div>

  </div>

  