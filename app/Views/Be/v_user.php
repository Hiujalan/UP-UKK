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
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="display" id="basic-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Nomor Telepon</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($userData as $users) { ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $users['nama']; ?></td>
                    <td><?= $users['telp']; ?></td>
                    <td><?= $users['email']; ?></td>
                    <td>
                      <ul class="action">
                        <li class="alamat me-2"> <a data-bs-toggle="modal" href="#modalAlamat-<?= $users['slug']; ?>"><i class="icon-home"></i></a></li>
                        <li class="edit"> <a data-bs-toggle="modal" href="#modalEdit-<?= $users['slug']; ?>"><i class="icon-pencil-alt"></i></a></li>
                        <li class="delete"><a data-bs-toggle="modal" href="#modalHapus-<?= $users['slug']; ?>"><i class="icon-trash"></i></a></li>
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
      <form action="<?= base_url('be/users/user'); ?>" method="post">
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
                <label class="form-label" for="exampleFormControlInput1">Email</label>
                <input class="form-control" name="email" id="exampleFormControlInput1" type="email" placeholder="Masukkan Email">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Nomor Telephone</label>
                <input class="form-control" name="telephone" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nomor Telephone">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Password</label>
                <input class="form-control" name="password" id="exampleFormControlInput1" type="password" name="login[password]" placeholder="Masukkan Password">
                <div class="show-hide pb-3"><span class="show"> </span></div>
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

<!-- modal edit -->
<?php foreach ($userData as $users) { ?>
  <div class="modal fade" id="modalEdit-<?= $users['slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('be/users/editUser?id=' . $users['slug']); ?>" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Nama</label>
                  <input class="form-control" value="<?= $users['nama']; ?>" name="nama" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nama">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Email</label>
                  <input class="form-control" value="<?= $users['email']; ?>" name="email" id="exampleFormControlInput1" type="email" placeholder="Masukkan Email">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Nomor Telephone</label>
                  <input class="form-control" value="<?= $users['telp']; ?>" name="telephone" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nomor Telephone">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Password</label>
                  <input class="form-control" name="password" id="exampleFormControlInput1" type="password" name="login[password]" placeholder="Masukkan Password">
                  <div class="show-hide pb-3"><span class="show"> </span></div>
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

  <div class="modal fade" id="modalAlamat-<?= $users['slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alamat User</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('login/updateAlamatBe?id=' . $users['slug']); ?>" method="post">
          <?php
          $alamatUser = json_decode($users['alamat'], true);
          ?>
          <div class="modal-body">
            <div class="row">
              <div class="col o-hidden">
                <div class="mb-2">
                  <div class="col-form-label">Provinsi</div>
                  <select name="provinsi" class="js-example-basic-single col-sm-12">
                    <optgroup label="Provinsi">
                      <option value="<?= $alamatUser['provinsi']; ?>"><?= $alamatUser['provinsi']; ?></option>
                      <?php foreach ($provinsiData as $provinsi) { ?>
                        <option value="<?= $provinsi['name']; ?>"><?= $provinsi['name']; ?></option>
                      <?php } ?>
                    </optgroup>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-2">
                  <div class="col-form-label">Kabupaten</div>
                  <select name="kabupaten" class="js-example-basic-single col-sm-12">
                    <optgroup label="Provinsi">
                      <option value="<?= $alamatUser['kabupaten']; ?>"><?= $alamatUser['kabupaten']; ?></option>
                      <?php foreach ($kabupatenData as $kabupaten) { ?>
                        <option value="<?= $kabupaten['name']; ?>"><?= $kabupaten['name']; ?></option>
                      <?php } ?>
                    </optgroup>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-2">
                  <div class="col-form-label">Kecamatan</div>
                  <select name="kecamatan" class="js-example-basic-single col-sm-12">
                    <optgroup label="Provinsi">
                      <option value="<?= $alamatUser['kecamatan']; ?>"><?= $alamatUser['kecamatan']; ?></option>
                      <?php foreach ($kecamatanData as $kecamatan) { ?>
                        <option value="<?= $kecamatan['name']; ?>"><?= $kecamatan['name']; ?></option>
                      <?php } ?>
                    </optgroup>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Kode Pos</label>
                  <input class="form-control" value="<?= $alamatUser['kodePos']; ?>" name="kodePos" id="exampleFormControlInput1" type="text" placeholder="Masukkan Kode Pos">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Jalan</label>
                  <input class="form-control" value="<?= $alamatUser['jalan']; ?>" name="jalan" id="exampleFormControlInput1" type="text" placeholder="Masukkan Jalan">
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

  <div class="modal fade" id="modalHapus-<?= $users['slug']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a href="<?= base_url('be/users/deleteUser?id=' . $users['slug']); ?>" class="btn btn-secondary">Iya</a>
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
<?= $this->endSection() ?>