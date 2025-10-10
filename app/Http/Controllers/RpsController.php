<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\RencanaStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RpsController extends Controller
{
    public function create()
    {
        // Asumsi mahasiswa saat ini berada di semester 3
        $currentSemester = 3;
        $currentUser = Auth::user();

        // Ambil SEMUA mata kuliah dari semester sebelumnya sebagai "transkrip"
        $completedCourses = MataKuliah::where('semester', '<', $currentSemester)
            ->orderBy('semester', 'asc')
            ->get();
        
        // --- MODIFIKASI UNTUK DEMO SPESIFIK ---
        // Logika ini hanya berlaku untuk Rina
        if ($currentUser->email === 'rina.mahasiswa@its.ac.id') {
            // Jika user adalah Rina, anggap dia BELUM LULUS Struktur Data
            $passedCourseCodes = $completedCourses->where('kode_mk', '!=', 'EF234201')->pluck('kode_mk')->toArray();
        } else {
            // Untuk mahasiswa lain, anggap semua mata kuliah sebelumnya LULUS
            $passedCourseCodes = $completedCourses->pluck('kode_mk')->toArray();
        }


        // Ambil semua mata kuliah yang ditawarkan di semester ini DAN semester atas
        $availableCourses = MataKuliah::where('semester', '>=', $currentSemester)
                                ->with('prerequisites') // Eager load prerequisites
                                ->orderBy('semester', 'asc')
                                ->get();
        
        $unmetPrerequisites = [];
        foreach ($availableCourses as $mk) {
            $isWarning = $mk->semester > $currentSemester; 
            $unmetList = [];

            foreach ($mk->prerequisites as $prasyarat) {
                if (!in_array($prasyarat->kode_mk, $passedCourseCodes)) {
                    $unmetList[] = $prasyarat->nama_mk;
                }
            }
            if (!empty($unmetList)) {
                $unmetPrerequisites[$mk->id] = [
                    'courses' => $unmetList,
                    'is_warning' => $isWarning
                ];
            }
        }
        
        return view('mahasiswa.rps.create', compact('availableCourses', 'completedCourses', 'unmetPrerequisites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matakuliah_ids' => 'required|array|min:1',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;
        $currentUser = Auth::user();
        
        $currentSemester = 3;
        
        // --- MODIFIKASI UNTUK DEMO SPESIFIK (SAAT MENYIMPAN) ---
        if ($currentUser->email === 'rina.mahasiswa@its.ac.id') {
             $passedCourseCodes = MataKuliah::where('semester', '<', $currentSemester)
                ->where('kode_mk', '!=', 'EF234201')
                ->pluck('kode_mk')->toArray();
        } else {
             $passedCourseCodes = MataKuliah::where('semester', '<', $currentSemester)
                ->pluck('kode_mk')->toArray();
        }
        
        $selectedMKs = MataKuliah::with('prerequisites')->whereIn('id', $request->matakuliah_ids)->get();

        $jadwal = [];
        $needsApproval = false;

        foreach ($selectedMKs as $mk) {
            if ($mk->semester > $currentSemester) {
                $needsApproval = true;
            }

            foreach($mk->prerequisites as $prasyarat) {
                if (!in_array($prasyarat->kode_mk, $passedCourseCodes)) {
                    // Jika ini MK semester atas, abaikan prasyarat (hanya peringatan)
                    if ($mk->semester > $currentSemester) {
                        continue;
                    }
                    // Jika MK semester ini, tolak karena prasyarat tidak terpenuhi
                    return back()->withErrors(['jadwal_bentrok' => "Anda tidak dapat mengambil '{$mk->nama_mk}' karena prasyarat '{$prasyarat->nama_mk}' belum terpenuhi."])->withInput();
                }
            }

            $waktu = "{$mk->hari}-{$mk->jam_mulai}-{$mk->jam_selesai}";
            if (isset($jadwal[$waktu])) {
                return back()->withErrors(['jadwal_bentrok' => "Jadwal bentrok antara '{$mk->nama_mk}' dan '{$jadwal[$waktu]}'."])->withInput();
            }
            $jadwal[$waktu] = $mk->nama_mk;
        }
        
        $status = $needsApproval ? 'perlu_persetujuan' : 'diajukan';

        DB::transaction(function () use ($request, $mahasiswa, $currentSemester, $status) {
            $rps = RencanaStudi::updateOrCreate(
                ['mahasiswa_id' => $mahasiswa->id, 'tahun_akademik' => '2024/2025', 'semester' => $currentSemester],
                ['status' => $status, 'catatan_dosen' => null]
            );
            $rps->mataKuliah()->sync($request->matakuliah_ids);
        });
        
        return redirect()->route('dashboard')->with('success', 'RPS berhasil diajukan!');
    }

    public function jadwal()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $rps = RencanaStudi::where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_akademik', '2024/2025') // TODO: Dinamiskan nanti
            ->where('status', 'disetujui')
            ->with('mataKuliah')
            ->firstOrFail();

        return view('mahasiswa.jadwal.index', compact('rps'));
    }

    public function edit()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $rps = RencanaStudi::where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_akademik', '2024/2025') // TODO: Dinamiskan nanti
            ->whereIn('status', ['revisi'])
            ->with('mataKuliah')
            ->firstOrFail();
            
        return view('mahasiswa.rps.edit', compact('rps'));
    }

    public function dropMataKuliah($mataKuliahId)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $rps = RencanaStudi::where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_akademik', '2024/2025') // TODO: Dinamiskan nanti
            ->where('status', 'revisi')
            ->firstOrFail();

        $rps->mataKuliah()->detach($mataKuliahId);

        return redirect()->back()->with('success', 'Mata kuliah berhasil di-drop.');
    }

    public function resubmit()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $rps = RencanaStudi::where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_akademik', '2024/2025') // TODO: Dinamiskan nanti
            ->where('status', 'revisi')
            ->firstOrFail();
        
        $rps->status = 'diajukan';
        $rps->catatan_dosen = null;
        $rps->save();

        return redirect()->route('dashboard')->with('success', 'RPS yang telah direvisi berhasil diajukan kembali.');
    }
}
