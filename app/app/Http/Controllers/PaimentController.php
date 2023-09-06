<?php

namespace App\Http\Controllers;

use App\Models\Paiment;
use Illuminate\Http\Request;

class PaimentController extends Controller
{

   function add(Request $request){
    $data = $request->except('_token');
    if(in_array( (int) $request->typepaiment_id,[2,3])){
        $data['status']='En Attent';
        Paiment::create($data);
    }
    Paiment::create($data);
    return back();
   }

   function index(){
    $paiments = Paiment::with('mode')->get();
    return view('Paiments',compact('paiments'));
   }

   function confirmer($id){
    $p = Paiment::find($id);
    $p->status='Confirme';
    $p->save();
    return back();
   }

   function reject($id){
    $p = Paiment::find($id);
    $p->status='Rejected';
    $p->save();
    return back();
   }


}
