<div class="container">
    <div class="mb-3 row mt-3">
        <div class="p-5 bg-ligth border rounded-3" id="jumbotron">
            <form class="row g-3 needs-validation" action="<?= BASEURL; ?>/register/prosesRegister" method="post">
                <?= Flasher::flash(); ?>
                <!-- <input type="text" hidden name="status" value="off"> -->
                <div class="row-md-2 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                        <input type="text" name="username" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required>

                    </div>
                </div>

                <div class="row-md-2 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Nama</label>
                    <div class="input-group has-validation">

                        <input type="text" name="nama" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required>

                    </div>
                </div>

                <div class="row-md-2 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required>

                    </div>
                </div>
                <div class="row-md-2 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Password</label>
                    <div class="input-group has-validation">
                        <div class="input-group">
                            <input type="password" name="password1" class="form-control pass" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required>
                            <img src="<?= BASEURL ?>/img/eye-slash.svg" class="password1 mx-3" width="25px" height="25px" alt="" srcset="">
                        </div>

                    </div>
                </div>

                <div class="row-md-2 position-relative">
                    <label for="validationTooltip05" class="form-label">Password 2</label>
                    <div class="input-group">

                        <input type="password" name="password2" class="form-control" id="inputPassword2" placeholder="Password">
                        <img src="<?= BASEURL ?>/img/eye-slash.svg" class="password2 mx-3" width="25px" height="25px" alt="" srcset="">
                    </div>

                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-primary" name="submit" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>