<?php
if (!empty($dt_barang)) { ?>
    <h3 class="fw-bold mb-5">Hasil Pencarian</h3>
    <?php foreach ($dt_barang as $data) { ?>
        <div class="col-12 col-md-4 col-lg-3 mb-5">
            <a class="product-item" href="<?= base_url('app/shop/detailBarang?id=' . $data->slug); ?>">
                <img src="<?= base_url('image/barang/' . $data->gambar); ?>" class="img-fluid product-thumbnail" style="height: 200px;">
                <h3 class="product-title"><?= $data->nama; ?></h3>
                <strong class="product-price">Rp <?= number_format($data->harga, 0, ',', '.'); ?></strong>

                <span class="icon-cross">
                    <img src="<?= base_url('assetsApp/images/cross.svg'); ?>" class="img-fluid">
                </span>
            </a>
        </div>
    <?php } ?>
    <hr>
<?php } elseif (!empty($dt_jasa)) { ?>
    <h3 class="fw-bold mb-5">Hasil Pencarian</h3>
    <?php foreach ($dt_jasa as $data) { ?>
        <div class="col-12 col-md-4 col-lg-3 mb-5">
            <a class="product-item" href="<?= base_url('app/shop/detailJasa?id=' . $data->slug); ?>">
                <img src="<?= base_url('image/jasa/' . $data->gambar); ?>" class="img-fluid product-thumbnail" style="height: 200px;">
                <h3 class="product-title"><?= $data->nama; ?></h3>
                <strong class="product-price">Rp <?= number_format($data->harga, 0, ',', '.'); ?></strong>

                <span class="icon-cross">
                    <img src="<?= base_url('assetsApp/images/cross.svg'); ?>" class="img-fluid">
                </span>
            </a>
        </div>
    <?php } ?>
    <hr>
<?php } else { ?>
    <div class="section text-center mt-3 mb-3">Data tidak ditemukan</div>
<?php } ?>