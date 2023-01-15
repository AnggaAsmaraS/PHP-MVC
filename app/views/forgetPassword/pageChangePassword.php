<div class="container mt-3">

    <div class="p-5 bg-ligth border rounded-3" id="jumbotron">
        <?php Flasher::flash(); ?>
        <form action="<?= BASEURL ?>/user/getPassword" class="row g-3 needs-validation" method="post">
            <div class="col-md-4">
                <label for="validationTooltipUsername" class="form-label">Password</label>
                <div class="input-group has-validation">
                    <div class="input-group">
                        <input type="password" name="password1" class="form-control pass" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" placeholder="Password 1" required>
                        <img src="<?= BASEURL ?>/img/eye-slash.svg" class="password1 mx-3" width="25px" height="25px" alt="" srcset="">
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <label for="validationTooltip05" class="form-label">Password 2</label>
                <div class="input-group">

                    <input type="password" name="password2" class="form-control" id="inputPassword2" placeholder="Password 2">
                    <img src="<?= BASEURL ?>/img/eye-slash.svg" class="password2 mx-3" width="25px" height="25px" alt="" srcset="">
                </div>

            </div>

            <div class="col-md-3 mt-5 mx-4">
                <button type="submit" name="changePass" class="btn btn-outline-primary">Ganti Password</button>
            </div>


        </form>

    </div>


</div>