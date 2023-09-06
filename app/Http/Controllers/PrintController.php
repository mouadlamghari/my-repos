<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    function print ($id){
        $consultation = Consultation::with('patient','paiment')->whereId($id)->first();
        return view('Print',['consultation'=>$consultation]);
    }
}
