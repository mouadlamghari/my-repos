<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employe;
use App\Models\Paiment;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Charts\ConsultationChart;
use Illuminate\Support\Facades\DB;

class StatiqtiqueController extends Controller
{
    function index(){
        $totalpatient  = Patient::count();
        $totalconsultations  = Consultation::count();
        $totalmedecin  = Employe::whereRoleId(4)->count();
        $totalinfermiere  = Employe::whereRoleId(3)->count();
        $totalnotpaid  = Paiment::whereStatus('En Attent')->sum('Montant');
        $totalpaid  = Paiment::whereStatus('Confirme')->sum('Montant');
        $totalasistant  = Employe::whereRoleId(2)->count();
        $totalotherEmploye  = Employe::whereNotIn('role_id',[1,2,3,4])->count();

        $services = Service::withCount('patients')->get();


        $currentYear = Carbon::now()->year;
            $data = Consultation::select(
                DB::raw("DATE_FORMAT(Date_consultation, '%Y-%m') as month"),
                DB::raw("COUNT(*) as count")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->whereYear('Date_consultation', $currentYear)
            ->get();

            $incomes = Paiment::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(Montant) as total_payment')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();



            return view('Statistique',
            compact('data','totalpatient',
            'totalconsultations','totalmedecin',
        'totalinfermiere','totalasistant','totalotherEmploye','incomes','services','totalnotpaid','totalpaid'));

    }
}
