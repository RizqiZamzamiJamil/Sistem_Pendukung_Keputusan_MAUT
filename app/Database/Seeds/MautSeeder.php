<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MautSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $this->db->table('alternatif')->upsertBatch([
            ['id_alternatif' => 67, 'indeks_alternatif' => 'A1', 'nama' => 'Muhammad Iqbal', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 68, 'indeks_alternatif' => 'A2', 'nama' => 'Lin Almeina Loebis', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 69, 'indeks_alternatif' => 'A3', 'nama' => 'Jeperson Hutahaean', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 70, 'indeks_alternatif' => 'A4', 'nama' => 'Afdhal Syafnur', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 71, 'indeks_alternatif' => 'A5', 'nama' => 'Muhammad Ardiansyah Sembiring', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 72, 'indeks_alternatif' => 'A6', 'nama' => 'Nasrun Marpaung', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 73, 'indeks_alternatif' => 'A7', 'nama' => 'Maulana Dwi Sena', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 74, 'indeks_alternatif' => 'A8', 'nama' => 'Suparmadi', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 75, 'indeks_alternatif' => 'A9', 'nama' => 'Andri Nata', 'created_at' => $now, 'updated_at' => $now],
            ['id_alternatif' => 76, 'indeks_alternatif' => 'A10', 'nama' => 'Akmal', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $this->db->table('kriteria')->upsertBatch([
            ['id_kriteria' => 42, 'keterangan' => 'Penelitian', 'kode_kriteria' => 'C1', 'bobot' => 0.2, 'created_at' => $now, 'updated_at' => $now],
            ['id_kriteria' => 43, 'keterangan' => 'Pengabdian', 'kode_kriteria' => 'C2', 'bobot' => 0.18, 'created_at' => $now, 'updated_at' => $now],
            ['id_kriteria' => 44, 'keterangan' => 'Sinta', 'kode_kriteria' => 'C3', 'bobot' => 0.12, 'created_at' => $now, 'updated_at' => $now],
            ['id_kriteria' => 45, 'keterangan' => 'Scopus', 'kode_kriteria' => 'C4', 'bobot' => 0.12, 'created_at' => $now, 'updated_at' => $now],
            ['id_kriteria' => 46, 'keterangan' => 'Buku', 'kode_kriteria' => 'C5', 'bobot' => 0.14, 'created_at' => $now, 'updated_at' => $now],
            ['id_kriteria' => 47, 'keterangan' => 'HKI', 'kode_kriteria' => 'C6', 'bobot' => 0.13, 'created_at' => $now, 'updated_at' => $now],
            ['id_kriteria' => 48, 'keterangan' => 'Prototype', 'kode_kriteria' => 'C7', 'bobot' => 0.11, 'created_at' => $now, 'updated_at' => $now],
        ]);

        $scores = [
            [67, 42, 3.6], [67, 43, 1.8], [67, 44, 29.3], [67, 45, 0], [67, 46, 60], [67, 47, 20], [67, 48, 24],
            [68, 42, 3.4], [68, 43, 1], [68, 44, 26.3], [68, 45, 40], [68, 46, 0], [68, 47, 0], [68, 48, 0],
            [69, 42, 2.6], [69, 43, 2.1], [69, 44, 28.6], [69, 45, 0], [69, 46, 76], [69, 47, 15], [69, 48, 0],
            [70, 42, 2.1], [70, 43, 1.8], [70, 44, 20], [70, 45, 0], [70, 46, 24], [70, 47, 10], [70, 48, 37.3],
            [71, 42, 8.4], [71, 43, 0.8], [71, 44, 20.3], [71, 45, 0], [71, 46, 24], [71, 47, 5], [71, 48, 0],
            [72, 42, 2.2], [72, 43, 2.4], [72, 44, 25], [72, 45, 0], [72, 46, 4], [72, 47, 10], [72, 48, 24],
            [73, 42, 11.5], [73, 43, 0.4], [73, 44, 36], [73, 45, 0], [73, 46, 0], [73, 47, 0], [73, 48, 0],
            [74, 42, 15], [74, 43, 2.2], [74, 44, 26], [74, 45, 0], [74, 46, 4], [74, 47, 5], [74, 48, 0],
            [75, 42, 9.3], [75, 43, 2.2], [75, 44, 36], [75, 45, 0], [75, 46, 5.3], [75, 47, 10], [75, 48, 4],
            [76, 42, 2.5], [76, 43, 2.2], [76, 44, 52], [76, 45, 0], [76, 46, 0], [76, 47, 0], [76, 48, 0],
        ];

        $rows = array_map(static fn (array $score): array => [
            'id_alternatif' => $score[0],
            'id_kriteria' => $score[1],
            'nilai' => $score[2],
            'created_at' => $now,
            'updated_at' => $now,
        ], $scores);

        $this->db->table('penilaian')->upsertBatch($rows);
    }
}
