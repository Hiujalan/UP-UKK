<?= $this->extend('App/layoutApp/master') ?>

<?= $this->section('main-content') ?>

<!-- Start Why Choose Us Section -->
<div class="untree_co-section">
  <div class="container" style="margin-top: -70px;">
    <?php if (session()->getTempdata('edit')) { ?>
      <div class="alert alert-warning" role="alert">
        <?= session()->getTempdata('edit'); ?>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-7 mb-5 mb-md-0">
        <h2 class="h3 mb-3 text-black">Edit Profile</h2>

        <form action="<?= base_url('app/user/editProfile'); ?>" method="post">
          <div class="p-3 p-lg-5 border bg-white">
            <div class="form-group row">
              <div class="col-md-12 mb-3">
                <label for="c_state_country" class="text-black">Nama</label>
                <input type="text" class="form-control" id="c_state_country" name="nama" value="<?= $userData['nama']; ?>">
              </div>
            </div>

            <div class="form-group row mb-5">
              <div class="col-md-6">
                <label for="c_email_address" class="text-black">Email Address </label>
                <input type="text" class="form-control" id="c_email_address" name="email" value="<?= $userData['email']; ?>">
              </div>
              <div class="col-md-6">
                <label for="c_phone" class="text-black">Phone </label>
                <input type="text" class="form-control" id="c_phone" name="telp" placeholder="Phone Number" value="<?= $userData['telp']; ?>">
              </div>
            </div>

            <?php $alamat = json_decode($userData['alamat']); ?>
            <div class="form-group row">
              <div class="col-md-6">
                <label for="c_country" class="text-black">Provinsi </label>
                <select id="c_country" class="form-control" name="provinsi">
                  <option value="<?= $alamat->provinsi; ?>"><?= $alamat->provinsi; ?></option>
                  <?php foreach ($provinsiData as $provinsi) { ?>
                    <option value="<?= $provinsi['name']; ?>"><?= $provinsi['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="c_country" class="text-black">Kabupaten </label>
                <select id="c_country" class="form-control" name="kabupaten">
                  <option value="<?= $alamat->kabupaten; ?>"><?= $alamat->kabupaten; ?></option>
                  <?php foreach ($kabupatenData as $kabupaten) { ?>
                    <option value="<?= $kabupaten['name']; ?>"><?= $kabupaten['name']; ?></option>
                  <?php } ?>
                </select>
              </div>

            </div>
            <div class="form-group row">
              <div class="col-md-8">
                <label for="c_fname" class="text-black">Kecamatan </label>
                <select id="c_country" class="form-control" name="kecamatan">
                  <option value="<?= $alamat->kecamatan; ?>"><?= $alamat->kecamatan; ?></option>
                  <?php foreach ($kecamatanData as $kecamatan) { ?>
                    <option value="<?= $kecamatan['name']; ?>"><?= $kecamatan['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label for="c_lname" class="text-black">Kode Pos </label>
                <input type="text" class="form-control" id="c_lname" name="kodePos" value="<?= $alamat->kodePos; ?>">
              </div>
            </div>

            <div class="form-group row mb-5">
              <div class="col-md-12">
                <label for="c_companyname" class="text-black">Jalan </label>
                <input type="text" class="form-control" id="c_companyname" name="jalan" value="<?= $alamat->jalan; ?>">
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-black py-3 btn-block">Simpan</button>
            </div>

          </div>
        </form>
      </div>
      <div class="col-md-5">

        <!-- <div class="row mb-5">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Pesanan</h2>
            <div class="p-3 p-lg-5 border bg-white">
              <table class="table site-block-order-table mb-5">
                <thead>
                  <th>Produk</th>
                  <th>Total</th>
                </thead>
                <tbody>
                  <tr>
                    <td><strong class="mx-2">x</strong> </td>
                    <td>Rp.</td>
                  </tr>
                  <tr>
                    <td>Validasi</td>
                    <td class="text-danger fw-bold"></td>
                  </tr>
                  <tr>
                    <td class="text-black font-weight-bold"><strong>Total Order</strong></td>
                    <td class="text-black font-weight-bold"><strong>Rp.</strong></td>
                  </tr>
                </tbody>
              </table>


            </div>
          </div>
        </div> -->

      </div>
    </div>
    <!-- </form> -->
  </div>
</div>
<!-- End Why Choose Us Section -->


<?= $this->endSection() ?>