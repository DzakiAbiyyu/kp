<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MediaSosialSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'  => 'Facebook',
                'link'  => 'https://www.facebook.com',
                'icon'  => 'https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg',
                'gambar' => 'https://example.com/facebook-background.jpg',
            ],
            [
                'nama'  => 'Twitter',
                'link'  => 'https://www.twitter.com',
                'icon'  => 'https://upload.wikimedia.org/wikipedia/commons/6/60/Twitter_Logo_2021.svg',
                'gambar' => 'https://example.com/twitter-background.jpg',
            ],
            [
                'nama'  => 'Instagram',
                'link'  => 'https://www.instagram.com',
                'icon'  => 'https://upload.wikimedia.org/wikipedia/commons/9/95/Instagram_logo_2022.svg',
                'gambar' => 'https://example.com/instagram-background.jpg',
            ],
            [
                'nama'  => 'LinkedIn',
                'link'  => 'https://www.linkedin.com',
                'icon'  => 'https://upload.wikimedia.org/wikipedia/commons/0/01/LinkedIn_Logo_2019.svg',
                'gambar' => 'https://example.com/linkedin-background.jpg',
            ],
        ];

        // Insert data ke dalam tabel media_sosial
        $this->db->table('media_sosial')->insertBatch($data);
    }
}
