<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableTime extends Model
{
    use HasFactory;

    // الحقول القابلة للتعبئة
    protected $fillable = [
        'doctor_id',        // معرف الطبيب
        'day_of_week',      // يوم الأسبوع
        'available_time',   // الوقت المتاح
        'status'            // حالة الوقت (متاح أو محجوز)
    ];

    // العلاقة مع جدول الأطباء
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
  
}
