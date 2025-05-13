<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaSosialModel extends Model
{
    protected $table      = 'media_sosial';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['nama', 'link', 'icon', 'gambar'];

    // Menambahkan validasi
    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[255]',
        'link' => 'required|valid_url',
        'icon' => 'permit_empty|valid_url',  // validasi untuk URL ikon jika ada
        'gambar' => 'permit_empty|valid_url',  // validasi untuk gambar jika ada
    ];
}
