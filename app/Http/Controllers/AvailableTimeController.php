<?php

namespace App\Http\Controllers;

use App\Models\AvailableTime;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\log;


class AvailableTimeController extends Controller
{
    /**
     * Display a listing of the available times.
     */
    public function index()
    {
        $availableTimes = AvailableTime::with('doctor')->get();
        return view('availabletimes.index', compact('availableTimes'));
    }

    /**
     * Show the form for creating a new available time.
     */
    public function create()
    {
        $doctors = Doctor::all();
        return view('availabletimes.create', compact('doctors'));
    }

    /**
     * Store a newly created available time in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'available_times' => 'required|array',
            'available_times.*.time' => 'nullable|date_format:H:i',
        ]);

        $availableTimes = [];
        foreach ($validatedData['available_times'] as $day => $timeData) {
            $time = $timeData['time'] ?? null;
            if ($time) {
                $availableTimes[] = [
                    'doctor_id' => $validatedData['doctor_id'],
                    'day_of_week' => $day,
                    'available_time' => $time,
                    'status' => 'available',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        AvailableTime::insert($availableTimes);

        return redirect()->route('availabletimes.index')->with('success', 'تمت إضافة الأوقات المتاحة بنجاح.');
    }

    /**
     * Display the specified available time.
     */
    public function show( $id)
    {
        $availableTime=AvailableTime::findOrFail($id);
        $availableTime->load(['doctor']);
        return view('availabletimes.show', compact('availableTime'));
    }

    /**
     * Show the form for editing the specified available time.
     */
    public function edit($id)
    {
        $availableTimes=AvailableTime::findOrFail($id);
        $doctors = Doctor::all();
        $availableTimes = AvailableTime::where('doctor_id', $availableTimes->doctor_id)
                                       ->pluck('available_time', 'day_of_week')
                                       ->toArray();

        return view('availabletimes.edit', compact('availableTime', 'doctors', 'availableTimes'));
    }

    /**
     * Update the specified available time in storage.
     */
    public function update(Request $request,$id){
        $availableTime=AvailableTime::findOrFail($id);
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'available_times' => 'required|array',
            'available_times.*' => 'nullable|date_format:H:i',
        ]);

        AvailableTime::where('doctor_id', $validatedData['doctor_id'])->delete();

        $availableTimes = [];
        foreach ($validatedData['available_times'] as $day => $time) {
            if ($time) {
                $availableTimes[] = [
                    'doctor_id' => $validatedData['doctor_id'],
                    'day_of_week' => $day,
                    'available_time' => $time,
                    'status' => 'available',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        AvailableTime::insert($availableTimes);

        return redirect()->route('availabletimes.index')->with('success', 'تم تحديث الأوقات المتاحة بنجاح.');
    }




    /**
     * Remove the specified available time from storage.
     */
    public function destroy($id)
    {
        $availableTime = AvailableTime::find($id);

        if ($availableTime) {
            Log::info('حذف الوقت المتاح:', ['id' => $availableTime->id, 'doctor_id' => $availableTime->doctor_id]);

            $availableTime->delete();

            return redirect()->route('availabletimes.index')->with('success', 'تم حذف الوقت المتاح بنجاح.');
        } else {
            return redirect()->route('availabletimes.index')->with('error', 'لم يتم العثور على الوقت المتاح للحذف.');
        }
    }

}
