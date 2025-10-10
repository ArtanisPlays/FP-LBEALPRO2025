<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Persetujuan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="max-w-lg w-full bg-white p-8 rounded-lg shadow-md text-center">
        <svg class="mx-auto h-12 w-12 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h1 class="text-2xl font-bold text-gray-800 mt-4">Pendaftaran Anda Telah Diterima</h1>
        <p class="text-gray-600 mt-2">Akun Anda sedang menunggu persetujuan dari administrasi atau dosen wali. Anda akan dapat login setelah akun Anda diaktifkan. Terima kasih atas kesabaran Anda.</p>
        <div class="mt-6">
            <a href="<?php echo e(url('/')); ?>" class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-700 transition">Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Mitra\KULIAH\SEM 3\LBE\final-web-frs\resources\views/auth/verification-pending.blade.php ENDPATH**/ ?>