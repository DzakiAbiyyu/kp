<?php

namespace App\Controllers;

use App\Models\ContentModel;
use App\Models\GambarModel;

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
        // Ambil gambar berdasarkan slug yang relevan
        $slug = 'hero_background';  // Ganti dengan slug sesuai kebutuhan
        $gambarModel = new \App\Models\GambarModel();
        $gambarList = $gambarModel->where('slug', $slug)->findAll();


        $data = [
            'title' => 'Home | Leuwi Hejo',
            'konten' => $konten,
            'gambarList' => $gambarList,
        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $ContentModel = new ContentModel();

        $konten = $ContentModel->where('slug', 'siapa_kami')->first();
        $data = [
            'title' => 'About | Leuwi Hejo',
            'konten' => $konten

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