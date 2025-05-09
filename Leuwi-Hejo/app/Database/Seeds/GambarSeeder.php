<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GambarSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('gambar')->truncate();

        $data = [
            [
                'slug'  => 'hero_background',
                'gambar' => 'img/background/1746624264_694a40c1165bd98036a8.png'
            
            ],
            [
                'slug'  => 'hero_background',
                'gambar' => 'img/background/dua.jpg',
            ],
            [
                'slug'  => 'hero_background',
                'gambar' => 'img/background/tiga.jpg',
            ]
        ];

        $this->db->table('gambar')->insertBatch($data);
    }
}
