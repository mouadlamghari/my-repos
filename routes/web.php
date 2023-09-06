<?php

use App\Models\Service;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\PaimentController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatiqtiqueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});





Route::middleware('auth')->group(function(){


Route::resource('Employe',EmployerController::class);
Route::middleware(['auth','RoleCheck:ADMIN,manage-employe'])->group(function(){
    Route::resource('Roles',RoleController::class);
    Route::get('Logs',[LogController::class,'index']);
    Route::get('Statistiques',[StatiqtiqueController::class,'index']);
});
Route::resource('Services',ServicesController::class);
    Route::resource('Patients',PatientController::class);
    Route::post('Paiment',[PaimentController::class,'add'])->name('paiment');
    Route::get('Paiments',[PaimentController::class,'index'])->name('paiments');
    Route::get('print/{id}',[PrintController::class,'print'])->name('print');

    Route::post('Valider/{id}',[PaimentController::class,'confirmer'])->name('validate');
    Route::post('Reject/{id}',[PaimentController::class,'reject'])->name('reject');
    Route::resource('Consultations',RendezVousController::class);

Route::middleware(['auth','RoleCheck:MEDECIN,show-calender'])->group(function(){
    Route::get('Calender',[CalenderController::class,'index']);
});

Route::get("result",[SearchController::class,'search'])->name('search');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("consultationResult",function(){
    return view("consultationResultPage");
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
