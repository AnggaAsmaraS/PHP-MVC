<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Awal</title>
    <!-- link bootstrap -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css">
    <!-- link style css -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
    <link href="<?= BASEURL; ?>/footers.css" rel="stylesheet">
</head>


<body>

    <header class="container mt-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= BASEURL; ?>">PHP MvC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>">Home</a>
                        </li>

                        <?php

                        if (isset($_SESSION['login'])) :

                            $namaUser = $_SESSION['username'];
                            $status = $_SESSION['status'];
                        ?>
                            <li class='nav-item'>
                                <a class='nav-link' href='<?= BASEURL ?>/user'> <?= $namaUser; ?> </a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link ' href='<?= BASEURL ?>/user/riwayatTransaksi/halaman=1' tabindex='-1'>Riwayat Transaksi</a>
                            </li>

                            <?php if ($status === 'off') : ?>
                                <li class='nav-item'>
                                    <a class='nav-link ' href='<?= BASEURL; ?>/user/pageDaftarMember' tabindex='-1'>Daftar Member</a>
                                </li>
                            <?php endif; ?>
                    </ul>

                    <a href=" <?= BASEURL; ?>/home/logout" class='btn btn-outline-secondary mr-md-3'>logout</a>
                <?php else : ?>
                    </ul>
                    <a href=" <?= BASEURL; ?>/login" class='btn btn-outline-primary mx-3'> Login</a>
                    <a href=" <?= BASEURL; ?>/register/register" class='btn btn-outline-secondary mr-md-3'>Register</a>


                <?php endif; ?>


                </div>
            </div>
        </nav>
    </header>