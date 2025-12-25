<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bus extends Migration
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
            'nomor_polisi' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'merek' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'kapasitas' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'id_jenisbus' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_jenisbus', 'jenisbus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bus');
    }

    public function down()
    {
        $this->forge->dropTable('bus');
    }
}
