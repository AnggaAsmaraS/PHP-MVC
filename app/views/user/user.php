<div class="container mt-3">

    <div class="card">


    </div>
    <div class="row mt-3 alpha">
        <div class="col-md-4">
            <img src="<?= BASEURL ?>/img/<?= $data['profile']['gambar']; ?>" width="100" height="100" class="rounded-circle border border-dark shadow" id="img-profile" alt="...">
        </div>


        <div class="col-md-4 ms-auto mt-5">



            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="<?= BASEURL ?>/img/lock.svg" width="23px" height="23px" class="setting" alt="" srcset="">
                Ganti Password
            </button>





            <a href="<?= BASEURL ?>/user/editprofile" id="form-edit" class="btn btn-outline-info mx-2"><img src="<?= BASEURL ?>/img/gear.svg" width="23px" height="23px" class="setting" alt="" srcset=""> Edit Profile</a>
        </div>
    </div>




    <div class="row md-3 mt-3">

        <label for="colFormLabel" class="col-sm-2 col-form-label">Username : </label>
        <div class="col-sm-4">
            <h2>
                <p><?= $data['profile']['username']; ?></p>
            </h2>
        </div>


        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama : </label>
        <div class="col-sm-4">
            <h2>
                <p><?= $data['profile']['nama']; ?></p>
            </h2>
        </div>
    </div>

    <div class="row md-3">

        <label for="colFormLabel" class="col-sm-2 col-form-label">Email : </label>
        <div class="col-sm-4">
            <h2>
                <p><?= $data['profile']['email'] ?></p>
            </h2>
        </div>


        <label for="colFormLabel" class="col-sm-2 col-form-label">Status : </label>
        <div class="col-sm-4">
            <h2>
                <?php if ($_SESSION['status'] === "off") : ?>
                    <p><?= "Non - Member" ?></p>
                <?php else : ?>
                    <p><?= "Member" ?></p>
                <?php endif; ?>
            </h2>
        </div>
    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL ?>/user/gantipassword" method="post">
                    <input type="password" class="form-control" name="password" placeholder="Masukan Kata Sandi Baru" id="" required>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>