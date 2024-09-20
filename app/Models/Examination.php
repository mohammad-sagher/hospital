<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;
   
    protected $fillable=['patient_id','doctor_id','result','diagnosis','treatment_diraction','examination_date'];
    public function doctor(){
        return $this->belongsTo(Doctor::class);

       }
       public function patient(){
        return $this->belongsTo(Patient::class);
       }
       public function medications(){
        return $this->belongsToMany(Medication::class,'prescriptions','examination_id','medication_id');
       }
}