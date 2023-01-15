<?php


class User_model
{
    private $db;
    private $status = 'off'; //untuk pengisian status default ketika user baru mendaftar kedalam website
    public function __construct()
    {
        $this->db = new Database;
    }



    //proses pergantian password
    public function changePassword($data)
    {
        session_start();
        $id_user = $_SESSION['id_user'];

        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->query('UPDATE user
         SET
         password = :password
         WHERE id_user = :id_user
         ');

        $this->db->bind('password', $password_hash);
        $this->db->bind('id_user', $id_user);

        $this->db->execute();

        return $this->db->rowCount();
    }

    //upload gambar untuk profile user
    public function uploadGambar()
    {
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        // if ($error === 4) {
        //     echo "Pilih Gambar Terlebih";
        //     return false;
        // }

        $extensiGambarValid = ['jpg', 'jpeg', 'png'];
        $extensiGambar = explode('.', $namaFile);
        $extensiGambar = strtolower(end($extensiGambar));

        if (!in_array($extensiGambar, $extensiGambarValid)) {
            echo "Yang anda Upload Bukan Gambar";
            return false;
        }

        if ($ukuranFile > 4000000) {
            echo "Ukuran gambar terlalu besar, maksimal 4MB";
            return false;
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $extensiGambar;

        move_uploaded_file($tmpName, "img/" . $namaFileBaru);

        return $namaFileBaru;
    }

    //prosess edit profile user
    public function editProfile($data)
    {

        session_start();
        $img = [];
        $id_user = $_SESSION['id_user'];
        $username = $_SESSION['username'];
        $img = $_FILES['gambar'];

        //untuk mengambil data dari database berdsarkan username, untuk pengecekan username apakah sama atau tidak username yang di edit di dalam database
        $this->db->query("SELECT username FROM user WHERE username =  :username");

        $this->db->bind('username',  $data['username']);

        $tes =   $this->db->singleResult();

        $this->db->execute();
        $this->db->rowCount();

        //cek jika username yang di kirimkan oleh user sama atau tidak di dalam database
        if ($username === $data['username']) {

            //mengecek apakah ada gambar yang dikirim atau tidak, jika tidak kosong, maka gambar akan di upload
            if ($img['name'] != "") {

                $img = $this->uploadGambar();
                $this->db->query("UPDATE user 
                SET 
                nama = :nama,
                email = :email,
                gambar = :gambar
                WHERE id_user = :id_user
                ");
                $this->db->bind('nama', $data['nama']);
                $this->db->bind('email', $data["email"]);
                $this->db->bind('gambar', $img);
                $this->db->bind('id_user', $id_user);

                $this->db->execute();

                return $img;
            }
            //apabila tidak ada gmabar yang dikirimkan maka gambar tidak akan di upload
            else {

                $this->db->query("UPDATE user 
                SET 
                nama = :nama,
                email = :email
                WHERE id_user = :id_user
                ");
                $this->db->bind('nama', $data['nama']);
                $this->db->bind('email', $data["email"]);
                $this->db->bind('id_user', $id_user);
                $this->db->execute();
                return $this->db->rowCount();
                exit;
            }
        }
        // jika username tidak sama sama dengan yang di database, maka user mengedit usernamenya
        else {
            //jika usernamenya sama dengan dengan data yangdi database maka username sudah di gunakan oleh user lain
            if ($tes) {

                return false;
            }

            $img = $this->uploadGambar();
            $this->db->query("UPDATE user 
            SET 
            username = :username,
            nama = :nama,
            email = :email,
            gambar = :gambar
            WHERE id_user = :id_user
            ");
            $this->db->bind('username', $data['username']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('email', $data["email"]);
            $this->db->bind('gambar', $img);
            $this->db->bind('id_user', $id_user);

            $_SESSION['username'] = $data['username'];

            $this->db->execute();

            return $this->db->rowCount();
        }
    }

    public function profileUser($profileUser)
    {

        $this->db->query("SELECT username, nama, email, gambar, status FROM user WHERE id_user = :id_user ");
        $this->db->bind('id_user', $profileUser);
        $this->db->execute();
        $this->db->rowCount();

        return $this->db->singleResult();
    }


    //untuk pembayaran tiket
    public function pembayaranTiket($data)
    {
        session_start();
        $status = [];
        $data['id_user'] =  $_SESSION['id_user'];
        $data['id_kelas'] = $_SESSION['id_kelas'];
        $data['idJadwal'] = $_SESSION['idJadwal'];
        $data['quantity'] = $_POST['quantity'];
        $data['harga'] = $_POST['harga'];
        $data['total'] = $_POST['total'];
        $data['hargaDiskon'] = $_POST['hargaDiskon'];

        $status = $this->profileUser($data['id_user']);

        //untuk memfilter angka agar tidak ada huruf
        $harga = preg_replace("/[^0-9]/", "", $data['harga']);
        $total = preg_replace("/[^0-9]/", "", $data['total']);
        $stokTiket = preg_replace("/[^0-9]/", "", $data['stokTiket']);
        $hargaDiskon = preg_replace("/[^0-9]/", "", $data['hargaDiskon']);


        $data['stokTiket'] = $_POST['stokTiket'];


        //mengecek jika status on (member). yang dimasukan harga diskon
        $this->status = "on";
        if ($status['status'] === $this->status) {
            $this->db->query("INSERT INTO pembayaran
            VALUES ('', :id_user, :id_kelas, :idJadwal, :quantity, :harga, :total) ");

            $this->db->bind("id_user", $data['id_user']);
            $this->db->bind("id_kelas", $data['id_kelas']);
            $this->db->bind("idJadwal", $data['idJadwal']);
            $this->db->bind("quantity", $data['quantity']);
            $this->db->bind("harga", $harga);
            $this->db->bind("total", $hargaDiskon); // harga diskon
            $this->db->execute();
            return $this->db->rowCount();
        }
        //apabila bukan member maka yang dimasukan harga normal
        else {
            $this->db->query("INSERT INTO pembayaran
         VALUES ('', :id_user, :id_kelas, :idJadwal, :quantity, :harga, :total) ");

            $this->db->bind("id_user", $data['id_user']);
            $this->db->bind("id_kelas", $data['id_kelas']);
            $this->db->bind("idJadwal", $data['idJadwal']);
            $this->db->bind("quantity", $data['quantity']);
            $this->db->bind("harga", $harga);
            $this->db->bind("total", $total); // harga normal
            $this->db->execute();
            return $this->db->rowCount();
        }
        // untuk mengecek proses pembayaran berhasil atau tidak
        if ($this->db->rowCount() > 0) {
            //menghitung stok tiket yang di database dengan quanity
            $sisaTiket = intval($stokTiket) - intval($data['quantity']);
            //update stok tiket agar stok tiket yang di database berukurang
            $this->db->query("UPDATE clas 
            SET 
            stok = :stokTiket
            WHERE id_class = :id_kelas");
            $this->db->bind('stokTiket', $sisaTiket);
            $this->db->bind('id_kelas', $data['id_kelas']);

            $this->db->execute();
        }

        return $this->db->rowCount();
    }
    public function getPertandingan($id)
    {
        $this->db->query("SELECT id_jadwal, pertandingan FROM jadwal WHERE id_jadwal = :id ");
        $this->db->bind('id', $id);
        return $this->db->singleResult();
    }

    public function getDiskon()
    {
        $this->db->query("SELECT * FROM tb_diskon");
        $this->db->execute();
        $this->db->rowCount();

        return $this->db->singleResult();
    }

    //untuk menghitung diskon dalam pembayaran tiket
    public function setDiskon($data)
    {
        $getHarga = $this->allTiket($data);
        $getDiskon = $this->getDiskon();

        return $getHarga['harga'] - ($getHarga['harga'] * $getDiskon['diskon'] / 100);
    }


    public function allTiket($idTiket)
    {
        $getHarga = [];
        $getDiskon = $this->getDiskon();
        $this->db->query("SELECT * FROM clas WHERE id_class = :idTiket");
        $this->db->bind('idTiket', $idTiket);
        session_start();
        $_SESSION["id_kelas"] = $idTiket;
        $this->db->execute();
        $getHarga = $this->db->rowCount();
        //untuk menghitung harga yang di diskon
        $total = $getHarga['harga'] - ($getHarga['harga'] * $getDiskon['diskon'] / 100);

        return $this->db->singleResult();
    }

    public function getTiket()
    {
        $this->db->query("SELECT * FROM clas");
        return $this->db->resultAll();
    }

    public function getLogin($data)
    {


        $dat = [];
        $username = $data['username'];
        $password = $data['password'];

        $query = "SELECT * FROM user WHERE username = :username";


        $this->db->query($query);
        $this->db->bind('username', $username);
        $dat = $this->db->singleResult();

        $this->db->execute();
        $row = $this->db->rowCount();

        $this->db->query("SELECT password FROM user WHERE password = :password");
        $this->db->bind("password", $password);

        if ($row > 0 && password_verify($password, $dat['password'])) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $dat['id_user'];
            $_SESSION['username'] = $dat['username'];
            $_SESSION['status'] = $dat['status'];

            return true;
        }
        return  $this->db->rowCount();
    }

    public function register($data)
    {
        //mengecek kecocokan password

        if ($data['password1'] != $data['password2']) {
            echo 'password tidak sama';
            return false;
        }

        $this->db->query("SELECT username FROM user WHERE username =  :username");

        $this->db->bind('username',  $data['username']);

        $tes =   $this->db->singleResult();

        $this->db->execute();
        $this->db->rowCount();

        //mengecek apakah username yang di daftarkan oleh user sudah terpakai atau belum
        if ($tes) {
            return false;
        }
        //apabila belum ada yang pakai maka masukan kedalam database
        else {
            $data['password'] = password_hash($data['password1'], PASSWORD_DEFAULT);
            $data['status'] = $this->status;
            $query = "INSERT INTO user
             VALUES ('', :username, :nama, :email, :password, :status)";

            $this->db->query($query);
            $this->db->bind('username', $data['username']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('password', $data['password']);
            $this->db->bind('status', $data['status']);

            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    //untuk pencarian email, apabila user lupa passsowrd
    public function getEmail($data)
    {
        if (isset($_POST['cari'])) {

            $username = $data['username'];

            session_start();

            $this->db->query("SELECT username FROM user WHERE username = :username");

            $this->db->bind("username", $username);
            $_SESSION['username'] = $data['username'];


            return $this->db->singleResult();
        }
    }

    //untuk mengganti password baru user
    public function setPassword($data)
    {

        $password1 = $data['password1'];
        $password2 = $data['password2'];
        session_start();
        $username = $_SESSION['username'];

        if (isset($_POST['changePass'])) {
            if ($password1 === $password2) {
                $password1 = password_hash($password1, PASSWORD_DEFAULT);

                $this->db->query("UPDATE user SET password = :password WHERE username = :username");
                $this->db->bind("password", $password1);
                $this->db->bind("username", $username);

                $this->db->execute();
                unset($_SESSION['username']);
                return $this->db->rowCount();
            }
        }
    }

    //untuk mengambil data riwayat transik pembelian tiket user

    public function getRiwayatTransaksi()
    {

        $id_user = $_SESSION['id_user'];
        $query = "SELECT clas.jenis, jadwal.pertandingan, jadwal.tgl, pembayaran.jumlah, pembayaran.hargaTiket, pembayaran.total FROM pembayaran JOIN user on user.id_user = pembayaran.id_user JOIN clas on clas.id_class = pembayaran.id_clas JOIN jadwal ON jadwal.id_jadwal = pembayaran.id_jadwal WHERE user.id_user = :id_user ORDER BY user.id_user";
        $this->db->query($query);
        $this->db->bind("id_user", $id_user);


        return $this->db->resultAll();
    }

    //mengeset pagination
    public function setPagination($url)
    {
        $transaksi = $this->getRiwayatTransaksi();
        $pagination = new Pagination();
        $id_user = $_SESSION['id_user'];


        /*pecah parameter string kedalam bentuk array
        dari halaman=1  menjadi =>  $url[0] = halaman
                                     $url[1] = 1
        */



        $url = explode('=', $url);
        $halamanAktif = (isset($url[1])) ? $url[1] : 1;
        $jumlahDataPerhalaman = 7;

        $awalData = ($halamanAktif - 1) * $jumlahDataPerhalaman;

        $query = "SELECT clas.jenis, jadwal.pertandingan, jadwal.tgl, pembayaran.jumlah, pembayaran.hargaTiket, pembayaran.total FROM pembayaran JOIN user on user.id_user = pembayaran.id_user JOIN clas on clas.id_class = pembayaran.id_clas JOIN jadwal ON jadwal.id_jadwal = pembayaran.id_jadwal WHERE user.id_user = :id_user ORDER BY user.id_user DESC LIMIT $awalData, $jumlahDataPerhalaman";
        $this->db->query($query);
        $this->db->bind("id_user", $id_user);
        $pagination->setPagination($transaksi, $jumlahDataPerhalaman, $halamanAktif, $url);
        return $this->db->resultAll();
    }



    public function getHargaMember()
    {
        $this->db->query("SELECT * FROM tb_hargamember");

        $this->db->execute();
        $this->db->rowCount();
        return $this->db->singleResult();
    }

    //untuk pembayaran member
    public function setBayarMember($data)
    {
        session_start();
        $id_user = $_SESSION['id_user'];

        $bayar = $data['harga'];
        $date = date("Y-n-j");

        $getHarga = $this->getHargaMember();

        //untuk mengecek apakah yang dimasukan user angka atau bukan
        if (is_numeric($bayar)) {

            //untuk mengecek jika angka yang di masukan user lebih besar ata tidak dengan harga yang pendaftaran member
            if ($bayar >= $getHarga['harga']) {
                $kembali = intval($bayar) - intval($getHarga["harga"]);
                $query = "INSERT INTO tb_daftarmember
                VALUES ('', :id_user, :tgl, :harga, :bayar)";

                $this->db->query($query);
                $this->db->bind('id_user', $id_user);
                $this->db->bind('tgl', $date);
                $this->db->bind('harga', $getHarga['harga']);
                $this->db->bind('bayar', $bayar);
                $this->db->execute();

                if ($this->db->rowCount() > 0) {
                    //apabila pembayaran member berhasil maka status berubah menjadi on
                    $this->status = "on";

                    $this->db->query("UPDATE user SET status = :status WHERE id_user = :id_user");
                    $this->db->bind("status", $this->status);
                    $this->db->bind("id_user", $id_user);
                    $this->db->execute();
                    $_SESSION['status'] = $this->status;
                    return $this->db->rowCount();
                }
                return $this->db->rowCount();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
