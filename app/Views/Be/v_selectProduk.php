<?php
if (!empty($produk)) { ?>
    <div class="row">
        <div class="col-8">
            <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Nama Produk</label>
                <input class="form-control" value="<?= $produk['nama']; ?>" name="namaProduk" id="exampleFormControlInput1" type="text" disabled>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Satuan</label>
                <input class="form-control" value="<?= $produk['satuan']; ?>" name="satuan" id="exampleFormControlInput1" type="text" disabled>
            </div>
        </div>
        <div class="col-8">
            <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Harga Per <?= $produk['satuan']; ?></label>
                <input class="form-control" value="Rp.<?= $produk['harga']; ?>" name="harga" id="exampleFormControlInput1" type="text" disabled>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Stok</label>
                <input class="form-control" value="<?= isset($produk['stok']) ? $produk['stok'] : '1'; ?>" name="stok" id="exampleFormControlInput1" type="text" disabled>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Gambar</label> <br>
                <center>
                    <img src="<?= base_url() ?>/image/<?= (isset($produk['stok']) ? 'barang' : 'jasa'); ?>/<?= $produk['gambar']; ?>" alt="Image" class="img-fluid" />
                </center>
            </div>
        </div>
    </div>
    <hr>
<?php } ?>