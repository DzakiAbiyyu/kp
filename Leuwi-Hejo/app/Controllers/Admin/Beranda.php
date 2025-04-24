<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentModel;


class Beranda extends BaseController
{

    protected $ContentModel;

    public function __construct()
    {
        $this->ContentModel = new ContentModel();
    }

    public function index()
    {
        $data = [
            'konten' => $this->ContentModel->where('slug', 'home_hero')->findAll(),
        ];

        return view('admin/beranda', $data);
    }

    public function edit($slug)
    {
        $data = [
            'konten' => $this->ContentModel->where('slug', $slug)->first(),
        ];

        return view('admin/edit_beranda', $data);
    }

    public function update($slug)
    {
        $this->ContentModel->where('slug', $slug)->set([
            'title' => $this->request->getPost('judul'),
            'body'  => $this->request->getPost('body'),
        ])->update();

        return redirect()->to('/admin/beranda')->with('success', 'Konten berhasil diperbarui!');
    }






    // tentang kamu
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
