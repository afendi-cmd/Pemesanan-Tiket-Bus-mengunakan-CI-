<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jabatan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id' => [
                'type' => 'INT',
                'constraint' =>  11,
                'unsigned' => true,
                'auto_increment' => true, 
            ],
            'namajabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
             ]
            ]);
    

    $this->forge->addKey('id', true);
    $this->forge->createTable('jabatan', true);
    }

    public function down()
    {
        $this->forge->dropTable('jabatan', true);
    }
}
