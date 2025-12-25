<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketWisataModel extends Model
{
   protected $table = 'paket_wisata';
   protected $primaryKey = 'id';
   protected $allowedFields = ['nama_paket', 'harga', 'tujuan'];

   public function getPaketWisata()
   {
       return $this-> select ('*')
                   ->findAll(); 
   }
}
