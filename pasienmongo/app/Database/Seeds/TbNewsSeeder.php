<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TbNewsSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'title' => 'Berita Pertama',
                'id_tag' => '1',
                'author' => 'Penulis A',
                'content' => 'Ini adalah konten berita pertama.',
                'status' => 'published',
            ],
            [
                'title' => 'Berita Kedua',
                'id_tag' => '2',
                'author' => 'Penulis B',
                'content' => 'Ini adalah konten berita kedua.',
                'status' => 'draft',
            ],
            // Tambahkan lebih banyak data jika diperlukan
        ];

        // Menyimpan data ke tb_news
        $this->db->table('tb_news')->insertBatch($data);
    }
}
