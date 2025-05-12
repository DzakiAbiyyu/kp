<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentModel;
use App\Models\GambarModel;
use App\Models\MediaSosialModel;


class Beranda extends BaseController
{

    protected $ContentModel;
    protected $GambarModel;

    protected $mediaModel;

    public function __construct()
    {
        $this->ContentModel = new ContentModel();
        $this->GambarModel = new GambarModel();
        $this->mediaModel  = new MediaSosialModel();
    }

    public function index()
    {
        $data = [

            'konten' => $this->ContentModel->where('slug', 'home_hero')->findAll(),
            'gambar' => $this->GambarModel->where('slug', 'hero_background')->findAll(),
            'media' => $this->mediaModel->findAll()

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

        return redirect()->to('/admin/beranda')->with('success_content', 'Konten berhasil diperbarui!');
    }

    public function editGambar($id)
    {
        $model = new GambarModel();
        $gambar = $model->find($id);

        if (!$gambar) {
            return redirect()->back()->with('error_edit', 'Gambar tidak ditemukan.');
        }

        return view('admin/edit_gambar', ['gambar' => $gambar]);
    }

    public function updateGambar($id)
    {
        $model = new GambarModel();
        $gambar = $model->find($id);

        if (!$gambar) {
            return redirect()->back()->with('error_edit', 'Gambar tidak ditemukan.');
        }

        $fileGambar = $this->request->getFile('gambar');

        // Validasi: hanya JPG
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            if (!in_array($fileGambar->getExtension(), ['jpg', 'jpeg'])) {
                return redirect()->back()->with('error_edit', 'File harus berformat JPG.');
            }

            // Hapus gambar lama jika ada
            if (file_exists(FCPATH . $gambar['gambar'])) {
                unlink(FCPATH . $gambar['gambar']);
            }

            // Simpan gambar baru
            $namaBaru = $fileGambar->getRandomName();
            $fileGambar->move('img/background/', $namaBaru);

            $model->update($id, [
                'gambar' => 'img/background/' . $namaBaru
            ]);

            return redirect()->to('/admin/beranda')->with('success_background', 'Gambar berhasil diperbarui.');
        }

        return redirect()->back()->with('error_edit', 'Gagal mengunggah gambar.');
    }

    public function hapusGambar($id)
    {
        $model = new GambarModel();
        $gambar = $model->find($id);

        if (!$gambar) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
        }

        // Hapus file gambar dari server jika ada
        $path = FCPATH . $gambar['gambar'];
        if (file_exists($path)) {
            unlink($path);
        }

        // Hapus data dari database
        $model->delete($id);

        return redirect()->to('/admin/beranda')->with('success_background', 'Gambar berhasil dihapus.');
    }

    public function tambahGambar()
    {
        return view('admin/tambah_gambar');
    }

    public function simpanGambar()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'gambar' => [
                'label' => 'Gambar',
                'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => 'File gambar wajib diunggah.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in' => 'Gambar harus berformat JPG.',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $fileGambar = $this->request->getFile('gambar');
        $namaBaru = $fileGambar->getRandomName();
        $fileGambar->move('img/background/', $namaBaru);

        $slug = 'hero_background';
        $this->GambarModel->insert([
            'gambar' => 'img/background/' . $namaBaru,
            'slug' => $slug,
        ]);

        return redirect()->to('/admin/beranda')->with('success_background', 'Gambar berhasil ditambahkan.');
    }

    public function tambahMedia()
    {
        return view('admin/beranda/tambah_media');
    }

    public function simpanMedia()
    {
        $mediaModel = new MediaSosialModel();

        $gambar = $this->request->getFile('gambar');
        $gambarName = null;

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/media', $gambarName);
        }

        $mediaModel->save([
            'nama' => $this->request->getPost('nama'),
            'url' => $this->request->getPost('url'),
            'ikon' => $this->request->getPost('ikon'),
            'gambar' => $gambarName ? 'uploads/media/' . $gambarName : null
        ]);

        return redirect()->to('/admin/beranda')->with('success', 'Media sosial berhasil ditambahkan.');
    }

    public function editMedia($id)
    {
        $mediaModel = new MediaSosialModel();
        $media = $mediaModel->find($id);

        if (!$media) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Media sosial tidak ditemukan.');
        }

        return view('admin/beranda/edit_media', ['media' => $media]);
    }

    public function updateMedia($id)
    {
        $mediaModel = new MediaSosialModel();
        $media = $mediaModel->find($id);

        if (!$media) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Media sosial tidak ditemukan.');
        }

        $gambar = $this->request->getFile('gambar');
        $gambarName = $media['gambar']; // default tetap pakai gambar lama

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            if ($media['gambar'] && file_exists($media['gambar'])) {
                unlink($media['gambar']); // hapus gambar lama
            }
            $gambarName = 'uploads/media/' . $gambar->getRandomName();
            $gambar->move('uploads/media', basename($gambarName));
        }

        $mediaModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'url' => $this->request->getPost('url'),
            'ikon' => $this->request->getPost('ikon'),
            'gambar' => $gambarName,
        ]);

        return redirect()->to('/admin/beranda')->with('success', 'Media sosial berhasil diperbarui.');
    }

    public function hapusMedia($id)
    {
        $mediaModel = new MediaSosialModel();
        $media = $mediaModel->find($id);

        if ($media) {
            if ($media['gambar'] && file_exists($media['gambar'])) {
                unlink($media['gambar']);
            }
            $mediaModel->delete($id);
        }

        return redirect()->to('/admin/beranda')->with('success', 'Media sosial berhasil dihapus.');
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
