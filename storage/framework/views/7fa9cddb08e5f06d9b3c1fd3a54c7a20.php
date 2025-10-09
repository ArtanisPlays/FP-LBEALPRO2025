<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail RPS Mahasiswa - MyFRS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#111827;--muted:#6B7280;--bg:#F3F4F6;--card:#fff;--ring:#E5E7EB;--primary:#4F46E5;--danger:#EF4444;--success:#10B981}
        body{margin:0;font-family:'Inter',sans-serif;background:var(--bg);color:var(--ink)}
        .app-header{display:flex;align-items:center;justify-content:space-between;padding:16px 24px;background:linear-gradient(135deg,#0ea5e9,#6366f1);color:#fff}
        .brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:20px}
        .brand .logo{background:#fff;color:#111827;border-radius:10px;padding:8px 12px}
        nav a{color:#e5e7eb;text-decoration:none;margin-right:16px;font-weight:500}
        .logout-btn{background:transparent;border:1px solid rgba(255,255,255,.5);color:#fff;padding:8px 12px;border-radius:8px;cursor:pointer}
        .container{max-width:1100px;margin:32px auto;padding:0 20px}
        .section{background:var(--card);border:1px solid var(--ring);border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px;margin-bottom:20px}
        .title{font-size:20px;font-weight:700;margin:0 0 12px}
        ul{padding-left:18px}
        .btn{display:inline-block;background:var(--primary);color:#fff;border:none;border-radius:10px;padding:10px 14px;font-weight:600;text-decoration:none;cursor:pointer}
        .btn-danger{background:var(--danger)}
        .btn-success{background:var(--success)}
        textarea{width:100%;border:1px solid var(--ring);border-radius:8px;padding:10px;font-family:inherit;resize:vertical}
        label{font-size:12px;color:var(--muted);display:block;margin-bottom:6px}
    </style>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
    <header class="app-header">
        <div class="brand"><span class="logo">MyFRS</span><span>Detail RPS</span></div>
        <nav>
            <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </nav>
    </header>

    <main class="container">
        <section class="section">
            <h3 class="title">Informasi Mahasiswa</h3>
            <div>
                <div style="color:var(--muted);font-size:12px">Nama Lengkap</div>
                <div style="margin-bottom:8px"><?php echo e($rps->mahasiswa->user->name); ?></div>
                <div style="color:var(--muted);font-size:12px">NIM</div>
                <div><?php echo e($rps->mahasiswa->nim); ?></div>
            </div>
        </section>

        <section class="section">
            <h3 class="title">Mata Kuliah yang Diambil</h3>
            <ul>
                <?php $__currentLoopData = $rps->mataKuliah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($mk->kode_mk); ?> - <?php echo e($mk->nama_mk); ?> (<?php echo e($mk->sks); ?> SKS)</li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </section>

        <section class="section">
            <h3 class="title">Aksi Validasi</h3>
            <p class="muted">Setujui atau tolak Rencana Studi mahasiswa ini. Anda bisa menambahkan catatan jika menolak.</p>
            <div style="display:flex;gap:12px;align-items:flex-start;flex-wrap:wrap;margin-top:12px">
                <form action="<?php echo e(route('dosen.validasi.update', $rps->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="status" value="disetujui">
                    <button type="submit" class="btn btn-success">Setujui RPS</button>
                </form>
            </div>
            <div style="margin-top:16px">
                <form action="<?php echo e(route('dosen.validasi.update', $rps->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="status" value="ditolak">
                    <div>
                        <label for="catatan_tolak">Catatan (Wajib jika ditolak)</label>
                        <textarea id="catatan_tolak" name="catatan" rows="3"></textarea>
                    </div>
                    <div style="margin-top:10px">
                        <button type="submit" class="btn btn-danger">Tolak RPS</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>

<?php /**PATH C:\Users\Mitra\KULIAH\SEM 3\LBE\final-web-frs\resources\views/dosen/validasi/show.blade.php ENDPATH**/ ?>