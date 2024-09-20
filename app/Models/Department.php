<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
   protected $fillable =['name','head','contact_info','doctor_id'];
   public function doctors(){
    return $this->hasMany(Doctor::class);
   }
   public function patients(){
    return $this->belongsToMany(Patient::class);
   }
}
