<?php

namespace App\Models;

use App\Models\Medecin;
use App\Models\Infermier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipemember extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function infermiere(){
        return $this->belongsTo(Infermier::class);
    }
    public function medecin(){
        return $this->belongsTo(Medecin::class);
    }
}
