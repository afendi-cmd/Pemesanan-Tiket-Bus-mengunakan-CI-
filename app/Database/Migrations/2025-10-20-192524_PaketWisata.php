<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaketWisata extends Migration
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
            'nama_paket' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'tujuan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('paket_wisata');
    }

    public function down()
    {
        $this->forge->dropTable('paket_wisata', true);
    }
}
