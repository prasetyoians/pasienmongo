<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
  protected $table = 'tb_tag';
    protected $primaryKey = 'id_tag';
    protected $allowedFields = ['tag'];
    
    // Tambahkan fungsi atau logika tambahan jika perlu
}
