<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - MyFRS</title>
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
        .link{display:block;text-align:center;margin-top:10px;color:#357ebd;text-decoration:none;font-weight:600}
        .error{color:#B91C1C;font-size:12px;margin-top:-6px;margin-bottom:8px}
        .card-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .card-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a202c;
            margin: 0 0 0.5rem 0;
        }
        
        .card-header p {
            font-size: 1rem;
            color: #718096;
            margin: 0;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
         /* Primary Button */
        .primary-button {
            width: 100%;
            padding: 0.85rem 1.75rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            color: #ffffff;
            background-color: #4a90e2;
            transition: all 0.3s ease;
        }

        .primary-button:hover {
            background-color: #357ebd;
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(74, 144, 226, 0.2), 0 3px 6px rgba(0, 0, 0, 0.08);
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="wrap">
        <form class="card" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="card-header">
                <h1>Selamat datang di MyFRS</h1>
                <p>Silakan mendaftar akun anda. Akun akan diverifikasi oleh Dos</p>
            </div>
            <div>
                <label for="name">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @if($errors->get('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
            </div>
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @if($errors->get('email'))<div class="error">{{ $errors->first('email') }}</div>@endif
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @if($errors->get('password'))<div class="error">{{ $errors->first('password') }}</div>@endif
            </div>
            <div>
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @if($errors->get('password_confirmation'))<div class="error">{{ $errors->first('password_confirmation') }}</div>@endif
            </div>
            <div class="form-group">
                <button type="submit" class="primary-button">
                    Daftar
                </button>
            </div>
            <a class="link" href="{{ route('login') }}">Sudah punya akun? Masuk</a>
        </form>
    </div>
</body>
</html>
