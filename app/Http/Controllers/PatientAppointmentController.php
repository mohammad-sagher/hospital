<?php

namespace App\Http\Controllers;

use App\Models\Apointment;
use App\Models\AvailableTime;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAppointmentController extends Controller
{

    public function create(Request $request)
    {

        $patient = Patient::findOrFail($request->patient_id);

        // Fetch departments to show in the appointment form
        $departments = Department::all();

        // Return the view with the specific patient's information only
        return view('health.appointment', compact('departments', 'patient'));
    }


    public function getDoctorsByDepartments(Request $request)
    {
        $departmentId = $request->input('department_id');
        $doctors = Doctor::where('department_id', $departmentId)->get();
        return response()->json($doctors);
    }

    public function getAvailableTimesByDoctors(Request $request)
    {
        $doctorId = $request->input('doctor_id');
        $availableTimes = AvailableTime::where('doctor_id', $doctorId)
            ->where('status', 'available')
            ->get(['day_of_week', 'available_time']);
        return response()->json($availableTimes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'available_time' => 'required|string',
            'patient_id' => 'required|exists:patients,id', // Validate patient ID
            'reason_for_visit' => 'required|string',
            'appointment_status' => 'required|string',
        ]);

        // Check if the time slot is already booked
        if (Apointment::where('doctor_id', $validated['doctor_id'])
                      ->where('available_time', $validated['available_time'])
                      ->exists()) {
            return redirect()->back()->withErrors(['error' => 'The selected time slot is already booked.']);
        }

        // Check if the doctor has reached the maximum of 50 appointments per day
        $appointmentsCount = Apointment::where('doctor_id', $validated['doctor_id'])
                                       ->whereDate('available_time', \Carbon\Carbon::parse($validated['available_time'])->toDateString())
                                       ->count();

        if ($appointmentsCount >= 50) {
            return redirect()->back()->withErrors(['error' => 'Doctor cannot accept more than 50 patients per day.']);
        }

        // Create the new appointment
        Apointment::create($validated);
        session()->flash('success', 'Appointment has been booked successfully!');

        return redirect()->route('health.home')->with('success', 'Appointment created successfully.');
    }

}
