<?php



class Register extends Controller
{

    public function index()
    {
        $this->views('tamplates/header');
        $this->views('register/register');
        $this->views('tamplates/footer');
    }

    public function prosesRegister()
    {
        if ($this->model('User_model')->register($_POST) > 0) {
            Flasher::setFlash("Berhasil", "Mendaftar", "success");
            header('Location:' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash("gagal", ", username sudah ada", "danger");
            header('Location:' . BASEURL . '/register/register');
        }
    }
}
