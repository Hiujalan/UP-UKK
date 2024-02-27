<?= $this->extend('Page/layoutLogin/master') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
  <div class="row m-0">
    <div class="col-12 p-0">
      <div class="login-card">
        <div>

          <div class="login-main">
            <form class="theme-form" method="POST" action="<?= base_url('login/register'); ?>">
              <div class="row">
                <div class="col-xl-9">
                  <h4>Register</h4>
                  <p>Masukkan Data yang diperlukan</p>
                </div>
                <div class="col-xl-3">
                  <a class="text-end" href="<?= base_url("/") ?>">
                    <img class="img-fluid for-light" src="<?= base_url() ?>/assets/images/logo/logo_smkn.png" alt="looginpage" width="70" style="margin-top: -10px;">
                  </a>
                </div>
              </div>
              <div class="form-group">
                <label class="col-form-label pt-0">Username</label>
                <input class="form-control" name="nama" type="text" placeholder="Masukkan Username">
                <?php if (!empty($errors) && is_null(old('nama'))) : ?>
                  <div class="invalid-feedback">
                    <?= $errors['nama']; ?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label class="col-form-label pt-0">Nomor Telephone</label>
                <input class="form-control" name="telephone" type="text" required="" placeholder="Masukkan Nomor Telephone">
              </div>
              <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <input class="form-control" name="email" type="email" required="" placeholder="Test@gmail.com">
              </div>
              <div class="form-group">
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                  <input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
                  <div class="show-hide"><span class="show"></span></div>
                </div>
              </div>
              <div class="form-group mb-0 mt-5">
                <button class="btn btn-primary btn-block w-100" type="submit">Selanjutnya</button>
              </div>
              <p class="mt-4 mb-0">Sudah punya akun?<a class="ms-2" href="<?= base_url('/'); ?>">Masuk</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>