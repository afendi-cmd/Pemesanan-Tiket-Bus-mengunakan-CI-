<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyewaModel extends Model
{
   protected $table = 'penyewa';
   protected $primaryKey = 'id';
   protected $allowedFields = ['nama_penyewa', 'alamat', 'no_telp','email', 'password'];

}
