<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bus;
use App\Models\BusStop;
use App\Models\BusSchedule;
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

            foreach ($daysOfWeek as $day) {
                $startTime = strtotime("05:".str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT).":00"); // Start time (5am something)
                $endTime = strtotime('23:59:59'); // End time (11:59:59 PM)

                // Generate schedule for the day
                $currentTime = $startTime;
                while ($currentTime <= $endTime) {
                    // Randomize arrival time within a 2-hour interval
                    $randomTime = date('H:i:s', $currentTime + rand(10, 100) * 7200 / 10); // 7200 seconds = 2 hours

                    foreach ($busStops as $busStop) {
                        $schedule[] = [
                            'bus_id' => $bus->bus_id,
                            'bus_stop_id' => $busStop->bus_stop_id,
                            'bus_schedule_day' => $day,
                            'bus_schedule_time' => $randomTime,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    // Move to the next interval (2 hours)
                    $currentTime += 7200; // 7200 seconds = 2 hours
                }
            }

            // Insert the schedule into the database
            DB::table('bus_schedules')->insert($schedule);
        }
    }
}
