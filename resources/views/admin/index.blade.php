<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Mata Kuliah - MyFRS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#111827;--muted:#6B7280;--bg:#F3F4F6;--card:#fff;--ring:#E5E7EB}
        body{margin:0;font-family:'Inter',sans-serif;background:var(--bg);color:var(--ink)}
        .app-header{display:flex;align-items:center;justify-content:space-between;padding:16px 24px;background:linear-gradient(135deg,#0ea5e9,#6366f1);color:#fff}
        .brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:20px}
        .brand .logo{background:#fff;color:#111827;border-radius:10px;padding:8px 12px}
        nav a{color:#e5e7eb;text-decoration:none;margin-right:16px;font-weight:500}
        .logout-btn{background:transparent;border:1px solid rgba(255,255,255,.5);color:#fff;padding:8px 12px;border-radius:8px;cursor:pointer}
        .container{max-width:1100px;margin:32px auto;padding:0 20px}
        .card{background:var(--card);border:1px solid var(--ring);border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px}
        table{width:100%;border-collapse:collapse}
        thead th{font-size:12px;text-transform:uppercase;text-align:left;color:#6B7280;border-bottom:1px solid var(--ring);padding:12px}
        tbody td{padding:12px;border-bottom:1px solid #F3F4F6}
        .muted{color:var(--muted)}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="app-header">
        <div class="brand"><span class="logo">MyFRS</span><span>Kelola Mata Kuliah</span></div>
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
            <p class="muted">(Fitur Tambah, Edit, Hapus akan dibuat selanjutnya)</p>
            <div style="overflow-x:auto;margin-top:16px">
                <table>
                    <thead>
                        <tr>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Jadwal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mataKuliahs as $mk)
                            <tr>
                                <td>{{ $mk->kode_mk }}</td>
                                <td>{{ $mk->nama_mk }}</td>
                                <td>{{ $mk->sks }}</td>
                                <td>{{ $mk->semester }}</td>
                                <td>{{ $mk->hari }}, {{ \Carbon\Carbon::parse($mk->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($mk->jam_selesai)->format('H:i') }}</td>
                                <td style="text-align:right"></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;color:#6B7280">Tidak ada data mata kuliah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
