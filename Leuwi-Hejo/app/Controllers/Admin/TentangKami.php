<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentModel;


class TentangKami extends BaseController
{


    // tentang kami
    protected $ContentModel;
    public function __construct()
    {
        $this->ContentModel = new ContentModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Manajemen Tentang - Kami',
            'konten' => $this->ContentModel->where('slug', 'siapa_kami')->findAll()
        ];

        return view('admin/tentang_kami', $data);
    }
    public function edit($slug)
    {
        $data = [
            'konten' => $this->ContentModel->where('slug', $slug)->first(),
        ];
        return view('admin/edit_tentang_kami', $data);
    }
    public function update($slug)
    {
        $this->ContentModel->where('slug', $slug)->set([
            'title' => $this->request->getPost('judul'),
            'body'  => $this->request->getPost('body'),
        ])->update();
        return redirect()->to('/admin/tentang_kami')->with('success', 'Konten berhasil diperbarui!');
    }
}
