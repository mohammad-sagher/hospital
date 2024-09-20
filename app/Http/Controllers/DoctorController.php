<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        // عرض قائمة جميع الأطباء مع تحميل العلاقة مع الأقسام فقط
        $doctors = Doctor::with('department')->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        // عرض صفحة إضافة طبيب جديد مع تمرير بيانات الأقسام
        $departments = Department::all();
        return view('doctors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات الواردة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'working_hours' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:doctors',
            'department_id' => 'required|exists:departments,id',
            'year_of_experience' => 'required|string|max:15',
        ]);

        // إنشاء الطبيب وتخزينه
        $doctor = Doctor::create($validated);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        // عرض تفاصيل طبيب معين مع تحميل العلاقة مع المرضى والأقسام
        $doctor->load(['patients', 'department']);
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        // عرض صفحة تعديل بيانات الطبيب مع تمرير بيانات الأقسام
        $departments = Department::all();
        return view('doctors.edit', compact('doctor', 'departments'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        // تحديث بيانات الطبيب
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'working_hours' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:doctors,email,' . $doctor->id,
            'department_id' => 'required|exists:departments,id',
            'year_of_experience' => 'required|string|max:15',
        ]);

        $doctor->update($validated);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        // حذف الطبيب
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
