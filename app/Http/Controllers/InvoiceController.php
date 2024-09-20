<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient; // إذا كان هناك علاقة مع المرضى
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        // عرض قائمة جميع الفواتير
        $invoices = Invoice::with('patient')->get(); // إذا كانت الفواتير مرتبطة بالمرضى
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        // عرض صفحة إضافة فاتورة جديدة مع تمرير بيانات المرضى
        $patients = Patient::all(); // تحميل بيانات المرضى لتحديدهم في الفاتورة
        return view('invoices.create', compact('patients'));
    }

    public function store(Request $request)
    { 
        // التحقق من صحة البيانات الواردة
        $validated = $request->validate([
            'total_amount' => 'required|numeric',
            'name' => 'nullable|string',
            'patient_id' => 'required|exists:patients,id', // التأكد من وجود المريض
            'paymaent_status' =>'nullable|string',
            'paymaent_date'=>'nullable|string',
            'issud_date'=>'nullable|string',
        ]);


        // إنشاء الفاتورة وتخزينها
        Invoice::create($validated);
      
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        // عرض تفاصيل فاتورة معينة
        $invoice->load('patient'); // تحميل بيانات المريض المرتبط بالفاتورة
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        // عرض صفحة تعديل بيانات الفاتورة مع تمرير بيانات المرضى
        $patients = Patient::all(); // تحميل بيانات المرضى لتحديدهم في الفاتورة
        return view('invoices.edit', compact('invoice', 'patients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        // تحديث بيانات الفاتورة
        $validated = $request->validate([
            'total_amount' => 'required|numeric',
           
            'patient_id' => 'required|exists:patients,id', // التأكد من وجود المريض
            'paymaent_status' =>'nullable|string',
            'paymaent_date'=>'nullable|string',
            'issud_date'=>'nullable|string',
        ]);

        $invoice->update($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        // حذف فاتورة معينة
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
