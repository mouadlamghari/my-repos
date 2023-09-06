<?php

namespace App\Models;

use App\Models\Equipe;
use App\Models\Blocoperation;
use App\Models\Typeoperation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operation extends Model
{
    use HasFactory;
    protected $guarded=[];

        public function blocoperation(){
            return $this->belongsTo(Blocoperation::class);
        }

    public function equipe(){
        return $this->belongsTo(Equipe::class);
    }

    public function Typeoperation(){
        return $this->belongsTo(Typeoperation::class);
    }
}
