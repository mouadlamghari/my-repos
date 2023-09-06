<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    function index(){
        $logs = Log::paginate(10);
        return view('Log',compact('logs'));
    }
}
