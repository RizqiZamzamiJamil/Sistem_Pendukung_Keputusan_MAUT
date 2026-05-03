<?php $errors = session('errors') ?? []; ?>

<?php if (session('success')): ?>
    <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800" role="alert">
        <?= esc(session('success')) ?>
    </div>
<?php endif; ?>

<?php if ($errors !== []): ?>
    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
        <p class="mb-2 font-semibold">Periksa kembali input berikut:</p>
        <ul class="list-disc space-y-1 ps-5">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
