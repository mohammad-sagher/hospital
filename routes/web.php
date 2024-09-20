<?php

use App\Http\Controllers\ApointmentController;
use App\Http\Controllers\AvailableTimeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\NewPatientsController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('health.home');
})->name('health.home');


Route::get('/create/appointment',[PatientAppointmentController::class,'create'])->name('create.appointment');
Route::post('/store/appointment',[PatientAppointmentController::class,'store'])->name('store.appointment');
Route::get('doctorss/by-department', [ApointmentController::class, 'getDoctorsByDepartments'])->name('doctors.byDepartments');
Route::get('available-timess/by-doctor', [ApointmentController::class, 'getAvailableTimesByDoctors'])->name('availableTimes.byDoctors');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('admin');

Route::get('doctors/by-department', [ApointmentController::class, 'getDoctorsByDepartment'])->name('doctors.byDepartment');
Route::get('available-times/by-doctor', [ApointmentController::class, 'getAvailableTimesByDoctor'])->name('availableTimes.byDoctor');

Route::get('/create/NewPatients', [NewPatientsController::class, 'create'])->name('create.NewPatients');
Route::post('/store/NewPatients', [NewPatientsController::class, 'store'])->name('store.NewPatients');


Route::get('/layout/dashboard', function () {
    return view('layout.dashboard');
})->name('layout.dashboard')->middleware('admin');



Route::middleware('admin')->group(function(){
    Route::resource('patients',PatientController::class);
    Route::resource('doctors',DoctorController::class);
    Route::resource('invoices',InvoiceController::class);
    Route::resource('examinations',ExaminationController::class);
    Route::resource('organizations',OrganizationController::class);
    Route::resource('departments',DepartmentController::class);
    Route::resource('apointments',ApointmentController::class);
    Route::resource('medications',MedicationController::class);
    Route::resource('availabletimes',AvailableTimeController::class);
});


    Route::get('/about', function () {
        return view('health.about');
    })->name('health.about');



    Route::get('/gogle', function () {
        return view('health.gogle');
    })->name('health.gogle');

    Route::get('/news', function () {
        return view('health.new');
    })->name('health.new');

    Route::get('/doctor', function () {
        return view('health.doctor');
    })->name('health.doctor');















//<----breeze --->


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
