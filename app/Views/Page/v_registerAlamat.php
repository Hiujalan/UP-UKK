<?= $this->extend('Page/layoutLogin/master') ?>

<?= $this->section('css-other') ?>

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/select2.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
  <div class="row m-0">
    <div class="col-12 p-0">
      <div class="login-card">
        <div>

          <div class="login-main">
            <form class="theme-form" method="POST" action="<?= base_url('login/registerAlamat?id=' . $loginData['slug']); ?>">
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
              <div class="mb-2">
                <div class="col-form-label">Provinsi</div>
                <select name="provinsi" class="js-example-basic-single col-sm-12" required>
                  <optgroup label="Provinsi">
                    <?php foreach ($provinsiData as $provinsis) { ?>
                      <option value="<?= $provinsis['name']; ?>"><?= $provinsis['name']; ?></option>
                    <?php } ?>
                  </optgroup>
                </select>
              </div>
              <div class="mb-2">
                <div class="col-form-label">Kabupaten</div>
                <select name="kabupaten" class="js-example-basic-single col-sm-12" required>
                  <optgroup label="Kabupaten">
                    <?php foreach ($kabupatenData as $kabupatens) { ?>
                      <option value="<?= $kabupatens['name']; ?>"><?= $kabupatens['name']; ?></option>
                    <?php } ?>
                  </optgroup>
                </select>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-8">
                    <div class="col-form-label">Kecamatan</div>
                    <select name="kecamatan" class="js-example-basic-single col-sm-12" required>
                      <optgroup label="Kecamatan">
                        <?php foreach ($kecamatanData as $kecamatans) { ?>
                          <option value="<?= $kecamatans['name']; ?>"><?= $kecamatans['name']; ?></option>
                        <?php } ?>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-4">
                    <label class="col-form-label">Kode Pos</label>
                    <input class="form-control" name="kodePos" type="text" required="" placeholder="Masukkan Pos">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-form-label">Jalan</label>
                <div class="form-input position-relative">
                  <input class="form-control" name="jalan" type="text" required="" placeholder="Masukkan Jalan">
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

<?= $this->section('script-other') ?>
<script src="<?= base_url() ?>/assets/js/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>/assets/js/select2/select2-custom.js"></script>
<script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>

<?= $this->endSection() ?>