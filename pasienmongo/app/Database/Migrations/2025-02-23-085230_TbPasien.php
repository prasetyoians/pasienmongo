<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPasien extends Migration
{
   public function up()
    {
        $this->forge->addField([
            'id_pasien'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
           
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'nik'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'alamat' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'telepon' => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
            ],
            'status'      => [
                'type'           => 'ENUM',
                'constraint'     => ['rawat inap', 'rawat jalan'],
                
            ],
           
        ]);

        // Membuat primary key
        $this->forge->addKey('id_pasien', TRUE);

        // Membuat tabel
        $this->forge->createTable('tb_pasien');
        
    }

    public function down()
    {
        // Menghapus tabel tb_news
        $this->forge->dropTable('tb_pasien');
    }
}
