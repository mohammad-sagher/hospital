<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name','type','contact'];

    use HasFactory;
    public function patients() {
        return $this->belongsToMany(Patient::class);
    }
}
