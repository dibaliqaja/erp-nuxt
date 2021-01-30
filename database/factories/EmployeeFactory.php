<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->name,
            'date_of_birth'     => now(),
            'job_title'         => $this->faker->jobTitle,
            'employee_status'   => 'active',
            'profiles'          => '{}',
            'unit_id'           => 1,
        ];
    }
}
