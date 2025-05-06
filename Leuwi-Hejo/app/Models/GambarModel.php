<?php

namespace App\Models;

use CodeIgniter\Model;

class GambarModel extends Model
{
    protected $table = 'gambar'; // Replace 'gambar' with your actual table name

    // Optionally, you can set primary key if it's different from the default 'id'
    protected $primaryKey = 'id';

    // You can also specify allowed fields for mass assignment
    protected $allowedFields = ['slug', 'gambar', 'created_at'];

    // If your model uses timestamps, enable this:
    protected $useTimestamps = true;
    public function tampil($slug)
    {
        $model = new GambarModel();

        $data['gambar'] = $model->where('slug', $slug)->first();

        if (!$data['gambar']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Gambar dengan slug '$slug' tidak ditemukan.");
        }

        return view('gambar/tampil', $data);
    }
}