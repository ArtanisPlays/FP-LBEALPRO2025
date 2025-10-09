<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - Sistem Rencana Studi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* base styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #1a202c;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* header and navigation */
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
            height: 4rem;
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
        
        /* dropdown menu */
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
            min-width: 12rem;
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

        /* main content */
        .main-content {
            width: 100%;
            flex-grow: 1;
            padding: 3rem 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        /* profile page layout */
        .profile-layout {
            max-width: 896px; /* max-w-4xl, a bit smaller for profile */
            margin: 0 auto;
            display: grid;
            gap: 1.5rem;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1a202c;
            margin: 0 0 1.5rem 0;
            text-align: center;
        }
        
        .content-card {
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-body {
            padding: 2rem;
        }

        .form-section {
            max-width: 640px; /* max-w-xl */
        }
        
        .section-header {
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1a202c;
            margin: 0;
        }

        .section-description {
            font-size: 0.875rem;
            color: #718096;
            margin-top: 0.25rem;
        }

        /* form elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            font-size: 0.875rem;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid #cbd5e0;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            box-sizing: border-box;
        }
        .form-input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            border: 1px solid transparent;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: #ffffff;
            text-decoration: none;
            transition: background-color 0.2s ease;
            cursor: pointer;
        }
        
        .button-primary {
            background-color: #2d3748;
        }
        .button-primary:hover {
            background-color: #1a202c;
        }
        
        .button-danger {
            background-color: #e53e3e;
        }
        .button-danger:hover {
            background-color: #c53030;
        }

        .status-message {
            font-size: 0.875rem;
            font-weight: 500;
            color: #4a5568;
        }

    </style>
</head>
<body>

    <!-- header -->
    <header class="app-header">
        <nav class="navbar">
            <a href="<?php echo e(url('/dashboard')); ?>" class="my-frs">MyFRS</a>
            
            <div class="dropdown">
                <button id="user-menu-button" class="dropdown-toggle" type="button">
                    <span class="user-name"><?php echo e(Auth::user()->name); ?></span>
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </button>
                <div id="user-menu" class="dropdown-menu">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">Profile</a>
                    <a href="<?php echo e(route('dashboard')); ?>" class="dropdown-item">Dashboard</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="dropdown-item-form">
                        <?php echo csrf_field(); ?>
                        <button type="submit">Log Out</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- page content -->
    <main class="main-content">
        <div class="container">
            <h2 class="page-title">Informasi Profil</h2>
            <div class="profile-layout">

                <!-- update profile information -->
                <div class="content-card">
                    <div class="card-body">
                        <section class="form-section">
                            <header class="section-header">
                                <h2 class="section-title">Update Profil</h2>
                                <p class="section-description">Update informasi profil Anda dan email anda.</p>
                            </header>
                            <form method="post" action="<?php echo e(route('profile.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('patch'); ?>
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input id="name" name="name" type="text" class="form-input" value="<?php echo e(old('name', $user->name)); ?>" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" name="email" type="email" class="form-input" value="<?php echo e(old('email', $user->email)); ?>" required>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="button button-primary">Simpan</button>
                                    <?php if(session('status') === 'profile-updated'): ?>
                                        <p class="status-message">Tersimpan.</p>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <!-- update password -->
                <div class="content-card">
                    <div class="card-body">
                        <section class="form-section">
                            <header class="section-header">
                                <h2 class="section-title">Update Password</h2>
                                <p class="section-description">Lakukan dengan hati-hati, pastikan password anda panjang dan aman.</p>
                            </header>
                            <form method="post" action="<?php echo e(route('password.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>
                                <div class="form-group">
                                    <label for="current_password" class="form-label">Password Saat Ini</label>
                                    <input id="current_password" name="current_password" type="password" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input id="password" name="password" type="password" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" required>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="button button-primary">Simpan</button>
                                     <?php if(session('status') === 'password-updated'): ?>
                                        <p class="status-message">Tersimpan.</p>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </main>
    
    <script>
        // script to toggle user dropdown menu
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
</body>
</html>
<?php /**PATH C:\Users\Mitra\KULIAH\SEM 3\LBE\final-web-frs\resources\views/profile/edit.blade.php ENDPATH**/ ?>