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
          <a target="_blank" href="<?= base_url('be/produk/cetakJasa'); ?>" class="btn btn-secondary float-end me-1">Cetak <i class="fa fa-file"></i></a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="display" id="basic-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($jasaData as $jasas) { ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $jasas['nama']; ?></td>
                    <td><?= $jasas['satuan']; ?></td>
                    <td>Rp.<?= number_format($jasas['harga'], 0, ',', '.'); ?></td>
                    <td>
                      <ul class="action">
                        <li class="info"> <a title="Info Jasa" data-bs-toggle="modal" href="#modalInfo-<?= $jasas['slug']; ?>"><i class="icon-info"></i></a></li>
                        <li class="spec me-1"> <a title="Spesifikasi Produk" data-bs-toggle="modal" href="#modalSpec-<?= $jasas['slug']; ?>"><i class="icon-dropbox-alt"></i></a></li>
                        <li class="edit"> <a title="Edit Jasa" data-bs-toggle="modal" href="#modalEdit-<?= $jasas['slug']; ?>"><i class="icon-pencil-alt"></i></a></li>
                        <li class="delete"><a title="Hapus Jasa" data-bs-toggle="modal" href="#modalHapus-<?= $jasas['slug']; ?>"><i class="icon-trash"></i></a></li>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('be/produk/jasa'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Nama</label>
                <input class="form-control" name="nama" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nama">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Harga</label>
                <input class="form-control" name="harga" id="exampleFormControlInput1" type="text" placeholder="Masukkan Harga">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <div class="mb-2">
                <div class="col-form-label">Satuan</div>
                <select class="js-example-basic-single col-sm-12" name="satuan">
                  <optgroup label="Satuan">
                    <?php foreach ($satuanData as $satuans) { ?>
                      <option value="<?= $satuans['nama']; ?>"><?= $satuans['nama']; ?></option>
                    <?php } ?>
                  </optgroup>
                </select>
              </div>
            </div>
            <div class="col-8">
              <div class="mb-2">
                <div class="col-form-label">Gambar</div>
                <input class="form-control mt-1" name="gambar" type="file">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div>
                <label class="form-label" for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
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

<!-- modal info -->
<?php foreach ($jasaData as $jasas) { ?>
  <div class="modal fade" id="modalInfo-<?= $jasas['slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Info Data</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Nama</label>
                <input class="form-control" value="<?= $jasas['nama']; ?>" name="nama" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nama" disabled>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Harga</label>
                <input class="form-control" value="Rp.<?= $jasas['harga']; ?>" name="harga" id="exampleFormControlInput1" type="text" placeholder="Masukkan Harga" disabled>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <div class="mb-2">
                <div class="col-form-label">Satuan</div>
                <input class="form-control" value="<?= $jasas['satuan']; ?>" name="stok" id="exampleFormControlInput1" type="text" placeholder="Masukkan Stok" disabled>
              </div>
            </div>
            <div class="col-8">
              <div class="mb-2">
                <div class="col-form-label">Nama Gambar</div>
                <input class="form-control mt-1" value="<?= $jasas['gambar']; ?>" name="gambar" type="text" disabled>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div>
                <label class="form-label" for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" disabled><?= $jasas['deskripsi']; ?></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div>
                <label class="col-form-label" for="deskripsi">Gambar</label><br>
                <div class="text-center">
                  <img src="<?= base_url('image/jasa/' . $jasas['gambar']); ?>" alt="Gambar" width="300px">
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

  <div class="modal fade" id="modalSpec-<?= $jasas['slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Spesifikasi Jasa</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('be/produk/spesifikasiJasa?id=' . $jasas['slug']); ?>" method="post">
          <div class="modal-body animate-chk">
            <div class="row">
              <?php isset($jasas['spesifikasi']) ? $spesifikasiCheck = json_decode($jasas['spesifikasi']) : $spesifikasiCheck = ''; ?>
              <?php foreach ($spesifikasiData as $spesifikasi) { ?>
                <div class="col-6 mb-2">
                  <label class="d-block" for="chk-ani">
                    <input class="checkbox_animated" name="spesifikasi[]" value="<?= $spesifikasi['spesifikasi']; ?>" id="chk-ani" type="checkbox" <?= !empty($spesifikasiCheck) ? in_array($spesifikasi['spesifikasi'], $spesifikasiCheck) ? 'checked' : '' : ''; ?>> <?= $spesifikasi['spesifikasi']; ?>
                  </label>
                </div>
              <?php } ?>
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

  <!-- modal edit -->
  <div class="modal fade" id="modalEdit-<?= $jasas['slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('be/produk/editJasa?id=' . $jasas['slug']); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Nama</label>
                  <input class="form-control" value="<?= $jasas['nama']; ?>" name="nama" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nama">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Harga</label>
                  <input class="form-control" value="<?= $jasas['harga']; ?>" name="harga" id="exampleFormControlInput1" type="text" placeholder="Masukkan Harga">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-4">
                <div class="mb-2">
                  <div class="col-form-label">Satuan</div>
                  <select class="js-example-basic-single col-sm-12" name="satuan">
                    <optgroup label="Satuan">
                      <option value="<?= $jasas['satuan']; ?>"><?= $jasas['satuan']; ?></option>
                      <?php foreach ($satuanData as $satuans) { ?>
                        <option value="<?= $satuans['nama']; ?>"><?= $satuans['nama']; ?></option>
                      <?php } ?>
                    </optgroup>
                  </select>
                </div>
              </div>
              <div class="col-8">
                <div class="mb-2">
                  <div class="col-form-label">Gambar</div>
                  <input class="form-control mt-1" name="gambar" type="file">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div>
                  <label class="form-label" for="deskripsi">Deskripsi</label>
                  <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"><?= $jasas['deskripsi']; ?></textarea>
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
  <div class="modal fade" id="modalHapus-<?= $jasas['slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a href="<?= base_url('be/produk/deleteJasa?id=' . $jasas['slug']); ?>" class="btn btn-secondary">Iya</a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<!-- Container-fluid Ends-->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>

<script src="<?= base_url() ?>/assets/js/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>/assets/js/select2/select2-custom.js"></script>
<script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

<script>
  ClassicEditor
    .create(document.querySelector('#deskripsi'))
    .catch(error => {
      console.error(error);
    });
</script>
<?= $this->endSection() ?>