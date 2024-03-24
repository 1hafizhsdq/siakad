<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertemuan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function matkul(){
        return $this->belongsTo(Matkul::class,'matkul_id');
    }
    
    public function dosen(){
        return $this->belongsTo(User::class,'dosen_id');
    }
    
    public function jadwal(){
        return $this->belongsTo(JadwalKuliah::class,'jadwal_id');
    }
    
    public function tahunajaran(){
        return $this->belongsTo(TahunAjaran::class,'tahun_ajaran_id');
    }
    
    public function jenisperkuliahan(){
        return $this->belongsTo(JenisPerkuliahan::class,'jenis_perkuliahan_id');
    }
    
    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'ruangan_id');
    }
}
