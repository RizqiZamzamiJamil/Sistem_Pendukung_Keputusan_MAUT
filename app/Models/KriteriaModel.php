<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $allowedFields = ['keterangan', 'kode_kriteria', 'bobot'];
    protected $useTimestamps = true;
    protected $returnType = 'array';
}
