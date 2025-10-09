<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Rencana Studi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#111827;--muted:#6B7280;--primary:#4F46E5;--bg:#F3F4F6;--card:#FFFFFF;--ring:#E5E7EB;--green:#10B981;--yellow:#F59E0B;--orange:#f97316;--red:#EF4444;--blue:#3B82F6}
        body{margin:0;font-family:'Inter',sans-serif;background:var(--bg);color:var(--ink)}
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
        .dropdown{position:relative;display:inline-block}
        .dropdown-toggle{background:transparent;border:none;cursor:pointer;padding:.5rem;border-radius:.375rem;display:flex;align-items:center;gap:.5rem;font-weight:600;color:#4a5568;font-size:.875rem}
        .dropdown-toggle:hover{background:#f7fafc}
        .dropdown-toggle .user-name{display:none}
        @media (min-width:640px){.dropdown-toggle .user-name{display:block}}
        .dropdown-toggle svg{width:1rem;height:1rem;stroke:currentColor;transition:transform .2s}
        .dropdown-toggle.open svg{transform:rotate(180deg)}
        .dropdown-menu{position:absolute;top:calc(100% + .5rem);right:0;background:#fff;border-radius:.5rem;box-shadow:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -2px rgba(0,0,0,.1);border:1px solid #e2e8f0;min-width:12rem;z-index:20;opacity:0;visibility:hidden;transform:translateY(-10px);transition:opacity .2s,transform .2s,visibility .2s}
        .dropdown-menu.show{opacity:1;visibility:visible;transform:translateY(0)}
        .dropdown-item{display:block;width:100%;padding:.75rem 1rem;text-align:left;font-size:.875rem;color:#4a5568;text-decoration:none;box-sizing:border-box}
        .dropdown-item:hover{background:#f7fafc}
        .dropdown-item-form button{width:100%;background:none;border:none;cursor:pointer;text-align:left;padding:.75rem 1rem;font-size:.875rem;color:#4a5568;font-family:'Inter',sans-serif;font-weight:500;margin:0;text-transform:none;border-radius:0}
        .dropdown-item-form button:hover{background:#f7fafc}
        main.container{max-width:1100px;margin:32px auto;padding:0 20px}
        .card{background:var(--card);border:1px solid var(--ring);border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px;margin-bottom:20px}
        .title{font-size:20px;font-weight:700;margin:0 0 12px}
        .page-title{font-size: 28px; font-weight: 800; margin-bottom: 24px; color: var(--ink);}
        .grid{display:grid;grid-template-columns:repeat(1,1fr);gap:16px}@media (min-width: 768px){.grid{grid-template-columns:repeat(2,1fr);}}
        .label{font-size:12px;color:var(--muted); font-weight: 500; margin-bottom: 4px; text-transform: uppercase;}
        .badge{display:inline-flex;align-items:center;font-size:12px;font-weight:700;padding:6px 10px;border-radius:999px}
        .badge.green{background:#ECFDF5;color:#065F46;border:1px solid #A7F3D0}
        .badge.yellow{background:#FFFBEB;color:#92400E;border:1px solid #FDE68A}
        .badge.orange{background:#fff7ed;color:#9a3412;border:1px solid #fed7aa}
        .badge.red{background:#FEF2F2;color:#991B1B;border:1px solid #FECACA}
        .badge.blue{background:#EFF6FF;color:#1E40AF;border:1px solid #BFDBFE}
        .btn{display:inline-block;background:var(--primary);color:#fff;border:none;border-radius:10px;padding:10px 14px;font-weight:600;text-decoration:none;transition: background-color .2s}
        .btn:hover{background-color: #4338ca;}
        .btn.green { background: var(--green); } .btn.green:hover { background-color: #059669; }
        .btn.yellow{background:var(--yellow)} .btn.yellow:hover { background-color: #d97706; }
        .btn.orange{background:var(--orange)} .btn.orange:hover { background-color: #ea580c; }
        .btn.red{background:var(--red)} .btn.red:hover { background-color: #dc2626; }
        .muted{color:var(--muted)}
        .alert{padding:12px;border-radius:10px;margin-bottom:16px}
        .alert-success{background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0}
        .alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
        .card{background:var(--card);border:1px solid var(--ring);border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px;margin-bottom:20px}
        .title{font-size:20px;font-weight:700;margin:0 0 12px}
        .main-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; }
        @media (min-width: 1024px) { .main-grid { grid-template-columns: 3fr 1fr; } }
        .sidebar .card { background-color: #f9fafb; }
        .sidebar th, .sidebar td { padding: 0.5rem; font-size: 0.8rem;}
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; }
        th, td { padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid var(--ring); }
        thead { background-color: #f9fafb; }
        th { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); }
        tbody tr:hover { background-color: #f9fafb; }
        td { font-size: 0.875rem; vertical-align: top; }
        input[type="checkbox"] { width: 1rem; height: 1rem; border-radius: 0.25rem; border-color: #d1d5db; }
        input[type="checkbox"]:disabled { background-color: #e5e7eb; cursor: not-allowed; }
    .submit-btn { display: inline-flex; align-items: center; padding: 0.6rem 1.2rem; background-color: #1f2937; border: 1px solid transparent; border-radius: 0.375rem; font-weight: 600; font-size: 0.75rem; color: #ffffff; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: background-color 0.2s ease-in-out; margin-top: 1.5rem; }
    .submit-btn:hover { background-color: #374151; }
        .error-box { padding: 1rem; margin-bottom: 1rem; font-size: 0.875rem; color: #991b1b; background-color: #fee2e2; border-radius: 0.375rem; border: 1px solid #fca5a5; }
        .prasyarat-info { font-size: 0.75rem; margin-top: 0.25rem; }
        .prasyarat-info.unmet { color: var(--red); }
        .prasyarat-info.warning { color: var(--yellow); }
        .disabled-row { background-color: #f9fafb; opacity: 0.6; }
    </style>
</head>
<body>
    <!-- Application Header -->
    <header class="app-header">
        <nav class="navbar">
            <!-- Logo -->
            <a href="<?php echo e(url('/dashboard')); ?>" class="my-frs">MyFRS <span>Mahasiswa</span></a>

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
                        <button type="submit">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <div class="main-grid">
            <!-- Kolom Utama: Pengisian RPS -->
            <div class="main-content">
                <div class="card">
                    <h1 class="title">Isi Rencana Studi (Semester 3)</h1>

                    <?php if($errors->any()): ?>
                        <div class="error-box">
                            <span style="font-weight: 600;">Error!</span> <?php echo e($errors->first()); ?>

                        </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo e(route('mahasiswa.rps.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Pilih</th>
                                        <th>Kode</th>
                                        <th>Nama Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Jadwal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $availableCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $prasyaratStatus = $unmetPrerequisites[$mk->id] ?? null;
                                            $isAvailable = $prasyaratStatus === null;
                                            $isWarning = $prasyaratStatus && $prasyaratStatus['is_warning'];
                                        ?>
                                        <tr class="<?php echo e(!$isAvailable && !$isWarning ? 'disabled-row' : ''); ?>">
                                            <td>
                                                <input type="checkbox" name="matakuliah_ids[]" value="<?php echo e($mk->id); ?>" <?php echo e(!$isAvailable && !$isWarning ? 'disabled' : ''); ?>>
                                            </td>
                                            <td><?php echo e($mk->kode_mk); ?></td>
                                            <td>
                                                <?php echo e($mk->nama_mk); ?>

                                                <?php if($prasyaratStatus): ?>
                                                    <div class="prasyarat-info <?php echo e($isWarning ? 'warning' : 'unmet'); ?>">
                                                        <?php echo e($isWarning ? 'Peringatan' : 'Prasyarat belum terpenuhi'); ?>: <?php echo e(implode(', ', $prasyaratStatus['courses'])); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($mk->sks); ?></td>
                                            <td><?php echo e($mk->hari); ?>, <?php echo e(date('H:i', strtotime($mk->jam_mulai))); ?> - <?php echo e(date('H:i', strtotime($mk->jam_selesai))); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: var(--muted);">
                                            Tidak ada data mata kuliah yang tersedia.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <button type="submit" class="submit-btn">Ajukan RPS</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Samping: Transkrip Mini -->
            <div class="sidebar">
                <div class="card">
                    <h3 class="title">Mata Kuliah Selesai</h3>
                    <div class="table-wrapper">
                         <table>
                            <thead>
                                <tr>
                                    <th>SMT</th>
                                    <th>Kode</th>
                                    <th>Nama MK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $completedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($course->semester); ?></td>
                                        <td><?php echo e($course->kode_mk); ?></td>
                                        <td><?php echo e($course->nama_mk); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center; color: var(--muted);">
                                            Belum ada data.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

<?php /**PATH C:\Users\Mitra\KULIAH\SEM 3\LBE\final-web-frs\resources\views/mahasiswa/rps/create.blade.php ENDPATH**/ ?>