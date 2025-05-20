<?php

namespace App\Models;

use CodeIgniter\Model;

class HargaPaketModel extends Model
{
    protected $table = 'harga_paket';
    protected $primaryKey = 'id';
    protected $allowedFields = ['paket_id', 'kapasitas', 'harga'];
}
