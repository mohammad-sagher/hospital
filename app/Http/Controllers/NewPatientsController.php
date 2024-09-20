<?php

namespace App\Http\Controllers;
use App\Http\Controllers\PatientAppointmentController;
use App\Models\Organization;
use App\Models\Patient;
use Illuminate\Http\Request;

class NewPatientsController extends Controller
{

    //
    public function create()
    {
        // عرض صفحة إضافة مريض جديد مع بيانات المنظمات
        $organizations = Organization::all();
        return view('NewPatients.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات الواردة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:patients',
            'gender' => 'required|string|max:15',
            'organizations' => 'nullable|array',
            'organizations.*' => 'exists:organizations,id',
        ]);
        if (Patient::where('email', $validated['email'])->exists()) {
            return redirect()->route('create.appointment')->withErrors(['email' => 'Email already exists ']);
        }




        // إنشاء المريض وتخزينه
        $patient = Patient::create($validated);



        return redirect()->route('create.appointment', ['patient_id' => $patient->id])
                         ->with('success', 'Patient created successfully.');




    }
}

