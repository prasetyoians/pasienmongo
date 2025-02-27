<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TbTagSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'tag' => 'Teknologi',
            ],
             [
                'tag' => 'Kesehatan',
            ]
            // Tambahkan lebih banyak data jika diperlukan
        ];

        // Menyimpan data ke tb_tag
        $this->db->table('tb_tag')->insertBatch($data);
    
    }
}
