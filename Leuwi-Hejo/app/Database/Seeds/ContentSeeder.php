<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'slug'  => 'home_hero',
            'title' => 'Rasakan Kedamaian di Tengah Alam Bogor',
            'body'  => 'Ajak keluarga dan temanmu, ciptakan momen indah bersama alam.',
        ];

        $this->db->table('contents')->insert($data);
    }
}
