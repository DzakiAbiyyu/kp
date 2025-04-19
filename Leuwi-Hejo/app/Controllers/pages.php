<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Leuwi Hejo'
        ];
        echo view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About | Leuwi Hejo'
        ];
        echo view('pages/about', $data);
    }

    public function galery()
    {
        $data = [
            'title' => 'Galery | Leuwi Hejo'
        ];
        echo view('pages/galery', $data);
    }

    public function pesanTiket()
    {
        $data = [
            'title' => 'Pesan-Tiket | Leuwi Hejo'
        ];
        echo view('pages/pesanTiket', $data);
    }
}
