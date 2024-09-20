<?php

namespace App\Http\Controllers;

use App\Models\Apointment;
use App\Models\AvailableTime;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class ApointmentController extends Controller
{
    public function index()
    {

        $apointments = Apointment::with(['doctor', 'patient'])->get();

        return view('apointments.index', compact('apointments'));
    }

    public function create()
    {
        $departments = Department::all();
        $patients = Patient::all();
        return view('apointments.create', compact('departments', 'patients'));
    }

    public function getDoctorsByDepartment(Request $request)
    {
        $departmentId = $request->input('department_id');
        $doctors = Doctor::where('department_id', $departmentId)->get();
        return response()->json($doctors);
    }

    public function getAvailableTimesByDoctor(Request $request)
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
            'patient_id' => 'required|exists:patients,id',
            'reason_for_visit' => 'required|string',
            'appointment_status' => 'required|string',
        ]);

        if (Apointment::where('doctor_id', $validated['doctor_id'])
                     ->where('available_time', $validated['available_time'])
                     ->exists()) {
            return redirect()->back()->withErrors(['error' => 'The selected time slot is already booked.']);
        }

        $appointmentsCount = Apointment::where('doctor_id', $validated['doctor_id'])
                                       ->whereDate('available_time', \Carbon\Carbon::parse($validated['available_time'])->toDateString())
                                       ->count();

        if ($appointmentsCount >= 50) {
            return redirect()->back()->withErrors(['error' => 'Doctor cannot accept more than 50 patients per day.']);
        }


        Apointment::create($validated);

        return redirect()->route('apointments.index')->with('success', 'Appointment created successfully.');
    }


    public function show(Apointment $apointment)
    {
        $apointment->load(['doctor', 'patient']);
        return view('apointments.show', compact('apointment'));
    }

    public function edit(Apointment $apointment)
    {

        $departments = Department::all();

        $doctors = Doctor::all();

        $availableTimes = AvailableTime::where('doctor_id', $apointment->doctor_id)->get();

        $patients = Patient::all();

        return view('apointments.edit', compact('apointment', 'departments', 'doctors', 'availableTimes', 'patients'));
    }


    public function update(Request $request, Apointment $apointment)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'available_time' => 'required|string',
            'patient_id' => 'required|exists:patients,id',
            'reason_for_visit' => 'required|string',
            'appointment_status' => 'required|string',
        ]);

        if (Apointment::where('doctor_id', $validated['doctor_id'])
                     ->where('available_time', $validated['available_time'])
                     ->where('id', '<>', $apointment->id)
                     ->exists()) {
            return redirect()->back()->withErrors(['error' => 'The selected time slot is already booked.']);
        }

        $appointmentsCount = Apointment::where('doctor_id', $validated['doctor_id'])
                                       ->whereDate('available_time', \Carbon\Carbon::parse($validated['available_time'])->toDateString())
                                       ->count();

        if ($appointmentsCount >= 50) {
            return redirect()->back()->withErrors(['error' => 'Doctor cannot accept more than 50 patients per day.']);
        }

        // تحديث الموعد
        $apointment->update($validated);

        return redirect()->route('apointments.index')->with('success', 'Appointment updated successfully.');
    }


    public function destroy(Apointment $apointment)
    {
        $apointment->delete();



        return redirect()->route('apointments.index')->with('success', 'Apointment deleted successfully.');
    }
}
