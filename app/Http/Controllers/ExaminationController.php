<?php
namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Medication; // تأكد من استيراد نموذج الأدوية
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index()
    {
        $examinations = Examination::with(['patient', 'doctor', 'medications'])->get();
        return view('examinations.index', compact('examinations'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medications = Medication::all(); // لجلب الأدوية المتاحة
        return view('examinations.create', compact('patients', 'doctors', 'medications'));
    }

    public function store(Request $request)
    {
        //'patients_id','doctor_id','diagnosis','treatment_diraction','examination_date'
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'examination_date' => 'required|date',
            'diagnosis' => 'nullable|string',
            'result' => 'nullable|string',
            
            'treatment_diraction' => 'nullable|string', 
          
        ]);
        //dd($validated);

        $examination = Examination::create($validated);

        // ربط الأدوية بالفحص الجديد
        if ($request->has('medications')) {
            $examination->medications()->attach($request->medications);
        }
     

        return redirect()->route('examinations.index')->with('success', 'Examination created successfully.');
    }

    public function show(Examination $examination)
    {
        return view('examinations.show', compact('examination'));
    }

    public function edit(Examination $examination)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medications = Medication::all(); // لجلب الأدوية المتاحة
        return view('examinations.edit', compact('examination', 'patients', 'doctors', 'medications'));
    }

    public function update(Request $request, Examination $examination)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'examination_date' => 'required|date',
            'diagnosis' => 'nullable|string',
            'treatment_diraction' => 'nullable|string', 
        ]);

        $examination->update($validated);

        // تحديث الأدوية المرتبطة
        if ($request->has('medications')) {
            $examination->medications()->sync($request->medications);
        } else {
            $examination->medications()->detach(); // إزالة الأدوية إذا لم يتم تقديم أدوية جديدة
        }

        return redirect()->route('examinations.index')->with('success', 'Examination updated successfully.');
    }

    public function destroy(Examination $examination)
    {
        $examination->medications()->detach(); // إزالة الأدوية المرتبطة بالفحص قبل الحذف
        $examination->delete();

        return redirect()->route('examinations.index')->with('success', 'Examination deleted successfully.');
    }
}
