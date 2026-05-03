<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<?php
$alternatives = $calculation['alternatives'];
$criteria = $calculation['criteria'];
$decisionMatrix = $calculation['decisionMatrix'];
$normalizedMatrix = $calculation['normalizedMatrix'];
$weightedMatrix = $calculation['weightedMatrix'];
$rankings = $calculation['rankings'];
?>

<div class="mb-5 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-base font-semibold text-slate-950">Ringkasan Perhitungan</h2>
            <p class="mt-1 text-sm text-slate-500">Rumus normalisasi benefit: (nilai - min) / (max - min), lalu dikalikan bobot kriteria.</p>
        </div>
        <span class="inline-flex w-fit items-center rounded-lg bg-brand-50 px-3 py-2 text-sm font-medium text-brand-700">Total bobot <?= number_format($calculation['totalWeight'], 2) ?></span>
    </div>
</div>

<div class="mb-4 border-b border-slate-200">
    <ul id="calculation-tabs" data-tabs-toggle="#calculation-tab-content" role="tablist" class="-mb-px flex flex-wrap text-center text-sm font-medium">
        <li class="me-2" role="presentation">
            <button class="inline-block rounded-t-lg border-b-2 p-4" id="ranking-tab" data-tabs-target="#ranking" type="button" role="tab" aria-controls="ranking" aria-selected="true">Ranking</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block rounded-t-lg border-b-2 p-4" id="matrix-tab" data-tabs-target="#matrix" type="button" role="tab" aria-controls="matrix" aria-selected="false">Matriks</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block rounded-t-lg border-b-2 p-4" id="normalization-tab" data-tabs-target="#normalization" type="button" role="tab" aria-controls="normalization" aria-selected="false">Normalisasi</button>
        </li>
        <li role="presentation">
            <button class="inline-block rounded-t-lg border-b-2 p-4" id="weighted-tab" data-tabs-target="#weighted" type="button" role="tab" aria-controls="weighted" aria-selected="false">Perkalian Bobot</button>
        </li>
    </ul>
</div>

<div id="calculation-tab-content">
    <section id="ranking" role="tabpanel" aria-labelledby="ranking-tab" class="rounded-lg border border-slate-200 bg-white shadow-sm">
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
                        <tr class="border-b border-slate-100 last:border-0">
                            <td class="px-5 py-4 font-semibold text-slate-950"><?= esc($ranking['rank']) ?></td>
                            <td class="px-5 py-4"><?= esc($ranking['alternative']['indeks_alternatif']) ?></td>
                            <td class="px-5 py-4 font-medium text-slate-900"><?= esc($ranking['alternative']['nama']) ?></td>
                            <td class="px-5 py-4 text-right font-semibold text-brand-700"><?= number_format($ranking['total'], 6) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="matrix" role="tabpanel" aria-labelledby="matrix-tab" class="hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <?= view('perhitungan/table', ['alternatives' => $alternatives, 'criteria' => $criteria, 'matrix' => $decisionMatrix, 'precision' => 2]) ?>
    </section>

    <section id="normalization" role="tabpanel" aria-labelledby="normalization-tab" class="hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <?= view('perhitungan/table', ['alternatives' => $alternatives, 'criteria' => $criteria, 'matrix' => $normalizedMatrix, 'precision' => 4]) ?>
    </section>

    <section id="weighted" role="tabpanel" aria-labelledby="weighted-tab" class="hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <?= view('perhitungan/table', ['alternatives' => $alternatives, 'criteria' => $criteria, 'matrix' => $weightedMatrix, 'precision' => 6]) ?>
    </section>
</div>
<?= $this->endSection() ?>
