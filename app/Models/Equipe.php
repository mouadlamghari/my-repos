<?php

namespace App\Models;

use App\Models\Equipemember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipe extends Model
{
    use HasFactory;
    function equipemember(){
        return $this->hasMany(Equipemember::class);
    }

    protected $guarded=[];
}
