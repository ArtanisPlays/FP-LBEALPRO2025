<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Validasi RPS - MyFRS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#111827;--muted:#6B7280;--bg:#F3F4F6;--card:#fff;--ring:#E5E7EB;--primary:#4F46E5}
        body{margin:0;font-family:'Inter',sans-serif;background:var(--bg);color:var(--ink)}

        /* App Header & Navigation (match dashboard) */
        .app-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 2rem;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4rem; /* 64px */
            max-width: 1280px;
            margin: 0 auto;
        }
        .my-frs {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2d3748;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .my-frs:hover { color: #4a90e2; }
        .dropdown { position: relative; display: inline-block; }
        .dropdown-toggle { background-color: transparent; border: none; cursor: pointer; padding: 0.5rem; border-radius: 0.375rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 600; color: #4a5568; font-size: 0.875rem; transition: background-color 0.2s ease; }
        .dropdown-toggle:hover { background-color: #f7fafc; }
        .dropdown-toggle .user-name { display: none; }
        @media (min-width: 640px) { .dropdown-toggle .user-name { display: block; } }
        .dropdown-toggle svg { width: 1rem; height: 1rem; stroke: currentColor; transition: transform 0.2s ease; }
        .dropdown-toggle.open svg { transform: rotate(180deg); }
        .dropdown-menu { position: absolute; top: calc(100% + 0.5rem); right: 0; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; min-width: 12rem; z-index: 20; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s; }
        .dropdown-menu.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item { display: block; width: 100%; padding: 0.75rem 1rem; text-align: left; font-size: 0.875rem; color: #4a5568; text-decoration: none; box-sizing: border-box; }
        .dropdown-item:hover { background-color: #f7fafc; }
        .dropdown-item-form button { width: 100%; background: none; border: none; cursor: pointer; text-align: left; padding: 0.75rem 1rem; font-size: 0.875rem; color: #4a5568; font-family: 'Inter', sans-serif; font-weight: 500; }
        .dropdown-item-form button:hover { background-color: #f7fafc; }

        .container{max-width:1100px;margin:32px auto;padding:0 20px}
        .card{background:var(--card);border:1px solid var(--ring);border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:24px}
        table{width:100%;border-collapse:collapse}
        thead th{font-size:12px;text-transform:uppercase;text-align:left;color:#6B7280;border-bottom:1px solid var(--ring);padding:12px}
        tbody td{padding:12px;border-bottom:1px solid #F3F4F6}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="app-header">
        <nav class="navbar">
            <!-- Logo -->
            <a href="{{ url('/dashboard') }}" class="my-frs">MyFRS <span>Dosen</span></a>

            <!-- User Menu Dropdown -->
            <div class="dropdown">
                <button id="user-menu-button" class="dropdown-toggle" type="button">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div id="user-menu" class="dropdown-menu">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                    <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item-form">
                        @csrf
                        <button type="submit">Log Out</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <section class="card">
            <h2 style="margin:0 0 12px;font-size:20px;font-weight:700">Daftar Pengajuan RPS</h2>
            <p class="muted">Berikut adalah daftar mahasiswa bimbingan Anda yang telah mengajukan RPS dan menunggu persetujuan.</p>
            <div style="overflow-x:auto;margin-top:16px">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Tanggal Pengajuan</th>
                            <th style="text-align:right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listRps as $rps)
                            <tr>
                                <td>{{ $rps->mahasiswa->user->name }}</td>
                                <td>{{ $rps->mahasiswa->nim }}</td>
                                <td>{{ $rps->created_at->format('d F Y') }}</td>
                                <td style="text-align:right">
                                    <a href="{{ route('dosen.validasi.show', $rps->id) }}" style="color:var(--primary);text-decoration:none;font-weight:600">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;color:#6B7280">Tidak ada pengajuan RPS yang perlu divalidasi saat ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.getElementById('user-menu-button');
        const dropdownMenu = document.getElementById('user-menu');
        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('show');
                this.classList.toggle('open');
            });
            window.addEventListener('click', function(event) {
                if (dropdownMenu.classList.contains('show') && !dropdownToggle.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                    dropdownToggle.classList.remove('open');
                }
            });
        }
    });
</script>
    