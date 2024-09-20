<?php
namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Patient;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        // عرض قائمة جميع المنظمات مع تحميل المرضى المرتبطين
        $organizations = Organization::with('patients')->get();
        return view('organizations.index', compact('organizations'));
    }

    public function create()
    {
        // عرض صفحة إضافة منظمة جديدة مع بيانات المرضى
        $patients = Patient::all();
        return view('organizations.create', compact('patients'));
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات الواردة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string',
            'contact' => 'nullable|string',

          
        ]);

        // إنشاء المنظمة وتخزينها
        $organization = Organization::create($validated);

        // إضافة المرضى المرتبطين
        if (isset($validated['patients'])) {
            $organization->patients()->attach($validated['patients']);
        }

        return redirect()->route('organizations.index')->with('success', 'Organization created successfully.');
    }

    public function show(Organization $organization)
    {
        // عرض تفاصيل منظمة معينة بما في ذلك المرضى المرتبطين
        $organization->load('patients');
        return view('organizations.show', compact('organization'));
    }

    public function edit(Organization $organization)
    {
        // عرض صفحة تعديل بيانات المنظمة مع بيانات المرضى
        $patients = Patient::all();
        return view('organizations.edit', compact('organization', 'patients'));
    }

    public function update(Request $request, Organization $organization)
    {
        // التحقق من صحة البيانات الواردة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'patients' => 'nullable|array',
            'patients.*' => 'exists:patients,id',
        ]);

        // تحديث بيانات المنظمة
        $organization->update($validated);

        // تحديث المرضى المرتبطين
        if (isset($validated['patients'])) {
            $organization->patients()->sync($validated['patients']);
        } else {
            $organization->patients()->detach();
        }

        return redirect()->route('organizations.index')->with('success', 'Organization updated successfully.');
    }

    public function destroy(Organization $organization)
    {
        // حذف المنظمة وجميع البيانات المتعلقة بها
        $organization->patients()->detach();
        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization deleted successfully.');
    }
}
