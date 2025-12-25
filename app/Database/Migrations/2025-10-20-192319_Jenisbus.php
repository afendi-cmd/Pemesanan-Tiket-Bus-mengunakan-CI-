<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jenisbus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_jenisbus' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenisbus');
    }

    public function down()
    {
        $this->forge->dropTable('jenisbus');
    }
}
