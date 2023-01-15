<?php

class Controller
{

    //untuk memanggil folder views
    public function views($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    //untuk memanggil folder models
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';

        return new $model;
    }

    //untuk mengecek setiap halaman, memiliki session login atau tidak
    public function sessionLogin()
    {
        session_start();
        if (!isset($_SESSION['login'])) {
            header("Location: " . BASEURL . "/index");
        }
    }
    // untuk mensetting menjadi nilai rupiah
    public function rupiah($nilai = 0)
    {
        $string = "Rp, " . number_format($nilai);
        return $string;
    }
}
