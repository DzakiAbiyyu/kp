<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class Beranda extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Beranda'
        ];

        return view('admin/beranda', $data);
    }

    public function tentang_kami()
    {
        $data = [
            'title' => 'Manajemen Tentang - Kami'
        ];

        return view('admin/tentang_kami', $data);
    }

    public function galery()
    {
        $data = [
            'title' => 'Manajemen Galery'
        ];

        return view('admin/galery', $data);
    }

    public function produk_paket()
    {
        $data = [
            'title' => 'Manajemen Produk - Paket'
        ];

        return view('admin/produk_paket', $data);
    }
}
