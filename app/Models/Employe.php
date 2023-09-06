<?php

namespace App\Models;

use App\Models\User;
use App\Models\Roles;
use App\Models\Patient;
use App\Models\Consultation;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;
    protected $guarded=[];
    function role(){
        return $this->belongsTo(Role::class);
    }
    function patients(){
        return $this->hasMany(Patient::class,);
    }

    function logs(){
        return $this->morphMany(Log::class,'loogable');
    }

    function consultations(){
        return $this->hasManyThrough(Consultation::class,Patient::class);
    }

    function user(){
        return $this->hasOne(User::class,'employe_id');
    }
}
