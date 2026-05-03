<?php

namespace App\Controllers;

use App\Models\AlternatifModel;

class AlternatifController extends BaseController
{
    public function index(): string
    {
        return view('alternatif/index', [
            'title' => 'Data Alternatif',
            'active' => 'alternatif',
            'alternatives' => model(AlternatifModel::class)
                ->orderBy('id_alternatif', 'ASC')
                ->findAll(),
        ]);
    }

    public function store()
    {
        $rules = [
            'indeks_alternatif' => 'required|max_length[20]|is_unique[alternatif.indeks_alternatif]',
            'nama' => 'required|max_length[150]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        model(AlternatifModel::class)->insert([
            'indeks_alternatif' => strtoupper((string) $this->request->getPost('indeks_alternatif')),
            'nama' => trim((string) $this->request->getPost('nama')),
        ]);

        return redirect()->to('/alternatif')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function update(int $id)
    {
        $rules = [
            'indeks_alternatif' => "required|max_length[20]|is_unique[alternatif.indeks_alternatif,id_alternatif,{$id}]",
            'nama' => 'required|max_length[150]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        model(AlternatifModel::class)->update($id, [
            'indeks_alternatif' => strtoupper((string) $this->request->getPost('indeks_alternatif')),
            'nama' => trim((string) $this->request->getPost('nama')),
        ]);

        return redirect()->to('/alternatif')->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        model(AlternatifModel::class)->delete($id);

        return redirect()->to('/alternatif')->with('success', 'Alternatif berhasil dihapus.');
    }
}
