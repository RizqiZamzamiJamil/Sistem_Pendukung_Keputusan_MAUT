<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = ['id_alternatif', 'id_kriteria', 'nilai'];
    protected $useTimestamps = true;
    protected $returnType = 'array';
}
