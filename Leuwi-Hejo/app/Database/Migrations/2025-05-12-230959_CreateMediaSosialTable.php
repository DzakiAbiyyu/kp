<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMediaSosialTable extends Migration
{
    public function up()
    {
        // Membuat tabel media_sosial
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'link'        => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'icon'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
                'default'        => null,  // Ikon font atau link gambar
            ],
            'gambar'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
                'default'        => null,  // URL gambar media sosial
            ],
            'created_at'  => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'  => [
                'type'           => 'DATETIME',
                'null'           => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('media_sosial');
    }

    public function down()
    {
        // Drop tabel media_sosial jika rollback migration
        $this->forge->dropTable('media_sosial');
    }
}
