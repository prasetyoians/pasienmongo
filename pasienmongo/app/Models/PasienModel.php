<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'tb_pasien';
    protected $primaryKey = 'id_pasien';
    protected $allowedFields = ['nama', 'nik', 'alamat', 'telepon', 'status',];
    
}
