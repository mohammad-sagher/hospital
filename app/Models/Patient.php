<?php
namespace App\Models;

use Apointment as GlobalApointment;
use App\Models\Apointment;;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'age', 
        'phone_number', 
        'address', 
        'email',  
        'gender'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'apointments', 'patient_id', 'doctor_id');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }

    public function apointments()
    {
        return $this->hasMany(Apointment::class);
    }
}
