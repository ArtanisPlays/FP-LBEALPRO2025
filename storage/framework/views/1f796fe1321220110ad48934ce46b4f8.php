<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Mahasiswa Baru</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
        }
        /* App Header & Navigation (match dashboard) */
        .app-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 2rem;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4rem; /* 64px */
            max-width: 1280px;
            margin: 0 auto;
        }
        .my-frs { font-size: 1.5rem; font-weight: 800; color: #2d3748; text-decoration: none; transition: color 0.3s ease; }
        .my-frs:hover { color: #4a90e2; }
        .dropdown { position: relative; display: inline-block; }
        .dropdown-toggle { background-color: transparent; border: none; cursor: pointer; padding: 0.5rem; border-radius: 0.375rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 600; color: #4a5568; font-size: 0.875rem; transition: background-color 0.2s ease; }
        .dropdown-toggle:hover { background-color: #f7fafc; }
        .dropdown-toggle .user-name { display: none; }
        @media (min-width: 640px) { .dropdown-toggle .user-name { display: block; } }
        .dropdown-toggle svg { width: 1rem; height: 1rem; stroke: currentColor; transition: transform 0.2s ease; }
        .dropdown-toggle.open svg { transform: rotate(180deg); }
        .dropdown-menu { position: absolute; top: calc(100% + 0.5rem); right: 0; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; min-width: 12rem; z-index: 20; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s; }
        .dropdown-menu.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item { display: block; width: 100%; padding: 0.75rem 1rem; text-align: left; font-size: 0.875rem; color: #4a5568; text-decoration: none; box-sizing: border-box; }
        .dropdown-item:hover { background-color: #f7fafc; }
        .dropdown-item-form button { width: 100%; background: none; border: none; cursor: pointer; text-align: left; padding: 0.75rem 1rem; font-size: 0.875rem; color: #4a5568; font-family: 'Inter', sans-serif; font-weight: 500; }
        .dropdown-item-form button:hover { background-color: #f7fafc; }
        .container {
            max-width: 900px;
            margin: 32px auto;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }
        .content {
            padding: 2rem;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }
        th, td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        thead {
            background-color: #f9fafb;
        }
        th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
        }
        tbody tr:hover {
            background-color: #f9fafb;
        }
        td {
            font-size: 0.875rem;
        }
        .actions a, .actions button {
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }
        .actions a {
            color: #3b82f6;
        }
        .actions a:hover {
            color: #1d4ed8;
        }
        .actions form {
            display: inline-block;
            margin-left: 1rem;
        }
        .actions button {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            font-size: inherit; /* Match the font size of links */
            padding: 0;
        }
        .actions button:hover {
            color: #b91c1c;
        }
        .success-box {
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            color: #065f46;
            background-color: #d1fae5;
            border-radius: 0.375rem;
            border: 1px solid #6ee7b7;
        }

        /* App Header & Navigation */
        .app-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 2rem;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4rem; /* 64px */
            max-width: 1280px;
            margin: 0 auto;
        }

        .my-frs {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2d3748;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .my-frs:hover {
            color: #4a90e2;
        }
        
        /* Dropdown Menu Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: #4a5568;
            font-size: 0.875rem;
            transition: background-color 0.2s ease;
        }
        .dropdown-toggle:hover {
            background-color: #f7fafc;
        }
        
        .dropdown-toggle .user-name {
            display: none;
        }
        @media (min-width: 640px) {
            .dropdown-toggle .user-name {
                display: block;
            }
        }

        .dropdown-toggle svg {
            width: 1rem;
            height: 1rem;
            stroke: currentColor;
            transition: transform 0.2s ease;
        }

        .dropdown-toggle.open svg {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
            min-width: 12rem; /* 192px */
            z-index: 20;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.875rem;
            color: #4a5568;
            text-decoration: none;
            box-sizing: border-box;
        }
        .dropdown-item:hover {
            background-color: #f7fafc;
        }
        
        .dropdown-item-form button {
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #4a5568;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            margin: 0;
            text-transform: none;
            border-radius: 0;
        }
        .dropdown-item-form button:hover {
            background-color: #f7fafc;
        }
    </style>
</head>
<body>

    <header class="app-header">
        <nav class="navbar">
            <!-- Logo -->
            <a href="<?php echo e(url('/dashboard')); ?>" class="my-frs">MyFRS <span>Dosen</span></a>

            <!-- User Menu Dropdown -->
            <div class="dropdown">
                <button id="user-menu-button" class="dropdown-toggle" type="button">
                    <span class="user-name"><?php echo e(Auth::user()->name); ?></span>
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div id="user-menu" class="dropdown-menu">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">Profile</a>
                    <a href="<?php echo e(route('dashboard')); ?>" class="dropdown-item">Dashboard</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="dropdown-item-form">
                        <?php echo csrf_field(); ?>
                        <button type="submit">Log Out</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="content">
            <h1>Verifikasi Pendaftaran Mahasiswa Baru</h1>

            <?php if(session('success')): ?>
                <div class="success-box">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Email</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $pendingUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td class="actions" style="text-align: right;">
                                    <a href="<?php echo e(route('dosen.verifikasi.approve.form', $user)); ?>">Setujui</a>
                                    <form action="<?php echo e(route('dosen.verifikasi.reject', $user)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')">Tolak</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: #6b7280; padding: 2rem;">
                                    Tidak ada pendaftar baru yang menunggu persetujuan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('user-menu-button');
            const dropdownMenu = document.getElementById('user-menu');
            if (dropdownToggle && dropdownMenu) {
                dropdownToggle.addEventListener('click', function(event) {
                    event.stopPropagation();
                    dropdownMenu.classList.toggle('show');
                    this.classList.toggle('open');
                });
                window.addEventListener('click', function(event) {
                    if (dropdownMenu.classList.contains('show') && !dropdownToggle.contains(event.target)) {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.classList.remove('open');
                    }
                });
            }
        });
    </script>
</body>
</html>

<?php /**PATH C:\Users\Mitra\KULIAH\SEM 3\LBE\final-web-frs\resources\views/dosen/verifikasi/list.blade.php ENDPATH**/ ?>