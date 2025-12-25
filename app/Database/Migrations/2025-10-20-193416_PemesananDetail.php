<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PemesananDetail extends Migration
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
            'id_pemesanan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'tanggal_berangkat' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'tanggal_kembali' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jumlah_penumpang' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pemesanan', 'pemesanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pemesanan_detail');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanan_detail');
    }
}
