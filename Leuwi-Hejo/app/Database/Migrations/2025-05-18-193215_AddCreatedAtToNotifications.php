<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedAtToNotifications extends Migration
{
    public function up()
    {


        $this->forge->addColumn('user_notifications', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'is_read'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user_notifications', 'created_at');
    }
}
