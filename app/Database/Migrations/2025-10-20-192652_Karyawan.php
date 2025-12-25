<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'idkaryawan' => [
                'type' => 'INT',
                'constraint' =>  11,
                'unsigned' => true,
                'auto_increment' => true, 
            ],
            'idjabatan' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'nama_karyawan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'nohp' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ]
            ]);
    

    $this->forge->addkey('idkaryawan', true);
    $this->forge->addForeignKey('idjabatan', 'jabatan', 'id', 'SET NULL', 'CASCADE');
            $this->forge->createTable('karyawan', true);
    }

    public function down()
    {
        $this->forge->droptable('karyawan', true)  ; 
    }
}
