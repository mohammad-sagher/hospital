<?php
// app/Http/Controllers/MedicationController.php

namespace App\Http\Controllers;

use App\Models\Medication;
use App\Models\Examination;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index()
    {
        $medications = Medication::all();
        return view('medications.index', compact('medications'));
    }

    public function create()
    {
    
        return view('medications.create');
    }

    public function store(Request $request)
    {
        //name','instruction','dosage','side_effect','avantages'
       $validated= $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'side_effects' => 'required|string|max:255',
            'instruction' => 'required|string',
             'avantages' => 'string'
        ]);
        $medication = Medication::create($validated);

       

        return redirect()->route('medications.index')->with('success', 'Medication created successfully.');
    }

    public function edit(Medication $medication)
    {
        $examinations = Examination::all();
        return view('medications.edit', compact('medication', 'examinations'));
    }

    public function update(Request $request, Medication $medication)
    {
       $validated= $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'side_effects' => 'required|string|max:255',
            'instruction' => 'required|string',
             'avantages' => 'required|string'
        ]);




        $medication->update($validated);



        return redirect()->route('medications.index')->with('success', 'Medication updated successfully.');
    }
  public function show(Medication $medication)
    {
        // عرض تفاصيل فاتورة معينة
        $medication->load('examinations'); // تحميل بيانات المريض المرتبط بالفاتورة
        return view('medications.show', compact('medication'));
    }
    public function destroy(Medication $medication)
    {
      
        $medication->delete();

        return redirect()->route('medications.index')->with('success', 'Medication deleted successfully.');
    }
}
