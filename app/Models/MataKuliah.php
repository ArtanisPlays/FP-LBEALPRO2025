<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'semester', 'hari', 'jam_mulai', 'jam_selesai'];

    public function rencanaStudi()
    {
        return $this->belongsToMany(RencanaStudi::class, 'mata_kuliah_rencana_studi');
    }

    /**
     * The prerequisites that this course requires.
     */
    public function prerequisites()
    {
        return $this->belongsToMany(MataKuliah::class, 'matakuliah_prasyarat', 'mata_kuliah_id', 'prasyarat_id');
    }
}
