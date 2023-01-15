<?php


class Login extends Controller
{

    public function index()
    {


        $this->views('tamplates/header');
        $this->views('login/login');
        $this->views('tamplates/footer');
    }


    public function login()
    {

        // $data['user'] = $this->model('User_model')->getUser();
        if (isset($_POST['submitLogin'])) {

            if ($this->model('User_model')->getLogin($_POST) > 0) {

                header("Location:" . BASEURL . "/user");
            } else {
                Flasher::setFlash("Username atau password", "salah", "danger");
            }
        }
    }
}
