<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-slate-600">Kelola kandidat/objek yang akan diproses dalam metode MAUT.</p>
    <button data-modal-target="add-alternative-modal" data-modal-toggle="add-alternative-modal" type="button" class="inline-flex items-center justify-center rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-4 focus:ring-brand-100">
        Tambah Alternatif
    </button>
</div>

<section class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Nama</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alternatives as $alternative): ?>
                    <?php $id = (int) $alternative['id_alternatif']; ?>
                    <tr class="border-b border-slate-100 last:border-0">
                        <td class="px-5 py-4 font-semibold text-slate-950"><?= esc($alternative['indeks_alternatif']) ?></td>
                        <td class="px-5 py-4"><?= esc($alternative['nama']) ?></td>
                        <td class="px-5 py-4 text-right">
                            <button data-modal-target="edit-alternative-<?= $id ?>" data-modal-toggle="edit-alternative-<?= $id ?>" type="button" class="me-2 rounded-lg border border-slate-200 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-100">
                                Edit
                            </button>
                            <button data-modal-target="delete-alternative-<?= $id ?>" data-modal-toggle="delete-alternative-<?= $id ?>" type="button" class="rounded-lg border border-red-200 px-3 py-2 text-xs font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-4 focus:ring-red-100">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <div id="edit-alternative-<?= $id ?>" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-full max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                        <div class="relative max-h-full w-full max-w-md p-4">
                            <form action="<?= site_url('alternatif/' . $id) ?>" method="post" class="relative rounded-lg bg-white shadow">
                                <?= csrf_field() ?>
                                <div class="flex items-center justify-between border-b border-slate-200 p-4">
                                    <h3 class="text-base font-semibold text-slate-950">Edit Alternatif</h3>
                                    <button type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-slate-400 hover:bg-slate-100 hover:text-slate-900" data-modal-hide="edit-alternative-<?= $id ?>">
                                        <span class="sr-only">Tutup</span>
                                        <svg class="h-3 w-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="space-y-4 p-4">
                                    <label class="block">
                                        <span class="mb-2 block text-sm font-medium text-slate-900">Kode</span>
                                        <input name="indeks_alternatif" value="<?= esc($alternative['indeks_alternatif']) ?>" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                                    </label>
                                    <label class="block">
                                        <span class="mb-2 block text-sm font-medium text-slate-900">Nama</span>
                                        <input name="nama" value="<?= esc($alternative['nama']) ?>" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                                    </label>
                                </div>
                                <div class="flex items-center justify-end gap-2 border-t border-slate-200 p-4">
                                    <button type="button" data-modal-hide="edit-alternative-<?= $id ?>" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</button>
                                    <button type="submit" class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="delete-alternative-<?= $id ?>" tabindex="-1" class="fixed left-0 right-0 top-0 z-50 hidden h-full max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                        <div class="relative max-h-full w-full max-w-md p-4">
                            <div class="relative rounded-lg bg-white p-5 shadow">
                                <h3 class="text-base font-semibold text-slate-950">Hapus alternatif?</h3>
                                <p class="mt-2 text-sm text-slate-500">Data penilaian untuk <?= esc($alternative['nama']) ?> ikut terhapus karena relasi database.</p>
                                <form action="<?= site_url('alternatif/' . $id . '/delete') ?>" method="post" class="mt-5 flex justify-end gap-2">
                                    <?= csrf_field() ?>
                                    <button type="button" data-modal-hide="delete-alternative-<?= $id ?>" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</button>
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

<div id="add-alternative-modal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-full max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
    <div class="relative max-h-full w-full max-w-md p-4">
        <form action="<?= site_url('alternatif') ?>" method="post" class="relative rounded-lg bg-white shadow">
            <?= csrf_field() ?>
            <div class="flex items-center justify-between border-b border-slate-200 p-4">
                <h3 class="text-base font-semibold text-slate-950">Tambah Alternatif</h3>
                <button type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-900" data-modal-hide="add-alternative-modal">
                    <span class="sr-only">Tutup</span>
                    <svg class="h-3 w-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <div class="space-y-4 p-4">
                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-900">Kode</span>
                    <input name="indeks_alternatif" value="<?= old('indeks_alternatif') ?>" placeholder="A11" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                </label>
                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-900">Nama</span>
                    <input name="nama" value="<?= old('nama') ?>" placeholder="Nama alternatif" class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-brand-600 focus:ring-brand-600" required>
                </label>
            </div>
            <div class="flex justify-end gap-2 border-t border-slate-200 p-4">
                <button type="button" data-modal-hide="add-alternative-modal" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</button>
                <button type="submit" class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
