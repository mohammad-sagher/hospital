<?php
namespace App\Models;


use  App\Models\Apointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'working_hours',
        'phone_number',
        'email',
        'department_id',
        'year_of_experience'
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'apointments', 'doctor_id', 'patient_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }

    public function apointments()
    {
        return $this->hasMany(Apointment::class);
    }
    public function available_times()
    {
        return $this->hasmany(AvailableTime::class);
    }

}
