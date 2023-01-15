<?php


class User extends Controller
{

    //menampilkan halaman index user
    public function index()
    {
        $this->sessionLogin();
        $profileUser =  $_SESSION["id_user"];
        $data['profile'] = $this->model('User_model')->profileUser($profileUser);
        $this->views('tamplates/header');
        $this->views('user/user', $data);
        $this->views('tamplates/footer');
    }

    //untuk halaman pembelian tiket
    public function beliTiket($id)
    {
        // $this->sessionLogin();
        session_start();
        if (isset($_SESSION['login'])) {
            $profileUser =  $_SESSION["id_user"];
            var_dump($id);
            //mengambil function getPertandingan berdasarkan id user
            $data['pertandingan'] = $this->model('User_model')->getPertandingan($id);

            //mengambil function getTiket berdasarkan id user
            $data['kelas'] = $this->model('User_model')->getTiket($id);

            $data["profile"] = $this->model("User_model")->profileUser($profileUser);
            $_SESSION['idJadwal'] = $id;
            $this->views('tamplates/header');
            $this->views('beli-tiket/beliTiket', $data);
            $this->views('tamplates/footer');
        } else {
            $this->views('tamplates/header');
            $this->views('login/login');
            $this->views('tamplates/footer');
        }
    }

    //untuk menerima data dari ajax, yang berguna untuk menampilkan data (database) dari table clas
    public function getAllTiket()
    {

        echo json_encode($this->model("User_model")->allTiket($_POST['idTiket']));
    }


    //mengambil diskon apabila status member
    public function getDiskon()
    {
        echo json_encode($this->model("User_model")->setDiskon($_POST['idTiket']));
    }

    //untuk pembayaran tiket
    public function bayarTiket()
    {
        if ($this->model('User_model')->pembayaranTiket($_POST) > 0) {
            Flasher::setFlash("Berhasil", "dalam pembayaran", "success");
        } else {
            Flasher::setFlash("Kesalahan", "dalam pembayaran", "danger");
        }
    }

    //untuk halaman edit profile user
    public function editProfile()
    {
        $this->sessionLogin();
        $profileUser =  $_SESSION["id_user"];
        $data['profile'] = $this->model('User_model')->profileUser($profileUser);
        $this->views('tamplates/header');
        $this->views('user/editprofile', $data);
        $this->views('tamplates/footer');
    }

    //untuk form edit profile (proses update kedalam database)
    public function edit()
    {

        if ($this->model("User_model")->editProfile($_POST) > 0) {
            Flasher::setFlash("Berhasil", "Edit Profile", "success");
            header("Location: " . BASEURL . "/user");
        } else {
            Flasher::setFlash("Gagal", "edit profile", "danger");
            header("Location: " . BASEURL . "/user/editprofile");
        }
    }

    //untuk form pergantian password
    public function gantiPassword()
    {
        if ($this->model("User_model")->changePassword($_POST) > 0) {
            Flasher::setFlash("Berhasil", "ganti password", "success");
        } else {
            Flasher::setFlash("Gagal", "ganti password", "danger");
        }
    }

    //halaman pencarian email apabila lupa password
    public function pageEmail()
    {
        $this->views('tamplates/header');
        $this->views("forgetPassword/pageEmail");
        $this->views("tamplates/footer");
    }

    //untuk proses pencarian email ganti password
    public function changePassword()
    {

        if ($this->model("User_model")->getEmail($_POST) > 0) {

            $this->views('tamplates/header');
            $this->views("forgetPassword/pageChangePassword");
            $this->views("tamplates/footer");
        } else {
            Flasher::setFlash("email", "tidak di temukan", "danger");
            $this->views('tamplates/header');
            $this->views("forgetPassword/pageEmail");
            $this->views("tamplates/footer");
        }
    }

    //untuk mengatur update password kedalam database
    public function getPassword()
    {
        if ($this->model("User_model")->setPassword($_POST) > 0) {
            Flasher::setFlash("ganti password", "Berhasil", "success");
            $this->views('tamplates/header');
            $this->views("forgetPassword/pageChangePassword");
            $this->views("tamplates/footer");
        } else {
            Flasher::setFlash("password", "tidak sesuai", "success");
            $this->views('tamplates/header');
            $this->views("forgetPassword/pageChangePassword");
            $this->views("tamplates/footer");
        }
    }

    //untuk halaman mpendaftaran member
    public function pageDaftarMember()
    {
        $this->sessionLogin();
        $data['hargaMember'] = $this->model('User_model')->getHargaMember();
        $this->views('tamplates/header');
        $this->views('daftarMember/daftarMember', $data);
        $this->views('tamplates/footer');
    }

    //untuk proses pendaftaran member
    public function getBayarMember()
    {

        if ($this->model("User_model")->setBayarMember($_POST) > 0) {
            Flasher::setFlash("behasil mendaftar sebagai", "member", "success");
            $this->views('tamplates/header');
            $data['hargaMember'] = $this->model('User_model')->getHargaMember();
            $this->views('daftarMember/daftarMember', $data);
            $this->views('tamplates/footer');
        } else {
            Flasher::setFlash("Gagal mendaftar sebagai", "member", "danger");
            $data['hargaMember'] = $this->model('User_model')->getHargaMember();
            $this->views('tamplates/header');
            $this->views('daftarMember/daftarMember', $data);
            $this->views('tamplates/footer');
        }
    }

    //untuk menampilkan riwayat transaksi dalam pembelian tiket

    public function riwayatTransaksi($url)
    {
        session_start();

        //   $data['riwayatTr'] = $this->model("User_model")->setRiwayatTransaksi();
        $this->views('tamplates/header');
        $data['pagination'] = $this->model("User_model")->setPagination($url);
        $this->views('user/riwayatTransaksi', $data);
        $this->views('tamplates/footer');
    }
}
