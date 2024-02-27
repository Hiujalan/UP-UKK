<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="<?= base_url('app/home'); ?>">
            <img src="<?= base_url('image/' . $settingsData['logo']); ?>" alt="logo" width="60px">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item <?= ($title == 'Home') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= base_url('app/home'); ?>">Home</a>
                </li>
                <li class="nav-item <?= ($title == 'Produk') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('app/shop/produk'); ?>">Produk</a></li>
                <li class="nav-item <?= ($title == 'Pesanan Saya') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('app/pesananSaya'); ?>">Pesanan Saya</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><a title="Profile" class="nav-link" href="<?= base_url('app/user/profile'); ?>"><img src="<?= base_url() ?>/assetsApp/images/user.svg"></a></li>
                <li><a title="Log out" class="nav-link" href="<?= base_url('login/logout'); ?>"><i class="fa-solid fa-right-from-bracket fa-lg" style="color: white;"></i></a></li>
            </ul>
        </div>
    </div>

</nav>
<!-- End Header/Navigation -->