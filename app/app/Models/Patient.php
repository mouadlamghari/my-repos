<?php

namespace App\Models;

use App\Models\Employe;
use App\Models\Medecin;
use App\Models\Consultation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    protected $guarded=[];
    function medecin(){
        return $this->belongsTo(Employe::class,'employe_id');
    }

    function consultations (){
        return $this->hasMany(Consultation::class);
    }
}
