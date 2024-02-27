<?php
if (!empty($user)) {
    $alamat = json_decode($user['alamat']); ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/vendors/select2.css">

    <div class="row">
        <div class="col-6">
            <div class="form-label" for="exampleFormControlInput1">Provinsi</div>
            <select name="provinsi" class="js-example-basic-single col-sm-12" required disabled>
                <optgroup label="Provinsi">
                    <option value="<?= $alamat->provinsi; ?>"><?= $alamat->provinsi; ?></option>
                    <?php foreach ($provinsiData as $provinsis) { ?>
                        <option value="<?= $provinsis['name']; ?>"><?= $provinsis['name']; ?></option>
                    <?php } ?>
                </optgroup>
            </select>
        </div>
        <div class="col-6">
            <div class="mb-2">
                <div class="form-label">Kabupaten</div>
                <select name="kabupaten" class="js-example-basic-single col-sm-12" disabled>
                    <option value="<?= $alamat->kabupaten; ?>"><?= $alamat->kabupaten; ?></option>
                    <?php foreach ($kabupatenData as $kabupaten) {   ?>
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
                        <option value="<?= $alamat->kecamatan; ?>"><?= $alamat->kecamatan; ?></option>
                        <?php foreach ($kecamatanData as $kecamatans) { ?>
                            <option value="<?= $kecamatans['name']; ?>"><?= $kecamatans['name']; ?></option>
                        <?php } ?>
                    </optgroup>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Kode Pos</label>
                <input class="form-control" value="<?= $alamat->kodePos; ?>" name="kodePos" id="exampleFormControlInput1" type="text" disabled>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Jalan</label>
                <input class="form-control" value="<?= $alamat->jalan; ?>" name="jalan" id="exampleFormControlInput1" type="text" disabled>
            </div>
        </div>

    </div>

    <script src="<?= base_url() ?>/assets/js/select2/select2.full.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/select2/select2-custom.js"></script>
    <script src="<?= base_url() ?>/assets/js/tooltip-init.js"></script>
<?php } ?>