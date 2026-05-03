<?php

namespace App\Controllers;

use App\Models\KriteriaModel;

class KriteriaController extends BaseController
{
    public function index(): string
    {
        $criteria = model(KriteriaModel::class)
            ->orderBy('id_kriteria', 'ASC')
            ->findAll();

        return view('kriteria/index', [
            'title' => 'Data Kriteria',
            'active' => 'kriteria',
            'criteria' => $criteria,
            'totalWeight' => array_sum(array_column($criteria, 'bobot')),
        ]);
    }

    public function store()
    {
        $rules = [
            'kode_kriteria' => 'required|max_length[20]|is_unique[kriteria.kode_kriteria]',
            'keterangan' => 'required|max_length[150]',
            'bobot' => 'required|numeric|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        model(KriteriaModel::class)->insert([
            'kode_kriteria' => strtoupper((string) $this->request->getPost('kode_kriteria')),
            'keterangan' => trim((string) $this->request->getPost('keterangan')),
            'bobot' => (float) $this->request->getPost('bobot'),
        ]);

        return redirect()->to('/kriteria')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function update(int $id)
    {
        $rules = [
            'kode_kriteria' => "required|max_length[20]|is_unique[kriteria.kode_kriteria,id_kriteria,{$id}]",
            'keterangan' => 'required|max_length[150]',
            'bobot' => 'required|numeric|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        model(KriteriaModel::class)->update($id, [
            'kode_kriteria' => strtoupper((string) $this->request->getPost('kode_kriteria')),
            'keterangan' => trim((string) $this->request->getPost('keterangan')),
            'bobot' => (float) $this->request->getPost('bobot'),
        ]);

        return redirect()->to('/kriteria')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        model(KriteriaModel::class)->delete($id);

        return redirect()->to('/kriteria')->with('success', 'Kriteria berhasil dihapus.');
    }
}
