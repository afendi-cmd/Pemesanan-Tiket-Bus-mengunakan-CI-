<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisbusModel extends Model
{
    protected $table = 'jenisbus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_jenisbus'];
}
