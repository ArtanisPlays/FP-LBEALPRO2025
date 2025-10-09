<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaStudi extends Model
{
    protected $fillable = ['mahasiswa_id', 'tahun_akademik', 'semester', 'status', 'catatan_dosen'];
    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function mataKuliah() {
        return $this->belongsToMany(MataKuliah::class, 'mata_kuliah_rencana_studi');
    }

}

