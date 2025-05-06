<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGambarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slug'    => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'gambar'  => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->createTable('gambar');
    }

    public function down()
    {
        $this->forge->dropTable('gambar');
    }
}
