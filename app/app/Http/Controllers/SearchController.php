<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Paiment;
use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(Request $request){
        $paiments = Paiment::where('numerocheck',$request->query('query'))
        ->orWhere('transaction','like','%'.$request->query('query').'%')
        ->get();
        $employes = Employe::where('Nom','like','%'.$request->query('query').'%')
        ->whereIn('role_id',["3","4"])
        ->with('role')
        ->get();
        $patients = Patient::where('CIN','%'.$request->query('query').'%')
        ->orWhere('Nom','like','%'.$request->query('query').'%')
        ->orWhere('Prenom')->get();
        return view('resultPage',compact('paiments','employes','patients'));
    }
}
