<?php

namespace App\Controllers;

use App\Models\ContentModel;

class Pages extends BaseController
{
    protected $ContentModel;

    public function __construct()
    {
        $this->ContentModel = new ContentModel();
    }


    public function index()
    {
        $ContentModel = new ContentModel();
        $konten = $ContentModel->where('slug', 'home_hero')->first();

<<<<<<< HEAD
        $data = [
            'title' => 'Home | Leuwi Hejo',
            'konten' => $konten
        ];

=======

        $data = [
            'title' => 'Home | Leuwi Hejo',
            'konten' => $konten
        ];

>>>>>>> 2f5f680020df4e91a8ae7f82e79136d0bd0ff7af
        return view('pages/home', $data);
    }

    public function about()
    {
        $ContentModel = new ContentModel();
<<<<<<< HEAD
        $konten = $ContentModel->where('slug', 'siapa_kami')->first();
        $data = [
            'title' => 'About | Leuwi Hejo',
            'konten' => $konten
=======
        $tentang_kami = $ContentModel->where('slug', 'siapa_kami')->first();
        $data = [
            'title' => 'About | Leuwi Hejo',
            'konten' => $tentang_kami

>>>>>>> 2f5f680020df4e91a8ae7f82e79136d0bd0ff7af
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
