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
        </div>
        <form action="<?= base_url('be/settings/settings'); ?>" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <ul class="nav nav-tabs border-tab nav-primary nav-left" id="danger-tab" role="tablist">
              <li class="nav-item"><a class="nav-link active" id="danger-home-tab" data-bs-toggle="tab" href="#danger-home" role="tab" aria-controls="danger-home" aria-selected="true"><i class="icofont icofont-gear"></i>General</a></li>
              <li class="nav-item"><a class="nav-link" id="profile-danger-tab" data-bs-toggle="tab" href="#danger-profile" role="tab" aria-controls="danger-profile" aria-selected="false"><i class="icofont icofont-home"></i>Alamat</a></li>
              <li class="nav-item"><a class="nav-link" id="contact-danger-tab" data-bs-toggle="tab" href="#danger-contact" role="tab" aria-controls="danger-contact" aria-selected="false"><i class="icofont icofont-users"></i>Media Sosial</a></li>
            </ul>
            <div class="tab-content" id="danger-tabContent">
              <div class="tab-pane fade show active" id="danger-home" role="tabpanel" aria-labelledby="danger-home-tab">
                <div class="row">
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Nama</label>
                      <input class="form-control" value="<?= $settingsData['nama']; ?>" name="nama" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nama">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Telp</label>
                      <input class="form-control" value="<?= $settingsData['telp']; ?>" name="telp" id="exampleFormControlInput1" type="text" placeholder="Masukkan Nomor Telepon">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Email</label>
                      <input class="form-control" value="<?= $settingsData['email']; ?>" name="email" id="exampleFormControlInput1" type="email" placeholder="Masukkan Nomor Telepon">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Logo</label>
                      <input class="form-control" name="logo" id="exampleFormControlInput1" type="file" placeholder="Masukkan Nomor Telepon">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="danger-profile" role="tabpanel" aria-labelledby="profile-danger-tab">
                <div class="row">
                  <div class="col-6">
                    <?php $alamat = json_decode($settingsData['alamat']); ?>
                    <label class="form-label" for="exampleFormControlInput1">Provinsi</label>
                    <select name="provinsi" class="js-example-basic-single col-sm-12" required>
                      <optgroup label="Provinsi">
                        <option value="<?= $alamat->provinsi; ?>"><?= $alamat->provinsi; ?></option>
                        <?php foreach ($provinsiData as $provinsis) { ?>
                          <option value="<?= $provinsis['name']; ?>"><?= $provinsis['name']; ?></option>
                        <?php } ?>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="form-label" for="exampleFormControlInput1">Kabupaten</label>
                    <select name="kabupaten" class="js-example-basic-single col-sm-12" required>
                      <optgroup label="Kabupaten">
                        <option value="<?= $alamat->kabupaten; ?>"><?= $alamat->kabupaten; ?></option>
                        <?php foreach ($kabupatenData as $kabupatens) { ?>
                          <option value="<?= $kabupatens['name']; ?>"><?= $kabupatens['name']; ?></option>
                        <?php } ?>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-6">
                    <label class="form-label" for="exampleFormControlInput1">Kecamatan</label>
                    <select name="kecamatan" class="js-example-basic-single col-sm-12" required>
                      <optgroup label="Kecamatan">
                        <option value="<?= $alamat->kecamatan; ?>"><?= $alamat->kecamatan; ?></option>
                        <?php foreach ($kecamatanData as $kecamatans) { ?>
                          <option value="<?= $kecamatans['name']; ?>"><?= $kecamatans['name']; ?></option>
                        <?php } ?>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Kode Pos</label>
                      <input class="form-control" value="<?= $alamat->kodePos; ?>" name="kodePos" id="exampleFormControlInput1" type="text">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Jalan</label>
                      <input class="form-control" value="<?= $alamat->jalan; ?>" name="jalan" id="exampleFormControlInput1" type="text">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="danger-contact" role="tabpanel" aria-labelledby="contact-danger-tab">
                <div class="row">
                  <?php $medsos = json_decode($settingsData['medsos']); ?>
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Facebook</label>
                      <input class="form-control" value="<?= $medsos->facebook; ?>" name="facebook" id="exampleFormControlInput1" type="text">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Twitter</label>
                      <input class="form-control" value="<?= $medsos->twitter; ?>" name="twitter" id="exampleFormControlInput1" type="text">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Instagram</label>
                      <input class="form-control" value="<?= $medsos->instagram; ?>" name="instagram" id="exampleFormControlInput1" type="text">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlInput1">Linkedin</label>
                      <input class="form-control" value="<?= $medsos->linkedin; ?>" name="linkedin" id="exampleFormControlInput1" type="text">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary float-end mb-3">Simpan</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Zero Configuration  Ends-->
  </div>
</div>


<!-- Container-fluid Ends-->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/datatable/datatables/datatable.custom.js"></script>

<script src="<?= base_url() ?>/assets/js/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>/assets/js/select2/select2-custom.js"></script>
<script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>
<?= $this->endSection() ?>