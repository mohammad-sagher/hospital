<?php
namespace App\Models;


use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apointment extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'patient_id', 
        'doctor_id',
        'available_time', 
        
        'reason_for_visit',
        'appointment_status', 
      
        
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
