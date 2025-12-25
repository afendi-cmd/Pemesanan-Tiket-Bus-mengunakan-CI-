<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penyewa extends Migration
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
            'nama_penyewa' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('penyewa');
    }

    public function down()
    {
        $this->forge->dropTable('penyewa');
    }
}
