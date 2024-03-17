<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perkuliahan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function perkuliahandetail(){
        return $this->hasMany(PerkuliahanDetail::class,'perkuliahan_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function dosen(){
        return $this->belongsTo(User::class,'dosen_id');
    }

    public function tahunajaran(){
        return $this->belongsTo(TahunAjaran::class,'tahun_ajaran_id');
    }

    public function prodi(){
        return $this->belongsTo(Prodi::class,'prodi_id');
    }
}
