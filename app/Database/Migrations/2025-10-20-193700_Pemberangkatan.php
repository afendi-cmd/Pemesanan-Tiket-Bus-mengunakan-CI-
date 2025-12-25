<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemberangkatan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'idberangkat' => [
                'type' => 'INT',
                'constraint' =>  11,
                'unsigned' => true,
                'auto_increment' => true, 
            ],
            'idpemesanan' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'idbus' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
          'idbus' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'idsopir' => [
               'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'idkernet' => [
               'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'tanggalberangkat' => [ 
               'type' => 'DATE',
                'null' => true,
            ]]);
              $this->forge->addkey('idberangkat', true);
              $this->forge->addForeignKey('idpemesanan', 'pemesanan', 'id', 'SET NULL', 'CASCADE');
              $this->forge->addForeignKey('idbus', 'bus', 'id', 'SET NULL', 'CASCADE');
              $this->forge->addForeignKey('idsopir', 'karyawan', 'idkaryawan', 'SET NULL', 'CASCADE');
              $this->forge->addForeignKey('idkernet', 'karyawan', 'idkaryawan', 'SET NULL', 'CASCADE');
              $this->forge->createTable('pemberangkatan', true);
    }

    public function down()
    {
        $this->forge->droptable('pemberangkatan', true);
    }
}
