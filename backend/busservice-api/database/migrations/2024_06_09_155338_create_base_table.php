<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id('bus_id');
            $table->string('bus_name');
            $table->timestamps();
        });

        Schema::create('bus_stops', function (Blueprint $table) {
            $table->id('bus_stop_id');
            $table->string('bus_stop_name');
            $table->double('bus_stop_location_value');
            $table->timestamps();
        });

        Schema::create('bus_schedules', function (Blueprint $table) {
            $table->id('bus_schedule_id');
            $table->foreignId('bus_id')->constrained('buses', 'bus_id')->onDelete('cascade');
            $table->foreignId('bus_stop_id')->constrained('bus_stops', 'bus_stop_id')->onDelete('cascade');
            $table->integer('bus_schedule_day');
            $table->time('bus_schedule_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_schedules');
        Schema::dropIfExists('buses');
        Schema::dropIfExists('bus_stops');
    }
};
