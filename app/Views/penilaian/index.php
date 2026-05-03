<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<form action="<?= site_url('penilaian') ?>" method="post" class="space-y-5">
    <?= csrf_field() ?>
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-slate-600">Isi nilai mentah setiap alternatif terhadap semua kriteria benefit.</p>
        <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-100">
            Simpan Penilaian
        </button>
    </div>

    <section class="rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="sticky left-0 z-10 bg-slate-50 px-5 py-3">Alternatif</th>
                        <?php foreach ($criteria as $criterion): ?>
                            <th class="px-4 py-3 text-right"><?= esc($criterion['kode_kriteria']) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alternatives as $alternative): ?>
                        <?php $alternativeId = (int) $alternative['id_alternatif']; ?>
                        <tr class="border-b border-slate-100 last:border-0">
                            <th class="sticky left-0 z-10 bg-white px-5 py-4 font-medium text-slate-950">
                                <span class="block"><?= esc($alternative['indeks_alternatif']) ?></span>
                                <span class="block max-w-52 truncate text-xs font-normal text-slate-500"><?= esc($alternative['nama']) ?></span>
                            </th>
                            <?php foreach ($criteria as $criterion): ?>
                                <?php $criterionId = (int) $criterion['id_kriteria']; ?>
                                <td class="px-4 py-3">
                                    <input type="number" step="0.01" min="0" name="nilai[<?= $alternativeId ?>][<?= $criterionId ?>]" value="<?= esc($scoreMap[$alternativeId][$criterionId] ?? 0) ?>" class="ms-auto block w-28 rounded-lg border border-slate-300 bg-slate-50 p-2 text-right text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600">
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</form>

<div class="mt-5 rounded-lg border border-slate-200 bg-white p-5 text-sm text-slate-600 shadow-sm">
    <p class="font-semibold text-slate-950">Catatan backend</p>
    <p class="mt-1">Penyimpanan memakai unique key alternatif + kriteria, jadi nilai yang sama akan diperbarui, bukan membuat duplikasi baris.</p>
</div>
<?= $this->endSection() ?>
