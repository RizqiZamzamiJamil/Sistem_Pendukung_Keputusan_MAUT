<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
    <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">Alternatif</p>
        <p class="mt-2 text-3xl font-semibold text-slate-950"><?= number_format($alternativeCount) ?></p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">Kriteria</p>
        <p class="mt-2 text-3xl font-semibold text-slate-950"><?= number_format($criteriaCount) ?></p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">Penilaian</p>
        <p class="mt-2 text-3xl font-semibold text-slate-950"><?= number_format($scoreCount) ?></p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-slate-500">Total Bobot</p>
        <p class="mt-2 text-3xl font-semibold <?= abs($totalWeight - 1) < 0.00001 ? 'text-emerald-600' : 'text-amber-600' ?>">
            <?= number_format($totalWeight, 2) ?>
        </p>
    </div>
</div>

<div class="mt-6 grid gap-6 xl:grid-cols-[1fr_380px]">
    <section class="rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-5">
            <h2 class="text-base font-semibold text-slate-950">Ranking Teratas</h2>
            <p class="mt-1 text-sm text-slate-500">Hasil dihitung otomatis dari matriks keputusan dan bobot kriteria.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Rank</th>
                        <th class="px-5 py-3">Kode</th>
                        <th class="px-5 py-3">Alternatif</th>
                        <th class="px-5 py-3 text-right">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rankings as $ranking): ?>
                        <tr class="border-b border-slate-100 bg-white last:border-0">
                            <td class="px-5 py-4 font-semibold text-slate-950"><?= esc($ranking['rank']) ?></td>
                            <td class="px-5 py-4"><?= esc($ranking['alternative']['indeks_alternatif']) ?></td>
                            <td class="px-5 py-4 font-medium text-slate-900"><?= esc($ranking['alternative']['nama']) ?></td>
                            <td class="px-5 py-4 text-right font-semibold text-brand-700"><?= number_format($ranking['total'], 4) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <h2 class="text-base font-semibold text-slate-950">Alur Kerja</h2>
        <ol class="relative mt-5 border-s border-slate-200">
            <li class="mb-6 ms-4">
                <div class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-brand-600"></div>
                <h3 class="text-sm font-semibold text-slate-900">Kelola alternatif</h3>
                <p class="text-sm text-slate-500">Daftar kandidat atau objek yang akan dibandingkan.</p>
            </li>
            <li class="mb-6 ms-4">
                <div class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-brand-600"></div>
                <h3 class="text-sm font-semibold text-slate-900">Tentukan kriteria</h3>
                <p class="text-sm text-slate-500">Bobot idealnya berjumlah 1.00 agar hasil mudah dibaca.</p>
            </li>
            <li class="ms-4">
                <div class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-brand-600"></div>
                <h3 class="text-sm font-semibold text-slate-900">Isi penilaian</h3>
                <p class="text-sm text-slate-500">MAUT menghitung normalisasi, perkalian bobot, dan ranking.</p>
            </li>
        </ol>
    </section>
</div>
<?= $this->endSection() ?>
