<?php
namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // عرض قائمة جميع الأقسام
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        // عرض صفحة إضافة قسم جديد
        return view('departments.create');
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات الواردة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'nullable|string',
            'head'=>'required|string|max:255'
        ]);

        // إنشاء القسم وتخزينه
        Department::create($validated);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function show(Department $department)
    {
        // عرض تفاصيل قسم معين
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        // عرض صفحة تعديل بيانات القسم
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        // تحديث بيانات القسم
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'nullable|string',
            'head'=>'required|string|max:255'
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        // حذف قسم معين
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
