<?= $this->extend('App/layoutApp/master') ?>

<?= $this->section('main-content') ?>

<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-12">
        <h2 class="h3 mb-3 text-black">Your Order</h2>
        <div class="p-3 p-lg-5 border bg-white">
          <table class="table site-block-order-table mb-5">
            <thead>
              <th>Product</th>
              <th>Total</th>
            </thead>
            <tbody>
              <tr>
                <td class="align-middle"><?= $produkData['nama']; ?> <strong class="mx-2">x</strong><?= $pesananData['jumlah']; ?> </td>
                <td>Rp <?= number_format($pesananData['total'], 0, ',', '.'); ?></td>
              </tr>
              <tr>
                <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                <td class="text-black font-weight-bold"><strong>Rp <?= number_format($pesananData['total'], 0, ',', '.'); ?></strong></td>
              </tr>
            </tbody>
          </table>

          <div class="border p-3 mb-3">
            <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">List Bank</a></h3>

            <div class="collapse" id="collapsebank">
              <div class="py-2">
                <ol>
                  <?php foreach ($bankData as $banks) { ?>
                    <li><?= $banks['nama']; ?> / Nomor Rekening : <?= $banks['rekening']; ?></li>
                  <?php } ?>
                </ol>
              </div>
            </div>
          </div>

          <form action="<?= base_url('app/shop/addBuktiPembayaran?id=' . $pesananData['slug'] . '&produk=' . $produkData['slug']); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="inputGroupFile02" class="form-label">Uploud Bukti Pembayaran</label>
              <input type="file" name="bukti" class="form-control form-control-lg" id="inputGroupFile02">
            </div>

            <!-- <div class="border p-3 mb-3">
              <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebankdetail" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

              <div class="collapse" id="collapsebankdetail">
                <div class="py-2">
                  <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                </div>
              </div>
            </div>

            <div class="border p-3 mb-3">
              <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

              <div class="collapse" id="collapsecheque">
                <div class="py-2">
                  <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                </div>
              </div>
            </div>

            <div class="border p-3 mb-5">
              <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

              <div class="collapse" id="collapsepaypal">
                <div class="py-2">
                  <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                </div>
              </div>
            </div> -->

            <div class="form-group">
              <button type="submit" class="btn btn-black btn-lg py-3 btn-block mt-3">Pesan Sekarang</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Why Choose Us Section -->


<?= $this->endSection() ?>