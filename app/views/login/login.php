<div class="container">
    <div class="mb-3 row mt-3">
        <div class="p-5 bg-ligth border rounded-3" id="jumbotron">
            <?= Flasher::flash(); ?>
            <form class="row g-3 needs-validation" action="<?= BASEURL; ?>/login" method="post" novalidate>

                <div class="col-md-4 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                        <input type="text" name="username" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required>
                        <div class="invalid-tooltip">
                            Please choose a unique and valid username.
                        </div>
                    </div>
                </div>
                <div class="col-md-4 position-relative">
                    <label for="validationTooltip05" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control pass bg-transparent " id="inputPassword2" placeholder="Password">
                        <img src="<?= BASEURL ?>/img/eye-slash.svg" class="password1 mx-3" width="25px" height="25px" alt="" srcset="">
                    </div>

                </div>
                <div class="col-12">
                    <button class="btn btn-primary" id="submitLogin" name="submitLogin" type="submit">Login</button>

                    <a href="<?= BASEURL; ?>/user/pageEmail" class="btn btn-outline-secondary">Lupa Password</a>
                </div>
            </form>
        </div>
    </div>
</div>