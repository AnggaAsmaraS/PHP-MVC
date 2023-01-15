<?php


class Home extends Controller
{
    public function index()
    {

        $data['jadwal'] = $this->model('jadwal_model')->getAllJadwalPertandingan();
        $this->views('tamplates/header');
        $this->views('home/index', $data);
        $this->views('tamplates/footer');
    }

    public function logout()
    {


        $data['jadwal'] = $this->model('jadwal_model')->getAllJadwalPertandingan();
        $this->views('tamplates/header');
        $this->views('home/index', $data);
        $this->views('tamplates/footer');
        unset($_SESSION['login']);
        session_destroy();
    }
}
