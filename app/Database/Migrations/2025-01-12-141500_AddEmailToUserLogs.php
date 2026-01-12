<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailToUserLogs extends Migration
{
    public function up()
    {
        $fields = [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'user_id'
            ]
        ];
        
        $this->forge->addColumn('user_logs', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user_logs', 'email');
    }
}