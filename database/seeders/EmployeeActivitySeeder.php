<?php

namespace Database\Seeders;

use App\Models\EmployeeActivity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeActivity::create([
            'employee_id' => 1,
            'date' => now(),
            'timezone' => 'Asia/Jakarta',
            'time_start' => Carbon::parse('03:10:00'),
            'time_end' => Carbon::parse('04:34:00'),
            'latitude' => '321',
            'longitude' => '331',
            'notes' => 'Tes notes seeder',
        ]);
    }
}
