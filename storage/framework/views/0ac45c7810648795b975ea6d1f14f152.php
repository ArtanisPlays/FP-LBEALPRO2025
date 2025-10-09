<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Rencana Studi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #f0f4f8 0%, #ffffff 100%);
            color: #1a202c;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
        }

        header {
            width: 100%;
            padding: 1.5rem 2rem;
            box-sizing: border-box;
            display: flex;
            justify-content: flex-start;
        }

        .my-frs {
            font-size: 1.5rem;
            font-weight: 800; /* Bolder for more impact */
            color: #2d3748;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .my-frs:hover {
            color: #4a90e2;
        }

        main {
            text-align: center;
            padding: 3rem 2.5rem;
            /* ✨ New "Card" UI */
            background-color: #ffffff;
            border-radius: 1rem; /* Softer, larger radius */
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width: 900px;
            width: 90%;
            margin: 1rem 0;
        }

        h1 {
            font-size: 2.75rem; /* Slightly adjusted for balance */
            font-weight: 800;
            color: #1a202c;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 400; /* Lighter weight for a subtitle */
            color: #718096;
            margin-bottom: 2.5rem; /* More space before buttons */
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        nav {
            display: flex;
            gap: 1rem; /* Use gap for spacing between buttons */
            justify-content: center;
        }

        nav a {
            padding: 0.75rem 1.75rem; /* Larger, more clickable buttons */
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            border: 2px solid transparent; /* Reserve space for border */
            transition: all 0.3s ease; /* Smoother transition */
            display: inline-block;
        }

        /* ✨ Polished secondary button */
        nav a.login {
            color: #4a90e2;
            background-color: #ffffff;
            border-color: #e2e8f0;
        }

        nav a.login:hover {
            background-color: #f7fafc;
            border-color: #4a90e2;
            transform: translateY(-2px); /* Add subtle lift on hover */
            box-shadow: 0 4px 12px rgba(74, 144, 226, 0.1);
        }

        /* ✨ Polished primary button */
        nav a.register {
            color: #ffffff;
            background-color: #4a90e2; /* A more vibrant primary color */
        }

        nav a.register:hover {
            background-color: #357ebd;
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(74, 144, 226, 0.2), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        footer {
            padding: 1.5rem;
            font-size: 0.875rem;
            color: #a0aec0; /* Lighter color for less emphasis */
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

    </style>
</head>
<body>
    <header>
        <a href="#" class="my-frs">MyFRS</a>
    </header>

    <main>
        <h1>✨Sistem Formulir Rencana Studi✨</h1>
        <h2>Platform manajemen akademik untuk mahasiswa dan dosen ITS</h2>
        <?php if(Route::has('login')): ?>
            <nav>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="register">
                        Dashboard
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="login">
                        Log in
                    </a>

                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="register">
                            Register
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    </main>

    <footer>
        © 2025 Designed & Built By Mitra Partogi & Rendy Tanuwijaya    
    </footer>
</body>
</html><?php /**PATH C:\Users\Mitra\KULIAH\SEM 3\LBE\final-web-frs\resources\views/welcome.blade.php ENDPATH**/ ?>