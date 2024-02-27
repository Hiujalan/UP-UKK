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
                  <th>Provinsi</th>
                  <th>Kabupaten</th>
                  <!-- <th>Aksi</th> -->
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($kabupatenData as $kabupatens) { ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $kabupatens->nameProvinsi; ?></td>
                    <td><?= $kabupatens->nameKabupaten; ?></td>
                    <!-- <td>
                      <ul class="action">
                        <li class="edit"> <a data-bs-toggle="modal" href="#modalEdit-<?= $kabupatens->id; ?>"><i class="icon-pencil-alt"></i></a></li>
                        <li class="delete"><a data-bs-toggle="modal" href="#modalHapus-<?= $kabupatens->id; ?>"><i class="icon-trash"></i></a></li>
                      </ul>
                    </td> -->
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
      <form action="<?= base_url('be/produk/kabupaten'); ?>" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="mb-2">
                <div class="col-form-label">Provinsi</div>
                <select name="provinsi" class="js-example-basic-single col-sm-12">
                  <optgroup label="Provinsi ">
                    <?php foreach ($provinsiData as $provinsis) { ?>
                      <option value="<?= $provinsis['id']; ?>"><?= $provinsis['name']; ?></option>
                    <?php } ?>
                  </optgroup>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Nama Kabupaten</label>
                <input class="form-control" name="kabupaten" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nama">
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
<?php foreach ($kabupatenData as $kabupatens) { ?>
  <div class="modal fade" id="modalEdit-<?= $kabupatens->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('be/produk/editProvinsi?id=' . $kabupatens->id); ?>" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Nama Kabupaten</label>
                  <input class="form-control" value="<?= $kabupatens->nameKabupaten; ?>" name="nama" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nama">
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
  <div class="modal fade" id="modalHapus-<?= $kabupatens->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a href="<?= base_url('be/produk/deleteBank?id=' . $kabupatens->id); ?>" class="btn btn-secondary">Iya</a>
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