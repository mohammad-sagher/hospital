<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;
  
    protected $fillable = ['name','instruction','dosage','side_effects','avantages'];
    public function examinations(){
        return $this->belongsToMany(Examination::class,'prescriptions','examination_id','medication_id');
       }
}
