<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
        protected $fillable = ['user_id', 'dosen_wali_id', 'nim', 'program_studi'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function dosenWali() {
        return $this->belongsTo(User::class, 'dosen_wali_id');
    }
    public function rencanaStudi() {
        return $this->hasMany(RencanaStudi::class);
    }

}

