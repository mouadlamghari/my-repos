<?php

namespace App\Models;

use App\Models\Typepaiment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiment extends Model
{
    use HasFactory;
    protected $guarded=[];

    function mode(){
        return $this->belongsTo(Typepaiment::class,'typepaiment_id');
    }
}
