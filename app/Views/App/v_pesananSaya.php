<?= $this->extend('App/layoutApp/master') ?>

<?= $this->section('main-content') ?>
<!-- Start Hero Section -->
<div class="container">
  <div class="row justify-content-between">
    <div class="col-lg-5">
      <div class="intro-excerpt">
        <h1 class="fw-bold mt-5"><?= $title; ?></h1>
      </div>
    </div>
  </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section" style="margin-top: -50px;">
  <div class="container">
    <div class="row mb-5">
      <form class="col-md-12" method="post">
        <div class="site-blocks-table">
          <table class="table">
            <thead>
              <tr>
                <th class="product-thumbnail">Gambar</th>
                <th class="product-name">Produk</th>
                <th class="product-price">Harga</th>
                <th class="product-quantity">Jumlah</th>
                <th class="product-total">Total</th>
                <th class="product-total">Status</th>
                <th class="product-remove">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php
              foreach ($pesananUser as $pesanans) {
              ?>
                <tr>
                  <td class="product-thumbnail">
                    <img src="<?= base_url() ?>/image/<?= (isset($pesanans->tanggal_mulai) ? 'jasa' : 'barang'); ?>/<?= (isset($pesanans->jasaGambar) ? $pesanans->jasaGambar : $pesanans->barangGambar); ?>" alt="Image" class="img-fluid" />
                  </td>
                  <td class="product-name">
                    <h2 class="h5 text-black"><?= isset($pesanans->barangNama) ? $pesanans->barangNama : $pesanans->jasaNama; ?></h2>
                  </td>
                  <td>Rp <?= isset($pesanans->barangHarga) ? number_format($pesanans->barangHarga, 0, ',', '.')  : number_format($pesanans->jasaHarga, 0, ',', '.'); ?></td>
                  <td><?= $pesanans->jumlah; ?></td>
                  <td>Rp <?= number_format($pesanans->total, 0, ',', '.'); ?></td>
                  <td><span class="fw-bold text-<?= ($pesanans->validasi == '0') ? 'danger' : 'success'; ?>"><?= ($pesanans->validasi == '0') ? 'Belum Tervalidasi' : 'Sudah Tervalidasi'; ?></span> </td>
                  <td>
                    <a href="<?= base_url('app/shop/detailPesanan?id=' . $pesanans->slug); ?>" class="btn btn-sm">Detail Pesanan</a>
                    <?php
                    if ($pesanans->validasi == '1') { ?>
                      <a target="_blank" href="<?= base_url('app/shop/cetakInvoice?id=' . $pesanans->slug); ?>" class="btn btn-sm">Cetak Invoice</a>
                    <?php } else if ($pesanans->pembayaran == '') {
                      $produkSlug = isset($pesanans->barangSlug) ? $pesanans->barangSlug : $pesanans->jasaSlug; ?>
                      <a href="<?= base_url('app/shop/pembayaran?id=' . $pesanans->slug . '&produk=' . $produkSlug); ?>" class="btn btn-sm">Pembayaran</a>
                    <?php } ?>
                  </td>
                </tr>
              <?php }
              ?>

            </tbody>
          </table>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row mb-5">
          <div class="col-md-6 mb-3 mb-md-0">
            <a href="<?= base_url('app/home'); ?>" class="btn btn-black btn-sm btn-block">Kembali</a>
          </div>
          <div class="col-md-6">
            <a href="<?= base_url('app/shop/produk'); ?>" class="btn btn-outline-black btn-sm btn-block">Beli Lagi</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>