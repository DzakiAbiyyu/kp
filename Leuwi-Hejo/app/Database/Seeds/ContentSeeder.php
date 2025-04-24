<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('contents')->truncate(); // Bersihkan isi tabel dulu

        $data = [
            [
                'slug'  => 'home_hero',
                'title' => 'Rasakan Kedamaian di Tengah Alam Bogor',
                'body'  => 'Ajak keluarga dan temanmu, ciptakan momen indah bersama alam.',
            ],
            [
                'slug'  => 'siapa_kami',
                'title' => 'Siapa Kami ?',
                'body'  => 'Ini adalah isi dari konten siapa kami',
            ]
        ];

        $this->db->table('contents')->insertBatch($data);
    }
}
