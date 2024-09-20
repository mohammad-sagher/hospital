<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_times', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل سجل
         $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->enum('day_of_week', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])->notNull(); // يوم الأسبوع
            $table->time('available_time'); // الوقت المتاح في هذا اليوم
            $table->enum('status', ['available', 'booked'])->default('available'); // حالة الوقت (متاح أو محجوز)
            $table->timestamps(); // الحقول created_at و updated_at

            // إنشاء مفتاح خارجي لربط الطبيب
          ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_times');
    }
}
