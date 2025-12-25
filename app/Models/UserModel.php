<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = ''; // kosongkan
    protected $primaryKey = ''; // kosongkan

    public function findUserByCredential($identifier)
    {
        // Cek di tabel karyawan
        $karyawan = $this->db->table('karyawan')
            ->where('email', $identifier)
            ->get()
            ->getRowArray();

        if ($karyawan) {
            return [
                'id'          => $karyawan['idkaryawan'],
                'nama_karyawan' => $karyawan['nama_karyawan'],
                'email'       => $karyawan['email'],
                'password'    => $karyawan['password'],
                'source'      => 'karyawan',
                'data'        => $karyawan
            ];
        }

        // Cek di tabel penyewa
        $penyewa = $this->db->table('penyewa')
            ->where('email', $identifier)
            ->get()
            ->getRowArray();

        if ($penyewa) {
            return [
                'id'            => $penyewa['id'],
                'nama_penyewa'  => $penyewa['nama_penyewa'],
                'email'         => $penyewa['email'],
                'password'      => $penyewa['password'],
                'source'        => 'penyewa',
                'data'          => $penyewa
            ];
        }

        return null;
    }


    /** Verifikasi password */
    public function verifyPassword($stored, $password)
    {
        if (!$stored) {
            return false;
        }

        return password_verify($password, $stored);
    }
}
