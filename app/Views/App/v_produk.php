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

<div class="untree_co-section product-section before-footer-section" style="margin-top: -50px;">
  <div class="container">
    <div class="row">
      <div class="col-sm-10 col-lg-4">
        <div class="mb-3">
          <input type="text" name="search_query" class="form-control" id="cari" placeholder="Search">
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div id="result_data"></div>
    </div>

    <div class="row mt-5 ">
      <h3 class="fw-bold mb-5 dot-yellow">Barang</h3>
      <?php foreach ($barangData as $barangs) { ?>
        <!-- Start Column 1 -->
        <div class="col-12 col-md-4 col-lg-3 mb-5">
          <a class="product-item" href="<?= base_url('app/shop/detailBarang?id=' . $barangs['slug']); ?>">
            <img src="<?= base_url('image/barang/' . $barangs['gambar']); ?>" class="img-fluid product-thumbnail" style="height: 200px;">
            <h3 class="product-title"><?= $barangs['nama']; ?></h3>
            <strong class="product-price">Rp <?= number_format($barangs['harga'], 0, ',', '.'); ?></strong>

            <span class="icon-cross">
              <img src="<?= base_url('assetsApp/images/cross.svg'); ?>" class="img-fluid">
            </span>
          </a>
        </div>
        <!-- End Column 1 -->
      <?php } ?>
    </div>
    <hr>
    <div class="row mt-5 pt-5">
      <h2 class="fw-bold mb-5">Jasa</h2>
      <?php foreach ($jasaData as $jasas) { ?>
        <!-- Start Column 1 -->
        <div class="col-12 col-md-4 col-lg-3 mb-5">
          <a class="product-item" href="<?= base_url('app/shop/detailJasa?id=' . $jasas['slug']); ?>">
            <img src="<?= base_url('image/jasa/' . $jasas['gambar']); ?>" class="img-fluid product-thumbnail" style="height: 200px;">
            <h3 class="product-title"><?= $jasas['nama']; ?></h3>
            <strong class="product-price">Rp <?= number_format($jasas['harga'], 0, ',', '.'); ?></strong>

            <span class="icon-cross">
              <img src="<?= base_url('assetsApp/images/cross.svg'); ?>" class="img-fluid">
            </span>
          </a>
        </div>
        <!-- End Column 1 -->
      <?php } ?>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  jQuery(function($) {
    $("#cari").keyup(function() {
      if ($("#cari").val().length > 2) {
        var cari = $("#cari").val();
        $.ajax({
          url: "<?php echo base_url('/app/searchProduk'); ?>",
          type: 'GET',
          data: {
            'id': cari,
          },
          beforeSend: function(s) {
            $('#result_data').html('<p class="text-center">Harap tunggu...</p>');
          },
          success: function(data) {
            $('#result_data').html(data);
          },
          failed: function(data) {
            alert('Gagal mendapatkan data');
          }
        });
      } else {
        $('#result_data').html('<p class="text-center">Data tidak ditemukan</p>');
        $('#list').show();
      }
    });
  });
</script>

<?= $this->endSection() ?>