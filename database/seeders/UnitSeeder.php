<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit1 = Unit::create([
            'name' => 'Direksi HRD',
        ]);

        $unit2 = Unit::create([
            'name' => 'Human Resource',
            'parent_unit_id' => $unit1->id
        ]);

        $unit3 = Unit::create([
            'name' => 'Career Development',
            'parent_unit_id' => $unit1->id
        ]);
    }
}
