<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employe;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Nom'=>'admin','Prenom'=>'admin','Email'=>'admin@admin.com','Tel'=>'0666666666','role_id'=>'1'];
        $employer = Employe::create($data);
        $role = Role::find(1);
        $user = User::create(['name'=>"admin",'employe_id'=>$employer->id,'email'=>'admin@admin.com','role_id'=>1,'password'=>'12345678']);
        $user->assignRole($role);
    }

}

