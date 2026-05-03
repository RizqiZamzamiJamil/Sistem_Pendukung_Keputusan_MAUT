<?php

namespace App\Controllers;

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Services\MautCalculator;

class Home extends BaseController
{
    public function index(): string
    {
        $calculation = (new MautCalculator())->calculate();

        return view('dashboard/index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'alternativeCount' => model(AlternatifModel::class)->countAllResults(),
            'criteriaCount' => model(KriteriaModel::class)->countAllResults(),
            'scoreCount' => model(PenilaianModel::class)->countAllResults(),
            'rankings' => array_slice($calculation['rankings'], 0, 5),
            'totalWeight' => $calculation['totalWeight'],
        ]);
    }
}
