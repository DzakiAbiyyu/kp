<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;


class AuthSeeder extends Seeder
{
    public function run()
    {
        $group = new GroupModel();
        $group->insertBatch([
            [
                'name' => 'admin',
                'description' => 'Administrator'
            ],
            [
                'name' => 'user',
                'description' => 'Regular user'
            ],
            [
                'super_admin',
                'description' => 'the boss'
            ]
        ]);

        // Menambahkan User Admin
        $users = new UserModel();

        $adminData = [
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => 'admin123',
            'active'   => 1,
        ];

        // Pastikan untuk memeriksa validasi secara manual
        if (!$users->save($adminData)) {
            // Menampilkan pesan error jika validasi gagal
            $errors = $users->errors();
            print_r($errors);  // Cek kesalahan validasi
        }
    }
}
