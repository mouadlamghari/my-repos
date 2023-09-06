<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Employe;
use App\Models\Medecin;
use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::paginate(5);
        $medecins = Employe::whereRoleId(4)->get();
     return view('Patients',compact('patients','medecins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('PatientAjouter');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->validate(['CIN'=>"required|unique:patients,CIN",'Nom'=>'required','Prenom'=>'required','Adresse'=>'required','Tel'=>['required','unique:patients,Tel'],'Email'=>['required','unique:patients,Email']])){

        $cinrecto='';
        $cinverso='';
        if($request->filled('cinrecto')){
            $cinrecto = Str::random(7).'.'.$request->file('cinverso')->getClientOriginalExtension();
        }
        if($request->filled('cinverso')){
            $cinverso = Str::random(7).'.'.$request->file('cinrecto')->getClientOriginalExtension();
        }
        $request->file('cinrecto')->storeAs('pics/',$cinrecto,'public');
        $request->file('cinverso')->storeAs('pics/',$cinverso,'public');
        $data=$request->except(['_token','cinrecto','cinverso']);
        $data['cinrecto']=$cinrecto;
        $data['cinverso']=$cinverso;
        Patient::create($data);
        return to_route('Patients.index')->with('success','Patient bien cree');
    }
    return to_route('Consultations.index')->withInput();
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
        $patient = Patient::find($id);
        return view('PatientModifier',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient=Patient::find($id);
        if($request->validate(['CIN'=>"required|unique:patients,CIN,$id",'Tel'=>"required|unique:patients,Tel,$id",'Email'=>"required|unique:patients,Email,$id"])){

        if($request->filled('cinrecto')){
            $cinrecto = Str::random(7).'.'.$request->file('cinverso')->getClientOriginalExtension();
            $request->file('cinrecto')->storeAs('pics/',$cinrecto,'public');
        }
        if($request->filled('cinverso')){
            $cinverso = Str::random(7).'.'.$request->file('cinrecto')->getClientOriginalExtension();
            $request->file('cinverso')->storeAs('pics/',$cinverso,'public');
        }
        $data=$request->except(['_token','cinrecto','cinverso']);
        $data['cinrecto']=$cinrecto ?? $patient->cinrecto;
        $data['cinverso']=$cinverso ?? $patient->cinverso ;
        $patient->update($data);
        return to_route('Patients.index')->with('message','Patient bien modifier');
    }
    return to_route('Consultations.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
