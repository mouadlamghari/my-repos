<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Roles;
use App\Models\Consultation;
use App\Models\Employe;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    function index(){
        $role = request()->user()->role_id;
        if($role==Roles::MEDECIN){
            $cosultation = request()->user()->employe->consultations;
            $events = [];
            foreach($cosultation as $c){
                $endDateTime = Carbon::parse($c->Date_consultation)->addMinutes(30);                $events[]=[
                    'title'=>$c->Objet,
                    'start'=>$c->Date_consultation,
                    'end'=>$endDateTime->format('Y-m-d H:i:s')
                ];
            }
        return view('ConsultationMedecin',compact('events'));
        }
    }
}
