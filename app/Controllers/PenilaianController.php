<?php

namespace App\Controllers;

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;

class PenilaianController extends BaseController
{
    public function index(): string
    {
        $alternatives = model(AlternatifModel::class)
            ->orderBy('id_alternatif', 'ASC')
            ->findAll();
        $criteria = model(KriteriaModel::class)
            ->orderBy('id_kriteria', 'ASC')
            ->findAll();
        $scores = model(PenilaianModel::class)->findAll();
        $scoreMap = [];

        foreach ($scores as $score) {
            $scoreMap[(int) $score['id_alternatif']][(int) $score['id_kriteria']] = $score['nilai'];
        }

        return view('penilaian/index', [
            'title' => 'Data Penilaian',
            'active' => 'penilaian',
            'alternatives' => $alternatives,
            'criteria' => $criteria,
            'scoreMap' => $scoreMap,
        ]);
    }

    public function save()
    {
        $values = $this->request->getPost('nilai') ?? [];
        $now = date('Y-m-d H:i:s');
        $rows = [];

        foreach ($values as $alternativeId => $criteriaValues) {
            foreach ($criteriaValues as $criterionId => $value) {
                $rows[] = [
                    'id_alternatif' => (int) $alternativeId,
                    'id_kriteria' => (int) $criterionId,
                    'nilai' => (float) $value,
                    'updated_at' => $now,
                    'created_at' => $now,
                ];
            }
        }

        if ($rows !== []) {
            model(PenilaianModel::class)->builder()->upsertBatch($rows);
        }

        return redirect()->to('/penilaian')->with('success', 'Nilai berhasil disimpan.');
    }
}
