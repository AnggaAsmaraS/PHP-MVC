<div class="container mt-3">

    <div class="p-5 bg-ligth border rounded-3" id="jumbotron">
        <div class="container-fluid py-5">
            <?= Flasher::flash() ?>
            <form class="was-validated row g-3" id="form-beli" action="" method="POST">
                <p class="h3 col-md-4" id="pertandingan"><?= $data['pertandingan']['pertandingan']; ?></p>
                <div class="col-md-2">
                    <select class="form-select" name="kelas" id="pilih-kelas" required aria-label="select example">
                        <option selected="selected" name="0" class="select" value="">Pilih Kelas</option>
                        <?php foreach ($data['kelas'] as $jenis) : ?>
                            <option name="0" class="select" data-id="<?= $jenis['id_class'] ?>" selected><?= $jenis['jenis']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <p class="h2 col-sm-3" name="harga" id="harga-tiket">Rp, 0 </p>
                <h3 id="stok-tiket" class="h2 col-sm-3" name="stok_tiket"> Tiket : 0
                </h3>
                <hr />
                <div class="col-md-4 bungkus">
                    <p class="h3" id="jenis-tiket">Jenis Tiket : REGULER</p>
                </div>
                <div class="col-md-2">
                    <input type="text" name="tes" class="form-control qty" id="validationCustom01" placeholder="qty" value="0" required>
                </div>
                <?php if ($data['profile']['status'] == 'on') : ?>

                    <p class="h2 col-sm-3 diskon" id="total">Rp, 0</p>
                    <p class="h2 col-sm-3" id="harga-diskon" name="total">Rp, 0</p>

                <?php else : ?>
                    <p class="h2 col-sm-3" id="total" name="total">Rp, 0</p>

                <?php endif; ?>
                <div class="col-12">
                    <button class="btn btn-primary" id="kirim" name="konfirmasiBayar" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>