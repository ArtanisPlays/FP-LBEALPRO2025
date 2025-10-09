<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RencanaStudi; // Tambahkan ini
use App\Models\User; // Tambahkan ini

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'dosen') {
            // --- MULAI BLOK YANG DIPERBARUI ---
            $dosenId = $user->id;
            
            // Hitung jumlah RPS yang statusnya 'diajukan' dari mahasiswa bimbingan
            $jumlahRpsMenunggu = RencanaStudi::whereHas('mahasiswa', function ($query) use ($dosenId) {
                $query->where('dosen_wali_id', $dosenId);
            })->where('status', 'diajukan')->count();

            // Hitung jumlah pendaftar baru yang statusnya 'pending'
            $jumlahPendaftarBaru = User::where('role', 'mahasiswa')
                                           ->where('status', 'pending')
                                           ->count();
                                           
            // Kirim kedua variabel ke view
            return view('dosen.dashboard', compact('jumlahRpsMenunggu', 'jumlahPendaftarBaru'));
            // --- AKHIR BLOK YANG DIPERBARUI ---

        } elseif ($user->role === 'mahasiswa') {
            $mahasiswa = $user->mahasiswa;

            // Jika akun mahasiswa ada tapi datanya belum lengkap
            if (!$mahasiswa) {
                return view('mahasiswa.data_tidak_lengkap');
            }

            $rps = RencanaStudi::where('mahasiswa_id', $mahasiswa->id)
                ->where('tahun_akademik', '2024/2025') // Contoh tahun akademik
                ->first();
            return view('mahasiswa.dashboard', compact('mahasiswa', 'rps'));
        }

        // Fallback untuk peran lain atau jika ada kondisi tak terduga
        return view('dashboard');
    }
}

