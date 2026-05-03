<?php

namespace App\Controllers;

use App\Services\MautCalculator;

class PerhitunganController extends BaseController
{
    public function index(): string
    {
        return view('perhitungan/index', [
            'title' => 'Perhitungan MAUT',
            'active' => 'perhitungan',
            'calculation' => (new MautCalculator())->calculate(),
        ]);
    }
}
