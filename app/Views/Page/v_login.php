<?= $this->extend('Page/layoutLogin/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-7">
            <img class="bg-img-cover bg-center" src="<?= base_url() ?>/assets/images/login/2.jpg" alt="looginpage">
        </div>
        <div class="col-xl-5 p-0 mb-0">
            <div class="login-card">
                <div>
                    <div class="login-main">
                        <form class="theme-form needs-validation" method="POST" action="<?= base_url('login'); ?>" novalidate>
                            <div class="row">
                                <div class="col-xl-9 col-sm-5">
                                    <h4>Login</h4>
                                    <p>Masukkan Username dan Password</p>
                                </div>
                                <div class="col-xl-3 col-sm-5">
                                    <a class="text-end" href="<?= base_url("/") ?>">
                                        <img class="img-fluid for-light" src="<?= base_url() ?>/assets/images/logo/logo_smkn.png" alt="looginpage" width="70" style="margin-top: -10px;">
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" id="validationCustom01">Username</label>
                                <input class="form-control" style="<?= (session()->getTempdata('errors[username]')) ? 'border: 1px solid red' : '' ?> ;" id="validationCustom01" name="nama" type="text" required="" placeholder="Masukkan Username">
                                <?php if (session()->getTempdata('errors[username]')) { ?>
                                    <div class="text-danger"><?= session()->getTempdata('errors[username]'); ?></div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" style="<?= (session()->getTempdata('errors[password]')) ? 'border: 1px solid red' : '' ?> ;" type="password" name="login[password]" required="" placeholder="*********">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                                <?php if (session()->getTempdata('errors[password]')) { ?>
                                    <div class="text-danger"><?= session()->getTempdata('errors[password]'); ?></div>
                                <?php } ?>
                            </div>
                            <div class="form-group mb-0 mt-5">
                                <button class="btn btn-primary btn-block w-100" type="submit">Masuk</button>
                            </div>

                            <p class="mt-4 mb-0 text-center">Tidak punya akun?<a class="ms-2" href="<?= base_url('login/register') ?>">Buat Akun</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

        <?= $this->endSection() ?>

        <?= $this->section('script') ?>
        <script src="<?= base_url() ?>/assets/js/form-validation-custom.js"></script>
        <script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>
        <?= $this->endSection() ?>