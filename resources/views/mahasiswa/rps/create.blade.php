<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Rencana Studi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; color: #1f2937; margin: 0; padding: 2rem; }
        .container { max-width: 900px; margin: 0 auto; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); overflow: hidden; }
        .content { padding: 2rem; }
        h1 { font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; }
        th, td { padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
        thead { background-color: #f9fafb; }
        th { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; }
        tbody tr:hover { background-color: #f9fafb; }
        td { font-size: 0.875rem; vertical-align: top; }
        input[type="checkbox"] { width: 1rem; height: 1rem; border-radius: 0.25rem; border-color: #d1d5db; }
        input[type="checkbox"]:disabled { background-color: #e5e7eb; cursor: not-allowed; }
        button { display: inline-flex; align-items: center; padding: 0.6rem 1.2rem; background-color: #1f2937; border: 1px solid transparent; border-radius: 0.375rem; font-weight: 600; font-size: 0.75rem; color: #ffffff; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: background-color 0.2s ease-in-out; margin-top: 1.5rem; }
        button:hover { background-color: #374151; }
        .error-box { padding: 1rem; margin-bottom: 1rem; font-size: 0.875rem; color: #991b1b; background-color: #fee2e2; border-radius: 0.375rem; border: 1px solid #fca5a5; }
        .error-box .font-medium { font-weight: 600; }
        .prasyarat-info { font-size: 0.75rem; color: #ef4444; margin-top: 0.25rem; }
        .disabled-row { background-color: #f9fafb; opacity: 0.6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Isi Rencana Studi (Semester 3)</h1>

            @if($errors->has('jadwal_bentrok'))
                <div class="error-box">
                    <span class="font-medium">Error!</span> {{ $errors->first('jadwal_bentrok') }}
                </div>
            @endif
            
            <form action="{{ route('mahasiswa.rps.store') }}" method="POST">
                @csrf
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Pilih</th>
                                <th>Kode</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Jadwal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mataKuliahs as $mk)
                                @php
                                    $isAvailable = !isset($unmetPrerequisites[$mk->id]);
                                @endphp
                                <tr class="{{ !$isAvailable ? 'disabled-row' : '' }}">
                                    <td>
                                        <input type="checkbox" name="matakuliah_ids[]" value="{{ $mk->id }}" {{ !$isAvailable ? 'disabled' : '' }}>
                                    </td>
                                    <td>{{ $mk->kode_mk }}</td>
                                    <td>
                                        {{ $mk->nama_mk }}
                                        @if(!$isAvailable)
                                            <div class="prasyarat-info">
                                                Prasyarat belum terpenuhi: {{ implode(', ', $unmetPrerequisites[$mk->id]) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $mk->sks }}</td>
                                    <td>{{ $mk->hari }}, {{ date('H:i', strtotime($mk->jam_mulai)) }} - {{ date('H:i', strtotime($mk->jam_selesai)) }}</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #6b7280;">
                                    Tidak ada data mata kuliah yang tersedia untuk semester ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div>
                    <button type="submit">Ajukan RPS</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

