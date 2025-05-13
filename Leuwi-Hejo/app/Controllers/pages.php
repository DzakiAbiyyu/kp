<?php

namespace App\Controllers;

use App\Models\ContentModel;
use App\Models\GambarModel;
use App\Models\MediaSosialModel;

class Pages extends BaseController
{
    protected $ContentModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->ContentModel = new ContentModel();
        $this->mediaModel = new MediaSosialModel();
    }


    public function index()
    {
        $ContentModel = new ContentModel();
        $mediaModel = new MediaSosialModel();
        $media = $mediaModel->findAll();
        $konten = $ContentModel->where('slug', 'home_hero')->first();
        // Ambil gambar berdasarkan slug yang relevan
        $slug = 'hero_background';  // Ganti dengan slug sesuai kebutuhan
        $gambarModel = new \App\Models\GambarModel();
        $gambarList = $gambarModel->where('slug', $slug)->findAll();

        // menampilkan icon berdasaran database

        $data = [
            'title' => 'Home | Leuwi Hejo',
            'konten' => $konten,
            'gambarList' => $gambarList,
            'media' => $media
        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $ContentModel = new ContentModel();
        $mediaModel = new MediaSosialModel();
        $media = $mediaModel->findAll();

        $konten = $ContentModel->where('slug', 'siapa_kami')->first();
        $data = [
            'title' => 'About | Leuwi Hejo',
            'konten' => $konten,
            'media' => $media

        ];
        echo view('pages/about', $data);
    }

    public function galery()
    {

        $mediaModel = new MediaSosialModel();
        $media = $mediaModel->findAll();
        $data = [
            'title' => 'Galery | Leuwi Hejo',
            'media' => $media
        ];
        echo view('pages/galery', $data);
    }

    public function pesanTiket()
    {

        $mediaModel = new MediaSosialModel();
        $media = $mediaModel->findAll();
        $data = [
            'title' => 'Pesan-Tiket | Leuwi Hejo',
            'media' => $media
        ];
        echo view('pages/pesanTiket', $data);
    }
}
