<?php

namespace App\Controllers;
use App\Models\ContentModel;

class Pages extends BaseController
{
    public function index()
{
    $ContentModel = new ContentModel();
    $konten = $ContentModel->where('slug', 'home_hero')->first();

    $data = [
        'title' => 'Home | Leuwi Hejo',
        'konten' => $konten
    ];

    return view('pages/home', $data);
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
