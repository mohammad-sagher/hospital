<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{ 
    protected $fillable = ['total_amount','paymaent_status','paymaent_date','issud_date','patient_id'];
    use HasFactory;
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}

