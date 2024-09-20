<?php
namespace App\Http\Controllers;

use App\Models\Apointment;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Examination;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $patientsCount = Patient::count();


        $appointmentsCount = Apointment::count();


        $invoicesCount = Invoice::count();


        $examinationsToday = Examination::whereDate('created_at', now()->toDateString())->count();

        $appointments = Apointment::with(['doctor', 'patient'])->get();
     


        return view('dashboard.index', compact('patientsCount', 'appointmentsCount', 'invoicesCount', 'examinationsToday', 'appointments'));
    }
    public function home(){
        return view('health.home');
    }
}
