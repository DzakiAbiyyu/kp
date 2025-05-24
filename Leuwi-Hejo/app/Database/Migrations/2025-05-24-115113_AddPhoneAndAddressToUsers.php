<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class AddPhoneAndAddressToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'after'      => 'email', // sesuaikan posisi kolom
                'null'       => true,
            ],
            'address' => [
                'type'       => 'TEXT',
                'after'      => 'phone_number',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['phone_number', 'address']);
    }
}
