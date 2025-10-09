<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Persetujuan Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }
        .content {
            padding: 2rem;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #111827;
        }
        p {
            color: #4b5563;
            margin-bottom: 2rem;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            font-weight: 500;
            font-size: 0.875rem;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            font-size: 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .button-container {
            text-align: right;
            margin-top: 2rem;
        }
        button {
            padding: 0.75rem 1.5rem;
            background-color: #16a34a;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
        button:hover {
            background-color: #15803d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Formulir Persetujuan Mahasiswa</h1>
            <p>
                Lengkapi data untuk mengaktifkan akun mahasiswa <strong>{{ $user->name }}</strong> ({{ $user->email }}).
            </p>
            
            <form method="POST" action="{{ route('dosen.verifikasi.approve.store', $user) }}">
                @csrf
                
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input id="nim" type="text" name="nim" required autofocus placeholder="Masukkan NIM mahasiswa">
                </div>
                
                <div class="form-group">
                    <label for="program_studi">Program Studi</label>
                    <input id="program_studi" type="text" name="program_studi" required placeholder="Contoh: Teknik Informatika">
                </div>
                
                <div class="button-container">
                    <button type="submit">
                        Setujui dan Aktifkan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

