<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Organization;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // عرض قائمة جميع المرضى مع تحميل البيانات الأساسية فقط
        $patients = Patient::all(); // تحميل بيانات المرضى فقط
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        // عرض صفحة إضافة مريض جديد مع بيانات المنظمات
        $organizations = Organization::all();
        return view('patients.create', compact('organizations'));
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

        // إنشاء المريض وتخزينه
        $patient = Patient::create($validated);

        // إضافة المنظمات (organizations) إذا كانت موجودة
        if ($request->has('organizations')) {
            $patient->organizations()->attach($request->organizations);
        }

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        // عرض تفاصيل مريض معين مع تحميل العلاقات
        $patient->load(['apointments', 'examinations', 'invoices', 'organizations']);
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        // عرض صفحة تعديل بيانات المريض مع بيانات المنظمات
        $organizations = Organization::all();
        return view('patients.edit', compact('patient', 'organizations'));
    }

    public function update(Request $request, Patient $patient)
    {
        // تحديث بيانات المريض
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:patients,email,' . $patient->id,
            'gender' => 'required|string|max:15',
            'organizations' => 'nullable|array',
            'organizations.*' => 'exists:organizations,id',
        ]);

        $patient->update($validated);

        // تحديث المنظمات (organizations) إذا كانت موجودة
        if ($request->has('organizations')) {
            $patient->organizations()->sync($request->organizations);
        } else {
            $patient->organizations()->detach();
        }

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        // حذف المريض وجميع البيانات المتعلقة به
        $patient->apointments()->delete();
        $patient->examinations()->delete();
        $patient->invoices()->delete();
        $patient->organizations()->detach(); // إزالة العلاقات مع المنظمات
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient and related data deleted successfully.');
    }
}
