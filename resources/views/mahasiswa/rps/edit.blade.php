<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit RPS - MyFRS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#111827;--muted:#6B7280;--bg:#F3F4F6;--card:#fff;--ring:#E5E7EB;--primary:#4F46E5;--danger:#EF4444;--warn:#F59E0B}
        body{margin:0;font-family:'Inter',sans-serif;background:var(--bg);color:var(--ink)}
        .app-header{display:flex;align-items:center;justify-content:space-between;padding:16px 24px;background:linear-gradient(135deg,#0ea5e9,#6366f1);color:#fff}
        .brand{display:flex;align-items:center;gap:10px;font-weight:800;font-size:20px}
        .brand .logo{background:#fff;color:#111827;border-radius:10px;padding:8px 12px}
        nav a{color:#e5e7eb;text-decoration:none;margin-right:16px;font-weight:500}
        .logout-btn{background:transparent;border:1px solid rgba(255,255,255,.5);color:#fff;padding:8px 12px;border-radius:8px;cursor:pointer}
        .container{max-width:1100px;margin:32px auto;padding:0 20px}
        .card{background:var(--card);border:1px solid var(--ring);border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px}
        .title{font-size:20px;font-weight:700;margin:0 0 12px}
        .note{background:#FFFBEB;border-left:4px solid var(--warn);padding:12px;border-radius:8px;color:#92400E;margin-bottom:16px}
        table{width:100%;border-collapse:collapse}
        thead th{font-size:12px;text-transform:uppercase;text-align:left;color:#6B7280;border-bottom:1px solid var(--ring);padding:12px}
        tbody td{padding:12px;border-bottom:1px solid #F3F4F6}
        .btn{display:inline-block;background:var(--primary);color:#fff;border:none;border-radius:10px;padding:10px 14px;font-weight:600;text-decoration:none;cursor:pointer}
        .btn-danger{background:var(--danger)}
        .actions{margin-top:16px;display:flex;justify-content:flex-end}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="app-header">
        <div class="brand"><span class="logo">MyFRS</span><span>Edit RPS</span></div>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </nav>
    </header>

    <main class="container">
        @if(session('success'))
            <div class="card" style="border-left:4px solid #10B981">{{ session('success') }}</div>
        @endif

        <section class="card">
            <h2 class="title">Edit Rencana Studi (Drop Mata Kuliah)</h2>
            <p class="muted">Status RPS Anda saat ini adalah <strong style="color:#B45309">Revisi</strong>. Silakan drop mata kuliah yang tidak diperlukan sesuai catatan dari dosen Anda. Setelah selesai, ajukan kembali RPS Anda.</p>

            @if($rps->catatan_dosen)
                <div class="note">
                    <div style="font-weight:700">Catatan dari Dosen:</div>
                    <div style="font-style:italic">"{{ $rps->catatan_dosen }}"</div>
                </div>
            @endif

            <div style="overflow-x:auto">
                <table>
                    <thead>
                        <tr>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th style="text-align:right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rps->mataKuliah as $mk)
                            <tr>
                                <td>{{ $mk->kode_mk }}</td>
                                <td>{{ $mk->nama_mk }}</td>
                                <td>{{ $mk->sks }}</td>
                                <td style="text-align:right">
                                    <form action="{{ route('mahasiswa.rps.drop', $mk->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin drop mata kuliah ini?');" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Drop</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;color:#6B7280">Tidak ada mata kuliah untuk di-drop.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="actions" style="border-top:1px solid var(--ring);padding-top:16px">
                <form action="{{ route('mahasiswa.rps.resubmit') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn">Ajukan Ulang RPS</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>

