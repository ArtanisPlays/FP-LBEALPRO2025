<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - MyFRS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body{margin:0;font-family:'Inter',sans-serif;background:#F3F4F6;color:#111827}
        .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
        .card{max-width:480px;width:100%;background:#fff;border:1px solid #E5E7EB;border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px}
        label{display:block;font-size:12px;color:#6B7280;margin-bottom:6px}
        input{width:100%;padding:10px;border:1px solid #E5E7EB;border-radius:10px;margin-bottom:12px;font-family:inherit}
        .btn{width:100%;background:#4F46E5;color:#fff;border:none;border-radius:10px;padding:10px 14px;font-weight:600;cursor:pointer}
        .alert{margin-bottom:12px;padding:10px;border-radius:10px;background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0}
        .error{color:#B91C1C;font-size:12px;margin-top:-6px;margin-bottom:8px}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="wrap">
        <form class="card" method="POST" action="{{ route('password.email') }}">
            @csrf
            <p style="color:#6B7280">Lupa password? Masukkan email Anda, kami akan kirim tautan reset password.</p>
            @if (session('status'))
                <div class="alert">{{ session('status') }}</div>
            @endif
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @if($errors->get('email'))<div class="error">{{ $errors->first('email') }}</div>@endif
            </div>
            <button class="btn" type="submit">Kirim Link Reset Password</button>
        </form>
    </div>
</body>
</html>
