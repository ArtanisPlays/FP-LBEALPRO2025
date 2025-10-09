<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Rencana Studi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Base Styles from Previous Theme */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #f0f4f8 0%, #ffffff 100%);
            color: #1a202c;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Changed to center content vertically for login page */
            justify-content: center; 
            min-height: 100vh;
            padding: 1rem;
            box-sizing: border-box;
        }

        .my-frs {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2d3748;
            text-decoration: none;
            transition: color 0.3s ease;
            /* Positioned logo at the top left */
            position: absolute;
            top: 1.5rem;
            left: 2rem;
        }
        .my-frs:hover {
            color: #4a90e2;
        }

        /* Login Card */
        .login-card {
            text-align: left; /* Align form content to the left */
            padding: 2.5rem;
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width: 420px; /* Optimal width for a login form */
            width: 100%;
        }

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

        /* Form Styles */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #2d3748;
            box-sizing: border-box;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }

        /* Checkbox and Links */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 1px solid #cbd5e0;
            color: #4a90e2; /* Color of the checkmark */
            margin-right: 0.5rem;
            cursor: pointer;
            flex-shrink: 0;
        }
        
        .remember-me input[type="checkbox"]:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }

        .remember-me label {
            font-size: 0.875rem;
            color: #4a5568;
            cursor: pointer;
        }

        .forgot-password-link {
            font-size: 0.875rem;
            color: #4a90e2;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-password-link:hover {
            text-decoration: underline;
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

        /* Session Status Message */
        .session-status {
            background-color: #e6fffa;
            color: #2c7a7b;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        
        /* Error Message */
        .input-error {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <a href="/" class="my-frs">MyFRS</a>

    <div class="login-card">

        <div class="card-header">
            <h1>Selamat datang di MyFRS</h1>
            <p>Silakan masukkan kredensial Anda untuk masuk.</p>
        </div>
        
        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                @error('email')
                    <p class="input-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                 @error('password')
                    <p class="input-error">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Options -->
            <div class="form-options">
                <!-- Remember Me -->
                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Remember me</label>
                </div>
    
                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <a class="forgot-password-link" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="primary-button">
                    Log in
                </button>
            </div>
        </form>
    </div>

</body>
</html>
