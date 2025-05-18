<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SeederCategories extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Camping',
                'slug' => 'camping',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'name' => 'Camping Non Tenda',
                'slug' => 'camping-non-tenda',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'name' => 'Trekking',
                'slug' => 'trekking',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'name' => 'Reguler',
                'slug' => 'reguler',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'name' => 'Persewaan Perlengkapan',
                'slug' => 'persewaan-perlengkapan',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
