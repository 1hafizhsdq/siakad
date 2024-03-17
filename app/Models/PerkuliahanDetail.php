<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerkuliahanDetail extends Model
{
    use HasFactory;
    // use SoftDeletes;

    // protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function perkuliahan(){
        return $this->belongsTo(Perkuliahan::class,'perkuliahan_id');
    }
    
    public function matkul(){
        return $this->belongsTo(Matkul::class,'matkul_id');
    }
    
    public function dosen(){
        return $this->belongsTo(User::class,'dosen_id');
    }
}
