<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Sistem Rencana Studi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Base Body Style */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa; /* A clean, light grey background */
            color: #1a202c;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* App Header & Navigation */
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
        .my-frs:hover {
            color: #4a90e2;
        }
        
        /* Dropdown Menu Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: #4a5568;
            font-size: 0.875rem;
            transition: background-color 0.2s ease;
        }
        .dropdown-toggle:hover {
            background-color: #f7fafc;
        }
        
        .dropdown-toggle .user-name {
            display: none;
        }
        @media (min-width: 640px) {
            .dropdown-toggle .user-name {
                display: block;
            }
        }

        .dropdown-toggle svg {
            width: 1rem;
            height: 1rem;
            stroke: currentColor;
            transition: transform 0.2s ease;
        }

        .dropdown-toggle.open svg {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
            min-width: 12rem; /* 192px */
            z-index: 20;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.875rem;
            color: #4a5568;
            text-decoration: none;
            box-sizing: border-box;
        }
        .dropdown-item:hover {
            background-color: #f7fafc;
        }
        
        .dropdown-item-form button {
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #4a5568;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }
        .dropdown-item-form button:hover {
            background-color: #f7fafc;
        }

        /* Main Content Area */
        .main-content {
            width: 100%;
            flex-grow: 1;
            padding: 3rem 0; /* py-12 equivalent */
            box-sizing: border-box;
        }

        .container {
            max-width: 1280px; /* max-w-7xl */
            margin: 0 auto;
            padding: 0 1.5rem; /* sm:px-6 lg:px-8 */
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1a202c;
            margin: 0 0 1.5rem 0;
        }
        
        /* Grid Layout for Dashboard Cards */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr; /* Default to 1 column */
            gap: 1.5rem; /* gap-6 equivalent */
        }

        @media (min-width: 768px) { /* md: equivalent */
            .grid-container {
                grid-template-columns: repeat(2, 1fr); /* 2 columns on medium screens and up */
            }
        }

        /* Content Card */
        .content-card {
            background-color: #ffffff;
            border-radius: 0.75rem; /* sm:rounded-lg */
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); /* shadow-sm */
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            padding: 1.5rem; /* p-6 */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 1.125rem; /* text-lg */
            font-weight: 600;
            margin: 0 0 0.5rem 0;
            color: #1a202c;
        }

        .card-text {
            font-size: 0.875rem; /* text-sm */
            color: #718096; /* text-gray-600 */
            line-height: 1.5;
            flex-grow: 1; /* Pushes the button to the bottom */
            margin: 0;
        }

        .card-text .font-bold {
            font-weight: 700;
            color: #2d3748;
        }

        .card-action {
            margin-top: 1rem; /* mt-4 */
        }

        /* Button Styles */
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem; /* px-4 py-2 */
            border: 1px solid transparent;
            border-radius: 0.375rem; /* rounded-md */
            font-weight: 600; /* font-semibold */
            font-size: 0.75rem; /* text-xs */
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.05em; /* tracking-widest */
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .button-green {
            background-color: #38a169; /* bg-green-600 */
        }
        .button-green:hover {
            background-color: #2f855a; /* hover:bg-green-700 */
        }

        .button-blue {
            background-color: #3182ce; /* bg-blue-600 */
        }
        .button-blue:hover {
            background-color: #2b6cb0; /* hover:bg-blue-700 */
        }

    </style>
</head>
<body>

    <!-- Application Header -->
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
                        <button type="submit">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Heading -->
            <h2 class="page-title">
                Halo, {{ Auth::user()->name }}!
            </h2>

            <!-- Grid Container for Cards -->
            <div class="grid-container">

                <!-- Kartu Validasi RPS -->
                <div class="content-card">
                    <div class="card-body">
                        <h3 class="card-title">Validasi Rencana Studi</h3>
                        <p class="card-text">
                            Anda memiliki <span class="font-bold">{{ $jumlahRpsMenunggu ?? 5 }}</span> mahasiswa yang memerlukan validasi RPS.
                        </p>
                        <div class="card-action">
                            <a href="{{ route('dosen.validasi.index') }}" class="button button-green">
                                Lihat Daftar Validasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kartu Verifikasi Pendaftar Baru -->
                <div class="content-card">
                    <div class="card-body">
                        <h3 class="card-title">Verifikasi Mahasiswa Baru</h3>
                        <p class="card-text">
                            Ada <span class="font-bold">{{ $jumlahPendaftarBaru ?? 2 }}</span> pendaftar baru yang menunggu persetujuan Anda.
                        </p>
                        <div class="card-action">
                            <a href="{{ route('dosen.verifikasi.list') }}" class="button button-blue">
                                Verifikasi Pendaftar
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('user-menu-button');
            const dropdownMenu = document.getElementById('user-menu');

            if (dropdownToggle && dropdownMenu) {
                // Toggle dropdown on button click
                dropdownToggle.addEventListener('click', function(event) {
                    event.stopPropagation();
                    dropdownMenu.classList.toggle('show');
                    this.classList.toggle('open');
                });

                // Close dropdown if clicked outside
                window.addEventListener('click', function(event) {
                    if (dropdownMenu.classList.contains('show') && !dropdownToggle.contains(event.target)) {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.classList.remove('open');
                    }
                });
            }
        });
    </script>
</body>
</html>

