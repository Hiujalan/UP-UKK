<?= $this->extend('App/layoutApp/master') ?>

<?= $this->section('main-content') ?>
<!-- Start Hero Section -->




<!-- Start Why Choose Us Section -->
<div class="why-choose-section mt-5">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6">
        <h2 class="section-title fw-bold"><?= $barangData['nama']; ?></h2>
        <h4 class="section-title">Rp <?= number_format($barangData['harga'], 0, ',', '.'); ?>/<?= $barangData['satuan']; ?></h4>
        <p><?= $barangData['deskripsi']; ?></p>

        <div class="row my-5">
          <p class="fw-bold">Promo</p>
          <?php isset($barangData['spesifikasi']) ? $spek = json_decode($barangData['spesifikasi']) : $spek = '' ?>
          <?php if (isset($barangData['spesifikasi'])) { ?>
            <?php foreach ($spek as $s) { ?>
              <div class="col-6 col-md-6">
                <div class="feature">
                  <!-- <div class="icon">
                <img src="<?= base_url() ?>/assetsApp/images/truck.svg" alt="Image" class="imf-fluid" />
              </div> -->
                  <h3><?= $s; ?></h3>
                  <!-- <p>Nikmati kemudahan belanja dengan cepat dan gratis ongkir, hanya untuk Anda!</p> -->
                </div>
              </div>
            <?php }
          } else { ?>
            <p>Tidak Ada Promo</p>
          <?php } ?>

          <!-- <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="<?= base_url() ?>/assetsApp/images/bag.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>Kemudahan untuk Membeli</h3>
              <p>Membeli menjadi lebih mudah dengan layanan online yang cepat dan praktis.</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="<?= base_url() ?>/assetsApp/images/support.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>Bantuan 24/7</h3>
              <p>Bantuan 24/7 siap membantu Anda kapan pun dibutuhkan.</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="<?= base_url() ?>/assetsApp/images/return.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>Barang Bisa Kembali</h3>
              <p>Barang bisa kembali memberikan jaminan kepuasan dengan kebijakan fleksibel yang memudahkan konsumen.</p>
            </div>
          </div> -->
        </div>
        <div class="col-md-4">
          <a href="#modalPesan-<?= $barangData['slug']; ?>" data-bs-toggle="modal" class="btn btn-black">Pesan</a>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="img-wrap">
          <img src="<?= base_url('image/barang/' . $barangData['gambar']); ?>" alt="Image" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Why Choose Us Section -->

<!-- Modal -->
<div class="modal fade" id="modalPesan-<?= $barangData['slug']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('app/shop/addjumlahPesanan?id=' . $barangData['slug']); ?>" method="post">
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <h3 class="section-title fw-bold mt-3"><?= $barangData['nama']; ?></h3>
              <h5 class="section-title">Rp.<?= $barangData['harga']; ?>/<?= $barangData['satuan']; ?></h5>
              <hr>
              <p>Detail Produk</p>
              <p><?= $barangData['deskripsi']; ?></p>
              <hr>
              <label for="exampleInputEmail1" class="form-label fw-bold">Jumlah</label>
              <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 200px">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                </div>
                <input type="number" max="<?= $barangData['stok']; ?>" name="jumlah" id="jumlah" class="form-control text-center quantity-amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                <div class="input-group-append">
                  <button class="btn btn-outline-black increase" type="button">&plus;</button>
                </div>
              </div>
              <p id="info-stok" class="text-danger">Jumlah Melebihi Stok Barang</p>
            </div>
            <div class="col-5">
              <div class="img-warp">
                <img src="<?= base_url('image/barang/' . $barangData['gambar']); ?>" alt="Image" class="img-fluid" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Selanjutnya</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#info-stok').hide();
    $('.increase').on('click', function() {
      var maxVal = parseInt($('#jumlah').attr('max'));
      var val = parseInt($('#jumlah').val());
      if (val >= maxVal) {
        $('.increase').hide();
        $('#info-stok').show();
      } else {
        $('.increase').show();
      }
    });
    $('.decrease').on('click', function() {
      $('.increase').show();
      $('#info-stok').hide();
    });
  });
</script>


<?= $this->endSection() ?>