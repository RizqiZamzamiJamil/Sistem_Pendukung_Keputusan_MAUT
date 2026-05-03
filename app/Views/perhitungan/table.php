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
                        <td class="px-4 py-4 text-right font-mono text-slate-800">
                            <?= number_format((float) ($matrix[$alternativeId][$criterionId] ?? 0), $precision) ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
