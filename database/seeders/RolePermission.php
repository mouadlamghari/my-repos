<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $admin = Role::Create(['name' => 'ADMIN']);
    $assistant = Role::Create(['name' => 'ASSISTANT']);
    $infermier = Role::Create(['name' => 'INFERMIER']);
    $medecin = Role::Create(['name' => 'MEDECIN']);

    $editeconsultation = Permission::Create(['name' => 'edit-consultation']);
    $addconsultation = Permission::Create(['name' => 'add-consultation']);
    $viewconsultation = Permission::Create(['name' => 'view-consultation']);
    $search = Permission::Create(['name' => 'search']);

    $viewpatient =  Permission::Create(['name' => 'view-patient']);
    $addpatient =  Permission::Create(['name' => 'add-patient']);
    $editepatient =  Permission::Create(['name' => 'edit-patient']);
    $showcalender =  Permission::Create(['name' => 'show-calender']);
    $managemploye = Permission::Create(['name' => 'manage-employe']);

    $admin->givePermissionTo($managemploye);
    $assistant->givePermissionTo($editeconsultation,$addconsultation,$viewconsultation,$viewpatient,$editepatient,$addpatient,$search);
    $infermier->givePermissionTo($viewconsultation,$viewpatient);
    $medecin->givePermissionTo($viewpatient,$editepatient,$viewconsultation,$editeconsultation,$showcalender);
    }
}
