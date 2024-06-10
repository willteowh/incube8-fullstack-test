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
        Schema::table('bus_stops', function (Blueprint $table) {
            $table->double('bus_stop_location_latitude')->after('bus_stop_location_value');
            $table->double('bus_stop_location_longitude')->after('bus_stop_location_latitude');
            $table->double('bus_stop_location_value')->nullable(true)->comment("DEPRECATED")->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bus_stops', function (Blueprint $table) {
            $table->dropColumn('bus_stop_location_latitude');
            $table->dropColumn('bus_stop_location_longitude');
            $table->double('bus_stop_location_longitude')->nullable(false)->comment("")->change();
        });
    }
};
