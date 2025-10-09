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

        // Ambil SEMUA kode MK yang sudah 'lulus' (asumsi: semua MK dari semester < 3)
        $passedCourseCodes = MataKuliah::where('semester', '<', $currentSemester)
                                        ->pluck('kode_mk')
                                        ->toArray();

        // Ambil semua mata kuliah yang ditawarkan di semester ini
        $mataKuliahs = MataKuliah::where('semester', $currentSemester)
                                ->with('prerequisites') // Eager load prerequisites
                                ->get();
        
        $unmetPrerequisites = [];
        foreach ($mataKuliahs as $mk) {
            foreach ($mk->prerequisites as $prasyarat) {
                // Jika kode prasyarat tidak ada di daftar MK yang sudah lulus
                if (!in_array($prasyarat->kode_mk, $passedCourseCodes)) {
                    // Tandai MK ini sebagai tidak bisa diambil
                    $unmetPrerequisites[$mk->id][] = $prasyarat->nama_mk;
                }
            }
        }

        return view('mahasiswa.rps.create', compact('mataKuliahs', 'unmetPrerequisites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matakuliah_ids' => 'required|array|min:1',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;
        
        // Asumsi mahasiswa saat ini berada di semester 3
        $currentSemester = 3;
        $passedCourseCodes = MataKuliah::where('semester', '<', $currentSemester)->pluck('kode_mk')->toArray();
        
        $selectedMKs = MataKuliah::with('prerequisites')->whereIn('id', $request->matakuliah_ids)->get();

        $jadwal = [];
        foreach ($selectedMKs as $mk) {
            // Validasi Prasyarat
            foreach($mk->prerequisites as $prasyarat) {
                if (!in_array($prasyarat->kode_mk, $passedCourseCodes)) {
                    return back()->withErrors(['jadwal_bentrok' => "Anda tidak dapat mengambil '{$mk->nama_mk}' karena prasyarat '{$prasyarat->nama_mk}' belum terpenuhi."])->withInput();
                }
            }

            // Validasi Jadwal Bentrok
            $waktu = "{$mk->hari}-{$mk->jam_mulai}-{$mk->jam_selesai}";
            if (in_array($waktu, $jadwal)) {
                return back()->withErrors(['jadwal_bentrok' => "Jadwal bentrok untuk mata kuliah '{$mk->nama_mk}'."])->withInput();
            }
            $jadwal[] = $waktu;
        }

        DB::transaction(function () use ($request, $mahasiswa, $currentSemester) {
            $rps = RencanaStudi::updateOrCreate(
                ['mahasiswa_id' => $mahasiswa->id, 'tahun_akademik' => '2024/2025', 'semester' => $currentSemester],
                ['status' => 'diajukan', 'catatan_dosen' => null]
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

