<div class="container">
    <div class="mb-3 row mt-3">
        <div class="p-5 bg-ligth border rounded-3" id="jumbotron">
            <?php Flasher::flash(); ?>
            <form class="row g-3 needs-validation" action="<?= BASEURL ?>/user/changePassword" method="post" novalidate>

                <div class="row-md-5 position-relative page-email">
                    <label for="validationTooltipUsername" class="form-label">Email</label>
                    <div class="input-group">
                        <div class="row-md-4">
                            <input type="text" name="username" class="form-control pr-3" id="page-email" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary mx-3" name="cari">Cari Email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>