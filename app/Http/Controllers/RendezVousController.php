<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Roles;
use App\Models\Equipe;
use App\Models\Employe;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\Operation;
use App\Mail\RendezVousMail;
use App\Models\Consultation;
use App\Models\Equipemember;
use Illuminate\Http\Request;
use App\Models\Blocoperation;
use App\Models\Typeoperation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\EventCollection;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


            $query = Consultation::query();

            if ($request->filled('medecin')) {
                $medecinName = $request->input('medecin');
                $query->whereHas('patient.medecin', function ($medecinQuery) use ($medecinName) {
                    $medecinQuery->where('Nom', 'like', '%' . $medecinName . '%');
                });
            }

            if ($request->filled('patient')) {
                $patientName = $request->input('patient');
                $query->whereHas('patient', function ($patientQuery) use ($patientName) {
                    $patientQuery->where('Nom', 'like', '%' . $patientName . '%')
                        ->orWhere('Prenom', 'like', '%' . $patientName . '%')
                        ->orWhere('CIN', 'like', '%' . $patientName . '%');
                });
            }

            if ($request->filled('from') && $request->filled('to')) {
                $fromDate = $request->input('from');
                $toDate = $request->input('to');
                $query->whereBetween('Date_consultation', [$fromDate, $toDate]);
            }

            if($request->filled('specific')){
                $query->whereDate('Date_consultation','=',$request->input('specific'));
            }

            $consultations = $query->with('patient.medecin','operation','operation.equipe.equipemember','operation.blocoperation')->paginate(5)
            ->appends(['medecin' => $request->medecin, 'patient' => $request->patient]);


    /*     $consultations = Consultation::query();
        $consultations->whereHas('patient', function ($query) use ($patient,$medecin) {
            $query->where('Nom', 'like', '%' . $patient . '%')
                ->orWhere('Prenom', 'like', '%' . $patient . '%')
                ->orWhere('CIN', 'like', '%' . $patient . '%')
                ->orWhereHas('medecin', function ($doctorQuery) use ($medecin) {
                    $doctorQuery->where('Matricule', 'like', '%' . $medecin . '%')
                        ->orWhere('Nom', 'like', '%' . $medecin . '%')
                        ->orWhere('Prenom', 'like', '%' . $medecin . '%')->get();
                });
        })->get();

        dd($consultations); */

        // with([['patient.medecin'=>function($query){
        //}],'operation'])->paginate(5);



        $patients = Patient::with('medecin.consultations')->get();
        $equipes = Equipe::all();
        $blocs = Blocoperation::all();

        $events = [];
        $role = request()->user()->role_id;
        if($role==Roles::MEDECIN){
            $cosultation = Employe::with('consultations')->whereId(request()->user()->employe_id)->first() ;
            foreach($cosultation->consultations as $c){
                $endDateTime = Carbon::parse($c->Date_consultation)->addMinutes(30);
                $events[]=[
                    'title'=>$c->Objet,
                    'start'=>$c->Date_consultation,
                    'end'=>$endDateTime->format('Y-m-d H:i:s')
                ];
            }
        }
        //dd($consultations);

        $medecins  = Employe::whereRoleId(4)->get();
        $Assistants  = Employe::whereRoleId(2)->get();
        $infermiers  = Employe::whereRoleId(3)->get();
        $typeoperations = Typeoperation::all();

        return view('Consultation',compact('consultations','patients','typeoperations','equipes','blocs','events','medecins','Assistants','infermiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $consultations = Consultation::all();
        $medecins = Medecin::with('consultations')->get();
        $patients = Patient::with('medecin.consultations')->get();
        $equipes = Equipe::with('equipemember.medecin')->get();
        $blocs = Blocoperation::all();
        return view('ConsultationAjouter',compact('consultations','medecins','patients','equipes','blocs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date =  $request->Date_consultation;
        $time = $request->time;
        $dateTimeString = $date . ' ' . $time;
       /*  $dateTime = DateTime::createFromFormat('Y/m/d H:i', $dateTimeString);
        dd($dateTime);
        // Set the time portion of the date object to match the time object
        $date->setTime($time->format('H'), $time->format('i'));
        $datetime = $date;
 */
            $consultation = Consultation::create(['NumeroConsultation'=>$request->NumeroConsultation,
            'patient_id'=>$request->patient_id,
            'Objet'=>$request->Objet,
            'Observation'=>$request->Observation,
            'TypeCosultation'=>$request->TypeCosultation,
            'Date_consultation'=>$dateTimeString
            ]);


        if($request->TypeCosultation=='operation'){
            $equipemembers  =  $request->equipe;
            $equipe = Equipe::create(['nom'=>$consultation->id.'-equipe']);
            foreach($equipemembers  as $member){
            Equipemember::create(['equipe_id'=>$equipe->id,'employe_id'=>$member]);
            }
            Operation::create([
                'equipe_id'=>$equipe->id,
                'blocoperatoire'=>$request->blocoperation,
                'DateDebut'=>$request->DateDebut,
                'DateFin'=>$request->DateFin,
                'Observation'=>$request->ObservationOperation,
                'consultation_id'=>$consultation->id,
                "typeoperation_id"=>$request->typeoperation_id
            ]);
        }
        $patient = Patient::find($request->patient_id);
        Mail::to($patient->Email)->send(new RendezVousMail($patient,$consultation));
        return back();
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
        $medecins  = Employe::whereRoleId(4)->get();
        $Assistants  = Employe::whereRoleId(2)->get();
        $infermiers  = Employe::whereRoleId(3)->get();
        $typeoperations = Typeoperation::all();
        $consultation = Consultation::with(['patient','operation','operation.blocoperation','operation.equipe'])->where('id',$id)->first();
        $medecins = Medecin::with('consultations')->get();
        $patients = Patient::with('medecin.consultations')->get();
        $equipes = Equipe::with('equipemember.medecin')->get();
        $blocs = Blocoperation::all();
        return view('ConsultationModifier',compact('consultation','medecins','patients','equipes','blocs','infermiers','infermiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $date =  $request->Date_consultation;
        $time = $request->time!='Choisir Time'?$request->time:null;
        $dateTimeString = $date . ' ' . $time;
       /*  $dateTime = DateTime::createFromFormat('Y/m/d H:i', $dateTimeString);
        dd($dateTime);
        // Set the time portion of the date object to match the time object
        $date->setTime($time->format('H'), $time->format('i'));
        $datetime = $date;
 */
        $consultation = Consultation::find($id);
        $consultation->update(['NumeroConsultation'=>$request->NumeroConsultation,
        'patient_id'=>$request->patient_id,
        'Objet'=>$request->Objet,
        'Observation'=>$request->Observation,
        'TypeCosultation'=>$request->TypeCosultation,
        'Date_consultation'=>$dateTimeString,
        ]);
        if($request->get('TypeCosultation')=='operation'){
            $equipemembers  =  $request->equipe;
            $equipe = Equipe::find($consultation->operation->equipe->id);
            $equipe->equipemember()->delete();

            foreach($equipemembers  as $member){
                Equipemember::create(['equipe_id'=>$equipe->id,'employe_id'=>$member]);
            }

            $operation = Operation::find($consultation->operation->id);
            $operation->update([
                'equipe_id'=>$equipe->id,
                'blocoperatoire'=>$request->blocoperatoire,
                'DateDebut'=>$request->DateDebut,
                'DateFin'=>$request->DateFin,
                'Observation'=>$request->ObservationOperation,
                'consultation_id'=>$consultation->id
            ]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
