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
            padding: 2rem;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
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
    </style>
</head>
<body>
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
</body>
</html>

<?php /**PATH C:\Users\Mitra\KULIAH\SEM 3\LBE\final-web-frs\resources\views/dosen/verifikasi/list.blade.php ENDPATH**/ ?>