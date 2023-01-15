<div class="container">
    <div class="mb-3 row mt-3">
        <?= Flasher::flash() ?>
        <div class="p-5 bg-ligth border rounded-3" id="jumbotron">
            <form class="row g-3 needs-validation" action="<?= BASEURL; ?>/user/edit" method="post" enctype="multipart/form-data">

                <div class="row-md-2 position-relative">
                    <img src="<?= BASEURL ?>/img/<?= $data['profile']['gambar']; ?>" width="100" height="100" class="rounded-circle border border-dark shadow mb-3" id="img-profile" alt="...">
                    <input type="file" class="form-control" name="gambar" id="gambar" aria-label="file example">
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>

                <div class="row-md-2 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                        <input type="text" name="username" class="form-control edit-username" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" value="<?= $data['profile']['username'] ?>" required>

                    </div>
                </div>

                <div class="row-md-2 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Nama</label>
                    <div class="input-group has-validation">

                        <input type="text" name="nama" class="form-control edit-nama" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" value="<?= $data['profile']['nama'] ?>" required>

                    </div>
                </div>

                <div class="row-md-2 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control edit-email" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" value="<?= $data['profile']['email'] ?>" required>

                    </div>
                </div>

                <div class="col-12 mt-3">
                    <button class="btn btn-primary" name="submit" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>