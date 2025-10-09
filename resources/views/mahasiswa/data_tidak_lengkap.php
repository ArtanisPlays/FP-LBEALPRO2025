<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemberitahuan - MyFRS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body{margin:0;font-family:'Inter',sans-serif;background:#F3F4F6;color:#111827}
        .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
        .card{max-width:700px;width:100%;background:#fff;border:1px solid #E5E7EB;border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px}
        h2{font-size:22px;margin:0 0 12px}
        p{color:#6B7280;margin:8px 0}
        .btn{background:#111827;color:#fff;border:none;border-radius:10px;padding:10px 14px;font-weight:600;cursor:pointer}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="wrap">
        <div class="card">
            <h2>Pemberitahuan</h2>
            <h3 style="margin:0 0 8px">Data Mahasiswa Tidak Ditemukan</h3>
            <p>Akun Anda telah berhasil dibuat, namun data detail mahasiswa Anda (seperti NIM dan Program Studi) belum terdaftar di sistem.</p>
            <p>Silakan hubungi bagian administrasi akademik untuk melengkapi data Anda.</p>
            <div style="margin-top:16px">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

