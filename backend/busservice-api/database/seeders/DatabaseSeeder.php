<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bus;
use App\Models\BusStop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 3 buses
        $buses = Bus::factory()->count(3)->create();

        // Create 10 bus stops
        $busStops = BusStop::factory()->count(10)->create();

        // Days of the week
        $daysOfWeek = range(0, 6); // 0 = Sunday, 6 = Saturday

        // Generate schedules for each bus
        foreach ($buses as $bus) {
            // Generate a random schedule
            $schedule = [];

            foreach ($busStops as $busStop) {
                foreach ($daysOfWeek as $day) {
                    $schedule[] = [
                        'bus_id' => $bus->bus_id,
                        'bus_stop_id' => $busStop->bus_stop_id,
                        'bus_schedule_day' => $day,
                        'bus_schedule_time' => $this->randomTime(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Insert the schedule into the database
            DB::table('bus_schedules')->insert($schedule);
        }
    }

    private function randomTime()
    {
        $hour = rand(6, 23);
        $minute = rand(0, 59);
        return sprintf('%02d:%02d:00', $hour, $minute);
    }
}
