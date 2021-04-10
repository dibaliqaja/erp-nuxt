<?php

namespace Database\Factories;

use App\Models\WorkSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'checkin_time'     => '08:00:00',
            'break_start_time' => '12:00:00',
            'break_end_time'   => '13:00:00',
            'checkout_time'    => '17:00:00',
            'name'             => $this->faker->dayOfWeek
        ];
    }
}
