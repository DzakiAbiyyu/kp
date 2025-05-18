<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table = 'paket';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'category_id',
        'nama_paket',
        'deskripsi',
        'fasilitas',
        'fitur_tambahan',
        'gambar'
    ];
    protected $useTimestamps = true;

    public function withCategories()
    {
        return $this->select('paket.*, categories.name as kategori')
            ->join('categories', 'categories.id = paket.category_id');
    }
}
