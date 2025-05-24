<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GambarModel;

class GalleryAdmin extends BaseController
{
    protected $gambarModel;

    public function __construct()
    {
        $this->gambarModel = new GambarModel();
    }

    public function index()
    {
        $data['title'] = 'Edit Gallery';
        $data['gambar'] = $this->gambarModel->where('slug', 'gallery')->findAll();

        return view('admin/gallery/index', $data);
    }

    public function edit($id)
    {
        $gambar = $this->gambarModel->find($id);
        if (!$gambar || $gambar['slug'] !== 'gallery') {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Gambar',
            'gambar' => $gambar
        ];

        return view('admin/gallery/edit', $data);
    }

    public function update($id)
    {
        $file = $this->request->getFile('gambar');
        $gambarLama = $this->gambarModel->find($id);

        if ($file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama jika ada
            if (file_exists('uploads/gallery/' . $gambarLama['gambar'])) {
                unlink('uploads/gallery/' . $gambarLama['gambar']);
            }

            $namaBaru = $file->getRandomName();
            $file->move('uploads/gallery/', $namaBaru);

            $this->gambarModel->update($id, ['gambar' => $namaBaru]);
        }

        return redirect()->to('/admin/gallery')->with('success', 'Gambar berhasil diperbarui');
    }

    public function delete($id)
    {
        $gambar = $this->gambarModel->find($id);
        if ($gambar) {
            if (file_exists('uploads/gallery/' . $gambar['gambar'])) {
                unlink('uploads/gallery/' . $gambar['gambar']);
            }

            $this->gambarModel->delete($id);
        }

        return redirect()->to('/admin/gallery')->with('success', 'Gambar berhasil dihapus');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Gambar'
        ];
        return view('admin/gallery/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'gambar' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil file gambar
        $file = $this->request->getFile('gambar');
        $newName = $file->getRandomName();

        // Simpan file ke folder public/uploads/gallery/
        $file->move('uploads/gallery', $newName);

        // Simpan data ke database
        $this->gambarModel->insert([
            'gambar' => $newName,
            'slug'   => 'gallery'
        ]);

        return redirect()->to(base_url('admin/gallery'))->with('success', 'Gambar berhasil ditambahkan');
    }
}
