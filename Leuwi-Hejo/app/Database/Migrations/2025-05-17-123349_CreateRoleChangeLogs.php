<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoleChangeLogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'auto_increment' => true],
            'changed_by'   => ['type' => 'INT', 'constraint' => 11],
            'target_user'  => ['type' => 'INT', 'constraint' => 11],
            'old_roles'    => ['type' => 'TEXT'],
            'new_roles'    => ['type' => 'TEXT'],
            'changed_at'   => ['type' => 'DATETIME', 'null' => true], // ✅ Fix di sini
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('role_change_logs');
    }

    public function down()
    {
        $this->forge->dropTable('role_change_logs');
    }
}
