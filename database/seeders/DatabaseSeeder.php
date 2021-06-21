<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UnitSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            WorkScheduleSeeder::class,
            RolePermissionSeeder::class,
            EmployeeActivitySeeder::class
        ]);
    }
}
