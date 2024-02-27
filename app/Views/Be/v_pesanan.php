<?= $this->extend('Page/layoutDashboard/master') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/datatables.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/select2.css">

<?= $this->endSection() ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3><?= $active; ?></h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
              </svg></a></li>
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active"><?= $active; ?></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
  <?= $this->include('Page/layoutDashboard/notif') ?>
  <div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header pb-0 card-no-border">
          <h3 class="float-start">Master Data <?= $active; ?></h3>
          <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah Data <i class="fa fa-plus"></i></button>
          <button class="btn btn-secondary float-end me-1" data-bs-toggle="modal" data-bs-target="#modalCetak">Cetak <i class="fa fa-file"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="display" id="basic-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Pesanan</th>
                  <th>Nama Pemesan</th>
                  <th>Nama Produk</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($pesananData as $pesanans) { ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $pesanans->pesananSlug; ?></td>
                    <td><?= $pesanans->userNama; ?></td>
                    <td><?= isset($pesanans->barangNama) ? $pesanans->barangNama : $pesanans->jasaNama; ?></td>
                    <td>Rp <?= number_format($pesanans->pesananTotal, 0, ',', '.'); ?></td>
                    <td><span class="badge badge-<?= (isset($pesanans->pesananValidasi) && $pesanans->pesananValidasi == '0' ? 'danger' : 'success'); ?> p-2"><?= (isset($pesanans->pesananValidasi) && $pesanans->pesananValidasi == '0' ? 'Belum Tervalidasi' : 'Sudah Tervalidasi'); ?></span></td>
                    <td>
                      <ul class="action">
                        <li class="info"> <a title="Info Pesanan" data-bs-toggle="modal" href="#modalInfo-<?= $pesanans->pesananSlug; ?>"><i class="icon-info"></i></a></li>
                        <?php if (!empty($pesanans->pesananPembayaran)) { ?>
                          <li class="check me-1"> <a title="Validasi" data-bs-toggle="modal" href="#modalValidasi-<?= $pesanans->pesananSlug; ?>"><i class="icon-check"></i></a></li>
                        <?php } else { ?>
                          <li class="coins me-1"> <a title="Pembayaran" data-bs-toggle="modal" href="#modalPembayaran-<?= $pesanans->pesananSlug; ?>"><i class="icofont icofont-coins"></i></a></li>
                        <?php } ?>
                        <?php if ($pesanans->pesananValidasi == '1') { ?>
                          <li class="print me-1"> <a target="_blank" title="Cetak Invoice" href="<?= base_url('be/pesanan/cetakInvoicePesanan?id=' . $pesanans->pesananSlug); ?>"><i class="icon-file"></i></a></li>
                        <?php } ?>
                        <li class="edit"> <a title="Edit Pesanan" data-bs-toggle="modal" href="#modalEdit-<?= $pesanans->pesananSlug; ?>"><i class="icon-pencil-alt"></i></a></li>
                        <li class="delete"><a title="Hapus Pesanan" data-bs-toggle="modal" href="#modalHapus-<?= $pesanans->pesananSlug; ?>"><i class="icon-trash"></i></a></li>
                      </ul>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Zero Configuration  Ends-->
  </div>
</div>

<!-- modal add -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('be/produk/createPesanan?id=' . $kodePesanan); ?>" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Kode Pesanan</label>
                <input value="<?= $kodePesanan; ?>" class="form-control" id="exampleFormControlInput1" name="kodePesanan" type="text" disabled>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Nama Pemesan</label>
                <select id="pemesan" name="namePemesan" class="js-example-basic-single col-sm-12" onchange="ambilNilai()">
                  <?php foreach ($userData as $user) {   ?>
                    <option value="<?= $user['slug']; ?>"><?= $user['nama']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-8">
              <div class="mb-2">
                <div class="col-form-label">Pilih Produk</div>
                <select id="produk" name="produk" class="js-example-basic-single col-sm-12" onchange="ambilNilai()">
                  <?php foreach ($semuaProduk as $produks) {   ?>
                    <option value="<?= $produks->slug; ?>"><?= $produks->nama; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label class="form-label" for="jumlahPesanan">Jumlah Pesanan</label>
                <input class="form-control" name="jumlahPesanan" oninput="hitungTotal()" id="jumlahPesanan" type="text">
              </div>
            </div>

            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="totalHarga">Total Harga</label>
                <input class="form-control" name="totalHarga" id="totalHarga" type="text" disabled>
              </div>
            </div>

            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Tanggal Mulai Sewa (Jika produk berupa Jasa)</label>
                <input class="form-control" name="tanggal" id="exampleFormControlInput1" type="date">
              </div>
            </div>

            <div class="col-12 mb-3">
              <div class="default-according" id="accordion1">
                <div class="card">
                  <div class="card-header bg-primary" id="headingFour">
                    <h5 class="mb-0">
                      <button type="button" class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapseAlamatUser" aria-expanded="true" aria-controls="collapseFour"><i class="icofont icofont-home"></i> Alamat Pemesan</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="collapseAlamatUser" aria-labelledby="headingOne" data-bs-parent="#accordion1">
                    <div class="card-body">
                      <div id="hasil_user"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 mb-3">
              <div class="default-according" id="accordion1">
                <div class="card">
                  <div class="card-header bg-primary" id="headingFour">
                    <h5 class="mb-0">
                      <button type="button" class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="icofont icofont-briefcase-alt-2"></i> Detail Produk</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="collapseFour" aria-labelledby="headingOne" data-bs-parent="#accordion1">
                    <div class="card-body">
                      <div id="hasil_barang"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tutup</button>
          <button class="btn btn-secondary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal cetak -->
<div class="modal fade" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Tanggal</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('be/produk/laporanPesanan'); ?>" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Tanggal Mulai</label>
                <input class="form-control" id="exampleFormControlInput1" name="tanggalMulai" type="date">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Tanggal Akhir</label>
                <input class="form-control" name="tanggalAkhir" id="exampleFormControlInput1" type="date">
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tutup</button>
          <button class="btn btn-secondary" type="submit">Selanjutnya</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal edit -->
<?php foreach ($pesananData as $pesanans) { ?>
  <div class="modal fade" id="modalInfo-<?= $pesanans->pesananSlug; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Info Data</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Kode Pesanan</label>
                <input class="form-control" value="<?= $pesanans->pesananSlug; ?>" id="exampleFormControlInput1" name="kodePesanan" type="text" disabled>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Nama Pemesan</label>
                <input class="form-control" value="<?= $pesanans->userNama; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
              </div>
            </div>

            <div class="col-8">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Total Harga</label>
                <input class="form-control" value="Rp.<?= $pesanans->pesananTotal; ?>" name="totalHarga" id="exampleFormControlInput1" type="text" disabled>
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Jumlah Pesanan</label>
                <input class="form-control" value="<?= $pesanans->pesananJumlah; ?>" name="jumlahPesanan" id="exampleFormControlInput1" type="text" disabled>
              </div>
            </div>

            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Tanggal Mulai Sewa (Jika produk berupa Jasa)</label>
                <input class="form-control" value="<?= (isset($pesanans->pesananMulai) ? $pesanans->pesananMulai : 'Produk berupa Barang'); ?>" name="jumlahPesanan" id="exampleFormControlInput1" type="text" disabled>
              </div>
            </div>

            <div class="col-6">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Validasi</label>
                <input class="form-control" value="<?= (isset($pesanans->pesananValidasi) && $pesanans->pesananValidasi == '0' ? 'Belum Tervalidasi' : 'Sudah Tervalidasi'); ?>" name="jumlahPesanan" id="exampleFormControlInput1" type="text" disabled>
              </div>
            </div>

            <div class="col-12 mb-3">
              <div class="default-according" id="accordion1">
                <div class="card">
                  <div class="card-header bg-primary" id="headingFour">
                    <h5 class="mb-0">
                      <button class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapseAlamatUser" aria-expanded="true" aria-controls="collapseFour"><i class="icofont icofont-home"></i> Alamat Pemesan</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="collapseAlamatUser" aria-labelledby="headingOne" data-bs-parent="#accordion1">
                    <div class="card-body">
                      <?php
                      $alamatUser = json_decode($pesanans->userAlamat, true);
                      ?>
                      <div class="row">
                        <div class="col-6">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Provinsi</label>
                            <input class="form-control" value="<?= $alamatUser['provinsi']; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Kabupaten</label>
                            <input class="form-control" value="<?= $alamatUser['kabupaten']; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Kecamatan</label>
                            <input class="form-control" value="<?= $alamatUser['kecamatan']; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Kode Pos</label>
                            <input class="form-control" value="<?= $alamatUser['kodePos']; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Jalan</label>
                            <input class="form-control" value="<?= $alamatUser['jalan']; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 mb-3">
              <div class="default-according" id="accordion1">
                <div class="card">
                  <div class="card-header bg-primary" id="headingFour">
                    <h5 class="mb-0">
                      <button class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="icofont icofont-briefcase-alt-2"></i> Detail Produk</button>
                    </h5>
                  </div>
                  <div class="collapse show" id="collapseFour" aria-labelledby="headingOne" data-bs-parent="#accordion1">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-8">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Nama Produk</label>
                            <input class="form-control" value="<?= isset($pesanans->barangNama) ? $pesanans->barangNama : $pesanans->jasaNama; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Satuan</label>
                            <input class="form-control" value="<?= isset($pesanans->barangSatuan) ? $pesanans->barangSatuan : $pesanans->jasaSatuan; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>
                        <div class="col-8">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Harga Per <?= isset($pesanans->barangSatuan) ? $pesanans->barangSatuan : $pesanans->jasaSatuan; ?></label>
                            <input class="form-control" value="Rp.<?= isset($pesanans->barangHarga) ? $pesanans->barangHarga : $pesanans->jasaHarga; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Stok</label>
                            <input class="form-control" value="<?= isset($pesanans->barangStok) ? $pesanans->barangStok : '1'; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Gambar</label> <br>
                            <center>
                              <img src="<?= base_url() ?>/image/<?= (isset($pesanans->pesananMulai) ? 'jasa' : 'barang'); ?>/<?= (isset($pesanans->jasaGambar) ? $pesanans->jasaGambar : $pesanans->barangGambar); ?>" alt="Image" class="img-fluid" />
                            </center>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalValidasi-<?= $pesanans->pesananSlug; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Validasi Pesanan</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('be/pesanan/validasi?id=' . $pesanans->pesananSlug); ?>" method="post">
          <div class="modal-body animate-chk">
            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Kode Pesanan</label>
                  <input class="form-control" value="<?= $pesanans->pesananSlug; ?>" id="exampleFormControlInput1" name="kodePesanan" type="text" disabled>
                </div>
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Nama Pemesan</label>
                  <input class="form-control" value="<?= $pesanans->userNama; ?>" name="namaPemesan" id="exampleFormControlInput1" type="text" disabled>
                </div>
              </div>

              <div class="col-12 mb-3">
                <label class="d-block" for="edo-ani">
                  <input class="radio_animated" id="edo-ani" value="1" type="radio" name="validasi"> Validasi
                </label>
                <label class="d-block" for="edo-ani1">
                  <input class="radio_animated" id="edo-ani1" value="0" type="radio" name="validasi"> Tidak Tervalidasi
                </label>
              </div>

              <div class="col-12 mb-3">
                <div class="default-according" id="accordion1">
                  <div class="card">
                    <div class="card-header bg-primary" id="headingFour">
                      <h5 class="mb-0">
                        <button type="button" class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapseAlamatUser" aria-expanded="true" aria-controls="collapseFour"><i class="icofont icofont-coins"></i> Pembayaran</button>
                      </h5>
                    </div>
                    <div class="collapse show" id="collapseAlamatUser" aria-labelledby="headingOne" data-bs-parent="#accordion1">
                      <div class="card-body">
                        <div class="col-12">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Gambar</label> <br>
                            <center>
                              <img src="<?= base_url() ?>/image/buktiPembayaran/<?= $pesanans->pesananPembayaran; ?>" alt="Image" class="img-fluid" />
                            </center>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tutup</button>
            <button class="btn btn-secondary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEdit-<?= $pesanans->pesananSlug; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('be/pesanan/editPesanan?id=' . $pesanans->pesananSlug); ?>" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Kode Pesanan</label>
                  <input class="form-control" value="<?= $pesanans->pesananSlug; ?>" id="exampleFormControlInput1" name="kodePesanan" type="text" disabled>
                </div>
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Nama Pemesan</label>
                  <select id="pemesanEdit" name="namePemesan" class="js-example-basic-single col-sm-12">
                    <option value="<?= $pesanans->userSlug; ?>"><?= $pesanans->userNama; ?></option>
                    <?php foreach ($userData as $user) {   ?>
                      <option value="<?= $user['slug']; ?>"><?= $user['nama']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-8">
                <div class="mb-2">
                  <div class="col-form-label">Pilih Produk</div>
                  <select id="produkEdit" name="produk" class="js-example-basic-single col-sm-12" onchange="ambilNilai()">
                    <option value="<?= isset($pesanans->barangSlug) ? $pesanans->barangSlug : $pesanans->jasaSlug; ?>"><?= isset($pesanans->barangNama) ? $pesanans->barangNama : $pesanans->jasaNama; ?></option>
                    <?php foreach ($semuaProduk as $produks) {   ?>
                      <option value="<?= $produks->slug; ?>"><?= $produks->nama; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="col-4">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Jumlah Pesanan</label>
                  <input class="form-control" oninput="hitungTotalEdit()" value="<?= $pesanans->pesananJumlah; ?>" name="jumlahPesanan" id="jumlahPesananEdit" type="text">
                </div>
              </div>

              <div class="col-6">
                <div class="mb-3">
                  <label class="form-label" for="totalHarga">Total Harga</label>
                  <input class="form-control" value="Rp.<?= $pesanans->pesananTotal; ?>" name="totalHarga" id="totalHargaEdit" type="text" disabled>
                </div>
              </div>

              <div class="col-6">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Tanggal Mulai Sewa (Jika produk berupa Jasa)</label>
                  <input class="form-control" value="<?= isset($pesanans->pesananMulai) ? $pesanans->pesananMulai : null; ?>" name="tanggal" id="exampleFormControlInput1" type="date">
                </div>
              </div>

              <div class="col-12 mb-3">
                <div class="default-according" id="accordion1">
                  <div class="card">
                    <div class="card-header bg-primary" id="headingFour">
                      <h5 class="mb-0">
                        <button type="button" class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapseAlamatUser" aria-expanded="true" aria-controls="collapseFour"><i class="icofont icofont-home"></i> Alamat Pemesan</button>
                      </h5>
                    </div>
                    <div class="collapse show" id="collapseAlamatUser" aria-labelledby="headingOne" data-bs-parent="#accordion1">
                      <div class="card-body">
                        <div id="hasil_user_edit"></div>
                        <?php $alamatUser = json_decode($pesanans->userAlamat); ?>
                        <div class="row" id="old_user_edit">
                          <div class="col-6">
                            <div class="form-label" for="exampleFormControlInput1">Provinsi</div>
                            <select name="provinsi" class="js-example-basic-single col-sm-12" required disabled>
                              <optgroup label="Provinsi">
                                <option value="<?= $alamatUser->provinsi; ?>"><?= $alamatUser->provinsi; ?></option>
                                <?php foreach ($alamat['provinsiData'] as $provinsis) { ?>
                                  <option value="<?= $provinsis['name']; ?>"><?= $provinsis['name']; ?></option>
                                <?php } ?>
                              </optgroup>
                            </select>
                          </div>
                          <div class="col-6">
                            <div class="mb-2">
                              <div class="form-label">Kabupaten</div>
                              <select name="kabupaten" class="js-example-basic-single col-sm-12" disabled>
                                <option value="<?= $alamatUser->kabupaten; ?>"><?= $alamatUser->kabupaten; ?></option>
                                <?php foreach ($alamat['kabupatenData'] as $kabupaten) {   ?>
                                  <option value="<?= $kabupaten['name']; ?>"><?= $kabupaten['name']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="exampleFormControlInput1">Kecamatan</label>
                              <select name="kecamatan" class="js-example-basic-single col-sm-12" required disabled>
                                <optgroup label="Kecamatan">
                                  <option value="<?= $alamatUser->kecamatan; ?>"><?= $alamatUser->kecamatan; ?></option>
                                  <?php foreach ($alamat['kecamatanData'] as $kecamatans) { ?>
                                    <option value="<?= $kecamatans['name']; ?>"><?= $kecamatans['name']; ?></option>
                                  <?php } ?>
                                </optgroup>
                              </select>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label class="form-label" for="exampleFormControlInput1">Kode Pos</label>
                              <input class="form-control" value="<?= $alamatUser->kodePos; ?>" name="kodePos" id="exampleFormControlInput1" type="text" disabled>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3">
                              <label class="form-label" for="exampleFormControlInput1">Jalan</label>
                              <input class="form-control" value="<?= $alamatUser->jalan; ?>" name="jalan" id="exampleFormControlInput1" type="text" disabled>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 mb-3">
                <div class="default-according" id="accordion1">
                  <div class="card">
                    <div class="card-header bg-primary" id="headingFour">
                      <h5 class="mb-0">
                        <button type="button" class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="icofont icofont-briefcase-alt-2"></i> Detail Produk</button>
                      </h5>
                    </div>
                    <div class="collapse show" id="collapseFour" aria-labelledby="headingOne" data-bs-parent="#accordion1">
                      <div class="card-body">
                        <div id="hasil_barang_edit"></div>
                        <div class="row" id="old_produk_edit">
                          <div class="col-8">
                            <div class="mb-3">
                              <label class="form-label" for="exampleFormControlInput1">Nama Produk</label>
                              <input class="form-control" value="<?= isset($pesanans->barangNama) ? $pesanans->barangNama : $pesanans->jasaNama; ?>" name="namaProduk" id="exampleFormControlInput1" type="text" disabled>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="mb-3">
                              <label class="form-label" for="exampleFormControlInput1">Satuan</label>
                              <input class="form-control" value="<?= isset($pesanans->barangSatuan) ? $pesanans->barangSatuan : $pesanans->jasaSatuan; ?>" name="satuan" id="exampleFormControlInput1" type="text" disabled>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="mb-3">
                              <label class="form-label" for="exampleFormControlInput1">Harga Per <?= isset($pesanans->barangSatuan) ? $pesanans->barangSatuan : $pesanans->jasaSatuan; ?></label>
                              <input class="form-control" value="Rp.<?= isset($pesanans->barangHarga) ? $pesanans->barangHarga : $pesanans->jasaHarga; ?>" name="harga" id="exampleFormControlInput1" type="text" disabled>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="mb-3">
                              <label class="form-label" for="exampleFormControlInput1">Stok</label>
                              <input class="form-control" value="<?= isset($pesanans->barangStok) ? $pesanans->barangStok : '1'; ?>" name="stok" id="exampleFormControlInput1" type="text" disabled>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3">
                              <label class="form-label" for="exampleFormControlInput1">Gambar</label> <br>
                              <center>
                                <img src="<?= base_url() ?>/image/<?= (isset($pesanans->pesananMulai) ? 'jasa' : 'barang'); ?>/<?= (isset($pesanans->jasaGambar) ? $pesanans->jasaGambar : $pesanans->barangGambar); ?>" alt="Image" class="img-fluid" />
                              </center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tutup</button>
            <button class="btn btn-secondary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalPembayaran-<?= $pesanans->pesananSlug; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('be/pesanan/addBuktiPembayaran?id=' . $pesanans->pesananSlug); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="inputGroupFile02" class="form-label">Uploud Bukti Pembayaran</label>
                  <input type="file" name="bukti" class="form-control" id="inputGroupFile02">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tutup</button>
            <button class="btn btn-secondary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal hapus -->
  <div class="modal fade" id="modalHapus-<?= $pesanans->pesananSlug; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin ingin mengahapus? Data akan <span class="text-danger">hilang permanen</span></p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Tutup</button>
          <a href="<?= base_url('be/pesanan/deletePesanan?id=' . $pesanans->pesananSlug); ?>" class="btn btn-secondary">Iya</a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<!-- Container-fluid Ends-->
<?= $this->endSection() ?>
3
<?= $this->section('script') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  var produkSlug;

  function ambilNilai() {
    produkSlug = document.getElementById('produk').value;
  }

  function hitungTotal() {
    <?php foreach ($semuaProduk as $produks) { ?>
      if (produkSlug == '<?php echo $produks->slug ?>') {
        var jumlah = document.getElementById('jumlahPesanan').value;
        var harga = <?php echo $produks->harga; ?>;
        var total = jumlah * harga;
        document.getElementById('totalHarga').value = 'Rp.' + total;
      }
    <?php } ?>
  }

  function hitungTotalEdit() {
    var produkSlugEdit = document.getElementById('produkEdit').value;
    <?php foreach ($semuaProduk as $produks) { ?>
      if (produkSlugEdit == '<?php echo $produks->slug ?>') {
        var jumlah = document.getElementById('jumlahPesananEdit').value;
        var harga = <?php echo $produks->harga; ?>;
        var total = jumlah * harga;
        document.getElementById('totalHargaEdit').value = 'Rp.' + total;
      }
    <?php } ?>
  }

  $(document).ready(function() {
    $('#produk').change(function() {
      var produkSlug = $(this).val();
      $.ajax({
        url: '<?php echo base_url('be/produk/selectProduk'); ?>',
        type: 'get',
        data: {
          produkSlug: produkSlug
        },
        success: function(response) {
          $('#hasil_barang').html(response);
        }
      });
    });
  });

  $(document).ready(function() {
    $('#produkEdit').change(function() {
      var produkSlug = $(this).val();
      $.ajax({
        url: '<?php echo base_url('be/produk/selectProduk'); ?>',
        type: 'get',
        data: {
          produkSlug: produkSlug
        },
        success: function(response) {
          $('#hasil_barang_edit').html(response);
          $('#old_produk_edit').hide();
        }
      });
    });
  });

  $(document).ready(function() {
    $('#pemesan').change(function() {
      var userSlug = $(this).val();
      $.ajax({
        url: '<?php echo base_url('be/produk/selectUser'); ?>',
        type: 'get',
        data: {
          userSlug: userSlug
        },
        success: function(response) {
          $('#hasil_user').html(response);
        }
      });
    });
  });

  $(document).ready(function() {
    $('#pemesanEdit').change(function() {
      var userSlug = $(this).val();
      $.ajax({
        url: '<?php echo base_url('be/produk/selectUser'); ?>',
        type: 'get',
        data: {
          userSlug: userSlug
        },
        success: function(response) {
          $('#hasil_user_edit').html(response);
          $('#old_user_edit').hide();
        }
      });
    });
  });
</script>

<script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>
<script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>

<script src="<?= base_url() ?>/assets/js/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>/assets/js/select2/select2-custom.js"></script>
<script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>
<?= $this->endSection() ?>