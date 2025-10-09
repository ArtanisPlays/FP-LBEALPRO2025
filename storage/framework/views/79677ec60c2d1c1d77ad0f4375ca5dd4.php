<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Mahasiswa - MyFRS</title>
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
        .dropdown-item-form button{width:100%;background:none;border:none;cursor:pointer;text-align:left;padding:.75rem 1rem;font-size:.875rem;color:#4a5568;font-family:'Inter',sans-serif;font-weight:500}
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
    </style>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <h1 class="page-title">
            Halo, <?php echo e(Auth::user()->name); ?>!
        </h1>

        <section class="card">
            <h2 class="title">Profil Anda</h2>
            <div class="grid">
                <div>
                    <div class="label">Nama</div>
                    <div><?php echo e(Auth::user()->name); ?></div>
                </div>
                <div>
                    <div class="label">NIM</div>
                    <div><?php echo e($mahasiswa->nim); ?></div>
                </div>
                <div>
                    <div class="label">Program Studi</div>
                    <div><?php echo e($mahasiswa->program_studi); ?></div>
                </div>
                <div>
                    <div class="label">Dosen Wali</div>
                    <div><?php echo e($mahasiswa->dosenWali->name ?? 'Belum ditentukan'); ?></div>
                </div>
            </div>
        </section>

        <section class="card">
            <h2 class="title">Status Rencana Studi Semester Ini</h2>
            <?php if($rps): ?>
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="label">Status:</div>
                     <?php if($rps->status == 'disetujui'): ?> <span class="badge green">Disetujui</span>
                     <?php elseif($rps->status == 'diajukan'): ?> <span class="badge blue">Diajukan</span>
                     <?php elseif($rps->status == 'revisi'): ?> <span class="badge yellow">Revisi</span>
                     <?php elseif($rps->status == 'ditolak'): ?> <span class="badge red">Ditolak</span>
                     <?php elseif($rps->status == 'perlu_persetujuan'): ?> <span class="badge orange">Perlu Persetujuan</span>
                     <?php endif; ?>
                </div>

                <?php if($rps->catatan_dosen): ?>
                    <div class="muted" style="margin-top:12px;border-left:4px solid var(--yellow);padding-left:12px">
                        <div style="font-weight:700;color:var(--yellow)">Catatan dari Dosen:</div>
                        <div style="font-style:italic">"<?php echo e($rps->catatan_dosen); ?>"</div>
                    </div>
                <?php endif; ?>

                <div style="margin-top:16px;display:flex;gap:12px;flex-wrap:wrap">
                    <?php if($rps->status == 'disetujui'): ?>
                        <a class="btn green" href="<?php echo e(route('mahasiswa.rps.jadwal')); ?>">Lihat Jadwal</a>
                    <?php elseif($rps->status == 'revisi'): ?>
                        <a class="btn yellow" href="<?php echo e(route('mahasiswa.rps.edit')); ?>">Edit RPS</a>
                    <?php elseif($rps->status == 'ditolak'): ?>
                        <a class="btn red" href="<?php echo e(route('mahasiswa.rps.create')); ?>">Isi Ulang RPS</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p class="muted">Anda belum mengisi Rencana Studi untuk semester ini.</p>
                <div style="margin-top:12px">
                    <a class="btn" href="<?php echo e(route('mahasiswa.rps.create')); ?>">Isi RPS Sekarang</a>
                </div>
            <?php endif; ?>
        </section>
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

<?php /**PATH C:\Users\Mitra\KULIAH\SEM 3\LBE\final-web-frs\resources\views/mahasiswa/dashboard.blade.php ENDPATH**/ ?>