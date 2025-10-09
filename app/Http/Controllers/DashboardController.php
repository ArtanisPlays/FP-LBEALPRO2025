<?php

namespace App\Http\Controllers;

use App\Models\RencanaStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } 
        
        if ($user->role === 'dosen') {
            // Menghitung jumlah RPS yang statusnya 'diajukan' atau 'perlu_persetujuan'
            $jumlahRpsMenunggu = RencanaStudi::whereHas('mahasiswa', function ($query) use ($user) {
                $query->where('dosen_wali_id', $user->id);
            })->whereIn('status', ['diajukan', 'perlu_persetujuan'])->count();

            // Menghitung jumlah mahasiswa baru yang menunggu persetujuan
            $jumlahPendaftarBaru = User::where('role', 'mahasiswa')->where('status', 'pending')->count();
            
            return view('dosen.dashboard', compact('jumlahRpsMenunggu', 'jumlahPendaftarBaru'));
        } 
        
        // Logika untuk Mahasiswa
        if ($user->mahasiswa) {
            $mahasiswa = $user->mahasiswa;
            $rps = RencanaStudi::where('mahasiswa_id', $mahasiswa->id)
                ->where('tahun_akademik', '2024/2025') // TODO: Dinamiskan
                ->first();
            
            // HANYA kirim data mahasiswa dan rps, BUKAN daftar mata kuliah
            return view('mahasiswa.dashboard', compact('mahasiswa', 'rps'));
        }

        // Jika data mahasiswa belum ada setelah login (misal: baru register)
        return view('mahasiswa.data_tidak_lengkap');
    }
}

