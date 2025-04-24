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
}
