<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RencanaStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DosenWaliController extends Controller
{
    /**
     * Menampilkan daftar RPS dari mahasiswa bimbingan.
     */
    public function index()
    {
        $dosenId = Auth::id();
        // Tampilkan semua RPS bimbingan, urutkan berdasarkan yang paling butuh perhatian
        $listRps = RencanaStudi::whereHas('mahasiswa', function ($query) use ($dosenId) {
            $query->where('dosen_wali_id', $dosenId);
        })
        ->with('mahasiswa.user')
        ->orderByRaw("FIELD(status, 'perlu_persetujuan', 'diajukan', 'revisi', 'disetujui', 'ditolak')")
        ->get();

        return view('dosen.validasi.index', compact('listRps'));
    }
    
    public function show($id)
    {
        $rps = RencanaStudi::with('mahasiswa.user', 'mataKuliah')->findOrFail($id);
        if ($rps->mahasiswa->dosen_wali_id !== Auth::id()) {
            abort(403);
        }
        return view('dosen.validasi.show', compact('rps'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak,revisi',
            'catatan' => 'nullable|string',
        ]);
        
        $rps = RencanaStudi::findOrFail($id);
        
        if ($rps->mahasiswa->dosen_wali_id !== Auth::id()) {
            abort(403);
        }

        $rps->status = $request->status;
        $rps->catatan_dosen = $request->catatan;
        $rps->save();

        return redirect()->route('dosen.validasi.index')->with('success', 'Status RPS berhasil diperbarui.');
    }
    
    // --- FUNGSI BARU UNTUK VERIFIKASI ---

    public function verificationList()
    {
        $pendingUsers = User::where('role', 'mahasiswa')
                              ->where('status', 'pending')
                              ->get();
        return view('dosen.verifikasi.list', compact('pendingUsers'));
    }

    public function showApproveForm(User $user)
    {
        return view('dosen.verifikasi.approve', compact('user'));
    }

    public function approveUser(Request $request, User $user)
    {
        $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim',
            'program_studi' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $user) {
            $user->status = 'active';
            $user->email_verified_at = now(); // Langsung verifikasi email
            $user->save();

            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'program_studi' => $request->program_studi,
                'dosen_wali_id' => Auth::id(),
            ]);
        });
        
        return redirect()->route('dosen.verifikasi.list')->with('success', 'Akun mahasiswa ' . $user->name . ' berhasil diaktifkan.');
    }

    public function rejectUser(User $user)
    {
        if ($user->status === 'pending' && $user->role === 'mahasiswa') {
            $userName = $user->name;
            $user->delete();
            return redirect()->route('dosen.verifikasi.list')->with('success', 'Pendaftaran mahasiswa ' . $userName . ' berhasil ditolak.');
        }

        return redirect()->route('dosen.verifikasi.list')->with('error', 'Gagal menolak pendaftaran.');
    }
}

