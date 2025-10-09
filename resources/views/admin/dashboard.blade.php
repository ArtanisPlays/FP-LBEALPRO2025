<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - MyFRS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#111827; --muted:#6B7280; --primary:#4F46E5; --bg:#F3F4F6; --card:#FFFFFF; --ring:#E5E7EB; }
        body{margin:0;font-family:'Inter',sans-serif;background:var(--bg);color:var(--ink)}
        .app-header{display:flex;align-items:center;justify-content:space-between;padding:16px 24px;background:linear-gradient(135deg,#0ea5e9,#6366f1);color:#fff;box-shadow:0 2px 10px rgba(0,0,0,.08)}
        .brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:20px}
        .brand .logo{background:#fff;color:#111827;border-radius:10px;padding:8px 12px}
        nav a{color:#e5e7eb;text-decoration:none;margin-right:16px;font-weight:500}
        nav a:hover{color:#fff}
        .logout-btn{background:transparent;border:1px solid rgba(255,255,255,.5);color:#fff;padding:8px 12px;border-radius:8px;cursor:pointer}
        .container{max-width:1100px;margin:32px auto;padding:0 20px}
        .card{background:var(--card);border:1px solid var(--ring);border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px}
        .title{font-size:22px;font-weight:700;margin:0}
        .muted{color:var(--muted)}
        .btn{display:inline-block;background:var(--primary);color:#fff;border:none;border-radius:10px;padding:10px 14px;font-weight:600;text-decoration:none}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="app-header">
        <div class="brand"><span class="logo">MyFRS</span><span>Admin</span></div>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </nav>
    </header>

    <main class="container">
        <section class="card">
            <h1 class="title">Selamat Datang, Admin!</h1>
            <p class="muted" style="margin-top:8px">Anda dapat mengelola data master dari sini.</p>
            <div style="margin-top:16px">
                <a href="{{ route('admin.matakuliah.index') }}" class="btn">Kelola Mata Kuliah</a>
            </div>
        </section>
    </main>
</body>
</html>
