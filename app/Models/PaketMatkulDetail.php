<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketMatkulDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function paket(){
        return $this->belongsTo(PaketMatkul::class,'paket_id');
    }
    
    public function jadwal(){
        return $this->belongsTo(JadwalKuliah::class,'jadwal_id');
    }
}
