<?php

namespace Database\Seeders;

use App\Models\WorkSchedule;
use Illuminate\Database\Seeder;

class WorkScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkSchedule::factory()
                ->count(7)
                ->create();
    }
}
