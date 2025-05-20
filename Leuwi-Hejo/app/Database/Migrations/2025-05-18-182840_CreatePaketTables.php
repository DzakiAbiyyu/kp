<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaketTables extends Migration
{
    public function up()
    {
        // Tabel kategori
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'slug'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');

        // Tabel paket
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'auto_increment' => true],
            'category_id'    => ['type' => 'INT'],
            'nama_paket'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi'      => ['type' => 'TEXT'],
            'fasilitas'      => ['type' => 'TEXT'],
            'fitur_tambahan' => ['type' => 'TEXT', 'null' => true],
            'gambar'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('paket');

        // Tabel harga per kapasitas
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'auto_increment' => true],
            'paket_id'  => ['type' => 'INT'],
            'kapasitas' => ['type' => 'VARCHAR', 'constraint' => 50],
            'harga'     => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('paket_id', 'paket', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('harga_paket');
    }

    public function down()
    {
        $this->forge->dropTable('harga_paket');
        $this->forge->dropTable('paket');
        $this->forge->dropTable('categories');
    }
}
