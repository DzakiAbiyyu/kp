<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActorIdToNotifications extends Migration
{
    public function up()
    {
        $this->forge->addColumn('notifications', [
            'actor_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'id'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('notifications', 'actor_id');
    }
}
