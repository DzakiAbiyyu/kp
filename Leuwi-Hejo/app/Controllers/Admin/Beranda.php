<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentModel;
use App\Models\GambarModel;


class Beranda extends BaseController
{

    protected $ContentModel;
    protected $GambarModel;

    public function __construct()
    {
        $this->ContentModel = new ContentModel();
        $this->GambarModel = new GambarModel();
    }

    public function index()
    {
        $data = [

            'konten' => $this->ContentModel->where('slug', 'home_hero')->findAll(),
            'gambar' => $this->GambarModel->where('slug', 'hero_background')->findAll()

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

    public function editGambar($slug)
    {
        $gambar = $this->GambarModel->where('slug', $slug)->first();

        if (!$gambar) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
        }

        return view('admin/edit_gambar', ['gambar' => $gambar]);
    }

    public function updateGambar($slug)
    {
        $gambar = $this->GambarModel->where('slug', $slug)->first();

        if (!$gambar) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
        }

        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // Hapus gambar lama
            if (file_exists(FCPATH . $gambar['gambar'])) {
                unlink(FCPATH . $gambar['gambar']);
            }

            // Upload gambar baru
            $namaBaru = $fileGambar->getRandomName();
            $fileGambar->move('img/background/', $namaBaru);

            $this->GambarModel->update($gambar['id'], [
                'gambar' => 'img/background/' . $namaBaru
            ]);

            return redirect()->to('/admin/beranda')->with('success', 'Gambar berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui gambar.');
    }

    public function hapusGambar($slug)
    {
        $gambar = $this->GambarModel->where('slug', $slug)->first();

        if ($gambar) {
            if (file_exists(FCPATH . $gambar['gambar'])) {
                unlink(FCPATH . $gambar['gambar']);
            }

            $this->GambarModel->delete($gambar['id']);
            return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
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
