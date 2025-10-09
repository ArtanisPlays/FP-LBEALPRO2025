<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Email - MyFRS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body{margin:0;font-family:'Inter',sans-serif;background:#F3F4F6;color:#111827}
        .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
        .card{max-width:640px;width:100%;background:#fff;border:1px solid #E5E7EB;border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px}
        h1{font-size:22px;margin:0 0 8px}
        p{color:#6B7280;margin:8px 0}
        .row{display:flex;gap:12px;justify-content:space-between;flex-wrap:wrap;margin-top:16px}
        .btn{background:#4F46E5;color:#fff;border:none;border-radius:10px;padding:10px 14px;font-weight:600;cursor:pointer}
        .linkbtn{background:transparent;border:1px solid #E5E7EB;color:#111827;border-radius:10px;padding:10px 14px;font-weight:600;cursor:pointer}
        .alert{margin-top:12px;padding:10px;border-radius:10px;background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
<body>
    <div class="wrap">
        <div class="card">
            <h1>Verifikasi Email</h1>
            <p>Terima kasih telah mendaftar! Silakan verifikasi alamat email Anda melalui tautan yang kami kirim. Jika belum menerima email, Anda bisa kirim ulang.</p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert">Tautan verifikasi baru telah dikirim ke email Anda.</div>
            @endif

            <div class="row">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn">Kirim Ulang Email Verifikasi</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="linkbtn">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
