<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $guarded=[];
    CONST ROLES=[1,2,3,4];
    CONST ADMIN =1;
    CONST ASSISTANT =2;
    CONST INFERMIER =3;
    CONST MEDECIN =4;
}
