<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalKuliah extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function dosen(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function ruangan(){
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
    
    public function matkul(){
        return $this->belongsTo(Matkul::class, 'matkul_id');
    }
    
    public function jam_perkuliahan(){
        return $this->belongsTo(JamPerkuliahan::class, 'jam_perkuliahan_id');
    }
    
    public function paketdetail(){
        return $this->hasMany(PaketMatkulDetail::class, 'jadwal_id');
    }
}
