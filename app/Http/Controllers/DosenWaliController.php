<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RencanaStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\RpsStatusNotification;

class DosenWaliController extends Controller
{
    /**
     * Menampilkan daftar RPS dari mahasiswa bimbingan.
     */
    public function index()
    {
        $dosenId = Auth::id();
        $listRps = RencanaStudi::whereHas('mahasiswa', function ($query) use ($dosenId) {
            $query->where('dosen_wali_id', $dosenId);
        })
        // Hapus filter ini agar semua status RPS tampil
        // ->where('status', 'diajukan') 
        ->with('mahasiswa.user')->get();

        return view('dosen.validasi.index', compact('listRps'));
    }

    /**
     * Menampilkan detail satu RPS untuk divalidasi.
     */
    public function show($id)
    {
        $rps = RencanaStudi::with('mahasiswa.user', 'mataKuliah')->findOrFail($id);
        // Pastikan dosen hanya bisa melihat RPS mahasiswa bimbingannya
        if ($rps->mahasiswa->dosen_wali_id !== Auth::id()) {
            abort(403);
        }
        return view('dosen.validasi.show', compact('rps'));
    }

    /**
     * Memperbarui status RPS (Setuju, Tolak, Revisi).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak,revisi',
            'catatan' => 'nullable|string',
        ]);
        
        $rps = RencanaStudi::findOrFail($id);
        
        // Pastikan dosen hanya bisa mengubah status RPS mahasiswa bimbingannya
        if ($rps->mahasiswa->dosen_wali_id !== Auth::id()) {
            abort(403);
        }

        $rps->status = $request->status;
        $rps->catatan_dosen = $request->catatan;
        $rps->save();

        // Kirim notifikasi ke mahasiswa (dinonaktifkan sementara)
        // $mahasiswaUser = $rps->mahasiswa->user;
        // $mahasiswaUser->notify(new RpsStatusNotification($rps));

        return redirect()->route('dosen.validasi.index')->with('success', 'Status RPS berhasil diperbarui.');
    }

    // --- MULAI BLOK KODE BARU UNTUK VERIFIKASI ---

    /**
     * Menampilkan daftar pengguna baru yang menunggu verifikasi.
     */
    public function verificationList()
    {
        $pendingUsers = User::where('role', 'mahasiswa')
                              ->where('status', 'pending')
                              ->get();
        return view('dosen.verifikasi.list', compact('pendingUsers'));
    }

    /**
     * Menampilkan form untuk menyetujui dan melengkapi data mahasiswa.
     */
    public function showApproveForm(User $user)
    {
        return view('dosen.verifikasi.approve', compact('user'));
    }

    /**
     * Memproses persetujuan mahasiswa.
     */
    public function approveUser(Request $request, User $user)
    {
        $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim',
            'program_studi' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $user) {
            // Update status user menjadi 'active'
            $user->status = 'active';
            $user->save();

            // Buat entri baru di tabel mahasiswa
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'program_studi' => $request->program_studi,
                'dosen_wali_id' => Auth::id(), // Dosen yang menyetujui menjadi dosen walinya
            ]);
        });
        
        return redirect()->route('dosen.verifikasi.list')->with('success', 'Akun mahasiswa ' . $user->name . ' berhasil diaktifkan.');
    }

    /**
     * Menolak dan menghapus pendaftaran mahasiswa.
     */
    public function rejectUser(User $user)
    {
        // Pastikan user yang akan dihapus statusnya 'pending'
        if ($user->status === 'pending' && $user->role === 'mahasiswa') {
            $userName = $user->name;
            $user->delete();
            return redirect()->route('dosen.verifikasi.list')->with('success', 'Pendaftaran mahasiswa ' . $userName . ' berhasil ditolak.');
        }

        return redirect()->route('dosen.verifikasi.list')->with('error', 'Gagal menolak pendaftaran.');
    }

    // --- AKHIR BLOK KODE BARU ---
}

