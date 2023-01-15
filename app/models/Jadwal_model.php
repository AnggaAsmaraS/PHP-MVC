<?php

class Jadwal_model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllJadwalPertandingan()
    {
        session_start();
        $this->db->query('SELECT * FROM jadwal GROUP BY tgl');

        return $this->db->resultAll();
    }
}
