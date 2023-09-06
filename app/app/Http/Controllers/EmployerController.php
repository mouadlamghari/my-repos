<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\Employe;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Mail\MailAcountInformations;
use Illuminate\Support\Facades\Mail;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $services = Service::all();
        $employes = Employe::with('role')->paginate(5);
        return view('Employer',compact('roles','services','employes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->validate(['Email'=>'unique:users,email','Tel'=>'unique:employes,Tel'])){

            $data = $request->except('_token');
            $employer = Employe::create($data);
        if(in_array($request->role_id,Roles::ROLES)){
            $password = Str::random(8);
            $npassword = bcrypt($password);
            $role = Role::find($request->role_id);
            $user = User::create(['name'=>$request->Nom,'employe_id'=>$employer->id,'email'=>$request->Email,'role_id'=>$request->role_id,'password'=>$password]);
            $user->assignRole($role);
            Mail::to($user->email)->send(new MailAcountInformations(['email'=>$user->email,'password'=>$password]));
        }
        return response()->json(['success'=>'Employer bien crée']);
    }
    return response()->json(['errors' => $request->validator->errors()], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->validate(['Email'=>"unique:users,email,$id",'Tel'=>"unique:employes,Tel,$id"])){

        $employe = Employe::find($id);
        $id = ($employe->user->id);
       $user = User::find($id);
       ($user->update(['role_id'=>$request->role_id]));
       $user->syncRoles([$request->role_id]);
        $user->role_id=$request->role_id;
        $user->save();
        $data = ($request->except('_token','_method'));
        $employe->update($data);
        return back()->with('success','employe birn modifier');
        }
        return response()->json(['errors' => $request->validator->errors()], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employe::destroy($id);
        return response()->json(['status'=>'bien supprimmer']);
    }
}
