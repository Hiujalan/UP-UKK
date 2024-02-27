<?= $this->extend('App/layoutApp/master') ?>

<?= $this->section('main-content') ?>

<!-- Start Why Choose Us Section -->
<div class="why-choose-section mt-5">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6">
        <h2 class="section-title fw-bold"><?= $jasaData['nama']; ?></h2>
        <h4 class="section-title">Rp <?= number_format($jasaData['harga'], 0, ',', '.'); ?>/<?= $jasaData['satuan']; ?></h4>
        <p><?= $jasaData['deskripsi']; ?></p>

        <div class="row my-5">
          <p class="fw-bold">Fasilitas</p>
          <?php isset($jasaData['spesifikasi']) ? $spek = json_decode($jasaData['spesifikasi']) : $spek = '' ?>
          <?php if (isset($jasaData['spesifikasi'])) { ?>
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
              <h3>Easy to Shop</h3>
              <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="<?= base_url() ?>/assetsApp/images/support.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>24/7 Support</h3>
              <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="<?= base_url() ?>/assetsApp/images/return.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>Hassle Free Returns</h3>
              <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
            </div>
          </div> -->
        </div>
        <div class="col-md-4">
          <a href="#modalPesan-<?= $jasaData['slug']; ?>" data-bs-toggle="modal" class="btn btn-black">Pesan</a>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="img-wrap">
          <img src="<?= base_url('image/jasa/' . $jasaData['gambar']); ?>" alt="Image" class="img-fluid" />
        </div>
      </div>

      <!-- <div class="col-lg-12">
        <div class="cal-modal-container">
          <div class="cal-modal">
            <h3>UPCOMING EVENTS</h3>
            <div id="calendar">
              <div class="placeholder"></div>
              <div class="calendar-events">
              </div>
            </div>
          </div>
        </div>
      </div> -->

    </div>
  </div>
</div>
<!-- End Why Choose Us Section -->

<!-- Modal -->
<div class="modal fade" id="modalPesan-<?= $jasaData['slug']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('app/shop/addjumlahPesanan?id=' . $jasaData['slug']); ?>" method="post">
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <h3 class="section-title fw-bold mt-3"><?= $jasaData['nama']; ?></h3>
              <h5 class="section-title">Rp.<?= $jasaData['harga']; ?>/<?= $jasaData['satuan']; ?></h5>
              <hr>
              <p>Detail Produk</p>
              <p><?= $jasaData['deskripsi']; ?></p>
              <hr>
              <label for="exampleInputEmail1" class="form-label fw-bold">Jumlah Hari</label>
              <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 200px">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                </div>
                <input type="text" name="jumlah" class="form-control text-center quantity-amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                <div class="input-group-append">
                  <button class="btn btn-outline-black increase" type="button">&plus;</button>
                </div>
              </div>
              <label for="exampleInputEmail1" class="form-label fw-bold">Tanggal Mulai Sewa</label>
              <div class="mb-3">
                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" placeholder="Tanggal Mulai Sewa">
              </div>
            </div>
            <div class="col-5">
              <div class="img-warp">
                <img src="<?= base_url('image/jasa/' . $jasaData['gambar']); ?>" alt="Image" class="img-fluid" />
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

<script>
  let day3 = formatDate(new Date(new Date().setDate(new Date().getDate() + 0)));
  eventDates[day3] = ["Annual Training Camp-II has been conducted in the campus"];
  let day2 = formatDate(new Date(new Date().setDate(new Date().getDate() + 10)));
  eventDates[day2] = ["End of Annual Training Camp-II"];

  // set maxDates
  var maxDate = {
    1: new Date(new Date().setMonth(new Date().getMonth() + 11)),
    2: new Date(new Date().setMonth(new Date().getMonth() + 10)),
    3: new Date(new Date().setMonth(new Date().getMonth() + 9)),
  };

  var flatpickr = $("#calendar .placeholder").flatpickr({
    inline: true,
    minDate: "today",
    maxDate: maxDate[3],
    showMonths: 1,
    enable: Object.keys(eventDates),
    disableMobile: "true",
    onChange: function(date, str, inst) {
      var contents = "";
      if (date.length) {
        for (i = 0; i < eventDates[str].length; i++) {
          contents += '<div class="event"><div class="date">' + flatpickr.formatDate(date[0], "l J F") + '</div><div class="location">' + eventDates[str][i] + "</div></div>";
        }
      }
      $("#calendar .calendar-events").html(contents);
    },
    locale: {
      weekdays: {
        shorthand: ["S", "M", "T", "W", "T", "F", "S"],
        longhand: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      },
    },
  });

  eventCaledarResize($(window));
  $(window).on("resize", function() {
    eventCaledarResize($(this));
  });

  function eventCaledarResize($el) {
    var width = $el.width();
    if (flatpickr.selectedDates.length) {
      flatpickr.clear();
    }
    if (width >= 992 && flatpickr.config.showMonths !== 3) {
      flatpickr.set("showMonths", 3);
      flatpickr.set("maxDate", maxDate[3]);
    }
    if (width < 992 && width >= 768 && flatpickr.config.showMonths !== 2) {
      flatpickr.set("showMonths", 2);
      flatpickr.set("maxDate", maxDate[2]);
    }
    if (width < 768 && flatpickr.config.showMonths !== 1) {
      flatpickr.set("showMonths", 1);
      flatpickr.set("maxDate", maxDate[1]);
      $(".flatpickr-calendar").css("width", "");
    }
  }

  function formatDate(date) {
    let d = date.getDate();
    let m = date.getMonth() + 1; //Month from 0 to 11
    let y = date.getFullYear();
    return "" + y + "-" + (m <= 9 ? "0" + m : m) + "-" + (d <= 9 ? "0" + d : d);
  }
</script>

<?= $this->endSection() ?>