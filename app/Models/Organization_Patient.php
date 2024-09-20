<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization_Patient extends Model
{
    use HasFactory;
   
    protected $fillable=['organization_id','patient_id',];
}
