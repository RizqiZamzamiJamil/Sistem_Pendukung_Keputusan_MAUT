<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'SPK MAUT') ?> - SPK MAUT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#ecfeff',
                            100: '#cffafe',
                            600: '#0891b2',
                            700: '#0e7490',
                        },
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-slate-50 text-slate-900">
<?php
$active = $active ?? 'dashboard';
$navigation = [
    ['key' => 'dashboard', 'label' => 'Dashboard', 'href' => site_url('/')],
    ['key' => 'alternatif', 'label' => 'Alternatif', 'href' => site_url('alternatif')],
    ['key' => 'kriteria', 'label' => 'Kriteria', 'href' => site_url('kriteria')],
    ['key' => 'penilaian', 'label' => 'Penilaian', 'href' => site_url('penilaian')],
    ['key' => 'perhitungan', 'label' => 'Perhitungan', 'href' => site_url('perhitungan')],
];
?>

<nav class="fixed top-0 z-50 w-full border-b border-slate-200 bg-white">
    <div class="px-4 py-3 lg:px-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button data-drawer-target="app-sidebar" data-drawer-toggle="app-sidebar" aria-controls="app-sidebar" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-sm text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-brand-100 lg:hidden">
                    <span class="sr-only">Buka menu</span>
                    <svg class="h-5 w-5" aria-hidden="true" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
                <a href="<?= site_url('/') ?>" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-brand-600 text-sm font-bold text-white">M</span>
                    <span class="leading-tight">
                        <span class="block text-sm font-semibold text-slate-900">SPK MAUT</span>
                        <span class="block text-xs text-slate-500">CodeIgniter 4</span>
                    </span>
                </a>
            </div>
            <button id="databaseDropdownButton" data-dropdown-toggle="databaseDropdown" type="button" class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-brand-100">
                Database aktif
                <svg class="ms-2 h-2.5 w-2.5" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <div id="databaseDropdown" class="z-50 hidden w-64 divide-y divide-slate-100 rounded-lg bg-white shadow">
                <div class="px-4 py-3 text-sm text-slate-700">
                    <p class="font-semibold">maut_kelompok2</p>
                    <p class="truncate text-xs text-slate-500">MySQLi via CodeIgniter Model</p>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="app-sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-slate-200 bg-white pt-20 transition-transform lg:translate-x-0" aria-label="Sidebar">
    <div class="h-full overflow-y-auto px-3 pb-4">
        <ul class="space-y-2 font-medium">
            <?php foreach ($navigation as $item): ?>
                <?php $isActive = $active === $item['key']; ?>
                <li>
                    <a href="<?= esc($item['href']) ?>" class="flex items-center rounded-lg px-3 py-2.5 text-sm <?= $isActive ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-100' ?>">
                        <span class="me-3 h-2.5 w-2.5 rounded-full <?= $isActive ? 'bg-brand-600' : 'bg-slate-300' ?>"></span>
                        <?= esc($item['label']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="mt-6 rounded-lg border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
            <p class="font-semibold text-slate-800">MAUT</p>
            <p class="mt-1">Normalisasi benefit, bobot kriteria, dan ranking otomatis dari database.</p>
        </div>
    </div>
</aside>

<main class="min-h-screen p-4 pt-24 lg:ml-64 lg:p-8 lg:pt-28">
    <div class="mx-auto max-w-7xl">
        <div class="mb-6">
            <p class="text-sm font-medium text-brand-700">Sistem Pendukung Keputusan</p>
            <h1 class="mt-1 text-2xl font-semibold tracking-normal text-slate-950"><?= esc($title ?? 'Dashboard') ?></h1>
        </div>

        <?= $this->include('partials/flash') ?>
        <?= $this->renderSection('content') ?>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.js"></script>
</body>
</html>
