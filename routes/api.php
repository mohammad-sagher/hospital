<?php

use App\Http\Controllers\apicontroller\PatientsController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('patients',[PatientsController::class,'index']);
Route::get('patients/{id}',[PatientsController::class,'show']);

Route::post('patients', [PatientsController::class, 'create']);
Route::delete('patients/{id}',[PatientsController::class,'destroy']);
Route::put('patients/{id}',[PatientsController::class,'update']);



