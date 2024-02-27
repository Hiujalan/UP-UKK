<?= $this->extend('App/layoutApp/master') ?>

<?= $this->section('main-content') ?>

<!-- Start Why Choose Us Section -->
<div class="untree_co-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7 mb-5 mb-md-0">
        <h2 class="h3 mb-3 text-black">Alamat</h2>
        <div class="p-3 p-lg-5 border bg-white">
          <div class="form-group row">
            <div class="col-md-12">
              <label for="c_state_country" class="text-black">Nama</label>
              <input type="text" class="form-control" id="c_state_country" name="c_state_country" value="<?= $pesananData[0]->userNama; ?>" disabled>
            </div>
          </div>

          <div class="form-group row mb-5">
            <div class="col-md-6">
              <label for="c_email_address" class="text-black">Email Address </label>
              <input type="text" class="form-control" id="c_email_address" name="c_email_address" value="<?= $pesananData[0]->userEmail; ?>" disabled>
            </div>
            <div class="col-md-6">
              <label for="c_phone" class="text-black">Phone </label>
              <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?= $pesananData[0]->userTelp; ?>" disabled>
            </div>
          </div>

          <?php $alamat = json_decode($pesananData[0]->userAlamat) ?>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="c_country" class="text-black">Provinsi </label>
              <input type="text" class="form-control" id="c_fname" name="c_fname" value="<?= $alamat->provinsi; ?>" disabled>
            </div>
            <div class="col-md-6">
              <label for="c_country" class="text-black">Kabupaten </label>
              <input type="text" class="form-control" id="c_fname" name="c_fname" value="<?= $alamat->kabupaten; ?>" disabled>
            </div>
            <!-- <select id="c_country" class="form-control">
              <option value="1">Select a country</option>
              <option value="2">bangladesh</option>
              <option value="3">Algeria</option>
              <option value="4">Afghanistan</option>
              <option value="5">Ghana</option>
              <option value="6">Albania</option>
              <option value="7">Bahrain</option>
              <option value="8">Colombia</option>
              <option value="9">Dominican Republic</option>
            </select> -->
          </div>
          <div class="form-group row">
            <div class="col-md-8">
              <label for="c_fname" class="text-black">Kecamatan </label>
              <input type="text" class="form-control" id="c_fname" name="c_fname" value="<?= $alamat->kecamatan; ?>" disabled>
            </div>
            <div class="col-md-4">
              <label for="c_lname" class="text-black">Kode Pos </label>
              <input type="text" class="form-control" id="c_lname" name="c_lname" value="<?= $alamat->kodePos; ?>" disabled>
            </div>
          </div>

          <div class="form-group row mb-5">
            <div class="col-md-12">
              <label for="c_companyname" class="text-black">Jalan </label>
              <input type="text" class="form-control" id="c_companyname" name="c_companyname" value="<?= $alamat->jalan; ?>" disabled>
            </div>
          </div>

          <div class="form-group">
            <a href="<?= base_url('app/pesananSaya'); ?>" class="btn btn-black py-3 btn-block">Kembali</a>
          </div>

        </div>
      </div>
      <div class="col-md-5">

        <div class="row mb-5">
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
                    <td><?= isset($pesananData[0]->barangNama) ? $pesananData[0]->barangNama : $pesananData[0]->jasaNama; ?> <strong class="mx-2">x</strong> <?= $pesananData[0]->pesananJumlah; ?></td>
                    <td>Rp <?= number_format($pesananData[0]->pesananTotal, 0, ',', '.'); ?></td>
                  </tr>
                  <tr>
                    <td>Validasi</td>
                    <td class="text-<?= ($pesananData[0]->pesananValidasi == '1') ? 'success' : 'danger'; ?> fw-bold"><?= ($pesananData[0]->pesananValidasi == '1') ? 'Tervalidasi' : 'Belum Tervalidasi'; ?></td>
                  </tr>
                  <tr>
                    <td class="text-black font-weight-bold"><strong>Total Order</strong></td>
                    <td class="text-black font-weight-bold"><strong>Rp <?= number_format($pesananData[0]->pesananTotal, 0, ',', '.'); ?></strong></td>
                  </tr>
                </tbody>
              </table>

              <?php if (isset($pesananData[0]->pesananPembayaran)) { ?>
                <div class="border p-3 mb-3">
                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Bukti Pembayaran</a></h3>

                  <div class="collapse" id="collapsebank">
                    <div class="py-2">
                      <img src="<?= base_url() ?>/image/buktiPembayaran/<?= $pesananData[0]->pesananPembayaran; ?>" alt="Image" class="img-fluid" />
                    </div>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- </form> -->
  </div>
</div>
<!-- End Why Choose Us Section -->


<?= $this->endSection() ?>