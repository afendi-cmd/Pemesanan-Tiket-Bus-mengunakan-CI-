<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserNameToUserLogs extends Migration
{
    public function up()
    {
        $fields = [
            'user_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'email'
            ]
        ];
        
        $this->forge->addColumn('user_logs', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user_logs', 'user_name');
    }
}