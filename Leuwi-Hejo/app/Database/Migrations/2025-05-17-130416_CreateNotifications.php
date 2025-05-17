<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotifications extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'message'    => ['type' => 'TEXT'],
            'icon'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'type'       => ['type' => 'VARCHAR', 'constraint' => 50], // info, warning, success, danger
            'is_read'    => ['type' => 'BOOLEAN', 'default' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications');
    }
}
