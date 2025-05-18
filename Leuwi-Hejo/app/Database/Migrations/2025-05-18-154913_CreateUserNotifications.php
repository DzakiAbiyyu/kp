<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserNotifications extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'notification_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'is_read' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'read_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('notification_id', 'notifications', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_notifications');
    }

    public function down()
    {
        $this->forge->dropTable('user_notifications');
    }
}
