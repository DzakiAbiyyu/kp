<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaket extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_paket'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'deskripsi'    => ['type' => 'TEXT', 'null' => true],
            'kategori'     => ['type' => 'ENUM', 'constraint' => ['tracking', 'tracking+camping', 'reguler'], 'default' => 'tracking'],
            'harga'        => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true); // primary key
        $this->forge->createTable('paket');
    }

    public function down()
    {
        $this->forge->dropTable('paket');
    }
}
