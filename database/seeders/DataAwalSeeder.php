<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;

class DataAwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu untuk konsistensi
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Mahasiswa::truncate();
        MataKuliah::truncate();
        DB::table('matakuliah_prasyarat')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // --- BUAT PENGGUNA ---
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@kampus.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $dosen = User::create([
            'name' => 'Prof. Dr. Budi Budiman, S.Kom., M.Sc.',
            'email' => 'budi.dosen@its.ac.id',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'status' => 'active',
        ]);

        $rinaUser = User::create([
            'name' => 'Rina Pertiwi',
            'email' => 'rina.mahasiswa@its.ac.id',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
            'status' => 'active',
        ]);

        Mahasiswa::create([
            'user_id' => $rinaUser->id,
            'dosen_wali_id' => $dosen->id,
            'nim' => '5025241091',
            'program_studi' => 'Teknik Informatika',
        ]);
        
        // --- BUAT DATA MATA KULIAH DARI PDF ---
        $this->createMataKuliah();
    }
    
    private function createMataKuliah()
    {
        // Semester 1
        MataKuliah::create(['kode_mk' => 'SM234101', 'nama_mk' => 'Calculus 1', 'sks' => 3, 'semester' => 1, 'hari' => 'Senin', 'jam_mulai' => '07:30', 'jam_selesai' => '09:00']);
        $daspro = MataKuliah::create(['kode_mk' => 'EF234101', 'nama_mk' => 'Fundamental Programming', 'sks' => 4, 'semester' => 1, 'hari' => 'Selasa', 'jam_mulai' => '10:00', 'jam_selesai' => '12:30']);
        $sisdig = MataKuliah::create(['kode_mk' => 'EF234102', 'nama_mk' => 'Digital System', 'sks' => 3, 'semester' => 1, 'hari' => 'Rabu', 'jam_mulai' => '07:30', 'jam_selesai' => '09:00']);
        MataKuliah::create(['kode_mk' => 'EF234103', 'nama_mk' => 'Linear Algebra', 'sks' => 3, 'semester' => 1, 'hari' => 'Kamis', 'jam_mulai' => '13:00', 'jam_selesai' => '14:30']);
        $sbd = MataKuliah::create(['kode_mk' => 'EF234104', 'nama_mk' => 'Database System', 'sks' => 4, 'semester' => 1, 'hari' => 'Jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '10:30']);

        // Semester 2
        $strukdat = MataKuliah::create(['kode_mk' => 'EF234201', 'nama_mk' => 'Data Structure', 'sks' => 4, 'semester' => 2, 'hari' => 'Senin', 'jam_mulai' => '10:00', 'jam_selesai' => '12:30']);
        $os = MataKuliah::create(['kode_mk' => 'EF234202', 'nama_mk' => 'Operating System', 'sks' => 4, 'semester' => 2, 'hari' => 'Selasa', 'jam_mulai' => '07:30', 'jam_selesai' => '10:00']);
        $ok = MataKuliah::create(['kode_mk' => 'EF234203', 'nama_mk' => 'Computer Organization', 'sks' => 3, 'semester' => 2, 'hari' => 'Rabu', 'jam_mulai' => '10:00', 'jam_selesai' => '11:30']);
        $kalkulus2 = MataKuliah::create(['kode_mk' => 'SM234201', 'nama_mk' => 'Calculus 2', 'sks' => 3, 'semester' => 2, 'hari' => 'Kamis', 'jam_mulai' => '07:30', 'jam_selesai' => '09:00']);

        // Semester 3
        $webProg = MataKuliah::create(['kode_mk' => 'EF234301', 'nama_mk' => 'Web Programming', 'sks' => 3, 'semester' => 3, 'hari' => 'Senin', 'jam_mulai' => '10:00', 'jam_selesai' => '12:30']);
        $oop = MataKuliah::create(['kode_mk' => 'EF234302', 'nama_mk' => 'Object Oriented Programming', 'sks' => 3, 'semester' => 3, 'hari' => 'Selasa', 'jam_mulai' => '13:00', 'jam_selesai' => '15:30']);
        $compNet = MataKuliah::create(['kode_mk' => 'EF234303', 'nama_mk' => 'Computer Network', 'sks' => 4, 'semester' => 3, 'hari' => 'Rabu', 'jam_mulai' => '10:00', 'jam_selesai' => '13:00']);
        $discreteMath = MataKuliah::create(['kode_mk' => 'EF234305', 'nama_mk' => 'Discrete Mathematics', 'sks' => 3, 'semester' => 3, 'hari' => 'Kamis', 'jam_mulai' => '08:00', 'jam_selesai' => '10:30']);
        $ai = MataKuliah::create(['kode_mk' => 'EK234201', 'nama_mk' => 'Artificial Intelligence Concepts', 'sks' => 3, 'semester' => 3, 'hari' => 'Jumat', 'jam_mulai' => '13:00', 'jam_selesai' => '15:30']);

        // Semester 4
        $ml = MataKuliah::create(['kode_mk' => 'EF234406', 'nama_mk' => 'Machine Learning', 'sks' => 3, 'semester' => 4, 'hari' => 'Jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '10:30']);
        
        // --- HUBUNGKAN PRASYARAT ---
        
        // Prasyarat untuk Semester 2
        $strukdat->prerequisites()->attach($daspro->id); // <<-- PRASYARAT BARU DITAMBAHKAN DI SINI
        $os->prerequisites()->attach($ok->id);
        $ok->prerequisites()->attach($sisdig->id);
        $kalkulus2->prerequisites()->attach(MataKuliah::where('kode_mk', 'SM234101')->first()->id);


        // Prasyarat untuk Semester 3
        $webProg->prerequisites()->attach($sbd->id);
        $oop->prerequisites()->attach($strukdat->id);
        $compNet->prerequisites()->attach($os->id);
        $ai->prerequisites()->attach($strukdat->id);
        $discreteMath->prerequisites()->attach($kalkulus2->id);

        // Prasyarat untuk Semester 4
        $ml->prerequisites()->attach($ai->id);
    }
}

