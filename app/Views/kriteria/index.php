<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-slate-600">Bobot dipakai untuk mengalikan nilai normalisasi setiap kriteria.</p>
        <p class="mt-1 text-sm <?= abs($totalWeight - 1) < 0.00001 ? 'text-emerald-700' : 'text-amber-700' ?>">Total bobot saat ini: <?= number_format($totalWeight, 2) ?></p>
    </div>
    <button data-modal-target="add-criterion-modal" data-modal-toggle="add-criterion-modal" type="button" class="inline-flex items-center justify-center rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-100">
        Tambah Kriteria
    </button>
</div>

<section class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Kriteria</th>
                    <th class="px-5 py-3 text-right">Bobot</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($criteria as $criterion): ?>
                    <?php $id = (int) $criterion['id_kriteria']; ?>
                    <tr class="border-b border-slate-100 last:border-0">
                        <td class="px-5 py-4 font-semibold text-slate-950"><?= esc($criterion['kode_kriteria']) ?></td>
                        <td class="px-5 py-4"><?= esc($criterion['keterangan']) ?></td>
                        <td class="px-5 py-4 text-right font-semibold text-slate-950"><?= number_format((float) $criterion['bobot'], 2) ?></td>
                        <td class="px-5 py-4 text-right">
                            <button data-modal-target="edit-criterion-<?= $id ?>" data-modal-toggle="edit-criterion-<?= $id ?>" type="button" class="me-2 rounded-lg border border-slate-200 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50">Edit</button>
                            <button data-modal-target="delete-criterion-<?= $id ?>" data-modal-toggle="delete-criterion-<?= $id ?>" type="button" class="rounded-lg border border-red-200 px-3 py-2 text-xs font-medium text-red-700 hover:bg-red-50">Hapus</button>
                        </td>
                    </tr>

                    <div id="edit-criterion-<?= $id ?>" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-full max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                        <div class="relative max-h-full w-full max-w-md p-4">
                            <form action="<?= site_url('kriteria/' . $id) ?>" method="post" class="relative rounded-lg bg-white shadow">
                                <?= csrf_field() ?>
                                <div class="flex items-center justify-between border-b border-slate-200 p-4">
                                    <h3 class="text-base font-semibold text-slate-950">Edit Kriteria</h3>
                                    <button type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-900" data-modal-hide="edit-criterion-<?= $id ?>">
                                        <span class="sr-only">Tutup</span>
                                        <svg class="h-3 w-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="space-y-4 p-4">
                                    <label class="block">
                                        <span class="mb-2 block text-sm font-medium text-slate-900">Kode</span>
                                        <input name="kode_kriteria" value="<?= esc($criterion['kode_kriteria']) ?>" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                                    </label>
                                    <label class="block">
                                        <span class="mb-2 block text-sm font-medium text-slate-900">Keterangan</span>
                                        <input name="keterangan" value="<?= esc($criterion['keterangan']) ?>" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                                    </label>
                                    <label class="block">
                                        <span class="mb-2 block text-sm font-medium text-slate-900">Bobot</span>
                                        <input name="bobot" type="number" step="0.01" min="0" value="<?= esc($criterion['bobot']) ?>" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                                    </label>
                                </div>
                                <div class="flex justify-end gap-2 border-t border-slate-200 p-4">
                                    <button type="button" data-modal-hide="edit-criterion-<?= $id ?>" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</button>
                                    <button type="submit" class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="delete-criterion-<?= $id ?>" tabindex="-1" class="fixed left-0 right-0 top-0 z-50 hidden h-full max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                        <div class="relative max-h-full w-full max-w-md p-4">
                            <div class="relative rounded-lg bg-white p-5 shadow">
                                <h3 class="text-base font-semibold text-slate-950">Hapus kriteria?</h3>
                                <p class="mt-2 text-sm text-slate-500">Data penilaian untuk <?= esc($criterion['keterangan']) ?> ikut terhapus karena relasi database.</p>
                                <form action="<?= site_url('kriteria/' . $id . '/delete') ?>" method="post" class="mt-5 flex justify-end gap-2">
                                    <?= csrf_field() ?>
                                    <button type="button" data-modal-hide="delete-criterion-<?= $id ?>" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</button>
                                    <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<div id="add-criterion-modal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-full max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
    <div class="relative max-h-full w-full max-w-md p-4">
        <form action="<?= site_url('kriteria') ?>" method="post" class="relative rounded-lg bg-white shadow">
            <?= csrf_field() ?>
            <div class="flex items-center justify-between border-b border-slate-200 p-4">
                <h3 class="text-base font-semibold text-slate-950">Tambah Kriteria</h3>
                <button type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-900" data-modal-hide="add-criterion-modal">
                    <span class="sr-only">Tutup</span>
                    <svg class="h-3 w-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <div class="space-y-4 p-4">
                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-900">Kode</span>
                    <input name="kode_kriteria" value="<?= old('kode_kriteria') ?>" placeholder="C8" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                </label>
                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-900">Keterangan</span>
                    <input name="keterangan" value="<?= old('keterangan') ?>" placeholder="Nama kriteria" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                </label>
                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-900">Bobot</span>
                    <input name="bobot" type="number" step="0.01" min="0" value="<?= old('bobot') ?>" placeholder="0.10" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                </label>
            </div>
            <div class="flex justify-end gap-2 border-t border-slate-200 p-4">
                <button type="button" data-modal-hide="add-criterion-modal" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</button>
                <button type="submit" class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
