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
<<<<<<< HEAD

        return view('admin/edit_tentang_kami', $data);
    }

=======
        return view('admin/edit_tentang_kami', $data);
    }
>>>>>>> 2f5f680020df4e91a8ae7f82e79136d0bd0ff7af
    public function update($slug)
    {
        $this->ContentModel->where('slug', $slug)->set([
            'title' => $this->request->getPost('judul'),
            'body'  => $this->request->getPost('body'),
        ])->update();
<<<<<<< HEAD

=======
>>>>>>> 2f5f680020df4e91a8ae7f82e79136d0bd0ff7af
        return redirect()->to('/admin/tentang_kami')->with('success', 'Konten berhasil diperbarui!');
    }
}
