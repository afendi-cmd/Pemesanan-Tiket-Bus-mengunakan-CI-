<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaketBus extends Migration
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
            'id_paketwisata' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'id_bus' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_paketwisata', 'paket_wisata', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_bus', 'bus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('paket_bus');
    }

    public function down()
    {
        $this->forge->dropTable('paket_bus');
    }
}
