<div class="container mt-3">

    <div class="p-5 bg-ligth border rounded-3" id="jumbotron">
        <?php Flasher::flash(); ?>
        <h4>Menjadi member, anda akan mendapatkan potongan harga ketika pembelian tiket</h4>
        <hr>
        <form action="<?= BASEURL; ?>/user/getBayarMember" class="row g-3 needs-validation" method="post">

            <h3>Harga Member : <Strong> <?= $this->rupiah($data['hargaMember']['harga']); ?>
                </Strong></h3>

            <div class="col-md-4">
                <label for="validationTooltipUsername" class="form-label">Bayar</label>
                <div class="input-group has-validation">
                    <div class="input-group">
                        <input type="text" name="harga" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" placeholder="Bayar" required>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mt-4">
                    <h3>Kembali : <strong> Rp, 50,000</strong></h3>
                </div>
            </div>

            <div class="col-md-3 mt-5 mx-4">
                <button type="submit" name="bayar" class="btn btn-outline-primary">Daftar Member</button>
            </div>
        </form>

    </div>
</div>